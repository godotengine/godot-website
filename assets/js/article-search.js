import {debouncedSearch, preload} from '/pagefind/pagefind.js';

(function () {
  window.addEventListener('pageshow', function (event) {
    const userNavigatedBack = event.persisted || performance.getEntriesByType('navigation')[0].type === 'back_forward';
    if (userNavigatedBack) {
      if (window.location.search) {
        window.history.replaceState(null, null, `${window.location.origin}${window.location.pathname}`);
      }
    }
    main();
  });

  // Load all categories with respective translation
  const articleCategoriesBySlug = {
    {{ range $category := $.Site.Data.categories }}
    {{ range $tag := index $category }}
    '{{$tag.slug}}':'{{ T (printf "%s.%s" "page.blog.category" $tag.name) }}',
      {{ end }}
    {{ end }}
  };

  // How many posts are loaded at once after a search query
  const searchResultsPerChunk = 6;
  const maxInitialResults = 12;
  const dataCategorySlugAttribute = 'data-category-slug';
  const activeCategoryClassName = 'active';
  const loadingIndicatorId = 'loading-indicator';
  const loadMoreResultsTriggerId = 'load-more-results-trigger';
  const searchFormId = 'search-form';
  const filterById = 'filtered-by';

  let loadingIndicator;
  let postsContainer;
  let bodyNode;
  let loadMoreResultsTrigger;
  let searchInput;
  let currentArticlesUrls = {};
  let state = {
    filters: undefined,
    currentSearchQuery: undefined,
    currentSearchResults: undefined,
    currentSearchResultIndex: undefined,
    isLoading: false,
  }

  function main() {
    initPage();
    initSearch();
  }

  async function handleNewSearchQuery(searchQuery) {
    if (!state.currentSearchQuery) {
      updatePaginators();
      updateCategoryTags();
    }

    if (state.currentSearchQuery && !searchQuery) {
      resetPage();
      return;
    }

    state.currentSearchQuery = searchQuery;

    resetSearchResultData();
    setIsLoading(true);

    // Preload using the first letter for faster indexing
    if (searchQuery.length === 1) {
      preload(searchQuery);
    }

    const search = await debouncedSearch(searchQuery, {
      filters: state.filters,
      sort: {
        date: 'desc'
      }
    }, 500);

    updateURLSearchParams(searchQuery);

    if (search) {
      state.currentSearchResults = search.results;
      state.currentSearchResultIndex = 0;
      await loadPostsIntoDOM();
      setIsLoading(false);
    }
  }

  function updateURLSearchParams(searchQuery) {
    const newQueryParams = new URLSearchParams();
    newQueryParams.set('search', searchQuery);
    window.history.replaceState(null, null, `?${newQueryParams.toString()}`);
  }

  async function loadPostsIntoDOM() {
    if (state.currentSearchResultIndex >= state.currentSearchResults.length) return;

    const maxResults = state.currentSearchResultIndex + maxInitialResults;

    for (let i = state.currentSearchResultIndex; i < maxResults; i += searchResultsPerChunk) {
      const paginatedResults = await Promise.all(state.currentSearchResults.slice(i, i + searchResultsPerChunk).map(r => r.data()));
      const posts = createPostsElements(paginatedResults);
      postsContainer.append(posts);
      state.currentSearchResultIndex += searchResultsPerChunk;
    }
  }

  function createPostsElements(results) {
    const template = document.createElement('template');
    template.innerHTML = '';
    for (let i = 0; i < results.length; i++) {
      const data = results[i];
      // Post already created
      if (currentArticlesUrls[data.url]) {
        continue;
      } else {
        currentArticlesUrls[data.url] = true;
      }

      template.innerHTML += `
        <a href="${data.url}">
          <article class="article-card">
            <img
              class="thumbnail"
              src="${data.meta.image}"
              alt=""
              width="16"
              height="9"
              decoding="async"
            >
            <div class="content">
              <div class="info">
                <img
                  class="avatar"
                  src="${data.meta.authorAvatarImage}"
                  width="25"
                  height="25"
                  alt="${data.meta.authorAvatarImageAlt}"
                  fetchpriority="low"
                  decoding="async"
                >
                  <span>${data.meta.author}</span>
                  <span class="date">&nbsp;-&nbsp;${data.meta.date}</span>
              </div>
              <h3>${data.meta.title}</h3>
              <p class="excerpt">${data.meta.excerpt}</p>
            </div>
          </article>
        </a>`;
    }
    return template.content;
  }

  function setIsLoading(isLoading) {
    state.isLoading = isLoading;
    if (isLoading) {
      loadingIndicator.style.display = 'block';
    } else {
      loadingIndicator.style.display = 'none';
    }
  }

  function updatePaginators() {
    const paginators = document.querySelectorAll('.pagination');
    for (const paginator of paginators) {
      paginator.remove();
    }
    postsContainer.style.marginTop = '2rem';
  }

  function updateCategoryTags() {
    const currentActiveCategory = document.querySelector('.tag.active');
    if (currentActiveCategory) {
      const categorySlug = currentActiveCategory.parentNode.getAttribute(dataCategorySlugAttribute);
      updateCurrentCategory(categorySlug);
    }

    const tagLinks = document.querySelectorAll('.tag-link');
    for (const tagLink of tagLinks) {
      tagLink.removeAttribute('href');
      const categorySlug = tagLink.getAttribute(dataCategorySlugAttribute);
      tagLink.addEventListener('click', () => onCategoryFilterClicked(tagLink, categorySlug));
    }
  }

  function onCategoryFilterClicked(tagLink, categorySlug) {
    const isCategoryAlreadyActive = categorySlug === state.filters.category;
    if (isCategoryAlreadyActive) return;

    updateCurrentCategory(categorySlug);

    const activeTag = document.querySelector('.tag.active');
    activeTag?.classList.remove(activeCategoryClassName);
    tagLink.querySelector('div').classList.add(activeCategoryClassName);

    handleNewSearchQuery(state.currentSearchQuery);
  }

  function resetSearchResultData() {
    state.currentSearchResults = []
    state.currentSearchResultIndex = 0;
    currentArticlesUrls = {};
    clearCurrentPosts();
  }

  function initPage() {
    state.currentSearchQuery = undefined;
    state.filters = {};
    state.isLoading = false;
    resetSearchResultData();
    cacheElements();
    initLoadMoreResultsIntersectionObserver();
  }

  function cacheElements() {
    bodyNode = document.querySelector('.blog-page').cloneNode(true);
    loadingIndicator = document.getElementById(loadingIndicatorId);
    postsContainer = document.querySelector('.posts');
  }

  function initLoadMoreResultsIntersectionObserver() {
    loadMoreResultsTrigger = document.getElementById(loadMoreResultsTriggerId);
    const observer = initLoadMoreResultsObserver();
    observer.observe(loadMoreResultsTrigger);
    initSearchInput();
  }

  function initSearchInput() {
    const searchForm = document.getElementById(searchFormId);
    searchForm.style.display = 'flex';
    searchForm.removeAttribute('aria-hidden');
    searchInput = searchForm.querySelector('input');
    searchInput.addEventListener('input', (e) => handleNewSearchQuery(e.target.value));
    searchInput.focus();
  }

  function resetPage() {
    window.history.replaceState(null, null, `${window.location.origin}${window.location.pathname}`);
    document.querySelector('.blog-page').replaceWith(bodyNode);
    initPage();
  }

  function initSearch() {
    const params = new Proxy(new URLSearchParams(window.location.search), {
      get: (searchParams, prop) => searchParams.get(prop),
    });

    if (params.search) {
      handleNewSearchQuery(params.search);
      searchInput.value = params.search;
    }
  }

  function initLoadMoreResultsObserver() {
    return new IntersectionObserver((entries) => {
      const entry = entries[0];
      if (!state.isLoading && state.currentSearchQuery && entry.isIntersecting) {
        loadPostsIntoDOM();
      }
    }, {rootMargin: '300px'});
  }

  function clearCurrentPosts() {
    if (postsContainer) {
      postsContainer.replaceChildren();
    }
  }

  function updateCurrentCategory(category) {
    delete state.filters.category;
    const filteredByNode = document.getElementById(filterById);

    if (category === 'all') {
      filteredByNode.style.display = 'none';
    } else {
      filteredByNode.style.display = 'block';
      filteredByNode.querySelector('span').textContent = articleCategoriesBySlug[category];
      state.filters.category = category;
    }
  }
})();

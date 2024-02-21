function applyAnchorLinks(baseSelector) {
    const baseNode = document.querySelector(baseSelector);
    if (typeof baseNode === 'undefined') {
        return;
    }

    const headings = baseNode.querySelectorAll('h2, h3, h4, h5');
    for (let i = 0; i < headings.length; i++) {
        const headingNode = headings[i];
        headingNode.classList.add('anchored');

        // Create a new anchor link.
        const template = document.createElement('template');
        template.innerHTML = `<a href="#${headingNode.id}" title="Click to copy a link to this section." class="anchored-link"></a>`;
        const anchorNode = template.content.firstChild;

        // Add the anchor link to the heading.
        headingNode.insertAdjacentElement('beforeend', anchorNode);

        // Add click event listener to anchor link to copy link to clipboard.
        anchorNode.addEventListener('click', (event) => {
            event.preventDefault();
            // Imitate default behavior that we just cancelled.
            const elUrl = event.target.getAttribute('href');
            history.pushState(null, null, elUrl);

            const baseUrl = window.location.href.split('#')[0];
            const anchorUrl = baseUrl + elUrl;
            navigator.clipboard
                .writeText(anchorUrl)
                .then(() => {
                    // Create a new toast element and add it to the DOM.
                    const template = document.createElement('template');
                    template.innerHTML = `<div class="anchored-toast">Section link copied to the clipboard</div>`;
                    const toast = template.content.firstChild;
                    document.body.appendChild(toast);

                    // Remove the toast element after 2 seconds.
                    setTimeout(() => {
                        toast.remove();
                    }, 2000);
                })
                .catch(() => {
                    console.error('Failed to copy an anchor link to the clipboard.');
                });
        });
    }
}

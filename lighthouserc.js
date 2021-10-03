module.exports = {
  ci: {
    collect: {
      url: [
        "http://localhost:8080/",

        // Test news lists and one article.
        "http://localhost:8080/news",
        "http://localhost:8080/devblog",
        "http://localhost:8080/article/first-blog-post",

        "http://localhost:8080/features",

        "http://localhost:8080/community",
        "http://localhost:8080/community/user-groups",
        "http://localhost:8080/events",
        "http://localhost:8080/events/past",

        "http://localhost:8080/download/linux",
        "http://localhost:8080/download/osx",
        "http://localhost:8080/download/windows",
        "http://localhost:8080/download/server",

        // Test showcase list and one item.
        "http://localhost:8080/showcase",
        "http://localhost:8080/showcase/kingdoms-of-the-dump",

        // Pages under the "More" navbar link.
        "http://localhost:8080/contact",
        "http://localhost:8080/donate",
        "http://localhost:8080/code-of-conduct",
        "http://localhost:8080/privacy-policy",
        "http://localhost:8080/license",
      ],
      // Print "Listening" immediately so that lighthouse-ci starts as soon as possible.
      startServerCommand:
        "env -C october php -S localhost:8000 & echo Listening",
    },
    assert: {
      assertions: {
        // Performance testing is flaky, so we don't require a minimum performance score.
        // The score thresholds are based on the lowest scores from all pages listed above.
        "categories:accessibility": ["error", { minScore: 0.82 }],
        "categories:best-practices": ["error", { minScore: 0.86 }],
        "categories:seo": ["error", { minScore: 0.74 }],
      },
    },
    upload: {
      target: "temporary-public-storage",
    },
  },
};

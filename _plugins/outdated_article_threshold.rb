AVERAGE_SECONDS_PER_MONTH = 2628000

# Add a custom `site.outdated_article_threshold` variable.
# We use `site.time` that holds the build time as a base, but since you can't do math in
# the template language we can't use it there directly.
Jekyll::Hooks.register(:site, :after_init) do |site|
  # Articles that have a date older than this at build time are considered outdated.
  # see `_includes/outdated_article_notice.html`
  site.config["outdated_article_threshold"] = site.time - AVERAGE_SECONDS_PER_MONTH * 18
end

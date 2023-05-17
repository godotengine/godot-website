# Add a custom `site.outdated_article_threshold` variable.
# Articles that have a date older than this at build time
# are considered outdated.
#
# See also `_includes/outdated_article_notice.html`.

AVERAGE_SECONDS_PER_MONTH = 2628000
OUTDATED_THRESHOLD_IN_MONTHS = 18

Jekyll::Hooks.register :site, :after_init do |site|
  # We use `site.time` that holds the build time as a base.
  # As we can't do math directly in the article template, we
  # prepare a value that we can compare to instead.

  threshold = site.time - AVERAGE_SECONDS_PER_MONTH * OUTDATED_THRESHOLD_IN_MONTHS
  site.config["outdated_article_threshold"] = threshold
end

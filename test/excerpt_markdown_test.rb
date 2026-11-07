# frozen_string_literal: true

# Regression test for issue #1381: Markdown not parsed in news preview.
#
# Reads the real Liquid expressions that render `post.excerpt` /
# `release_article.excerpt` in `_layouts/blog.html`, `pages/home.html` and
# `_includes/download/version-card.html`, evaluates them against excerpt
# strings pulled from real article front matter that ships with the repo,
# and asserts that the Markdown is rendered as HTML (`<em>`, `<strong>`)
# instead of leaking the raw underscore / asterisk syntax into the rendered
# preview cards.
#
# Usage:  bundle exec ruby test/excerpt_markdown_test.rb
#
# This test fails against the pre-fix templates (raw `{{ post.excerpt }}`
# leaves `_Director's Cut_` showing literally on the home page and blog list)
# and passes against the patched templates which pipe excerpts through
# `markdownify`.

require "jekyll"
require "liquid"
require "tmpdir"

site_root = File.expand_path("..", __dir__)
site = Jekyll::Site.new(
  Jekyll.configuration(
    "source"      => site_root,
    "destination" => File.join(Dir.tmpdir, "_site_excerpt_test"),
  )
)
registers = { site: site }

# Fixtures: real excerpt strings from front matter in this repo. Pre-fix these
# render with raw `_` / `**` visible to the reader; post-fix they render with
# inline `<em>` / `<strong>`.
fixtures = {
  "italic (godot-4-7-lights-camera-action.md)" => {
    excerpt: "Like a cult classic movie, Godot 4 has only gotten better with age. " \
             "This brings us to Godot 4.7. With 3 years under its belt, the 4.7 " \
             "_Director's Cut_ offers colors of never-before-reached intensity.",
    expect_inline_html: "<em>Director",
    raw_markdown:        "_Director",
  },
  "bold (warning-head-going-unstable.md)" => {
    excerpt: "Starting now, and only for the upcoming 3.0 release, HEAD will break " \
             "compatibility completely. Projects from Godot 1.x and 2.x **will not " \
             "work** and this is expected.",
    expect_inline_html: "<strong>will not work</strong>",
    raw_markdown:        "**will",
  },
}

# Extract the actual Liquid expression that wraps `post.excerpt` /
# `release_article.excerpt` from a template file so we exercise the real code,
# not a hand-copied filter chain.
def extract_expression(path, variable)
  contents = File.read(path, encoding: "UTF-8")
  match = contents.match(/\{\{\s*#{Regexp.escape(variable)}\b[^}]*\}\}/)
  raise "could not find #{variable} in #{path}" unless match
  match[0]
end

call_sites = [
  {
    label:    "_layouts/blog.html (blog list card)",
    path:     File.join(site_root, "_layouts/blog.html"),
    variable: "post.excerpt",
  },
  {
    label:    "pages/home.html (featured news card)",
    path:     File.join(site_root, "pages/home.html"),
    variable: "post.excerpt",
  },
  {
    label:    "_includes/download/version-card.html (release notes preview)",
    path:     File.join(site_root, "_includes/download/version-card.html"),
    variable: "release_article.excerpt",
  },
]

def render(template, variable, value, registers)
  varname = variable.split(".", 2).first
  bag     = {}
  if variable.include?(".")
    bag[varname] = { variable.split(".", 2).last => value }
  else
    bag[varname] = value
  end
  Liquid::Template.parse(template).render!(bag, registers: registers)
end

failures = []

call_sites.each do |site_info|
  expression = extract_expression(site_info[:path], site_info[:variable])

  fixtures.each do |label, fx|
    rendered = render(expression, site_info[:variable], fx[:excerpt], registers)

    if rendered.include?(fx[:raw_markdown])
      failures << "[#{site_info[:label]}] raw markdown leaked for #{label}: #{rendered.inspect}"
      next
    end

    unless rendered.include?(fx[:expect_inline_html])
      failures << "[#{site_info[:label]}] expected #{fx[:expect_inline_html].inspect} for #{label}, got: #{rendered.inspect}"
    end
  end
end

# The truncated variant on the home page (`pages/home.html` line ~93) intentionally
# strips formatting so it stays safe to cut mid-string with `truncate`. Verify it
# at least no longer leaks raw markdown syntax to readers.
truncated_expression = File.read(File.join(site_root, "pages/home.html"), encoding: "UTF-8")
  .scan(/\{\{\s*post\.excerpt[^}]*truncate[^}]*\}\}/)
  .first

if truncated_expression.nil?
  failures << "[pages/home.html (small news list)] could not locate truncated excerpt expression"
else
  fixtures.each do |label, fx|
    rendered = render(truncated_expression, "post.excerpt", fx[:excerpt], registers)
    if rendered.include?(fx[:raw_markdown])
      failures << "[pages/home.html (small news list)] raw markdown leaked for #{label}: #{rendered.inspect}"
    end
    if rendered.include?("<em>") || rendered.include?("<strong>")
      failures << "[pages/home.html (small news list)] HTML tag leaked into truncated excerpt for #{label}: #{rendered.inspect}"
    end
  end
end

if failures.any?
  warn "excerpt markdown regression test FAILED:"
  failures.each { |f| warn "  - #{f}" }
  exit 1
end

total_assertions = call_sites.size * fixtures.size + fixtures.size
puts "excerpt markdown regression test passed (#{total_assertions} assertions across " \
     "#{call_sites.size + 1} excerpt call sites)"

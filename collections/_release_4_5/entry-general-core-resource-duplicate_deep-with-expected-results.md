---
type: entry
section: general
subsection: core
rank: 2
importance: 3
anchor: resource-duplicate_deep-with-expected-results
title: "`Resource.duplicate_deep()` with expected results"
blockquote: As deep as you want
text: |
  For a long time, even though `Resource.duplicate()` has a `deep` parameter, people realized that setting it to `true` doesn’t always perform in a reliable and predictable way. [Notably](https://github.com/godotengine/godot/issues/74918), it does not duplicate subresources stored inside `Array` or `Dictionary` properties.

  The new `Resource.duplicate_deep()` method give users full control [over what gets duplicated or not](https://docs.godotengine.org/en/4.5/classes/class_resource.html#enum-resource-deepduplicatemode).
contributors:
  - name: Pedro J. Estébanez
    github: RandomShaper
read_more: https://github.com/godotengine/godot/pull/100673
---

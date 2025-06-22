---
type: entry
section: general
subsection: core
rank: 2
importance: 3
anchor: duplicate-at-ease-with-expected-results
title: Duplicate at ease with expected results
blockquote: As deep as you wish
text: |
  For a long time, even though [`Resource.duplicate()`](https://docs.godotengine.org/en/4.5/classes/class_resource.html#class-resource-method-duplicate) has a `deep` parameter, people realized that setting it to `true` doesn’t always perform in a reliable and predictable way. [Notably](https://github.com/godotengine/godot/issues/74918), it does not duplicate subresources stored inside `Array` or `Dictionary` properties. The same thing happens with [`Array.duplicate()`](https://docs.godotengine.org/en/4.5/classes/class_array.html#class-array-method-duplicate) and [`Dictionary.duplicate()`](https://docs.godotengine.org/en/4.5/classes/class_dictionary.html#class-dictionary-method-duplicate).

  The new `duplicate_deep()` methods for these classes now give users full control over what gets duplicated or not.

  This new feature is the result of an overhaul of the duplication logic for arrays, dictionaries, and resources. For developers, we made sure to keep what was working and consistent intact. If you need more details, feel free to consult our new exhaustive documentation about the duplication specification.[^duplicate-at-ease-with-expected-results]

  [^duplicate-at-ease-with-expected-results]: See [`Array`](https://docs.godotengine.org/en/latest/classes/class_array.html#class-array-method-duplicate), [`Dictionary`](https://docs.godotengine.org/en/latest/classes/class_dictionary.html#class-dictionary-method-duplicate), and [`Resource`](https://docs.godotengine.org/en/latest/classes/class_resource.html#class-resource-method-duplicate) API documentation.
contributors:
- name: Pedro J. Estébanez
  github: RandomShaper
read_more: https://github.com/godotengine/godot/pull/100673
---

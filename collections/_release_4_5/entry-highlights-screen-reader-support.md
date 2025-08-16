---
type: entry
section: highlights
rank: 1
importance: 2
anchor: screen-reader-support
title: Screen reader support
blockquote: Show, ~~don't~~ tell
text: |
  Accessibility should be every developer’s top priority, full-stop. Excluding someone from an experience for factors outside of their control is an area that video games and applications have the potential to circumvent entirely.

  One feature often overlooked that is a must-have in computer software is screen reader support. Such readers are an essential tool for people who are visually impaired, illiterate, or have a learning disability.[^screen-reader-support-mdn] It enables them to understand the context given visually. It does, however, take a solid framework to develop such accommodations. That’s because each platform has its own way to handle accessibility. This obviously makes it difficult to support every platform.

  After 32,000 lines of code, hundred of comments, and countless hours of feedback and testing, we are proud to introduce the integration of [AccessKit](https://accesskit.dev/) in the engine. It is a framework that launched 2 years ago in order to offer a way to bridge most of the platforms (macOS, Windows, and Unix/Linux using [D-Bus](https://en.wikipedia.org/wiki/D-Bus)) over a common API.

  Thanks to AccessKit, we added screen reader support to `Control` nodes. We also added screen reader bindings in order to customize the behavior of any type of `Node`.

  As this feature is quite new, screen reader support for the Godot Editor itself is not complete yet. Support is only implemented for the Project Manager, standard UI nodes, and the inspector. We commit to extend support in future versions.

  Don’t hesitate to leave us any feedback you might have!

  [^screen-reader-support-mdn]: [MDN article on screen readers](https://developer.mozilla.org/en-US/docs/Glossary/Screen_reader).
contributors:
  - name: bruvzg
    github: bruvzg
read_more: https://github.com/godotengine/godot/pull/76829
---

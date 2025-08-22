---
type: entry
section: scripting
subsection: gdextension
rank: 0
importance: 3
anchor: main-loop-callbacks
title: Main loop callbacks
text: |
  GDExtension plugins sometimes need to run code at engine specific cues. For example, there were a lot of issues accessing the engine singletons from GDExtension, since there was no simple way to know when the engine had started up or shut down.

  From now on, developers are able to register main loop callbacks directly from GDExtension, such as `startup` and `shutdown`.

  This new feature is the result of our ongoing efforts towards bringing C#/.NET to GDExtension, as the port needed to register a `frame` callback.
contributors:
- name: Raul Santos
  github: raulsntos
read_more: https://github.com/godotengine/godot/pull/106030
---

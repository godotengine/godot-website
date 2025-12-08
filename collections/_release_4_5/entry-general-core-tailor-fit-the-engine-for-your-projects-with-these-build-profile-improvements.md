---
type: entry
section: general
subsection: core
rank: 3
importance: 4
anchor: 
  tailor-fit-the-engine-for-your-projects-with-these-build-profile-improvements
title: Tailor fit the engine for your projects with these build profile 
  improvements
text: |
  Since Godot 4.0[^tailor-fit-the-engine-for-your-projects-with-these-build-profile-improvements-since-godot-4-0], users can open _Project &gt; Customize Engine Build Configuration_ to access the "Edit Build Configuration Profile" window. This utility helps with selecting and even detecting which classes (i.e. which ``@[Node](enginetype)``s, ``@[Resource](enginetype)``s, and servers) are actually needed for the currently opened project. The idea is that by reducing the features to only the ones actually needed, users can build their own Godot template that is custom fit for their game.

  4.5 expands on what is detected. Not only does it detect classes, but can also now set correct build options. It also takes into account which classes are used by the project’s GDExtensions.

  [^tailor-fit-the-engine-for-your-projects-with-these-build-profile-improvements-since-godot-4-0]: You can read more about it in [our docs](https://docs.godotengine.org/en/4.5/tutorials/editor/using_engine_compilation_configuration_editor.html).
contributors:
- name: Michael Alexsander
  github: YeldhamDev
- name: David Snopek
  github: dsnopek
read_more: 
  https://github.com/godotengine/godot/pulls?q=is%253Apr+is%253Amerged+103719+104129
---

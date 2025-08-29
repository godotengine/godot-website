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
  Build profiles are a largely unknown feature, but they are incredibly useful. Especially with the latest improvements brought with 4.5.

  Since Godot 4.0[^tailor-fit-the-engine-for-your-projects-with-these-build-profile-improvements-since-godot-4-0], users can open _Project &gt; Customize Engine Build Configuration_ to access the "Edit Build Configuration Profile" window. This utility helps selecting and even detecting which classes (i.e. which `Node`s, `Resource`s, and servers) are exactly needed for the currently opened project. The idea is that by reducing the features to only the ones actually needed, it permits users to build their own custom Godot templates that is custom fit for their game.

  4.5 is now expanding on what’s detected. Not only it detects classes, but also now can set correct build options. It also now takes into account which classes are used by the project’s GDExtensions, preventing searching needles in an haystack.

  [^tailor-fit-the-engine-for-your-projects-with-these-build-profile-improvements-since-godot-4-0]: If you didn’t know about this feature, it is partially due to the fact that it was an undocumented feature [until now](); mea culpa.
contributors:
- name: Michael Alexsander
  github: YeldhamDev
- name: David Snopek
  github: dsnopek
read_more: 
  https://github.com/godotengine/godot/pulls?q=is%253Apr+is%253Amerged+103719+104129
---

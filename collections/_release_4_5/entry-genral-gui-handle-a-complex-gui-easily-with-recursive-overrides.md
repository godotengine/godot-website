---
type: entry
section: general
subsection: GUI
rank: 2
importance: 3
anchor: handle-a-complex-gui-easily-with-recursive-overrides
title: Handle a complex GUI easily with recursive overrides
blockquote: Gooey GUI no more
text: |
  It is now possible to change mouse and focus behavior of a ``@[Control](enginetype)`` node recursively. This greatly helps creating complex GUIs without breaking a sweat.

  Here’s an example: let’s say you create an inventory screen for your game. On the left, there’s a grid displaying what’s the hero is carrying. On the right, it shows a detailed view about the selected item on the left; a rotatable display of the item in 3D to examine every detail, a section containing a scrollable description, a box containing stats and modifiers (with hyperlinks for technical terms), and a list of buttons representing actions that are possible to do with it.

  Now, the problem is that the right view depends on an item being selected on the left. The user shouldn’t be able to interact with the detail view until that happens.

  By changing [``@[Control](enginetype)@[.](symbol)@[focus_behavior_recursive](membervariable)``](https://docs.godotengine.org/en/latest/classes/class_control.html#class-control-property-focus-behavior-recursive) and [``@[Control](enginetype)@[.](symbol)@[mouse_behavior_recursive](membervariable)``](https://docs.godotengine.org/en/latest/classes/class_control.html#class-control-property-mouse-behavior-recursive) of the detailed view container to their disabled value until an item is selected, focus and mouse events will be disabled for every child. You no longer have to resort to complex messages to manage the behavior of ``@[Control](enginetype)`` groups.
contributors:
- name: DE YU
  github: Delsin-Yu
read_more: https://github.com/godotengine/godot/pull/97495
---

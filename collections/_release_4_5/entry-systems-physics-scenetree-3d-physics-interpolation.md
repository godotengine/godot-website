---
type: entry
section: systems
subsection: physics
rank: 0
importance: 2
anchor: scenetree-3d-physics-interpolation
title: "``@[SceneTree](enginetype)`` 3D physics interpolation"
blockquote: Frames grow on trees now
text: |
  We transplanted (or should we say "grafted"?) 3D physics interpolation to ``@[SceneTree](enginetype)``. [Introduced in Godot 4.4](/releases/4.4/#_3D-physics-interpolation), 3D physics interpolation is the concept of making physics-based movement appear fluid even if it’s running slower than the process frame-rate.

  We previously implemented that feature in the ``@[RenderingServer](enginetype)``, as the feature is mostly tied to drawing in-between states and it didn’t require changing code handling ``@[Node](enginetype)``s. Unfortunately, this caused some issues. Namely, in practice, Godot’s built-in nodes—and custom nodes—often rely on ``@[Node3D](enginetype)`` transforms for their behavior. Due to technical and performance-related reasons, it proved impossible to query the ``@[RenderingServer](enginetype)`` for interpolated transforms. We had to move everything to ``@[SceneTree](enginetype)`` for 3D, where nodes reside.

  Not only has this fixed a number of issues, but it also makes everything conceptually easier for users and maintainers.

  Don’t worry: what’s awesome is the fact that we kept the existing user API even if a lot changed under the hood. So this change shouldn’t break your project!
contributors:
- name: lawnjelly
  github: lawnjelly
read_more: https://github.com/godotengine/godot/pull/104269
---

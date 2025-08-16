---
type: entry
section: systems
subsection: physics
rank: 0
importance: 2
anchor: scenetree-3d-physics-interpolation
title: "`SceneTree` 3D physics interpolation"
blockquote: Frames grow on trees now
text: |
  We transplanted 3D physics interpolation (or should we say "grafted"?) to `SceneTree`. [As you remember](/releases/4.4/#_3D-physics-interpolation), physics interpolation is the concept of making physics-based movement appear fluid even if it's running slower than the process frame-rate.

  We previously implemented that feature in the `RenderingServer`, considering the feature is mostly tied to drawing in-between states and that it didn't require to change code handling `Node`s. Unfortunately, it caused some issues. Namely, in practice, Godot built-in nodes—and custom nodes too—often rely on `Node3D` transforms for their behavior. Due to technical and performance-related reasons, it proved impossible to query the `RenderingServer` for interpolated transforms. We had to move everything to `SceneTree` for 3D, where nodes reside.

  Not only it fixed number of issues, but it also makes everything conceptually easier for users and maintainers.

  Don't worry: what's awesome is the fact that we kept the existing user API even if a lot changed under the hood. It means you get all of this without it even breaking a bit of your project!
contributors:
  - name: lawnjelly
    github: lawnjelly
read_more: https://github.com/godotengine/godot/pull/104269
---

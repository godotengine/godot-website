---
type: entry
section: highlights
rank: 5
importance: 2
anchor: _3D-physics-interpolation
title: 3D physics interpolation
blockquote: Do you get the jitters?
text: |
  With Godot 4.3, we introduced physics interpolation for your 2D projects. In this release, the long-awaited 3D counterpart has been merged as well! Make sure to enable it in your project settings.

  By decoupling physics ticks and display frame rates, physics interpolation creates additional frames between the last physics position and the current one. This reduces jitter and creates a smoother appearance, especially on displays with a high refresh rate.

  Mobile games in particular benefit from this change, since you can now lower the tick rate without compromising on smoothness.
contributors:
  - name: Ricardo Buring
    github: rburing
  - name: lawnjelly
    github: lawnjelly
read_more: https://github.com/godotengine/godot/issues?q=is%3Apr%20state%3Amerged%2092391%2091818
video_poster: /storage/releases/4.4/video/godot_physics_interpolation.webp
video_src: /storage/releases/4.4/video/godot_physics_interpolation_without.webm
video_label: Without <small>(10 ticks/s)</small>
video_comparison_poster: /storage/releases/4.4/video/godot_physics_interpolation.webp
video_comparison_src: /storage/releases/4.4/video/godot_physics_interpolation_with.webm
video_comparison_label: With <small>(10 ticks/s)</small>
media_position: bottom
content_creator: "[@heytibo](https://bsky.app/profile/heytibo.bsky.social)"
---

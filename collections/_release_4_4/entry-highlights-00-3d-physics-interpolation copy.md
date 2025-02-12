---
type: entry
section: highlights
rank: 0
importance: 1
anchor: "_3d-physics-interpolation"
title: "3D physics interpolation"
blockquote: "Do you get the jitters?"
text: |
  With Godot 4.3, we introduced physics interpolation for your 2D projects. In this release, the long-awaited 3D counterpart has been merged!

  By decoupling physics ticks and display frame rates, physics interpolation creates additional frames between the last physics position and the current one. This reduces jitter and creates a smoother appearance, especially on displays with a high refresh rate. Mobile games also benefit from this change, since you can now lower the tick rate without compromising on smoothness.
contributors:
  - name: Ricardo Buring
    github: rburing
  - name: lawnjelly
    github: lawnjelly
read_more: https://github.com/godotengine/godot/issues?q=is%3Apr%20state%3Amerged%2092391%2091818%20
---

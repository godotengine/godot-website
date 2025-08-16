---
type: entry
section: systems
subsection: rendering
rank: 3
importance: 3
anchor: mobile-renderer-now-using-half-precision-floating-point-format-explicitly
title: Mobile renderer now using half-precision floating-point format explicitly
blockquote: Even the smallest float can change the course of the Mobile renderer
text: |
  If a computer can only understand 0s and 1s, how can it calculate non-integer numbers? That’s where [floating-point arithmetic](https://en.wikipedia.org/wiki/Floating-point_arithmetic) comes in. It’s a method to represent these kind of numbers in binary.

  A mobile GPU not only needs to process pixels as fast as possible, but it needs to do it in an energy-efficient way. Quite recently, the industry realized that even the standard [single-precision floating-point (F32) format](https://en.wikipedia.org/wiki/Single-precision_floating-point_format) can sometimes be overkill in terms of size and processing power, even for rendering purposes.

  With this new update, the Mobile renderer now explicitly asks for [half-precision floating-point (F16) format](https://en.wikipedia.org/wiki/Half-precision_floating-point_format) if the hardware supports it — most devices commonly used should, especially if they are new. If so, games should now see rendering performance increase, run smoother overall (better frame pacing), and require less power usage.
contributors:
  - name: Darío
    github: DarioSamo
read_more: https://github.com/godotengine/godot/pull/102330
---

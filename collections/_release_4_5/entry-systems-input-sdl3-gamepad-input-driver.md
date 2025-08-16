---
type: entry
section: systems
subsection: input
rank: 0
importance: 2
anchor: sdl3-gamepad-input-driver
title: SDL3 gamepad input driver
blockquote: Gamepads galore!
text: |
  Gamepads are a given in modern PC gaming. Users expect their gamepad to just plug in and work. Not only that, but in order to deliver unique experiences, some gamepads are introducing new features; from adaptive triggers and advanced haptic feedback, to microphones and motion controls.

  Over time, issues accumulated in our gamepad driver implementation and missing features began to crop up. We were facing an ever-growing mountain.

  That’s why we turned our heads to the [SDL project](https://libsdl.org/). SDL is a well established and mature cross-platform library that handles audio, keyboard, mouse, joystick, and graphics. We determined that it’s now a net positive to defer the responsibility for gamepad handling to it.

  While this change doesn’t by itself bring new features, expect bugfixes and new features to come a little bit faster from now on.
contributors:
  - name: Nintorch
    github: Nintorch
  - name: Álex Román Núñez
    github: EIREXE
  - name: Xavier Sellier
    github: xsellier
read_more: https://github.com/godotengine/godot/pull/106218

---

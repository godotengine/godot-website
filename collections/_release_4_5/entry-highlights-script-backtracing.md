---
type: entry
section: highlights
rank: 2
importance: 2
anchor: script-backtracing
title: Script backtracing
blockquote: You stay in Wonderland, and I show you how deep the rabbit hole goes
text: |
  Those who launched a game using Godot can attest: it is often hard to debug why an error occurs on users’ devices. Is it a problem caused by the developers’ code, or a bug from the engine itself?

  That’s why we’re introducing custom loggers and script backtracing.

  Custom loggers allow developers to intercept log messages and errors. That makes it possible to create a tool for reporting bugs within your game.

  Script backtracing, on the other hand, gives developers the exact details on where an issue happened in the code.[^script-backtracing-enable] Even in "Release" builds.

  Developers will now be able to report issues to the [issue tracker](https://github.com/godotengine/godot/issues) more accurately, making Godot more stable for them and their users.

  [^script-backtracing-enable]: Just make sure that the _Debug > Settings > GDScript > Always Track Call Stacks_ project setting is enabled.
contributors:
- name: Mikael Hermansson
  github: mihe
- name: Juan Linietsky
  github: reduz
read_more: https://github.com/godotengine/godot/pull/91006
---

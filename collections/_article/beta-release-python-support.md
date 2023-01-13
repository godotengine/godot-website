---
title: "Beta release for Python support"
excerpt: "Emmanuel Leblond (touilleMan) just released the first beta of his Python for Godot interface, which will allow developers to use Python 3 and its complete ecosystem as a scripting language in Godot 3.0."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/596/62b/1c4/59662b1c4ffa8859295653.png
date: 2017-07-12 08:59:44
---

*This is a guest post by Emmanuel Leblond (touilleMan), a Godot contributor and Python lover who develops a GDNative interface to use Python 3 as alternative scripting language in Godot. To answer the obligatory question: yes, the plan is still to ship Godot 3.0 with GDScript, VisualScript and C# support. Python support should also be ready by then and usable plug 'n play thanks to GDNative; its main advantage compared to the Python-like GDScript will be the access to the whole Python ecosystem.*

------

Who said Godot's only about waiting? Today we are releasing the [first beta version of Python for Godot](https://github.com/touilleMan/godot-python), the GDNative interface that enables you to use the full-blown Python 3 as a scripting language for Godot games. Now we need you to try it and give your feedback, so that it can be made as good as possible for the upcoming 3.0 release!

- [Release 0.9.0 page](https://github.com/touilleMan/godot-python/releases/tag/v0.9.0)
- [Direct link to 0.9.0 linux binary release](https://github.com/touilleMan/godot-python/releases/download/v0.9.0/godot-python-0.9.0.tar.bz2)
- [Repository for Godot Python](https://github.com/touilleMan/godot-python)

All core features of Godot are expected to work fine:

- Builtins (e.g. `Vector2`)
- Object classes (e.g. `Node`)
- Signals
- Variable export
- RPC synchronization

On top of that, mixing GDScript and Python code inside a project should work fine, have a look at the [Pong example](https://github.com/touilleMan/godot-python/tree/master/examples/pong) to see how you can convert one by one your existing GDScript code to Python fairly easily.

This release ships a recent build of Godot 3.0-alpha (yes, it's a beta based on an alpha...) and CPython 3.6.1 with the standard library and pip, ready to work with the Python ecosystem in its full glory (can't wait to see people experimenting game AI with [Pytorch](http://pytorch.org/)!).

The project is Linux-only so far, however you should be able to compile it from the sources if you are on macOS (let us know if you do so).
Binaries for all platforms will eventually be provided when Godot 3.0 gets stable.

As always, keep in mind this is a beta and you are expected to encounter issues and maybe crashes. If so, make sure to report them on the [project's bug tracker](https://github.com/touilleMan/godot-python/issues) ;-)

**PS:** A talk about Godot & Python was given last Monday at [EuroPython 2017](https://ep2017.europython.eu/conference/talks/bringing-python-to-godot-game-engine). You can watch the (for now unedited) recording [on YouTube](https://www.youtube.com/watch?v=h6MsqsJqnao&feature=youtu.be&t=2h35m09s); the edited version should be available later on [EuroPython's YouTube channel](https://www.youtube.com/c/EuroPythonConference).

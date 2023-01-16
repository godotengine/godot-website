---
title: "Godot Web export progress report #3"
excerpt: "An alpha stage Godot Web Editor update, more news on GDNative for the Web, and many upcoming improvements to the Web export."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5f9/88c/905/5f988c90545a8956737903.png
date: 2020-10-27 21:30:00
---

Howdy Godotters! It's-a me! Fabio! It is time for an update on the Godot export for the Web.

In the last few months, a lot has been going on regarding the Godot export for the Web. Most of the enhancements mentioned in the [previous report](/article/godot-web-progress-report-2) have now been merged into the `master` branch, and backported to `3.2` (included in [3.2.4 beta 1](/article/dev-snapshot-godot-3-2-4-beta-1)).

This sadly does not yet include the virtual keyboard support, since implementing it without impacting the experience on touchscreen-enabled devices that also have a physical keyboard has proven harder than expected.

There is great news, though, on the other topic mentioned in that report, which is... GDNative support on HTML5 exports!

Additionally, a new prototype version of the Godot Web Editor is now available for you to try out.

# Godot Web Editor

After way too long, a new prototype version of the [**Godot Web Editor is online**](/online/godot.tools.html).

Change includes a lot of stability and usability improvements, the ability to download the project sources via a dedicated button under the **Project > Tools** menu and various performance optimizations.

![webtools.png](/storage/app/uploads/public/5f9/883/f4c/5f9883f4cbca6695990935.png)

All this work, as mentioned in the [initial report](/article/godot-editor-running-web-browser), also resulted in various improvements to games exported for the Web including a much more reliable user file system for saving persistent game data on the end user browser (`user://`) and more work on audio processing.

# Getting closer to GDNative support on the Web

GDNative is the C language interface to Godot Engine that allows integrating third-party libraries without recompiling the engine. It is also used to write bindings that allow game developers to write game logic in the programming language of their choice (e.g. [Python](https://github.com/touilleMan/godot-python), [Rust](https://github.com/godot-rust/godot-rust), etc.).

It could also be a good way, in the future, to further reduce the offical templates binary size by moving some of the features to offical modules, letting game developers choose which features of the engine they want, and only export those (without recompiling the engine like you can already do).

For this to work though, GDNative has to run on all platforms! The trouble here is that GDNative relies on [dynamic linking](https://en.wikipedia.org/wiki/Dynamic_linker), which (oversimplifying) means opening a program-like file and running functions contained in that file from another program (apologies to the tech people that will skip a heartbeat reading this description). Now this could seem to be an easy task for a human but not for a computer, since it has both compatibility and security ramifications. On the topic of compatibility specifically, linking is not mentioned in the WebAssembly standard, so build tools started creating [their own convention](https://github.com/WebAssembly/tool-conventions/blob/master/Linking.md).

The good news is that after a huge refactor of the Godot code to play nice with the build toolchain, we are very close to getting GDNative support in the Web exports. If you read all this, and you want to try it out, well, I'm sorry, but you'll have to wait a little bit more, since the code is not merged yet, but we are very close.

# Future work

We plan to soon have a faster release cycle for the web editor, possibly tied to Godot point releases, and to focus on usability and bugfixing, so it can enter a stable status soon.

GDNative support is really close to coming to the Web, and its inclusion will likely be the topic of the next blog post.

Virtual keyboard support, which has been so long delayed, should also come after GDNative support, along with a lot of bug fixes that have piled up while refactoring the JavaScript code handling browser-related functionalities.

Stay tuned for more :)

# Reference work

[Current prototype branch](https://github.com/godotengine/godot/tree/js/editor_prototype_2)

[Web Editor tools PR](https://github.com/godotengine/godot/pull/42789)

[File system and fixes PR](https://github.com/godotengine/godot/pull/42178)

[Audio improvements PR](https://github.com/godotengine/godot/pull/42505)

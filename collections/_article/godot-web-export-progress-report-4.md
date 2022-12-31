---
title: "Web Editor beta, AudioWorklet, GDNative and more!"
excerpt: "The Web Editor reaches beta (3.2.4 beta 4), GDNative lands on the web, thread-enabled HTML5 builds now come with an improved audio driver using the AudioWorklet API."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5fe/1bf/c80/5fe1bfc80c475551734903.png
date: 2020-12-24 17:00:00
---

Howdy Godotters! The year is almost over and it's about time we give you some news about the Web Editor and the HTML5 export.

It's been a very fruitful year for Godot on the Web since the announcement of the first [web editor prototype](https://godotengine.org/article/godot-editor-running-web-browser).
As expected in the rationale of the original post, this has produced a lot of improvements to the HTML5 export in general, including support for threads, file drag and drop, <abbr title="Link-Time Optimization">LTO</abbr> for smaller and faster builds, low-processor mode with optional lower framerate, and better control over audio output latency and mix rate. See the [second](https://godotengine.org/article/godot-web-progress-report-2) and [third](https://godotengine.org/article/godot-web-progress-report-3) reports for more details.

With this new report, as you may know if you checked out the last [Godot Live Q&A](https://www.youtube.com/watch?v=zGmCbnE0UqA), we're happy to announce that we have added optional **GDNative support** in HTML5 exports, that the optional **Thread support** now comes with an improved audio driver using the **AudioWorklet API**, and that the **Web Editor has reached the beta stage**.

Optional GDNative/Threads support
=================================

If you tried out Godot [3.2.4 beta 4](https://godotengine.org/article/dev-snapshot-godot-3-2-4-beta-4) you might have noticed that the HTML5 export now has a new option called `Export Type`, which allows you to select either the `Regular`, `Threads`, or `GDNative` build.
Sadly, as of now, it is not possible to have an export that supports both GDNative and Threads. This is a [documentated limitation](https://github.com/emscripten-core/emscripten/wiki/Linking#pthreads-support) of the toolchain used to create the web export, and the WebAssembly specification itself. We are still investigating a workaround for that, but it's going to take some more time.

![Selecting HTML5 export template type](/storage/app/uploads/public/5fe/0b6/6f9/5fe0b66f9ef85260274295.png)

Each export type has advantages and disadvantages, so you should choose depending on the scope and target of your game:

- **Regular**: It is the most compatible acrosss browsers but does not support multithreading nor GDNative.
- **Threads**: Supports multithreading via the [Thread](https://docs.godotengine.org/en/stable/classes/class_thread.html) and [Mutex](https://docs.godotengine.org/en/stable/classes/class_mutex.html) classes and comes with a low latency audio driver that runs off the main thread preventing it from stalling or crackling when framerate drops or when changing scenes. However, it is currently not supported by all browsers (notably, Safari and thus iOS does not support it yet). It also requires some [extra care when distributing](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/SharedArrayBuffer#Security_requirements).
- **GDNative**: Supports GDNative libraries, allowing to write your code in other languages (e.g. C++) so you can further optimize your game and speed up execution, or bind external libraries to add extra functionalities to the engine. On the downsides, it will result in a bigger build size, thus increasing the startup time and memory usage.

In general, my suggestion if you are not interested in mobile browser support is to use the *Threads* build to get the best performance with the smallest effort.
Hopefully, Safari's support for WebAssembly threads will ship next year thanks to the great work people are doing on the WebKit project, and even developers interested in HTML5 exports for mobile will be able to use the threaded version.

Web Editor beta
===============

A new version of the web editor has been published at [this temporary address](https://godotengine.org/editor/).

This is the first release tagged as "official" and based on the exact same sources of the other [3.2.4 beta 4](https://godotengine.org/article/dev-snapshot-godot-3-2-4-beta-4) builds. The goal is to keep the editor in sync with stable builds (starting from 3.2.4 stable). Old versions will still be available at dedicated locations.


![Web editor landing page](/storage/app/uploads/public/5fe/0b7/741/5fe0b77416fd2727783264.png)


The highlights of the new version are:

- A new improved look and feel of the HTML page that looks more integrated with the editor (special thanks to [Calinou](https://github.com/Calinou)).
- All importing issues should have been fixed. Most notably, audio samples can now be imported correctly, so the demo project now contains audio too.
- An old bug in the thirdparty Tween functions has been fixed that caused weird behaviors on HTML5 exports (and potentially other platforms too).
- Few bugs have been fixed in the JavaScript code that interfaces HTML5 exports with the browser (that glue-code has been mostly rewritten).


Honorable mentions
==================

I would like to give a shout-out to the amazing work done by [dsnopek](https://github.com/dsnopek) and [lawnjelly](https://github.com/lawnjelly) on [WebXR](https://github.com/godotengine/godot/pull/42397) and [GLES/WebGL in Godot 4.0](https://twitter.com/lawnjelly/status/1336767514227957761) respectively. You well deserve the Web export medal of honor.

Future work
===========

We feel like the web editor is almost ready to become stable, and plan to release it as such when 3.2.4 is released, but there are still few things that needs to be improved for web exports before I can refocus my work on some other ideas I've been sketching for networking and server exports:

The HTML5-related **documentation** needs some love to be more in sync with the current status.

**Gamepad** support on HTML5 is in an abysmal state, this is for many reasons. First of all the W3C specification is incomplete and does not allow to easily identify devices in a unique way. Additionally, the sheer amount of work required to support all possible devices is too much for browser vendors.
In an effort to improve the current situation, we plan to create a small addon that allows to remap the gamepad on the fly that you can bundle in your game, or send your generated mappings to us (so we can bundle them in future Godot versions). While this won't solve all the problems until the specification is improved and browser support gets better, it should allow for many more controller to work out of the box across different platforms.

I've recently proposed a better way than `eval` to **communicate with JavaScript**, and that will need a tentative implementation.

Stay tuned for the next announcement!

References
==========

[GDNative support](https://github.com/godotengine/godot/pull/44076) [(3.2)](https://github.com/godotengine/godot/pull/44170)

[Threads/AudioWorklet](https://github.com/godotengine/godot/pull/43443) [(3.2)](https://github.com/godotengine/godot/pull/43454)

[Importing issues](https://github.com/godotengine/godot/pull/44161)

[Tween bug](https://github.com/godotengine/godot/pull/44197)

[Editor style](https://github.com/godotengine/godot/pull/44221) [(3.2)](https://github.com/godotengine/godot/pull/44256)
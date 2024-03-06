---
title: "Godot Engine awarded $50,000 by Mozilla Open Source Support program"
excerpt: "We are delighted to announce that Godot Engine has been awarded USD 50,000 by Mozilla as part of the Mozilla Open Source Support (MOSS) Mission Partners program.
This award will be used to fund the work of some of our core contributors on three different work packages, all linked with Mozilla's mission of furthering an open and accessible Web. For Godot, this means making sure that everyone can build and play networked and browser-based games with open source technology."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5ca/f3f/2b5/5caf3f2b5f75b989378173.png
date: 2019-04-11 13:05:11
---

We are delighted to announce that Godot Engine has been awarded **USD 50,000** by [Mozilla](https://www.mozilla.org) as part of the Mozilla Open Source Support (MOSS) [*Mission Partners*](https://www.mozilla.org/en-US/moss/mission-partners/) program. This is the second time that Godot receives a MOSS award, after a [first award of USD 20,000]({{% ref "article/mozilla-awards-godot-engine-part-moss-mission-partners-program" %}}) in 2016.

This award will be used to fund the work of some of our core contributors on three different work packages, all linked with Mozilla's mission of furthering an open and accessible Web. For Godot, this means making sure that everyone can build and play networked and browser-based games with open source technology.

The work packages (WP) that we defined together with Mozilla are described hereafter. All the contributors working on those work packages are hired as contractors by our fiscal sponsor [Software Freedom Conservancy](https://sfconservancy.org), part-time and for a duration of 9 months. They will post progress reports on this blog.

## WP1: Godot Engine's editor on the Web

Godot's editor is built with Godot itself, using the same runtime and UI toolkit as games developed with Godot. This means that it can run on any platform where Godot can run, including browsers via WebAssembly. While it's relatively easy to make the editor build and run for browsers, many of its features can't work out of the box and need specific development for HTML5, such as handling multi-threading or the lack thereof, running/debugging edited projects, filesystem management, cloud storage, etc.

Our contributor Leon Krause ([eska](https://github.com/eska014)), who is the maintainer of our HTML5/WebAssembly platform port, will work on providing a first-class integration of the Godot editor in browsers.

This might open many possibilities in the future such as sharing direct links to projects/scenes in bug reports of the [Godot Q&A](https://godotengine.org/qa/), being able to run and edit demo projects directly from the browser, collaborative edition features... Notably, this could also be an advantage for Godot's adoption in teaching environments, where getting software installed and configured on all computers of an institution can be a hassle (even for an engine with such a small footprint like Godot).

The WP also includes work to make the editor work on mobile browsers, such as touch screen gestures, responsive UI, etc. This should also make it possible for us to port the editor to Android and iOS natively to tweak your projects on the go.

Additionally, while working to make the editor run smoothly on all major browsers, Leon will have to fix issues which are also relevant for exported games, so all users of the HTML5 port should benefit from this work.

Leon will start the work on WP1 in coming days.

**Update:** Due to unforeseen circumstances, Leon was not able to working on this work package. Instead, it's also Fabio (from WP2) who will work on the HTML5 improvements in 2020, once his networking work package is completed.

## WP2: WebRTC and networking improvements

Fabio Alessandrelli ([Fales](https://github.com/Faless)) is the maintainer of both low-level and high-level networking APIs in Godot. In 2018, he mentored the student Brandon Makin as part of the Google Summer of Code, who did initial work on integrating the WebRTC technology in Godot. The project faced various hurdles with the WebRTC library and could not be completed during GSoC, so Fabio will complete this work. He will also write documentation and create demos and plugins showcasing the use of WebRTC and WebSocket.

WP2 will also cover better tools and debugging features for networked projects, including some changes which will be relevant for Leon's work in WP1, such as implementing an HTTPServer to serve HTML5 exported files, and use WebSocket instead of TCP to communicate between the editor and debugger in HTML5 exports.

Finally, Fabio will work on further networking improvements, including a refactor of the low level TCP/UDP abstractions, implementing DTLS over UDP using mbedTLS, and improving the error handling in the Multiplayer API.

Fabio already started working on WP2 in March, and will soon post his first progress report.

## WP3: Artwork commission for high quality demos

Fernando Calabró, the artist who worked on the [TPS demo](https://github.com/godotengine/tps-demo), is going to make professional 3D assets for two more demos. These demos will be used to showcase and benchmark various features of the engine. Particular attention will be given to optimize them for Godot's HTML5 platform (in part thanks to work done in WP1). This will enable them to be used as benchmarking material for upstream WebAssembly developers, thus contributing back to improving this stack.

Fernando started working on WP3 in March, and will soon share his current progress and more details about the planned demos.

-----

A big **thank you** to Mozilla for supporting our project again with such a substantial award!

As a non-profit entity, we rely on the generosity of the many users who support us on [Patreon](https://patreon.com/godotengine), as well as companies who sponsor us or grant us funding for specific work packages. Being able to add two part-time developers and one artist on the project's "payroll" will be a huge boost in productivity and development for the engine, and should greatly benefit the community as a whole.

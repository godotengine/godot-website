---
title: "Progress report April/May 2017"
excerpt: "The Godot Engine contributors were not idle during Juan's long holidays - lots of interesting features were implemented over the last two months, and they all converge towards making Godot 3.0 an impressive release! This progress reports covers the work done by all contributors apart from Juan, who will showcase his recent renderer improvements in the next progress report."
categories: ["progress-report"]
author: Rémi Verschelde
image: /storage/app/uploads/public/594/103/ff1/594103ff1f172007468975.jpg
date: 2017-06-14 09:39:49
---

It's been a while since the last progress report, and there have been lots of changes in the development branch that you might not have heard of yet. Usually we let our lead developer Juan (reduz) do progress reports on his impressive work on rendering features, but since he was in holidays for more than a month, we'll showcase the work of some key contributors this time.

This report covers important changes made by all contributors [from April to today](https://github.com/godotengine/godot/graphs/contributors?from=2017-04-01&to=2017-06-14&type=c), excluding Juan's recent work which will be covered in his next progress report (but check his Twitter account for some more 3.0 teasers). There were over 300 commits by more than 30 different contributors, so this was a busy time even while our lead dev was away.

Before going over some hand-picked changes, we'd like to welcome new contributors who got involved in the engine development during the last few months: magyar123, mcanders, Noshyaar, RameshRavone, toger5 and touilleMan. Thanks for your contributions, and we hope to see you stick around and become core developers!


## GDNative

Since [the last blog post](/article/dlscript-here), a lot of development happened on GDNative (one of the most visible change being its renaming from DLScript to GDNative to avoid confusion about its nature).

The GDNative core API is getting more and more complete, thanks to Emmanuel (touilleMan) and Ben (sheepandshepherd).
Many different things like printing to the editor console and other small things were added to the API.

But most of the work happened on the bindings for GDNative. The [C++ bindings](https://github.com/GodotNativeTools/cpp_bindings) were rewritten completely to be easier
to generate and also better reflect the way Godot handles scripts.

![gdnative-example](https://pbs.twimg.com/media/C_uBqzSXYAErP5o.jpg)

Also worthy to mention are the [D bindings](https://github.com/GodotNativeTools/d_bindings) by Ben which are under active development and the [Rust bindings](https://github.com/GodotNativeTools/rust_bindings) by vurpo which are currently halted, but soon to be extended further.

karroffel will be working on a few examples (will be uploaded to the [GDNative-demos repository](https://github.com/GodotNativeTools/GDNative-demos) and creating documentation for the users of GDNative but also for bindings authors to make it easier to bring new languages to Godot!


## New customizable editor theme

Daniel (djrm) started an impressive work on a new theme for Godot 3.0, which was merged in an early state a couple months ago. It spawned a lot of interest from the broader community and some very lengthy discussions on GitHub; based on this early feedback, 박한얼 (volzhs) reworked the initial proposal by simplifying some of the changes, and restoring the old theme for game prototyping. He took the opportunity to make the colors and the contrast of the interface customizable, which allows everyone to tune them to their preference. Nuno (nunod) added support for color presets so that we can propose a few good-looking defaults out of the box.

![New editor theme as of early May](https://cloud.githubusercontent.com/assets/8281454/25639522/22b0a980-2fc7-11e7-9be2-1812c4708474.gif)

There is still some work to do to make the theme even better before the 3.0 stable release, but it's already looking pretty slick.

[![Default theme color and PBR example](https://pbs.twimg.com/media/DBtvEwdVwAAwu1e.jpg)](https://twitter.com/fracteed/status/872413140977278976)


## WebGL 2.0 and WebAssembly support

eska has given Godot's Javascript/HTML5 platform a lot of love over the last few months, ensuring that the new WebGL 2.0-compatible renderer can be used optimally. He added support for the WebAssembly platform, so that it is now possible to build Godot for the web using either asm.js or WebAssembly (both via the Emscripten toolchain).

He also reworked the input of the HTML5 platform to bring it up to par with the desktop and mobile platforms. There are still some improvements to be done but the performance is overall pretty good already, and we are pretty hyped about what Godot 3.0 will offer in terms of Web exports.

It's already a few months old, but here's an early port of the [platformer demo under WebAssembly](http://godot.eska.me/pub/wasm-platformer/) (requires a recent version of Firefox or Chrome). It can even run on your phone, though it currently lacks the detection that it would need touchscreen controls :)


## Mono/C# support

For the last 2 months, Ignacio (neikeq) has focused on completing and stabilizing the internals.

Several bug fixes and improvements were made to the scripting API implementation, but the most notable additions are in regards to assembly reloading and threading.

Assemblies reloading is crucial for several use cases like hot reloading or refreshing the inspector properties when a change is made to the code. Now this is finally working, and all that is left is the serialization of properties.

In regards to threading, now the native threads created by the Godot API can be attached to have access to the Mono API and call into C#.

The next task on the list is finishing serialization, and then the focus will switch to usability and IDE integration.

Screenshot of upcoming support for async/await next weeks:
![Mono async/await example](/storage/app/uploads/public/594/0fe/d6e/5940fed6ec836901996527.png)


## AR/VR features

For the past few months Bastiaan (Mux213) and Andreas (Hinsbart) have gone through a few prototypes to get their head around implementing AR and VR into Godot - first with a main focus on VR. The early prototypes were based on the OpenVR SDK and they ended up with a working system that rendered properly to a Vive HMD (head monitoring device) and enable tracking the Vive controllers. They've since been working on building a new server implementation into Godot that would allow them to make this more moduler and implement different AR and VR SDKs into Godot without needing too many changes in the game being built (if any). This server implementation also attempts to hide as much of the complexity of implementing stereoscopic rendering to the HMDs.

Whenever possible, the interface to the AR or VR SDKs will be integrated into the core AR/VR server to provide a native solution usable out of the box even on mobile devices. But for some of the larger SDKs such as OpenVR Andreas has been hard at work using GDNative to make it possible to deliver the implementations separate from the core product. 

Bastiaan and Andreas' main focus currently remains with the OpenVR SDK allowing them to use Godot with SteamVR - that interface will likely be available in the upcoming alpha build. Once that is up and running, they will start moving on to supporting some of the other SDKs such as the Oculus SDK, and some of the mobile SDKs.


## 3D freelook navigation mode

Marc (Zylann) has implemented a freelook mode for the 3D editor viewport, which can be triggered by hold the right mouse button. It allows to navigate through the scene with FPS-like controls (WASD) and will be pretty useful to get a better view of your 3D levels. Be sure to test it and give your feedback on the usability when we release the alpha build, so that it can be perfected before the stable release.

Here's a video showing an early version of the freelook mode (it was since improved further):

<iframe width="560" height="315" src="https://www.youtube.com/embed/lmFVNVHTBFk" frameborder="0" allowfullscreen></iframe>


## UWP support in the 2.1 branch

Back in 2016 George (vnen) implemented support for UWP, the Universal Windows Platform, which allows to deploy to the Windows Store, the Windows Phone and the Xbox One. Shortly after, Juan began implementing the new renderer and the UWP platform code was broken, so this platform did not get much attention up to now (it will of course be fixed for Godot 3.0).

As some users expressed interest in the platform, George backported the UWP code from the *master* branch to the *2.1* branch (for legacy reasons the platform is still called "WinRT" there) - it still needs some testing and polishing, but it should be possible to deploy games to UWP with the upcoming Godot 2.1.4, or at the latest with 2.1.5. More on this once we are actually confident that it works :)


## Script editor enhancements

Paul (Paulb23) is back with script editor enhancement! The so-called "colour guy" who did a lot of work on syntax highlighting in the script editor now brought us optional space-based indentation (Python users will love that!), an edit tool to convert casing, a quick access list to recent scripts and most importantly, a new panel that list member variables and methods of a given script and allows to quickly focus them.

![Members overview in script editor](https://cloud.githubusercontent.com/assets/6584330/26529566/fa67a5c6-43b9-11e7-8293-b6fc6a3d6123.jpg)


## Other noteworthy contributions

There were tons of other changes by many contributors, including a lot of bug fixes and enhancements to the new features of Godot 3.0. Some noteworthy changes include:

- iPhone MFI gamepad support and other macOS and iOS improvements (BastiaanOlij)
- Networking fixes (Faless)
- Various core and rendering changes (RandomShaper)
- Various core/math/compression changes (tagcup)
- Thirdparty splitting and exhaustive licensing documentation (akien)

All in all, the progress is great and we continue to get impressed by our growing community of both users and contributors!


## When will we get Godot 3.0?

Godot 3.0 is coming along pretty nicely, and though its development is taking longer than we initially planned back in Fall 2016, it's all for the better. The many compatibility changes that we had the opportunity to make over the last 9 months will make Godot 3.0 more consistent and easy to use.

Still, as we often repeat it to newcomers, please continue using Godot 2.1.x until the 3.0 branch is ready - we speak a lot of compatibility changes but the workflow stays very similar, and the vast majority of what you will learn using Godot 2.1.x will be reusable 1:1 in the future branch. It will be the same engine, just better.

***Okay, but when do we get the alpha build?***

*When it's ready™.* There has been a lot of progress on many blocking bugs lately, which we track in a [dedicated issue](https://github.com/godotengine/godot/issues/8805). We expect to be ready for an alpha release in ca. 2 weeks, so stay tuned :)

By then we will consider 3.0 feature complete, and we should stop breaking compatibility every other day. Count likely two months of testing and bugfixing and we should be ready to release the stable version, probably some time in August.
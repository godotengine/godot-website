---
title: "C# support on Android"
excerpt: "Godot 3.2 will bring Android support to C# users, which can already be tried in the master branch and will soon be available in Godot 3.2 alpha 1. Moreover, the editor code for the Mono module was converted from C++ to C#, making it easier to extend."
categories: ["progress-report"]
author: Ignacio Roldán Etcheverry
image: /storage/app/uploads/public/5d2/775/7d1/5d27757d198a8779988083.png
date: 2019-07-12 10:16:37
---

In this devlog I will be talk about what I have been working on for the last two months. There are some nice new goodies coming for C# users with Godot 3.2.

Before starting, I would like to announce that this work is possible thanks to a generous donation of $24,000 by Microsoft. This grant will be used to fund my work on C# in Godot for a year. This is the second time I receive a grant from Microsoft to work in Godot and I'm extremely grateful.

## C# on Android

![SkyOfSteel REPL](/storage/app/media/SkyOfSteel_REPL_Android.png)
_C# interactive shell from the game [SkyOfSteel](https://github.com/ForLoveOfCats/SkyOfSteel) by ForLoveOfCats running on an Android emulator. **Edit (2021-06-07)**: This game development has halted and the domain expired, so the link was changed to point to archived GitHub repository._

Up until now Godot supported scripting with C# only on desktop platforms. Our plan has been to add support for other platforms over time and Android has been by far the most requested one. Even when it comes to overall feedback, not only about platforms, Android tends to be at the top of the list.

Today I'm glad to announce we've finally made it happen. Godot 3.2 will ship with support for exporting C# games to the Android platform.

The process of exporting a game for Android with C# is the same as it would be if you were using GDScript. Godot will make sure to add all the assemblies and dependencies to the exported APK. No extra steps are required from you.

It supports all target ABIs Godot does (`armeabi-v7a`, `arm64-v8a`, `x86` and `x86_64`). Currently, we only use JITed code, with AOT support coming in the future.

If you can't wait for a 3.2 release and you feel brave enough, you may be interested in building Godot from source to try it out. In order to do that you will also need to build the Mono runtime from source. We're considering the possibility of providing prebuilt Mono packages, but that's still uncertain.

If you're interested in building Godot from source with C# support, we have [a page](https://docs.godotengine.org/en/latest/development/compiling/compiling_with_mono.html) documenting this process, as well as [a section](https://docs.godotengine.org/en/latest/development/compiling/compiling_with_mono.html#targeting-android) specific for Android.

I've created a repository with scripts to help in the process of building the Mono runtime for Android. You can find it [here](https://github.com/godotengine/godot-mono-builds). You may need to apply [some patches](https://github.com/godotengine/godot/blob/master/modules/mono/build_scripts/patches/fix-mono-android-tkill.diff) to the Mono repository in order to be able to build it for `armeabi-v7a` and `x86` on newer NDK releases.

## Rewriting the module's editor code in C#* *

![C# Editor Code Snippet](/storage/app/media/GodotTools_Code_Snippet.png)

Excluding the C# bindings, most of the C# module's code is written in C++. This includes the editor code in charge of building the project, opening scripts with external editors/IDEs, and exporting the C# game. This is an obstacle for the future as not only is C++ a lower level language, but the API available is also a more limited one (adding thirdparty libraries cannot be done lightly).

We've gotten away with this until now by moving some small parts of the code to C#. This allowed us to benefit from .NET where we needed it. However, this requires a lot of boilerplate code in order to invoke C# from C++, quickly turning into bloat.

All of this together makes adding new features to the editor a much slower and painful process than it should be. As such I decided that, before embarking on such tasks, I had to do something about this.

Last month I worked on moving most of the editor code to C# to make it easier to maintain and extend. The new code only has one method that gets invoked from C++, which is called during editor initialization. All the other C++ to C# calls are instead handled by the existing scripting implementation (signals, object calls, etc.).

The interesting part is that the new code is pretty much a Godot addon. It uses the same C# API Godot projects and addons use. There are only two differences with real addons:
1. Unlike other addons, this one is not part of your project and is not listed in _`Project Settings > Plugins`_. Instead, it's enabled by the module when the editor is loaded.
2. If you [peek into the code](https://github.com/godotengine/godot/tree/master/modules/mono/editor/GodotTools) you may notice that classes derived from `Godot.Object` are not marked with `ToolsAttribute`. This is intentional as everything there is meant to run in the editor. Using this attribute would be redundant so we decided to add a special case for it.

There were several bugs that needed to be fixed to get things working properly; especially related to hot-reloading. Since this is pretty much a glorified Godot addon with some extra privileges, those fixes also benefit other Godot addons and editor plugins written in C#.

There were also some great build system improvements. The most important: SCons will now take care of building the C# API to be bundled with the Godot editor, a step that had to be done manually before.

## What's to come next

The next step in the roadmap is integration with the MonoDevelop IDE. More details will come in the next devblog, in a bit less than a month. You can expect much awaited features like debugging as well as better experience for opening files with this IDE (currently we use the command line with bad results). Thanks to the editor re-write, this will be a much easier task.

If you're wondering about support for WebAssembly and iOS or integration with Visual Studio and VS Code, don't fear. Those are all on the roadmap. You can expect to hear more about them in the future.

Until next month!
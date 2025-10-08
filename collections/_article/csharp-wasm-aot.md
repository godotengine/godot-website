---
title: "C# progress report: WebAssembly, MonoDevelop and AOT"
excerpt: "Godot 3.2 brings WebAssembly support for C# games. There is also a new extension for Visual Studio for Mac and MonoDevelop and preliminary support for AOT compilation."
categories: ["progress-report"]
author: Ignacio Roldán Etcheverry
image: /storage/app/uploads/public/5dc/e01/229/5dce01229c795712716182.png
date: 2019-11-15 21:18:23
---

There's been some interesting progress going on with C# over the last few months since the first progress report as part of my work sponsored by Microsoft.
In this progress report I'll briefly introduce the most important improvements and additions that were made, which are support for exporting C# games to WebAssembly, an IDE extension for Visual Studio for Mac and MonoDevelop, and preliminary support for AOT compilation.

_Please note that both WebAssembly and AOT depend on [changes](https://github.com/godotengine/godot/pull/33603) that may still be unmerged as of this writing._

## WebAssembly support

The main announcement from the first blog report was support for exporting Godot C# games to Android. This time, it's the turn for WebAssembly.

![C# WASM Demo](/storage/app/media/mono_wasm_demo.opt.gif)
_The [Dodge The Creeps C#](https://github.com/godotengine/godot-demo-projects/tree/master/mono/DodgeTheCreepsCS) demo running on a web browser_

WebAssembly is a quite unusual platform so there are a few things to keep in mind. Most importantly, the JIT compiler is not available. There are two ways to run code: the Mono's IL interpreter and AOT compilation.
Right now, Godot uses the former. The interpreter is good for development as it allows for fast iteration, but it runs much slower compared to AOT compiled assemblies. Unfortunately, Godot doesn't support AOT on WebAssembly just yet, but it should be happening soon.

As for the export process, just like with Android, there shouldn't be any differences compared to what we're used to when exporting non-C# games. Godot takes care of everything and the resulting files are the same.

When it comes to compiling Godot from source, you will need to build both the Mono runtime and the Base Class Library for WebAssembly. I've created some [scripts](https://github.com/godotengine/godot-mono-builds) to help with this process. I will be updating the [Compiling with Mono](https://docs.godotengine.org/en/latest/development/compiling/compiling_with_mono.html) docs next week to reflect all this.

## Add-in for Visual Studio for Mac and MonoDevelop

In the last progress report I talked about the upcoming extensions for editors/IDEs. Today the first extension is available as an add-in for Visual Studio for Mac and the MonoDevelop IDE.

With using this add-in you can expect a better experience when opening/jumping to C# files from the Godot editor. Prior to this, Godot was using the MonoDevelop command line, which didn't work well when it comes to reusing running MonoDevelop instances. With this new add-in, Godot directly connects to the IDE to send such requests, eliminating those issues.

More importantly, this add-in aims to provide seamless debugging integration with the Godot editor. Launching from the MonoDevelop editor notifies the Godot editor to run the game and connect the debugger. From there everything should work as expected, from breakpoints, unhandled exceptions, etc.

There are three launch options:

![Add-in Run Options](/storage/app/media/monodevelop_addin.png)

- _"Play in Editor"_ launches the game from the Godot editor. This is probably the one you will be using the most during development.
- _"Launch"_ executes the Godot executable from a path that must be previously configured in the settings (or a path automatically obtained from a connected Godot editor).
- _"Attach"_ attaches to a running instance.

Please note that in order to be able to run the game with the _"Play in Editor"_ option, you will have to set the active _Configuration_ to _"Tools"_, which is what the Godot editor and player use.

The add-in source code is available at: https://github.com/godotengine/godot-monodevelop-addin

There is a "mpack" package available as well in the [releases](https://github.com/godotengine/godot-monodevelop-addin/releases) page and hopefully we can soon upload it to the official add-ins repository so it can be installed from the "Extension Manager".

I would like to thank David Karlaš from Microsoft for taking the time to write [this extension](https://github.com/DavidKarlas/GodotExtension) which I used as a base for this one. It was of great help and saved me a lot of time.

## Ahead Of Time compilation

Godot is starting to support Ahead Of Time (AOT) compilation for exported games. There's still a lot of work to do here, and some things may not be fully working. It's not possible to enable LLVM yet, although you could experiment with that using the setting `Mono -> Export -> Extra Aot Options`.

![AOT Settings](/storage/app/media/mono_aot_settings.png)

Something worth mentioning: currently, due to a limitation with the API exposed by the Godot editor, all of the C# export settings are located in `Project Settings` under `Mono -> Export`, including the AOT settings. In the future, they will be moved to the export presets panel, where they belong.

Godot expects AOT compilers to be placed in the editor directory under `GodotSharp/Tools/aot-compilers`. If you want to build them from source, these [scripts](https://github.com/godotengine/godot-mono-builds) can also be of some help with that.
Being so close to a release, it's unlikely 3.2 will ship with AOT support, but it will likely be included in the next point release so we don't have to wait for 4.0.

## What comes next

Right now, I'm going to put some time into fixing bugs to make sure 3.2 is a stable release. The very next thing after that is going to be iOS support; you can expect to hear an announcement on this in about a month. What comes later, among other things, is more IDE extensions, starting with Visual Studio and later Visual Studio Code.
Also more progress will be made on AOT compilation over time and it will be a priority to have it working on WebAssembly as soon as possible.

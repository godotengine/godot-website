---
title: "C# progress report: Visual Studio and VSCode"
excerpt: "Godot is getting extensions for Visual Studio and Visual Studio Code, including debugging support and code completion of Godot strings."
categories: ["progress-report"]
author: Ignacio Roldán Etcheverry
image: /storage/app/uploads/public/5ef/e2d/10d/5efe2d10d53f8199324952.png
date: 2020-07-03 15:10:04
---

In a past progress report I announced a Godot extension for
Visual Studio Mac and MonoDevelop. This was the first step
towards Godot support in C# IDEs.

Today I'm announcing two new extensions for other editors: Visual Studio
and Visual Studio Code.
In this progress report I'm going to do a brief introduction to the
features included in the current version of the extensions.

This work was kindly sponsored by Microsoft.

# Debugging

The two extensions support debugging of Godot games. They make it easy to launch
and debug games from the IDE without the need to tweak any Godot setting.

![VSCode Debugging](/storage/app/media/mono/vscode_debugging.png)

As of this writing, the two extensions provide 3 debug targets:
**Launch**, **Attach** and **Play in Editor**.

**Play in Editor** is likely going to be the one that's used the most during
development as it launches the game from a running Godot editor instance.
It's similar to pressing the play button in the Godot editor, except it's
done from the IDE and debugger options are configured automatically.

![VS Debug Targets](/storage/app/media/mono/vs_debug_targets.png)

You can find more details in the extension descriptions.

### Notes

The Visual Studio extension uses debugging components from the
"Mobile development with .NET" workload of Visual Studio. This
workload is installed automatically when installing the extension.
This is a big dependency, but I couldn't find a better alternative
that didn't involve write and maintain a huge amount of code ourselves.

![VS Debugging](/storage/app/media/mono/vs_debugging.png)

The debugger adapter used by the VSCode extension is a fork the
[vscode-mono-debug](https://github.com/microsoft/vscode-mono-debug) extension.

# Code completion

When coding in Godot, developers very commonly find themselves having to write the
path of nodes, scenes and resources, as well as the name of signals and input actions.
Most GDScript developers are used to getting code completion for such values from the
Godot built-in code editor (or from another editor that supports the GDScript LSP).
This wasn't the case when coding in C# so one had to go through the burden of
typing all those strings manually... up until now.

The new IDE extensions add code completion for these values to the C# editor. This
feature requires there to be a running Godot editor which can provide the completion items.

![VSCode Completion](/storage/app/media/mono/vscode_completion.png)

The Visual Studio version is implemented as a Roslyn completion provider.
In the case of node paths, the code completion is triggered wherever the expected
type can be inferred to be `NodePath`. This means it won't just trigger only when
invoking `GetNode`, but also when assigning a value to a `NodePath` field/property
and similar contexts.

The VSCode extension is more limited when it comes to code completion. Currently
it does not use Roslyn. Instead it uses regex patterns to determine whether code
completion should be triggered. This is subject to change in the future, but for
the most part the results are still good.

**NOTE:** The current version of the extensions require a running Godot editor
instance to provide the completion items. I'm considering to make future version
support a subset of the code completion in "offline" mode (when no Godot editor
is there to provide them).

### Visual Studio for Mac

As a bonus, the extension for VS Mac and MonoDevelop was also updated to support code
completion of Godot strings. It uses the same Roslyn completion providers as the Visual Studio extension.

# Download

### Visual Studio

The Visual Studio extension can be downloaded
[here](https://github.com/godotengine/godot-csharp-visualstudio/releases).

The **minimum required** Godot version is **3.2.3**, which is not yet released at the time of this writing.
While the extension may work to some extent with Godot 3.2.2, there might be issues.
Also Godot 3.2.2 can't launch Visual Studio when selecting a script.

The extension will be published to the marketplace once Godot 3.2.3 stable is released.

### Visual Studio Code

The VSCode extension can be downloaded from the marketplace
[page](https://marketplace.visualstudio.com/items?itemName=neikeq.godot-csharp-vscode).

It works with Godot versions **3.2.2** or newer. Older versions of Godot won't work.

### Visual Studio for Mac

The VS Mac can be installed from the Extension Manager gallery or
[manually](https://github.com/godotengine/godot-monodevelop-addin/releases).

It works with Godot versions **3.2.2** or newer. Older versions of Godot won't work.

# What comes next

The following two are the last tasks of my current roadmap:

- Separate and organize the C# Godot API into different namespaces.
- Provide a .NET friendly IO API for the Godot virtual file system.

After this I want to dedicate a month entirely to bug fixing and to plan the
roadmap for Godot 4.0 before starting any new work.
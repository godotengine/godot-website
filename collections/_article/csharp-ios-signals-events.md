---
title: "C# progress report: iOS and signals as events"
excerpt: "Godot is getting iOS support for C# games. There is also a new system for using Godot signals as C# events."
categories: ["progress-report"]
author: Ignacio Roldán Etcheverry
image: /storage/app/uploads/public/5e8/92c/7b8/5e892c7b82886061410800.png
date: 2020-04-06 10:55:26
---

Initially and for quite some time C# was only supported in Godot on desktop platforms. In the last year we made good progress extending support to Android and WebAssembly, and now it's time to add iOS to that list as well.

In this progress report I'm also introducing a new way of working with Godot signals in C#.

This work is kindly sponsored by Microsoft.

# iOS support

![DodgeTheCreepsCS on the iOS Simulator](/storage/app/media/mono/csharp_dodgethecreeps_ios_sim.png)
_The [Dodge The Creeps C#](https://github.com/godotengine/godot-demo-projects/tree/master/mono/dodge_the_creeps) demo running on the iOS Simulator_

Godot 4.0 will be getting C# support for iOS. We also plan to include it in a 3.2.x release, which could be 3.2.2 if everything goes well.

Similarly to WebAssembly, the Mono JIT compiler is not available on iOS devices. Instead, Godot will perform Ahead-of-Time (AOT) compilation when exporting a game and the resulting libraries will be added to the generated Xcode project.

Other than the additional time that is spent doing AOT compilation of assemblies, the export process should be the same as it is with games that don't use C#.

For those interested in building Godot from source, the code is available in the [3.2-mono-ios](https://github.com/godotengine/godot/tree/3.2-mono-ios) branch (soon to be merged in the `3.2` branch). Currently the `master` branch doesn't support a lot of platforms (including iOS) due to the ongoing work with the renderer.
The [Compiling with Mono](https://docs.godotengine.org/en/latest/development/compiling/compiling_with_mono.html) page includes information about building the Mono runtime, the Base Class Library and the AOT cross-compiler.

# Signals as events

[Signals](https://docs.godotengine.org/en/latest/getting_started/step_by_step/signals.html) are the Godot version of the _observer_ pattern. Engine classes use signals to notify listeners when an event occurs. User scripts can also create their own signals.

This is what a signal declaration looks like in GDScript:

```gd
signal text_changed(text)
```

Code can interact with signals via the `connect` (listen), `disconnect` (stop listening) and `emit_signal` (notify/raise) methods. Signals are also accessible from the Godot editor where new connections can be created.

The equivalent of a signal declaration in C# is a delegate declaration with a `Signal` attribute. They can be interacted with them using the aforementioned methods. While this did the job well and it's pretty much the same as GDScript, I was never fully satisfied with it.

In .NET, the common way to implement the observer pattern is using [events](https://docs.microsoft.com/en-us/dotnet/standard/events/). Compared to events, C# code that uses Godot signals looks foreign.

Last month, motivated by the new [Callable](https://godotengine.org/article/core-refactoring-progress-report-1) type, I decided to re-think the implementation of signals in C#. The goal this time is to expose them as events. It's not finished, but the initial results are looking great.

![Code completion for signals events](/storage/app/media/mono/csharp_signals_as_events.png)
_Code-completion of signals events for the `Godot.CheckBox` class_

In the following code example we can see how it compares to the old style:

```cs
// Old style
class TextField : Node {
    [Signal] delegate void TextChanged(string text);

    void Foo() {
        Connect(nameof(TextChanged), this, nameof(TextChangedCallback));
        EmitSignal(nameof(TextChanged), "bar");
    }

    void TextChangedCallback(string text) { /* ... */ }
}

// New style
class TextField : Node {
    delegate void TextChangedHandler(string text);
    [Signal] event TextChangedHandler TextChanged;

    void Foo() {
        TextChanged += TextChangedCallback;
        // TextChanged?.Invoke("bar"); // Nope, not yet :(
        EmitSignal(nameof(TextChanged), "bar");
    }

    void TextChangedCallback(string text) { /* ... */ }
}
```

As seen in the example, the most important part that's missing is support for raising the event. This right now would only invoke the event delegates, but it won't emit the signal, which is important to notify engine and GDScript listeners. As such, we still need to use the classic `EmitSignal` call, which will emit the signal as well as raise the event. More work will be needed in order to support event raising.

# What comes next

This progress report came really delayed. You can expect a new one in the next weeks, in which I'll be announcing Godot extensions for both Visual Studio and VS Code!

After that there are two more tasks in my current roadmap. One of them is separating the Godot API into namespaces (right now we have everything in the same bloated namespace).

The other task is writing a C# API to wrap the Godot file system. This new API is meant to replace the auto-generated `Directory` and `File` classes (which will still be available for compatibility). The new API is meant to be very similar to what developers are used to in .NET.

C# is now working on almost every platform Godot supports, with the exception of the Universal Windows Platform (UWP). While UWP is not part of my current roadmap, support for it is likely to happen before 4.0 is released. Also WebAssembly, while already working, is still lacking AOT compilation from Godot which is of high priority.
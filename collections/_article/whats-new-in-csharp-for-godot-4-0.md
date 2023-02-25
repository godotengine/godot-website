---
title: "What's new in C# for Godot 4.0"
excerpt: "All about changes and improvements that Godot 4.0 offers to C# developers."
categories: ["progress-report"]
author: Raul Santos
image: /storage/blog/covers/whats-new-in-csharp-for-godot-4-0.jpg
date: 2023-02-25 17:00:00
---

The Godot 4.0 release contains [multiple changes](/article/dev-snapshot-godot-4-0-beta-1) to almost every area of the engine, and first-party support for C# and .NET is no exception. The main focus of this release has been on modernizing the runtime environment and updating the C# API to be more in line with the engine core. We took care not to sacrifice that aspect of familiarity that many of you seek when picking C# as your main scripting language.

In this article, we'll go into more detail about each of the most important changes.

* [Runtime changes](#runtime-changes)
* [Engine interop with source generators](#engine-interop-with-source-generators)
* [The new Variant type](#the-new-variant-type)
* [Collections changes](#collections-changes)
* [Signals as events](#signals-as-events)
* [Callable support](#callable-support)
* [Int and Float changes](#int-and-float-changes)
* [Renames](#renames)
* [Exported property improvements](#exported-property-improvements)
* [Improved C# documentation](#improved-c-documentation)
* [NuGet packages](#nuget-packages)
* [IDE support](#ide-support)
* [Future](#future)
  - [Global classes](#global-classes)
  - [Mobile and web support](#mobile-and-web-support)
  - [Full AOT and trimming support](#full-aot-and-trimming-support)
  - [GDExtension support](#gdextension-support)
  - [Improve Source Generators extensibility](#improve-source-generators-extensibility)
  - [Editor unification](#editor-unification)
  - [Godot as a library](#godot-as-a-library)

<div class="card card-warning">
  <p><strong>⚠️ Warning</strong></p>
  <p>If you have created a Godot project in one of the earlier preview releases of Godot 4.0, you will need to delete the <code>res://.godot/mono</code> directory before opening it in the stable version of the engine. This is required to ensure that no older assemblies are used.</p>
  <p>Godot 3 projects can be converted to Godot 4.0 with the built-in project converter. Due to limitations of how the project converter works, the converted project will likely require lots of manual fixing before it can be opened with Godot 4.0. Because of numerous changes between the two versions you may want to create a new project from scratch instead of porting it.</p>
</div>

## Runtime changes

The main change for C# support is that we moved away from the Mono SDK and we now use the **.NET SDK** to embed the .NET runtime. This means we use the CoreCLR runtime for desktop platforms. Mobile and web platforms are not supported at the moment, and will be worked on for a future Godot 4 release. For the mobile platform specifically we are going to use the Mono runtime.

With this change, the Mono module is now called **.NET module**, but the only .NET language officially supported is still **C#**. The Godot API is also now targeting .NET 6, the latest .NET LTS release.

For end users this means that they only need to install the latest [.NET SDK](https://get.dot.net) to start working with C# in Godot 4. The default target for game projects is .NET 6, allowing you to use modern C# features included in .NET; something that is not easily accessible in Godot 3. It should also be possible to target newer frameworks, although we can't fully guarantee it would work properly.

In Godot 3, which targets .NET Framework 4.7.2 by default, you could use the latest version of C# just as well, because the language version is not inherently tied to the targeted framework. However, this is not true for all features, as some of them require runtime support (such as [Default Interface Methods](https://learn.microsoft.com/en-us/dotnet/csharp/language-reference/proposals/csharp-8.0/default-interface-methods)). Now that we officially support targeting .NET 6, all features available in C# 10 are supported.

Targeting the latest frameworks also allows using the newer APIs included in the Base Class Library (e.g. `DateOnly`, `TimeOnly`, `PriorityQueue`) and benefiting from recent [performance improvements](https://devblogs.microsoft.com/dotnet/performance-improvements-in-net-6/).

#### Relevant links

- Merge .NET 6 branch with master ([GH-64089](https://github.com/godotengine/godot/pull/64089)).
- [What's new in .NET 5](https://learn.microsoft.com/en-us/dotnet/core/whats-new/dotnet-5).
- [What's new in .NET 6](https://learn.microsoft.com/en-us/dotnet/core/whats-new/dotnet-6).
- [Announcing .NET 6 — The Fastest .NET Yet](https://devblogs.microsoft.com/dotnet/announcing-net-6/).

## Engine interop with source generators

In the past, Godot has used reflection to communicate with the engine. This has worked great so far but it comes with some limitations. We now use [source generators](https://devblogs.microsoft.com/dotnet/introducing-c-source-generators/), which have the following benefits:

- Generated code is generally faster than reflection.
- They support **trimming** which reduces the size of the exported assembly and paves the way for full **AOT** support in the future.
- They allow analyzing user code to **emit diagnostics at compile time**. This means that we can warn you about code that would fail at runtime before you actually execute the game.

This change also means that user types which derive from native Godot types (such as `Node` or `Resource`) need to be declared `partial`.

Unfortunately, currently this makes it difficult or more cumbersome for third-party source generators to support some workflows. We are looking into ways to support these use cases, so keep an eye out for that in the future.

#### Relevant links

- Merge .NET 6 branch with master ([GH-64089](https://github.com/godotengine/godot/pull/64089)).
- C#: Generators ignore _Ready method in partial classes from another generators ([GH-66597](https://github.com/godotengine/godot/issues/66597)).
- Allow for a way to ensure some source generators run before / after others ([GH-57239](https://github.com/dotnet/roslyn/issues/57239)).

## The new Variant type

Previous versions of C# in Godot have used `System.Object` to represent Godot's Variant type, which is a special container for various data types supported by the engine. The problem with that is that `System.Object` is the base type for all .NET types, including types that are not supported by Godot. This means that the Godot API allowed using types that would fail at runtime since we wouldn't be able to convert it to a type that Godot would understand.

Now we have a dedicated `Variant` struct that represents all the types that Godot supports. This means our API is more strict about which types you can use, and you will get errors at compile time before executing your game.

The way the `Variant` struct is implemented also avoids boxing value types (such as `int` and `float`) in cases where it was unavoidable in Godot 3.

When using `System.Object`, users have been able to take advantage of .NET features such as pattern matching and generics. The new `Variant` struct no longer allows to use those features directly. Pattern matching can be replaced with checking the `Variant.VariantType` property, while generics can be supported using the `[MustBeVariant]` attribute.

For more information about how Variants are supported in C#, take a look at the new documentation page about [_C# Variant_](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/c_sharp_variant.html).

#### Relevant links

- C#: Represent Variant as its own type instead of System.Object ([GH-3837](https://github.com/godotengine/godot-proposals/issues/3837)).
- Merge .NET 6 branch with master ([GH-64089](https://github.com/godotengine/godot/pull/64089)).
- C#: Optimize Variant conversion callbacks ([GH-68310](https://github.com/godotengine/godot/pull/68310)).

## Collections changes

Just like in 3.x, `Array` and `Dictionary` collections are supported in C# through the types defined in the `Godot.Collections` namespace. Godot's packed arrays, a special type of arrays optimized for memory usage, don't have their own representation in C#, and normal C# arrays should be used (e.g. `byte[]`).

Godot APIs are only able to understand these Godot collections, which means anything that interops with Godot's native side needs to use one of the supported collection types.

In 3.x, the non-generic collections used `System.Object`, just like .NET non-generic collections. However, thanks to the new [`Variant`](#the-new-variant-type) type, Godot C# collections now implement the generic collection interfaces where `T` is `Variant`. This means that the non-generic collections now only support Variant-compatible types, so you'll get compile errors when using an invalid type rather than a runtime exception.

The generic collections will also validate that the generic `T` parameter is one of the Variant-compatible types, since it's annotated with the new `[MustBeVariant]` attribute.

Godot collections now implement more utility methods that expose similar functionality to what can be done in other supported languages. Using these instance methods is generally faster than Linq because it avoids marshaling every item in the collection. On top of that, collections also provide an extra utility method, `MakeReadOnly`. It allows you to freeze the collections so modifying them is no longer possible.

You are not limited to using Godot collections in your own internal logic, of course. The Base Class Library in .NET includes many other collections that can be used. These collections are not going to work with Godot's API but can still be useful. In 3.x, some .NET collections were supported in very specific scenarios (such as exporting properties). This is no longer supported in 4.0 since it required reflection. Support for .NET collections may be re-introduced in the future, implemented with source generators instead of reflection.

To help you choose which collection type to use and when, we have a new documentation page all about [_C# Collections_](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/c_sharp_collections.html).

#### Relevant links

- Merge .NET 6 branch with master ([GH-64089](https://github.com/godotengine/godot/pull/64089)).
- C# Export on List not possible anymore ([GH-70298](https://github.com/godotengine/godot/issues/70298)).
- Sync C# Array with Core ([GH-71786](https://github.com/godotengine/godot/pull/71786)).
- Sync C# Dictionary with Core ([GH-71984](https://github.com/godotengine/godot/pull/71984)).

## Signals as events

Godot signals are a great way to implement the Observer pattern. It's possible to use Godot signals by using the common engine API, such as the `Connect` and `EmitSignal` methods. But C# developers are more used to using events, as they are more idiomatic.

For Godot 4.0, we now generate C# events for all Godot signals, which allows developers to use the event syntax that they are used to and love. As a consequence, subscribing to Godot signals using the event syntax is type-safe.

These generated events differ from normal C# events in two ways:

* These events are disconnected from automatically upon freeing the Godot type that contains the signal.
* Using the `Invoke` method to raise the event is not allowed.

We are looking into ways to allow raising events in a type-safe way, so keep an eye out for that in the future.

For more information on how to use signals in C#, take a look at the new documentation page about [_C# Signals_](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/c_sharp_signals.html).

#### Relevant links

- Fix C# bindings after recent breaking changes ([GH-37050](https://github.com/godotengine/godot/pull/37050)).
- Create a dedicated "C# Signals" page ([GH-6643](https://github.com/godotengine/godot-docs/pull/6643)).

## Callable support

In Godot 4 we introduce the new `Callable` type that represents a method in an object instance or a standalone function. This may sound familiar, because C# already supports a similar concept with delegate types, the `Action` and `Func` types, and lambdas.

In order to support interoperability with the engine, Godot's C# API implements a `Callable` type that can be created from an `Action` or a `Func`. This also allows developers to use C# lambdas with Godot API.

`Callable`s can be invoked by using the `Call` or `CallDeferred` methods. We currently don't support binding values to the parameters in C#. This shouldn't be a problem when using C# lambdas since they can use closures to support this scenario.

```csharp
string name = "John Doe";
Callable.From(() => SayHello(name));

void SayHello(string name)
{
  GD.Print($"Hello, {name}");
}
```

#### Relevant links

- Fix C# bindings after recent breaking changes ([GH-37050](https://github.com/godotengine/godot/pull/37050)).
- C#: Reflection-less delegate callables and nested generic Godot collections ([GH-67987](https://github.com/godotengine/godot/pull/67987)).

## Int and Float changes

In Godot API the names `INT` and `FLOAT` are used to mean 64-bit integer and floating types, respectively. This is true even in Godot 3, but in C# we used to marshal those types as 32-bit C# types `int` and `float`. This led to [marshaling issues](https://github.com/godotengine/godot/issues/39609) and potential precision loss. This has been fixed in Godot 4.0, as now we use the same bit-ness as the engine does. This means some APIs have changed from `int` to `long` and from `float` to `double`.

For vector types, Godot uses 32-bit floats by default (this can be changed by building the engine with `--precision=double`). This may lead to some inconvenient situations where values must be converted to `float` before using them with vectors. This limitation also applies to some engine core APIs, the most common one being the `delta` parameter in `_Process` and `_PhysicsProcess`. The `Mathf` API has been updated to support both `float` and `double` overloads, which should reduce friction with these changes.

#### Relevant links

- C#: _Process / _PhysicsProcess receive delta as float instead of double ([GH-65139](https://github.com/godotengine/godot/issues/65139)).
- C#: Assume 64-bit types when type has no meta ([GH-65168](https://github.com/godotengine/godot/pull/65168)).
- Reduce the amount of casting required for floating points in C# ([GH-5403](https://github.com/godotengine/godot-proposals/issues/5403)).
- C#: Add float and double overloads to Mathf ([GH-71583](https://github.com/godotengine/godot/pull/71583)).

## Renames

A lot of types and members have been renamed in Core with the intention to make names clearer. In C# we took the opportunity to also rename a bunch of APIs in order to more closely follow the [.NET naming guidelines](https://learn.microsoft.com/en-us/dotnet/standard/design-guidelines/naming-guidelines).

The [_Capitalization Conventions_](https://learn.microsoft.com/en-us/dotnet/standard/design-guidelines/capitalization-conventions) guidelines indicate that C# should use PascalCase for all identifiers except parameter names (including acronyms over two letters in length). As a result, some types have been renamed (e.g. `CPUParticles2D` is now `CpuParticles2D`, `DTLSServer` is now `DtlsServer`).

The `Godot.Object` type is now named `GodotObject` in order to avoid conflicting with the `System.Object` type. This follows the [_Namespaces and Type Name Conflicts_](https://learn.microsoft.com/en-us/dotnet/standard/design-guidelines/names-of-namespaces#namespaces-and-type-name-conflicts) guidelines:

- Types in two different namespaces shouldn't have the same name if those namespaces are often used together.
- Type names should not conflict with the names of types in the .NET Core namespaces (such as `System`).

The [_General Naming_](https://learn.microsoft.com/en-us/dotnet/standard/design-guidelines/general-naming-conventions#using-abbreviations-and-acronyms) guidelines also recommend to avoid abbreviations or contractions as part of identifier names. Acronyms should only be used when they are widely accepted, and even then, only when necessary.

This should make Godot's API more consistent with the rest of the .NET ecosystem, and hopefully avoid some conflicts.

#### Relevant links

- PascalCase naming inconsistencies with C# ([GH-28748](https://github.com/godotengine/godot/issues/28748)).
- C#: Renames to follow .NET naming conventions ([GH-69547](https://github.com/godotengine/godot/pull/69547)).

## Exported property improvements

A lot of highly requested features have been implemented in Godot to improve exported properties and the inspector. These features are also supported in C#.

In 4.0, you are now able to export properties of type `Node` or any derived type directly, without the need to export a `NodePath` and retrieve it manually.

It's also now possible to group properties with the new `[ExportCategory]`, `[ExportGroup]` and `[ExportSubgroup]` attributes. Take a look at the updated [_C# Exports_](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/c_sharp_exports.html) documentation page to learn more about the new attributes.

Support for flag enums (annotated with the `[System.Flags]` attribute) has also been improved. Exported properties for such enums now show up as checkboxes in the Inspector.

Due to [engine interop improvements](#engine-interop-with-source-generators) we now use source generators instead of reflection. This means that the attributes are not retrieved at runtime. Instead the source generators generate different code based on the attributes found from the source analysis. This makes it much more difficult to support custom user attributes derived from the Godot attributes. With our current source generator implementation, derived attributes have no effect on user scripts.

To prevent a possible confusion, we've sealed the attributes to disallow inheriting from them. We are looking into ways to support extending our source generators to allow custom user attributes to affect scripts, so keep an eye out for that in the future.

In Godot 4.0, a bunch of new export annotations were added to GDScript. However, we didn't have time to add equivalent attributes in C#. All those annotations can be replicated with the `[Export]` attribute using the right combination of `PropertyHint` and `HintString` values, until we implement these convenient attributes in a future version of Godot 4.

The much anticipated support for exporting [custom resources](#global-classes) hasn't made it in time, unfortunately, and is still in development, but you can expect it to arrive very soon.

#### Relevant links

- Ability to export Node types instead of just NodePaths ([GH-1048](https://github.com/godotengine/godot-proposals/issues/1048)).
- Add ability to export Node pointers as NodePaths ([GH-62185](https://github.com/godotengine/godot/pull/62185)).
- C#: Enable exporting nodes to the inspector ([GH-62789](https://github.com/godotengine/godot/pull/62789)).
- Add grouping annotations for class properties in GDScript ([GH-62707](https://github.com/godotengine/godot/pull/62707)).
- C#: Add an easy and accessible way of organizing export variables ([GH-3451](https://github.com/godotengine/godot-proposals/issues/3451)).
- C#: Add grouping attributes for properties ([GH-64742](https://github.com/godotengine/godot/pull/64742)).
- C#: Preserve order of exported fields/categories ([GH-64852](https://github.com/godotengine/godot/pull/64852)).
- Support explicit values in flag properties, add C# flags support ([GH-59327](https://github.com/godotengine/godot/pull/59327)).

## Improved C# documentation

A lot of Godot tutorials and tips you can find online contain samples of GDScript code. To help you with interpreting them into C# equivalents the official documentation has a [C# differences article](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/c_sharp_differences.html), which has also been updated. It now features a complete set of tables with the C# equivalent for every common GDScript API. Sometimes a Godot C# equivalent does not exist because there are more suitable methods in the .NET Base Class Library.

The new equivalence tables try to encompass every possible case, and should be a great tool for developers looking to port GDScript code to C#. Let us know if this can be improved!

#### Relevant links

- C#: Add table with equivalent string methods ([GH-6442](https://github.com/godotengine/godot-docs/pull/6442)).
- C#: Add table with equivalent GlobalScope methods ([GH-6721](https://github.com/godotengine/godot-docs/pull/6721)).
- C#: Add table with equivalent Array methods ([GH-6677](https://github.com/godotengine/godot-docs/pull/6677)).
- C#: Add table with equivalent Dictionary methods ([GH-6676](https://github.com/godotengine/godot-docs/pull/6676)).
- Add Color section to C# differences page ([GH-6679](https://github.com/godotengine/godot-docs/pull/6679)).

## NuGet packages

With the Godot 4 release we also start publishing the Godot assemblies to [NuGet.org](https://www.nuget.org/packages/GodotSharp). This allows developers to create third-party libraries that reference Godot assemblies with more ease and convenience.

The NuGet packages versioning follows Godot which is similar to [semver](https://semver.org/). This means, in theory, that there should not be breaking changes between minor or patch versions. In practice, while we try to avoid breaking compatibility as much as possible, there may still be some minor breaking changes from time to time.

How does breaking compatibility affect your game? If your game references a package _MyLibrary_ which has been built against _GodotSharp 4.0.0.0_, but your game is using _GodotSharp 4.1.0.0_ which introduces a breaking change, it will cause runtime exceptions, the most common one being `System.MethodNotFoundException`.

For example, take a look at this method signature:

```csharp
public void MyMethod();
```

Now, let's assume this API changes in a future version and the new method signature looks like this:

```csharp
public void MyMethod(int number = 42);
```

Even though the parameter is optional, the method now has a different signature. Therefore libraries built against the previous version that invoke `MyMethod` won't be able to find it.

Godot implements various systems to preserve compatibility and allow for smooth transition, even when we have to change some fundamental things. You should expect future releases of Godot 4 to work with your Godot 4.0 project, but we still leave the room for the inevitable. In case of completely incompatible changes introduced in minor releases, we promise to provide clear migration instructions and possibly tools for automated conversion. In order to further minimize issues make sure your game project as well as the libraries it uses are all referencing the same _GodotSharp_ version.

## IDE support

With the move to the .NET Core CLR runtime, Godot gained support to use the official C# debugger. This means IDEs that support C# and official C# extensions support debugging Godot projects out of the box. Although configuring your IDE may require a few more steps at the moment.

Other features of Godot's IDE extensions for C#, such as our Roslyn completion providers, are planned to be moved out of the extensions and into NuGet packages so that all IDEs can benefit without requiring a dedicated extension.

The [_Configuring an external editor_](https://docs.godotengine.org/en/latest/tutorials/scripting/c_sharp/c_sharp_basics.html#configuring-an-external-editor) section of the C# basics documentation page has yet to be updated to explain how to set up your editor for Godot 4.0. Stay tuned for an updated version.

#### Relevant links

- Make GodotCompletionProviders work via NuGet ([GH-18](https://github.com/godotengine/godot-csharp-visualstudio/issues/18)).

## Future

Some features didn't make it in time for Godot 4.0, but are already on our roadmap for a future release (and some are already in the works).

### Global classes

Global classes, also known as named scripts, are classes registered in the editor so they can be used more conveniently. These classes appear in the _Add Node_ and _Create Resource_ dialogs. GDScript supports this feature with the `class_name` syntax.

We tried, but ultimately failed, to bring this feature to C# in time for 4.0. Luckily, there's already a PR open, so it's very likely it is going to be ready for the next minor release, Godot 4.1.

#### Relevant links

- Add first-class custom resource support ([GH-18](https://github.com/godotengine/godot-proposals/issues/18)).
- Allow exporting custom resources from/to GDScript, VisualScript, C#, and PluginScript ([GH-48201](https://github.com/godotengine/godot/pull/48201)).
- Script-class-aware Inspector & related controls ([GH-62413](https://github.com/godotengine/godot/pull/62413)).
- Enable QuickOpen to see scripted resources ([GH-62417](https://github.com/godotengine/godot/pull/62417)).
- Add C# resource export ([GH-72619](https://github.com/godotengine/godot/pull/72619)).

### Mobile and web support

We aim to support C# on all the platforms that Godot is available on. Unfortunately, we were unable to implement support for mobile and web platforms for 4.0. These platforms gained support upstream somewhat recently so we didn't have much time to work on it. The new workloads in .NET 6 should allow us to support the mobile and web platforms really soon, so keep an eye out for that.

#### Relevant links

- [Announcing .NET 6 — The Fastest .NET Yet](https://devblogs.microsoft.com/dotnet/announcing-net-6/).

### Full AOT and trimming support

Support for these features can greatly reduce binary size and enable further performance optimizations. In order to support them, we need to ensure that our libraries are prepared. Dynamically accessed types can't be trimmed, so we need to avoid reflection as much as possible.

Some target platforms don't support JIT, so we are definitely looking into supporting AOT. We'll be working on this as we add support for more platforms in future 4.x releases.

#### Relevant links

- [App Trimming in .NET 5](https://devblogs.microsoft.com/dotnet/app-trimming-in-net-5/).
- [Native AOT deployment](https://learn.microsoft.com/en-us/dotnet/core/deploying/native-aot/).

### GDExtension support

The ability to create GDExtensions using C# will enable new and powerful workflows. This would allow us to avoid the limitations of a scripting language implementation, such as [relying on file paths](https://github.com/godotengine/godot/issues/15661) to reference C# classes. Users are going to be able to implement C# types that can be registered in Godot's internal type database, ClassDB, and that would behave as built-in Nodes and Resources.

GDExtension is still very new to the engine, and is subject to change. It also has some limitations that would result in UX regressions, if C# moved away from the scripting language implementation. But it also has the potential to reduce some pain points that users have had in the past. In Godot 4.0, C# is still implemented as a scripting language, but we are planning to add support for GDExtension creation using C#. We will be keeping the scripting language implementation for your regular game scripting needs.

Consuming APIs provided by a GDExtension is also currently unsupported. We'll keep working on bridging the gap between GDExtension and C# in future 4.x releases.

#### Relevant links

- [Introducing GDNative's successor, GDExtension](https://godotengine.org/article/introducing-gd-extensions/).

### Improve source generators extensibility

As mentioned throughout this article, several areas can benefit from allowing users to create their own third-party source generators that can extend what's currently available. For example, allowing our source generators to be affected by custom user-defined attributes.

This is tricky to get right, but we'll be exploring some ideas in future 4.x releases to see how we can provide some extensibility without requiring users to disable and re-implement all of our source generators.

### Editor unification

Just like Godot 3 before it, Godot 4.0 is going to come with two versions of the editor, one "standard" and one with extra support for C# and .NET. However, the plan for 4.x is to provide one unified editor, that support everything the .NET build currently supports. If you're a GDScript user, this doesn't come at any cost for you. But for maintainers and C# developers it greatly simplifies things and allows for more efficient editor development and testing. To keep things slim and flexible, components required to support .NET projects would be downloaded on-demand when the user needs them.

#### Relevant links

- From embedding Mono to Godot as a library and the future ([GH-2333](https://github.com/godotengine/godot-proposals/issues/2333)).

### Godot as a library

The concept of Godot as a library and C# being the entry point is something that a lot of users seem to be interested in. We think this could bring many benefits to C# users, it would make it easier to support all the platforms where .NET is available, and stay up-to-date with newer .NET versions.

We started exploring this area in 4.0, but it still requires more investigation and work. It's unlikely to be finished any time soon but we'll keep working on it in the future.

#### Relevant links

- From embedding Mono to Godot as a library and the future ([GH-2333](https://github.com/godotengine/godot-proposals/issues/2333)).

---

As you can see, a lot of work has been done, and more work is in the pipeline. We are constantly looking into more ways to improve performance and usability of the API, and we keep fixing all the bugs that you can find. We are looking forward to see what you think of the .NET module in Godot 4.0. Don't hesitate to reach out with your feedback! 🙂

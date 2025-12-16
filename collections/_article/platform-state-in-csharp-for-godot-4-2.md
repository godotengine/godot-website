---
title: "Current state of C# platform support in Godot 4.2"
excerpt: "How the transition to a unified .NET has impacted platform support, and re-adding the ability to port to mobile."
categories: ["progress-report"]
author: Raul Santos
image: /storage/blog/covers/progress-update-csharp-2.jpg
date: 2024-01-26 17:00:00
---

With the recent release of Godot [4.2](/article/godot-4-2-arrives-in-style), projects that use C# can now export to Android and iOS. Let's take a look at the current platform support for C# projects and what to expect from future releases beyond 4.2.

## Background

First a bit of history. Godot 3 supports exporting C# projects to all the platforms supported by the engine. The C# implementation uses the [Mono embedding APIs](https://www.mono-project.com/docs/advanced/embedding/) and the [Mono runtime](https://www.mono-project.com/docs/advanced/runtime/). **Mono** is an open source cross-platform implementation of the Windows-only .NET Framework.

With the [4.0 release](https://godotengine.org/article/godot-4-0-sets-sail/), the C# integration moved away from the Mono embedding APIs and replaced it with the .NET Core hosting APIs (using the `hostfxr` library). This allowed us to modernize the codebase and prepare for [.NET 5](https://devblogs.microsoft.com/dotnet/introducing-net-5/), the first release in the .NET unification journey. Unfortunately, in this move C# projects lost the ability to export to platforms other than Desktop (Windows, macOS and Linux).

Before **.NET unification** there was the Windows-only .NET Framework and the cross-platform Mono and .NET Core. Unification means there will be just one .NET going forward, so the next release after .NET Core 3.0 was named .NET 5, and Mono and .NET Framework won't have any new major releases.

The term **Mono** can be used to refer to a collection of technologies. With .NET unification, the Mono framework is deprecated, but the runtime is still supported. Unified .NET uses both the CoreCLR and the Mono runtimes, but Mono is the only runtime that supports mobile and web platforms.

However, in .NET 7.0 a new runtime became available, [**NativeAOT**](https://learn.microsoft.com/en-us/dotnet/core/deploying/native-aot), which allows publishing native binaries built for a specific platform, instead of the JIT-based portable binaries. In .NET 7.0, NativeAOT only supports Windows and Linux, but in .NET 8.0 it adds support for macOS and experimental support for Android and iOS. This means in .NET 8.0 NativeAOT can be used as an alternative to Mono for mobile platforms.

## Platform support in 4.2

Thanks to amazing work by [RedworkDE](https://github.com/RedworkDE) and [Andreia Gaita](https://github.com/shana), C# projects in Godot [4.2](/article/godot-4-2-arrives-in-style) have _experimental_ support for exporting to **Android** and **iOS**.

These initial implementations have some limitations which is why they are still marked experimental. We want to make sure the platform support is production-ready before we remove the experimental label. The platform limitations are documented in the [C# documentation](https://docs.godotengine.org/en/4.2/tutorials/scripting/c_sharp/index.html#c-platform-support), but we'll go over each platform here.

### Android

Android support was implemented in [GH-73257](https://github.com/godotengine/godot/pull/73257) by [RedworkDE](https://github.com/RedworkDE) and uses the .NET hosting APIs provided, just like the desktop platforms.

Exporting to Android requires .NET **7.0** or higher, uses the [**linux-bionic**](https://github.com/dotnet/runtime/pull/66147) Mono runtime, and only supports the `arm64` and `x64` architectures.

The **linux-bionic** runtime is a Linux runtime using the Android C library, so it's basically Android but without the JNI. This means that the Android bindings are not available, so some APIs (such as [SSL](https://github.com/godotengine/godot/issues/84559)) will crash the game. Use the Godot APIs when possible to avoid these issues.

Using NativeAOT should also be supported in theory, but it requires using .NET **8.0** and some manual work. You can read more about using NativeAOT with Android bionic in the [Microsoft documentation](https://github.com/dotnet/runtime/blob/v8.0.0/src/coreclr/nativeaot/docs/android-bionic.md).

### iOS

iOS support was implemented in [GH-82729](https://github.com/godotengine/godot/pull/82729) by [Andreia Gaita](https://github.com/shana) and uses the new **NativeAOT** runtime which has experimental support for iOS in .NET **8.0**.

NativeAOT uses trimming and Godot still uses reflection in parts of the codebase, so we are rooting the Godot bindings and the game project's assemblies but some reflection usage may still break at runtime.

Exporting to iOS is only supported from a macOS device and requires using Xcode to build the final binaries.

The official export template for the iOS simulator only supports the `x64` architecture.

### Web

The web platform is still **not supported** in 4.2.

For non-C# projects, Godot uses [Emscripten](https://emscripten.org/) to compile C++ code to [Web Assembly](https://webassembly.org/) (WASM) that can be run as "native code" in web browsers. The Godot WASM acts as the main module and it's able to load other WASMs that are built as side modules. GDExtensions that are used in web exports are built as WASM side modules so Godot can load them dynamically.

When building C# projects for the web platform, .NET is able to build a WASM but this can't be used by Godot because .NET expects to be the main entry point and doesn't support [dynamic linking](https://github.com/dotnet/runtime/issues/75257). This is because, currently, the .NET runtime can only be built as a main module. So, unlike GDExtensions, the resulting WASM can't be loaded by Godot.

Future upstream improvements may allow using the WASM built by the .NET workload.

### Desktop

Desktop platforms have been supported since 4.0, but what some users may not know is that those platforms support all .NET runtimes. This is not new to 4.2 and, in fact, has been supported since 4.0. Godot's C# integration uses standard .NET so everything that works in a normal C# project should work in Godot too. To use a different runtime from the default (which is CoreCLR), users have to modify the C# project file (`.csproj`) as documented in the Microsoft documentation.

To enable NativeAOT in desktop platforms, make sure to target .NET 7.0 or higher and set the `<PublishAOT>` property to true. Also, since Godot uses reflection, make sure to root the assemblies (this is done automatically for you when exporting to iOS because NativeAOT is currently the only supported runtime). Here's an example C# project:

```xml
<Project Sdk="Godot.NET.Sdk/4.2.0">
  <PropertyGroup>
    <TargetFramework>net8.0</TargetFramework>
    <EnableDynamicLoading>true</EnableDynamicLoading>
    <!-- Use NativeAOT. -->
    <PublishAOT>true</PublishAOT>
  </PropertyGroup>
  <ItemGroup>
    <!-- Root the assemblies to avoid trimming. -->
    <TrimmerRootAssembly Include="GodotSharp" />
    <TrimmerRootAssembly Include="$(TargetName)" />
  </ItemGroup>
</Project>
```

### Summary

As a summary, the current platform support as of 4.2 is described in the table below:

| Platform | Runtimes supported | Minimum required .NET version |
| -: | - | - |
| **Windows** | CoreCLR, Mono, NativeAOT | 6.0 (CoreCLR), 7.0 (Mono, NativeAOT) |
| **macOS** | CoreCLR, Mono, NativeAOT | 6.0 (CoreCLR), 7.0 (Mono, NativeAOT) |
| **Linux** | CoreCLR, Mono, NativeAOT | 6.0 (CoreCLR), 7.0 (Mono, NativeAOT) |
| **Android** | Mono | 7.0 |
| **iOS** | NativeAOT | 8.0 |
| **Web** | - | - |

## What's next?

As new releases of .NET become available, platform support gets better. NativeAOT support for mobile platforms is still experimental, and there's currently no support for the web platform. The .NET 9.0 release is set to include some improvements to NativeAOT and we may see initial support for the web platform. We'll see what makes it into the release in November 2024.

Using NativeAOT is only one of the ways in which we can add support for more platforms to Godot C# projects, using the Mono runtime is another possibility. For a future Godot release, we want to explore bringing back some of the Mono embedding that was available in Godot 3 as an alternative way to support mobile and web platforms.

Please, give Godot [4.2](/article/godot-4-2-arrives-in-style) a try and let us know if you find any bugs.

<style>
  .article-body table {
    width: 100%;
  }
  .article-body table tr:nth-child(odd) td{
    background: #80808021;
  }
  .article-body table tr:nth-child(even) td{
    background: #80808047;
  }
  .article-body table td {
    padding: 10px;
  }
  .article-body table thead tr {
    background: var(--background-color);
    height: 43px;
  }
  .article-body table thead tr th {
    text-align: center !important;
  }
  .article-body table tbody tr td {
    text-align: center !important;
  }
</style>
---
title: "Godot C# packages move to .NET 8"
excerpt: "On moving to the latest .NET LTS release, and what it means for users."
categories: ["progress-report"]
author: Raul Santos
image: /storage/blog/covers/godotsharp-packages-net8.jpg
date: 2025-01-02 17:00:00
---

A new version of .NET is released in November each year, alternating Long Term Support (LTS) and Standard Term Support (STS) releases. The quality of all releases is the same. The only difference is the length of support. LTS releases are supported for 3 years, while STS releases are supported for 18 months.

With the release of Godot 4.0, we moved our C# packages from targeting Mono to .NET 6. This version of .NET was released on November 8, 2021 and ended support on November 12, 2024.

With .NET 6 ending support, Godot C# packages in 4.4 will target the current LTS release, .NET 8. Thanks to [RedworkDE](https://github.com/RedworkDE) and [Paul Joannon](https://github.com/paulloz) for their great work in [GH-92131](https://github.com/godotengine/godot/pull/92131).

<figure>
	<picture>
		<source srcset="/storage/blog/dotnet/release-schedule-dark.svg" media="(prefers-color-scheme: dark)">
		<img class="lightbox-ignore" style="background-color: transparent;" src="/storage/blog/dotnet/release-schedule-light.svg">
	</picture>
	<figcaption><small>.NET release cadence from the <a href="https://dotnet.microsoft.com/en-us/platform/support/policy/dotnet-core">.NET official support policy</a>.</small></figcaption>
</figure>

## What does this mean for users?

Starting with Godot 4.4, your project will need to target .NET 8 or newer, otherwise it will be incompatible with the new `GodotSharp` packages. You will still be able to use other libraries that target older .NET versions.

Existing projects will be automatically upgraded to target `net8.0` when they are opened with Godot 4.4. If your project already targets .NET 8 or newer, nothing will change. This was implemented in [GH-100195](https://github.com/godotengine/godot/pull/100195).

## What took so long?

The version of .NET that a library targets becomes the minimum required version for consumers of that library. That is, if the `GodotSharp` package targets `net7.0`, your game project needs to target `net7.0` or newer. We didn't want to force our users to upgrade to a non-LTS release.

When .NET 8 was released in November 2023, it would've been a good time to bump the target version in Godot C# packages, since .NET 8 is an LTS release. Unfortunately, there were some breaking changes in .NET 7[^1] that prevented us from upgrading, and making the required changes took us longer than we hoped.

However, users could always use the latest version of .NET in their projects. Up until now, .NET 6 has been the minimum required version, but newer versions have always been supported from day one (even the pre-releases[^2]). In 4.4, the new minimum is now .NET 8, but as always, your projects can target the recent STS release .NET 9 and any newer version that is released in the future.

Libraries tend to stay on older versions of .NET to support as many consumers as possible. But upgrading to the latest version of .NET brings benefits that we want to take advantage of.

[^1]: .NET 7 introduced the new `scoped` keyword. This feature breaks compatibility in some low-level scenarios that affected Godot.

[^2]: While pre-releases are usually supported by Godot, they may require users to enable them by setting the `DOTNET_ROLL_FORWARD_TO_PRERELEASE` environment variable to `1`. Keep in mind pre-releases are still a work-in-progress so there may be bugs.

## What about older Godot releases?

We encourage users to upgrade to the latest version of Godot. We work hard to prevent breaking compatibility, to ensure you can safely upgrade to new versions of Godot when they are released. Please, make sure to test the pre-releases and let us know if you find some bugs so we can fix them before the stable release.

Older versions of Godot will keep targeting .NET 6; we won't change the target version in patch updates, since that would be a big breaking change. If you still need to target .NET 6, you can stay on an older version of Godot, but we strongly encourage you to update to benefit from all the fixes and improvements included in the latest version of Godot and the .NET runtime.

## What about future .NET releases?

Godot always supports the latest .NET version. The version targeted by Godot's C# packages is only the minimum version that your project can target, but you are always free to target a newer .NET version. To target the latest .NET 9 release in your project, you just need to install the latest version of the .NET SDK and change the `TargetFramework` property in your `.csproj`:

```xml
<Project Sdk="Godot.NET.Sdk/4.3.0">
  <PropertyGroup>
    <!-- Target .NET 9 -->
    <TargetFramework>net9.0</TargetFramework>
    <EnableDynamicLoading>true</EnableDynamicLoading>
  </PropertyGroup>
</Project>
```

<div class="card card-warning">
	<p>You should always use the latest version of the .NET SDK even when targeting an older .NET version in your projects.</p>
</div>

We'll keep updating our C# packages to the latest LTS version as they are released. The next LTS release will be .NET 10, due in November 2025.

---
title: "Maintenance release: Godot 2.1.6"
excerpt: "Godot 2.1.6 is a maintenance update for users of Godot's older 2.1 stable branch. It fixes a few platform-specific bugs, and updates Android and iOS export templates to match new requirements of Google Play and the Apple Store."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5d2/745/fd5/5d2745fd51cc0710225918.png
date: 2019-07-11 14:20:00
---

It's been a long time since [our previous release]({{% ref "article/maintenance-release-godot-2-1-5" %}}) in the 2.1 branch!

"Wait," I hear you say, "is the 2.1 branch still maintained 3 years after its first release?"

The answer is yes, on a "best effort" basis and focusing on release critical and security issues. What we consider "release critical" are issues which prevent people using Godot 2.1.x in production from releasing or updating their game, such as crash issues and adapting to the changing requirements of distribution platforms (mainly Google Play and Apple Store).

This Godot 2.1.6 release addresses new requirements from Google Play and Apple store, as well as updates thirdparty libraries to recent versions to fix known security vulnerabilities (in particular in libpng and openssl).

Google Play now mandates the support of its two 64-bit architectures, `arm64v8` and `x86_64`. The former was already included in Godot 2.1.5, but `x86_64` was missing and added first in Godot 3.1-stable. The templates for this architecture are now also included in Godot 2.1.6, and will be included in an upcoming Godot 3.0.7 for the same reason. Additionally, the templates now target the Android API level 28 as required by Google Play from August 2019 onwards.

Apple Store now requires binaries compiled against the iOS SDK 12.1 or later to support the latest iterations of its OS, so Godot 2.1.6 templates are built against this SDK.

### Who is this for?

As mentioned above, this new release is made for people using Godot 2.1.x in production. Many users started projects years ago with Godot 2.1 and are still developing them, about to release them or need to ship updates. Upgrading to Godot 3.0 or later is not straightforward due to various compatibility breakages that we did at the time, so these users need long term support.

If you want to start a new project, there is no reason to use Godot 2.1.6 which is based on a 3 years old code branch. You should instead use the [latest stable release]({{% ref "download" %}}) to benefit from all the new features and bug fixes included over the years.

### Download

As a reminder, Godot 2.1.x does not have an export templates downloader, so you should make sure to download both the editor binary for your platform and the templates archive ([`.tpz` file](https://download.tuxfamily.org/godotengine/2.1.6/Godot_v2.1.6-stable_export_templates.tpz)), and install these templates using the dedicated editor feature. You should **not mix versions**, i.e. using a 2.1.6 editor binary with 2.1.5 templates or the other way around. Export templates should match the exact commit used to build your editor binary.

- [Download repository](https://download.tuxfamily.org/godotengine/2.1.6/)
- [Changelog](https://downloads.tuxfamily.org/godotengine/2.1.6/Godot_v2.1.6-stable_changelog.txt)

**Update (2019-07-12 @ 7:00 UTC):** The Android templates released initially were mistakenly built against an older `AndroidManifest.xml` and still targeted API 27. If you downloaded the templates archive before this update was posted, you should [redownload the templates](https://download.tuxfamily.org/godotengine/2.1.6/Godot_v2.1.6-stable_export_templates.tpz) to have API 28 support.

### Highlights

As the focus is on release critical issues, the changelog is relatively short and upgrades should be problemless. Most fixes are related to platform-specific issues.

- Android: Add support for `x86_64` architecture, fulfills [Google Play requirements](https://android-developers.googleblog.com/2017/12/improving-app-security-and-performance.html) from August 2019. [[GH-25033]](https://github.com/godotengine/godot/pull/25033)
- Android: Target API level 28 (Android 9) as per [Google Play requirements](https://android-developers.googleblog.com/2019/02/expanding-target-api-level-requirements.html) from August 2019. [[GH-29484]](https://github.com/godotengine/godot/issues/29484)
- AtlasTexture: Optimize AtlasTexture packing by minimal perimeter. [[GH-22215]](https://github.com/godotengine/godot/pull/22215)
- Fonts: Fix potential crash using DynamicFont. [[GH-15392]](https://github.com/godotengine/godot/issues/15392).
- HTML5: Fix WebM and Theora video in HTML5 export. [[GH-21511]](https://github.com/godotengine/godot/pull/21511)
- Input: Fix `Input::set_custom_mouse_cursor` showing cursor when it's invisible. [[GH-22187]](https://github.com/godotengine/godot/pull/22187)
- iOS: Target SDK raised to 12.1 (required for new uploads on the Apple Store). [[GH-26593]](https://github.com/godotengine/godot/issues/26593)
- Linux: Default building against builtin freetype, libpng, openssl and zlib for better portability. [[GH-29998]](https://github.com/godotengine/godot/pull/29998)
- Windows: Add HiDPI support. [[GH-29518]](https://github.com/godotengine/godot/issues/29518)
- Thirdparty: libpng 1.6.37 (security update), openssl 1.0.2s (security update), libvorbis 1.3.6, libwebp 1.0.2, Mozilla CA certificates from Dec 2018.

Thanks to all contributors who worked on this release to make sure that Godot 2.1 users can keep publishing their games on their target platforms.

-----

*The illustration picture is a screenshot of *[Kingdoms of the Dump](https://kingdomsofthedump.com)*, a gorgeous trash-themed RPG developed by Roach Games using Godot 2.1, coming to Kickstarter on July 15. Follow them on [Twitter](https://twitter.com/DumpKingdoms) or register to their [junkmailing list](https://kingdomsofthedump.com/#junk-section).*

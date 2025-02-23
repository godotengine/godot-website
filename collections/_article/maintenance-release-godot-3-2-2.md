---
title: "Maintenance release: Godot 3.2.2"
excerpt: "Godot contributors are happy to release version 3.2.2 of our free and open source game engine. It adds various features such as C# support for iOS, 2D batching for the GLES2 renderer, a new plugin system for Android, DTLS support in the networking API, and more! Numerous bugs have been fixed and the documentation and translations have been greatly enhanced."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5ef/477/2d8/5ef4772d8ab2c844046542.jpg
date: 2020-06-26 12:15:57
---

Godot contributors released the [**Godot 3.2 stable branch**](/article/here-comes-godot-3-2) in January 2020 as a major update to our free and open source game engine. The main development effort then moved towards our future major version, Godot 4.0 (see Godot's [Devblog](/devblog) for a preview of some things to come). But Godot 4.0 is still a long way off, and in the meantime we want to provide the best support possible to all Godot users, so the `3.2` branch is worked on in parallel and receives minor updates to fix bugs, improve usability and occasionally add some compatible features.

We thus released [**Godot 3.2.1**](/article/maintenance-release-godot-3-2-1) in March 2020 with a focus on fixing the main issues surfaced in Godot 3.2.

After fixing the most urgent issues in 3.2.1, we could take the time to add some new features to the `3.2` branch which we believe are important improvements to the Godot 3.2 experience (especially since we expect at least one year of development before 4.0 is released). Some of those features had already been partially implemented before the 3.2 release, but not merged to avoid delaying the release (any new feature involves new issues and a certain amount of time to improve and stabilize its implementation).

This brings us to [**Godot 3.2.2**](/download) released today, which includes a number of big new features that have been merged and tested over the past few months, on top of the usual batch of bug fixes, usability enhancements, documentation and translation updates.

[**Download Godot 3.2.2**](/download) now and read on about the changes in this update.

*Note: [Illustration credits](#credits) at the bottom of this page.*

## New features!

Among its more than 800 new commits, Godot 3.2.2 includes 5 major features:

#### C# support for the iOS platform

Thanks to our Mono/C# maintainer Ignacio ([neikeq](https://github.com/neikeq)) and the sponsorship of Microsoft, [**C# projects can now be exported to iOS**](/article/csharp-ios-signals-events). This nearly completes the platform support for C# projects in Godot (only UWP support is still missing).

iOS export templates are now included in the Mono build. Exporting C# projects to iOS should be done from macOS using the [classical workflow](http://docs.godotengine.org/en/3.2/getting_started/workflow/export/exporting_for_ios.html), and the scripts will be automatically compiled Ahead-of-Time (AOT) for iOS.

![DodgeTheCreepsCS on the iOS Simulator](/storage/app/media/mono/csharp_dodgethecreeps_ios_sim.png)
*The [Dodge The Creeps C#](https://github.com/godotengine/godot-demo-projects/tree/master/mono/dodge_the_creeps) demo running on the iOS Simulator.*

<a id="gles2-batching"></a>
#### 2D batching for the GLES2 renderer

While most rendering work was postponed for the 4.0 release with its new Vulkan-based renderer, our contributors [lawnjelly](https://github.com/lawnjelly) and Clay ([clayjohn](https://github.com/clayjohn)) decided to give some more attention to the `3.2` branch.

Among a wide array of bug fixes to the GLES2 and GLES3 renderer, they also designed and implemented a [**2D batching system for GLES2**](/article/gles2-renderer-optimization-2d-batching), which greatly optimizes the 2D rendering performance in many situations. This drastically reduces drawcall-related bottlenecks and can give massive gains in specific scenarios (drawing lots of sprites, big TileMaps, text rendering). It's not magical, and projects have to fulfill some conditions to benefit from it (and actually have a drawcall-related bottleneck). Lawnjelly and Clay are working on some documentation to help you make the best use of the new batching - it will soon be in the main docs, but until then you can refer to the [current draft](https://github.com/lawnjelly/Misc/blob/master/Batching/batching.md).

*Left is without batching, right is with. Can you spot the difference?*

![Benchmarks with and without batching](/storage/app/uploads/public/5e8/e4f/660/5e8e4f660d679955685206.jpg)
*Top: 10,000 Sprites with a randomized modulate and position.*<br />
*Bottom: 8 layers of a screen full of "A"s with two Sprites intermixed.*

<a id="android-plugins"></a>
#### Re-architecture of the Android plugin system

Godot 3.2 came with a brand new Android plugin system, and notably the possibility to build custom APKs from your project folder with any additional plugins/modules that your project needs.

Our Android maintainer Fredia ([m4gr3d](https://github.com/m4gr3d)) had done a lot of work back then to improve Juan's initial custom build system, which led him to notice many things that could be modernized to be better suited to the current Android ecosystem. Notably, he re-architectured the plugin system to leverage the [Android AAR library file format](https://developer.android.com/studio/projects/android-library#aar-contents), and allow the easy distribution and use of Android plugins using a custom `.gdap` metadata file.

This new plugin system is backward-incompatible with the 3.2/3.2.1 system, but both systems are kept functional in future releases of the 3.2.x branch. Since we previously did not version our Android plugin systems, this new one is now labelled `v1`, and is the starting point for the modern Godot Android ecosystem.

The [Android plugin documentation](https://docs.godotengine.org/en/3.2/tutorials/plugins/android/android_plugin.html) has been updated with instructions on how to write plugins for this new system. Porting existing 3.2 plugins should be fairly straightforward.

**Note:** In this process, the `GodotPaymentsV3` built-in Android module has been porting to an external, first-party [GodotGooglePlayBilling](https://github.com/godotengine/godot-google-play-billing) plugin thanks to [Timo](https://github.com/timoschwarzer). See the updated [Android in-app purchase docs](https://docs.godotengine.org/en/3.2/tutorials/platform/android_in_app_purchases.html) for a migration guide.

#### DTLS support and ENet integration

Our networking maintainer [Fabio](https://github.com/Faless) has been working for over a year on networking features and the HTML5 platform thanks to an [award from Mozilla](/article/godot-engine-awarded-50000-mozilla-open-source-support-program). Almost all of the networking improvements made their way into Godot 3.2, but [DTLS support and its ENet integration](/article/enet-dtls-encryption) came a bit close to the release date and was postponed to 3.2.2.

This is now included and ready to use! See the [dedicated devblog](/article/enet-dtls-encryption) for usage examples.

**Note:** We recently found out that Godot's `UDPServer` (and thus `DTLSServer`) [do not work on Windows](https://github.com/godotengine/godot/issues/39832). Fabio is working on a fix which should be included in Godot 3.2.3.

<a id="dangling-variant"></a>
#### Better handling of `Variant`s pointing to released `Object`s

Many Godot users working on bigger projects have run into issues linked to having a `Variant` pointing to an `Object` becoming a "dangling pointer" once the `Object` is released (e.g. with `free()`). Such pointer could be reported as valid even though the memory it points to was not, or worse, that memory could now hold a different object, leading to hard to debug situations.

Thanks to the work of Pedro ([RandomShaper](https://github.com/RandomShaper)), debug versions of Godot (e.g. when running in the editor, or exporting a debug build) will [properly handle such situations](https://github.com/godotengine/godot/pull/38119) and, when using the debugger, provide a clear error message so that the user code can be adapted to prevent the issue. Checks are currently not done in release builds for performance reasons, so make sure to handle those errors in debug builds before shipping a release build in production.

#### Updated and localized documentation

It's also worth noting that, while it's not included in the 3.2.2 build *per se*, the [**online documentation**](https://docs.godotengine.org/en/stable/) for Godot 3.2 has also seen hundreds of changes since the original 3.2 release, with a lot of new content and many updates to existing tutorials to match the 3.2 feature set.

Additionally, translators have been hard at work to [localize the online documentation](https://docs.godotengine.org/en/stable/), and we now have 100% complete documentation in [French](https://docs.godotengine.org/fr/stable/), as well as near complete versions in [Chinese (Simplified)](https://docs.godotengine.org/zh_CN/stable/), [Japanese](https://docs.godotengine.org/ja/stable/), and [Spanish](https://docs.godotengine.org/es/stable/). You can join the translation effort on [Weblate](https://hosted.weblate.org/projects/godot-engine/godot-docs/) and help bring high quality localized documentation to game developers all over the world!

A big thankyou to all the documentation and localization contributors!


## Other changes

The 3.2.2 release includes more than 800 commits from 140 contributors – thanks a ton to all of them for their work! Contributors fixed a wide range of issues (both new and older ones), as well as improving usability and documentation. Dozens more have been involved in [updating translations](https://hosted.weblate.org/projects/godot-engine/godot/) to make Godot 3.2.2 available in over 20 languages!

Consult the complete changelog ([sorted by authors](https://github.com/godotengine/godot-builds/releases/3.2.2/Godot_v3.2.2-stable_changelog_authors.txt) or by [reverse chronological order](https://downloads.tuxfamily.org/godotengine/3.2.2-Godot_v3.2.2-stable_changelog_chrono.txt)) for an exhaustive list of all changes.

Here's a hand-picked list of the some of the main changes in Godot 3.2.2:

- 2D: Expose the `cell_size` affecting `VisibilityNotifier2D` precision ([GH-38286](https://github.com/godotengine/godot/pull/38286)).
- 2D: Add `MODULATE` builtin to canvas item shaders ([GH-38432](https://github.com/godotengine/godot/pull/38432)).
- Android: Re-architecture of the Godot Android plugin ([GH-36336](https://github.com/godotengine/godot/pull/36336)).
- Android: Add signal support to Godot Android plugins ([GH-37305](https://github.com/godotengine/godot/pull/37305)).
- Android: Fix `LineEdit` virtual keyboard issues ([GH-38309](https://github.com/godotengine/godot/pull/38309)).
- Android: The `GodotPayments` plugin was moved to an external first-party plugin using the Google Play Billing library ([GH-39034](https://github.com/godotengine/godot/pull/39034)).
- AStar: Implements `estimate_cost`/`compute_cost` for AStar2D ([GH-37039](https://github.com/godotengine/godot/pull/37039)).
- AStar: Make `get_closest_point()` deterministic for equidistant points ([GH-39409](https://github.com/godotengine/godot/pull/39409)).
- Audio: Fix volume interpolation in positional audio nodes ([GH-37279](https://github.com/godotengine/godot/pull/37279)).
- C#: Add iOS support ([GH-36979](https://github.com/godotengine/godot/pull/36979)).
- C#: Sync csproj when files are changed from the FileSystem dock ([GH-37149](https://github.com/godotengine/godot/pull/37149)).
- C#: Replace uses of old Configuration and update old csprojs ([GH-36865](https://github.com/godotengine/godot/pull/36865)).
- C#: Allow debugging exported games ([GH-38115](https://github.com/godotengine/godot/pull/38115)).
- C#: Revert marshalling of IDictionary/IEnumerable implementing types ([GH-38141](https://github.com/godotengine/godot/pull/38141)).
- C#: Fix inherited scene not inheriting parent's exported properties ([GH-38638](https://github.com/godotengine/godot/pull/38638)).
- C#: Fix exported values not updated in the remote inspector ([GH-38940](https://github.com/godotengine/godot/pull/38940).
- Core: Ensure COWData does not always reallocate on resize ([GH-37373](https://github.com/godotengine/godot/pull/37373)).
- Core: Fix dangling Variants ([GH-38119](https://github.com/godotengine/godot/pull/38119)).
- Core: Fixed false positives in the culling system ([GH-37863](https://github.com/godotengine/godot/pull/37863)).
- Core: Fix leaks and crashes in `OAHashMap` ([GH-38828](https://github.com/godotengine/godot/pull/38828)).
- CSG: Various bug fixes ([GH-38011](https://github.com/godotengine/godot/pull/38011)).
- Debug: Add a suffix to the window title when running from a debug build ([GH-33148](https://github.com/godotengine/godot/pull/33148)).
- Editor: Add rotation widget to 3D viewport ([GH-33098](https://github.com/godotengine/godot/pull/33098)).
- Editor: Add editor freelook navigation scheme settings ([GH-37989](https://github.com/godotengine/godot/pull/37989)).
- Editor: Improved go-to definition (Ctrl + Click) in script editor ([GH-37293](https://github.com/godotengine/godot/pull/37293)).
- Editor: Account for file deletion and renaming in Export Presets ([GH-39434](https://github.com/godotengine/godot/pull/39434)).
- Editor: Allow duplicating files when holding Control ([GH-39307](https://github.com/godotengine/godot/pull/39307)).
- Files: Improve UX of drive letters ([GH-36639](https://github.com/godotengine/godot/pull/36639)).
- GDNative: Fix Variant size on 32-bit platforms ([GH-38799](https://github.com/godotengine/godot/pull/38799)).
- GDScript: Fix leaked objects when game ends with yields in progress ([GH-38288](https://github.com/godotengine/godot/pull/38288)).
- GDScript: Fix object leaks caused by unfulfilled yields ([GH-38482](https://github.com/godotengine/godot/pull/38482)).
- GDScript: Various bugs fixed in the parser.
- GLES2: Add 2D batch rendering across items ([GH-37349](https://github.com/godotengine/godot/pull/37349)).
- GLES2: Avoid unnecessary material rebind when using skeleton ([GH-37667](https://github.com/godotengine/godot/pull/37667)).
- GLES3: Add Nvidia `draw_rect` flickering workaround ([GH-38517](https://github.com/godotengine/godot/pull/38517)).
- GLES2/GLES3: Add support for OpenGL external textures ([GH-36342](https://github.com/godotengine/godot/pull/36342)).
- GLES2/GLES3: Reset texture flags after radiance map generation ([GH-37815](https://github.com/godotengine/godot/pull/37815)).
- HTML5: Implement audio buffer size calculation, should fix iOS Safari audio issues ([GH-38816](https://github.com/godotengine/godot/pull/38816)).
- HTML5: Switch key detection from `keyCode` to `code` ([GH-39298](https://github.com/godotengine/godot/pull/39298)).
- HTML5: Use 2-phase setup in JavaScript ([GH-39538](https://github.com/godotengine/godot/pull/39538)).
- Image: Fixing wrong blending rect methods ([GH-39200](https://github.com/godotengine/godot/pull/39200)).
- Image: Fix upscaling image with bilinear interpolation option specified ([GH-39617](https://github.com/godotengine/godot/pull/39617)).
- Import: Fix changing the import type of multiple files at once (regression fix) ([GH-37610](https://github.com/godotengine/godot/pull/37610)).
- Import: Respect 'mesh compression' editor import option in Assimp and glTF importers ([GH-39134](https://github.com/godotengine/godot/pull/39134)).
- Import: Add support for glTF lights ([GH-39428](https://github.com/godotengine/godot/pull/39428)).
- Input: Various fixes for touch pen input ([GH-37756](https://github.com/godotengine/godot/pull/37756), [GH-38439](https://github.com/godotengine/godot/pull/38439), [GH-38484](https://github.com/godotengine/godot/pull/38484)).
- Input: Fix joypad GUID conversion to match new SDL format on OSX and Windows ([GH-39060](https://github.com/godotengine/godot/pull/39060), [GH-39172](https://github.com/godotengine/godot/pull/39172))
- Input: Add keyboard layout enumeration / set / get functions ([GH-39502](https://github.com/godotengine/godot/pull/39502)).
- Language Server: Switch the GDScript LSP from WebSocket to TCP, compatible with more external editors ([GH-35864](https://github.com/godotengine/godot/pull/35864)).
- macOS: Ignore process serial number argument passed by macOS Gatekeeper ([GH-37719](https://github.com/godotengine/godot/pull/37719)).
- macOS: Enable signing of DMG and ZIP'ed exports ([GH-33447](https://github.com/godotengine/godot/pull/33447)).
- macOS: Fix exports losing executable permission when unzipped ([GH-39700](https://github.com/godotengine/godot/pull/39700)).
- Main: Improve the low processor mode sleep precision ([GH-36052](https://github.com/godotengine/godot/pull/36052)).
- Networking: DTLS support + optional ENet encryption ([GH-35091](https://github.com/godotengine/godot/pull/35091)).
- Object: Add `has_signal` method ([GH-33508](https://github.com/godotengine/godot/pull/33508)).
- Particles: Fix uninitialized memory in CPUParticles and CPUParticles2D ([GH-38346](https://github.com/godotengine/godot/pull/38346), [GH-38378](https://github.com/godotengine/godot/pull/38378)).
- Physics: Make soft body completely stiff to attachment point ([GH-36048](https://github.com/godotengine/godot/pull/36048)).
- Physics: Test collision mask before creating constraint pair in Godot physics broadphase 2D and 3D ([GH-39399](https://github.com/godotengine/godot/pull/39399)).
- Physics: Normalize up direction vector in `move_and_slide()` ([GH-39590](https://github.com/godotengine/godot/pull/39590)).
- RegEx: Enable Unicode support for RegEx class ([GH-39454](https://github.com/godotengine/godot/pull/39454)).
- RichTextLabel: Fix alignment bug with `[center]` and `[right]` tags ([GH-39164](https://github.com/godotengine/godot/pull/39164)).
- RichTextLabel: Add option to fit height to contents ([GH-33235](https://github.com/godotengine/godot/pull/33235)).
- Shaders: Add shader time scaling ([GH-38995](https://github.com/godotengine/godot/pull/38995)).
- Skeleton: Fix IK rotation issue ([GH-37272](https://github.com/godotengine/godot/pull/37272)).
- UWP: Renamed the "Windows Universal" export preset to "UWP", to avoid confusion ([GH-39678](https://github.com/godotengine/godot/pull/39678)).
- VR: Fix aspect ratio on HMD projection matrix ([GH-37601](https://github.com/godotengine/godot/pull/37601)).
- Windows: Make stack size on Windows match Linux and macOS ([GH-37115](https://github.com/godotengine/godot/pull/37115)).
- Windows: Fix certain characters being recognized as special keys when using the US international layout ([GH-38820](https://github.com/godotengine/godot/pull/38820)).
- Windows: Add tablet driver selection (WinTab, Windows Ink) ([GH-38875](https://github.com/godotengine/godot/pull/38875)).
- Windows: Fix quoting arguments with special characters in `OS.execute()` ([GH-38856](https://github.com/godotengine/godot/pull/38856)).
- Windows: Do not probe joypads if DirectInput cannot be initializer ([GH-39143](https://github.com/godotengine/godot/pull/39143)).
- Windows: Fix overflow condition with QueryPerformanceCounter ([GH-38958](https://github.com/godotengine/godot/pull/38958).
- API documentation updates.
- Editor translation updates.
- And many more bug fixes and usability enhancements all around the engine!

## Known incompatibilities

While we strive to preserve compatibility in the 3.2 branch, there's a lot of surface covered in a game engine and some bug fixes might have an impact on your projects if you somehow used a bug as a feature. Here's a list of known incompatibilities / changes that you might need to be aware of:

- Android: The `GodotPaymentsV3` built-in module was removed and replaced by a first-party `GodotGooglePlayBilling` plugin (see above for details).
- GDNative: The fix for Variant size on 32-bit platforms ([GH-38799](https://github.com/godotengine/godot/pull/38799)) might require that you rebuild your GDNative libraries using the latest `3.2` commit from [`godot_headers`](https://github.com/godotengine/godot_headers/tree/3.2).
- GDScript: The Language Server Protocol was switched from WebSocket to TCP, so third-party plugins using it should be updated to use TCP. Contact the plugin developers if this has not been done yet in preparation for Godot 3.2.2.
- GDScript: Shadowing local variables with the iterator of a `for` loop now raises an error (like it already did for `if` or `while` blocks, see [GH-39861](https://github.com/godotengine/godot/issues/39861)).
- macOS: A breaking regression was found post-release in the export workflow, which cause macOS ZIP archives to have invalid file permissions, and some unarchiving tools will mess them up. To fix it for now, use `unzip` on macOS or Linux to extract the ZIP, and then recreate it with your favorite ZIP tool. A fix will be released soon with Godot 3.2.3.
- Sliders: A `grabber_area_highlight` style was added [GH-37517](https://github.com/godotengine/godot/pull/37517), so projects made before 3.2.2 that use themed sliders may need to define a new style for `grabber_area_highlight` too to prevent falling back to the default style (see [GH-38103](https://github.com/godotengine/godot/issues/38103)).
- Windows: Per-pixel transparency no longer lets mouse events pass-through ([GH-39914](https://github.com/godotengine/godot/issues/39914). This change greatly improves performance and fixes compatibility with other platforms (Linux, macOS).

If you experience any unexpected behavior change in your projects after upgrading from a previous version to 3.2.2, please [file an issue on GitHub](https://github.com/godotengine/godot/issues).

-----

<a id="credits"></a>
*The illustration picture is from *[Oddventure](https://store.steampowered.com/app/1235710/Oddventure/?curator_clanid=41324400), *a charming pixel-art, lore-rich and turn-based crazy RPG set in a cursed fairytale world, inspired by the Mother series and Undertale, and developed by [Infamous Rabbit](https://twitter.com/erutnevddO). Wishlist it on [Steam](https://store.steampowered.com/app/1235710/Oddventure/?curator_clanid=41324400), and follow the development on Twitter! Check the demo on [itch.io](https://infamousrabbit.itch.io/oddventure), and stay tuned for an upcoming Kickstarter by following development on [Twitter](https://twitter.com/erutnevddO) and [@InfamousRibbit](https://twitter.com/InfamousRibbit).*

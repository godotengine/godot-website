---
title: "Maintenance release: Godot 2.0.2"
excerpt: "Features various bug fixes and editor usability improvements, notably in the script editor. This time, the official binaries are also built without OpenSSL and not compressed with UPX."
categories: ["release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/570/778/0a5/5707780a5a4e5946541256.png
date: 2016-04-08 00:00:00
---

**Edit (2016-04-11 20:44 CEST):** New binaries were uploaded for the 2.0.2 release to [include a late fix](https://github.com/godotengine/godot/commit/e8a0b2462b11528838ad5890f2146a84a9e70f93) for a bug causing a memory overflow on some platforms, notably iOS.

As mentioned in [an earlier announcement](article/updates-on-the-release-cycle-and-godot-2-0-1), while working on our future major version 2.1, we intend to provide maintenance releases every once in a while for the currently supported version (branch 2.0).

So one month after the release of Godot 2.0.1, [here's version 2.0.2](/download) with some non-critical bug fixes and some usability improvements. [Grab it now!](/download)

## Distribution changes

### OpenSSL temporarily disabled

Godot uses OpenSSL for HTTPS support in its networking API. For easier binary distribution, most official binaries were linked against an embedded copy of OpenSSL; however this one being somewhat old and thus vulnerable to various security issues, we chose to build the 2.0.2 binaries without OpenSSL support.

This is a temporary solution to work around the warnings you might be getting on Google Play or the Apple Store about security vulnerabilities in your binary. The better solution for future releases will be to update our embedded OpenSSL copy to the latest upstream release (cf. [issue 2780](https://github.com/godotengine/godot/issues/2780)).

If your game requires OpenSSL support, you can either:

- Keep using version 2.0.1 which was built with OpenSSL support
- Build binaries yourself with `openssl=builtin` (built-in version) or `openssl=yes` (system shared library)

### Uncompressed binaries

We used to compress official binaries with [UPX](http://upx.sourceforge.net), a nice tool that generates small binaries with little decompression overhead. However, this tool is unmaintained since 2013 and has only experimental support for 64-bit Windows, and no support for 64-bit OSX and some other platforms. It has also been known to cause various issues on Windows with antivirus software, and might be related to a couple other bugs.

So for this release, we decided to distribute uncompressed binaries and see how it goes. If you liked having small binaries to distribute, you can still use UPX yourself on your export templates or exported binaries; we will put together some documentation about which templates can be safely compressed, and how to do it (in the meantime you can refer to [UPX's website](http://upx.sourceforge.net) for instructions).

## Engine changes

The main highlights in this maintenance release are:

**Enhancements:**

- Add -r flag to adb install for keep app user data
- Add a `sleeping_state_changed` signal to RigidBody and RigidBody2D classes
- Add stop and delete buttons to sample library
- Added insert mode to text editor
- Added rotation/panning support for trackpads in 3D mode
- Bind Z key (without modifiers) to toggle wireframe in 3D view
- Expose `android/shutdown_adb_on_exit` parameter and default to true
- LineEdit/TextEdit: various improvements and fixes to copy, cut and paste behaviors
- Option to toggle line numbers
- Option to toggle tabulation drawing and configurable size
- Separate help pages from scripts by default
- Syntax highlighting for numbers, functions and member variables
- Syntax highlighting for selected words

**Bug fixes:**

- Fix crash when importing sub-scenes
- Fix crash when resizing ConcavePolygonShape2D segments
- Fix cursor getting locked on tree control if tree is cleared while modifying numerical element
- Fix editors panels, of the bottom panel, not resizing in some cases
- Fix errors when switching to a new scene with a spatial editor from a canvas editor
- Fix file dialog, of Particles2D plugin, showing "Error" icons
- Fix inconsistent file saving validation
- Fix `InputMap::action_erase_event()`
- OSX: Fix inverted horizontal scrolling
- **Hotfix (2016-04-11):** Use non-templated `nearest_power_of_2` (workaround for iOS out-of-memory crash)

See the [full changelog](https://github.com/godotengine/godot-builds/releases/2.0.2/Godot_v2.0.2_stable_changelog.txt) for more details, and head towards the [Download page](-download) to get it!

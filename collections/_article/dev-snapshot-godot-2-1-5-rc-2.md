---
title: "Dev snapshot: Godot 2.1.5 RC2"
excerpt: "Some love for the users of the old stable 2.1 branch: Godot 2.1.5 is still being worked on and we now have a second release candidate. If all goes well, the stable release should only be a few days away."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5b5/073/2f9/5b50732f9b7ce697339594.jpg
date: 2018-07-19 11:22:40
---

Yes, you read correctly: Godot 2.1.5 is still being worked on, four months after the [previous release candidate](/article/dev-snapshot-godot-2-1-5-rc-1) and close to one year after the [2.1.4 stable release](/article/maintenance-release-godot-2-1-4)!

I planned to release it much sooner, but 3.0 and its subsequent maintenance releases happened, and I could only dedicate a few hours every now and then to the old stable branch.

On top of that, I decided to wait for this RC2 to have a proper fix for the [Android placeholder permissions issue](/article/fixing-godot-games-published-google-play) that crept up on Google Play in May and affected many published 2.1 games. HP's [APK fixer tool](/article/godot-apk-fixer-tool) could already be used to fix those games, but I wanted 2.1.5 to export correct APKs out of the box. The proper fix was [merged a few days ago](https://github.com/godotengine/godot/pull/20082), so I'm now considering 2.1.5 ready to go stable.

## Download and test

This is the second release candidate for 2.1.5, and if all goes well, it should be the last. For this I will need the help of all 2.1.x users to test this release, use it to export your existing projects and check that there are no regressions from 2.1.4.

- [~~Downloads~~](https://github.com/godotengine/godot-builds/releases/2.1.5-rc2/)
- [~~Changelog~~](https://github.com/godotengine/godot-builds/releases/download/2.1.5-rc2/Godot_v2.1.5-rc2_changelog.txt)
- [General feedback issue](https://github.com/godotengine/godot/issues/20273) - you can collect your feedback on this RC build here, especially linking to other issues which might be open already but not fixed yet

Note that contrarily to 3.0 which can download the export templates for you automatically, with 2.1 you still need to [download the `.tpz` file](https://github.com/godotengine/godot-builds/releases/2.1.5-rc2/Godot_v2.1.5-rc2_export_templates.tpz) manually and use it to install templates within the editor.

## Why do we still do 2.1.x releases again?

As mentioned in a [previous blog post](/article/dev-snapshot-godot-2-1-5-beta-1), since Godot 3.0 requires OpenGL 3.3 on desktop and OpenGL ES 3.0 on mobile, some developers are sticking to the 2.1.x branch for now while waiting for Godot 3.1, which will bring support for OpenGL 2.1 and OpenGL ES 2.0 again.

Moreover, some developers started big projects with Godot 2.1 before Godot 3.0 was released, and it might not be worth it for them to port their project over to Godot 3 for the time being, due to the important amount of work required to port/rewrite non-trivial projects in Godot 3.

Finally, distribution platforms like Google Play or the Apple Store keep increasing their requirements in terms of target systems (to ~~force~~ encourage more users to move to newer, supported versions), so we need to provide new export templates that match those guidelines so that people can update their published games. Same story with ensuring that the embedded libraries that we're using don't have known security vulnerabilities.

## What's new in 2.1.5?

We'll go over the changes in detail in the stable release announcement (hopefully in a few days!), but in the meantime you can check the [complete changelog since 2.1.4](https://github.com/godotengine/godot-builds/releases/2.1.5-rc2/Godot_v2.1.5-rc2_changelog.txt). Here are some highlights:

- Android: APKs no longer include placeholder permissions that Google Play started complaining about
- Android: Minimum SDK raised to 18, target SDK raised to 27.
- Debug: New crash handler to generate backtraces when crashing on all desktop platforms (as in 3.0).
- Editor: Tons of improvements to the "Godot 2 to 3 converter" tool, which can now convert many more resources than the one in 2.1.4. It even has an option to tentatively convert your scripts and change things like `get_pos()` (2.1) to `get_position()` (3.0) automatically.
- Editor: Add class members overview in script editor.
- Editor: New contextual menu in FileSystem dock.
- Input: Hardware cursor support.
- Input: Multitouch support.
- iOS: Minimum SDK raised to 9.0, target SDK raised to 11.4.
- OSX: Exporting for macOS from a Mac now generates a .dmg package.
- Windows: New WASAPI audio driver (as in 3.0).
- Performance optimizations.
- Several crashes fixed, especially in Android backend.

That's just a quick selection going through the changelog, there were a lot more nice changes in the 450 commits made to the 2.1 branch since 2.1.4-stable!

Happy testing, and please report any (new) issue you may find!

*The illustration picture ([full size](/storage/app/uploads/public/5b5/073/2f9/5b50732f9b7ce697339594.jpg)) is from an upcoming Godot 2.1 game by [Kit9Studio](https://twitter.com/kit9studio) (composed of [Sini](https://twitter.com/thekattiapina) and [Jared](https://twitter.com/Avencherus)), *Gun-Toting Cats*. They helped a lot with testing the *2.1* branch and finding several bugs that are fixed in this RC2.*

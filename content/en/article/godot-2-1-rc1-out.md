---
title: "Godot 2.1 RC1 is out!"
excerpt: "Our first Release Candidate for Godot 2.1 is here! If you don't find enough bugs, this will be our final candidate, so better get testing!"
categories: ["pre-release"]
author: Juan Linietsky
image: /storage/app/uploads/public/62e/949/5ee/62e9495eee18d883052090.jpg
date: 2016-07-24 21:40:26
---

Our first release candidate is out! This means, if nothing important changes, that this build will become Godot 2.1.

Godot 2.1 continues to improve on the usability trend, taking care of several aspects that were left out of 2.0 due to time constraints. [Grab it now](/download) while you read on the list of new features below (short version!).

Same as in Beta, a quick and incomplete list of new features follows (a proper post will be written for the stable release):

* **New asset sharing platform**: Godot has a new platform for sharing assets between users. It's still rough, but it will improve with time. As of now there is almost no content to test it with, but we will upload some plugins and the demos there in the coming days.
* **New plugin API**: Downloaded assets can be used as plugins to extend the editor functionalities. Our first attempt at offering an API for this is still probably incomplete, so help us improve it with your feedback.
* **Support for dynamic fonts**: Load TTF and OTF font files directly into your projects. This aids enormously with internationalization.
* **Fully internationalized editor UI**: Godot can now be used in several languages and displays all unicode characters properly (including CJK). Right-to-left language support is still unimplemented though.
* **Editor visual customization**: Change font sizes or set custom fonts, set custom themes, etc.
* **Customizable keybindings**: Most keybindings can now be customized and there is a new binding editor in the editor settings.
* **Live script reloading**: Saved scripts in the editor will be reloaded in the running game automatically, and tool scripts will also be automatically reloaded.
* **Profiler & frame profiler**: Godot has a fully featured profiler (with graph plotting), which allows going back in time and see the performance numbers and most used functions frame by frame.
* **Remote scene inspector**: Inspect the scene tree of the running game live, including nodes and resources.
* **HiDPI/Retina support**: Godot detects high resolution monitors and offers the editor UI with native resolution. All Godot icons were redone in vector graphics for the occasion, thanks a lot to [@drjm](https://github.com/djrm) who did almost all of them!
* **Drag & drop support**: Godot now supports drag & drop editor-wide. Dragging assets from filesystem explorer to Godot will also open the relevant import dialogs.
* **Contextual menus**: Godot now also supports contextual menus where relevant.
* **Script editor usability improvements**: Incremental search, better highlighting, smart function matching in code-completion, etc.
* **Improved asset pipeline**: Automatic re-import and reload of assets and scenes when changed.
* **Improved thumbnailer**: Previews are updated in real-time, and thumbnails of resources will appear in the inspector.
* **New AnimatedSprite features**: Labelled animations, and the ability to play animations without an AnimationPlayer.

With these changes, Godot has become a true joy to use. [Please help us with testing](/download) so we can make sure 2.1 is a solid release! This is the time to [report your favorite bugs](https://github.com/godotengine/godot/issues/), or add a comment to existing ones so we give them more priority.

For the most adventurous, you can check the [complete git changelog](http://download.tuxfamily.org/godotengine/2.1-dev/rc1/Godot_v2.1_rc1_changelog_from_2.0.txt) of the more than 1,200 commits (excluding merge commits) that were done so far for this new release! If you've tried the betas already, you can also consult the (much shorter) [git changelog since the previous beta build](http://download.tuxfamily.org/godotengine/2.1-dev/rc1/Godot_v2.1_rc1_changelog_from_beta.txt).

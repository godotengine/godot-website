---
title: "Godot 2.1 reaches beta, ready for testing!"
excerpt: "After 5 months of development and more than 1,600 commits, we are pretty happy with the state of the upcoming 2.1 version, and therefore release a beta for the community to test and give feedback upon! This new releases had again an important focus on usability, making Godot a very convenient and pleasing engine to use!"
categories: ["pre-release"]
author: Juan Linietsky
image: /storage/app/uploads/public/578/568/145/5785681454bd4264168994.png
date: 2016-07-12 00:00:00
---

**Edit:** A new beta build has been published, [dated 2016-07-21](https://downloads.tuxfamily.org/godotengine/2.1-dev/20160721/). See the [changelog](https://downloads.tuxfamily.org/godotengine/2.1-dev/20160721/Godot_v2.1_beta_20160721_changelog.txt) since the 2016-07-12 build.

Today, after several months of hard work, we have reached a new milestone in the development of the upcoming version 2.1! We are now pretty happy with the feature set and the overall stability, and therefore provide [beta binaries]({{% ref "download" %}}) for you to test and [report issues/suggest improvements](https://github.com/godotengine/godot/issues).

Godot 2.1 continues to improve on the usability trend, taking care of several aspects that were left out of 2.0 due to time constraints. [Grab it now]({{% ref "download" %}}) while you read on the list of new features below (short version!).

![godot-2.1-jetpaca.png](/storage/app/uploads/public/578/55f/d52/57855fd52ff5b417284461.png)

A quick and incomplete list of new features follows (a proper post will be written for the stable release):

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

With these changes, Godot has become a true joy to use. [Please help us with testing]({{% ref "download" %}}) so we can make sure 2.1 is a solid release! This is the time to [report your favorite bugs](https://github.com/godotengine/godot/issues/), or add a comment to existing ones so we give them more priority.

For the most adventurous, you can check the [complete git changelog](http://download.tuxfamily.org/godotengine/2.1-dev/Godot_v2.1_beta_20160712_changelog.txt) of the more than 1,600 commits that were done so far for this new release!

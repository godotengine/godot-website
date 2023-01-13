---
title: "Godot web export progress report #2"
excerpt: "Godot is getting better export for the Web. While web technologies are not always suited to provide bleeding edge experiences, we do our best to let you exported game run as smoothly as possible on every platform."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5f4/8d5/175/5f48d51759192009283012.png
date: 2020-08-28 12:00:00
---

Howdy Godotters! It's time for a long overdue update on the status of the HTML5 export and the web version of Godot in general.

Many of the improvements made for the Web editor's [early prototype](/article/godot-editor-running-web-browser) have been merged in the `master` branch and backported to the `3.2` branch. Support for [`SceneTree.quit()`](https://docs.godotengine.org/en/stable/classes/class_scenetree.html#class-scenetree-method-quit) and drag and drop of files via the [`files_dropped`](https://docs.godotengine.org/en/stable/classes/class_scenetree.html#signals) signal are already in the upcoming 3.2.3 release.

The HTML5 export is also getting further improvements in the upcoming point releases:

- Support for low processor usage mode, and FPS limiting (via `Engine.target_fps`). This is especially useful for non-game apps.
- Better control over the audio buffer size, to allow customizing the trade-off between audio delay and glitches on low-end devices (via the `audio/output_latency` and `audio/mix_rate` options in project settings and their overrides).
- Better keyboard support (see [GH-39298](https://github.com/godotengine/godot/pull/39298)).
- Link time optimization (LTO) for exported games (smaller size, shorter load).

Along with these changes, I've been working to bring virtual keyboard support for the HTML5 export on mobile browsers. But this deserves a chapter of its own.

Virtual Keyboards support
---

Sadly, web technologies do not allow us to directly show virtual keyboards on mobile devices. Like most of the time, when it comes to the web, one must (*sigh*) rely on hacks.

To force the browser to show the keyboard, we need to rely on a hidden `<input>` (or `<textarea>` for multiline) HTML element. Additionally, we cannot detect keypresses, due to autocomplete, and the only reliable way to update the content of GUI elements is by listening for changes in the input or textarea element, which makes it very inefficient and "clunky" for long texts. Still, it should allow your users to put their name in the leaderboard ;-). This work is still not merged to `master` and will receive some further improvements.

There is no update to the prototype Web editor yet, but stay tuned for more as GDNative support is coming to web and that's a matter for the next blog post.

References
---

[Virtual keyboard](https://github.com/godotengine/godot/pull/41097)

[Fixed FPS support](https://github.com/godotengine/godot/pull/40052)

[3.2 backports](https://github.com/godotengine/godot/pull/39604)

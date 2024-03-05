---
title: "Web Editor PWA, easier HTML customizations, and faster load times!"
excerpt: "Godot on the Web is feeling more and more like native, getting performance improvements (20% faster load time), easier customizations, and more!"
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/605/23a/448/60523a448123d203397950.png
date: 2021-03-20 18:30:00
---

Howdy Godotters! Quite a lot happened since my [last update](https://godotengine.org/article/godot-web-progress-report-5). Beside working on the [custom HTML shell improvements](https://github.com/godotengine/godot-proposals/issues/2182), and the long awaited fixes for HiDPI/fullscreen, I took some time to make the [Web Editor](https://editor.godotengine.org) a Progressive Web App as requested by many users. While I was there, I took some more time to rework the loading process of the engine and make it load faster on the Web.

### Web Editor PWA

If you are not familiar with what a [PWA (Progressive Web App)](https://web.dev/progressive-web-apps/) is, you can think about it as a way to "install" a web page on your device.

In this context, "install" usually means **adding a shortcut** to the web page in the device desktop or application list, and allow **running it while offline**. This is great for Chromebook-like devices. Note that for offline support to work, you will need to start the project manager at least once before it can actually work offline.

In the future, offline support will also be extended to projects exported to HTML5, allowing your players to run your HTML5 projects even under unreliable network conditions. Stay tuned ;)

![Web Editor as a Progressive Web App](/storage/app/uploads/public/605/1f5/858/6051f5858bc8e696137524.png)

On top of that, most of the issues with HiDPI displays has been fixed in HTML5 exports in general (including the Web Editor). HiDPI support should now work like on native builds.

### Customizing the HTML shell

The default HTML template used when exporting projects for the Web has become increasingly complex over the years. While we tried to accomodate good defaults for all projects, this has become a problem for users that wants to customize the loading bar, the background image, etc.

To make things easier for developers, the HTML template format has been rewritten quite a bit. Unfortunately, this will break compatibility with previous versions if you where using a custom HTML shell. Since the feature was mostly unused because of how hard it was to maintain, and that further breakage would have been necessary anyway to support new features, I've decided to go ahead and do it for the `3.2.4`/`3.3` release which includes most of the new cool features.

Compared to the old template, the new template is easier to get started with:

{{< highlight html >}}

<!DOCTYPE html>
<html>
    <head>
        <title>My Template</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <canvas id="canvas"></canvas>
        <script src="$GODOT_URL"></script>
        <script>
            var engine = new Engine($GODOT_CONFIG);
            engine.startGame();
        </script>
    </body>
</html>

{{< /highlight >}}

The [documentation](https://docs.godotengine.org/en/latest/tutorials/platform/customizing_html5_shell.html) has been updated to give a full overview, along with an updated reference of the exposed [`Engine` JavaScript class](https://docs.godotengine.org/en/latest/tutorials/platform/html5_shell_classref.html).

For those who have been following previous updates, this was preliminary work needed for the now long awaited [JavaScript <-> Godot interface](https://github.com/godotengine/godot-proposals/issues/1852) which is coming soon™.

### Faster load times

The aforementioned JavaScript [`Engine`](https://docs.godotengine.org/en/latest/tutorials/platform/html5_shell_classref.html) class has been heavily refactored as a result of the HTML shell update, so while at it I also took the time to finally implement [`WebAssembly.instantiateStreaming`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/WebAssembly/instantiateStreaming) which allows the WebAssembly file (the engine web binary file) to be processed while it's being downloaded. This significantly improves load times, especially on low end devices and slow networks.

![Lighthouse comparison without (speed index: 8.2s) and with (speed index: 6.6s) instantiateStreaming](/storage/app/uploads/public/605/243/c34/605243c34eb6c496397184.png)

### Further work

There's actually much more to talk about since the new `3.3` release will also provide an improved `HTTPClient` class  and experimental virtual keyboard support on the Web. That's a matter for another blog post though, so stay tuned for more :)

### Reference

- [JavaScript documentation with `jsdoc`](https://github.com/godotengine/godot/pull/46446)
- [Easy HTML templates](https://github.com/godotengine/godot/pull/46200) and its [documentation](https://github.com/godotengine/godot-docs/pull/4748)
- [Make Web Editor a Progressive Web Application](https://github.com/godotengine/godot/pull/46797)
- [HiDPI Web Editor scaling](https://github.com/godotengine/godot/pull/45920)

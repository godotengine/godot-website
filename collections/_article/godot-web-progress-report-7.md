---
title: "Godot Web progress report #7: Virtual keyboard on the Web, better HTTPClient"
excerpt: "Experimental virtual keyboard support coming to Godot HTML5 exports, along with improved support to many HTTP-based APIs."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/607/199/55d/60719955d6579766750202.png
date: 2021-04-16 17:00:00
---

Howdy Godotters! It's time for another brief update on the status of Godot on the Web.

If you read through the [last post](https://godotengine.org/article/godot-web-progress-report-6), you already got the spoiler that Godot `3.3` is getting **experimental virtual keyboard support on the Web**. This has been a highly requested feature, but also a hard one to implement (as you might also guess by the fact that most engines, even famous ones, do not support that). It is still in experimental state, and comes with limitations, but should be enough to allow your users to insert their high-score name, or simple chat messages.

### Experimental virtual keybaord

But why is it so hard to implement? And what are the limitations?

Well, accessing the virtual keyboard directly is not possible with the current web standards. Web browsers pretty much only show this virtual keyboard when the user selects an `<input>` or `<textarea>` HTML element.

Additionally, the [standard](https://w3c.github.io/uievents/#interface-compositionevent) for handling `input method editor` (e.g. insertion via autocomplete) is still being drafted by the World Wide Web Consortium (W3C), and browser implementations for it are very inconsistent.

To provide basic VK support, we can only rely on what is currently available: using an `input`/`textarea` element, and reading its content when it changes. This is sub-optimal, because it forces us to clear Godot's `LineEdit`/`TextEdit` every time a character is inserted or removed via [`SceneTree._input_text`](https://docs.godotengine.org/en/stable/classes/class_mainloop.html#class-mainloop-method-input-text) (or the DisplayServer `input_text` callback in `4.0`).

For this reason, while `TextEdit` nodes are supported, you should limit them to small amounts of text (i.e. no (GD)scripting via the Web virtual keyboard yet).

![Experimental Virtual Keyboard - vertical](/storage/app/uploads/public/607/189/593/607189593f5f0909945700.png)

Zooming is not supported for now, so plan your LineEdit placement carefully:

![Experimental Virtual Keyboard - horizontal](/storage/app/uploads/public/607/18b/17d/60718b17dd7ec207537124.png)

While this is far from the best experience for the developer, it allows using the device virtual keyboard, with auto-completion, and corrections, and can be used for letting the user insert their nickname, email, etc.

Given its experimental state and limitations, virtual keyboard support must be enabled manually in the Export window:

![HTML5 Export Window](/storage/app/uploads/public/607/18d/382/60718d38288c7588365817.png)

Even implementing such a basic support took a great amount of time, testing different strategies across different browser, and trying to get a minimal implementation working. While I still don't feel like recommending it for your game in production, it could be a very good addition to one of your jam games. I hear the [Godot Wild Jam is up](https://godotwildjam.com/) ;)

Hopefully, not too long from now, we'll be able to do another iteration on this and add zoom support.

### HTTPClient improvements

Talking about more "production-grade" improvements, the [`HTTPClient`](https://docs.godotengine.org/en/stable/classes/class_httpclient.html) implementation on the Web has been rewritten using the [Fetch API](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API).

Tthis rewrite means you can now process chunks of the HTTP response before it completes like on native platforms, allowing the usage of APIs based on ["server-sent events"](https://developer.mozilla.org/en-US/docs/Web/API/Server-sent_events/Using_server-sent_events) which were traditionally handled on the web using the [`EventSource` API](https://developer.mozilla.org/en-US/docs/Web/API/EventSource) and is not exposed by Godot being specific to the web.

This means finally being able to use important endpoints of various internet APIs (Google's Firebase/Facebook/your own!) that rely on server-sent events. As an example, there is a good [Godot Firebase plugin](https://github.com/GodotNuts/GodotFirebase) which now works really well on the web. Kudos to its developers for helping me out in testing this improvement :)

### Future work

It's been a year since I started working on the Godot Web export, and I feel it's finally getting where we want to to be, a close-to-native experience.

There are still 2 important steps I want to take in that direction:

- Implement <abbr title="Progressive Web App">PWA</abbr> support for exported apps and games like we've done for the Web Editor.
- Finish the `Godot <-> JavaScript` interface that I started working on months ago, and it's not yet finished (but soon!).

As always... stay tuned for more!

### Reference work

- [Virtual Keybaord support](https://github.com/godotengine/godot/pull/46913) ([3.2](https://github.com/godotengine/godot/pull/46914))
- [Fetch API changes](https://github.com/godotengine/godot/pull/46728) ([fd76977](https://github.com/godotengine/godot/pull/46728/commits/fd7697718311338fa1d546ded4f8dc4a8a9ae8eb))

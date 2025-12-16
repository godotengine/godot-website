---
title: "Web Export in 4.3"
excerpt: "With single-threaded builds and sample playback, it's now easier than ever to export your game to the Web with Godot 4.3. And more!"
categories: ["progress-report"]
author: Adam Scott
image: /storage/blog/covers/progress-report-web-export-in-4-3.jpg
image_caption_title: "Catburglar"
image_caption_description: "An open source game by @JohnGabrielUK and his team"
date: 2024-05-15 13:15:00
---

Have you ever begun some type of work, and only after realized how little you actually knew? That happened to me during [the last <abbr title="Game Developers Conference">GDC</abbr>](https://godotengine.org/article/gdc-2024-retrospective/).

A few months ago, I took over [Fabio Alessandrelli's (@faless)](https://github.com/Faless/) responsibilities as [Web Platform Lead](https://godotengine.org/teams/#platforms) for Godot to reduce his task load and accelerate the pace at which our Web platform exports continue to improve.

I'm well used to the Web and its quirks. I began creating websites in <abbr title="Extensible Hypertext Markup Language">XHTML</abbr> and (vanilla) JavaScript, back in the days. Flash games were my jam! Enough so that I even worked for a video game studio as an ActionScript 3 developer in 2010. And I didn't really stop caring about the Web platform ever since.

Since then, Flash may have died, but online games didn't.

# The new situation
But what I realized at the <abbr title="Game Developers Conference">GDC</abbr> is that we're entering into a sort of Golden Age of Web games. Not only websites like [Poki](https://poki.com/) or [Crazy Games](https://www.crazygames.com/) are super popular, but big players are starting to integrate Web games into their services, such as
[Discord Activities](https://support.discord.com/hc/en-us/articles/4422142836759-Activities-on-Discord) or [YouTube Playables](https://www.youtube.com/playables). All these entities want developers to create games for their platform, and they are all asking how Godot can bring a first-class development experience to it.

# Godot 4.3
Making games for the Web using Godot 4.x still isn't as seamless as we would like it to be. Unfortunately serious revisions are needed to improve the experience to the extent that we want.

Godot 4.3 promises to be one of the best recent releases for Web exports. One of the biggest issues relating to this has been properly fixed: single-threaded exports.

## Single-threaded Web export

### Betting on the wrong horse
[`SharedArrayBuffer`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/SharedArrayBuffer)s were supposed to revolutionize the Web. And they did. That API permits to share memory between [Web Workers](https://developer.mozilla.org/en-US/docs/Web/API/Web_Workers_API/Using_web_workers) (which are the Web native "threads").

Unfortunately, we live in the same timeline that includes the [Spectre and Meltdown exploits](https://meltdownattack.com/).

The result of this is that [browsers greatly reduced where and how you can use that API](https://developer.chrome.com/blog/enabling-shared-array-buffer?hl=en). Namely, browsers nowadays require websites to be [cross-origin isolated](https://web.dev/coop-coep/). When isolated, it does unlock the potential of `SharedArrayBuffer`s, but at what cost?

At the cost of having the capacity to make remote calls to other websites. _Adieu_ game monetization. _Adieu_ interacting with an external API.

The issue is that during the development of Godot 4, we bet on the wrong horse: we went all-in with using threads with `SharedArrayBuffer`s. We thought it was mainly a question of [browser support](https://caniuse.com/sharedarraybuffer) (which took a step back due to the aforementioned security issues), so when all browsers finally shipped stable releases with `SharedArrayBuffer`, we streamlined everything around multi-threading.

But we underestimated the difficulty of configuring cross-origin isolated websites.

We know it has been a hurdle for a lot of users trying to publish their jam games on [itch.io](https://itch.io), which has an experimental `SharedArrayBuffer` option, but relying upon another feature ([`coep:credentialless`](https://caniuse.com/mdn-http_headers_cross-origin-embedder-policy_credentialless)) not supported by Safari or Firefox for Android).

Likewise, most Web games are being published on third-party publishing platforms where the game authors may not even be able to set the required headers for `SharedArrayBuffer` support.

### Backporting the single-threaded feature from Godot 3.x
At the end of the development of Godot 4.2, [the Foundation](https://godot.foundation/) tasked me to find a way to backport the ability to build Godot without using threads in order to export Godot games without the pesky <abbr title="Cross-Origin-Opener-Policy">COOP</abbr>/<abbr title="Cross-Origin-Embedder-Policy">COEP</abbr> headers.

This was not easy because 4.0 was made with threads in mind. It maybe explains why we were so hesitant to go ahead with this change. Fortunately, with the help of our thread guru [Pedro J. Estébanez (@RandomShaper)](https://github.com/RandomShaper), I was able to tame the beast and put back single-threaded builds.

[My <abbr title="Pull Request">PR</abbr>](https://github.com/godotengine/godot/pull/85939) was finally merged at the beginning of the Godot 4.3 development period.

![Web export thread support option](/storage/blog/progress-report-web-export-in-4-3/thread-support-export-option.webp)

It even had some unexpected benefits. Apple devices (macOS and iOS) were long known to have issues when playing Godot Web exports. Well, when you do export your game single-threaded, these issues fortunately disappear.

However, it came with a downside too: it introduced a new, virtually unsolvable bug:

The single-threaded build introduced garbles in the audio of games, making them unplayable on low-end machines such as laptops or phones, or high-end machines with high frame rates.

When I mean unplayable, I mean it. [Try it yourself.](https://adamscott.github.io/2d-platformer-demo-main-thread/){:target="_blank"} (Consider yourself lucky if it doesn't glitch out.)

_Please note: we know that there's some issues running Platformer 2D on Safari, namely the browser reloading the page complaining that "this webpage is using significant memory". We're currently investigating to fix this <abbr title="as soon as possible">ASAP</abbr>._

Yes. Web single-threaded audio stream playback with Godot 4.2 is that bad. It is marginally better on Godot 3.x, but the problem exists there as well.

## Sample playback to the rescue!
[Here comes my <abbr title="Pull Request">PR</abbr>](https://github.com/godotengine/godot/pull/91382) (not yet merged at the time of writing) for the rescue. [Here's the same demo without sound issues.](https://adamscott.github.io/2d-platformer-demo-main-thread-samples/){:target="_blank"}

### What are samples?
Using samples for games is not a novel idea. In fact, for a long time, it was the _de facto_ way to play sound and music on game consoles. As they didn't have the processing power to do the mixing on the CPU, you could send audio clips (hence the term "sample") to a special chip and tell it how and when to play them.

Since the audio chip was operating on its own, the sound would never lag nor glitch out if the game is lagging.

### (Re)introducing samples to Godot
When open sourced, the Godot engine offered two ways to emit audio: streams for music and samples for sounds.

![The long gone SampleLibrary resource and SamplePlayer2D node on Godot 2.1](/storage/blog/progress-report-web-export-in-4-3/sample-library.webp)

But when Godot 3 released, it was decided that samples support was not needed anymore. Game consoles nowadays ask developers to mix themselves the samples using the CPU. And for the Web, we could mix the audio using a dedicated thread, like other platforms since `SharedArrayBuffer`s exist.

This is why there's audio garbles in single-threaded builds (without my "fix"). Audio rendering is tied with the frame rate. And if it drops, there's not enough audio frames to fill out the buffer, hence the glitches.

What [my <abbr title="Pull Request">PR</abbr>](https://github.com/godotengine/godot/pull/85939) does is to reinstate sample playback. At least at the time of writing, for the Web platform only.

### Near seamless integration
From the get-go, it was something that we ruled out: we couldn't simply port how it was done in 2.1, we needed a more intuitive way.

Then, I hacked samples into stream. I more or less hijacked the streams API to insert samples support. Simple as that!

![AudioStreamPlayer playback type property](/storage/blog/progress-report-web-export-in-4-3/playback-type.webp)

`AudioStreamPlayer`, `AudioStreamPlayer2D`, and `AudioStreamPlayer3D` have a new "Playback Type" property which determines how these nodes will behave behind the scenes. You can choose between "Stream", "Sample", and "Default".

![Default playback type project settings](/storage/blog/progress-report-web-export-in-4-3/default-playback-type.webp)

Fortunately, "Default" uses the new default project settings value `audio/general/default_playback_type`, so on the Web, the project will use "Sample" and the rest of the platforms will keep using "Stream".

When an `AudioStreamPlayer` wants to play a sample, it will check if it's registered first. If not, it will register it before playing it. Please note that not all samples can be registered, as only static ones can be (wav, ogg vorbis, mp3).

![A way to register samples: `AudioServer.register_stream_as_sample()`](/storage/blog/progress-report-web-export-in-4-3/register-stream.webp)

On low-end devices, to make sure that they aren't encountering lag spikes when registering samples just before playing them, I recommend to register them manually while loading the level. You just have to call the new API `AudioServer.register_stream_as_sample()`.

Other than these details, your game should pretty much work as is on the Web, without the pesky crackling noise. But under the hood, the audio is handled in a completely different way. Kinda weird, isn't it?

#### Under the hood
If the API stays pretty much the same, we cannot say the same thing about how `AudioStreamPlayer`s, `AudioServer`, and `AudioDriver` work internally.

Usually, everything is set in place to mix streams of audio by small chunks, determined by the audio latency in the project settings. If the audio latency setting is set at 15ms, Godot will make sure to keep filled a memory buffer worth of 15ms of audio.

To do that, each cycle, the `AudioServer` will go through each audio stream. If it's active, it will mix the frames it needs to fill the buffer.

_Inside Godot, [servers are what's underneath most of the nodes](https://docs.godotengine.org/en/4.2/tutorials/performance/using_servers.html), logic-wise. The nodes explain what and how to do to the servers, which image to show, which sound to stop, which 3D model to load and where._

Now, if the audio stream is considered a "sample", the `AudioServer` will ignore it in the mixing phase. But each time, a sample is played or paused, it must call the `AudioDriver` (here, the `AudioDriverWeb`) to tell it what happened.


##### Web audio node chains
If a sample is added, a Web Audio node chain representing a sample will be added. If an audio bus is removed, a Web Audio node chain representing an audio bus will be removed.

Doing this permits some sort of one-to-one connection between the `AudioServer` state and the Web audio API, which makes it possible to recreate somewhat accurately the mixing happening on the Godot side with streams.

![A screenshot of Catburglar Web Audio nodes.](/storage/blog/progress-report-web-export-in-4-3/web-audio-schema.webp)

Here's an image showing the Web audio nodes of the intro scene of [Catburglar](https://johngabrieluk.itch.io/catburglar), the open-source game featured on the cover. It is where all the samples are getting mixed.

From the right to the left of that image, you have the destination node (the audio output), then the master bus (represented by a chain of nodes). Plugged to the master bus are the rest of the audio buses determined by the project. All the buses have multiple `GainNode`s to handle actual gain, solo and mute.

Then, you see a sample chain, with its weird splitter and merger nodes. This is where the magic happens.

Each cycle, for mixing the streams, Godot calculates the volume of each audio channel. As Godot supports up to 7.1 surround (5.1 surround on the Web), it must know how loud to actually play the stream in the left and right speaker, the center one, the <abbr title="Low-frequency effects">LFE</abbr>, and so on. All according to the volume,
position, and orientation of the node.

So, to handle all of that on the Web Audio side, we send those values to each channel, and it just works.

#### It works out-of-the-box
You want proof that it works out-of-the-box? Here's some projects that I just opened with my PR build and I exported them right away (using the single-threaded export option and using the (new) default project values).

| Game title | Single-threaded samples build | Project page |
| ---------- | :---------------------------: | :----------: |
| Truck Town | [Play](https://adamscott.github.io/truck-town-main-thread-samples/){:target="_blank"} | [Link](https://github.com/godotengine/godot-demo-projects/tree/master/3d/truck_town){:target="_blank"} |
| Platformer 2D | [Play](https://adamscott.github.io/2d-platformer-demo-main-thread-samples/){:target="_blank"} | [Link](https://github.com/godotengine/godot-demo-projects/tree/master/2d/platformer){:target="_blank"} |
| Dodge the Creeps 2D | [Play](https://adamscott.github.io/2d-dodge-the-creeps-demo-main-thread-samples){:target="_blank"} | [Link](https://github.com/godotengine/godot-demo-projects/tree/master/2d/dodge_the_creeps){:target="_blank"} |
| Platformer 3D | [Play](https://adamscott.github.io/3d-platformer-demo-main-thread-samples/){:target="_blank"} | [Link](https://github.com/godotengine/godot-demo-projects/tree/master/3d/platformer){:target="_blank"} |
| Catburglar | [Play](https://adamscott.github.io/catburglar-main-thread-samples/){:target="_blank"} | [Link](https://johngabrieluk.itch.io/catburglar){:target="_blank"} |

Many thanks to the awesome [Catburglar](https://johngabrieluk.itch.io/catburglar) team (John Gabriel, Jerico Landry, Kyveri, Sacha Feldman, and Carrie Drovdlic). Without this [open-source project](https://bitbucket.org/JohnGabrielUK/catburglar/), made for the [63rd](https://itch.io/jam/godot-wild-jam-63) [Godot Wild Jam](https://godotwildjam.com/), I wouldn't have solved as many bugs as I did. Please try it out! The audio work, in particular, sounds incredible.

### Here be dragons
Even if the odds are that sample playback will be a part of Godot 4.3 release, it was developed very quickly, and even if it works pretty well, if you ask me, it still is pretty much a prototype. But we can't just release Godot 4.3 without proper audio support for single-threaded releases.

So it has been decided that it should be treated as _experimental_. More work will be done before the release of Godot 4.4 in order to stabilize the API and how it works under the hood.

### Call to action
But even before thinking about Godot 4.4, I must call for your help! We need people to test out [the sample playback <abbr title="Pull Request">PR</abbr>](https://github.com/godotengine/godot/pull/85939) until the release.

If you encounter any issue while testing my PR or while testing out the single-threaded samples builds, please report them [here](https://github.com/godotengine/godot/pull/85939).

Finally, if you still intend to continue using threads on the Web platform, you can! And the next feature should aid you setup your game online.

## Easy <abbr title="Cross-Origin-Opener-Policy">COOP</abbr>-<abbr title="Cross-Origin-Embedder-Policy">COEP</abbr> <abbr title="Progressive Web App">PWA</abbr> for threaded builds
With this new feature, if you still need to export your game with thread support, you'll are able to activate the necessary <abbr title="Cross-Origin-Opener-Policy">COOP</abbr>/<abbr title="Cross-Origin-Embedder-Policy">COEP</abbr> headers without having to modify the server's header responses. You'll need to export your game as a Progressive Web App though.

![Ensure Cross-Origin Isolation Headers export option](/storage/blog/progress-report-web-export-in-4-3/ensure-cross-origin-isolation-headers.webp)

This is because this export option sets up the Service Worker, included with the <abbr title="Progressive Web App">PWA</abbr> build, to intercept the requests from the server and inject those missing <abbr title="Cross-Origin-Opener-Policy">COOP</abbr>-<abbr title="Cross-Origin-Embedder-Policy">COEP</abbr> headers.

## Boot splash screen
Just before the beta feature freeze deadline, [@patwork](https://github.com/patwork), a new [#web](https://chat.godotengine.org/channel/web) contributor,
included [some neat features](https://github.com/godotengine/godot/pull/91128):

He cleaned up the game page code and he updated the progress bar to use the semantic (and very useful) HTML `<progress>` tag.

But, mainly and from now on, he made the boot splash screen set in the project settings to be displayed on the screen while the engine and the assets are getting loaded by the browser.

![New Godot Web loading screen](/storage/blog/progress-report-web-export-in-4-3/loading-screen.gif)

If no boot splash screen has been set, the classic Godot boot splash will be seen, as it is currently displayed on other platforms.

# Next steps
Don't worry, these changes only mark the beginning for the Godot Engine to truly offer game developers a great and reliable way to create Web games.

So work will be done to finalize and stabilize the samples playback for the Web. In the future, the node chain system should be powerful enough to support audio effects on buses, so we intend to work on this too.

Based on the feedback we received at the <abbr title="Game Developers Conference">GDC</abbr> from partners and friends, we know that we need a way to reduce the size of our exports. Currently, the 4.3 release Web build .wasm is around 40 MB uncompressed, and 5 MB compressed with Brotli. We have a few ideas in mind to address this, and it could even help optimize builds for other platforms!

If you know C/C++, you're familiar with the Web APIs and you feel contributing, don't hesitate to join our [#web team](https://chat.godotengine.org/channel/web) on the
[Godot Engine developers chat](https://chat.godotengine.org).

# Support
Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/).

A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by the [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

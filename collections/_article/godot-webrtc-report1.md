---
title: "WebRTC support, progress report #1"
excerpt: "Godot is getting some WebRTC love! Experimental support is available in current master branch, enabling low latency networking in HTML5/WebAssembly exports, and initial desktop platforms support via GDNative. The API is still experimental but will become stable in the next few months."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5cb/9e2/b60/5cb9e2b60bf06285510736.png
date: 2019-04-19 14:53:33
---

## Presentations

Hello Godotters, my name is Fabio Alessandrelli, you may know me by my handle fales ([faless](https://github.com/Faless) on GitHub). Here are a few words about my Godot journey.

I first discovered Godot in 2015 while looking for a good game engine (that would also work on GNU/Linux) to develop a small game for a university project with a friend.

It was the early era of Godot 1.0, which was open sourced just few months before.

It was love at first sight, and since then, I slowly started contributing to its development, proposing small PRs whenever I found something that was missing or not working and I had the time to fix, learning a lot in the process.

Finally, I started specializing in the networking subsystem (again, because I needed it for my projects). I slowly became the “network guy”, so if your networking PR or issue is stalling, yes, it's my fault, I'll try to review them soon™.

## On HTML5, WebSockets, WebRTC

One of the thing that struck me after some time playing with Godot, was how easily it enables developers to export for different platforms, and among those, **HTML5/WebAssembly** (thanks to the great effort of many developers, especially eska, the current HTML5 platform maintainer). Enabling developers to share their beautiful **games running in browsers** is a great feature for an engine!

Networking trough browsers used to be very limited and originally only **HTTP requests** were possible.

### Websocket

Then, in December 2011, the **WebSocket protocol** was standardized, allowing browsers to create **bidirectional** channels to a WebSocket server. The protocol is pretty simple, it begins with an HTTP request from the browser with some protocol specific headers. From there, if the server accepts the connection (replying with similar headers), the connection is kept open, and data begins to flow bidirectionally using the quite **simple protocol** message format.

That though, wasn't enough. WebSockets still uses a **TCP connection**, which is **good for reliability but not for latency**, rendering it useless for real-time applications (e.g. VoIP, fast-paced real-time games).

### WebRTC

For this reason, since 2010, Google started working on a new technology called **WebRTC**, which later on, in 2017, became a **W3C candidate recommendation** (i.e. it's considered quite stable but it's still being worked on).
WebRTC is a **much more complex** set of specifications and API, and uses a lot of other technology underneath (ICE, DTLS, SDP), to provide fast, real-time, and secure communication between two peers.

The idea, is to **find the fastest route** between the two peers and establish whenever possible a **direct communication** (as in try to avoid a relaying server).

This **comes at a price** though, and the price is that some media information must be exchanged between the two peers before the communication can start (in the form of Session Description Protocol – SDP strings). This usually takes the form of a so-called WebRTC Signaling Server.

![signaling_simple.png](/storage/app/uploads/public/5ca/d20/5ae/5cad205ae8405844580807.png)

A signaling server (for example a WebSocket server) to which peers connects and send their media information. The server then relays those information to other peers, allowing them to establish the desired direct communication. Once this step is done, peers can disconnect from the signaling server and keep the direct P2P connection open.

---

## Current work on supporting WebRTC in Godot

During the last month, I've spent most of my time (paid by the Software Freedom Conservancy thanks to [a grant by Mozilla Foundation](/article/mozilla-awards-godot-engine-part-moss-mission-partners-program)) working on a WebRTC implementation for Godot Engine. Part of the work, was already done by Brandon Makin during [GSoC 2018](/article/gsoc-2018-progress-report-1).

I focused on getting the Javascript version ready, and porting the work of Brandon Makin to GDNative (to support WebRTC in native exports, without having to bundle the huge WebRTC Native Code reference library into Godot sources).
So, while the WebAssembly export will have WebRTC support out of the box, native exports (e.g. GNU/Linux, Windows, macOS, Android, etc.) will need a GDNative library to work.

This is done by having a WebRTCGDNative class, which we then implement via GDNative, and will be released in a [separate repository](https://github.com/godotengine/webrtc-native).

### But how does this work?

Here are the Godot-exposed functions for the current state in my branch (yes, yes, I will document them, when the work is ready :) ):



![webrtc_docs.png](/storage/app/uploads/public/5cb/9c4/f57/5cb9c4f5719a8010547417.png)

NOTE: The API will slightly change to allow creating multiple data channels.

And here is a simple schema on how to use it:


![webrtc_example.png](/storage/app/uploads/public/5cb/9c5/1d2/5cb9c51d2b949452233794.png)

Wait, that doesn't look simple! Well, that's true, WebRTC has a fairly complex setup phase, but it can be boiled down to 4 steps:

1. The peer that wants to establish a new connection calls `create_offer()`.
   1. A new `offer_created` signal is emitted by that same WebRTC peer.
   2. The signal values need to be passed to `set_local_description`.
   3. The signal values need to also be passed to the remote peer, using any means desired (usually, the Signaling Server).
2. The remote peer will need to pass the received parameters (`type` and `sdp`) to its `WebRTCPeer` `set_remote_description`.
   1. This will generate an `offer_created` signal on that peer.
   2. The signal values need to be passed to `set_local_description`.
   3. The signal values need to also be passed to the peer that generated the offer in the first place.
3. The peer that originally generated the offer will pass the received parameters (i.e. the answer from the remote peer) to its own `WebRTCPeer` `set_remote_description`.
4. After calling `set_remote_description` on each peer, multiple `new_ice_candidate` events will be emitted.
   1. The values from those events needs to be sent to the other peer (again, via the signaling server).
   2. Each peer will then pass the candidates received from the signaling server to the `add_ice_candidate` function (i.e. each peer must pass to the function the candidate generated by the other peer).

After that, the connection will be established!

### Reference work

You will need a recent build of Godot's `master` branch:
https://github.com/godotengine/godot/tree/master

A compiled version of the WebRTC GDNative library is available at:

https://github.com/godotengine/webrtc-native/releases/tag/0.2

A small demo to test it can be found at:

https://github.com/Faless/webrtc-native-demo/releases/tag/0.2

The work on the reference WebRTC signaling server based on WebSocket is available at:

https://github.com/Faless/gd-webrtc-signalling

## Additional resources

### Websocket

RFC: https://tools.ietf.org/html/rfc6455

JS API: https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API

### WebRTC

W3C Recommendation: https://www.w3.org/TR/webrtc/

JS API: https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API

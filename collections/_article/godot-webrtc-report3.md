---
title: "WebRTC support, progress report #3"
excerpt: "WebRTC for the High Level Multiplayer API is here! Featuring a fully peer to peer mesh network. Documentation is now available for WebRTC classes, a tutorial and two new demos has been added."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5d0/a2c/54a/5d0a2c54aaced070739095.png
date: 2019-06-19 14:50:00
---

In the [last](https://godotengine.org/article/godot-webrtc-report2) two [reports](https://godotengine.org/article/godot-webrtc-report1) we laid out the basis for building a Godot application that uses WebRTC to communicate with other peers.

Now, the **WebRTC module got an interface to the High Level Multiplayer API**, so it can be used as a transport for **RPCs/RSETs**. The implementation is a **full p2p mesh**, meaning every player is connected with each other via a "direct" connection, and there is no need for a player to act as a server.

WebRTCMultiplayer
=================

![webrtc-multiplayer-docs.png](/storage/app/uploads/public/5d0/a2d/7ca/5d0a2d7caa88a877416904.png)

The **`WebRTCMultiplayer`** class interfaces WebRTC with the High Level Mulitplayer API. Due to the way WebRTC works, this class needs a **slightly more complex setup** before it can be used compared to other network peers, but as said it will **create a full p2p mesh** that is also **encrypted** at transport level. The idea, is that you will have a **[signaling server](http://docs.godotengine.org/en/latest/tutorials/networking/webrtc.html) assigning ids** to peers, and letting them know about each other.

To **setup** the multiplayer class one would need to:

- Call `initialize` with the id assigned by the signaling server.
- For each newly connected peer (as notified by the signaling server along with its id), create a new `WebRTCPeerConnection` and pass it with the given id to `add_remote_peer`. You can optionally add channels to it, but the first three (negotiated 1, 2, and 3) are reserved for the high level mutiplayer.
- Do the usual signaling procedure to exchange ICE candidates and session descriptions.

**Note 1**: You don't have to poll each `WebRTCPeerConnection` separately, just call `WebRTCMultiplayer.poll` and it will poll all connections added via `add_remote_peer`.

**Note 2** The `WebRTCMultiplayer` class does not fire `connection_succeded` and `server_disconnected` unless run in `server_compatibility` mode.

**Server compatibility mode** can be used to adapt games written using server/client architecture in mind (e.g. the ENet implementation). The connection will **still** be a **p2p mesh**, but one peer will be expected to have **id `1` (server)**, and all `peer_connected` signals will be suppressed until such a peer **connects**. When that happens, **`server_connected`** will be **emitted**, the connection state will be set to `CONNECTION_CONNECTED` and **then `peer_connected`** will be emitted **for each connected peer**.

You can **read more** about the `WebRTCMultiplayer` class in the [docs](http://docs.godotengine.org/en/latest/classes/class_webrtcmultiplayer.html).

WebRTC tutorials and demos
==========================

This blog post will be a bit shorter then the previous ones, but don't worry, there is much more reference material to learn from now!

You can find a [new WebRTC tutorial here](http://docs.godotengine.org/en/latest/tutorials/networking/webrtc.html) with two small examples.

Two new demos are available in the [godot demo repository](https://github.com/godotengine/godot-demo-projects/). The demos includes one with the two examples in the tutorial, and a **reference signaling server** using WebSocket, with two server implementations (GDScript, and **Node.js**) and two GDScript client implementation (raw, and **`WebRTCMultiplayer`**).

Documentation has been added for [WebRTCPeerConnection](http://docs.godotengine.org/en/latest/classes/class_webrtcpeerconnection.html), [WebRTCDataChannel](http://docs.godotengine.org/en/latest/classes/class_webrtcdatachannel.html), and the new [WebRTCMultiplayer](http://docs.godotengine.org/en/latest/classes/class_webrtcmultiplayer.html).

There is a port of the multiplayer bomber demo using the reference signaling server **[running live here](https://no-war.fales.me/)**. Have fun playing it with your friends (and/or studying its [source code]((https://github.com/Faless/bomber-rtc/))).

Future work
===========

Beside documenting the GDNative plugin build system and building binaries for macOS, the work on WebRTC is pretty much concluded for now, ready for the 3.2 release.

Future work in the network department includes **SSL server** support, basic [**Crypto**](https://github.com/godotengine/godot/pull/29871) support (generate keys, random bytes, certificates), **DTLS** support, built-in editor web server for **debugging HTML5** exported games, plus other neat features (in no particular order).

Stay tuned, for more Godot goodies, and as always, **thank you for your support**!
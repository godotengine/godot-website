---
title: "WebRTC support, progress report #2"
excerpt: "Godot's WebRTC interface is getting STUN/TURN support, and now allows you to create multiple reliable or unreliable data channels. WebRTC GDNative support for non-HTML5 platforms can now works as a drop-in library without any extra configuration. Some hints on incoming multiplayer support."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5ce/3e2/cdb/5ce3e2cdb9f4f320495518.png
date: 2019-05-21 13:30:00
---

In the [last report](https://godotengine.org/article/godot-webrtc-report1) we introduced WebRTC and the reasons why it's being added to the list of web standards (and thus to Godot). As mentioned there, the WebRTC protocol supports a wide variety of applications: from VoIP, to video streaming, to custom data transfers. The interface that allows you to send custom data is called a *data channel* and is now exposed in Godot via a new `WebRTCDataChannel` interface (more on that later).


## Data Channels

WebRTC **data channels** can be configured to either be reliable or unreliable (and optionally non-ordered).

The **reliable** data channels can be seen as a TCP connection (like WebSocket) so all your data is guaranteed to arrive at the destination in order. If you send too much data here, latency will grow, and the connection might be closed.

The **unreliable** data channels can be seen more as a form of "UDP connection" (it's actually SCTP beneath), meaning that not all the packets you send might arrive at the other destination, and they will only be retransmitted according to certain limits. By default, these channels are configured to be **ordered**, so packets are either received in order, or the are not received at all. The "ordered" feature can be **optionally disabled**, but a retransmission policy must be indicated in any case, specifying either the maximum number of retransmissions or a maximum packet lifetime (i.e. max time in milliseconds the channel will attempt a retransmission if not acknowledged).

## Godot implementation

During last month, I worked on introducing full data channels support to our WebRTC interface. This required, as mentioned, some **API changes**:

- `WebRTCPeer` was renamed to `WebRTCPeerConnection` and no longer is a `PacketPeer`, it only handles the connection.
- A **new `WebRTCDataChannel` interface** was added which inherits from `PacketPeer` to handle data transfer (so now each connection can have multiple channels).
- A new `WebRTCPeerConnection.create_data_channel` method was added to create a new `WebRTCDataChannel` for the given connection.
  The connection must be in `STATE_NEW` as specified by the standard, the data channel must have a label, and can be optionally configured ([see MDN docs for options](https://developer.mozilla.org/en-US/docs/Web/API/RTCPeerConnection/createDataChannel#RTCDataChannelInit_dictionary)).
- You now need to call `create_data_channel` at least once before calling `create_offer` (or the connection will have nothing to setup at all).
- `offer_created` was renamed to `session_description_created` and `new_ice_candidate` to `ice_candidate_created` to better fit Godot's signal naming.
- A new `data_channel_received` signal was added to receive in-band (not pre-negotiated) channels (if you don't store it, the channel will be closed).

Other features that were added includes:
- A new `WebRTCPeerConnection.initialize` method to create a new connection with the desired configuration provided as dictionary ([see MDN docs](https://developer.mozilla.org/en-US/docs/Web/API/RTCPeerConnection/RTCPeerConnection#RTCConfiguration_dictionary)). This allows **STUN/TURN configuration**.
- The WebRTC **GDNative plugin** (for desktop platforms) is now a singleton, and will be **loaded automatically** if dropped inside the project.


![pc_docs.png](/storage/app/uploads/public/5ce/2db/be6/5ce2dbbe6c5ab261586810.png)


![dc_docs.png](/storage/app/uploads/public/5ce/2db/c43/5ce2dbc43da44979393013.png)


## Reference work

[The PR this report is about](https://github.com/godotengine/godot/pull/28964). Merged! Fresh master builds will have all these new features.

The updated [GDNative plugin](https://github.com/godotengine/webrtc-native/releases/tag/0.3) that works as a drop-in plugin (need a recent build from master branch).

The updated [GDScript demo](https://github.com/Faless/webrtc-native-demo/releases/tag/0.3) that uses the new functionalities.

### We want goodies, where's the multiplayer?

I've spent some time to get the Multiplayer API running, but I feel that it still needs a finishing touch and it's not ready to be released yet. Additionally, this report was already overdue and I'm sorry about that.

For now I can tease you with the following image and [this small video](/storage/app/media/webrtc/multiplayer-teaser.webm) (forgive the screencast quality), while you wait a few weeks for another update.


![bomber-screen.png](/storage/app/uploads/public/5ce/3e2/980/5ce3e2980017d563652932.png)

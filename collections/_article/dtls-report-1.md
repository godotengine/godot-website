---
title: "DTLS progress report #1"
excerpt: "A sneak peak at DTLS support in Godot 4.0 ."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5db/87c/7eb/5db87c7eb83ec156927495.png
date: 2019-10-29 17:30:00
---

Hello Godotters, as part of my August work (sponsored, as always, [by Mozilla](https://godotengine.org/article/godot-engine-awarded-50000-mozilla-open-source-support-program)) I've been working on integrating DTLS in Godot.
Sadly, the work is not yet finished (although usable), and since it requires some API changes in `PacketPeerUDP` to make it performs well (avoiding extra buffering) it will be pushed to the `4.0` release.
But what is DTLS? Why is it important to have? And how will users benefit from it?

DTLS
====

DTLS stands for Datagram Transport Layer Security, you can think of it as TLS/SSL but for UDP packets.
This is very important, because it allows you to use transparent encryption in real-time applications (like fast-paced multiplayer games).

It prevents abusers from being able to disrupt your match by claiming to be some other players (which is not easy to do, and not always possible, but is something that needs to be considered when using UDP, and thus the `NetworkedMultiplayerENet` class).

It also allows you to validate that the user connects to the right server when you use a client/server architecture and thus prevent man-in-the-middle attacks (someone faking to be the server, that replay all the data to the real server, but can read/change everything you send).

DTLS in Godot
=============

This first part of the work adds three new classes:

- `UDPServer`: Yep, you got it right, a "server" for UDP. It's quite different from a `TCPServer`, keep reading for more.
- `DTLSServer`: This is a class used to keep the state for DTLS, specifically its cookies (again, keep reading for more).
- `PacketPeerDTLS`: The actual DTLS connection peer, that can be used as a regular packet peer (and will in the future be used by `NetworkedMultiplayerENet` to provide transparent encryption for the high level multiplayer).

UDPServer
---------

![dtls_udpserver.png](/storage/app/uploads/public/5db/874/2b0/5db8742b093d7752570350.png)

`UDPServer` can listen to a specific port/address and accept "connections" as soon as they arrive.
This can be achieved thanks to the fact that UDP can be, in a way, "connected" to a specific address.
It's not a connection like a TCP one (where you can potentially know if the other peer exists), this is more like a filter, that tells the operating system to ignore all the packets that do not come from a specific address. Each packet received from a new peer will result in a new connection, from that moment on, all the packets coming from the same source will be received by the "connected" peer and not the server.
Simply call `take_connection()` when `is_connection_available()` is true to get the connected `PacketPeerUDP`.

DTLSServer
----------

![dtls_dtlsserver.png](/storage/app/uploads/public/5db/874/3ca/5db8743ca7056849589724.png)

As mentioned, the `DTLSServer` class is used to store the DTLS state. DTLS must use a thing called cookies, to avoid amplification attacks.

In simple terms, for the way UDP works, anyone can send you UDP packets (without the need for a connection), and since one can fake its source (by spoofing, i.e. altering the source filed in the IP protocol), one can force a server to send the reply of the received packet to a different address than the original sender. This is very bad when a protocol has the reply message which is much bigger than the original packet, as this will allow a simple client with low bandwidth to amplify their bandwidth capabilities by exploiting the server.

Imagine this:
- `A` has limited bandwidth of 1 Mb/s.
- `A` sends a spoofed packet (masquerading as `B`) to the server `Z` (which has a bandwidth of 100Mb/s).
- The server `Z` sends the reply to `B`, but the reply is much bigger (e.g. 10 times bigger) than the data sent by `A`.
- Thus `A` can, with its 1 Mb/s, force server `Z` to flood `B` of packets with a 10 Mb/s bandwidth (1 Mb/s from `A` times 10 for the reply size).

To avoid this, DTLS uses cookies. When the client sends data for the first time to the server, the server will reply with a smaller packet that assigns it a cookie (e.g. a random number) and stores the cookie/client association in a state.

Only when the clients sends their requests with the received cookie, will the server start to send bigger packets.

This way, when `A` sends the spoofed packet, it will not receive the cookie (which `B` will receive instead) and will not be able to amplify its bandwidth exploiting `Z` (since the cookie packet is smaller than the packet sent by `A`).

If this seems a bit confusing, it's because it's actually a pretty twisted kind of attack. But you don't have to worry about it, because the `DTLSServer` class does the job for you :)

This class has 2 interesting methods: `setup`, to generate the state (and where you set the RSA key and certificate), and `take_connection` that accepts a connected PacketPeerUDP (from `UDPServer`) and will return a `PacketPeerDTLS` in the "connecting" state when the cookie is correct, or in the "error" state when the cookie is missing or not known.

PacketPeerDLTS
--------------

![dtls_packetpeerdtls.png](/storage/app/uploads/public/5db/874/4be/5db8744be52f4536086078.png)

`PacketPeerDTLS` is the core class of the whole DTLS implementation in Godot, the one that provides access to the actual data transfer functionalities.

There are two ways of getting a working `PacketPeerDLTS`:

1. Use `DTLSServer` as explained above.
2. Call `connect_to_host` on a `PacketPeerUDP` and then pass it to the `PacketPeerDTLS.connect_to_peer`.

Remember to call `PacketPeerDTLS.poll` frequently, and at some point it will reach the "connected" state. At that point, you can start transfer data and it will be automatically encrypted.

Consideration, further work
---------------------------

First of all, I'm sorry it took me so long to publish this report. It has been a crazy few months between the upcoming `3.2` release, the Godot Sprint, GodotCon, and the nerd flu that got us there.

I had stopped working on this feature to focus on improvements and fixes for `3.2` but I will get on it again in the coming month (November) working on the integration with `NetworkedMultiplayerENet` so that the high level multiplayer can benefit from this technology.

Stay tuned for more on DTLS, and for the report on September/October work (some merged already, some still in the process of being merged).

I will try to speed up my reporting capabilities ;-)

References
----------

[DTLS work done so far](https://github.com/godotengine/godot/tree/dtls_report1)

[Small project to demo/test the work done so far](https://github.com/Faless/gd-udp-dtls-example)

[Wiki on amplification attacks](https://en.wikipedia.org/wiki/Denial-of-service_attack#Amplification)

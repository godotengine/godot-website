---
title: "WebSocket updates, UDP multicast"
excerpt: "UDP multicast support, WebSocket updates, demos, a new tutorial."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5d5/ea9/151/5d5ea9151801b115754281.png
date: 2019-08-22 14:00:00
---

In effort to better Godot's networking, two main changes were worked on in June and are now merged in the current master branch:

- The third party library used to implement WebSocket in non web export has been changed.
- `PacketPeerUDP` multicast support has been added.

WebSocket update
================

Third-party library change
--------------------------

In an effort to make Godot's WebSocket implementation more portable, maintainable and lightweight we recently swtiched from [libwebsocket](https://libwebsockets.org/) to [wslay](https://tatsuhiro-t.github.io/wslay/).

This new library allows us to use our own networking classes, making it more portable across different platforms, and solving some long lasting problems we had with the previous library, while also decreasing the overall code size.

More details are provided in the [merged pull request](https://github.com/godotengine/godot/pull/30263).

If you are using WebSocket in your project please try out these changes and report any issue you might encounter.

WebSocket tutorial and demos
----------------------------

A new WebSocket tutorial and three new WebSocket demos (minimal, chat, multiplayer) have been added to Godot's [documentation](http://docs.godotengine.org/en/latest/tutorials/networking/websocket.html) and [demo projects](https://github.com/godotengine/godot-demo-projects/pull/343).

UDP multicast
=============

Multicast support is finally coming for `PacketPeerUDP`, this is useful for network discovery (e.g. finding LAN peers, servers, etc.). See the documentation for [`join_multicast_group`](https://docs.godotengine.org/en/latest/classes/class_packetpeerudp.html#class-packetpeerudp-method-join-multicast-group) and [`leave_multicast_group`](https://docs.godotengine.org/en/latest/classes/class_packetpeerudp.html#class-packetpeerudp-method-leave-multicast-group).

Along with this change, it is now also possible to get more information about the network interfaces of the machine on which Godot is running via the new [`IP.get_local_interfaces()`](https://docs.godotengine.org/en/latest/classes/class_ip.html#class-ip-method-get-local-interfaces) function.

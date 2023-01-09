---
title: "Multiplayer in Godot 4.0: ENet wrappers, WebRTC"
excerpt: "A more powerful ENet interface for better multiplayer in Godot 4, updates about WebRTC, hints at the new scene replication API."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/617/989/cf8/617989cf82e64600038831.png
date: 2021-10-27 18:30:00
---

Howdy Godotters! Time for yet another status update on networking in Godot.

This time, we are going to dig a bit deeper into the low-level territory, showing some of the new ENet features exposed in Godot 4, and the effort of bringing WebRTC on all Godot-supported platforms.

*See other articles in this Godot 4.0 networking series:*

1. [Multiplayer in Godot 4.0: On servers, RSETs and state updates](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-1)
2. [Multiplayer in Godot 4.0: RPC syntax, channels, ordering](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-2)
3. (you are here) [Multiplayer in Godot 4.0: ENet wrappers, WebRTC](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-3)
4. [Multiplayer in Godot 4.0: Scene Replication (part 1)](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-4)

Lower-level ENet
---

First of all, many users wanted to access some ENet-specific features (e.g. getting the round-trip time, pinging, setting timeouts, bandwidth limits, etc), and some wanted to simply use ENet without the higher-level multiplayer abstraction of Godot.

For this reason, we re-organized the old `NetworkedMultiplayerENet` (now renamed to `ENetMultiplayerPeer`) as an easy interface for the high-level multiplayer API, and implemented two lower level wrappers around ENet functions, exposing most of the library functionalities, one for the [enet host](http://enet.bespin.org/group__host.html) (`ENetConnection`) and one for the [enet peer](http://enet.bespin.org/group__peer.html) (`ENetPacketPeer`).

```gdscript
var enet = ENetMultiplayerPeer.new()

func create_server(port):
	# Create server is as simple as before.
	enet.create_server(port)
	# Optional DTLS is now moved the ENetConnection interface.
	enet.get_host().dtls_server_setup(
	    load("res://priv.key"),
	    load("res://cert.crt")
	)
	multiplayer.set_network_peer(enet)
```

You can access the underlying `ENetConnection` (enet host) via the `get_host()` function.

```gdscript
func set_peers_timeout():
	for id in multipler.get_multiplayer_peers():
		enet.get_peer(id).set_timeout(1000, 3000, 5000)
```

And retrieve a connected `ENetPacketPeer` (enet peer) via the `get_peer(id)` method.

```gdscript
func get_peer_latency(id):
    var peer = enet.get_peer(id)
    return peer.get_statistic(ENetPacketPeer.PEER_ROUND_TRIP_TIME)
```

Most of ENet's generated statistics like average latency, packet loss, etc., are also now exposed via the `ENetPacketPeer.get_statistic` and `ENetConnect.pop_statistic` methods.



![ENetConnection reference](/storage/app/uploads/public/617/985/a4a/617985a4a2bfb846798104.png)



![ENetPacketPeer reference](/storage/app/uploads/public/617/985/b28/617985b28dc3d255167102.png)


ENet mesh networking
---

One of the additions to the `ENetMultiplayer` is the possibility to create a mesh network, i.e., a network when all peers are connected to each other, without a central server that connects them all.

Setting up mesh networks is a bit more complex since it requires a [signaling server like WebRTC](https://docs.godotengine.org/en/stable/tutorials/networking/webrtc.html) and some form of port forwarding, either manual, or automatic like [UPNP](https://docs.godotengine.org/en/stable/classes/class_upnp.html) or [STUN](https://github.com/godotengine/godot-proposals/issues/434).

The advantage of mesh networking over the traditional client/server architecture is that it does not rely on "game servers" drastically reducing the infrastrucutre required for non-competitive or co-op matches, while maintaining fair bandwidth requirements among the peers.

```gdscript
const BASE_PORT = 4333

var mesh_hosts := {}
var enet := ENetMultiplayerPeer.new()


func create_mesh(my_id : int, peers : Dictionary):
	# This initialize the mesh with my_id as the unique multiplayer ID.
	enet.create_mesh(my_id)
	multiplayer.set_multiplayer_peer(enet)
	# "peers" is a dictionary containing the remote peer ID as the key,
	# and the remote address and the value. It also contains our own ID.
	# We want to assign a port for every remote peer, and make sure that
	# the remote peer knows what port we open for it.
	var idpos = peers.keys().find(my_id)
	var port_index = 0
	for id in peers:
		port_index += 1
		if id == my_id:
			continue
		var conn = ENetConnection.new()
		var port = BASE_PORT + ((port_index + idpos) % peers.size())
		if id < my_id:
			conn.create_host_bound("*", port, 1)
			print("Peer %d listening on %s:%d" % [id, peers[id], port])
		else:
			conn.create_host(1)
			conn.connect_to_host(peers[id], port)
			print("Peer %d connecting to %s:%d" % [id, peers[id], port])
		mesh_hosts[id] = conn

func _process(delta):
	for id in mesh_hosts:
		var host : ENetConnection = mesh_hosts[id]
		var ret = host.service()
		if ret[0] == host.EVENT_CONNECT:
				print("Adding host %d" % id)
				enet.add_mesh_peer(id, host)
				mesh_hosts.erase(id)
		elif ret[0] != host.EVENT_NONE:
				print("Mesh peer error %d" % id)
				mesh_hosts.erase(id)
	enet.poll()

func _peer_connected(id):
	print("Peer %d connected" % id)

func _ready():
	multiplayer.peer_connected.connect(self._peer_connected)
	# IDs, addresses, and ports, are usually obtained via a signaling server.
	# They are statically generated in this example.
	var ids = {}
	for i in range(2, 5):
		ids[i] = "127.0.0.1"
	# The first argument passed will be the desired ID.
	# E.g.: godot --path my_project -- 2
	for a in OS.get_cmdline_args():
		if a.is_valid_int() and ids.has(a.to_int()):
			create_mesh(a.to_int(), ids)
```

As you can see, setting up a network mesh is harder then setting up an ENet server and client, but it is now possible, and more examples will be added to the demos including a signaling server on the line of the [WebRTC one](https://github.com/godotengine/godot-demo-projects/tree/master/networking/webrtc_signaling).

WebRTC everywhere!
===

Speaking of WebRTC, back in July, we released an update to the [WebRTC native plugin](https://github.com/godotengine/webrtc-native/releases) to finally support all official Godot platforms. This release also updates the WebRTC library to a much newer version ([4472](https://webrtc.googlesource.com/src/+/refs/branch-heads/4472)).

The latest release is still **`3.x`-only**, but we plan to make a new one supporting Godot 4 soon, along with an update to the `3.x` version with some additional features.

Future work
===

Well, this was probably more boring than usual, but there are a lot of exciting news to talk about, including a new [scene replication system](https://github.com/godotengine/godot-proposals/issues/3459), along with the new GDExtension for low level network peers to better integrate third-party networking libraries.

So, as always, stay tuned for more!

Reference work
===

[Low level ENet wrappers, ENet meshes for multiplayer](https://github.com/godotengine/godot/pull/50710)

[webrtc-actions repository (WebRTC library automated builds)](https://github.com/godotengine/webrtc-actions/releases/tag/4472-33644-92ba70c)

[WebRTC plugin library update](https://github.com/godotengine/webrtc-native/pull/33)
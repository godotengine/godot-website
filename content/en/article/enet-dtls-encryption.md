---
title: "ENet with DTLS encryption in 4.0"
excerpt: "Easy ENet high-level-multiplayer encryption via DTLS is coming in Godot 4.0."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5e5/166/6a0/5e51666a0d8b2890019310.png
date: 2020-02-25 15:40:15
---

Hello Godotters, as part of my November work (sponsored, as always, by [Mozilla](/article/godot-engine-awarded-50000-mozilla-open-source-support-program)) I've been working on finalizing DTLS support I wrote about in a [previous report](/article/dtls-report-1), and implementing a custom ENet socket layer that uses it.

This allows for optional, transparent, easy-to-use encryption of the high level Multiplayer API when using the ENet peer (`NetworkedMultiplayerENet`). If you want to try these features in 3.2, and don't mind compiling the engine yourself, check out the end of this post.

DTLS support
============

DTLS support is now merged in the `master` branch. To know more about DTLS support in Godot 4.0 and DTLS in general you can read the [previous blog post on the subject](/article/dtls-report-1).

Additionally, documentation for all the new classes with small code samples has been added, the documentation is not yet synced with the online version, so here is a simple script (included in the docs) that shows how to make a DTLS server and client:

{{< highlight gdscript >}}

# server.gd
extends Node

var dtls := DTLSServer.new()
var server := UDPServer.new()
var peers = []

func _ready():
    server.listen(4242)
    var key = load("key.key") # Your private key.
    var cert = load("cert.crt") # Your X509 certificate.
    dtls.setup(key, cert)

func _process(_delta):
    while server.is_connection_available():
        var peer : PacketPeerUDP = server.take_connection()
        var dtls_peer : PacketPeerDTLS = dtls.take_connection(peer)
        if dtls_peer.get_status() != PacketPeerDTLS.STATUS_HANDSHAKING:
            continue # It is normal that 50% of the connections fails due to cookie exchange.
        print("Peer connected!")
        peers.append(dtls_peer)
    for p in peers:
        p.poll() # Must poll to update the state.
        if p.get_status() == PacketPeerDTLS.STATUS_CONNECTED:
            while p.get_available_packet_count() > 0:
                print("Received message from client: %s" % p.get_packet().get_string_from_utf8())
                p.put_packet("Hello DTLS client".to_utf8())

{{< /highlight >}}

{{< highlight gdscript >}}

# client.gd
extends Node

var dtls := PacketPeerDTLS.new()
var udp := PacketPeerUDP.new()
var connected = false

func _ready():
    udp.connect_to_host("127.0.0.1", 4242)
    dtls.connect_to_peer(udp, false) # Use true in production for certificate validation!

func _process(_delta):
    dtls.poll()
    if dtls.get_status() == PacketPeerDTLS.STATUS_CONNECTED:
        if !connected:
            # Try to contact server.
            dtls.put_packet("The answer is... 42!".to_utf8())
        while dtls.get_available_packet_count() > 0:
            print("Connected: %s" % dtls.get_packet().get_string_from_utf8())
            connected = true

{{< /highlight >}}

ENet DTLS support
=================

With the new DTLS interface laid out, our custom ENet implementation has been updated to optionally use it to wrap all the ENet packets. This meant a lot of work under the hood (which actually took me most of December too), but with a very pleasing result for the end user. Now, the only thing to do to enable DTLS encryption on the ENet peer is setting the `use_dtls` property to `true`, and calling `set_dtls_certificate()` with the appropriate server certificate (plus `set_dtls_key()` for servers).

{{< highlight gdscript >}}

extends Node

# Your DTLS server key (secret to the server).
var key = load("key.key")
# Your DTLS certificate (shared between server and clients).
var cert = load("cert.crt")

func start_server():
	var peer = NetworkedMultiplayerENet.new()
	peer.use_dtls = true
	peer.set_dtls_key(key)
	peer.set_dtls_certificate(cert)
	peer.create_server(8092)
	multiplayer.set_network_peer(peer)

func start_client():
	var peer = NetworkedMultiplayerENet.new()
	peer.use_dtls = true
	# Optionally disable this to skip certificate verification (unsecure).
	peer.dtls_verify = true
	peer.set_dtls_certificate(cert)
	peer.create_client("localhost", 8092)
	multiplayer.set_network_peer(peer)

{{< /highlight >}}

Here you can see a screenshot of the result of sending an RPC with and without DTLS enabled:


![View of non-encrypted and DTLS encrypted RPCs](/storage/app/uploads/public/5e5/164/7e8/5e51647e88bcd863421756.png)


Reference Work
==============

[The pull request for this work](https://github.com/godotengine/godot/pull/36296) (merged in `master`).

If you want to try the new DTLS features, and you don't mind compiling the engine, you can check out this [3.2 PR](https://github.com/godotengine/godot/pull/35091).

---
title: "WebSocket SSL server, HTTP server for testing HTML5 builds"
excerpt: "More networking improvements are coming in 3.2.
WebSocketServer now has SSL support, and users can now test HTML5 export from the editor with one click."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5de/044/c15/5de044c1559cf429683529.png
date: 2019-11-28 10:30:00
---

Hello Godotters, as part of my September work (sponsored, as always, by [Mozilla](https://godotengine.org/article/godot-engine-awarded-50000-mozilla-open-source-support-program)) I've been working on better documentation for the [Crypto](http://docs.godotengine.org/en/latest/classes/class_crypto.html) class, further improving WebSocket support, and an HTTP server integrated in the editor for testing out HTML5 export builds.

SSL for WebSocketServer
=======================

Thanks to the improvements to the WebSocket module over the previous months, SSL support has been added to the [`WebSocketServer`](http://docs.godotengine.org/en/latest/classes/class_websocketserver.html) class.

Setting both the `private_key` and `ssl_certificate` properties of a `WebSocketServer` will enable SSL.

Here is an example for creating a WebSocket server with a self-signed certificate:

{{< highlight gdscript >}}

extends Node

const PORT = 9080
var _server = WebSocketServer.new()

# (Test client)
var _client = WebSocketClient.new()

func _ready():
	# Create and set key and self-signed certificate.
	var crypto = Crypto.new()
	var key = crypto.generate_rsa(4096)
	var cert = crypto.generate_self_signed_certificate(key, "CN=localhost,O=myorganisation,C=IT")
	_server.private_key = key
	_server.ssl_certificate = cert

	# Start server.
	_server.connect("client_connected", self, "_connected")
	_server.listen(PORT)

	# (Test Client) Set our self signed certificated as trusted and connect.
	_client.trusted_ssl_certificate = cert
	_client.connect_to_url("wss://localhost:%d" % PORT)

func _process(delta):
	_server.poll()
	_client.poll()

func _connected(id, protocol):
	print("Client connected!")

{{< /highlight >}}

Check out the [`Crypto` class documentation](http://docs.godotengine.org/en/latest/classes/class_crypto.html) for more details on RSA key and certificate generation.

Running HTML5 export
====================

Godot has a cool feature that allows users to export for some plaftorms in debug mode and run the exported game directly on a connected device with the press of a button, as long as at least one [runnable export preset](https://docs.godotengine.org/en/latest/getting_started/workflow/export/exporting_projects.html) for that plafrom has been created.

![export.png](/storage/app/uploads/public/5de/044/edb/5de044edb1159008949448.png)

HTML5 exports, used to have this feature too, opening the exported HTML in the default browser directly from the file system. Since most browsers now no longer allow making async requests from a page loaded from `file://`, we added a minimal HTTP server to the editor to serve the exported HTML5 game.

This is also a very important step towards allowing users to profile HTML5 exported games via websocket connection. Stay tuned for more.

![http_server.png](/storage/app/uploads/public/5de/045/0f1/5de0450f18d4a943481630.png)

Reference work
==============

- [WebSocket improvements, SSL server, custom headers](https://github.com/godotengine/godot/pull/32683)
- [Implement HTTP server for HTML5 "run" export](https://github.com/godotengine/godot/pull/33001)
- [Add documentation for crypto-related classes](https://github.com/godotengine/godot/pull/32285)

---
title: "Basic cryptography, SSL improvements"
excerpt: "As part of the MOSS project sponsored by Mozilla, during July I worked on some new features regarding cryptography and SSL to improve the quality and security of Godot networking."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5d8/f4b/b0a/5d8f4bb0a3174096196968.png
date: 2019-09-28 12:15:00
---

As part of the MOSS project sponsored by Mozilla, during July I worked on some new features regarding cryptography and SSL to improve the quality and security of Godot networking.

Certificates and keys as resources
----------------------------------

SSL certificates (in the form of `*.crt` files) and private keys (in the form of `*.key` files) are now treated as resources in Godot. This means they will be exported automatically and they can be loaded via the GDScript `load()` function.

Crypto class
------------

A new [`Crypto`](http://docs.godotengine.org/en/latest/classes/class_crypto.html) class was introduced that allows to access some basic cryptographic functions.

- You can generate cryptographically secure random bytes via the `generate_random_bytes()` function. The bytes are returned in a `PoolByteArray`.
- You can generate RSA keys that can be used by `StreamPeerSSL` to act as a server.
- You can generate SSL self-signed certificates that again, can be used by `StreamPeerSSL` to act as a server.

Hashing Context
---------------

A new [`HashingContext`](http://docs.godotengine.org/en/latest/classes/class_hashingcontext.html) class now provides an interface for computing cryptographic hashes (MD5, SHA-1, SHA-256) over multiple iterations.

This is useful for example when computing hashes of big files (so you don't have to load them all in memory), network streams, and data streams in general (so you don't have to hold buffers). Here is an example of how it works:

```
const CHUNK_SIZE = 1024

func hash_file(path):
	var ctx = HashingContext.new()
	var file = File.new()
	# Start a SHA-256 context.
	ctx.start(HashingContext.HASH_SHA256)
	# Check that file exists.
	if not file.file_exists(path):
	    return
	# Open the file to hash.
	file.open(path, File.READ)
	# Update the context after reading each chunk.
	while not file.eof_reached():
	    ctx.update(file.get_buffer(CHUNK_SIZE))
	# Get the computed hash.
	var res = ctx.finish()
	# Print the result as hex string and array.
	printt(res.hex_encode(), Array(res))
```

SSL improvements
----------------

[`StreamPeerSSL`](http://docs.godotengine.org/en/latest/classes/class_streampeerssl.html) can now use a per-object SSL certificate (i.e. you no longer have to set the trusted certificates om project settings), you can specify the valid certificate by passing an `X509Certificate ` as last parameter in `connect_to_stream()`.

`StreamPeerSSL` can now act as a server. The new `accept_stream()` function, which accepts a private key, a certificate, and an optional CA chain, will try to establish a connection with the given stream acting as a server. This will soon also allow us to support acting as a WebSocket server over TLS.

Here is an example of a test HTTPS server made in GDScript... not meant to be used in production ;-)

```
extends Node

# A class that represents a client accepted by our server.
class Client extends Reference:
	# The SSL stream of this client.
	var ssl = StreamPeerSSL.new()
	# Received request.
	var recv = ""

	# Set the stream for this client.
	func set_stream(stream, key, cert):
		ssl.blocking_handshake = false
		ssl.accept_stream(stream, key, cert)

	# Process network operations for this client.
	func process():
		if ssl.get_status() == StreamPeerSSL.STATUS_HANDSHAKING:
			# Still performing handshake.
			ssl.poll()
			return
		if ssl.get_status() != StreamPeerSSL.STATUS_CONNECTED:
			# Disconnected.
			return
		ssl.poll()
		# Read available bytes.
		if ssl.get_available_bytes() > 0:
			recv += ssl.get_data(ssl.get_available_bytes())[1].get_string_from_utf8()
		# Send response if request is complete.
		if recv.ends_with("\r\n\r\n"):
			ssl.put_data(("HTTP/1.0 200 OK\r\nContent-Type: text/html\r\n\r\n" + \
						"<h2>Godot TLS Test Server</h2>\r\n" + \
						"<p>Successful connection using SSL</p>\r\n").to_utf8())
			ssl.disconnect_from_stream()

	func is_disconnected():
		return ssl.get_status() != StreamPeerSSL.STATUS_HANDSHAKING and \
		    ssl.get_status() != StreamPeerSSL.STATUS_CONNECTED

# Our TCP server.
var _server = TCP_Server.new()
# A list of connected clients.
var _clients = []

# Our private key and certificate.
var _key = null
var _cert = null

func _ready():
	var crypto = Crypto.new()
	# Generate an RSA key (this should be done in a thread to avoid blocking).
	_key = crypto.generate_rsa(4096)
	# Generate a self signed certificate to use with our server.
	_cert = crypto.generate_self_signed_certificate(_key, "CN=example.com,O=A Game Company,C=IT")
	# Start listening on "*:4343".
	_server.listen(4343)

func _process(delta):
	# Take new connections.
	if _server.is_connection_available():
		var c = Client.new()
		c.set_stream(_server.take_connection(), _key, _cert)
		_clients.append(c)

	# Take note of disconnected clients.
	var to_rem = []
	# Process clients and send response when done.
	for c in _clients:
		c.process()
		if c.is_disconnected():
			to_rem.append(c)

	# Remove disconnected clients.
	for c in to_rem:
		_clients.erase(c)
```

Future work
-----------

This has been quite a long work, and included some refactoring of the `core` code to use a single library for cryptography (mbedTLS) instead of multiple specific libraries for hashing algorithms and AES. This work will allow us to introduce support for AES encryption and more at scripting level in future versions.

Additionally, the SSL overhaul helped a lot in developing the upcoming DTLS implementation.

References
----------

- [PR refactoring the `core` crypto code](https://github.com/godotengine/godot/pull/30239)
- [PR adding Crypto class, Hashing contexts, SSL server](https://github.com/godotengine/godot/pull/29871)
- [PR adding documentation for above-mentioned additions](https://github.com/godotengine/godot/pull/32285)

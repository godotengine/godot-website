---
title: "Multiplayer in Godot 4.0: Scene Replication (part 1)"
excerpt: "The long-awaited first post about the multiplayer replication system in development for Godot 4.0 is here!
Check out the design goals, concepts, initial prototype, and as always, stay tuned for more!"
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/61a/27f/881/61a27f8816a4e934017559.png
date: 2021-11-27 19:00:00
---

Howdy Godotters!

It's finally time for the long-awaited post about the new multiplayer replication system that is being developed for Godot 4.0.
Below, we will introduce the concepts around which it was designed, the currently implemented prototype, and planned changes to make it more powerful and user-friendly.

*See other articles in this Godot 4.0 networking series:*

1. [Multiplayer in Godot 4.0: On servers, RSETs and state updates](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-1)
2. [Multiplayer in Godot 4.0: RPC syntax, channels, ordering](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-2)
3. [Multiplayer in Godot 4.0: ENet wrappers, WebRTC](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-3)
4. (you are here) [Multiplayer in Godot 4.0: Scene Replication (part 1)](https://godotengine.org/article/multiplayer-changes-godot-4-0-report-4)

## Design goals

Making multiplayer games has historically been a complex task, requiring ad-hoc optimizations and game-specific solutions. Still, two main concepts are almost ubiquitous in multiplayer games: some form of **messaging**, and some form of **state replication** (synchronization and reconciliation).

While Godot does provide a system for messaging (i.e. <abbr title="Remote Procedure Calls">RPC</abbr>), it does not provide a common system for replication.

In this sense, we had quite a few [#networking meetings](https://chat.godotengine.org/) in August 2021 to design a replication API that could be used for the common cases, while being extensible via plugins or custom code.

The design goals that emerged for such an API where:

- Provide an out-of-the-box solution for scene state replication across the network.
- Allow for (almost) no-code prototyping.
- Be extensible with game-specific behaviours (custom reconciliation, interpolation, interest management, etc).
- Allow ex-post (incremental) optimizations of network code.
- Be easy to use for game developers, of course :)

### Glossary

- `State`: The informations (properties) about an Object relevant to the multiplayer game.
- `Spawn`: Creating, or requesting remotely to create a new Object.
- `Sync`: Updating, or requesting remotely to update the state of an Object.

### Security

When dealing with computer networks, it's important to understand the security implication of transfering data across machines.
For instance, Godot does not allow [decoding objects](https://docs.godotengine.org/en/stable/classes/class_multiplayerapi.html#class-multiplayerapi-property-allow-object-decoding) by default, since they could carry scripts with them or force the receiving end to execute specific code during initialization. This is a security vulnerability, as arbitrary code execution of this kind would allow for servers to access or manipulate any file on the client's filesystem that the game process has access to.

In a similar way, the replication API will let you specify which scenes can be spawned by a remote peer. Tthe final implementation will also allow for fine-grained control over which node can be spawned at each specific path.

### Optimizations

Optimizations, and bandwidth optimizations in particular, are crucial to an effective networking protocol.

- Synchronizing multiple properties is very useful in the prototyping stage, but bad in terms of potential optimizations.
- A very quick way to optimize the network code later on is to replicate a single property that returns a tightly packed representation of the object state based on your game's unique characteristics.
  When done properly, this is also going to be the most optimized state possible that no tool can produce for you.
- The replication API will still try to squeeze the state size as much as possible with the information in its hands.

## Initial prototype

With this in mind, an initial prototype was developed and has been merged in Godot's `master` branch.
Please note that **the final implementation will be substantially different** in terms of exposed low-level API. Nonetheless, it will retain the same concepts and functionalities while adding more as we gather more feedback (jump to the next section for more information).

The initial prototype requires some wiring via GDScript, but **the final version will use visual configuration nodes** for better usability.

Without further ado, let's create our player:

```
# player.gd
extends CharacterBody2D

# The player name.
var player_name: String


func _ready():
	print("Player spawned. Name: %s, position: %s" % [player_name, position])


func _notification(what):
	if what == NOTIFICATION_PREDELETE:
		print("Player deleted. Name: %s" % player_name)
```

Now let's create our main scene, which configures the replication, and starts the networking:

```
# main.gd
extends Node

# The player scene (which we want to configure for replication).
const Player = preload("res://player.tscn")


func _ready():
	# Get the UID of the scene we want replicated.
	var id = ResourceLoader.get_resource_uid(Player.resource_path)
	# Configure the scene to be controlled by the server,
	# and which properties will be replicated during spawn.
	multiplayer.replicator.spawn_config(id, MultiplayerReplicator.REPLICATION_MODE_SERVER,
		[&"player_name", &"position"])
	# Configure the variables to be synchronized periodically
	# (every 16 milliseconds = 62.5 Hz).
	multiplayer.replicator.sync_config(id, 16, [&"position"])

	# Start the server if Godot is passed the "--server" argument,
	# and start a client otherwise.
	if "--server" in OS.get_cmdline_args():
		start_network(true)
	else:
		start_network(false)


func start_network(server: bool):
	var peer = ENetMultiplayerPeer.new()
	if server:
		# Listen to peer connections, and create new player for them
		multiplayer.peer_connected.connect(self.create_player)
		# Listen to peer disconnections, and destroy their players
		multiplayer.peer_disconnected.connect(self.destroy_player)
		peer.create_server(4242)
	else:
		peer.create_client("localhost", 4242)

	multiplayer.set_multiplayer_peer(peer)


func create_player(id):
	# Instantiate a new player for this client.
	var p = Player.instantiate()
	# Sets the player name (only sent during spawn).
	p.player_name = "Player %d" % id
	# Set a random position (sent on every replicator update).
	p.position = Vector2(randi() % 500, randi() % 500)
	# Add it to the "Players" node.
	# We give the new Node a name for easy retrieval, but that's not necessary.
	p.name = str(id)
	$Players.add_child(p)

func destroy_player(id):
	# Delete this peer's node.
	$Players.get_node(str(id)).queue_free()
```

With this configuration, each new client that connects will cause the server to instantiate a new player for it.

Note that the client code doesn't "instantiates" the scene explicitly. However, since the scene is marked for replication, when the server adds the scene to the SceneTree, it automatically sends that information remotely. Each connected client will then instantiate the scene automatically, adding it to the proper path and setting the values configured via `multiplayer.replicator.spawn_config` (`position` and `player_name` in this example).

Additinally, the server automatically keeps track of replicated nodes to send them to newly connected peers, i.e. supporting clients that join mid-game.

The RPC system will also work appropriately for the nodes spawned this way, so you can easily integrate state synchronization with messaging.

At the specified interval (16 milliseconds in the above example), the properties passed to `multiplayer.replicator.sync_config` will also be synchronized from the server to the client.

You can decide to synchronize multiple properties via `sync_config`, but keep in mind that will result in a larger sync state. If the sync state becomes too large, this can potentially introduce latency or packet loss.

```
multiplayer.replicator.sync_config(id, 16, [&"position", &"health", &"mana"])
```

In those cases, a good way to optimize the state is to use a dedicated "sync_state" property with your own optimized representation:

```
multiplayer.replicator.sync_config(id, 16, [&"sync_state"])
```

And then in your player script:

```
# player.gd

# In this example, health and mana must be set between 0 and 255
# to be encoded as 8-bit integers.
var health := 100
var mana := 100

# Optimized state representation using bit-packing.
var sync_state:
	get:
		var buf = PackedByteArray()
		buf.resize(6)
		buf.encode_half(0, position.x)
		buf.encode_half(2, position.y)
		buf.encode_u8(4, health)
		buf.encode_u8(5, mana)
		return buf

	set(value):
		assert(typeof(value) == TYPE_RAW_ARRAY and value.size() == 6,
		    "Invalid `sync_state` array type or size (must be TYPE_RAW_ARRAY of size 6).")
		position = Vector2(value.decode_half(0), value.decode_half(2))
		health = value.decode_u8(4)
		mana = value.decode_u8(5)
```

In the same way, properties of child nodes could be set, and custom interpolation techniques implemented.

## Future work

As explained, this is an early prototype. A [more complete proposal](https://github.com/godotengine/godot-proposals/issues/3459) has been created to gather feedback as we work towards a final implementation in the coming months. This includes **visual configuration**, child node properties support, fine grained spawn control and more.

The coming months will be prety dense of announcements. As always, stay tuned for more!

## References

- [Spawn/Despawn pull request](https://github.com/godotengine/godot/pull/51097)
- [Spawn/Despawn initial state pull request](https://github.com/godotengine/godot/pull/51534)
- [State synchronization pull request](https://github.com/godotengine/godot/pull/51788)
- [Last replication proposal](https://github.com/godotengine/godot-proposals/issues/3459) (ongoing).

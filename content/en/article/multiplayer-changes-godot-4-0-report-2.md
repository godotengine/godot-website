---
title: "Multiplayer in Godot 4.0: RPC syntax, channels, ordering"
excerpt: "New RPC syntax and features in Godot 4.0. Introducing channels and ordered transfer mode."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/615/766/117/6157661176579529840022.png
date: 2021-09-25 14:00:00
---

Howdy Godotters! Time for [another update]({{% ref "article/multiplayer-changes-godot-4-0-report-1" %}}) on Godot 4.0's multiplayer networking.

We have been really busy working on the foundation of the networking and multiplayer classes lately, and there are quite a few new features to talk about. In this post, we'll start by showing some of the new RPC syntax and features.

*See other articles in this Godot 4.0 networking series:*

1. [Multiplayer in Godot 4.0: On servers, RSETs and state updates]({{% ref "article/multiplayer-changes-godot-4-0-report-1" %}})
2. (you are here) [Multiplayer in Godot 4.0: RPC syntax, channels, ordering]({{% ref "article/multiplayer-changes-godot-4-0-report-2" %}})
3. [Multiplayer in Godot 4.0: ENet wrappers, WebRTC]({{% ref "article/multiplayer-changes-godot-4-0-report-3" %}})
4. [Multiplayer in Godot 4.0: Scene Replication (part 1)]({{% ref "article/multiplayer-changes-godot-4-0-report-4" %}})

### Simplified RPC configuration

First of all, many users found the old `master` and `puppet` keywords in `3.x` were confusing.

The `master` keyword would mean that a function could be called on the "network master", while `puppet` that a function could be called only on the "non-master" peers. Additionally, the old `master` keyword had very little usage, since `remote` could be used in its place with little to no effort.

Learning from this, we decided to have a unified `@rpc` annotation with a few optional parameters.

#### Authority

{{< highlight gdscript >}}

@rpc
func my_rpc():
	print("RPC called.")

{{< /highlight >}}

By default, `@rpc` only allows calls from the **multiplayer authority**, which is the server by default. You can optionally set the multiplayer authority on a per-node basis via the `Node.set_multiplayer_authority()` method.

In this sense, the `@rpc` annotation alone behaves like the old `puppet` keyword.

{{< highlight gdscript >}}

@rpc(any_peer)
func my_rpc():
	print("RPC called by: ", multiplayer.get_remote_sender_id())

{{< /highlight >}}

As mentioned above, the `@rpc` annotation can also take optional parameters. If one of those parameters is `any_peer`, the RPC will be callable by any connected peer, behaving like the old `remote` keyword. You can get the ID of the peer that is making the call via the `MultiplayerAPI.get_remote_sender_id()` method.

{{< highlight gdscript >}}

@rpc(any_peer)
func my_rpc():
	var peer_id = multiplayer.get_remote_sender_id()
	if peer_id == get_multiplayer_authority():
		# The authority is not allowed to call this function.
		return
	print("RPC called by: ", peer_id)

{{< /highlight >}}

There is no direct replacement for the rarely used `master` keyword. In those cases, `@rpc(any_peer)` can be used by adding an extra check against the called ID as is done above.

#### Calling functions locally

{{< highlight gdscript >}}

@rpc(call_local)
func my_sync_rpc():
	print("RPC called")

{{< /highlight >}}

In Godot, it's possible to instruct the engine that a specific function has to also be called locally when sending RPCs.

In Godot `3.x`, this was done using even more dedicated keywords (e.g. `puppetsync`, `remotesync`, etc). In Godot 4.0, `sync` is now an optional parameter of the `@rpc` annotations.

Parameters do not need to be in a particular order, so `@rpc(call_local, any_peer)` and `@rpc(any_peer, call_local)` have the equivalent meaning of defining an RPC that any peer can call. Thanks to the `sync` parameter, the RPCs will also be executed locally on the sending peer.

### Simplified RPC calls

In Godot `3.x`, we used to have 2 different transfer modes for RPCs: reliable and unreliable.

Calling `rpc("my_func")` would transfer it reliably, while calling `rpc_unreliable("my_func")` would transfer it unreliably.

In most cases though, you would always want the same transfer mode to be used (with few exceptions).

{{< highlight gdscript >}}

@rpc(unreliable)
func my_unreliable_rpc():
	print("RPC called.")

{{< /highlight >}}

In Godot `4.0` we decided to also make the transfer mode a parameter of the `@rpc` annotation.

You will still be able to to override the configuration for a specific RPC using a dedicated `rpc_raw` function (not implemented yet).

### Channels and ordering

Two new features of the multiplayer API in Godot `4.0` are the introduction of channels, and the ordered transfer mode.

#### Channels

Most realtime network protocols, including ENet and WebRTC, support the concept of *channels*.

You can think of channels like separate streams inside the same connection, or even separate connections to the same remote peer if you wish. Each channel acts independently from each other, and like rivers flowing at different speeds reliable messages sent on different channels, might arrive in a different order.

This might at first seem like a limitation, but it is actually their true power.

Every time you send a message (RPC) in a reliable way, the protocol needs to keep track of it and wait until the client acknowledge its receival before sending more messages. While there are many techniques protocols use to optimize this process (e.g. buffering multiple messages), this inevitably introduces latency.

In your game, you will likely have some RPCs that are quite unrelated from the others (e.g. the player chat). These RPCs don't have to be perfectly in sync with the rest of the game (while retaining internal order). In those cases, especially when transfering larger amount of data, using a separate channel is an efficient way to reduce latency and lower the risk of disconnections.

{{< highlight gdscript >}}

@rpc(any_peer, 1)
func my_chat_func():
	print("RPC received on channel 1.")

{{< /highlight >}}

Godot 4.0 will make these optimizations easier, allowing you to specify a different channel to use other than the default by passing an integer as the last parameter of the `@rpc` annotation.

This also comes handy with the other new feature, the "ordered" transfer mode.

#### Ordering

{{< highlight gdscript >}}

@rpc(unreliable_ordered)
func my_ordered_rpc():
	print("Ordered RPC received")

{{< /highlight >}}

In general, unreliable RPCs are not guaranteed to arrive in order. If the server sends first the message `A` and then the message `B`, a client *could* receive `B` first, and then `A`.

An "ordered" RPC is an unreliable RPC that still guarantees the received messages to be in the right order. That is, if the clients receive `B`, it will automatically discard any message that the server sent before that (including `A` if received at a later time).

**A note of caution:** Ordered transfer mode is a powerful tool to further squeeze performances out the network connections, but it has the downside of potentially increasing packet loss if not used properly.

{{< highlight gdscript >}}

@rpc(unreliable_ordered, 1)
func _update_players_state(state):
	# Code to update the state of the players
	pass

@rpc(unreliable_ordered, 2)
func _update_enemies_state(state):
	# Code to update the state of the enemies.
	pass

{{< /highlight >}}

When using the ordered transfer mode, be advised **you should not send heterogeneous messages** over the same channel.

In the code snippet above, we are are designing a game where we don't mind if the player and enemy states are a bit offsetted in the client. However, we do want each state to only be updated if the received one is newer (hence the "ordered" mode).

In this case, we must use different channels for the 2 RPCs because we want 2 separate orderings. Otherwise, a "players" update could be dropped because a newer "enemies" state has already been received, which is not what we want.

### Future work

There are a lot of exciting new things to talk about, from heavy refactoring of the networking classes and exposing most low-level ENet functions, to the high level work done on the new scene replicator. Stay tuned for more :)

### Reference work

- [RPC refactor](https://github.com/godotengine/godot/pull/49221)
- [`@rpc` annotation PR](https://github.com/godotengine/godot/pull/49882)
- [Master/puppet removal, authority](https://github.com/godotengine/godot/pull/51481) (only recently merged as it required some consensus on the new namings).

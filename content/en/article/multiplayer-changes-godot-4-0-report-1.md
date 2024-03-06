---
title: "Multiplayer in Godot 4.0: On servers, RSETs and state updates"
excerpt: "News about running Godot on servers, and hints at upcoming networking changes in Godot 4.0."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/610/918/f3e/610918f3ec53b713518837.png
date: 2021-08-05 18:00:00
---

Howdy Godotters!

It's time for the first update on Godot 4.0 multiplayer and networking changes.

In this post, I'll focus on the new "headless" display, and the removal of multiplayer RSETs (read below before despairing!), along with keeping you hyped with some of the new features planned or in the work.

*See other articles in this Godot 4.0 networking series:*

1. (you are here) [Multiplayer in Godot 4.0: On servers, RSETs and state updates]({{% ref "article/multiplayer-changes-godot-4-0-report-1" %}})
2. [Multiplayer in Godot 4.0: RPC syntax, channels, ordering]({{% ref "article/multiplayer-changes-godot-4-0-report-2" %}})
3. [Multiplayer in Godot 4.0: ENet wrappers, WebRTC]({{% ref "article/multiplayer-changes-godot-4-0-report-3" %}})
4. [Multiplayer in Godot 4.0: Scene Replication (part 1)]({{% ref "article/multiplayer-changes-godot-4-0-report-4" %}})

### Goodbye `server` platform, hello headless display!

One of the emergent feature of Godot that users have discovered and really started to like is its ability to run on a headless Linux machine and act as game server.

Over time, [macOS support](https://github.com/godotengine/godot/pull/23279) was added to the `server` platform, and users showed interest in a [`windows` server](https://github.com/godotengine/godot/issues/6059).

Finally, in Godot 4.0, you will be able to run Godot with [**headless display**](https://github.com/godotengine/godot/pull/49074) (no rendering) on any *desktop platform*.

Passing the **`--display-driver headless`** command line argument will start Godot without rendering, like the old `server` platform, no matter if you are on Linux, macOS or Windows.

Additionally, we are working on a series of ["server" export options](https://github.com/godotengine/godot-proposals/issues/2756), to let developers further reduce the memory and load time footprint by replacing specific assets with "fake" files that only contains metadata. For example, a "fake" audio file will not contain any audio, but will retain informations about length, loops, etc. This means that server-side code relying on audio timing or texture sizes will still work correctly.

### Removing RSETs

When building the multiplayer API, two forms of network communications were introduced: RPCs to call functions remotely, and RSETs to set variables remotely. This seemed like a good idea at the time: RSETs were a fast way to prototype, and easily make your game networked… or were they?

In reality, using RSET proved to be almost always a bad idea:

- First, you have very little control over who is setting it beside the `master` keyword. Anything more complex than that, and you will need a function so you can base your logic on the RPC caller.
- Second, performances are bad!

Take this example from the [multiplayer bomber demo](https://github.com/godotengine/godot-demo-projects/tree/master/networking/multiplayer_bomber):

{{< highlight gdscript >}}

extends KinematicBody2D

puppet var puppet_pos = Vector2()
puppet var puppet_motion = Vector2()

func _physics_process(_delta):
    # ...
    if is_network_master():
        rset("puppet_motion", motion)
        rset("puppet_pos", position)
    else:
        position = puppet_pos
        motion = puppet_motion

    move_and_slide(motion * MOTION_SPEED)
    if not is_network_master():
        puppet_pos = position # To avoid jitter

{{< /highlight >}}

It's making 2 separate `rset()`s, generating 2 packets, which may arrive each at a different frame under certain conditions. Additionally, while one would think it could use a direct RSET for the `position`, it actually can't. This is because it needs to add some logic to avoid jittering anyway.

Compare it with this:

{{< highlight gdscript >}}

extends KinematicBody2D

var puppet_pos = Vector2()
var puppet_motion = Vector2()

puppet func _update_state(p_pos, p_motion):
    puppet_pos = p_pos
    puppet_motion = p_motion

func _physics_process(_delta):
    # ...
    if is_network_master():
        rpc("_update_state", puppet_pos, puppet_motion)
    else:
        position = puppet_pos
        motion = puppet_motion

    move_and_slide(motion * MOTION_SPEED)
    if not is_network_master():
        puppet_pos = position # To avoid jitter

{{< /highlight >}}

In this example, we only make 1 `rpc()`, reducing the network usage and latency. More importantly, we make sure that in each frame, either the client will have the old state, or a fully updated one. This avoids having an inconsistent state where the position is up-to-date but the motion isn't (or vice versa).

This is just one example which shows a common pitfall in networking.

So, to avoid tricking developers into these common mistakes (which could be unexpected for newcomers), and given the rarity of `rset()` usage in general, we decided to remove `rset()`. We really think you won't miss it in the end, but let us know if you feel you had a strong use case for them. Like most decisions in Godot, this is not set in stone.

### Future work

If you feel a bit disappointed from this progress update, keep in mind this was just the ground work for more important changes. We have a few surprises in the works!

There's the new GDScript syntax for RPCs to talk about, the newly exposed `ordered` transfer mode, channels, ENet and WebRTC improvements, and even some news about the long-awaited **node replication**! So stay tuned for more :)

### Reference work

- [Headless DisplayServer](https://github.com/godotengine/godot/pull/49074)
- [RPC refactor and RSET removal](https://github.com/godotengine/godot/pull/49221)

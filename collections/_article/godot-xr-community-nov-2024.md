---
title: "Godot XR community - December 2024"
excerpt: "Interesting projects from the Godot XR community."
categories: ["news"]
author: Bastiaan Olij
image: /storage/blog/covers/december-2024-update-godot-xr-community.webp
image_caption_description: "ROTVD: Demon in the Shell"
date: 2024-12-01 12:00:00
---

Godot has a very active XR-focused community on the XR channel of the [official Godot Discord server](/community/).
Today, we want to put a spotlight on a number of community projects.

## Godot XR community Game Jams

To showcase the engine capabilities and the ingenuity of the Godot XR community, game jams are now being organized twice a year.
It's a fun way for participants to get introduced to Godot's XR capabilities.

### Godot XR Game Jam #1

The [first Godot XR Game Jam](https://itch.io/jam/godot-xr-game-jam) was held from 1 December until 4 December 2023.
The theme of this game jam was Vapor.
We saw both many new faces and long-time community members join, and had a total of 17 entries.

The #1 spot went to [Cloud Shepherd](https://itch.io/jam/godot-xr-game-jam/rate/2402526) which won 3 out of 6 categories, including "Originality", "User experience", and "Audio".
In this entry, you herd sheep on clouds in the sky by using fans to create breezes that blow the sheep to their destinations.

The #2 spot was taken by [Super Steam Hands](https://itch.io/jam/godot-xr-game-jam/rate/2402404) which won 2 out of 6 categories ("Fun factor" and "Theme incorporation").
Don't let the thumbnail of this entry fool you. It's a great game where you can feel like Iron Man by using jets of steam to parkour around a level.

The #3 spot went to [Pipe Stream](https://itch.io/jam/godot-xr-game-jam/rate/2400974) which ranked the best in the "Haptics" category.
It's a great little puzzle game where you need to chip away a path for vapor to reach a target. Very challenging!

There were far more great entries, so be sure to [check out the jam page for more](https://itch.io/jam/godot-xr-game-jam/entries)!

### Godot XR Game Jam #2

The [second Godot XR Game Jam](https://itch.io/jam/godot-xr-game-jam-july-2024) was held from 8 July until 15 July 2024.
We decided to give participants a full week to complete their game.
The theme this jam was Relaxation. There were a total of 26 entries and this time we scored them on the average points in all categories.

The #1 spot went to [Who's a good boy](https://itch.io/jam/godot-xr-game-jam-july-2024/rate/2821459) with 4.042 points.
This cute little game has you play fetch with a dog in a park.
It features some excellent interactions both from the player's and dog's points of view.

The #2 spot went to [Constellation Coach VR](https://itch.io/jam/godot-xr-game-jam-july-2024/rate/2830514) with 3.974 points.
This game has you find constellations in the night sky by holding up a picture of the constellation and aligning it with the relevant stars.
Excellent haptic feedback lets you know when you've gotten close, and successfully aligning the constellation lights it up.

The #3 spot went to [Summer Pottery VR](https://itch.io/jam/godot-xr-game-jam-july-2024/rate/2830121) with 3.938 points.
This game lets you do some clay pottery sculpting.
It's a great and very well-executed use of physically interacting with the clay to shape and paint your creation.

<iframe width="560" height="315" src="https://www.youtube.com/embed/0IxvWaj8iUo?si=em-D99NacStXyIYA" title="5 VR Games Made in Godot To Inspire You" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

Again, many of the other entries were of great quality and we highly recommend [checking them out](https://itch.io/jam/godot-xr-game-jam-july-2024/entries).

### Godot XR Game Jam #3

The 3rd game jam will be held in the week starting 10 February 2025. [You can read all about it and sign up here](https://itch.io/jam/godot-xr-game-jam-feb-2025).

## Universal Godot VR plugin

Inspired by the Universal Unreal Engine VR Mod, community member TeddyBear082 has created a mod to inject VR capabilities into existing 3D games made with Godot.

TeddyBear082 previously made a name for himself with the excellent VR port of the popular game Cruelty Squad and has used the knowledge gained with that and similar projects to create a more universal mod.

<iframe width="560" height="315" src="https://www.youtube.com/embed/Hb9BDcCZHCY?si=Zr2Jw3MV7cY00yEE" title="UGVR Demo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

You can find the plugin [on teddybear082's GitHub profile](https://github.com/teddybear082/UGVR).

## Body tracking and motion capture plugins

Core contributor Malcolm Nixon has created various plugins for Godot that use the new body tracking feature to make tracking data available from various sources.

He has support for Rokoko, Axis Studio and Movella.
He also has a plugin for VMC (Virtual Motion Capture), which is a standard used by a number of motion capture systems.

You can find the plugins [on his GitHub profile](https://github.com/Malcolmnixon?tab=repositories).

## Meta platform plugin

Community member Decacis has released a few of his games on the Meta Horizon store and implemented part of the Meta platform SDK in support of this.
He has implemented support for things like in-app purchases, leaderboard, challenges, and much much more.

The plugin he created is open source and can be found [on his GitHub profile](https://github.com/decacis/godot_oculus_platform).

## Godot XR Tools

We've showcased XR Tools before, but with version 4.4 of the plugin nearly ready for release, it's worth quickly looking at what's coming.

* Improved support for Godot 4.2+ features such as pass through logic with both OpenXR and WebXR.
* New objects to make games suitable for both VR and non-VR use.
* A new gaze interaction component for controller-less experiences.
* Various improvements to snap points.
* Improvements to hands interacting with physics.

<iframe width="560" height="315" src="https://www.youtube.com/embed/YWdcc6r9w3E?si=BimitXSjjVQxcLrO" title="Godot XR tools demo for GodotCon 2024" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

## Godot ARCore support

ARCore support in Godot has been a long time coming.
From an early working prototype in Godot 3, to moving this into a community maintained plugin, there have been plenty of hurdles along the way. Thanks to the persistance of Patrick Exner, Luca Junge, and Chambefort Maxime, we have nearly reached the finish line.

Supporting changes were recently merged into the master branch of Godot and you can find the plugin itself [on the plugin's GitHub](https://github.com/GodotVR/godot_arcore).

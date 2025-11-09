---
title: "Godot XR update - November 2025"
excerpt: "MOAT XR, XR game jam results, new features, OpenXR inventory"
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/blog/covers/november-2025-update-godot-xr-community.jpg
image_caption_description: "Memories - Cularo Games"
date: 2025-11-14 12:00:00
---

## "The Museum of All Things" released on the Meta Quest store!

The Museum of All Things is a virtual museum where each exhibit is generated from an article on Wikipedia, and the links to other articles become doors to other exhibits.

<img src="/storage/blog/godot-xr/updates/moat.png" alt="Museum of All Things"/>

It was the topic of a [showcase back in February](https://godotengine.org/article/museum-of-all-things/), where it had a PCVR version, but no port to the Meta Quest.

However, now it's launched on the [Meta Quest store](https://www.meta.com/experiences/the-museum-of-all-things/25148973151401467/)!

## Results of the Godot XR Community Game Jam

In September the Godot XR Community held its latest game jam and we had some amazing entries. The quality is definitely rising from previous jams.

The theme this time around was “It takes two”, and the interpretations of the theme did not disappoint.

You can find the full results here, we’ll list the top 5 results below. I highly recommend checking out the other entries. There are a number of gems that didn’t make the top 5.

### No 5. "Rogue Vantage" by Allen Dawodu

[Rogue Vantage](https://itch.io/jam/godot-xr-game-jam-sep-2025/rate/3879177) by [Allen Dawodu](https://allendawodu.itch.io/) ranked 5th with 11 ratings (Score: 3.606).

<iframe width="560" height="315" style="width: 100%; height: 100%; aspect-ratio: 16/9;" src="https://www.youtube.com/embed/iX6pwozpcC8" title="Rogue Vantage" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

This entry is a variation on the Superhot formula where time only progresses when you move.

However the main character is now an NPC that you need to assist. Levels get progressively more difficult as you’re trying to keep your NPC alive.

### No 4. "And 2 We Are" by MigueBC

[And 2 We Are](https://itch.io/jam/godot-xr-game-jam-sep-2025/rate/3883812) by [MigueBC](https://miguebc.itch.io/) ranked 4th with 10 ratings (Score: 3.617).

<iframe width="560" height="315" style="width: 100%; height: 100%; aspect-ratio: 16/9;" src="https://www.youtube.com/embed/zowvWSvMEbg" title="And 2 We Are" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

This entry has you play two separate characters that need to perform complimentary actions to escape a maze. It has a very Portal feel to it and I wish it had many more levels to it.

The miniaturization part was especially well executed.

### No 3. "Runaway Rails" by Copper Tunic

[Runaway Rails](https://itch.io/jam/godot-xr-game-jam-sep-2025/rate/3880221) by [Copper Tunic](https://copper-tunic.itch.io/) ranked 3rd with 11 ratings (Score: 3.833).

<iframe width="560" height="315" style="width: 100%; height: 100%; aspect-ratio: 16/9;" src="https://www.youtube.com/embed/euV89UPG4Go" title="Runaway Rails" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

This great little rhythm game has you play together with another player to place rail road tracks to the beat of music in order to prevent a train from derailing.

If you don’t have a friend at hand, you can play together with an NPC.

The developer seems set to continue building this game out and has already released several updates to his game since the jam ended.

### No 2. "Things You Can Do With Two Hands" by Matt Giuca

[Things You Can Do With Two Hands](https://itch.io/jam/godot-xr-game-jam-sep-2025/rate/3874113) by [Matt Giuca](https://mgiuca.itch.io/) ranked 2nd with 11 ratings (Score: 4.000).

<iframe width="560" height="315" style="width: 100%; height: 100%; aspect-ratio: 16/9;" src="https://www.youtube.com/embed/L41KnIcSRzE" title="Things You Can Do With Two Hands" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

This game might have a simple aesthetic, but it is a unique experience to play through.

The aim is to coordinate and perform actions with both your hands to complete levels. Whether it is turning keys in moving locks, throwing bowling balls that have to hit a cone at the same time, or trying to hit the moon while also hitting a target, it is deceptively tricky to complete the whole game. 

### No 1. "Wiener Wobble Dog Park" by Andyman404

[Wiener Wobble Dog Park](https://itch.io/jam/godot-xr-game-jam-sep-2025/rate/3883622) by [Andyman404](https://andyman404.itch.io/) ranked 1st with 7 ratings (Score: 4.048).

<iframe width="560" height="315" style="width: 100%; height: 100%; aspect-ratio: 16/9;" src="https://www.youtube.com/embed/DNN8vEwrVdg" title="Wiener Wobble Dog Park" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

The winner of the game jam was Wiener Wobble Dog Park. This unique entry has you control a sausage dog with two fingers on each hand. One hand controls the front of the dog, while the other controls the rear.

The dog works like a slinky and you have to move it through an obstacle course where you can move only when the dog touches the course. It is a frantic and very enjoyable experience.

## Introducing spatial entities

Spatial entities is a new collection of APIs within the OpenXR specification that gives us access to information about the real world around us. This API is designed to grow over time. Its initial iteration gives access to:

1. Spatial anchors allow users to mark real world locations that are tracked by the headset. These can be stored on the headset and retrieved on subsequent runs of your application. They are great for placing virtual objects in a fixed location in your real space.
2. Plane tracking provides us with insight about the world around us, where is our floor, where are walls, where are tables, etc.
3. Marker tracking allows us to use various printed markers like QR codes, April tags, and Aruca codes, and have our headset identify and track those locations.

Godot is an early adopter of this API thanks to funding through the Khronos Godot Integration Project.

You can try out this new API using the Galaxy XR headset as Android XR has support for all three implementations. We are eagerly awaiting news of other headsets supporting this functionality.

## Frame synthesis

Frame synthesis is a new OpenXR API that defines a standard for advanced reprojection techniques. This allows you to run your application at a lower frame rate and have the runtime inject reprojected frames that use motion vectors and depth information to improve the image.

Note that this API only works with the Compatibility and Mobile renderers.

This work was made possible thanks to funding through the Khronos Godot Integration Project.

## OpenXR inventory

The OpenXR working group maintains an [inventory website](https://github.khronos.org/OpenXR-Inventory/extension_support.html) where you can see which OpenXR extensions are supported on various OpenXR Runtimes.

The past year our very own Bastiaan Olij has spent time on extending this inventory to also support a [client matrix](https://github.khronos.org/OpenXR-Inventory/extension_support.html#client_matrix) showing which OpenXR extensions are supported by various game engines. Working together with developers from these other engines we were able to present a complete list and devise a system that will inform users of needed plugins to get access to these features.

We can now see that Godot leads the pack, supporting 95 official OpenXR extensions in total. This number is made up of:

- 14 core extensions (KHR)
- 22 multi-vendor extensions (EXT)
- 59 vendor extensions

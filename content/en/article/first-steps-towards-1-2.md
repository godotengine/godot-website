---
title: "First steps towards 1.2"
excerpt: "As many of you know, Vulkan will be the next open and multi platform rendering 2D and 3D API. While many claim it will just be an additional API, those of us who have been in the industry for long enough know well that Vulkan will make other APIs obsolete."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/56c/d7f/bae/56cd7fbae6495309340594.jpg
date: 2015-06-06 00:00:00
---

## Waiting for Vulkan

As many of you know, Vulkan will be the next open and multi platform rendering 2D and 3D API. While many claim it will just be an additional API, those of us who have been in the industry for long enough know well that Vulkan will make other APIs obsolete.

CAD and 3D DCC applications will most likely continue to using OpenGL, but for anything related to games OpenGL will be no more.

Vulkan will work on all PC platforms: Windows, OSX and Linux. It will also work on any modern mobile devices, iOS and Android. Vulkan will run in so many platforms that even the idea of using DirectX in the future is starting to look unfamiliar for large studios. It also fixes most of the gripes everyone has with modern OpenGL: Better drivers (due to much less intrinsic complexity) and much larger industry backing. Industry backing for Vulkan is, in fact, so big that everyone but Microsoft is on board.

As this will be undoubtedly the new, de facto, 3D API for games, all work on improving the current 3D renderer has been halted until drivers and API reference are published (which will be this year at some point).

Godot developers love 3D programming, and can’t wait to begin working on a new, awesome backend, with support for physically based rendering, modern global illumination, etc. But this will have to be sometime later this year or beginning of next, otherwise all the work will go to the trashbin once Vulkan comes out.

## Next goal: usability

The next version of Godot (1.2) will, then, focus almost exclusively on usability. Godot has a great underlying architecture which has proven to be rock solid during the past years, but the user interface still needs more work to be as friendly as possible. Other (commercial) game engines have set the bar high in this area.  Current work is already underway and showing nice progress:

![first-steps-1-2-open-file.jpg](/storage/app/uploads/public/56c/d7f/91e/56cd7f91e9163818771217.jpg)

*New animation editor.*

![first-steps-1-2-open-file.jpg](/storage/app/uploads/public/56c/d7f/ab3/56cd7fab34cf2526093425.jpg)

*New file selector, with thumbnails, favorites and recent folders.*

## New website, documentation and asset DB

The community is also working on a new website, which will allow more open access to adding documentation to the wiki. An asset database where you can share or search for assets, templates, etc. is also planned.

## Legal status

We are looking for a way to officialise Godot as a non profit so it can stand on it’s own and not rely or belong to anyone. Effort towards this is in the works, so expect exciting news in the near future!

## Participate and make noise!

If you are using Godot, plan to use Godot or are you just interested about it and want to support it, make sure to join our [amazing community]({{% ref "community" %}})! The [Facebook group](https://www.facebook.com/groups/godotengine/) and [IRC](irc://irc.freenode.net/#godotengine) are always active, as well as the forum (*Edit:* replaced by [Q&A](/qa) in the new website). Remember that we don’t have millions to spend in marketing and PR, so we rely on you to talk about Godot and spread the love!

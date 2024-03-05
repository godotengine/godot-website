---
title: "WebAssembly: Godot on the web?"
excerpt: "Godot has a long story on attempts trying to make it run on the web. We always wanted this to happen, we tried many approaches, it may finally happen. This article will be a small recap of our experiences with this matter."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/56b/c4b/20e/56bc4b20e9832821396846.jpg
date: 2015-06-25 00:00:00
---

## Running native on the web

Godot has a long story on attempts trying to make it run on the web. We always wanted this to happen, we tried many approaches, it may finally happen. This article will be a small recap of our experiences with this matter.

## Atmosphir

A long time ago Ariel and I wrote a game named Atmosphir as contractors. It was one of the first voxel games and a Minecraft precursor. Although far from what Godot is now (almost the entire codebase is different at this point), the game+engine combo were written almost from scratch in seven months and Atmosphir got a warm welcome by the community.

As it [did well](http://techcrunch.com/2008/09/10/tc50-atmosphir-the-build-it-yourself-gaming-platform/), investors wanted to expand the game and one of their first ideas was to make it a web based game to run it in Kongregate (which was trendy). They were set on this idea and completely convinced that downloadable games were a thing of the past (a common idea at the time, Steam did not exist yet and Minecraft was a year or two away from proving them wrong).

## First attempt, native plugin

We did research on how to make the game run on a browser and researched NPAPI and similar technologies and even made prototypes, but reality was that we believed it was a huge security risk to do this, as plugins don’t have any sort of protection against attacks (reason why now they are being removed from Chrome and Edge).

Finally It was decided that the game was to be ported to Unity so it could run on the web. Unity at the time was a very immature engine and Atmosphir was probably one of the biggest projects made with it, if not the largest. Still, it had a great web plugin with a decent userbase. At the time we had other priorities so we ceased involvement with the project.

## Second attempt, native client

Shortly afterwards, Google announced Native Client. Native Client works by allowing developers to compile “safe” binaries that run on the Browser. You had to compile a binary for each processor by yourself, but that wasn’ t too bad. We believed it was a great idea, as it was a safe way to run native code on the web. Ariel did a very early port of Godot to it and it worked fantastic.

At the time, Google started experimenting with Pepper API (PPAPI), proposing it as an open safe (sandboxed) plugin interface. Mozilla was interested too so so we believed this was the future (Hey, if both Firefox and Chrome had it working, Microsoft would have been forced to implement it, right?). Unfortunately, Mozilla [changed course](https://wiki.mozilla.org/NPAPI:Pepper) and decided not to go that route (no PPAPI) and, as a Chrome-only plugin would not be very useful, we abandoned it to.

Failure. A shame because PNaCL was not going to get support either, as a great of an idea as it was. Thanks Mozilla.

## Third attempt, Flash

Fast forward to Farmville. Making games in Flash became all the rage and the most popular way to make games on Facebook. On the peak of it’ s glory, Adobe announced a cool internal project called “[FlasCC](http://www.adobe.com/devnet-docs/flascc/docs/samples.html)“, later renamed to “Project Alchemy” and finally settled as “Adobe CrossBridge”. This technology allowed to compile C++ to run on the FlashVM.

At the time, It was still immature and it needed some work, but it showed promise. “This is it!” we thought again, this is how to run Godot on the web.  We met with Adobe privately at GDC and worked with them in the closed beta with the hopes to have a nice flash exporter.

Unfortunately, one day Steve Jobs decided that “[Flash is dead](https://www.apple.com/hotnews/thoughts-on-flash/)” and killed it. It was a simple as that. Can’t complain about it as it was probably a good thing, but efforts to bring Godot to the web failed again as Adobe abandoned both Flash and Cross Bridge. Thanks Apple.

## Fourth attempt, ASM.JS

When I first heard that someone made a compiler that [converted C++ to JavaScript](http://asmjs.org/), I laughed a lot and ignored it for about a year. Finally, one day, decided to gave it a try and I was surprised that it worked. It had a lot of limitations but it could run Godot. Firefox ran it flawlessly and perfectly, but not Chrome and much less Internet Explorer. The situation improved the following years, with support somehow improving in all major browsers and Microsoft deciding to adopt it for Edge.

Unfortunately, the process of detecting asm.js and pre-parsing it efficiently seems it’s too much of a hack to implement by browser vendors other than Mozilla. Despite it being adopted by Unity and Unreal too, ASM.JS is still hit or miss. It requires a huge amount of resources to compile the Javascript blob, a large pre-allocated chunk of memory (to serve as process memory), and a relatively fast computer to run it. Forget about mobile web. This back-end is still in the works in Godot, but we were mainly waiting for browser vendors to make it not suck. This may never happen.

## Fifth attempt, WebAssembly

Some days ago, [WebAssembly was announced](https://github.com/WebAssembly/design). It’s a bytecode specification to run code that converts to native on the browser. On paper it’s great and provides every single thing that Godot needs. It’s still in diapers and we might not see support for it until next year, but it’ cool because this time Unity and Unreal are in our same boat and they have more lobby power than us.

In fact, all this is probably because they freaked after Google decided to deprecate NPAPI from Chrome and Microsoft decided to stop supporting plugins on Edge. Will we succeed this time? I hope so, but i we do it will definitely be thanks to Google and Microsoft this time! Thanks for having the balls to deprecate native plugins!

As soon as there is an initial implementation of this technology in all major browsers, we will definitely be giving it a try! Stay tuned!

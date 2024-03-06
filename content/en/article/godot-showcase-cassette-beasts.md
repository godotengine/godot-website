---
title: "Godot Showcase - Cassette Beasts"
excerpt: "We interviewed Jay and Tom from Bytten Studio about Cassette Beasts."
categories: ["showcase"]
author: Emi
image: /storage/blog/covers/cassette-beasts.webp
date: 2023-04-26 15:00:00
---

<style>
.jay {
	color: #aa77e2;
}
.tom {
	color: #40b99f;
}
</style>

It's been a long time since our last showcase interview. This time, we bring you Jay and Tom, the team behind [Cassette Beast](https://www.cassettebeasts.com/), an 80’s vibe Creature Collector turn-based RPG set in a vast and colourful open world.

<iframe width="560" height="315" src="https://www.youtube.com/embed/JBt-B5eT2h4" frameborder="0" allowfullscreen style="width: 100%; aspect-ratio: 16 / 9; height: auto;"></iframe>

### Could you tell us a bit about yourselves and your studio, and how you got started in game development?

<strong class="jay">Jay:</strong> My name is Jay Baylis and I’m one half of Bytten Studio, a micro game dev team based here in Brighton, United Kingdom. I’ve been making indie games for over a decade now, and have made games for fun ever since I was a kid. Whilst pixel art is my specialty, I also do writing and design.


<strong class="tom">Tom:</strong> I’m Tom Coxon, and I’m the other 50% of Bytten Studio. Although ‘Studio’ is in our company’s name, we don’t actually have one! I’m Bytten Studio’s programmer and also do design.

I first started making games in my bedroom as a kid, using Delphi (I don't know whether that still exists). I picked up this hobby again after finishing university, and then after a few years in a software engineering job, I decided to jump to the games industry. I went to work for an indie publisher for a while, and then left that to start Bytten Studio with Jay.

### Can you tell us a bit about your game?

<strong class="jay">Jay:</strong> Cassette Beasts is an open-world monster collecting RPG. It is set on the mysterious island of New Wirral, where people transform into monster forms using cassette players to defend themselves. As the player explores this world in order to find a way home, they’ll make new friends, uncover lost secrets and do battle with beings that defy reality!

### What were some of the biggest challenges you faced during the development process, and how did you overcome them?

<strong class="jay">Jay:</strong> On the art and creative side, figuring out how exactly we would be able to create the amount of content needed to realise the project was challenging! For a game about collecting monster forms, we needed a lot of monster designs, and for them to look good. On top of that, figuring out how the game’s “Fusion system” would work was also pretty daunting! A lot of work went into it ultimately, but I’m very proud of how it turned out!

<strong class="tom">Tom:</strong> The biggest and most consistent technical challenge we've faced is getting performance to where we need it for smooth gameplay. That's not unique to Godot though - and in fact Godot being open source gives us ways to address this that other engines don't.

Engine code is often optimised to be fast enough in the most common cases, at the expense of poor performance in highly specific cases. Cassette Beasts actually hit several of those poor-performance cases in Godot, and I had to patch engine code in a few places to claw back a few frames. However, I think that this is a strength of Godot. No code can be perfectly optimised for every case. Optimising for better general performance in the most common cases, while allowing game developers to customise the engine for weird cases, is exactly what engine developers should be doing.

![](/images/showcase/cassette-beasts-1.webp)

### How did you discover Godot? What made you pick it for your project?

<strong class="tom">Tom:</strong> I don't remember how I discovered it, but I'm a long-time Linux user, so it was probably through [r/linux_gaming](https://www.reddit.com/r/linux_gaming/)!

We tried out a few engines before settling on Godot for Cassette Beasts. High up on our list of priorities was workflow efficiency. We wanted Cassette Beasts to feel dense with content, and that requires good tooling. After making a few prototype projects and editor plugins with Godot I was convinced.

I do think Godot is how Bytten Studio, as a two-man team, was able to build an open world RPG with 30+ hours of content in it.

### What do you like about Godot?

<strong class="tom">Tom:</strong> I like lots of things about Godot! As I've already mentioned, I like that we get total control of the source code.

But a massively undersold advantage Godot has over other engines, in my opinion, is its scripting language, GDScript. Unity devs using C# jump through tons of hoops just to avoid garbage collection, whilst the reference counting and manual memory management options that GDScript has built-in completely side-step it. GDScript isn't perfect, but I do feel like developers who come to Godot and continue using C# (outside of performance-critical code) are missing out.

### What do you dislike about Godot?

<strong class="tom">Tom:</strong> I would like it if stability was a higher priority in the engine. There are a number of crashes that were reported over a year ago that still aren't fixed. For example, it seems like certain things in the engine that should have thread-safety (like resource loading and audio) just aren't thread-safe, and I had to apply fixes and workarounds on our end.

Obviously, I'll submit pull requests for whatever I can when I get time, because that's how open source software works - and I expect the situation will naturally improve over time as larger and larger projects are built in Godot. But I'd still like to see a bigger effort by the project's leadership to bring down the number of serious bugs.

![](/images/showcase/cassette-beasts-2.webp)

### What advice would you give to aspiring game developers who are just starting out in the field?

<strong class="jay">Jay:</strong> Just make stuff! A lot of online discussion around “getting started in game dev” focuses so much on “what engine to use” or “what genres are popular” when I think the best approach is to simply start making things and not worry about the other stuff. You don’t have to come out of the gate with a professional commercial project (and, in fact, this rarely happens) but the only real way to learn how to make stuff is to start doing it. It’s easier than ever to jump into game development as a hobby -

<strong class="tom">Tom:</strong> I'll give some different advice! It's an unavoidable truth about the games industry that who you know matters just as much as what you can do. If what you want to do is work on your own indie projects full-time, my advice would be to first spend a few years at other companies building connections, or to partner with someone who is already connected. Good connections can provide opportunities you wouldn't otherwise get, as well as keep you from making mistakes they've already made!

### Did you find any issues when looking for a publisher? How is it like working with Raw Fury?

<strong class="jay">Jay:</strong> We revealed our game before we had a publisher in order to try and attract one, which was a risky move but ultimately ended up working! One challenge we faced was, I think, the perception that turn-based RPGs are “outdated” games and not in line with the genres that are more commonly seen in the indie game space (such as rogue-likes, town sims, deck building games etc.) but we were pretty insistent that the “monster-collecting RPG” genre was a popular one with fans that would support games in it. We were super happy to get to partner with Raw Fury, and they’ve understood our goals and aspirations with the game from the very start. Considering that they also published [Dome Keeper]( /images/showcase/dome-keeper/), I’d say they’ve already developed a good track record of publishing and supporting Godot games!

<strong class="tom">Tom:</strong> We love working with Raw Fury!

### How was the experience of porting Cassette Beast to consoles?

<strong class="tom">Tom:</strong> We knew from the start that porting to consoles would be a challenge with Godot. The situation seems like it's starting to improve now that the various closed ports of Godot 3.x are maturing, and Godot 4.0 has arrived.

We partnered with [Pineapple Works](https://pineapple.works/) to bring Cassette Beasts to Switch and Xbox--and you'll soon be able to see the results of their efforts on Switch and Xbox! I would encourage any indie who wants to bring their Godot project to Switch/Xbox to have a chat with the folks at Pineapple Works.

I can't go into the details of what it's like to port to consoles unfortunately. But here's some general advice for game development:
1. Before committing to working with a third party, make sure each parties' schedule is aligned, and that budgets are happy.
2. Don't announce any release dates until the final builds are locked in, because the unexpected can and does happen!

### Finally, what do you hope players will take away from your game, and how do you see it contributing to the broader gaming landscape?

<strong class="jay">Jay:</strong> The “monster-collecting RPG” space is one with some big franchises in it that cast a long shadow, but we want to prove that there’s room for new and original games in it that can stand on their own! We also hope to show off the potential of what a very small development team can do with Godot.

<strong class="tom">Tom:</strong> Hopefully developers who see our game will see that Godot is ready for more than just small projects! I also hope developers see that you can mix fantasy, comedy, horror, and genuine heartwarming moments, AND wrap it all up in whimsy and mystery, without it coming across as indecision. Because I'm bored of playing monotone games. And because if I'm wrong then Cassette Beasts probably won't do very well. 🙂

![](/images/showcase/cassette-beasts-3.webp)

*[Cassette Beast](https://www.cassettebeasts.com/) is available on [Steam](https://store.steampowered.com/app/1321440/Cassette_Beasts/) for Windows, Linux and Steam Deck. You can join their Discord server [here](https://discord.gg/byttenstudio).*

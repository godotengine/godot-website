---
title: "Godot Showcase - Lumencraft developer talks about his experience"
excerpt: "We interviewed Leszek Nowak from 2Dynamic Games about their game Lumencraft, which is made with Godot."
categories: ["showcase"]
author: Hugo Locurcio
image: /storage/app/uploads/public/625/6ff/331/6256ff331f974859299358.jpg
date: 2022-04-13 15:00:00
---

Welcome to another Godot showcase interview! This time, we interviewed Leszek Nowak from 2DynamicGames about their latest release Lumencraft.

___

### Introduce yourself (or your studio) in a few sentences.

My name is [Leszek Nowak](https://twitter.com/JohnMeadow3) and I’m a part of independent studio 2Dynamic Games located in Kraków, Poland. We are a small team working on our first team project, Lumencraft, which is released as I'm writing this.

### Introduce your project in a few sentences: description, supported platforms, release date, etc.

Lumencraft is a top-down shooter with base-building elements where you're a lonely little digger sent into bug infested underground caves.
The game is made in Godot Engine 3, with many custom-made technologies that enable a fully destructible environment, fluid simulation and dynamic lighting.

The game releases into Early Access on April 13th, 2022 for Windows, Linux, Steam Deck, and in the near future macOS.
You can find it on [Steam](https://store.steampowered.com/app/1713810/Lumencraft/?curator_clanid=41324400) and [GOG](https://www.gog.com/en/game/lumencraft).

### How did you discover Godot? When did you start using it? Do you have prior experience with other game engines?

I have years of random experience in development with my first games made way back for Commodore 64. I used the most known game engines there were, and some of my obscure games were made in Pascal, and even Matlab.

Since the path of a game developer is rarely straightforward, I ended up as an academic at the university doing PhD in skin cancer research, and as a part of not doing the PhD I started writing my own game engine. Luckily my students introduced me to Godot Engine and since 2014 it is my favorite tool. As of now, I have 40+ random free and open source games made in Godot, some can be found on [itch.io](https://johnmeadow.itch.io/) and [Global Game Jam](https://globalgamejam.org/users/john-meadow). You might find something that resembles Lumencraft in there.

As it happens, the 2Dynamic core team had to deal with me as their teacher at some point in their university life, with me preaching Godot at any opportunity.
One of the successful conversions to Godot was [Paweł Mogiła](https://twitter.com/PawelMogila) (szamq), the architect of Lumencraft. He published [Grimind](https://store.steampowered.com/app/265380/Grimind/?curator_clanid=41324400) in his custom SDL-based engine and [Clinically Dead](https://store.steampowered.com/app/927840/Clinically_Dead/?curator_clanid=41324400) using [Urho3D](https://urho3d.io/).

Luckily, one of the core contributors of Godot Engine happened to end up in the same University and was persuaded to join the team. [Tomasz Chabora](https://twitter.com/KoBeWi_) (KoBeWi) is making all the things work properly.

### Why did you choose Godot for your project?

It comes down to Godot being Open Source. We knew that we needed custom modifications for destructible terrain, dynamic lightning, and support for thousands of swarm monsters. All this is rarely supported in any engine out of the box. Additionally most of our team was already familiar with Godot.
Paweł and I are teaching classes on simulations and game dev that are heavily based on Godot Engine mostly due to Godot being perfect for fast prototyping.
When you want to create a new feature for your game it might just take a few hours to see it will work.

### Which parts of the game development process did you enjoy the most while working on your project?

The most enjoyable part of the game development is of course implementing new features. We went over many iterations on all kinds of systems and elements. The process overall can get mundane sometimes, but once you finish your cool spear combo or flashy lava particles or extremely complex custom map editor that does wonders under-the-hood, looking at the final result and playing it is a very satisfying experience. Some of the features were added just because they were fun to code and have this “cool” factor about them.

### Which parts of the game development process did you find the most difficult to apply in your project?

The most difficult part is to decide what features should be implemented and resist the urge of adding new features. Because we want to keep our game simple, yet we have many ideas that standalone are cool, but mashed up together may result in something that is not working well. We still don't know if the game is balanced enough, which is why we are on Early Access to check what works right and what doesn’t. We will tweak things based on player feedback as we want to make the game as good as possible.

### How has Godot helped you advance on your project? Which aspects of Godot do you consider to be its strength?

GDScript is my favorite as you can do a lot with a little bit of code.

The scene system gives much needed flexibility to create your own building blocks that create a level when brought together. Overriding properties like script variables, or sprite color via modulate property, allows to make asset variations easily.

Another thing that was quite useful is the option to quickly test shaders. Being able to see the results of a shader the moment you change some code makes development so much better.

And finally Lumencraft would not be possible without Godot being open source. Having the option to add custom modules is just wonderful.

### How do you find Godot's multi-platform support, both for the editor and your final project?

We launch on Windows and Linux for now. We got the game working on Mac as well. Also Linux build works almost out of the box on Steam Deck console.

Most of us use Windows for development, but we have one Linux developer. Our experience was mostly seamless, with the only problems emerging at C++ level due to compiler quirks between platforms.

### Which challenges have you encountered when using Godot?

We struggled a lot with proper multiple resolution support. While this is mostly straight-forward and well-documented, Lumencraft required the ability to change fullscreen target resolution and that wasn’t obvious to achieve, especially when multiple in-game effects are full screen shaders that needed to match the screen size and resolution. Because of that we are still missing support for different aspect ratios (for now at least). Because we all had the same system specs and didn’t test different setups. When we realized there was a problem, it was too close to the release date.

### Which features would you like to see in future versions of Godot?

We would like to make use of compute shaders and array uniforms in shaders. Much of our custom tools needed tricks to pass the data around. One example is the debris particles interacting with 2D terrain. That one was tricky.
An option to generate mipmaps from viewport textures is coming back regularly. Currently you can't do that and multiple VFX had to be dropped because of that.

### Would you use Godot for a future project?

We are actively waiting for the next Godot version. ;)
We like the freedom to modify source code and implement features on top of C++ code base. We hope to upgrade Lumencraft to Godot 4 in the future.

___

*Lumencraft is available on [Steam](https://store.steampowered.com/app/1713810/Lumencraft/?curator_clanid=41324400) and [GOG](https://www.gog.com/en/game/lumencraft) for Windows, Linux and Steam Deck.*

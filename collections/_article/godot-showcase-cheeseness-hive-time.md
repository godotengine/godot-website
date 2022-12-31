---
title: "Godot Showcase - Hive Time developer Cheeseness talks about his experience"
excerpt: "We've invited Cheeseness to talk about his project, Hive Time. it was released in December 2019 and is available on Windows, macOS and Linux."
categories: ["showcase"]
author: Hugo Locurcio
image: /storage/app/uploads/public/602/e98/120/602e98120ec23097807599.png
date: 2021-02-18 15:30:00
---

Welcome to the third developer interview following the [introduction of the Godot Showcase page](https://godotengine.org/article/new-showcase-for-projects-made-with-godot)! This week, we've interviewed Cheeseness about his project [*Hive Time*](https://godotengine.org/showcase/hive-time).

___

### Introduce yourself in a few sentences.

My name is Cheese, and I'm an Australian independent game developer/Linux porter/freelance generalist based in the small island of Tasmania. I've been making games in some form or another for over thirty years now.

I like to contribute to Free/Open Source Software projects when I have time, and release my own work under F/OSS and open culture licences when appropriate. I've even made some small contributions to Godot itself. I enjoy photography, playing guitar, and long, long walks in the wilderness.

### Introduce your project in a few sentences: description, supported platforms, release date, etc.

[Hive Time](https://cheeseness.itch.io/hive-time) is a bee-themed management sim, which invites players to construct a generational bee hive and manage its population's diversity. It's cute, silly, and has a big heart.

I released Hive Time for Linux, Mac, and Windows on the 12th of Beecember 2019, and shipped a [large update](https://cheeseness.itch.io/hive-time/devlog/147869/v11-the-informational-update) coinciding with World Bee Day on the 20th of May 2020.

Hive Time is $10, but in the interests of making sure it's still accessible to people who aren't able to afford that and to explore the [dynamics of pay-what-you-want models](http://cheesetalks.net/hive-time-finances.php), I decided to release it with a minimum price of $0.

### How did you discover Godot? When did you start using it? Do you have prior experience with other game engines?

I first came across Godot when backing The Interactive Adventures of Dog Mendonça & Pizzaboy on Kickstarter back in 2014, but I think the first project I used the engine for was a prototype for [Super Happy Fun Sun](http://shfs.twolofbees.com/) developed as part of a game jam in 2015.

Over the years, I've worked on projects that have used GoldSrc (Half- Life 1's engine), Serious Engine, Unity, SLUDGE, Adventure Game Studio, jMonkeyEngine, Blender Game Engine, and SCUMM/Remonkeyed Engine. I've also worked on games that have been built from scratch or use frameworks rather than general purpose engines like SDL, SFML, and Allegro.

For the past six years, I've been writing my own game engine called [Icicle](http://icicle-engine.org/), which is written in C/C++, using SDL and OpenGL.

### Why did you choose Godot for your project?

I'd previously attempted to make a 3D game in Godot in 2015 (it would have been a third person plafomer about a ladybug), but my initial experiments before the jam I was planning to use it for weren't yielding the kind of results I was after.

The next time I had the opportunity to try again, Godot had come a long way, and I was able to develop the initial [Hive Time prototype](https://cheeseness.itch.io/hive-time-prototype) during a 10 day game jam.

### Which parts of the game development process did you enjoy the most while working on your project?

For me, the most enjoyable part of both making and playing Hive Time is sitting back and watching my little bees bumble arund and go about their business.

I also loved going out to local honey farms to record bees, and it was wonderful to see/hear Peter's work on the soundtrack breathe extra life into the game.

### Which parts of the game development process did you find the most difficult to apply in your project?

Broadly speaking though, the game came together with very few signficant design or production hurdles. I worked hard to lean on my existing development and project management experience and keep the game's development timeframes tight and overheads small.

### How has Godot helped you advance on your project? Which aspects of Godot do you consider to be its strength?

I felt like Godot enabled me to pull the core game together very quickly. The most attractive parts of the engine for me come from its nature as a Free/Open Source Software project and the ability that gives me to debug, fix, or modify the engine to suit my personal needs.

I also feel more comfortable using free and Free tools because I can be confident that if others want to follow in my footsteps, financial or philosophical hurdles won't prevent them from doing so.

### How do you find Godot's multi-platform support, both for the editor and your final project?

I pretty much exclusively developed Hive Time on Linux, so I didn't have much opportunity to expose myself to the editor tools' multi-platform support.

I'm glad that Godot allows me to deploy builds for all my supported platforms from my Linux build server without having to involve other operating systems or set up cross-compiling pipelines.

### Which challenges have you encountered when using Godot?

I've struggled a little with performance optimisation, and the now-addressed dangling variants bug likely caused the majority of unidentifiable problems that had been reported in the wild.

Unclear or incomplete documentation has been a long time friction point for me. Things have definitely improved on that front over the years, though there's always room for improvement. These kinds of hurdles are rarely significant and the option to fall back on reading engine code is always there, but cumulatively, these can add up to be a reasonable time sink across a large project.

### Which features would you like to see in future versions of Godot?

I'd love to see an option to treat underscores as punctuation for the purposes of text navigation. I run custom editor builds that already do this, but that applies to all string handling engine-wide rather than just the editor tools, so it's been difficult to formulate that into a patch that I can contribute upstream.

### Would you use Godot for a future project?

I plan to!

___

*Hive Time is available on [itch.io](https://cheeseness.itch.io/hive-time/) for Windows, macOS and Linux.*
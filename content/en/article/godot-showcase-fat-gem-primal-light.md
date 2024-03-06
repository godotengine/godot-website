---
title: "Godot Showcase - Primal Light developer interview"
excerpt: "We've interviewed Fat Gem about their first released project Primal Light. It was released in July 2020 and is available on Windows, macOS and Linux."
categories: ["showcase"]
author: Hugo Locurcio
image: /storage/app/uploads/public/604/11f/d88/60411fd88eb88947959052.png
date: 2021-03-04 17:00:00
---

Welcome to the fourth developer interview following the [introduction of the Godot Showcase page]({{% ref "article/new-showcase-for-projects-made-with-godot" %}})! This week, we are interviewing the studio Fat Gem about their first game *Primal Light*.

___

### Introduce your studio in a few sentences.

Hi, I’m Shane Sicienski. My friend Jeff Nixon and I make games together under the name Fat Gem.

### Introduce your project in a few sentences: description, supported platforms, release date, etc.

Primal Light is a linear 2D action platformer for Windows, Mac, and Linux. It was released on July 09, 2020 and is available on [Steam](https://store.steampowered.com/app/771420/Primal_Light/).

In the game, you play as Krog, a one-eyed blue caveman wearing a red loincloth, who is on a quest to save his tribe from an evil moon god.

The game features 10 challenging levels with arcade-style combat reminiscent of the 16-bit era. As you progress, you acquire new acrobatic abilities which allow you to overcome obstacles and enemies. Each level ends with a gruesome boss.

### How did you discover Godot? When did you start using it? Do you have prior experience with other game engines?

Around 4 years ago, I was learning how to program (in order to do natural language processing) when it suddenly dawned on me that I had probably learned enough to be able to make a game. I prototyped a little top-down Zelda clone and showed it to my friend Jeff one night while we were hanging out at his apartment. We were so excited by the prospect of making a game that he dove headfirst into pixel art and I into programming. That was around August 2017.

We started making Primal Light in Python (using the [PyGame](https://www.pygame.org/news) module), but when we started getting serious about the project, we decided to shift to a full-fledged engine.

I had seen Godot come up in comments on [Game Development Stack Exchange](https://gamedev.stackexchange.com/) with people describing it as “Pythonic”, so it seemed like a natural candidate for me.

At that time, I didn’t have experience with any engines outside of PyGame, but since then I’ve become proficient in GMS2 and Unity, in addition to Godot.

### Why did you choose Godot for your project?

When we were deliberating on moving to a full-fledged engine, I had seen Godot come up in comments on [Game Development Stack Exchange](https://gamedev.stackexchange.com/) with people describing it as “Pythonic”, so it seemed like a natural candidate for me. The fact that I am also a big fan of Samuel Beckett didn’t hurt Godot’s chances with me.

### Which parts of the game development process did you enjoy the most while working on your project?

Jeff and I both enjoyed designing bosses and boss battles.

### Which parts of the game development process did you find the most difficult to apply in your project?

Jeff and I were flying by the seat of our pants on this project, as it is our first game. We encountered difficulties all over the place, but our sheer excitement at making a game sustained us. We found level design intimidating at first, but, like lots of things, it becomes fun once you try to study it and learn its mysterious rules.

### How has Godot helped you advance on your project? Which aspects of Godot do you consider to be its strength?

Godot has a ton of strengths. A few come to mind. First, Godot uses the pixel as the native unit of measurement, which makes it ideal for 2D games. Second, Godot has a much better implementation of coroutines than other engines (and coroutines are a game developer’s best friend). Third, Godot’s signal system provides an out-of-the-box implementation of the observer pattern that is more intuitive that what you have in other engines (for example, using C# events). Finally, Godot has better animation tools than other engines I have worked with.

### How do you find Godot's multi-platform support, both for the editor and your final project?

We developed Primal Light on both Windows & Mac and had no issues whatsoever, even on old hardware (I started development on a 2008 MacBook). We built for Windows, Mac, & Linux, and found it a breeze, even accommodating Steam integration across all three platforms using the life-saving [GodotSteam](https://github.com/Gramps/GodotSteam) repo. Godot’s option to toggle between GLES2 and GLES3 also makes it easy to build for specific rendering architectures if needed.

The only issues we encountered were some inconsistent capitalization in our filenames causing crashes on case-sensitive OSes, and using the same variable name in both a local and nested local context causing crashes on Mac (both easily fixed).

### Which challenges have you encountered when using Godot?

We had some thorny issues with pixel jitter when our camera would settle on the player, but I think that’s a cross-engine problem which plagues pixel art games in general.

We tried to use Godot’s native Camera2D offset when implementing screenshake, but offset alone wouldn’t allow the viewport to traverse camera limits if the camera was adjacent to them. I filed that as a bug on GitHub and Godot devs fixed it in Godot 3.1 or thereabouts.

We originally had Light2Ds littered throughout the game (for example, for candle effects), but it caused severe performance issues. This was a known issue for Light2Ds back then. I think I heard that Godot devs recently made strides in improving their performance, but I’m not certain.

### Which features would you like to see in future versions of Godot?

I think Godot has an excellent feature set as is, and I am typically a fan of minimalism. Some of the larger engines have bloat that irritates me aesthetically.

I know some people would like to see a sprite editor in the engine (similar to what you have in GMS2), but I never encountered a use case for that in my own development.

I recall a Twitter poll recently which asked Godot users what should be focused on in the near future. I voted for improvements to tilemap functionality, which was the frontrunner at least at that time.

### Would you use Godot for a future project?

One hundred times yes!

___


*Primal Light is available on [Steam](https://store.steampowered.com/app/771420/Primal_Light/) for Windows, macOS and Linux.*

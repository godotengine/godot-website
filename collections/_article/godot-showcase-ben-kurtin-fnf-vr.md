---
title: "Godot Showcase - Friday Night Funkin' VR developer talks about his experience"
excerpt: "We interviewed Ben Kurtin about his VR recreation of the hit rhythm game Friday Night Funkin', which is made with Godot!"
categories: ["showcase"]
author: Hugo Locurcio
image: /storage/app/uploads/public/61e/c59/4ad/61ec594adad2c161680389.png
date: 2022-01-22 18:15:00
---

Welcome to a Godot showcase developer interview! This week, we interviewed Ben Kurtin about his experience developing and releasing a VR recreation of the hit rhythm game *Friday Night Funkin'*.

___

### Introduce yourself in a few sentences.

Hi! I'm Ben Kurtin, better known as ThisIsBennyK on [YouTube](https://www.youtube.com/channel/UCu7zwXQxp4rHmGhW9Dmulkg), [Twitter](https://twitter.com/ThisIsBennyK), and [TikTok](https://www.tiktok.com/@this.is.bennyk). I've made several games in the past couple of years, with projects ranging from a simple 2D platformer to the very VR rhythm game being showcased here; and that was all done while I was self-taught. Now I'm currently going to college to, quite literally, learn how to make games. My secondary hobbies are graphic design and video creation, both of which are evident based on my social media.

### Introduce your project in a few sentences: description, supported platforms, release date, etc.

Friday Night Funkin' VR (FNFVR) is a VR recreation of Friday Night Funkin' (FNF). FNF is the most recent smash hit indie rhythm game (which is also open source!), and it's like if DDR had the style of PaRappa the Rapper. FNFVR lets you experience all the cartoony glory the game provides for yourself: you get to see all the wacky characters up close; you get to be in the stylized environments they're in; and, of course, you get to jam out to the awesome songs while you're fighting for your life to spend time with your girlfriend.

FNFVR has already been released for Windows and both Quests on [Itch](https://thisisbennyk.itch.io/funkin-vr) and [SideQuest](https://sidequestvr.com/app/4089/friday-night-funkin-vr), but me and my team are consistently working on updates to it whenever we've got the chance. In fact, we're already working on the 6th week (or level) from the original game as we speak. I've also been making a better engine for both 2D and potential 3D mods for FNF using Godot, which we will be porting FNFVR to. As for when the next update comes up... well, no promises, but hopefully by the end of January!

### Your game got [some traction on YouTube](https://www.youtube.com/watch?v=QpgxxARRqxI) such as on channels like Weegeepie. Can you tell us a little about that experience?

It's been surreal to see how much traction FNFVR has gotten. I couldn't believe my eyes when the Week 2 preview I posted on TikTok garnered a million views in just a few days. And to see quite a number of respected YouTubers play and enjoy the game is astounding. I've even seen some YouTubers that I used to watch as a kid play the game, and that's just crazy to me. I feel like I have to pinch myself whenever that happens!
I'm extremely thankful for anyone who's made a video about FNFVR. It means the world to me that you all wanted to play it and show it off. It's helped me kickstart a lot of opportunities, like my YouTube channel and quite a few new friends, and for that I'm eternally grateful!

### How did you discover Godot? When did you start using it? Do you have prior experience with other game engines?

All my life I've wanted to make video games, so I've dabbled in quite a few game engines, but most things I tried to make as a kid didn't get finished. I started trying to make complete game projects in high school with Unity, but I became frustrated using it. After graduating (around summer 2020), I decided to search for a game engine that was easier to use and still just as feature rich. That's when I happened to find Godot. Like with any new thing you try, it took me a little bit to understand the basics. But after completing my second game jam project with it and being actually satisfied with my results despite having only picked it up recently, I knew it was my engine of choice.

### Why did you choose Godot for your project?

Well, I had already been using Godot for around 6 months when I decided I was going to make FNFVR, so I figured it would be easier to work with an engine that I was already familiar with. Plus, this is actually my second VR game made in Godot, so I wanted to improve from my last VR project. And boy did I improve!
In general, I chose Godot because, like I said before, I wanted something easy to work with. Maybe it was also for a bit of that counterculture feeling, since even when I picked up the engine in 2020, Godot was a niche engine. Of course, now I've been hearing lots of talk about it. In fact, I know a few professional software developers who have been using Godot for their game projects for the same reason: it's easy! While it does take away from the nicheness of the engine, that's not a change that I mind. I'm glad that more people are starting to use it.

### How was your experience building a VR game specifically?

It's a lot tougher than making a 2D or a non-VR 3D game, that's for sure. Not because it's necessarily harder to program or harder to make assets for, but it's much, much harder to debug. You have to put on the headset, wait for it to wake up, hit F5 awkwardly with the headset on, and then kind of peer through the nose gap to see the info you get on screen. And if you run into an error, you have to take off the headset, put it in a safe place, edit the code, and then rinse and repeat this process until you get it running stably. Simply put, it's tedious and a pain in the butt. Despite that, the satisfaction you get from seeing your work come to fruition when you put on the headset is incredible!

### Which parts of the game development process did you enjoy the most while working on your project?

Like many other game developers, I enjoy seeing the final product come together harmoniously. This effect has been magnified during the development of FNFVR, because there's something magical about seeing a game you enjoy from a different perspective. Besides that, however, FNFVR has given me deep insight on how to make a good rhythm game. Over several iterations, I've learned how to make an extremely accurate timekeeper (usually referred to as the Conductor, similar to the person who keeps tempo for an orchestra), as well as a highly flexible note and lane system. These revised components will be making their way into an upcoming update for the game. I'm very proud of the work I did for those and had a lot of fun making them! I hope they can be reused in other Godot rhythm game projects that I make or that others make (since the code will be open source, in the spirit of FNF).

### Which parts of the game development process did you find the most difficult to apply in your project?

I'm very new to 3D game development, and I only had a little experience prior to FNFVR. It was an arduous process figuring out how to get the player model right. At first, I was going to use inverse kinematics, similar to how VRChat works, but fortunately one of my fellow VR enthusiast friends guided me in the right direction and suggested floating hands. Not only that, but with a bit of hindsight, I've figured out that the game is extremely unoptimized in so many different ways. I'm going to be fixing this very shortly with my newfound knowledge (such as: it's actually a bad idea to make every model local since all the data of each model is duplicated into text).

### How has Godot helped you advance on your project? Which aspects of Godot do you consider to be its strength?

I've said this to others when talking about Godot, and I'll say it again: Godot is very good for making games quickly. The rapid and hotfix prototyping that Godot provides made it possible for me to learn the engine quickly and then make a VR game quickly. The first prototype of FNFVR was made in around two weeks if I remember correctly. Granted, I worked my butt off for those two weeks, but I guarantee you that trying to do the same thing in other VR-compatible game engines would have been a slog. Even besides FNFVR, almost every game in Godot has been made quickly and efficiently (even with my spaghetti code in earlier projects!), which is something I truly appreciate about the design of the engine and the editor.

### Which challenges have you encountered when using Godot?

I did encounter a few issues, mostly nitpicks, during the development of FNFVR:

- Some documentation leaves something to be desired. For instance, the SkeletonIK node, a node that would be very useful for controlling a VR avatar, has zero documentation on it. Or the PCKPacker, which is useful for an upcoming update for FNFVR, does not have a great tutorial on how to use it, so I had to brute force my way into learning how it worked.
- Blendshapes / shape keys simply don't work in the GLES2 renderer. For those reading who don't know, blendshapes, or shape keys, are parameters that morph a part of a 3D model to have a different shape. It's typically used for facial animations, like lip sync. This means the faces of every character in the game, which are controlled by these blendshapes, do not work on the Quest. There does seem to be an open request to fix this, which I would implement myself if I was confident enough to debug an entire game engine.
- Animating 3D stuff in-engine. I had to write my own custom code just to be able to animate the 3D models myself. Fortunately, I now work with people who are better at animating than I am, but I did find it odd that 3D skeleton animation was not built-in like it was for 2D.
- By far the biggest challenge of the project was learning how to properly use (and then promptly almost never using) `yield` statements. Because they can't be interrupted or destroyed (which is bad for pausing and quitting out of levels), I've decided to use signals for almost every event I need to handle. While this does produce uglier code, it makes it more flexible and ultimately allows us to be more creative with levels!

### You ported your game to the Quest. How was that experience?

While the Quests have been a major step up in affordable and accessible VR, it's not fun to develop for the standalone side of them. Having to switch renderers, design and manage levels so that they look the same on both platforms, debug across devices, and do operating-system specific set-up is a slow and tedious process. This process is so slow and tedious that I might've given up on developing for the Quests if they didn't happen to have the largest share of all personal VR users (and incidentally, the large share of our player base). I can only hope that the move to OpenXR and the eventual release of Godot 4.0 makes it easier to develop for the Quest platform.

### Which features would you like to see in future versions of Godot?

Most of the features I already wanted to see in Godot are actually coming in 4.0, which I'm pretty happy about. If possible, having those blendshapes work in GLES2 would be great to have (unless 4.0 is coming soon enough to fix that problem). However, my #1 request would be for AnimationPlayers to have the same easing options as Tweens do; that would be very useful. Otherwise, Godot already packs quite the punch with the features it has, and I can't wait to see what you guys are working on in future updates!

### Would you use Godot for a future project?

If you ask some of my friends what they know about me, a couple possible answers are: "Ben never shuts up about Godot" and "Ben sounds like he's sponsored by Godot." I think that's a sufficient enough way to say "yes, absolutely!"

___

*Friday Night Funkin' VR is available as a free download for Windows, Quest and Quest 2 on [Itch](https://thisisbennyk.itch.io/funkin-vr) and [SideQuest](https://sidequestvr.com/app/4089/friday-night-funkin-vr). The project's source code is also available on [GitHub](https://github.com/this-is-bennyk/Funkin-VR).*
---
title: "Godot Showcase - Dogwalk"
excerpt: "Julien and Simon from Blender Studio tell us about their experience working on Dogwalk."
categories: ["showcase"]
author: Emi
image: /assets/showcase/dogwalk/thumbnail.jpeg
date: 2025-07-12 22:00:00
---

<style>
.julien {
	color: #aa77e2;
}
.simon {
	color: #40b99f;
}
</style>


Today we want to showcase a very special project. Most of you already know about it since it is really hard to go around any Godot space without finding people excited about Dogwalk. So if somehow you didn't know about the project or you still haven't been captivated by their [video blogs](https://www.youtube.com/watch?v=c4zP1sUgt6I&list=PLav47HAVZMjkxzzLDqYpTCosbsWjosUN0) over at YouTube, you are in for a treat! <strong class="julien">Julien Kaspar</strong> and <strong class="simon">Simon Thommes</strong> from the [Blender Studio](https://studio.blender.org) team tell us about their experience developing their first Godot game: Dogwalk. 

The game is already out on [Steam](https://store.steampowered.com/app/3775050/DOGWALK/), [Itch.io](https://blenderstudio.itch.io/dogwalk), and you can also get the project files with tons of extras from [their website](https://studio.blender.org/projects/dogwalk/). 

<iframe width="560" height="315" src="https://www.youtube.com/embed/gPENs56vfYk" frameborder="0" allowfullscreen style="width: 100%; aspect-ratio: 16 / 9; height: auto;"></iframe>


## Can you tell us a little bit about your project?

<strong class="julien">Julien:</strong>
For this year the Blender Studio, which is the in-house art department of the Blender project, decided to focus on smaller short-term projects. We aimed for four months for each of them so I saw the unique chance to pitch a tiny game project. And the scope really had to be tiny to be able to pull off a game for the first time.

Dogwalk is a short, wholesome interactive story about a dog and a kid decorating a snowman together. One big focus was on wordless storytelling through reactive gameplay. 
It’s not strictly about fun or overcoming challenges. It’s about allowing the player to shape and experience the relationship between the two characters, simply by constraining the player to a small set of mechanics and have the game react to what they do with that.

![](/assets/showcase/dogwalk/dogwalk-1.jpg)

## Why did you pick Godot to develop this project?

<strong class="julien">Julien:</strong>
One of our primary missions (and constraints) is that we demonstrate how people can make entire movies by only using free open-source software. We call these “Open Projects” since we also licence them as open source and make the sources available.
So for a game project it seemed natural to use Godot for it. Personally I’m a fan of the engine and project, and was quite excited to be able to use it for a professional project in a team.

Every one of our projects also comes with some Blender-specific development targets. In this case we took a closer look at the export and import of glTF animations and assets. We created a pipeline for ourselves to stress-test the interoperability between Blender and Godot as much as our production scope allowed us. 

![](/assets/showcase/dogwalk/dogwalk-7.jpg)

## How did the project compare with your past experiences as a studio who usually does animation movies rather than games?

<strong class="julien">Julien:</strong>
Pretty different. One big change is the shift from storyboarding/editorial to game prototyping/playtesting. In our film productions the story artists and animators would typically helm the project, but in this case I was doing it with an emphasis on development and design. It put us in very different shoes.

The animation and rigging workflow is also very different. Animators don’t have the usual fine level of control and instead need to playtest the game to see the animations applied in action. We were also not used to rigging for export and game engines in mind, so we made some mistakes on that side that needed creative problem solving later on.

But the biggest hurdle was to have the entire art team use Git LFS for version control. That was … quite a journey.

## How did you find the current export pipeline from Blender to Godot?

<strong class="simon">Simon:</strong>
We were quite impressed immediately with how seamless the base level compatibility was. As an initial test we had built a demo environment in Blender and exported it as one big glTF to throw it in Godot. Everything just worked. That’s definitely nothing to scoff at.
Of course, we had a more refined pipeline setup in mind that would allow us to collaborate and iterate on assets and sets from within Blender.
But the extensible ecosystem of Godot and using glTF made it possible for us to hook up anywhere in the process and inject our own functionality. Coming in from outside, I was really quite surprised how powerful our available options are without a core understanding of how the engine works.

## Were there any quirks with the way the material rendering and animations were converted from Blender to Godot?

<strong class="simon">Simon:</strong>
We actually ran into a couple of issues with our stop motion animation style, which apparently seems to not be very common for game animation. So both on the export and the import level there were some parts that made assumptions over keyframe interpolation causing some obscure issues that took quite some investigation. But now those are all resolved.
Since Godot was always our target for rendering, there were some shader features that we didn’t replicate for the preview that we had in Blender. That’s mainly the fake paper thickness, for which we had two separate effects. But since the effects are so subtle, it wasn’t really required for the asset creation process.
We’re also not used to having to make drastic cuts due to performance, coming from usually doing offline rendering. So there were some rendering features that we had to disable and replace with some clever lighting cheats to save the frames.

![](/assets/showcase/dogwalk/dogwalk-8.jpg)

## Are there suggestions for improvement in this context?

<strong class="simon">Simon:</strong>
Most of the things we ran into, we reported right away and they have already been fixed. It’s been great to see how actively the Godot community has been responding to the issues we found.
There have been some other more big-picture issues that we ran into when collaborating as a team and using versioning. This mainly relates to UIDs and caching going out of sync.
Since these issues are usually complex and relate to our pipeline and people’s individual systems, these were a bit more tricky to identify and report. Especially with the additional burden of our art team using git for the first time, it wasn’t always clear what were issues that were actually caused by Godot.
I really hope that we can find the time to sit together with some Blender and Godot developers to see what we can collectively take away from these issues and potentially change to make sure collaborating as a team using Blender and Godot is a smooth process.

## While making your game, were there any features that were sorely missing in Blender or in Godot?

<strong class="julien">Julien:</strong>
Nothing that couldn’t be added manually or fixed with workarounds. 
With one of the main gameplay and visual elements being the leash, sadly there was no Line3D node. But luckily the community had a [handy plugin](https://github.com/CozyCubeGames/godot-lines-and-trails-3d ) to immediately fill in that gap.
We also ran into some limitations with our animation system, but that [will be fixed in the upcoming 4.5 release](https://github.com/godotengine/godot/pull/102398#issuecomment-2949711987).

![](/assets/showcase/dogwalk/dogwalk-4.jpg)

---

Thank you very much Julien and Simon for taking the time to answer our questions, and we look forward to see what you do next with Godot!

If you want to play Dogwalk, it is free and already out on [Steam](https://store.steampowered.com/app/3775050/DOGWALK/), and [Itch.io](https://blenderstudio.itch.io/dogwalk). Make sure to get the supporter DLC on Steam, donate via Itch, or subscribe to Blender Studio if you are interested in seeing more projects like this in the future.


---
title: "Godot Showcase - Material Maker"
excerpt: "RodZilla talks about his experience developing Material Maker, a procedural PBR material creation tool made with Godot."
categories: ["showcase"]
author: Hugo Locurcio
image: /assets/showcase/material-maker/header.jpg
date: 2025-10-14 14:00:00
---


Today, we want to showcase [Material Maker](https://www.materialmaker.org/), which is an open-source application made with Godot. Material Maker is designed to create materials and textures for use in physically-based rendering (PBR). As a reminder, Godot is more than just a game engine; using its [UI building blocks](https://docs.godotengine.org/en/stable/tutorials/ui/index.html), it is possible to create full-featured applications for desktop, mobile and web platforms. In fact, the Godot editor is made with Godot itself!

Material Maker had its 1.4 release in early October. This marks a significant milestone in the project, as this is the first version to be running on Godot 4. We interviewed its author, RodZilla, about how this project came to fruition and what its future might look like.

<iframe width="560" height="315" src="https://www.youtube.com/embed/8QzDPzJhVs4" title="Materials created using Material Maker" frameborder="0" allowfullscreen style="width: 100%; aspect-ratio: 16 / 9; height: auto;"></iframe>

## Can you tell us a little bit about yourself and your project?

Hello, I'm Rodolphe Suescun, also known as RodZilla. I am 53, I live in Grenoble, France, and work as a senior software developer in the microelectronics industry, mostly on electronic design automation tools and embedded software.

I've been into game development as a hobby for 25 years, mostly learning, experimenting, and creating prototypes.

I started Material Maker back in 2018 because I wanted to create 3D games but was not very good at drawing textures. I put the project on GitHub and itch.io without much of a plan, and didn't really communicate about it. Then one day, GameFromScratch made a video about my project, downloads started rising, and a community began forming, first on Reddit, then later on Discord.

When Material Maker reached 10,000 downloads, GameFromScratch encouraged me to apply for an Epic MegaGrant, which allowed me to spend a bit more time developing the project for a few months.

Although it is perceived as a procedural texture authoring tool, Material Maker is mainly about generating shaders which is why it has a few uncommon features, such as exporting shaders for Shadertoy, or animated or even raymarching materials for game engines. This is also what makes it so much fun to develop.

Material Maker now has almost 250 nodes and can export to Godot, Unity, and Unreal. It is also possible to create new nodes (either by assembling existing nodes or by writing their code using [Godot shading language](https://docs.godotengine.org/en/stable/tutorials/shaders/shader_reference/shading_language.html)) and new export targets.

Another key part of the project is the website, where artists can share the amazing materials and nodes they create. It is the best showcase of what the tool can do, and a nice source of examples for new users.

Finally, I'm no longer alone and Material Maker has a few active contributors such as williamchange, Jowan-Spooner, and NotArme who helped a lot on the 1.4 release.

## Can you give us some examples of games developed with the help of Material Maker?

The first two games that come to mind are [Crown Gambit](https://store.steampowered.com/app/2447980/Crown_Gambit/?curator_clanid=41324400) and [Zefyr: A Thief's Melody](https://store.steampowered.com/app/1344990/Zefyr_A_Thiefs_Melody/), which were both released on Steam in June.

*Crown Gambit* is a narrative dark fantasy deck-building game (made with Godot!). Rachel Dufossé, who worked as a 2D/3D artist on the project, joined our Discord server two years ago, asking questions and showing her work from time to time, while actively promoting Material Maker in the studio she works for, Wild Wits Games. She ended up giving a talk about her work with Material Maker to Atlangames, the network of video game companies in her region.

*Zefyr: A Thief's Melody* is an action-adventure game with nice Wind Waker and Beyond Good and Evil vibes. Mathias Fontmarty, the solo developer of this project, did not interact as much with the community, but gave a few talks about Material Maker at conferences (such as Capitole du Libre in Toulouse).

Those are beautiful projects, and it is always a real pleasure to see users carry the Material Maker flag in their own way, whether by creating amazing games or by sharing their experiences.

I can mention a few others, released or soon-to-come, such as [Chrono Weaver](https://store.steampowered.com/app/2053370/Chrono_Weaver/), [Beyond the Space Wall](https://store.steampowered.com/app/3697370/Beyond_The_Space_Wall/), [Blocky Ball](https://store.steampowered.com/app/1343040/Blocky_Ball/), [Polylithic](https://store.steampowered.com/app/1839060/Polylithic/), [KOOK](https://store.steampowered.com/app/2329690/KOOK/?curator_clanid=41324400), and [Neverlooted Dungeon](https://store.steampowered.com/app/1171980/Neverlooted_Dungeon/).

Note to readers: the 1.4 release has a new splash screen that shows games, shaders, and materials created with Material Maker, so please feel free to contact me on Discord if you used it for your game.

![Material Maker splash screen featuring Crown Gambit](/assets/showcase/material-maker/material-maker-4.webp)

> One of Material Maker's many splash screens; some of them are even animated!

## What were some of the biggest challenges you faced during the development process, and how did you overcome them?

At the very beginning of the project, nodes were nearly hardcoded in GDScript and I soon realized it was a huge mistake. So I had to take a step back and come up with a generic way of describing the shader code used by nodes and assembling them. Then I added an editor for those shader nodes, which made node creation really easy.

I am not sure it was that big of a challenge, but it took a few weeks of not touching the code, and thinking about use cases and code generation to come up with the right solution. Although shader code generation has been improved and extended since then, it has not changed that much.

Exporting to other game engines was a bit challenging. I had to understand how they handle materials and come up with a convenient export workflow. Unreal needs a material graph and I didn't find an easy-to-generate file format for it, so Material Maker generates a Python script that creates the graph when executed in Unreal (I know it is an ugly solution).

This challenge is not completely solved, though. When exporting dynamic materials to Unreal and Unity, Material Maker "translates" the generated GLSL shader code to HLSL. This part will need to be rewritten at some point, based on a proper GLSL parser.

Of course, there is optimization, mainly to decrease rendering time for generated textures. And there is still a lot more to be done.

On the non-technical challenges side, I would say that evolving from a "lone wolf working on personal projects" mindset to interacting with a very nice community of users and contributors was not without glitches. But I guess it was a well-needed evolution.

## The project is under the MIT license and available for everyone [at GitHub](https://github.com/RodZill4/material-maker). What made you decide to make the project free and open source?

I have been an open-source software user (and advocate) for quite some time. I think I installed Linux for the first time back in 1993. If I remember correctly, that was about 30 floppy disks.

When I started Material Maker, it was just an experiment I intended to use to create textures, so I shared it under the MIT license, just like all prototypes you can find on my GitHub.

And for me it is a hobby anyway, so it was never meant to be paid software.

That said, donations pay for the domain name, the <abbr title="Virtual Private Server">VPS</abbr>, the "Apple tax", and whatever hardware I needed to develop Material Maker and port it to all supported platforms, and I'm pretty happy with that. Huge thanks to everyone who supports this project!

![Beehive material graph and preview](/assets/showcase/material-maker/material-maker-2.webp)

> Material showcased: *Beehive* by RodZilla (included in the `examples/` folder with Material Maker)

## How did you discover Godot? What made you pick it for your project?

It is really funny that I discovered Godot just like Material Maker gained its current visibility. I discovered this game engine while watching a video from GameFromScratch covering Godot around the time it went open-source.

I tried it for a few very small game prototypes (including one featuring a silly mouse for my very first game jam) and I must admit it immediately clicked for me. Godot was far from what it would become, but I already loved the nodes approach and how natural the overall design felt.

I've been using Godot for all my game development projects and prototypes ever since, and it consistently proves easy and efficient to work with.

## Material Maker 1.4 is the first version to be running on Godot 4. What upgrades does Godot 4 bring to your project?

The main change that Godot 4 brings is compute shaders which give a lot more flexibility for shader generation and help improve performance. I also used them to introduce new generated meshes (rounded cube and cylinder) to replace the default ones.

Support for multiple windows made it possible for me to add flexible layout with undockable panels, and I will probably expose this part as a Godot addon so other application developers can reuse it.

I also started using the new GDScript features (mainly typed arrays and dictionaries), but it will take a long time before all of Material Maker's code is updated.

![Pavement Generator material preview](/assets/showcase/material-maker/material-maker-3.webp)

> Material showcased: [*Pavement Generator* by Tarox](https://www.materialmaker.org/material?id=548)

## What challenges have you encountered while upgrading the project to Godot 4? What would you like to see implemented?

The main challenge for me was learning the new [RenderingServer](https://docs.godotengine.org/en/stable/classes/class_renderingserver.html) and [RenderingDevice](https://docs.godotengine.org/en/stable/classes/class_renderingdevice.html) and finding out how to best use compute shaders for Material Maker's use cases. Also, API changes between releases have been a bit annoying, but that's the price to pay when using bleeding edge releases.

The only thing I'm missing for Material Maker is support for saving EXR files in the release templates. I currently have to use custom-built templates for Material Maker. This is not much of an annoyance since I only have to recompile Godot whenever I use a new release.

But speaking of possible improvements for Godot, while doing game jams with my team, we noticed Godot makes it hard for audio designers to do their job without diving into the whole Godot project (since sounds are triggered wherever there is an AudioStreamPlayer node). I wrote a small addon (called TRAudio and [available on my GitHub](https://github.com/RodZill4/TRAudio)) that tries to bridge the gap between the audio designer and the software developer, but I think Godot would benefit from supporting this natively. The addon is OK in most use cases, but triggering sounds in animations is not as convenient as it could be.

## Do you have any new features or improvements in mind for Material Maker in the future?

Of course, Material Maker has a roadmap, but I generally do not communicate much about it so I do not promise anything my limited free time does not allow.

That said, Material Maker 1.0 (and all previous releases) were about delivering a nice toolkit for creating seamlessly tileable materials. And 2.0 will focus on texturing 3D models (and 1.4 is a step in that direction with the new Mesh Map node).

The painting tool in Material Maker is a nice prototype and can do quite a few impressive things (brushes are completely procedural and described by connecting nodes), and in 1.4, all PBR channels can be painted by a single compute shader. But it becomes way too slow with complex brushes, and the end result of each stroke is stored in the final textures of the painted layer. So we start with a procedural brush, and lose the procedural aspect while painting (which defeats the purpose of the approach).

So instead of improving the current painting tool, I'm thinking of introducing very basic painting features in the material authoring tool. By "very basic", I mean painting simple masks that can be applied to parts of the graph, or UV maps that will help place a procedural shape or pattern using a CustomUV node. Thus painting would become a guide for procedural generation, which would allow an interactive yet nearly non-destructive workflow for texturing models.

And in the short term, the [EasySDF node and its corresponding dialog](https://rodzill4.github.io/material-maker/doc/node_simple_easy_sdf.html) (that is used to edit 2D and 3D Signed Distance Functions) will get an update, on both UI and code generation sides.

![Broken Floor material graph and preview](/assets/showcase/material-maker/material-maker-1.webp)

> Material showcased: [*Broken Floor* by Tarox](https://www.materialmaker.org/material?id=975)

## How can one learn to use Material Maker?

This is probably the weakest point of this project. There are [nice video tutorials made by Kasper Arnklit Frandsen](https://www.youtube.com/watch?v=mSuyrsJSZ_o&list=PLI2XkW0E3DLhYDu30nxSiUsdBS-ziIbbo) and [a few more advanced ones by Pavel Oliva](https://www.youtube.com/watch?v=yKQRfrxJRLM), but they are a bit old. It is also possible to follow Substance Designer tutorials; the nodes are different, but the concepts are the same.

Another great way to learn is to [grab materials from the website](https://www.materialmaker.org/materials) and study their graph.

In any case, you probably want to [join our Discord server](https://discord.gg/RnHgQS9Nqq). Material Maker has a very nice and welcoming community.

Material Maker definitely needs a few good-quality "official" video tutorials and I really need to make sure they happen.

## Thank you for sharing your experience using Godot. Is there anything you would like to plug?

Although I mainly mentioned Material Maker, I recently participated in six [Godot Wild Jams](https://godotwildjam.com/), followed by a [Godot XR Game Jam](https://itch.io/jam/godot-xr-game-jam-sep-2025), with a truly awesome team (now named Cularo Games). We're now planning to push one of those projects further. The lone wolf in me will soon be gone for good.

---

Thank you RodZilla for taking the time to answer our questions! We look forward to the future of Material Maker.

[Material Maker](https://www.materialmaker.org/) is free and open-source. It can be downloaded for Windows, macOS, and Linux on [itch.io](https://rodzilla.itch.io/material-maker). Along with the [GitHub repository](https://github.com/RodZill4/material-maker), there is also a [subreddit](https://www.reddit.com/r/MaterialMaker/) and [Discord server](https://discord.gg/RnHgQS9Nqq) you can join to interact with its community.

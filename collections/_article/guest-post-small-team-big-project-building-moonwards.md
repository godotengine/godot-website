---
title: "Guest post - “Small Team, Big Project”: Building Moonwards"
excerpt: "Moonwards is an in-development open source sandbox MMO built with Godot. In this guest post, some members of the Moonwards team give us insights into how they approach building such a complex project with Godot."
categories: ["news"]
author: Hugo Locurcio
image: /storage/app/uploads/public/600/f16/4a1/600f164a1426d584796163.jpg
date: 2021-02-15 14:00:00
---

*[Moonwards](https://www.moonwards.com/) is an in-development [open source](https://github.com/moonwards1/Moonwards-Virtual-Moon/) sandbox MMO built with Godot. In this guest post, some members of the Moonwards team give us insights into how they approach building such a complex project with Godot.*

We are the team behind [Moonwards](https://www.moonwards.com/), a sandbox MMO being built in Godot. Yes, we know that’s awfully ambitious. But that’s OK. The world needs something like this.

<video title="Moonwards promo video" width="1280" height="720" controls>
  <source src="/storage/app/media/moonwards-godotblog1.mp4" type="video/mp4">
  Sorry, your browser doesn't support embedded videos.
</video>

Moonwards is the experience of building a world together. That world is an advanced town on the moon designed on hard science and engineering. It starts with a vast set of habitats and infrastructure, and a detailed development timeline based on solid known technology. The community that takes up residence there – by making actual homes and offices – then brings it alive, fills it in, and advances it. Because this world depicts a future that is entirely feasible, it provides a unique reward – a sense that your participation influences the world towards a better future. For the same reason, it can call for support from a resource few games can – the industry devoted to building the future it depicts, that being the space industry.

We need to draw in the many space engineers out there starving for the kind of space development they imagined when they chose their careers. Moonwards gives them a place to express those visions, but they will need help from game developers interested in providing the tools they need to do so in a game environment. The Godot community is clearly the best one for this. From the beginning, we’ve financially supported Godot as much as we can. As Moonwards grows, it will be providing a series of add-ons back to the community for any project to use, adapted from our code. Our architecture is also being designed to be a platform for game devs looking for a great place to test, experiment, showcase, or browse other developers' ideas.

Our three lovely devs can explain - Karim, Yael, and Zach. Read on…

## Architecture - by Karim Rizk, Project Manager

Moonwards is meant to be an MMO, hence possibly thousands of game entities needing to be acted upon, then networked in real-time. This accounts for a lot of data going back and forth, and a need for accessible, predictable & clearly defined states. What’s more, Moonwards is meant to be a sandbox, eventually spanning a number of interactive dynamic systems.

### Sounds great, let's try ECS!

I’m a big [Entity Component System](https://en.wikipedia.org/wiki/Entity_component_system) advocate. I love the paradigm! But no, not this time. ECS is great, flexible, performant, it’s all you could wish for in many circumstances and it can be made invisible to the end user, while still providing a higher-level interface. More than that, it’s conveniently network-able code, you get beautiful GameStates out of the box – sequential data, vectorized iterations and all that lovely stuff. However, Godot is not ECS, simply put. Converting Godot to fit our needs in such a manner does prove troublesome and counter-productive, with the following in mind:

- The Godot Scene Tree is a tightly knit beast. Branches, leaves and all.
- Chances are, custom engine additions would break on 4.0. And we will be migrating to 4.0.
- Time-cost factor grows a lot. Which we’re very limited on.

Not to misunderstand, it could have definitely been done. It’s more so about the trade off – is it worth it to commit the time? Do you even have the time? Our answers were mostly “no”. And so it was decided.

### The “S” is for "no thanks"

So, Godot’s scene tree is already heavily composition-based. This is surely great, right? Right…
The problem here is, it’s mostly object-based composition. A scene could easily depend on its children, possibly its neighbors and parents to exist, and catch fire if they don’t. Godot lets you do that, although one could argue that if it doesn’t work, it’s the developers’ fault. That is exactly why we’re looking for an alternative - so there can be lots of developers who collaborate informally without things breaking.

It's also meant for linear gameplay. Construct your scenes however, and they’ll work – it’s the definition of a “scripted game”. For a networked sandbox? That doesn’t work so much. We need predictability and our actors decoupled. We also need reusability where possible. This calls for another ECS concept:  “[Archetypes](https://ajmmertens.medium.com/building-an-ecs-2-archetypes-and-vectorization-fe21690805f9)”.
With that in mind, we set out to find a future proof alternative. One that is as intuitive and easy to use as the Scene Tree paradigm, and that complements it. And importantly, easily refactors down the line.

We unsarcastically present to you the Entity-Component-Tree paradigm.

### How it should work – Entity-Component-NoSystem

The approach: leverage the Tree, keep everything composition-based and sneak in your entities unnoticed. Use the good parts of the engine. Create your base layer of code in migratable fashion, to be moved to GDNative later. This opens the door for your networking layer to produce game states, through Entities, while not being invasive, nor coupled to any part of the Tree.

And no, this is not actual ECS, but it gives us the flexibility we want. We have Archetypes, we have decoupled Entities, and simple, predictable building blocks. Minus the performance benefits of ECS. All while being a fit to the already existing Scene Tree structure, and only depending on core Godot features.

### The rules

- Entities are independent, decoupled beings. They can exist alone, and provide state regardless of the existence of their components, or the game for that matter.
- Components are encapsulated, self-sufficient building blocks. They contain necessary extra data & logic to function on a given Archetype, and act upon their parent entity, or themselves.
- Components run in order.
- Ideally, only Entity states need be networked, components remain hidden to the network layer.

To give an analogy, Entities are your SceneTree, and components are your Nodes. Kinda. Close enough? Following these rules, the result should be a global interface for all – or realistically, most – of your actors, and a plug-n-play style development cycle. Minimal coupling. An Entity would contain state and expand into multiple components, each unfolding into further data and logic.

A more complete explanation can be found [here](https://0x0.st/NIm2).

![Alternative SceneTree layout diagram](/storage/app/media/SceneTreeLayout-Alternative.png)

## Add-on: The NPC Editor - by Yael Atletl, Tools Programmer

I’ve been a developer at Moonwards for 2 years now and though I’ve had many roles and done many things, from debugging, refactoring code, networking, fixing materials and more, lately I’m the NPCs and tools guy. I made the Dialog system (and its editor), the Workstations and Navigation system and most importantly, the NPC Editor - and the NPCs that use it.

The editor has been a constantly evolving idea. It began as a simple interpretation of a Bungie Publications’ presentation that talked about Halo 3’s behavior trees. Later on, I learnt about State Machines and found out these two concepts could mix pretty well.

### The current concept

The NPC Editor creates State Machines and Behavior trees. The resulting NPC is a “State Machine” where every state is a different Behavior Tree.
The concepts of “Stimulus” (Signals), “Inhibitors” (functions with returns) and “Actions” (functions without returns) are the main components of the Behavior Tree.
The Behaviors and extra information, like the character’s name and colors, are stored in the State Machine.

To modify the signals and functions available to the tool, one has to modify the `Definitions.gd` file and create a script that extends NPCBase and contains your custom functions.
Even if the files generated by this tool are intended to be used inside Godot, they are not specific to the engine and could be used in Unity, Unreal Engine or a custom engine (with slight modifications to use their filesystem).

<video title="NPC editor" width="1280" height="720" controls>
  <source src="/storage/app/media/npc-editor.mp4" type="video/mp4">
  Sorry, your browser doesn't support embedded videos.
</video>

### What’s left to be done?

- As it currently stands, the State Machine that uses the NPC doesn’t change states in a particular, predictable order, and though that is the desired behavior for now, I plan to implement a way to specify which state or set of states loads next.
- The addon currently depends on having cohesion on the programmers side: all the nodes defined in a special file (`Definitions.gd`) should have a function of the same name in a custom NPC Script that extends NPCBase. Ideally, the Definitions would be created at load, using the functions in the custom NPC script.
- Currently there’s only support for the first input slot of a GraphNode, soon I’ll implement a way to set and get the NPC’s variables inside the Behavior Tree editor, so these can be used in other input slots.
- There’s plenty of room for optimization, as many parts of the NPCBase could benefit from GDNative’s speed or using a different approach from signals and connections.

You can read more about the development process [here](https://810dude.blogspot.com/2021/01/NPC-Editor.html).

## Add-ons: the Logger Console and Doc Generator - by Zachary Shea, Programmer and UX design

You might know me from the Godot Discord as *Zach777#3000*. All the Moonwards devs wear many hats, but we still have a certain set of hats we wear more often. My frequent hats are UI programming, UX design and tool development. I take a lot of general programming tasks too, of course. While I would love to dive into my plans for improving Moonwards' current UI code and the best practices I have learned, today I will be talking about the addons being developed because of Moonwards.

The addon I think will be the most useful no matter a project's size is the custom Logger Console. Having detailed log messages helps when you are trying to test or debug. With the large number of log messages our scripts generate, the in-editor logger console cannot keep up and it is hard to use command line interfaces to read the log messages in real time. So we built a custom logger and a way to filter log messages by log type.

All log types can be toggled on or off. The custom Logger Console in game will then dynamically add or remove the logs messages from the shown log history that match that toggled type.

<video title="Debug panel" width="1280" height="720" controls>
  <source src="/storage/app/media/debug-panel.mp4" type="video/mp4">
  Sorry, your browser doesn't support embedded videos.
</video>

With just a little bit of work, we can make the Logger and Logger Console an add-on for anyone to use. There are a few features we would like to add first though before official addon release:

- Make the color schemes recognizable for all types of color blindness.
- Variable displays. Quickly add variables to watch in real time from the console.
- Filtering logs by class that generated the log.
- Filter logs by the name of the node that made them.
- Filter by group the node is in.
- The addition of a temp log level that will store logs you make while testing code.
- A setting for release versions to store logs in a way that is unobtrusive for players and easy for devs to check.

Another addon that will be of help to the Godot community is the Docs Generator. A tool for automatically generating documentation by reading your project's GDScript files. The documentation generated is styled like Godot's read the docs pages.  All generated docs will be saved as files in the directory of your choosing as Markdown files. This way you can choose how to best integrate them within your chosen documentation website. The tool is currently in early alpha, so not all features are implemented yet. You can take a look at the early prototype [here](https://github.com/Zach777/Docs-Generator). Connect with me on [Fosstodon](https://fosstodon.org/@Zach777) or [Twitter](https://twitter.com/xXZach777Xx).

I have a lot planned after the initial alpha release of Moonwards. The two plans I am most excited for are refactoring Moonward's UI scene and resource management to serve as an example of best practices. Our team's other plan is making a tool for any project to let players make custom controls in game.

*You can join the [Moonwards](https://www.moonwards.com/) community on [GitHub](https://github.com/moonwards1/Moonwards-Virtual-Moon), [Discord](https://discord.gg/x4A9FsZxFv) and [Reddit](https://www.reddit.com/r/Moonwards/).*

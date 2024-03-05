---
title: "Godot 4.0 will discontinue VisualScript"
excerpt: "Godot's visual scripting language, VisualScript, was introduced in Godot 3.0, almost five years ago. Despite our continuous effort, it never gained traction and the path to improve it was never clear. Because of this, for Godot 4.0, we decided to accept that the approach we took from the start was simply not the right one and decided to remove it from the engine. If enough volunteer interest exists, it may be moved to an extension."
categories: ["news", "progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/630/52d/76e/63052d76e024a243584746.png
date: 2022-08-23 00:00:00
---

Godot's visual scripting language, VisualScript, was introduced in Godot 3.0, almost five years ago. Despite our continuous effort, it never gained traction and the path to improve it was never clear. Because of this, for Godot 4.0, we decided to accept that the approach we took from the start was simply not the right one and decided to remove it from the engine. If enough volunteer interest exists, it may be moved to an extension.

To be clear, this refers to the **VisualScript** scripting language, and not to visual shaders. Visual shaders are working well and appreciated by many users, so they're not going anywhere.

### Origins

One of the most requested features when Godot 2.1 was around was visual scripting. At the time it seemed like just another feature request. Still, this one had a peculiarity: It was a feature that many *yet to be Godot users* wanted in order to use Godot.

Most features in Godot are requested by users actually *using* the engine, not by potential users. Nowadays, in fact, Godot proposal system is designed in a way where feature proposals must meet the requirement of being needed for actual projects. That was not the case back then.

So, we ran a poll to determine which kind of visual scripting users wanted and most mentioned Blueprint style.
With this information, VisualScript was created and published for Godot 3.0.

It was not perfect, but it contained most of what we believed was needed to use it. Using it was similar to GDScript but in a graphical, node-based way.

## Unable to meet expectations

Unfortunately, VisualScript did not catch on. When trying to ask users why they did not use it, we got two main answers:

1. For a lot of potential users that wanted this feature, they found out GDScript was a great fit and they pretty much ended up preferring it over VisualScript. They did not expect to find GDScript to be so easy to learn and use (even if they did not have prior programming knowledge), given none of the popular engines of the time offered this type of high level scripting. For many of these users, Godot ended up being a tool to learn programming instead.
2. Even though the visual scripting base functionality was there, Godot lacked high level components to make use of it. Engines like Unreal, Game Maker or Construct offer high level game features packaged together with the visual scripting solution. This is what makes it useful. Godot is an *extremely* general purpose game engine where it's easy to make those features yourself, but they don't come packaged out of the box. As such, VisualScript by itself was of little use.

Another likely reason for VisualScript's low popularity is that we failed to provide good documentation for using it. The official documentation has examples in GDScript and C#, but we never succeeded in including VisualScript examples due to technical reasons (we'd have to make screenshots of VS graphs for each example and maintaining them would prove very difficult). We had some demo projects, but that's not enough to let users become proficient with a language, even a visual one – and to learn Godot's API, they'd need to become familiar with GDScript or C# to understand the examples.

According to our most recent poll (with more than 5000 respondents), only 0.5% of the user base has used VisualScript as their main engine language.

![Poll results showing the most used programming languages in Godot](/storage/app/uploads/public/630/526/086/630526086cf01605139233.png)


## No path forward

The contributor community did improvements to it, but for the most part these were mostly based on assumptions of what could be improved since, for pretty much all features we implement in Godot, we always get user feedback indicating us what needs to change, via issues or proposals.

VisualScript was the exception, we struggled to get enough feedback to improve it meaningfully. The conclusion we can draw from this is that there simply wasn't any path forward: the approach we took to visual scripting was simply not the right one.

## Removing and maybe moving to extension

VisualScript will be removed from the codebase in Godot 4.0 (it will remain supported in Godot's 3.x branch).

As VisualScript was implemented as an optional module, the relevant code was moved to a dedicated repository so that interested users could still compile it in, if there is interested in keeping it up to date: https://github.com/godotengine/godot-visual-script

One possibility is to convert it to an official GDExtension using [GodotCPP](https://github.com/godotengine/godot-cpp), which is very mature now and should support everything required to do this. As an extension, it may work better as a ground for experimentation and improvement. For this to happen, however, there have to be volunteers wanting to make this happen and spend the time required to research a path forward. If you are interested, get in contact with us on the `#scripting` channel on the [Godot Contributors Chat](https://chat.godotengine.org).

## Retrospective

Godot development philosophy has shaped very strongly to focus on finding solutions for user problems and real-life use cases. VisualScript was not developed this way, and hence we were unable to implement something useful, costing us significant development time. This has been a great learning experience and it reinforces our belief that Godot must always be developed user-facing first.

## Future

There are some ideas floating around by contributors on implementing alternatives to do visual scripting, more similar to tools like Game Maker or GDevelop. Anything that is done will most likely still be an extension, as this provides more flexibility to experiment with quick feedback from users, and to provide lots of high level and even game-specific components without adding a significant maintainance burden on the core engine.

The VisualScript removal from the core engine will happen before Beta (which is now very close!). Even though it's gone, we are still thankful to all the effort that many contributors put on it over the past years to try to keep it alive, even if ultimately we were unable to make it user-friendly enough to attract user interest!

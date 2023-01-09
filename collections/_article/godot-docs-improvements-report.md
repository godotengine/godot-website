---
title: "Godot docs improvements report"
excerpt: "Some of you like the docs for what it covers already; others dislike it for what it lacks. The team's well-aware there is always room for improvement, and so they hired me to work part-time on it since September. Here are all the changes you can already enjoy today!"
categories: ["progress-report"]
author: Nathan GDQuest
image: /storage/app/uploads/public/5fc/8fe/e80/5fc8fee80a1e9162541704.png
date: 2020-12-04 02:05:00
---

Some of you like the docs for what it covers already; others dislike it for what it lacks.

The team's well-aware there is always room for improvement, and so they hired [me](https://twitter.com/NathanGDQuest) to work part-time since September.

My job was to take the maintainer's role for about two months and tackle some high-priority tasks. As such, I got to do a mix of reviews, editing, writing new content, and maintenance.

Here's a report on the changes and the new content you can already enjoy today.

In everything I wrote or edited, the goal was to **simplify the language**, improve precision, **organize** the information, and generally enhance your experience reading the docs.

Note: you can find the changes in the [bleeding-edge manual](https://docs.godotengine.org/en/latest/). We haven't back-ported them to the "stable" documentation yet as there are over 100 pages to redirect. More on that below.

We'll start with the boring stuff and finish with the re-written getting started series.

## The audit

The job started with an [audit](https://github.com/godotengine/godot-docs/issues/3969) of the existing manual. I read the manual from start to finish and took notes about the parts that needed edits, a re-write, to move, or that were missing.

From there, I created individual issues so both contributors and the team could see what's missing. I also triaged hundreds of existing issues and reviewed, edited, and merged dozens of pull requests, many pending since months ago. I also reviewed contributions to the class reference for a time.

## Reorganization

I moved about 150 pages to improve your browsing experience. The sections now have clearer names, some were merged, and many files moved to more appropriate sections. You will now find sections dedicated to [rendering](https://docs.godotengine.org/en/latest/tutorials/rendering/index.html) and [performance optimization](https://docs.godotengine.org/en/latest/tutorials/performance/index.html), for example.

![menu-reorganization.png](/storage/app/uploads/public/5fc/8fe/6fa/5fc8fe6fae97d632718971.png)

This change involves registering as many redirections on the back-end, affecting every version of the online manual. This is the main reason we haven't included the changes in the "stable" docs.

## Content and contribution guidelines

The guidelines are much simpler and are now split into shorter pages based on your interests. The new [contributing section](https://docs.godotengine.org/en/latest/community/contributing/index.html) now gives you a better overview of how you can help.

We have new [content guidelines](https://docs.godotengine.org/en/latest/community/contributing/content_guidelines.html) to define what should and shouldn't go into the docs.

Until now, we accepted a bit of everything; we lacked a clear direction and quality standards. These guidelines give us clear goals and help to set priorities for the online manual.

We are moving towards delivering a complete reference manual, the perfect companion to the class reference, and moving away from game-specific tutorials that we could never manage to keep up-to-date. The only exceptions are the two "your first game" tutorial series for new users.

## The new "step-by-step" series

The series of articles introducing new users to Godot was a bit of a melting pot. It always lacked a clear target audience, coherent style, tone, and teaching goals.

Yet, it's essential to nail this one because it's the first experience tens of thousands of new users will have while learning Godot. It introduces key concepts you need to know to understand Godot and that other tutorials online don't necessarily cover.

I re-wrote it entirely to make it more accessible, avoid introducing many new concepts at once, and generally provide you with a more coherent series.

![nodes_and_scenes_3d_scene_example.png](/storage/app/uploads/public/5fc/8fe/bd6/5fc8febd65f7c670216153.png)

It starts with an [introduction](https://docs.godotengine.org/en/latest/getting_started/introduction/index.html) to Godot to answer the most common questions newcomers have: what can it do for me? How does it work? Do I need to know programming to use it? You then get to learn some key concepts, have a first look at the editor, and learn how to make the most of official learning resources and maximize your chances of getting support on the QA site or Discord.

The [step-by-step series](https://docs.godotengine.org/en/latest/getting_started/step_by_step/index.html) now covers the essentials in a relatively short amount of time.

The goal here is to get you to the point where you can follow the "your first game" tutorials as fast as possible, so you can apply what you learned early on and get results quickly.

_Note: the extra pages moved to other sections, and I improved some about scripting._

There is now a complete [Your first 3D game](https://docs.godotengine.org/en/latest/getting_started/first_3d_game/index.html) tutorial series to introduce you to 3D game creation with Godot. That was commonly requested, and it's now available.

![dodge.png](/storage/app/uploads/public/5fc/8fe/924/5fc8fe924a214204296490.png)

The game itself is similar to the 2D one, with a twist, for learning purposes. It will help you spot similarities and differences working with 2D and 3D in Godot. They're complementary tutorials, yet we've designed them so you can read only one or the other if you so desire.

## What next

This job was funded by a generous donor who requested that the money went to the docs' specifically. We've invested it in a range of tasks that we felt would give you the biggest value for the budget and help onboard more contributors in the future.

There is always more to do, and more you can get. Completing the manual is a colossal yet essential job for you and tutorial-makers to learn the beast that Godot is.

Yes, on top of you, tutors need good documentation to create the tutorials everyone loves, starting with me.

But to fund more quality work on the docs and Godot, we need you.

Consider [becoming our patron](https://www.patreon.com/godotengine) on Patreon today!
---
title: "Godot 3 at the Capitole du libre"
excerpt: "We met with Julian and Gilles at the Capitole du Libre 2017 in Toulouse. It's one of the largest French events dedicated to Free Software.
We went there to showcase Godot 3 and try to introduce new users to it. Here's our report, with a bonus presentation."
categories: ["events"]
author: Nathan GDQuest
image: /storage/app/uploads/public/5a2/678/7be/5a26787bebf13417068091.jpg
date: 2017-12-05 12:00:00
---

We gathered with [Julian](https://github.com/StraToN) and [Gilles](https://github.com/groud) at the [Capitole du Libre 2017](https://2017.capitoledulibre.org/) in Toulouse. It's one of the largest French events dedicated to Free Software. We went there to showcase Godot 3 and try to introduce new users to it. Here's our event report.

Passing the word to Gilles Roudière himself.

## Gilles' perspective

Julian (*StraToN*) and I (Gilles a.k.a. *Groud*) spent most of our time at the Godot stand. We used Fracteed's demo to showcase the engine, along with Zylann's Wallrider.

We met a lot of friendly people interested in Godot. Enthusiasts, hobbyists, and even some Unity users looking for an alternative to their game engine!

More importantly, we met people who are deeply involved into the game development community. Especially those from the Toulouse Game Dev association, which regroups both hobbyists and professional game developers in Toulouse. They even asked us to organize a presentation of the engine. Besides, we managed to sell some shirts, bringing 152€ to the project.

<figure>
<img src="/storage/app/uploads/public/5a2/667/59b/5a266759b5be9948536480.jpg" alt="A stack of official Godot shirts at our stand" />
<figcaption align="center">Picture courtesy of <a href="https://photo7.input.fr/">Photo N7</a></figcaption>
</figure>


We held a workshop based on [KidsCanCode's tutorial](http://docs.godotengine.org/en/latest/learning/step_by_step/your_first_game.html). We're very happy about the interest it brought. 25 persons came so the room was almost full. Even if we did not manage to finish the tutorial in two hours, all participants left with a serious playable prototype, with a moving player and enemies. It seems that nobody got lost in the process, which shows that Godot is accessible to beginners.


<figure>
<img src="/storage/app/uploads/public/5a2/667/9f5/5a26679f56d53373043307.jpg" alt="Gilles teaching Godot at the Your First Game workshop" />
<figcaption align="center">Picture courtesy of <a href="https://photo7.input.fr/">Photo N7</a></figcaption>
</figure>


We would like to thank everyone involved in the event. It was very good, well-organized and welcoming. Big thanks to Fracteed and Zylann for their demos. All presentations at the event should be available soon on the Capitole Du Libre 2017, in French. The presentation from [GDQuest](https://twitter.com/NathanGDquest) is available in English below.


## Giving a talk about Godot

I prepared a complete Open Source presentation ( [sources on GitHub](https://github.com/GDquest/godot-3-presentation) ) for everyone to use. It covers some of Godot 3's new features and talks about **what sets Godot apart from other engines**: its design principles and its health as an open source project. A good presentation takes long hours of prep work: now you don't have to start from scratch anymore.

The goal was to answer some of the most common questions creators may have about the engine:

- What is Godot?
- What can it do?
- Can I trust it?
- How does it work?
- How do I get started?

The first idea was to use [reveal.js](https://revealjs.com/#/), an open source, web-based presentation framework. This would make the presentation easy enough to edit and available to everyone: it allows you to write slides as JSON.

In the end I picked a riskier, but a more interesting option: the presentation runs in Godot 3. It's a more playful way to introduce people to the engine: you can include a real-time game demos, use the particle engine... hopefully other Godot contributors can help to enrich it up in the future too.

You can **watch the presentation** right here:

<iframe width="560" height="315" src="https://www.youtube.com/embed/4v3qge-3CqQ?rel=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>

The engine being in alpha, it was still a bit buggy and took some workarounds to make it work. The developers had to merge a fix for the `VideoPlayer` to work only a few days before the event.

The presentation was met with relative success. It's available in French and English thanks to Daniel Marais, and it's completely open source. The code is under the MIT license, you can do whatever you want with the assets, and there are some videos and pictures that Godot users kindly accepted to let us use. You'll find a slide at the very end of the slideshow with credits and links.

![GDQuest giving the Godot 3 presentation at E-artsup Lyon, a game creation/art school](/storage/app/uploads/public/5a2/673/8a3/5a26738a31155771786730.jpg)

You're welcome to use, customize, or even to re-distribute it to your heart's content. You're also more than welcome to make it available in more languages! Luiz Gustavo is already at work on a Portuguese version.

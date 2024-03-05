---
title: "Godot and consoles, all you need to know"
excerpt: "The topic of running Godot games on consoles pops up very often. In this article you will find information about how console development works, the challenges that Godot faces for supporting those platforms and which alternatives exist to publish your games for them."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/62d/161/b64/62d161b640268831834229.png
date: 2022-07-15 00:00:00
---

The subject of running Godot games on consoles pops up very often. In this article you will find information about the following topics:

* How console development works.
* The challenges that Godot faces for supporting those platforms.
* Which alternatives exist to publish your Godot games for consoles.

### What is the consoles market like?

While platforms like Steam are very easy to publish for, the reality is that most of the revenue from independent developers generally comes from consoles (this, of course, speaking of devs not focusing on mobile).

Consoles are cheap, easy to get access to, and have a wide catalog of first and third party titles, making them ideal devices for players wanting to spend their time and money on games.

### How does one develop for consoles?

Unfortunately, consoles are entirely closed ecosystems. This means that there is a very simple rule that must be followed in order to develop for them: **Unless you sign an NDA** (Non Disclosure Agreement) and the manufacturer approves you, it is **impossible for you to obtain any kind of information** in regards to how they work (and much less publish games).

This means that, on the whole public Internet, **you will not be able to find** (legally, at least):

* Any **detailed public documentation** on how consoles work (that was not reverse engineered).
* Any **official tools or libraries** that let you develop or run your game on consoles.
* Any **downloadable game engines** that, out of the box, include support for developing or exporting to consoles.

This **includes game engines such as Unity or Unreal**. To obtain the console versions of those, you **must get licensed**, sign the NDA, get approved and then download the version that lets you develop on consoles from a secret console development portal. It is a common misconception that you can download a game engine and start using it to develop for consoles without previously being approved by the console manufacturer.

The only exception at some point was exporting to the UWP platform which _could_ run on XBox, but it had limited access to the console internals and was eventually deprecated by Microsoft.

### Where does Godot fit is in all this?

Godot is a free and open source (FOSS) game engine, published under the MIT license. Development is made entirely in the open. Because of this, it **is impossible for Godot to include first-party console support** out of the box. Even if someone would contribute it, we simply **could not host this code** legally in our Git repository for anyone to use.

Additionally, it would **not be possible to distribute** this code under the same license that Godot uses (MIT) because this is in direct conflict with the proprietary licenses and non-disclosure terms that console manufacturers require to have access to the knowledge needed to write this code.

To make it simple, it **is not possible for Godot** to support consoles as an open source project.

### Can it be done in secrecy?

Some projects such as [LibSDL](https://www.libsdl.org/), [Haxe](https://haxe.org/), [Monogame](https://www.monogame.net/), [Cocos](https://www.cocos.com/) or [Defold](https://defold.com/) developed console ports behind closed doors and offer them to licensed developers for free, so the question arises often about whether Godot can do this too.

The answer is that, Godot is not in the same situation, because:

* Godot is orders of magnitude more complex than any of those projects. Porting the platform layer can be relatively simple, but **porting the rendering engine** and making sure it works well is extremely laborious. Hiring talent that can do this properly can be in the order of hundred thousands of US dollars. Given consoles are exclusively a commercial market, It is very unlikely that anyone would do this for free if it can't be made open source afterwards.
* Additionally, save for SDL (which is the simplest of them all given its just a platform layer), all the other projects are actually **developed by companies** with an actual business model, such as the Haxe Foundation (which is actually a company), Microsoft, Cocos China, or King for Defold (then Refold).

Godot **is not developed by a company**. It is a pure open source project developed by individuals entirely in the open, so it has **no alternate business model** to sustain the cost of developing console ports at loss.

Additionally, the difficulties **do not end there**. Obtaining the source code for console development can be useful for some independent developers, mainly those who are strong in technology, but this is not how console manufacturers prefer to work.

In consoles, any technology that is offered to develop titles for them must be an **official, licensed middleware**. This means that, for companies to use them, they require that:

* It must **support the platform efficiently** (the port must be optimized for it).
* It must **support the platform APIs**, such as save files, online APIs, peripherals, dedicated hardware, etc as best as possible.
* There must be **some level of technical support** for companies using the technology in the platform.

Unless the above points are met, obtaining official middleware category is not possible, which means that most companies will still not be able to port their Godot games to consoles, even if they can get the source code.

In all, supporting consoles properly **is very costly** and beyond the possibilities of Godot as a project to do so.

### So, how do I get my Godot game into consoles anyway?

The best way to do this right now is to work with companies that will port and publish your Godot game to consoles. Because these companies act as the publishers, they are **not required to license the technology to you** (and thus avoid the costly process of becoming middleware providers). For most independent developers also, porting to consoles is not easy because they need to meet a lot of technical requirements, so working with a company that does for them is generally still desired.

Links to companies that do console porting for Godot titles:
* [Lone Wolf Technology](https://lonewolftechnology.com/)
* [Pineapple Works](https://pineapple.works/)
* [GOTM](https://gotm.io/about/gpp)
* [Flynn's Arcade](https://www.flynnsarcades.com/)

Most smaller studios working on games with Unity and Unreal also rely on third party companies to ensure that their ports are done properly and pass all the console comformance requirements.

The last alternative is to do the console ports yourself. This is what Sega did for Sonic Colors Ultimate, but only large studios with a strong technical background are assumed to be able to do it.

### Future

One can only wish that, as consoles nowadays are almost nothing more than [openly documented](https://www.amd.com/en/technologies/rdna) stock hardware (very distant from the specialized hardware that we saw until the PS3/Wii era), the secrecy requirements are going to be eased at some point in the future. Efforts can be seen from Nintendo and Microsoft in this direction already.

Still, until (if) this happens, it is possible that some of the existing (or new) companies that specialize in Godot for consoles may become licensed Godot middleware providers, but it must be clear that this **is a very costly process** so they will need to make revenue somehow and adoption will depend on the strategy they take towards independent and corporate entities.

Hoping that this dissipates most of the doubts regarding to Godot on consoles. If you have further questions, let us know!

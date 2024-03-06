---
title: "A decade in retrospective and future"
excerpt: "The dawn of a new decade looms and there is a lot of excitement about the future of Godot! But it was not always like this, as the previous decade did not go as expected.."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/5e0/b8b/0c0/5e0b8b0c04557983735004.png
date: 2019-12-31 00:00:00
---

The dawn of a new decade looms and there is a lot of excitement about the future of Godot! But it was not always like this, as the previous decade did not go as expected..

### The beginning

Ten years ago, Ariel Manzur and I were convinced that our future was going to be as entrepreneurs, using to our advantage the vast experience we amassed as game technology consultants during the 2000s and the tools (by that time already called Godot, as far as I remember) that we had created for use by our clients.


![Early 2010s screenshot of Godot before the open sourcing](/storage/app/uploads/public/5e0/b83/849/5e0b838492e95726884765.jpeg)
*Early 2010s screenshot of Godot before the open sourcing*


We were strong in technology, but we lacked the rest, so we decided to join the very talented and creative people from Okam to work together. As we wanted to continue using the technology we developed before (and were not interested on selling it, we wanted to make games), we made it open source and put it on GitHub.

Things did not really go as planned though. Even though the company had a stellar take off, to the point we managed to work for companies like Square Enix, Turner, etc. and even made our own games (Dog Mendonça), the truth is that the country we live in (Argentina) is too unstable politically and economically, which made it very difficult and stressing for the company to continue operating.

![Games made with Godot before open sourcing](/storage/app/uploads/public/5e0/b85/d9d/5e0b85d9d3edb853495694.png)
*Games made with Godot before open sourcing*


### Change of plans, Godot becomes a hobby

At the time (around 2014), I was just planning to move away and start over somewhere else, in a region with a more stable economy. In the meantime, I went back to work as a consultant (and started specializing in game business consulting too) and Ariel remained working as his own company (Lone Wolf Technology). For me, Godot became more or less a hobby. It was fun to get feedback from users, which would often complain about how terrible usability was (of course, Godot had always been a licensed and in-house engine). Almost no one would contribute code for a long time, so all I did was fix the issues reported by users in my free time.

After a year, [version 1.0 was released]({{% ref "article/godot-engine-reaches-1-0" %}}). This was cool but users really complained about the many limitations of the 2D engine (and 3D being outright unusable), so many months of work resulted in a 1.1 release with [improved 2D features]({{% ref "article/godot-1-1-out" %}}).



![Screenshot of Godot 1.0](/storage/app/uploads/public/5e0/b86/9eb/5e0b869ebd618160831355.png)
*Godot 1.0, released in December 2014*


Usability remained as the main complaint, though. Users still had to go through a lot of steps to do things that were simpler in other engines. Their feedback was heard and, several months later, [Godot 2.0 came out]({{% ref "article/godot-engine-reaches-2-0-stable" %}}). The work on improving usability continued until [2.1 finally came out]({{% ref "article/godot-reaches-2-1-stable" %}}) at the end of 2016.


![Screenshot of Godot 2.0](/storage/app/uploads/public/5e0/b86/b5e/5e0b86b5e5873141503256.png)
*Godot 2.0, released in February 2016*


### Godot starts growing

Users were beginning to be happy with 2D, so I moved focus to improving the 3D part of the engine, modernizing it and implementing physically based rendering and some more modern features. At the same time, the amount of issues and pull request opened kept growing and I was starting to lose grasp of everything (remember that, at the time, I was doing consulting as my main full time job, and working on Godot on the side).

In parallel, the project was blessed by the arrival of Rémi Verschelde in 2015, who quickly took over project management and the interaction with all contributors. That allowed the project to start expanding in code, docs, etc. much faster than before. Rémi took over release management, which meant maintenance releases for stable branches (2.0 was the first release to get 2.0.x maintenance versions).

At the same time, the work towards 3.0 took an unexpected turn. As before being open, Godot was used in many commercial projects (for both our clients and later our company), a lot of the code-base remained set in stone to avoid breaking compatibility. This led to a very long TODO list of things that would be nice to refactor. But this was no longer a problem at this time, because we had no longer any commercial obligation with anyone regarding the code-base.

Because of this, Godot 3.0 took much longer than expected, as we performed a massive refactor of most of the code-base, resulting in huge usability gains (and huge compatibility breaking that many of our users hated, sorry :( ).

By the time Godot 3.0 was released, it had begun amassing a very significant community of users and contributors. Still tiny compared to other technologies, but enough to put it on the radar.



![Screenshot of Godot 3.0](/storage/app/uploads/public/5e0/b87/225/5e0b87225348f403410178.jpg)
*Godot 3.0, released in January 2018*



### Change of plans again, no longer a hobby

To be completely honest, my plan up to this point remained unchanged. I wanted to leave the country and start over  a new game development company somewhere else. Of course, during the years I was working as a consultant, it crossed my mind that it might be possible to turn Godot into a non-profit organization and ask for donations (which is why we signed with Ariel to put the project in the [Software Freedom Conservancy](https://sfconservancy.org/) from the beginning), but the idea seemed too far away (and I was not completely sure I wanted to stop developing games).

But life often [slaps you in the face](https://www.kickstarter.com/projects/gdquest/make-professional-2d-games-godot-engine-online-cou) and shows that you are wrong, and I realized that others were already doing Godot-based consulting jobs or successful Kickstarters to create tutorials.

We set up a Patreon and started asking for donations so I could work [full-time](https://www.patreon.com/godotengine). Goal was met quickly.

This was an extremely hard decision to make, because at the time, my experience (been making games and technology since the 90s) was paid a lot more, and I was receiving extremely good job offers from companies around the world due to my work on Godot. Still, the fact that the project became so important for many and the hope that it will continue growing made me change plans yet again.

Eventually, the same happened to Rémi (who many may not know is an Energy Engineer), and he also changed his life plans and profession to work full time for the project.

In fact, thanks to community and company donations, Godot now employs many of our contributors:

* Ignacio Roldán Etcheverry is employed part-time to work on C# thanks to a generous grant from Microsoft.
* Fabio Alessandreli is employed part-time to work on networking, web-sockets and HTML5 thanks to a generous award from Mozilla.
* Fernando Calabró (who made the art for the TPS demo) is now hired to create art for a new third person platformer demo. This is a bigger and more complex demo, which hopefully be done by the time Godot 4.0 is out.
* George Marques has recently been hired as a generalist thanks to community donations.


### Godot 3.0 and a dose of realism

Back to the retrospective, something unexpected happened during the late part of Godot 3.0 development. We decided to use OpenGL ES 3.0 / OpenGL 3.3 for Godot 3. It looked like a great choice, having a very nice API and it would work perfectly on desktop and mobile. Reality has [shown us otherwise]({{% ref "article/abandoning-gles3-vulkan-and-gles2" %}}), so only a month after releasing 3.0 we realized we would need to leave OpenGL behind.



![Illustration for Godot's announcement of planned Vulkan support](/storage/app/uploads/public/5e0/b87/bb2/5e0b87bb2df48404553151.png)


Still, the explosion in new users and contributors, and the fact it took us a year and half to push Godot 3.0 out of the door, forced us to keep our expectations in check. There were massive amounts of bugs resulting from all the code rewrite and new features for Godot 3.0, so we had to spend an entire year fixing bugs and improving usability, while the 3D engine had to be more or less set in stone (given the plan was to rewrite it in Vulkan, anyway).

Additionally, OpenGL ES 3.0 was barely working for a lot of mobile hardware, so we had to go back to add an OpenGL ES 2.0 / OpenGL 2.1 renderer again, but still using the new PBR design of Godot 3.0.

After a very intense year of work, we finally managed to release [Godot 3.1]({{% ref "article/godot-3-1-released" %}}), which then again contributed to another boost in the amount of users, given that the engine was a lot more stable and usable.


![Interest over time in "Godot Engine" on Google Trends](/storage/app/uploads/public/5e0/b88/c66/5e0b88c660334537087053.png)
*Interest over time in "Godot Engine" on Google Trends*


### GodotCons

As the project started growing, Godot Conferences started being organized, this way most of the core contributors could meet face to face. This greatly improved discussions and decision-making in key areas.

Nowadays, we meet several times a year in Europe. In fact you are welcome to [join us next month]({{% ref "article/meet-community-fosdem-and-godotcon-2020" %}}) in Brussels!


### New goals

Afterwards, the plan was to "split" teams, as I would work on the Vulkan branch (which will become the master branch soon, and is expected to release as Godot 4.0 by mid 2020) and Rémi would manage with the rest of the contributors the release of Godot 3.2 (for the first time, entirely on his own, and he is doing an amazing job so far).

And then a decade has gone by. The almost six years since Godot was open-sourced were a roller-coaster. It's hard to believe so much happened in such a short amount of time.

### Future

Today, Godot has over a thousand contributors and an amazing user community. The new 3.2 version will hopefully be released this month (January 2020), with even better and improved usability and stability, and putting an end to our best release cycle yet.

Afterwards, the Vulkan branch will become master (it will be pretty unstable for a while, so definitely not advised for production). The plan is to not add a lot of new general features in 4.0 and focus exclusively on bringing rendering quality and performance on par with mainstream game engines.

Of course, as always, keep in mind that all this is done with ease of use as our first priority, as Godot is designed so that small and medium sized teams, as well as individual developers, have the best possible tool for the games they want to make.

The new rendering architecture will also allow companies working on console ports to more efficiently port the engine and offer our users the possibility of running their games on the most popular game consoles (something we will, unfortunately, never be able to offer officially due to legal reasons, thus forcing us to cooperate with companies porting it on their own).

So, to everyone contributing, using, following or [donating](https://www.patreon.com/godotengine) to Godot development, have a happy new decade! From the bottom of our hearts, lets hope our hard work will help you one day make your dream games come true!

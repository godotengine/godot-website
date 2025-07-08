---
title: "2022: A Retrospective"
excerpt: "The year 2022 was very special for us. We reached a lot of milestones within Godot and also in the community. This blog post will offer a small retrospective of the year."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/63a/ebf/03e/63aebf03e854b249543216.png
date: 2022-12-31 23:20:19
---

The year 2022 was very special for us. We reached a lot of milestones within Godot and also in the community. This blog post will offer a small retrospective of the year.

### Godot 4.0

The work of Godot 4.0 begun in 2019 when I forked it after 3.1 was released with the hopes of rewriting the rendering architecture using Vulkan as a target API. I worked on it alone for a while, while it was just a graphics fork.

But then things happen, in the years in between the community (both users and contributors) grew massively and so did our funding thanks to many generous large donations.

With more users come more demands and, suddendly, the will to use Godot for larger and more serious projects required that large parts of the core were modernized. Godot 3.x core architecture is still that of an engine of the late 2000s, when computers were single core and the difference in speed between CPU and memory was not as significant as it is today.

As a result, and with many contributors interested in improving and modernizing Godot, the goal for 4.0 became much bigger and more ambitious, and a huge amount of the engine core was rewritten, as well as GDScript.

As far as 2021, the status of the 4.0 was a mess. A lot of work was done, but almost nothing worked and so many features were unfinished. As a result, 2022 became a year of focus on stabilizing and finishing all major remaining issues.

Early in the year, we released [Godot 4.0 Alpha](https://godotengine.org/article/dev-snapshot-godot-4-0-alpha-1). After it, 17 alphas followed in total. Things improved a lot, but eventually it was time to do feature freeze and focus on bug fixing. In September, the [first betas](https://godotengine.org/article/dev-snapshot-godot-4-0-beta-1) rolled out and, since then, the stability of the master branch has improved enormously thanks to contributors changing their mindset to fixing bugs.

We will not end the year with a stable release, but we are very close. We are still aiming to release the first stable version of Godot 4.0 during the first months of 2023.

It is important to note, though, that as with any X.0 release, there will still be significant stability, usability and performance related issues. All these will improve significantly in the [upcoming point releases](https://godotengine.org/article/release-management-4-0-and-beyond) (just like it happened after Godot 3.0).

### First Godot Sprint after Covid

In June this year, we held our first [Godot Sprint](https://godotengine.org/article/godot-sprint-and-user-meeting-barcelona-june-2022) since the pandemic started (previous one being in Brussels, January 2020).

It was an excellent way to get back in touch with everyone. As much as Godot is developed very efficiently online, the main developers meeting personally is a great way to move forward with a lot of issues that are difficult to discuss online.

Even if we do online calls often, we are all very tired after an hour or two, but meeting in person is a blast where we can have fun all day discussing Godot topics.

![](/storage/app/media/godot-bcn.jpg)

### Godot Foundation

The success of Godot is largely due to the support provided by the Software Freedom Conservancy. Thanks to them, we could receive donations, and hire contributors who work full or part time to improve the project.

As Godot continued to grow, we realized that we needed the autonomy, control, and flexibility of an organization specifically dedicated to Godot.

Because of this, the [Godot Foundation was launched last month](https://godotengine.org/article/godots-graduation-godot-moves-to-a-new-foundation). It's still not fully operational, as there is still some bureaucracy remaining, but the plan is to do a gradual move from the Conservancy to it during all of next year.

### The 2022 showreels were published

We published our [2022 showreels](https://godotengine.org/article/announcing-godot-2022-showreels), and they looks amazing! The quality and quantity of games published using Godot keep growing significantly every year. This year, we also added the tools category! Thanks to its powerful UI system and architecture, Godot is becoming a go-to platform to create applications and tools that are graphically intensive.

![](/storage/app/media/showreels.jpg)

### Social media explosion

Godot also kept growing strongly on social media, surpassing 100k subscribers on [Reddit](https://www.reddit.com/r/godot/), 50k stars on [GitHub](https://github.com/godotengine/godot) and 60k followers on [Twitter](https://mastodon.gamedev.place/@godotengine). Our Discord has also grown significantly.

### Godot games on Steam keep growing exponentially

This year, there were several hit games published with Godot, such as [Dome Keeper](https://store.steampowered.com/app/1637320/Dome_Keeper/?curator_clanid=41324400), [Brotato](https://store.steampowered.com/app/1942280/Brotato/?curator_clanid=41324400) or [The Case of the Golden Idol](https://store.steampowered.com/app/1677770/The_Case_of_the_Golden_Idol/?curator_clanid=41324400). It makes us very happy that studios are starting to choose Godot more and more for developing their games.

![](/storage/app/media/steam-games.png)

### Closing and personal note

On a personal level, this year was a turning point for me. As a Godot creator and having pushed countless hours majorly churning code for the project since its inception, this is the year where I finally stopped working on large features and moved on to helping other contributors and a more administrative role.

I worked hard towards this happening, increasingly delegating engine areas to trusted and talented contributors over the years. Nowadays, pretty much all the major areas have dedicated maintainers who understand the code better than I do.

Of course, I still help them out with feedback and code reviews and will still contribute new features from time to time but, as time passes, it is (and always was) my intention that Godot is a project that can stand on its own and thrive.

We create Godot out of love and a belief that game development should be freely accessible to everyone. By using Godot, you can have full ownership and control over the technology powering your game. If you believe in our mission and want to support us, you can [become a Patreon](https://www.patreon.com/bePatron?u=5597979) or [send a donation](https://godotengine.org/donate).

It has been a productive year, and we are grateful to have been able to share it with all of you. We look forward to seeing what the next year brings. Thank you!

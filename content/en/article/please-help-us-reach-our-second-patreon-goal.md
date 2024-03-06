---
title: "Please help us reach our second Patreon goal so we can hire karroffel part-time!"
excerpt: "Our campaign for the initial Patreon goal (hiring Juan full time) has been a huge success thanks to our community's support. Thanks to this, Juan is able to spend a lot more time working on Godot and helping other contributors. However, many areas remain where more dedicated developer time would be highly beneficial to advance the project faster."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/5a1/5de/ee5/5a15deee52d15217381472.png
date: 2017-11-22 14:15:00
---

*Edit:* When this post was written we were slightly below our second goal of $4,500 - thanks to a soon-to-be-announced Platinum sponsor, we already reached this second goal and are well on our way to the third one! More infos on our plans for this third goal soon.

## Godot and Patreon so far

[Our Patreon campaign](https://www.patreon.com/godotengine) for the initial goal (hiring me full-time!) has been a huge success, thanks to the strong support of our community. Because of this, I am able to spend a lot more time working on Godot. One of the (not so apparent) benefits of this is the fact that I had more time to work with other contributors, help them around the engine and spend more time helping them with their contributions. This has resulted in a very significant boost in core developers regularly contributing (and the quality of their submissions).

However, while many of the areas being worked on can be approached reasonably by contributors in their free time, several remain where (at this point) more dedicated developer time would be highly beneficial to advance the project faster.

## Our next planned hire

![](/storage/app/media/gdnative.png)

If you help us reach our next Patreon goal (and exceed it, as we need a certain margin of safety), we plan to hire [karroffel](https://github.com/karroffel) part-time. She's the brilliant mind behind what is probably one of the best additions in 3.0, [*GDNative*]({{% ref "article/dlscript-here" %}}). Thanks to her work, it's possible to do all sorts of amazing things, such as:

* Develop using C++ for all platforms without recompiling the engine.
* Bind Godot to all sort of cool external libraries and frameworks (like Steam, SQLite, mobile SDKs, etc.) without recompiling the engine (and which can be simply downloaded from our asset library).
* Extend Godot to support VR, custom audio and video codecs, etc. without having to ship that support by default.
* Provide add-in support for dozens more of scripting languages, such as real Python, Nim, D, Kotlin, and more!

As a lot of new additions to Godot are based on her work, we need her fully focused on making it work as good as possible.

But this is not all. karroffel will also have a second area of responsibility.


## More hands in rendering

![](/storage/app/media/rendering.png)

While, as mentioned above, we are slowly getting more external developers to help, there is an area where we are having a high amount of difficulty finding contributors. This is *rendering*.

Almost all the rendering work has been done by me. While rendering is only a small part of Godot (no more than 5% of the engine), it's one of the most complex areas.

Render engineers are few and one of the most valued positions in the game industry (and yes, I'm tired of turning down juicy job offers for companies all around the world just because I love working on Godot for all of you :P).

The few experienced developers in these areas are working for big companies and under strict contracts, non competes and NDAs, so it's very difficult for them to lend a hand even if they wanted.

As we failed over time to find this type of contributor, karroffel will work on becoming an additional rendering engineer for the project. I will mentor her as best as I can. Her first task will be to create an OpenGL ES 2.0 renderer for Godot 3.1.

This will make Godot work properly again on older hardware and mobile devices (where 2.1 works great, but 3.0 is slow), because the new renderer is too high-end for them.

Afterwards, karroffel will help improve the existing 2D and 3D renderers, as well as contemplating future platforms (such as Vulkan).

## We are counting on you!

Being able to hire karroffel will give us a very immediate boost in productivity, given so many users and developers depend on the work she is doing. Eventually the plan is to do more hires in other areas, so we can have several core developers working full or part-time (which is common in other open source projects of this kind).

We are counting on your help! Please share the word and [link to the Patreon page](https://www.patreon.com/godotengine)!

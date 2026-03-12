---
title: "Godot Showcase – Xogot: Godot for iPad & iPhone"
excerpt: "Miguel de Icaza from Xibbon shares his experience working on Xogot for iOS."
categories: ["showcase"]
author: Adam Scott
image: /storage/blog/covers/godot-showcase-xogot.jpg
date: 2026-03-25 18:00:00
---

We're happy to showcase a project that released last year, but was long in the making. The folks at Xibbon have been working hard to port the Godot Engine to the iOS platforms. Not only did they port the editor to make it run on iOS, they successfully interfaced the editor with a custom iOS interface in order to make the engine match Apple strict UI and UX guidelines. Using their app on the iPad and iPhone feels totally native, _because it is_!

Xibbon has been active in our community, in terms of code contributions and events. Xibbon has been our sponsor at events, such as the first [GodotCon in the US](/article/godotcon-us-2025-wrapup/)!

Today, [Miguel de Icaza](https://en.wikipedia.org/wiki/Miguel_de_Icaza), known for starting the [GNOME](https://www.gnome.org/), [Mono](https://www.mono-project.com/), and [Xamarin](https://en.wikipedia.org/wiki/Xamarin) projects, is sharing with us his experience developing his iOS app.

---

## Can you tell us a little bit about your project?

Xogot brings the Godot Editor to the iPad and the iPhone as a native iOS application.

Xogot uses the Godot Editor and the Godot Engine, but we provide an alternative user interface and shell that is built on top of Apple’s native user interface elements. We tuned the user experience to be both touch friendly and to work with the more limited screen space on these devices.

By being a new user interface on top of the existing Godot Editor, we remain compatible with the desktop Godot and users can move seamlessly between the platforms, but we also wanted to make a product that truly belonged on the iPad, not merely running the desktop experience on the iPad.

While I am an engineer, the joy that I derive from using creative apps on the iPad is unmatched.

Interacting with the world with our fingers is one of the earliest skills that we acquire as babies - and I find the physical feedback of using touch user interfaces to be very rewarding.  Not only do I spend hours playing with my iPad, I also love watching creators use their iPads for sketching, drawing, modeling, composing, editing videos, and building games.

## Why did you want to build Xogot?

Xogot is very much a labor of love, the result of a perfect storm of conditions and a way of expanding our own horizons and getting out of our comfort zone.

We have worked on the mobile world for almost fourteen years, and built developer tools for helping .NET developers target mobile platforms. Mostly building IDEs and tools and supporting others on their adventures to bring software to users (among those, funding the early effort to bring .NET to Godot).

We wanted to get out of our comfort zone, and build an end-user product that followed the ethos of iOS developers that obsess over highly polished apps. Products that obsess over the details of the user experience and strive to create delightful user interfaces.

For almost sixteen years we have helped folks in the game industry adopt .NET for game development, and we supported various games, engines, and hardware vendors with their efforts to bring our compilers and tools to their systems. Just like we were inspired by the iOS community, we are inspired by the game developer community - people pouring their hearts out exploring ways of entertaining and surprising us, and we wanted to get closer to this joyful world.

Lastly, we all witnessed a major turning point in the game-engine industry when Unity’s leadership made decisions that shook developer trust across the community.  We watched as the industry rushed to find alternatives - and being emotionally invested already in Godot, we were very much in the camp “How can we give the Godot community an edge?”.

## What was challenging about bringing the Godot Editor to the iPad and iPhone?

This is the poster child of a slippery slope, or an extreme case of Yak Shaving.

There are three buckets of challenges:
- Multi-process
- User experience
- Embedding

At first, we figured “How hard could it be to get Godot on the iPad?” and it turned out that running Godot on iPad was quite simple, but comes with some strings attached. The first thing you have to deal with is that the Godot workflow uses three processes: the home screen that creates new fresh Godot Editors on demand, the Godot Editor itself, and every time you press “play”, a new and fresh instance of Godot.

The challenge is that iPadOS does not really support the above model where you get a fresh new process for each step, instead you get a single process and you get to live there.  Without being able to launch a new project, Godot would have worked, but would not have been very interesting to people.

We first experimented with a proof of concept which was to reset the state of Godot to one of a fresh process. That worked, and it allowed us to edit one game, and then edit a second one. We called this the “reset state” effort. That was still not quite useful. The second stage was to make the editor run a child process, and for that what we did was to “virtualize” every single global variable in Godot, so we could run multiple instances simultaneously. That turned out to work great, but it relied on a very manual process of editing a very large chunk of Godot to remove every access to globals and static variables.  We later invested in a clang-based rewriter that would take an existing Godot codebase and produce a virtualized Godot on demand. This is what we are based on now.

With the above system we could open multiple projects, but also start and stop the game under development over and over. So we were now cooking with gas. One last component was not just to launch separate instances of Godot, but having those run side-by-side, which was necessary to implement debugging over a “virtual” process that happened to be running on your same address space.

We took the limitations of the platform as a fun challenge to solve, and I am incredibly proud of the result.

That was a very satisfying technical problem to solve, but it did not lend itself to a great iPad experience. Godot is designed for a desktop computer where you have a lot of space, and you can easily aim your mouse at small user interface elements. On the iPad and iPhone, Apple recommends that elements are at least 44 points in size for users to be able to interact with them comfortably. In fact, every time I thought I could get away “just this time” with a smaller user interface, I found out the hard way that neither our users nor myself could tap it. We repeatedly learned that lesson.

_44 points._

It is now hanging on a printed piece of paper next to my desk, so I do not forget.

But even if we resized the controls, the user interface did not feel good on the iPad. Godot was clearly intended to be used with a mouse and a keyboard, so we set out to solve the most problematic areas for our users. Some were mechanical, like “make this button larger” or “display this elsewhere”, but some were more philosophical. In my previous experience with the GNOME desktop, we pursued a path similar to Godot. That is, we tried to deliver a user interface, but whenever there were disagreements about the intended behavior, rather than making an editorial or design decision, we offered a choice. Or three.  Or four.  Or five, or as many choices as there were opinions.

Offering choices sounds great on paper, but is terrible in practice. Options can paralyze users, but each option forces you to test two codepaths - and that is if you are lucky, if you have options that interact with other options. Now you have to test combinations of those features, and so on. And then you get to document all these combinations.

We wanted an application that lived up to the ethos of great iOS applications.  We felt that we had to act as editors and make design choices that surfaced the right defaults, and we opted to only surface what we felt was necessary.

Overall, I think that we did a pretty good job, but every once in a while, our users would complain and make a case for why they really needed an option. So, in those cases, we have brought back a level of configuration or re-surfaced elements that were previously not shown.

Our design process was documented in our blog, and you can see our process and some of the iterations on the concepts over time.

We initially thought we would only touch on a couple of pieces, the scene pad, the file pad - and over time we found ourselves rewriting almost all of the user interface in Godot, both because it felt so much better, but also as users struggled with different parts of the UI. This is a process that has been both extensive, but also quite enjoyable - as [SwiftUI](https://developer.apple.com/swiftui/) has made this a delightful exercise.

At first, we just layered a new UI on top of the Godot Editor, and we customized Godot to show fewer UI elements when running. This served us well for a while, but at some point we found ourselves needing to “host” parts of the Godot UI in SwiftUI views that we controlled, like the bottom bar panels, the plugins that render inside the inspector, as well as having a fallback for custom Godot user interface code - and for that we used a system that allows us to “rehost” parts of the Godot UI - but having this was important to fully take control of the user experience, while ensuring that everything you need to work with Godot was still there.

Adapting Godot from a desktop application into a pleasant, touch-first, iPad application was a lot of work, and we were convinced there was no more shrinking or adjusting in our future. But even during the beta period before we launched the iPad version, our testers kept asking us for an iPhone version. We were not convinced that this was necessary, but our users kept telling us all the reasons why they would want this - tuning their apps, experimenting on the go, testing an idea during small breaks, adjusting some properties of their game during their bus or train ride or during their lunch breaks.

But there is a big gap between what people tell you they want and what they are actually going to do, so we remained skeptical for a long time. The first time we reconsidered this was when we heard a presentation from Chad Stewart on using Godot on Android where he shared his real-life experiences doing his work on the go. Then the Godot foundation shared information about usage of Godot on Android, on phones and tablets - and it was then that we grasped that for some folks their phone is their sole computing device. So not only was this possible, for some folks it was a necessity.

So, delivering the full Godot Editor on iPad and iPhone has meant more than just porting a desktop app. To meet App Store requirements and match Apple users’ expectations, we rebuilt the interface to be truly native and touch-first - something that feels at home on touch devices rather than adapted for it.
Xogot has been a multi-year effort and a significant engineering investment. It’s a commercial product created by a small team deeply passionate about both Godot and Apple platforms. Xogot includes a free tier open to everyone, with the complete version provided at no cost to students and contributors to the Godot open-source project.

## What are the biggest differences between the Xogot and the Godot Editor?

Xogot has two major limitations. First, it can not run third-party plugins authored in native code, or run .NET code. The reason for the former is that Apple’s security system does not allow for third-party dynamic code to be loaded into a process, so all of these plugins fail.

And the ability to run .NET code is not something we have worked on.

## Considering the improvements made to adapt to the new form factor, are there any plans on bringing Xogot to other platforms?

We want to bring Xogot to the Apple Vision Pro. Anecdotally, just before we decided to embark on bringing Godot to the iPad, we were working on building frameworks and games for the Vision Pro.  We were going to our first Boston Unity meeting to learn more about Unity and Vision when the Boston Unity group disbanded in response to Unity’s license changes. It was in this turmoil that we were inspired to jump headlong into the Godot world.

The idea of building and testing immersive experiences directly inside the headset feels like a natural extension of what we have done so far - creating something with your hands, right in front of you, makes the process feel immediate and physical. But like the iPad effort, there are a number of very interesting problems to solve there before we can ship a product that would meet the expectations of users, so we are going to have to work through those.

We don’t currently have plans to bring Xogot to non-Apple platforms. Our focus right now is on delivering the best possible experience on iPhone and iPad, and continuing to refine what it means to build games natively on Apple’s devices.  So you will see us iterating on the experience and incorporating user feedback until we can score ourselves one of those Apple Design Awards.

That said, Godot already runs on many platforms, and we see Xogot as part of that larger ecosystem.  For now, our aim is to deliver a great experience to game developers on the Apple platforms, and to maintain a high level of compatibility with Godot so that both environments can complement each other.


## Were there some improvements made in Xogot that made it upstream?

Our biggest contribution so far has been the [LibGodot](https://github.com/godotengine/godot/pull/110863) effort, which is a major investment we’ve been funding with the development work led by [Migeran](https://migeran.com/). LibGodot makes it possible to embed Godot inside modern applications, and Migeran is now in the process of getting it upstreamed so it can benefit the broader community.

We’ve also contributed a number of smaller patches and fixes, and we’re continuing to learn what it takes to shepherd contributions through the review and merge process. Looking ahead, we expect to contribute larger components as well.  We already have a few ideas in mind. But as we’re still relatively new to the game development community, we want those contributions to be shaped by what we learn as Xogot and its user base continue to grow.

I would love to participate more directly in Godot’s workgroups and community discussions. Balancing that with running a company and raising three kids can be challenging, but I have enormous respect for the dedication and care of the Godot team. My hope is that over time we can contribute not just code, but also ideas and processes that help strengthen the community.

## What’s next for Xogot?

We’re especially excited about Xogot Connect, our new open-source Godot add-on that lets developers on Windows, Linux, or macOS easily run and debug their projects on iPhone or iPad without the usual complexity of exporting to iOS, building in Xcode, or managing provisioning profiles.

Our goal is to keep expanding that bridge between desktop and mobile development. Xogot Connect already makes it simple to configure on-screen controls in your game by enabling the iOS Virtual Controller in Project Settings, and we have a few more ideas like this in the works that bring the mobile-specific affordances we’ve developed for Xogot directly to Godot developers on the desktop and make targeting mobile smoother and more approachable.

---

I would like to thank Miguel de Icaza for sharing with us the experience of his ride of adapting the Godot Editor specifically for a new platform.

You can easily find Xogot [in the App Store](https://apps.apple.com/us/app/xogot-godot-for-ipad-iphone/id6469385251) or at [its homepage](https://xogot.com/).

Also, don't forget to check out Xogot Connect in the [Godot Asset Library](https://godotengine.org/asset-library/asset/4472). (Expect it to be also in the upcoming Asset Store!)

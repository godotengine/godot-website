---
title: "About Official Console Ports Blog Post"
excerpt: "With this post we aim to address the community’s questions about the lack of official console ports through the Godot Foundation."
categories: ["news"]
author: Emi
image: /storage/blog/covers/about-official-console-ports.webp
image_caption_description: "Photo by <a href='https://unsplash.com/photos/two-video-game-controllers-sitting-next-to-each-other-r4iput0KsOw'>Eugene Chystiakov</a> from Unsplash"
date: 2024-09-03 18:30:00
---

With this post we aim to address the community’s questions about the lack of official console ports through the Godot Foundation.
Unfortunately, there has been a lot of mixed messaging on this topic in the past. The truth is that a lot of important information is locked behind vendor-specific NDAs, so even those in the know are often unable to fully explain the situation. Nonetheless, here we attempt to describe the current blockers to the best of our ability, and detail what that means for you as developers looking to port to console. 

## The Foundation does not plan on providing console ports at this time

First and foremost, with the situation being as it is, the Godot Foundation does not have active plans to work on console platform ports.

This may change in the future, especially if it becomes possible to share console ports that are truly Free and Open Source (i.e. not locked behind any NDAs or paywalls).

However, this does not mean you cannot bring your game to these platforms, see here for a [list of unofficial vendors](https://docs.godotengine.org/en/stable/tutorials/platform/consoles.html#third-party-support) providing porting services.

## Barriers to providing console ports

We wrote a blog post a few years ago explaining the barriers to providing console ports: [https://godotengine.org/article/godot-consoles-all-you-need-know/](https://godotengine.org/article/godot-consoles-all-you-need-know/). We want to expand on that post and include more detail about what led to our decision not to produce console ports through our non-profit organization.

From a high level, here are three barriers we are facing:
1. Legal liability
2. Disproportionate cost
3. Open source licensing issues

Of these three issues, only the inability to license ports as open source is a deal breaker for the Godot Foundation. The other two simply make it very expensive and undesirable for us to consider providing ports officially. Let's look at these issues one by one.

### Legal Liability

Broadly speaking, there are two types of console ports:
1. Games developed with approved middleware (e.g. Unity, Unreal)
2. Games developed with custom ports

Using approved middleware is ideal for game developers as they can trust that the game they develop will work on the target platform. A crucial part of approved middleware is that the engine provider accepts liability for any problems with the port. In other words: if there is a problem with the engine itself in regards to security, licensing etc. then the middleware provider takes the liability and the game developer is safe.

The Godot Foundation is not able to take such liability, as it does not provide commercial support for any of its projects. In fact, this refusal to accept liability is core to the MIT license that Godot uses (more on licensing later).

From a liability perspective alone, anyone could provide source code for console ports in a closed environment only available to NDA holders that fully disclaims all sources of liability. 
The great news is that the first ports of this sort are surfacing already!  They are difficult to find as you often need to have the relevant NDAs to discover them. In the case of a Nintendo Switch port, [RAWRLAB](https://www.rawrlab.com/) was able to [publicly announce](https://www.rawrlab.com/godot_nintendo_switch_free_port.html) their open-source Nintendo Switch port for Godot Engine users. This sort of community effort is amazing and is something that the Godot Foundation heavily encourages!

While we are very excited about this progress, we aren't going to put our limited Godot  Foundation resources behind developing such ports either, for the following reasons.

### Disproportionate Cost

The Godot Foundation as an entity receives donations from the community to spend on the development of the Godot Engine as a project. That being said, these resources — which currently pay for about 10 people to work on anything from release management to writing code to organizational tasks — are nothing in comparison to the amount of voluntary time that you as a community invest in making the Godot Engine as successful as it has become in the recent years. At the time of writing, 2,634 volunteer contributors are listed as authors of the project!

We are gifted with a huge community of such passionate contributors, and put a lot of weight on enabling and encouraging new people to join into the process. Sadly, the number of potential contributors with console experience, access to console vendor NDAs, and devkits is very small in comparison.

This would flip our current situation on its head. With console ports, nearly all the work would have to be done by the Godot Foundation, which means the cost per platform would be disproportionately higher than for all other platforms we officially maintain (i.e. PC/Linux/Mac, Web and mobile).  Even more so if we want the console ports to be the same quality as the rest of our code base, including maintenance and catering to new hardware.

This is both inefficient, and unfair to community members who don't plan to release on consoles. A significant portion of their donation would go towards maintaining platform ports for closed systems which they don't have access to (and can't have access to without spending a significant amount of money).

It is also worth keeping in mind that Godot is a very large and fully featured game engine compared to other open source game engines out there. We have extensive third party libraries, a dedicated 2D and 3D renderers, networking, multiple scripting language support, external plugins etc. It would be an undertaking of immense effort and time to create a console port that fully supports all Godot has to offer.

Finally, because we do have limited resources, diverting any resources away from the core product to work on consoles would require slowing down development of Godot itself to create and maintain the console ports.

### Licensing

The board of the Foundation strongly feels that we should only be using funds to develop Free and Open Source Software (FOSS). We are committed to being a fully FOSS project. Further, we credit our FOSS stance with a lot of our success. When you contribute to Godot, you become a part owner of the project and you don't sign away your rights to your code in a CLA (contributor license agreement). This way, every contributor has assurance that they have worked to benefit all users, and that their contribution won't be yanked away from them by the entity controlling development.

In short, we want to develop Godot in a way that ensures that anyone who downloads Godot can be assured that they own the copy of Godot that they are using. We do that by remaining dedicated to two things:

1. Using the MIT license
2. FOSS principles

#### MIT license

We use the MIT license to distribute Godot. Unfortunately, the MIT license is incompatible with providing official middleware because it very clearly states that we won't take on liability for the code (i.e. you can't sue us if it turns out that Godot doesn't work for you, or has a bug that costs you money — which is important since we only operate on [your donations](https://fund.godotengine.org) to begin with). Further it is incompatible with non-middleware ports as well because such ports would have to be limited in their distribution to authorized console developers only.

Accordingly, any console port would have to be distributed under a modified MIT license or another license that allowed us to limit who the code could be distributed to (and potentially limit the distribution in other ways). In either case, we would have to compromise our FOSS ideals, which we feel are our strength.

#### FOSS principles
Further, and more importantly, we do all of our development in the open. Everything is on Github or our developer chat ([chat.godotengine.org](https://chat.godotengine.org), which is open to all who want to discuss development of the project or just listen in). We don't want to put ourselves in a situation where our development has to happen behind closed doors and away from the eyes of the community, and this is exactly what would be required by the console vendors.

Right now, anyone can see the volume of work that is happening on Godot by visiting Godot’s [Github page](https://github.com/godotengine/godot). They can also hang out on the chat and get a feel for the process of development or ask questions directly to the developers. If we shift our development behind closed doors, then you have to take our word that things are progressing and that the donations are being put to good use (unless you have the relevant NDAs).
Finally, we want to assure every contributor and every donor that their contribution benefits all Godot users. If we put donations towards a console port that is hidden behind closed doors, then we are taking resources away from everyone and putting them into something that only benefits a select few and that isn't something we want to do.

## Summary
For the above reasons, the Foundation has decided not to provide console ports for now. Not because we categorically do not want to, quite the opposite actually, but because it currently is not feasible for us and would require to compromise the things that make Godot great. In the future, if console manufacturers become more open about the licensing of console ports in particular, and maybe even agree to support that endeavor financially, then we will happily reconsider. We would love to have official console ports alongside the existing ones from third-party vendors for all of our community to use.

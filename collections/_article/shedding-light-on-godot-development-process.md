---
title: "Shedding light on Godot's development process"
excerpt: "Godot keeps growing steadily in both users and contributors, and 3.0 will be our best release yet. As our community keeps expanding, the development process also reshapes to accommodate new contributions.
While our process is completely transparent, it is not obvious for a large part of the community how new features, fixes and improvements are added. This short article will attempt to shed some light on it."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/5a2/422/3b0/5a24223b08a3b535873636.png
date: 2017-12-03 00:00:00
---

Godot keeps growing steadily in both users and contributors, and 3.0 will be our best release yet. As our community keeps expanding, the development process also reshapes to accommodate new contributions.

While our process is completely transparent, it is not obvious for a large part of the community how new features, fixes and improvements are added. This short article will attempt to shed some light on it.

### Who is the boss?

We constantly get questions about who is the boss. Several community members also attempt contacting me, Rémi and others asking us for help or features, and giving suggestions. The problem is we are not anyone's bosses.

As an entepreneur myself, and having owned many small companies in the past, I can assess that the relationship between open source developers is completely different to that in a corporate culture. An employee gets paid to do his or her job, but an open source contributor helps the project because of his or her own impulse to do it.

In open source projects, most developers work on their free time, on whathever they want, and when they want. No one has any authority over them, be it moral or monetary, and this is for the best. The code they give to the project is also still owned by them (under the same permissive license). 

This may seem chaotic, but it works very well. Godot does not have to compete with companies for mindshare, we have some of the brightest minds working for the project.

### Ok, but who decides?

When Godot was open sourced, I was the only lone contributor and of course, whathever was done was my decision. As more contributors joined the project, the priority was to incorporate them in the decision making.

The important word here is consensus. In everything we do, we try to look for agreement between all parties involved and, so far, we never had problems with this. Were there to be disagreements, we could look for voting but everything was discussed and agreed up to now.

### How is consensus reached?

Here are some typical situations going on during development.

#### Feature request

Often, users request features on GitHub (by opening an issue). At first, other users will discuss whether they think it's ok or not. Eventually, developers may chime in and give their view on how difficult it could be to implement and whether it's worth or not.

If this feature is easy enough to do, usually one of the developers who commented may feel tempted to implement it and submit a Pull Request.

Sometimes, en existing or new developer comes up with a new feature and opens a Pull Request directly. This is fine, though we advise about first asking if the feature is wanted if the amount of work it takes is considerable, as it may be denied merge and result in wasted time.

#### Pull Request

Pull requests are commented and reviewed by developers. Only a few core developers can merge PRs, but they will only do if there is a consensus. To reach a consensus, we regularly host meetings to review PRs on IRC. If an agreement is reached, the PR is merged.

Whenever a PR is trivial to assess and (from the point of view of the reviewer) unquestionably good, it can be merged without extensive discussion to speed up the process. If it ends up being challenged later on by other devs, it can get reverted so that a new PR can be worked on addressing the shortcomings of the first one.

#### Direct commits

Some core developers are "owners" of areas. This means they have enough knowledge on this area of the engine (because they learnt it well or because they made it themselves), that allows them to commit directly to keep improving or working on it. Likewise, they can usually decide to merge a PR in an area of their responsibility if they approve it.

#### Community filter

There are hundreds of community users building Godot from source. In general, bad commits are easy to find and bisect and they can be quickly reverted. This is why Godot is always very, very stable.

#### No, Juan and Rémi don't decide

Before approaching me, Rémi or someone else, please understand that our current role is more along the lines of communication. We try to convey information outwards to the community, and inwards to new and existing developers.

As mentioned before, most decisions on features, fixes, etc. are made in consensus and generally over GitHub or IRC.

### What about Software Freedom Conservancy and the Godot PLC?

The original owners of the "Godot" trademark are me and Ariel Manzur, who worked on it since around 2007. Like many other high profile open source projects, we signed an agreement with [Software Freedom Conservancy](https://sfconservancy.org) so they can use the trademark, collect money for the project and defend the project legally.

Conservancy requires that a PLC (Project Leadership Committee) is created. They also require that Ariel and I are in a minority in this committee, so there are three more members from the core team, selected by their longstanding contributions to the project over the years. The current PLC members are:

* Juan Linietsky (me, who act as development lead)
* Ariel Manzur (co-author of Godot, though not currently active in development)
* Rémi Verschelde (who acts as project manager)
* George Marques
* Andreas Haas

Previous members:

* Alket Rexhepi (stepped down due to lack of time).

In any case, Software Freedom Conservancy acts as our fiscal sponsor. They receive donations for the project and the PLC decides what to do with them. Of course, as a charity, Conservancy has very strict rules to ensure that money is only used for the benefit of the project. They control every penny that goes through and make sure it's invested as intended, so this should act as a warranty to the whole community and sponsors.

But the responsibility of the PLC is only about managing money, it has zero inference on the development process itself. If developers are to be hired with this money, it will still be done in agreement and consensus with everyone else, and only for contributors with an extensive and proven track record. Hired developers have a strict contract to comply with, drafted by Conservancy's laywers.

### How about Patreon?

Our current Patreon is owned by the Software Freedom Conservancy. All donations go to our project finances within their organization.

Conservancy asks that Patreon rewards can at much affect the priority of tutorials, demos or features that the project is already intending to do. We can't offer rewards unrelated to Godot's goals. This is why we ask the whole community for proposals, then we later approve them, and only Patrons have voting power in the end.

As soon as 3.0 stable is out, we will work on the proposals first. In general, existing contributors want to work on them, though I make sure to work on them myself if no one is up for the task.

### What if I want to pay for specific work to be done?

There are two choices for this. If the work to be done is something of interest of the project and we want to merge it, Conservancy can accept a directed donation. Meaning they will be in charge of hiring (with our recommendation) someone to work on that. This is how the Mozilla and Microsoft grants happened.

If the work is no interest for the project (like, supporting a proprietary API or technology), many of our core developers accept paid work. Just drop a line to contact *at* godotengine · org, which will reach the PLC. We will ask the developers to see if there is any interest.

### Help us be transparent

Our goal with Godot is to be as transparent as possible. This article was created to shed light on how everything works, but if you still have any doubts or would like to have more information, please let us know!
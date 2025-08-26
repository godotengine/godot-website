---
title: "Will your contribution be merged? Here's how to tell"
excerpt: "The pull request workflow is great, because it allows proposing changes to the codebase in a way where they can be evaluated, reviewed (with feedback) and eventually merged or rejected. Despite this, a large amount of pull requests get rejected for reasons that are often unclear to new contributors, so this article aims at clarifying the process and underlying motives for PR reviewers' decisions."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/5bf/33b/9b7/5bf33b9b794d9900123756.png
date: 2018-11-19 00:00:00
---

The [**pull request workflow**](https://contributing.godotengine.org/en/latest/organization/pull_requests/creating_pull_requests.html) is great, because it allows proposing changes to the codebase in a way where they can be evaluated, reviewed (with feedback) and eventually merged or rejected. Despite this, a large amount of pull requests (PRs) get rejected for reasons that are often unclear to new contributors.

To avoid unnecesary work, this short article has some suggestions on what is desired and what is not, and the general rules for accepting or rejecting pull requests.

## Ask first

Ask about what you want to do, by either [opening an issue](https://github.com/godotengine/godot/issues/new), or asking in the [Godot contributors chat platform](https://chat.godotengine.org). This will defintely save you time and effort, as other contributors will better guide you on whether your proposal is desired or not (or what needs to be changed so it would be).

## We refuse by default

Contributions are considered rejected until proven useful. There are no hypotheticals here and we never accept something because *it might be useful*. Functionality is merged only when there is a valid and proven real-life [use case](https://en.wikipedia.org/wiki/Use_case) for it. This means that someone (and especially more than one user) needs this new functionality for their actual projects, in order to save considerable amounts of time or just because it's otherwise impossible to advance development without it.

Again, hypothetical use cases are ignored most of the time, whereas real projects being worked on (and their needs) take the priority.

This also means that it's your resonsibility (or that of fellow interested users) to demonstrate the use cases and need for a specific feature. Discuss it beforehand as mentioned, and add some details in your pull request (or the affiliated issue) about what this proposal aims to solve. A never-discussed, no-comment PR with a terse "Add feature X" 500 <abbr title="lines of code">LOC</abbr> commit will likely produce a deep *sigh* among PR reviewers, more than anticipation for a potential great feature.

## Bloat accumulates quickly

Please understand that we need to keep the engine size as small as possible. This ensures download on Steam, Mobile stores or HTML5 are as smooth as possible. Adding features that will not be used (or seldom used when then can be easily worked around) just adds more weight to the engine.

Even if a feature is small (say, a few kilobytes), we get several requests of them per week. If we were to accept/merge all of them as a general rule, Godot would grow several megabytes bigger over time.

And even if size was not a problem, more code means more difficulty for potential contributors and users to understand how the engine works, as well as more surface area for potential bugs.

We really do our best effort to keep it simple and small, help us with this!

## General logic

The following diagram shows the logic steps used to evaluate pull requests. If you can ask yourself the same questions, everyone's time will be saved.

![newfeature.png](/storage/app/uploads/public/5bf/336/251/5bf336251f0fb012041766.png)

This can seem a bit confusing at first, so let's go over it question by question:

#### Do you need it?

Just adding a feature because it seems like it would be a cool addition does not cut it (feel free to ask first, of course). As mentioned before, we are only interested in real-life [use cases](https://en.wikipedia.org/wiki/Use_case). This needs to be for a project being worked on (or for types of projects that are not possible without this feature).

#### Does this feature cover a common use case?

Is this something you need to use often for your project? Will other users also find it often useful? If a feature covers a common use case and it's needed very often, then it may be worth considering for addition.

Even if it's not needed often but implementing it from the user's side is difficult, then it may also be worth considering for addition.

This is why the following question is also important..

#### Can it be worked around with a few lines of code?

If you don't need a feature that often (say, just a couple of times) and working it around can be easily done by writing a small amount of scripting code, then there is no merit in integrating this as a new feature. It's better that this complexity goes on your side rather than ours.

#### Can you program C++?

It should be obvious from this article, but remember that, in a community-driven <abbr title="Free and Open Source Software">FOSS</abbr> project like Godot, no one is obliged to do anything for anyone. If you can work on something yourself, feel free to do it and propose it. We will lend you a hand if you need!

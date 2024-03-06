---
title: "New communication platform for Godot contributors"
excerpt: "Godot contributors are moving from good old IRC to a new self-hosted chat platform based on Rocket.Chat! It provides many modern features that will enable a better communication flow between contributors, as well as providing a central place for all team or topic-specific discussion channels around Godot development."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/601/ad2/3e5/601ad23e55ddd872740322.png
date: 2021-02-03 16:44:47
---

Godot has [many communication platforms]({{% ref "community" %}}) used by the community to talk about the engine and their projects: [GitHub](https://github.com/godotengine/godot/) for development, the <a href="/qa" data-barba-prevent>Q&A</a> for technical questions, [Reddit](https://www.reddit.com/r/godot/), [Discord](https://discord.gg/4JBkykG), and several others for user discussions, [Twitter](https://twitter.com/godotengine) for announcements, etc.

Up until recently, engine contributors favored the [tried and trusted](https://xkcd.com/1782/) <abbr title="Internet Relay Chat">IRC</abbr> protocol on [Freenode](https://freenode.net/) as their main chat communication platform, but we are now moving all developer channels to the new [**Godot Contributors Chat**](https://chat.godotengine.org/):

Join [**chat.godotengine.org**](https://chat.godotengine.org/) if you want to follow or participate in engine development discussions.

This new platform is a self-hosted instance of the open source [Rocket.Chat](https://rocket.chat/) communication platform, gratiously hosted and administered by [Prehensile Tales](https://prehensile-tales.com/) on behalf of the Godot project.

## Why a new chat platform?

We've been using IRC to discuss engine development for several years, but despite being a tried and trusted open source technology with bazillion clients for all platforms, it is lacking in modern features such as:
- Persistent login (to see what was discussed while you were offline).
- Good moderation features.
- Easy-to-setup private channels and group discussions.
- Support for Markdown and code blocks.
- Easily uploading images.

While we can live without most of those, the difficulty to have persistent login on IRC (you either need to host your own client or bouncer, or pay for a cloud-based client) was a major annoyance for many current and potential contributors, especially with a project spread across all timezones.

Additionally, this new platform provides a centralized place for Godot Engine contributors to talk with each other. When you join the platform, you can browse the list of public channels and join the ones related to topics or teams you want to contribute to. Having everything in one place makes those channels more discoverable, enabling more potential contributors to connect with us.

## Priority to open source

While there are many popular proprietary platforms which offer the kind of modern features that we need, Godot is a community-driven open source project, and it is important for us to use and promote open source technology where we can. That's why we chose to deploy our own instance of Rocket.Chat for this purpose. We also considered other open source team chat options such as Matrix and Mattermost, but Rocket.Chat proved to be the best candidate for our needs in our evaluation.

As we offer Single Sign-On with social OAuth login, and plan to eventually expanded it to other Godot-hosted services such as the <a href="/asset-library" data-barba-prevent>Asset Library</a> and the <a href="/qa" data-barba-prevent>Q&A</a>, we are confident that this new platform should serve us well and be accessible to everyone.

## Focused on engine contributions

Finally, we'd like to reiterate that this platform is the communication platform for engine contributors, and not the primary user support community.

Everyone interested in contributing to Godot, be it with code, documentation, bug reports, or general feedback on technical discussions, is very welcome to join us there!

For general user support, sharing projects, and other non contribution-related Godot topics, we keep the many platforms listed on the [Community]({{% ref "community" %}}) page.

## How does it work?

There are many open source clients which you can use to access the platform, either through your browser, or desktop and mobile native apps. See the [Home page](https://chat.godotengine.org/home) of the chat platform for some links.

You can read some channels anonymously, but if you want to participate in the discussions, you will have to create an account to log in. You can use pre-existing social logins to authenticate on Godot's Single Sign-On, such as GitHub, Google, or Discord accounts. Or you can create a local Godot account with your email address.

Once you join the platform, you can visit the [Channels Directory](https://chat.godotengine.org/directory/channels) for a list of public channels that you might be interested to join. This platform is intended to host channels for all the Godot development teams, and possibly for regional communities too, so most channels are opt-in and will only be visible if you decide to join them. We also have a dedicated channel for [`#new-contributors`](https://chat.godotengine.org/channel/new-contributors) which you can join if you'd like to contribute to Godot.

See you around!

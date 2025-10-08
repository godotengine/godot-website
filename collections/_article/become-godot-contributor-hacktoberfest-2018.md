---
title: "Become a Godot contributor for Hacktoberfest 2018"
excerpt: "Hacktoberfest 2018 has started, and you can contribute to Godot to earn a T-shirt (and experience!). Digital Ocean and GitHub sponsor this event that encourages everyone to contribute to any free and open source project on GitHub, including Godot's repositories. All pull requests count, so you can work either on the engine source code or on the documentation - there are things to do for everyone!"
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5bb/27f/fe8/5bb27ffe8696a709684472.png
date: 2018-10-01 20:43:47
---

October arrived, and with it one of the great community events of the <abbr title="Free and Open Source Software">FOSS</abbr> year, the [Hacktoberfest](https://blog.digitalocean.com/hacktoberfest-is-back-for-year-5/)!

This event co-organized by Digital Ocean and GitHub has simple rules: contribute 5 pull requests to open source projects on GitHub, and you will get a cool T-shirt (plus eternal recognition from project maintainers and internal fame in many communities, or something close to that ;)).

And of course, Godot being one of the GitHub-hosted projects, you can work on your Hacktoberfest milestones by contributing directly to [Godot's source code](https://github.com/godotengine/godot) or [documentation](https://github.com/godotengine/godot-docs).

## Getting started

First of all head to the [**Hacktoberfest 2018 website**](https://hacktoberfest.digitalocean.com/) and register with your GitHub account (if you haven't one, you'll have to [register](https://github.com/) there too). The Hacktoberfest website has plenty of resources to get you started, and tips on how to find projects that you could be interested in, so make sure to check it in depth.

For Godot specifically, here are relevant links and tips:

### Engine contributions

If you want to contribute to the game engine itself by fixing bugs or implementing enhancements (note that new features would be put on hold as we are in *feature freeze* - you can still make them but you wouldn't get much feedback for now), head to the [godotengine/godot](https://github.com/godotengine/godot/) repository. Most of the code is C++, with some bits in Objective-C (iOS/macOS), Java (Android) and JavaScript (HTML5).

This is also the place to work on the *class reference*, the documentation of all nodes available in Godot and their properties and methods.

Here's how to get started:

- The [*Hacktoberfest*](https://github.com/godotengine/godot/labels/Hacktoberfest) label on the [source code repository](https://github.com/godotengine/godot) lists some "newcomer-friendly" issues that you can have a look at. Note that you are not limited to those issues, you can work on anything you want - this selection is just a shortlist.
- Similarly, the [*Hero wanted!*](https://github.com/godotengine/godot/labels/hero%20wanted%21) label also has a selection of issues ready to be worked on, where project maintainers or users have done enough initial debugging to point you in the right direction (see our [recent blog post](/article/hero-wanted-31-version) about the "Hero wanted!" campaign).
- You can also browse all other issues of the code repository which are in the [*3.1 milestone*](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A3.1) (our main focus currently), and especially the ones [labeled as *bug*](https://github.com/godotengine/godot/issues?q=is%3Aopen+label%3Abug+milestone%3A3.1).
- Have a look at the [contributor's documentation](https://contributing.godotengine.org/en/latest/organization/how_to_contribute.html), especially the [CONTRIBUTING.md](https://github.com/godotengine/godot/blob/master/CONTRIBUTING.md), the [Pull Request workflow](https://contributing.godotengine.org/en/latest/organization/pull_requests/creating_pull_requests.html) and the [Code style guidelines](https://contributing.godotengine.org/en/latest/engine/guidelines/code_style.html).
- Join the [`#godotengine-devel`](http://webchat.freenode.net/?channels=#godotengine-devel) IRC channel on Freenode (also bridged on [Matrix](https://matrix.to/#/#freenode_#godotengine-devel:matrix.org)) to discuss with fellow engine contributors.

If you want to work on the class reference, have a look at the [dedicated page](https://contributing.godotengine.org/en/latest/documentation/class_reference.html).

### Documentation contributions

To contribute to the [online documentation and tutorials](http://docs.godotengine.org/), the main repository is [godotengine/godot-docs](https://github.com/godotengine/godot-docs/). Note that as mentioned above, contributions to the [class reference](http://docs.godotengine.org/en/latest/classes/index.html) should instead be done directly in the engine repository (as the class reference is also included offline in the editor).

Here's how to get started:

- Check the [list of issues](https://github.com/godotengine/godot-docs/issues) and see if there's anything you'd like to work on.
- Review the documentation on [how to write documentation](https://contributing.godotengine.org/en/latest/documentation/guidelines/index.html) (yes, that has to be documented too!).
- Join the `#documentation` channel on [Godot's Discord](https://discord.gg/zH7NUgz) server (most active place to discuss with fellow documentation contributors), or if you prefer the [`#godotengine-doc`](http://webchat.freenode.net/?channels=#godotengine-doc) IRC channel on Freenode (but it's less active).

That's it! It's a lot of links and documentation, but you of course don't need to review everything in depth, look in priority at the [contributor's documentation](https://contributing.godotengine.org/en/latest/organization/how_to_contribute.html) and then pick something you'd like to work on.

Enjoy your Hacktoberfest and have fun contributing to your very own engine!

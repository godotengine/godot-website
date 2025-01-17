---
title: "Home, sweet home"
excerpt: "Godot Engine has a new home! A new website was designed from the ground up with a modular design, so that it can easily be extended and customized to fit our needs.
You'll now find a Q&A section where the community can share its knowledge, and a new documentation system that can be contributed to directly via pull requests!"
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/56c/9da/a89/56c9daa8921c3243289535.jpg
date: 2016-02-21 00:00:00
---

Here it is: [Godot Engine's new homepage](/)! Some of you might have been awaiting it for a long time, while others might have never used the previous website, so we will recap what motivated modifying the website again.

Thanks enormously to Andrea Calabró, Alket Rexhepi, Hugo Locurcio (Calinou) and Rémi Verschelde (Akien) for their hard work!

## Why change again?

The early Godot users might remember that we used to have a WordPress-powered website in 2015, with a self-hosted forum and the official documentation on [Godot's GitHub wiki](https://github.com/godotengine/godot/wiki). With the growing community and the project getting more and more new contributors, we wanted to have a platform that eases the project management so that we can work efficiently in teams. It was also becoming clear that GitHub's very limited permissions management would not let us have contributions on the wiki without giving push rights on the source code to everybody (!), so we needed an alternative for the documentation.

Some Godot contributors (mainly Theo Hallenius – TheoXD – who has our biggest thanks and appreciation for carrying out this task) put a lot of time in setting up an [OpenProject](https://www.openproject.org) instance to replace the previous website. OpenProject is an open source project management system that features most of what we needed in the same software: tasks management, wiki, forum, blog, and good possibilities for handling localized websites. In contrast to setting up several separate software packages, OpenProject seemed like the obvious way to go.

Unfortunately, OpenProject proved to be too complex of a beast for us. It was difficult to find contributors who could spend enough time to learn how its backend works and we also ran into performance problems we couldn't figure how to fix. As a result, the site looked unpolished and ran slow.

## New website and its tools

So we decided to make a new homepage that we could easily theme with PHP, HTML and CSS that most of us know quite well, and to which we could easily add components little by little to match the needs of the community (did I hear someone say "asset sharing system"?). After having difficulties with a monolithic platform that was too big for us, we decided to go for a more modular approach using tools that should be easy to maintain by our current and future contributors.

#### Main website

For the [landing page](/), we wanted a lot of technical freedom to theme everything as we wanted, and as little clutter as possible to ease the maintenance. We worked first on the design, HTML and CSS implementation, and finally decided to use the lightweight [OctoberCMS](https://octobercms.com) as a backend, which powers among other things this simple news section.

Thanks to this straightforward setting, we could easily design good looking (we hope!) pages to showcase Godot and its features, make the downloads easily accessible, etc. In the future we would like to add a section showcasing games made using Godot.

#### Q&A platform

As we increasingly noticed that people were asking many technical questions on the Facebook group, which provides no good search feature nor search engine referencing, we decided to setup a [Question2Answer](http://www.question2answer.org) instance, also in PHP and easy to customize with a great number of plugins. It is very similar to popular technical platforms like StackExchange or StackOverflow, and should help increase the visibility of Godot-related questions and their best answers. [Check it out!](/qa)

For the time being we also propose specific categories to showcase Godot games and WIPs and discuss off-topic stuff in the Q&A - this used to be in the forums but we did not want to setup yet another new tool just yet. This might change in the future if/when we settle on a better-suited solution.

#### Sphinx documentation

Finally, to make the documentation easier to contribute to, we chose to use the well established [Sphinx](http://www.sphinx-doc.org) documentation generator. It allows us to have the source of the documentation [in a public git repository](https://github.com/godotengine/godot-docs), which means that everybody can easily contribute to the documentation will pull requests, and it's easy to keep track of changes to any page using git features. Sphinx then generates HTML pages based on this source, which we can then host on our website.

To make things easier to manage, we use the open source [readthedocs.org](http://readthedocs.org) frontend, which rebuilds the HTML documentation each time the git repository is updated (as well as PDF and Epub versions!), and enables us to handle different versions of the documentation (e.g. for each Godot version, though for now there is only the "latest" branch which might become "2.0") as well as translations. We'll post more about [this documentation](http://docs.godotengine.org) and how to contribute to it in the future!

That's it for today! We hope that you will like Godot's new home, and we will gladly welcome your feedback on [IRC](http://webchat.freenode.net/?channels=#godotengine) or in the [Facebook group](https://www.facebook.com/groups/godotengine/). The current website is not final, we'll continue to improve it little by little to make it as functional as possible.

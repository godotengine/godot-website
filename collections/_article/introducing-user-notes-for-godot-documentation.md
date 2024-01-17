---
title: "Introducing user notes for the Godot documentation"
excerpt: "The Godot documentation recently got an integration for user notes using Giscus. This allows users to share additional information relevant for documentation readers."
categories: ["news"]
author: Hugo Locurcio
image: /storage/blog/covers/introducing-user-notes-for-godot-documentation.jpg
date: 2024-01-23 16:00:00
---

The [Godot documentation](https://docs.godotengine.org/) recently got an integration for user notes using [Giscus](https://giscus.app/). This allows users to share additional information relevant for documentation readers.

## Why have user notes on the documentation?

The Godot documentation is an essential learning resource for new and returning users alike. However, the content can sometimes benefit from additional clarification not found on the page itself. Since it's an officially-maintained resource, it also tries to limit the number of third-party resources it links to.

To resolve this problem, we've decided to introduce an *user note system* in the Godot documentation. Inspired by user-provided comment systems such as [PHP's](https://www.php.net/docs.php), this allows the community to make the documentation more useful for everyone: not just for users, but also for engine developers.

**It should be noted that *user notes* are different from the usual comments you'd find on a blog post.** As described by the [user-contributed notes policy](https://github.com/godotengine/godot-docs-user-notes/discussions/1), they are intended to be used to provide additional context for the documentation or link to community resources. They are not designed to report bugs or suggest features. Also, when the documentation is incorrect or outdated, please open an issue on the [godot-docs](https://github.com/godotengine/godot-docs) repository instead of leaving an user note.

## How it works

This user notes integration is powered by [Giscus](https://giscus.app/), an open source script that allows integrating a GitHub Discussions thread on a web page. To do so, it automatically creates a discussion in a [repository](https://github.com/godotengine/godot-docs-user-notes) when the first comment on a page is posted. On the Godot documentation, pages are matched based on their file name, but several page matching modes are provided by Giscus depending on the website's needs.

Being hosted on GitHub Discussions allows anyone with a GitHub account to comment. On the organizational side, this also reduces system administration overhead as no separate backend or database for hosting comments is required. As a bonus, you can also watch the [godot-docs-user-notes](https://github.com/godotengine/godot-docs-user-notes) repository on GitHub to be informed of new user notes being added to documentation pages.

## Support

If you would like to help with the development of these features, please, consider [supporting the project financially](https://fund.godotengine.org/)! More funding allows us to sponsor volunteer contributors and better respond to technical demands of project users.

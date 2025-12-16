---
title: "Introducing the new Godot Forum"
excerpt: "We are finally unveiling the new Godot forum which replaces our Q&A platform while unlocking many new features."
categories: ["news"]
author: Winston Yallow
image: /storage/blog/covers/introducing-new-forum.jpg
date: 2023-12-08 15:00:00
---

For the last couple of months, our Q&A platform was in read-only mode. Now it has been superseded by our new and more powerful forum! 🎉

🔗 [https://forum.godotengine.org/](https://forum.godotengine.org/)

And don't worry: no content is lost, all the old posts have been migrated to the new platform.

## Why did we replace the old platform?

The old Q&A platform was based on [Question2Answer](https://www.question2answer.org/), an open source project for Q&A sites. Unfortunately it is infrequently updated and had some security issues we couldn't easily solve. This led to problems like bot registrations and spam which took a lot of manual effort to manage.

On top of that, we also wanted more forum features that Question2Answer simply couldn't provide. It served its purpose well for quite some time, but we have simply outgrown its capabilities. So it's time to give our community a new home!

## Introducing Discourse

The new forum is based on [Discourse](https://www.discourse.org/), an open source forum software that can easily be adjusted via plugins and themes to suit our needs. For logins, the same SSO (single sign on) is used as for other Godot platforms (like the developer chat). This allows users to have one account across all Godot websites.

## Data migration

Let's look at some details about our process going from Question2Answer to Discourse!

The old Q&A platform had over 150k questions, answers and comments stored in the database. 20% of those were hidden by our moderators for being spam or breaking the rules, so we ended up importing 120k items from the old database.

What we did not import were the users. The old instance had lots of old and unused accounts, and it would have been a lot of work to reconcile those users with the users of the SSO server. Instead, all imported posts are made by a system user, and the original username is shown at the top of the post. Since Discourse does not support comments on posts like Question2Answer, we embed them directly within the post and add some styling. This way we can represent all data from the old platform in a neat way:

![Imported post with note on top and comment below](/storage/blog/introducing-new-forum/example-import.webp)

### Permalinks

To keep existing links working, we forward any request from the old server to the new server. We then use the Discourse permalinks feature to map requests to `forum.godotengine.org/{some_old_id}` automatically to `forum.godotengine.org/t/{new_id}`.

### External images

By default, Discourse downloads external images on the server to prevent linkrot. However, this is not a good idea when importing a big amount of posts at the same time. Leaving this feature on would get the server blacklisted by imgur and other providers for requesting too many resources in a short amount of time. Therefore the feature was turned off for the duration of the import.

### Markdown adjustments

Discourse uses Markdown, HTML and BBCODE for the post content. Luckily, on the old Q&A platform we also used a plugin for Markdown. While this made the posts somewhat compatible, there were still a few differences in how the Markdown is interpreted.

We ended up using a Markdown parser to access the content in a tokenized form. This allows us to apply a bunch of adjustments:

#### Code blocks

There are two ways to denote code blocks in Markdown: either a block delimited by <code>```</code> or by indenting every line of the block by one tab (or four spaces). The old platform highlights both as code. Discourse only highlights backtick delimited blocks. So for all indent based code blocks, we remove the indentation and surround the blocks with backticks instead.

This ensures that all code blocks will be processed by `highlight.js` and will receive syntax highlighting if the language can be detected.

#### Image embeds and links

The new Markdown parser is a bit stricter about links/embeds that use the footnote syntax. They are only processed correctly if the line before is completely blank. This was easy to fix by simply adding a new line before every footnote. We also replace any references to the old server address with references to the new server. This avoids unnecessary redirects.

![Example post with working syntax highlighting and link](/storage/blog/introducing-new-forum/example-link-syntax.webp)

## The future

Now that we have a proper forum, we can use it for more than just questions and answers. Beside the [Help](https://forum.godotengine.org/c/help/6) section for questions and answers, we also already have a  [Resources](https://forum.godotengine.org/c/resources/19) category where you can post tutorials and plugins as well as your favorite tips & tricks for Godot!

If you have any ideas for further improvements to the forum, feel free to create a post in the [Site Feedback](https://forum.godotengine.org/c/site-feedback/2) category.

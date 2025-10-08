---
title: "We need your help to improve our documentation system!"
excerpt: "Godot has grown a lot and, nowadays, and new users expect us to have quality documentation comparable to commercial offerings. For this, the documentation system we currently have needs tweaks and improvements. As we, game engine developers, are not experienced in the web side of the programming world, everything seems daunting to us (please don't laugh), so any help with the following items would be hugely appreciated!"
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/59a/873/435/59a87343562c8216231867.png
date: 2017-08-31 00:00:00
---

### About Godot Documentation

Like many other mainstream projects, Godot uses the [Sphinx](http://www.sphinx-doc.org) doc generator graciously hosted on [ReadTheDocs](https://readthedocs.org/) for its [documentation](http://docs.godotengine.org). This has worked great so far, as it allow us to have a very mature system with versioning and search functionality. It also has great features such as previous and next indices or the fact it fetches the source pages from our [GitHub project](https://github.com/godotengine/godot-docs), where we can write them comfortably in reStructuredText.

Given that our project has grown so much and that documentation is a critical piece of it, we are starting to find some limitations to this system, which should hopefully be possible to solve as every component is free and open source. There are many small tweaks and improvements that we would like to do to it but, as we game engine developers are not experienced in the web side of the programming world, everything seems daunting to us (please don't laugh).

Because of this, we are looking for someone who can start by investigating what components should be modified and how to solve the issues we have, and then ideally do the job and contribute it back upstream.

To give an overview of the architecture:
- Documentation is written in reStructuredText in a [GitHub repository](https://github.com/godotengine/godot-docs)
- It is then compiled to static HTML pages via Sphinx, using:
  1. The popular [sphinx_rtd_theme](https://github.com/rtfd/sphinx_rtd_theme) theme (or given the role it fulfills, we could say "engine") which is the default on ReadTheDocs (but we could change it if we find a better one, or fork it if we need to).
  2. Some config option defined in our [conf.py](https://github.com/godotengine/godot-docs/blob/master/conf.py), which govern both Sphinx itself and the theme-specific options.
  3. [HTML templates](http://www.sphinx-doc.org/en/stable/theming.html) which can be used to further customize things without having to modify the "engine" theme mentioned above.
- All this is deployed automatically on each commit to the GitHub repo thanks to the ReadTheDocs hosting.

The three numbered options are the part where we need motivated web devs ready to dig into this technology and see if our wishes can be fulfilled. Those are:

#### Headings show in the TOC Tree

The TOC Tree in Sphinx theme includes the page headings. This can become quite confusing, as it makes it look like there are a lot more documentation pages than there really are. Other engines documentation systems we have seen do not include these. We tried to no avail to remove them but it seems this is not currently supported.

![](/storage/app/media/misc/rdtfeats1.png)

We think that this should be implemented directly in sphinx_rtd_theme, and [wrote an issue about it](https://github.com/rtfd/sphinx_rtd_theme/issues/312) a year ago, but it would speed things up if one of our contributors could work on it and make a pull request.

**Edit:** One of our contributors, Paul alias pcvonz submitted a [pull request upstream](https://github.com/rtfd/sphinx_rtd_theme/pull/456) against the sphinx_rtd_theme project, which should let it honor the existing Sphinx `titles_only` option.


#### Multiple language support

Starting with Godot 3.0, we now support multiple languages: GDScript, Visual Script, C# and C++ (via GDNative). It would be great if we could add a language switcher to the documentation, so contributors can add code (or images for the case of Visual Script) showing how the same code exists in different languages.

What we have:
![](/storage/app/media/misc/rdtfeats2.png)

Example of how this is done in [MSDN](https://msdn.microsoft.com/en-us/default.aspx):
![](/storage/app/media/misc/rdtfeats3.png)

For this part we don't know which component (Sphinx, sphinx_rtd_theme, or HTML (JS?) templates) could address it the best way, so some research would be needed.

**Edit:** That went fast, our resident design expert Daniel alias djrm [already implemented it](https://github.com/godotengine/godot-docs/pull/453) using the pre-existing [sphinx-tabs](https://github.com/djungelorm/sphinx-tabs) extension. Gotta love the open source ecosystem, with some digging you always find what you need :)


#### Language Case switching

As the API exposed in C# uses PascalCase, some users of this language might find confusing that methods shown in the API documentation (e.g. the above `Object.connect`) are in snake case. If we could implement a simple case switcher for these (i.e. `Object.connect` -> `Object.Connect`), it would make the life of such language users easier.


#### Feedback on the heat of the moment

Some help systems have a simple dialog "Was this page useful? YES/NO", which can catch frustrated users in the heat of the moment, allowing us to know what where they looking for and why they couldn't find it. Users might find the solution later anyway and will not report their problems, so this will help us make the documentation better.

Example from [MSDN](https://msdn.microsoft.com/en-us/default.aspx):
![](/storage/app/media/misc/rdtfeats4.png)


### How to contribute

The best way to contact us for this work is joining the [#godotengine-atelier IRC channel](irc://chat.freenode.net:6667/godotengine-atelier) on Freenode, which is dedicated mostly to website development.

Thanks!

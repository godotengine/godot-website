---
title: "Ensuring quality in the Godot documentation, a continuous process"
excerpt: "The Godot documentation is the fruits of the labor of hundreds of people working together. How do we ensure the highest possible level of quality, while making it easy for anyone to contribute? Find out in this article."
categories: ["news"]
author: Hugo Locurcio
image: /storage/blog/covers/ensuring-quality-godot-documentation.jpg
date: 2025-09-18 14:00:00
---

What makes up the quality and usability of an open-source project is not just about its code. A big part of what makes a project useful to the community is its documentation.

Over the years, Godot contributors have developed many tools and processes to ensure the highest possible level of quality for the [documentation](https://docs.godotengine.org/). Read on if you're curious about how the documentation is made.

## Documentation repository organization

Godot's documentation is hosted on [Read the Docs](https://about.readthedocs.com/). This service provides hosting for projects using [Sphinx](https://www.sphinx-doc.org/), which is a static site generator targeted at building documentation.

The documentation's source files are hosted [on GitHub](https://github.com/godotengine/godot-docs). Several customizations have been made to improve readability, such as [adding a dark theme](https://github.com/godotengine/godot-docs/blob/master/_static/css/custom.css) (used according to browser/OS preferences) and [GDScript syntax highlighting](https://github.com/godotengine/godot-docs/blob/master/_extensions/gdscript.py).

There is a continuous integration system in place, which performs several automated tasks:

- [General continuous integration](https://github.com/godotengine/godot-docs/blob/master/.github/workflows/ci.yml)
  - Runs pre-commit hooks and builds the website to ensure no errors occur. The pre-commit hooks are configured to check for typos using [codespell](https://github.com/codespell-project/codespell).
- [Synchronize the class reference](https://github.com/godotengine/godot-docs/blob/master/.github/workflows/sync_class_ref.yml)
  - Automatically synchronizes the generated class reference with the [class reference XML](https://github.com/godotengine/godot/tree/master/doc/classes) from the main Godot repository.
- [Build offline documentation in HTML and ePub formats](https://github.com/godotengine/godot-docs/blob/master/.github/workflows/build_offline_docs.yml)
  - Creates downloads of the documentation in offline-friendly formats.
- [Check URLs for dead links](https://github.com/godotengine/godot-docs/blob/master/.github/workflows/check_urls.yml)
  - URLs can stop working over time for several reasons. This check makes it possible to be informed of link rot and replace links with archived versions when needed.
- [Automatically cherry-pick relevant pull requests to stable branches](https://github.com/godotengine/godot-docs/blob/master/.github/workflows/cherrypick.yml)
  - The documentation is split into several branches (one for `master`, one for the latest `stable` version, one for `4.3` and so on). Pull requests that make changes relevant for stable versions are assigned a label such as `cherrypick:4.3`. When the pull request is merged, the commit is automatically cherry-picked to the corresponding stable branch.

## Internationalizing the documentation

As the Godot community is worldwide, we want the ability to provide not only the Godot editor in users' native languages, but also the documentation.

To internationalize content that gets continuously updated, we use dedicated tooling to keep the translations in sync with the source material. Sphinx can extract content from each page to put in translation catalogs in the [Gettext](https://en.wikipedia.org/wiki/Gettext) format (POT/PO files, [also supported by Godot!](https://docs.godotengine.org/en/stable/tutorials/i18n/localization_using_gettext.html)). We merge these 500 POT files into a monolithic "Godot Documentation" component (500,000 words).

The class reference is handled separately as its source material is not Sphinx's reStructuredText files, but XML files in the engine repository. For this, we use [a script](https://github.com/godotengine/godot-editor-l10n/blob/main/scripts/extract_classes.py) to extract the descriptions from the XML files and generate a Gettext POT file (600,000 words).

So we're currently at 1,100,000 words of documentation to translate! To put this into perspective, the Godot editor's translation has a bit more than 40,000 words.

Godot uses [Hosted Weblate](https://hosted.weblate.org) as a collaborative translation platform. This greatly simplifies the barrier to entry for editing Gettext files without merge conflicts, and provides a number of additional features such as suggestions, translation memory, or the ability to cross-compare translations.

- [**Godot Documentation**](https://hosted.weblate.org/projects/godot-engine/godot-docs/) and [**Class Reference**](https://hosted.weblate.org/projects/godot-engine/godot-class-reference/) components on Hosted Weblate
- Localized documentation websites: [cs](https://docs.godotengine.org/cs/4.x/), [de](https://docs.godotengine.org/de/4.x/), [es](https://docs.godotengine.org/es/4.x/), [fr](https://docs.godotengine.org/fr/4.x/), [it](https://docs.godotengine.org/it/4.x/), [ja](https://docs.godotengine.org/ja/4.x/), [ko](https://docs.godotengine.org/ko/4.x/), [pl](https://docs.godotengine.org/pl/4.x/), [pt-br](https://docs.godotengine.org/pt-br/4.x/), [ru](https://docs.godotengine.org/ru/4.x/), [uk](https://docs.godotengine.org/uk/4.x/), [zh-cn](https://docs.godotengine.org/zh-cn/4.x/), [zh-tw](https://docs.godotengine.org/zh-tw/4.x/)
- [Documentation on contributing translations](https://contributing.godotengine.org/en/latest/documentation/translation/index.html)
- [`#translation` channel on the Godot Contributors Chat](https://chat.godotengine.org/channel/translation)

<img alt="Hosted Weblate Godot documentation website screenshot" src="/storage/blog/ensuring-quality-godot-documentation/hosted-weblate.webp" />

## Splitting the contributor documentation to its own website

Since September 2025, documentation for new and returning engine contributors has been split to its own website, [contributing.godotengine.org](https://contributing.godotengine.org). This website is powered by Sphinx, just like the main documentation. This split was motivated by several factors:

- The documentation is split by minor version, but the contributing documentation generally does not need a version split. Feature development always happens on the `master` branch, with cherry-picking towards the previous stable branch. In practice, it's easier to maintain only one version of the documentation.
- Contributing to the engine requires English reading comprehension. The existing documentation had some translations available, but they were not always complete or up-to-date. Focusing on English for contribution guides reduces the burden on translators, which can then better focus on other sections of the manual.

Note that some of the pages that were previously in the Contributing section of the documentation were moved to a new section called [Engine details](https://docs.godotengine.org/en/latest/engine_details/architecture/index.html). These pages are not just useful for engine contributors, but also for people looking to compile their own builds and write custom modules in C++.

As an aside, splitting this website allows it to build much faster, which is useful when testing changes locally. The main documentation website now also builds slightly faster, but is still slow due to containing the class reference. The GitHub repository for the new website can be found at [godotengine/godot-contributing-docs](https://github.com/godotengine/godot-contributing-docs).

## Class reference progress tracker

The Godot documentation is more than just a manual. It also contains an hosted mirror of the *class reference*, which documents every class that's exposed to the scripting API in the engine. This class reference can be read directly offline in the editor, but the hosted version can be linked to on a website.

Since the class reference represents a massive amount of items to document, we built a website to track the documentation progress for each class:

- [**Godot class reference status**](https://godotengine.github.io/doc-status/)

This website relies on the [`doc_status.py`](https://github.com/godotengine/godot/blob/master/doc/tools/doc_status.py) script from the main Godot repository, which detects the completion percentage and outputs a Markdown table with the results.

Being aware of the overall and per-class completion percentages at all times made it a lot easier to improve the documentation coverage. As of writing, the overall completion percentage is **97%**. With additional efforts from [contributors like you](https://contributing.godotengine.org/en/latest/documentation/class_reference.html), we can perhaps reach 100% completion in the future.

<img alt="Godot class reference status website screenshot" src="/storage/blog/ensuring-quality-godot-documentation/doc-status.webp" />

## Team reports for class reference pull requests

Another way for contributors to organize pull requests and work through the backlog is to use the *team reports* website. This website was built for contributors to check all open pull requests in a more convenient fashion than using GitHub's web interface. Using this website, it's easier to see when pull requets were last active and whether they are in a mergeable state (which may not be the case due to merge conflicts).

This website only tracks the main Godot repository on GitHub, not the documentation repository. With that said, in the context of the documentation, this is still relevant since all contributions to the class reference are sent to the main Godot repository. (The documentation repository only hosts a generated copy of the class reference from the XML source files.)

- [**Godot Team Reports**](https://godotengine.github.io/godot-team-reports/#documentation)

<img alt="Godot team reports website screenshot" src="/storage/blog/ensuring-quality-godot-documentation/team-reports.webp" />

## User notes system

In 2024, the Godot documentation got an integration for user notes using [Giscus](https://giscus.app/). This allows users to share additional information relevant for documentation readers. This integration is currently present on the `4.4`, `4.5`, `stable`, and `latest` branches of the documentation.

As an example, you can see it in action at the bottom of the [GDScript reference](https://docs.godotengine.org/en/stable/tutorials/scripting/gdscript/gdscript_basics.html#godot-giscus) manual page.

<img alt="Godot documentation user notes screenshot" src="/storage/blog/ensuring-quality-godot-documentation/user-notes.webp" />

### Why have user notes on the documentation?

The Godot documentation is an essential learning resource for new and returning users alike. However, the content can sometimes benefit from additional clarification not found on the page itself. Since it's an officially-maintained resource, it also tries to limit the number of third-party resources it links to.

To resolve this problem, we've decided to introduce a *user note system* in the Godot documentation. Inspired by user-provided comment systems such as [PHP's](https://www.php.net/docs.php), this allows the community to make the documentation more useful for everyone: not just for users, but also for engine developers.

**It should be noted that *user notes* are different from the usual comments you'd find on a blog post.** As described by the [user-contributed notes policy](https://github.com/godotengine/godot-docs-user-notes/discussions/1), they are intended to be used to provide additional context for the documentation or link to community resources. They are not designed to report bugs or suggest features. When the documentation is incorrect or outdated, please open an issue on the [godot-docs](https://github.com/godotengine/godot-docs) repository instead of leaving a user note.

### How user notes are implemented

The user notes integration is powered by [Giscus](https://giscus.app/), an open-source script that allows integrating a GitHub Discussions thread on a web page. To do so, it automatically creates a discussion in a [repository](https://github.com/godotengine/godot-docs-user-notes) when the first comment on a page is posted. On the Godot documentation, pages are matched based on their file name, but several page matching modes are provided by Giscus depending on the website's needs.

Being hosted on GitHub Discussions allows anyone with a GitHub account to comment. On the organizational side, this also reduces system administration overhead as no separate backend or database for hosting comments is required. Spam protection (a traditionally difficult topic with comment platforms) is handled on GitHub's end, which has historically been quite effective at avoiding spam.

As a bonus, you can also watch the [godot-docs-user-notes](https://github.com/godotengine/godot-docs-user-notes) repository on GitHub to be informed of new user notes being added to documentation pages. Replying to user notes left by others is a good way to get started with documentation improvements, as many user notes bring new information that can be incorporated into the main page.

## Conclusion

This organization allows more people to contribute in various ways, even with limited technical know-how. Not only does the documentation benefit from those opening [pull requests](https://github.com/godotengine/godot-docs/pulls), it's also continuously improved every day by those posting user notes at the bottom of documentation pages. These user notes bring further clarifications and context to the manual pages, as well as linking to useful resources.

A massive **thank you** to [all contributors to the documentation](https://github.com/godotengine/godot-docs/graphs/contributors)! As always, we welcome contributions to the documentation. [The contribution process is well-documented](https://contributing.godotengine.org/en/latest/documentation/overview.html), but you're welcome to hop on the [`#documentation` channel on the Godot Contributors Chat](https://chat.godotengine.org/channel/documentation) if you have any questions.

## Support

If you would like to help with the development of these features, please consider [supporting the project financially](https://fund.godotengine.org/)! More funding allows us to sponsor volunteer contributors and better respond to technical demands of project users.

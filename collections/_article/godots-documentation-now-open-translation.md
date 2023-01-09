---
title: "Godot's documentation is now open for translation"
excerpt: "Godot has been around for over 4 years, and localized documentation in Spanish, Portuguese, Chinese, French, Russian and many other languages has always been a very requested feature. After a lot of documentation work to ensure that we have a good original English content to translate from, and some more work on setting up a convenient infrastructure for translating and keeping translations up to date, we are now ready to welcome contributions!"
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5ad/5d4/c96/5ad5d4c964791484476565.png
date: 2018-04-17 13:00:20
---

Ever since Godot was open sourced in 2014, localized documentation has been requested every now and then by new users. Some eager translators even started unofficial localized wikis, but without a proper infrastructure for internationalization, those were incomplete and quickly grew obsolete as the English documentation changed.

Today, we are finally ready to open the documentation for translation on [Hosted Weblate](https://hosted.weblate.org/projects/godot-engine/godot-docs/), where we already manage the [editor localization](https://hosted.weblate.org/projects/godot-engine/godot/).

You can contribute to an existing localization effort, or request the addition of a new language, but read the rest of this blog post first for a few words of caution – localization of something as big as Godot's documentation is not a light task!

## Doing things right

As mentioned above, some community members were so eager to help with localizing the documentation that they even started their own thirdparty wikis to work on it – so why didn't we build upon this motivation and waited 4 years to open the documentation for translation?

### Ensuring the quality of the content to translate

The main reason is our expectations for quality content. As long as we were not fully confident that our English documentation was of top quality, we did not want translators to spend countless hours translating content that might be obsolete or bound to be rewritten in the near future. Godot's documentation is *huge*, likely requires hundreds of hours of work for each language to be well translated, so even if some translators are motivated, it's not a task that should be undertaken lightly with no preparation.

During the 3.0 release cycle, a huge effort has been done on improving the documentation. [Nathan](https://github.com/NathanLovato), [Chris](https://github.com/KidsCanCode) and [Max](https://github.com/mhilbrunner) took charge of the [Documentation Team](https://github.com/godotengine/godot-docs/graphs/contributors), writing guidelines, reorganizing the sections, removing outdated or low quality content and writing new high quality tutorials.

Since the 3.0 release and the arrival of dozens of new documentation contributors, the pace at which improvements are written, contributed and merged is so strong that I'm hardly able to keep up with the changes.

Suffice it to say, Godot's documentation is now a well-managed and high-quality project, and it seems to be a good time to consider translating it to new languages. It will continue evolving in the future, but we are now confident that the available content is worth translating, and with the right infrastructure, future content should be easy to translate as it comes.

### Setting up the infrastructure

Seeing that the time has come to make the documentation translatable, and thanks to some [additional research](https://github.com/godotengine/godot-docs/issues/1057) by contributor Juankz, I started working on preparing the documentation repository for internationalization.

I've spent a good chunk of my work time those last three weeks working on this, doing some research on what workflow can be used with our existing [Sphinx](http://sphinx-doc.org/)/[Read the Docs](http://readthedocs.org/) documentation system.

Sphinx has a good [built-in support for internationalization](http://www.sphinx-doc.org/en/stable/intl.html) using Gettext, and makes it quite easy to extract the strings (paragraph by paragraph) from our [reStructuredText source files](https://github.com/godotengine/godot-docs). This leads to a [collection of template files](https://github.com/godotengine/godot-docs-l10n/tree/master/sphinx/templates) (POT files) matching the structure of the original repository, which can be converted to a [collection of catalog files](https://github.com/godotengine/godot-docs-l10n/tree/master/sphinx/po/es/LC_MESSAGES) (PO files) for each language.

Those can then be committed in the Git repository, and new Read the Docs projects [can be configured](https://docs.readthedocs.io/en/latest/localization.html) for each language to build the docs with the right translated strings.

So far so good – but the main issue for me was the sheer amount of content to translate, which would make a Git-only workflow very bothersome (especially if localization PRs would be in the same repository at the English documentation PRs). Since we were using the free and open source (and generously hosted) [Weblate](https://weblate.org) web-based service for the editor translations, I wanted to do the same for the documentation. Sadly there isn't a lot of documentation available on how to best combine Weblate and Sphinx/Read the Docs, so I got in touch with their respective developers to discuss possibilities.

While discussing with the Weblate maintainer, it became clear that having one template (POT) file for each page would not be a good workflow, as it would mean configuring almost 200 components in Weblate! (and deleting them when files are removed, and having to ask admins to add new components each time we add a file).

I saw that some projects like [PhpMyAdmin](https://github.com/phpmyadmin/localized_docs) would concatenate all their template files into one monolithic file, and only upload that one to Weblate, then convert the translations back to each single file for Sphinx... I wrote some `Makefile` logic to do that (since changed to a [Shell script](https://github.com/godotengine/godot-docs-l10n/blob/master/update.sh) because my `Makefile`-fu is limited), and was a bit concerned to see that the resulting monolithic file would be over 2.5 MB for Godot (meaning that catalog (PO) files would end up as over 5 MB with English source + localized string). And this is without the [Class Reference](http://docs.godotengine.org/en/3.0/classes/index.html), which is currently excluded from the documentation and would otherwise bring the template to 8 MB! I started looking into grouping files together in related sections, to have maybe 10 components instead of 200, but several would still be over 500 kB, so bringing little gain in usability while complexifying the maintenance a lot.

Finally, thanks to the advice of [Yuri Chornoivan](https://github.com/yurchor), who is an expert in internationalization of free software, including their documentation (such as that of the KDE, GNOME, Fedora and Ubuntu projects), I settled on the "huge monolithic template" approach. Weblate makes it relatively easy to work even with such big files, and offline translation tools like Poedit or Lokalize have features to filter the catalog to isolate a given page you want to work on.

Time will tell if it's a good workflow for localization and how we can improve it further. Suggestions and bug reports can be made in the dedicated [godot-docs-l10n](https://github.com/godotengine/godot-docs-l10n) repository.

## Translation workflow

Now that you know how it was set up, what's the workflow to contribute?

As mentioned above, once logged in [Hosted Weblate](https://hosted.weblate.org/projects/godot-engine/godot-docs/), you can contribute directly to your language if it's already a work-in-progress, or add it ("Start new translation" button in the bottom left part).

You can translate directly in the Weblate interface (pro tip: the "Zen mode" is quite useful to see the previous and following strings next to the one you want to translate, which can help understanding the context), or download the current translation catalog, work on it with an offline tool of your choice, and upload it back to Weblate.

**Do not make PRs to the godot-docs-l10n repository** (at least not to add translations), I will be syncing the Git repository with Weblate manually, as the process I outlined above is non trivial:

- Translations pulled from Weblate are the "monolithic" translation files, and need to be split into the per-page files that Sphinx expects before building the docs.
- Updating the Weblate monolithic template requires syncing the per-page Sphinx templates with the [godot-docs](https://github.com/godotengine/godot-docs) repository, then creating the monolithic template again and merging the changes in the monolithic translation catalogs.

Moreover, for now only two localized documentation websites exist ([es](http://docs.godotengine.org/es/latest) and [zh_CN](http://docs.godotengine.org/zh_CN/latest), created for testing purposes), I will create the other relevant ones as needed when some languages have a good level of completion in their translations (e.g. 10-15%, which would amount to the *Getting started* section for example).

## Strive for quality

Finally, if you are considering contributing to the documentation's localization for your language, please take your time to do it right, and ensure a high level of quality. There's enough content for several months of work with a handful of contributors, so don't rush it and focus on the most relevant parts first (especially the *Getting started* section).

Translating from English to your mother language may seem easy at first, but make sure that you have a good mastery of writing skills for your own language, and that you understand the English texts that you are translating. Approximate translations in software and documentation are always the source of a lot of frustration.

Also try to get in touch with other Godot translators for your language and define some guidelines for the writing style, punctuation, etc.

If you notice issues with the translation workflow, please report them in the [godot-docs-l10n](https://github.com/godotengine/godot-docs-l10n) repository. If you find issues with the English documentation itself (typos, unclear sentences, overall bad section), report them directly to the [godot-docs](https://github.com/godotengine/godot-docs) repository and/or make a PR to fix them.

Have fun translating Godot's documentation and making it accessible to all the users who struggle with reading English documentation!
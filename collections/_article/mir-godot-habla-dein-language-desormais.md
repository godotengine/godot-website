---
title: "你好 мир, Godot habla deine language désormais!*"
excerpt: "Internationalization support has been added to the editor in the current development branch! Translators are now encouraged to contribute as many languages as possible so that we can have a great multilingual 2.1 release!"
categories: ["progress-report"]
author: Rémi Verschelde
image: /storage/app/uploads/public/574/96e/202/57496e202d030947930555.png
date: 2016-05-28 00:00:00
---

It is generally accepted that, for programming, a certain knowledge of the Latin alphabet and a small understanding of the English language is needed. From there, there is a long distance to go before being fluent in the language.

We understand that, as such, there is a huge amount of programmers, from beginners to very talented developers, who would benefit enormously from using Godot in their native language. Moreover, Godot is a great tool for teamwork and is thus used by artists and game designers which might not even master the basic notions that programmers must know.

### Internationalization of the editor

To stop this unfair retribution of individuals who rightfully believe they have better things to do than becoming fluent at English, we have added internationalization support to Godot!

Only French is supported as of this writing (in the [git master branch](https://github.com/godotengine/godot/tree/master)), and we are still in a testing phase, but we are open to as many languages as you can contribute!

[![godot-2.1-fr.png](/storage/app/uploads/public/574/963/7c7/5749637c75028323711899.png)](/storage/app/uploads/public/574/963/7c7/5749637c75028323711899.png)

If you believe you are fluent in your own language (because some of us clearly are not), and want to help your comrades by submitting a translation, let us know!

### How to help?

The internationalization system in Godot is based on the well-established gettext/PO files workflow, though with a tailor-made parsing and integration of the translated strings that does not rely on gettext.

---

**Edit (June 2016):** The following section is no longer relevant, as we now manage Godot translations on [Hosted Weblate](http://hosted.weblate.org/). Please contribute your changes there, and the Godot core developers will handle syncing them with the git repository every now and then.

---

The strings to translate are all referenced in [the `tools.pot` template](https://github.com/godotengine/godot/blob/master/tools/translations/tools.pot). This template can be used to generate an empty PO file (e.g. `pt_BR.po` for Brazilian Portuguese) using gettext or a PO edition tool:

- With gettext: ``msginit -i tools.pot -o pt_BR.po``
- With a PO edition tool such as [Poedit](https://poedit.net), you can just load the `tools.pot` file and it will let you generate a language PO file from it.

You can then edit the newly created PO file with your favorite text editor (fill-in the `msgstr` entries, trying to respect the same formatting as in the `msgid` source strings), or with Poedit or a similar tool (which provide nice facilities for PO edition, such as translation memory).

Feel free to get in touch with other members of the community to work on your translation as a team. Once you're happy with it (even if only partially translated, if you want other contributors to pick up the work), make a pull request on the [GitHub repository](https://github.com/godotengine/godot) with your PO file in `tools/translations/`.

If you build the editor from source with your PO file in the correct folder, it should pick it up and extract the translated strings to display them in the editor!

### Troubleshooting

Note that this is a pretty new development in the master branch, and won't be backported to the current stable 2.0 branch. There are still various issues that have to be handled regarding internationalization (e.g. proper right-to-left languages support, Unicode font for languages that need it, etc.).

[Please report any issue](https://github.com/godotengine/godot/issues) you might see while translating so that we can have a great 2.1 release!

(\*) *Hello world, Godot speaks your language from now on!*
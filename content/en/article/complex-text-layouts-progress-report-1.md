---
title: "Complex text layouts progress report #1"
excerpt: "Report on the complex text layouts support implementation progress, part one: TextServer interface implementation details."
categories: ["progress-report"]
author: Pāvels Nadtočajevs
image: /storage/app/uploads/public/5f8/6ec/9d7/5f86ec9d7d0fd694122636.png
date: 2020-10-14 14:20:00
---

# Introduction

Hello! [bruvzg](https://github.com/bruvzg) here, I got hired by the Godot team to work on the complex text layouts and BiDi aware UI implementation. This is the first part that focuses on TextServer API implementation.

See [GH-1180](https://github.com/godotengine/godot-proposals/issues/1180), [GH-1181](https://github.com/godotengine/godot-proposals/issues/1181), [GH-1182](https://github.com/godotengine/godot-proposals/issues/1182), [GH-1183](https://github.com/godotengine/godot-proposals/issues/1183) on GitHub for detailed information on CTL proposals and feedback.

Currently, text display in Godot Engine is extremely limited, text is drawn character-by-character, left-to-right without kerning and support for any other font features.

Godot is incapable of correctly displaying text in the languages that are written right-to-left (e.g. Arabic, Hebrew), have context-sensitive characters (e.g. Arabic positional shape-forms) and ligatures or character reordering (e.g. Devanagari consonant placement).

# How does this work?

Since Godot is game engine and CTL support is slower than simple text display and can (depending on the set of supported features) substantially increase the size of the exported project, and is not required for every game, CTL support is implemented as standalone `TextServer` module, that can be disabled, or easily moved to the GDNative library in the future.

Here's `TextServer` API in the current state (API is not final and is subject to minor changes during further development): https://bruvzg.github.io/textserver-api-overview.html

# Preparation work

`wchar_t` type that was previously used by Godot to store Unicode string, is inconsistent and have different size on different platforms. Due to lack of UTF-16 surrogate pair support Godot was incapable to store and display character outside the basic multilingual plane (characters with the codes above `0xFFFF`, e.g. emojis) on Windows, where `wchar_t` is 16-bit.

For the ease of `TextServer` and GDNative interface development, Godot strings were changed to always use C++11 `char32_t` type and store string in UTF-32 encoding.
Additionally, fully functional (with surrogate pairs support) conversion to and from UTF-16 is implemented for use with Windows APIs.
All ASCII/Latin-1, UTF-8, UTF-16, and UTF-32 functions are exposed to GDNative and covered with unit tests.

# TextServer structure

![TextServer structure overview](/storage/app/uploads/public/5f8/6e6/fe4/5f86e6fe4559f023119606.png)

The new implementation introduces `TextServer` singleton, for low level handling of:

* Fonts (loading font files, font substitution, and rendering text).
* Text processing for display:
    * Bi-directional reordering, using ICU library, with the optional override for highly structured texts (e.g. File path, URIs, and source code).
    * Breaking text into uniform (with the same language, writing system, font and direction along whole text) runs (custom implementation, backed with ICU Unicode database API).
    * Context-sensitive shaping (translation a string of character into a properly arranged sequence of glyphs, OpenType features), using HarfBuzz and SIL Graphite libraries.
* Line breaking (custom implementation, optionally backed with ICU Break Iterator API).
* Text justification (fitting text to the desired width), using spaces and kashidas, (custom implementation, optionally backed with ICU Break Iterator API to break words in the languages without spaces between the words).
* Aligning text to the tab stops.
* Helper functions for the input controls:
    * Detection of selection/highlight rectangles in the bi-directional text.
    * Split caret drawing (caret on the border of different direction runs).
    * Caret movement over composite graphemes (composed of multiple combining characters).
    * Hit testing for caret placement.

# Current TextServer implementations

All text server implementations are fully interchangeable, project development with one text server can be easily switched to the different one without any changes to the code or resources. Changing text server in runtime is also possible but require reloading all themes and fonts, and refreshing all controls, therefore it's not recommended.

## TextServerAdvanced

ICU, HarfBuzz, and SIL Graphite backed text server.

Default text server with full CTL support, vertical text support (vertical text can be shaped and displayed by text server, but currently there're no plans to support it in controls).

`TextServerAdvanced` is capable of loading and using ICU break iterator database (4 MB). Break iterator database is included in the editor binary by default, and can be added to the exported project on demand, without rebuilding export templates.

Supports TrueType/OpenType (FreeType backed) and BMFont format fonts.

![TextServerAdvanced Screenshot](/storage/app/uploads/public/5f8/6e2/612/5f86e2612931d380061737.png)
*`TextServerAdvanced` - with BiDi and shaping support.*

## TextServerFallback

Simple, fallback text server without BiDi, shaping, OpenType font features and kashida justification support.

`TextServerFallback` supports basic font features, like kerning, line breaking (using spaces to detect words), basic justification and have limited vertical text support.
Fallback text server is intended for use in the projects that do not need CTL support to avoid CTL overhead. Fallback text server can be used with Godot editor as well, in this case unsupported locales are automatically disabled.

Supports same font types as the `TextServerAdvanced`.

![TextServerFallback Screenshot](/storage/app/uploads/public/5f8/6e2/bc6/5f86e2bc652b4356694485.png)
*`TextServerFallback` - No BiDi and contextual shaping.*

## TextServerGDNative

Wrapper class for the GDNative text server implementations.

## Reference work

* TextServer implementation proposal -  https://github.com/godotengine/godot-proposals/issues/1180
* UTF-32 transition - https://github.com/godotengine/godot/pull/40999  (merged to the master branch).
* Text server implementations - https://github.com/godotengine/godot/pull/41100 (first 4 commits, PR is regularly rebased to keep up with upstream changes, exact commit hashes may vary).
* BiDi and shaping process overview diagram - https://bruvzg.github.io/media/files/gdtl_operation_notes_1_shaping_draft.pdf
* Line breaking process overview diagram - https://bruvzg.github.io/media/files/gdtl_operation_notes_2_line_breaking_draft.pdf
* Line justification process overview diagram - https://bruvzg.github.io/media/files/gdtl_operation_notes_3_justification_draft.pdf
* GDNative library template - https://github.com/bruvzg/gdnative_text_server_template (dummy GDNative library implementation, intended as a base for future CoreText, DirectWrite based text servers or/and moving ICU/HarfBuzz based text server out of the core engine distribution).

## Additional resources

* UAX #9: Unicode Bidirectional Algorithm - http://www.unicode.org/reports/tr9/
* Bidirectional text FAQ - http://www.unicode.org/faq/bidi.html
* ICU homepage - http://site.icu-project.org/
* HarfBuzz homepage - https://harfbuzz.github.io/
* SIL Graphite homepage - https://scripts.sil.org/cms/scripts/page.php?site_id=projects&item_id=graphite_home
* Approaches to full justification - https://www.w3.org/International/articles/typography/justification
* Kashida expansion priorities - https://web.archive.org/web/20160304113846/http://www.microsoft.com/middleeast/msdn/JustifyingText-CSS.aspx

## Future

Stay tuned for the next progress report. Next part will focus on UI mirroring and related changes.

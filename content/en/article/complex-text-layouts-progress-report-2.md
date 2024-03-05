---
title: "Complex text layouts progress report #2"
excerpt: "Report on the complex text layouts support implementation progress, including changes to Godot's Font resources, and UI mirroring and BiDi implementation details."
categories: ["progress-report"]
author: Pāvels Nadtočajevs
image: /storage/app/uploads/public/5f9/ab1/122/5f9ab11220775871830624.png
date: 2020-11-10 08:00:00
---

# Introduction

This is the second part of my work on Complex Text Layouts for Godot 4.0, focusing on Fonts and UI mirroring.

See [godot-proposals#1180](https://github.com/godotengine/godot-proposals/issues/1180), [godot-proposals#1181](https://github.com/godotengine/godot-proposals/issues/1181), [godot-proposals#1182](https://github.com/godotengine/godot-proposals/issues/1182), and [godot-proposals#1183](https://github.com/godotengine/godot-proposals/issues/1183) on GitHub for detailed information on <abbr title="Complex Text Layouts">CTL</abbr> proposals and feedback.

See also the [previous progress report](https://godotengine.org/article/complex-text-layouts-progress-report-1) for the `TextServer` API implementation details.

# Changes to the Godot Fonts

Since font handling was moved to `TextServer`, some substantial changes were made to the Godot `Font` and related classes:

`BitmapFont`, `DynamicFont` and `DynamicFontData` were removed and replaced with universal `Font` and `FontData` resources which are backed by `TextServer`. This provides cleaner font fallback/substitution and possibility for custom text servers to expose different types of fonts without interface changes, for example direct access to the system fonts.

The new `Font` class provides new functions to draw and measure multiline text, and apply alignment.

Font and outline size, that were properties of the `Font` instance, are moved to the arguments of the draw functions and theme constants. This allows changing font size for individual draw calls, controls, or spans of text in the `RichTextLabel` control without creating new `Font` instances.

Functions for loading font data from the memory buffer are exposed to GDScript and GDNative.

## Font substitution system for scripts and languages

A new, smarter font substitution system is added:

* Each `FontData` has an associated list of supported scripts (writing systems) and languages. For a TrueType/OpenType fonts, a script list is populated automatically from the OS2 table, but it's not always precise.
* Script and language support can be overridden by the user.
* For each run of text with a specific script and language, `TextServer` will try to use fonts in the following order:
    * Fonts with both script and language supported.
    * Fonts with script supported.
    * Rest of the fonts.

Here're a few cases of manual override:

1. Many Latin fonts have a limited set of Greek characters for use in scientific texts (and such fonts usually have Greek script support flag set in the OS2 table), but it's not always enough to display Greek text. Adding a separate font with full Greek support, and disabling Greek support in the main font will prevent `TextServer` from mixing characters form different fonts.
2. TrueType/OpenType font tables do not have flags for rare/ancient scripts (e.g. Egyptian hieroglyphs), enabling script support manually will speed up font substitution.
3. Some languages use the same script, but different font styles (e.g. Kufic, Naskh and Nastaʼlīq writing styles preferred for writing different Arabic languages; or the use of traditional Chinese characters in different regions and CJK variants - Traditional Chinese, Simplified Chinese, Japanese, and Korean). Setting language overrides allows to seamlessly use the same font stack for the text in different languages and get the desired style.

*Incorrect font used for "μ":* ![Screenshot of Greek text with incorrect font](/storage/app/uploads/public/5f9/ab0/8c2/5f9ab08c29909806138597.png)
*Correct font used for "μ":* ![Screenshot of Greek text with correct font](/storage/app/uploads/public/5f9/ab0/990/5f9ab0990205f215371719.png)
*`Label`s with `language` property set, using the same `Font` instance:* ![Screenshot of Arabic scripts](/storage/app/uploads/public/5f9/ab0/a45/5f9ab0a45ba9c930829579.png)
*CJK variants, `Label`s using same font instance:*![Screenshot of CJK variants from a same Font](/storage/app/uploads/public/5f9/c8b/149/5f9c8b149a866095706571.png)

## Variable fonts

Additionally, the new `Font` and `TextServer`'s <abbr title="Bidirectional">BiDi</abbr> and shaping features can work with variable fonts (see [godot#43030](https://github.com/godotengine/godot/pull/43030) for the variable font support PR):

![Variable fonts support](/storage/app/uploads/public/5f9/ab1/9a7/5f9ab19a7b4d9032991692.gif)

Functions to control the font size were added to the `Theme`, `Control`, and `Window` classes:

- `Control` and `Window` functions: `add_theme_font_size_override`, `get_theme_font_size`, `has_theme_font_size`, `has_theme_font_size_override`.
- `Theme` functions: `clear_font_size`, `get_font_size`, `get_font_size_list`, `has_font_size`, `set_font_size` to control the font size in a similar manner to existing functions for `Font`. The special value `-1` can be used as unset/default (have the same effect as `null` for the font).

# UI mirroring

To ensure that the content is easy to understand, user interfaces for the right-to-left written languages should flow from right-to-left. UI "mirroring" provides a convenient way to achieve this without designing separate interfaces for the <abbr title="Right-to-Left">RTL</abbr> and <abbr title="Left-to-Right">LTR</abbr> languages.

*Right-to-left UI:* ![UI mirroring for RTL written languages](/storage/app/uploads/public/5f9/ab0/bd9/5f9ab0bd9bc7f519888172.png)
*Left-to-right UI:* ![UI mirroring for LTR written languages](/storage/app/uploads/public/5f9/ab0/c09/5f9ab0c095876209674720.png)

In most cases, UI mirroring should happen automatically, and do not require any actions from the user or knowledge of the RTL writing systems.

Each `Control` has a `layout_direction` property to control mirroring. It can be set to `inherited` (use the same direction as the parent control, same as `auto` for the root control), `auto` (direction is determined based on the current locale), or forced to RTL or LTR.

On the above screenshots, the green and blue "compass" controls are forced to LTR and RTL layout respectively, the red container is set to `auto` and the rest of the UI uses `inherited` (default setting) direction.

For RTL languages, Godot will automatically do the following changes to the UI:

* Mirror left/right anchors and margins.
* Swap left and right text alignment.
* Mirror horizontal order of the child controls in the containers, and items in `Tree`/`ItemList` controls.
* Use mirrored order of the internal control elements (e.g. `OptionButton` dropdown button, checkbox alignment, `List` column order, `Tree` item icons and connecting line alignment, etc.), in some cases mirrored controls use separate theme styles.
* The coordinate system is not mirrored, and non-UI nodes (sprites, etc.) are not affected.

# BiDi override for structured text

The Unicode <abbr title="Bidirectional">BiDi</abbr> algorithm is designed to work with natural text and it's incapable of handling text with a higher level order, like file names, URIs, email addresses, regular expressions or source code.

The `structured_text_bidi_override` property and the `_structured_text_parser` callback are added to the all text controls to handle this.

*File path display:* ![File paths with BiDi override](/storage/app/uploads/public/5f9/ab0/cd0/5f9ab0cd03075487056412.png)

For example, the path for the directory structure in the above screenshot will be displayed incorrectly (top `LineEdit` control). The `File` type structured text override splits text into segments, then the BiDi algorithm is applied to each of them individually to correctly display directory names in any language and preserve correct order of the folders (bottom `LineEdit` control).

Custom callbacks provide a way to override BiDi for the other types of structured text. For example, the following code splits a text using `:` as separator, applies BiDi to each part, and displays them in reversed order. The BiDi override can be used with any control, including input fields (`LineEdit`, `TextEdit`).

{{< highlight gdscript >}}
func _structured_text_parser(args, text):
    var ranges = []
    var offset = 0
    for t in text.split(":"):
        var text_offset = offset + t.length()
        ranges.push_front(Vector2i(offset, text_offset) # Add text
        ranges.push_front(Vector2i(text_offset, text_offset + 1)) # Add ":"
        offset = text_offset + 1
    return ranges
{{< /highlight >}}

# Other changes to the Godot controls

To control BiDi and font related features, all controls have the following properties added:

- `language` property (only for controls with text):
Overrides the locale for that node: controls language specific line breaking rules, OpenType localized form, shaping, and font substitution.

*English and Romanian rendering of the same string:* ![English and Romanian rendering of the same string](/storage/app/uploads/public/5f9/ab0/d67/5f9ab0d67b297148367651.png)

- `opentype_features` property (only for controls with text):
Controls OpenType font features for the node e.g. ligature types to use, number styles, small caps, etc. ([Full list of standard tags](https://docs.microsoft.com/en-us/typography/opentype/spec/featuretags), fonts can have custom features as well).

*OpenType features:* ![Labels using different OpenType features](/storage/app/uploads/public/5f9/ab0/e30/5f9ab0e30a6ab831089813.png)

# Reference work

- UI improvements for implementing BiDi aware apps proposal: [godot-proposals#1183](https://github.com/godotengine/godot-proposals/issues/1183).
- UI mirroring, Font, Theme, and control changes: [godot#41100](https://github.com/godotengine/godot/pull/41100) (commits 5 to 8, the PR is regularly rebased to keep up with upstream changes, exact commit hashes may vary).
- Variable font support PR: [godot#43030](https://github.com/godotengine/godot/pull/43030).
- Mirroring, BiDi layout and override demo projects: [godot-demo-projects#538](https://github.com/godotengine/godot-demo-projects/pull/538).

# Additional resources

- [Windows guidelines to design apps for bidirectional text](https://docs.microsoft.com/en-us/windows/uwp/design/globalizing/design-for-bidi-text).
- [Mozilla RTL guidelines](https://developer.mozilla.org/en-US/docs/Mozilla/Developer_guide/RTL_Guidelines).

# Future

The next part will focus on the changes to the specific controls and `RichTextLabel` BBCode.

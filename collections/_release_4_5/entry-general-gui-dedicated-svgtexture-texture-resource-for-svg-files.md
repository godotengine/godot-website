---
type: entry
section: general
subsection: GUI
rank: 3
importance: 2
anchor: dedicated-svgtexture-texture-resource-for-svg-files
title: "Dedicated `SVGTexture` texture resource for SVG files"
text: |
  SVGs are different from bitmap images as they are vector-based. This means that no matter how much you zoom, the shapes will never break down into discrete pixels.

  Until this release, Godot was converting every SVG file into a bitmap-based image. It is now possible to load SVG files (even dynamically) properly with the new `SVGTexture` resource.

  TODO
contributors:
  - name: bruvzg
    github: bruvzg
read_more: https://github.com/godotengine/godot/pull/105375
---

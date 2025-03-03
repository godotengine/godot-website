---
type: entry
section: systems
subsection: rendering
rank: 0
importance: 2
anchor: lightmaps-bicubic
title: "Lightmaps: bicubic sampling & transparency"
blockquote: Blend into the <span class="highlight">shadows</span>
text: |
  Thanks to bicubic sampling (and new antialiasing for direct light samples), your low resolution static shadows will now look better than ever.

  This method for reading from lightmaps smoothes out sharp edges, but requires a small run-time performance cost. You can disable it in the project settings if needed.

  Additionally, lightmaps now support baking transparent objects and correlatedly: tinted shadows.
contributors:
  - name: BlueCube3310
    github: BlueCube3310
read_more: https://github.com/godotengine/godot/pull/89919
image_label: "Off"
image_alt: The Sponza scene with bicubic shadows turned off.
image_src: /storage/releases/4.4/images/godot_shadow_bicubic_off.webp
image_src_2x: /storage/releases/4.4/images/godot_shadow_bicubic_off_2x.webp
image_comparison_label: "On"
image_comparison_alt: The Sponza scene with bicubic shadows turned on.
image_comparison_src: /storage/releases/4.4/images/godot_shadow_bicubic_on.webp
image_comparison_src_2x: /storage/releases/4.4/images/godot_shadow_bicubic_on_2x.webp
media_position: left
---

---
type: entry
section: systems
subsection: xr
rank: 0
importance: 4
anchor: fragment-density-map-support
title: Fragment density map support
blockquote: TODO
text: |
  In order to push great visuals on a VR headset, a little cheating is often necessary. As players tend to turn their head rather than move their eyes too far from the center and as pixels around the edges of the viewport are often distorted by the lens, why should the device render these parts at full resolution?

  This is exactly what the "Fragment Density Map" Vulkan extension does: it renders the edges of the viewport at a lower resolution with little noticeable decrease in quality. It makes the Mobile renderer (using the Vulkan rendering driver) more viable for VR on standalone.

  It is not necessarily a new feature to Godot, as the "Fragment Rate Shading" Vulkan extension already does something similar. But they differ in terms of device compatibility. Don’t worry though, as Godot will now choose the best supported method for the device. Users will only have to care about "Variable Shading Rate", which is the term that encompasses both extensions.
contributors:
  - name: Darío
    github: DarioSamo
read_more: https://github.com/godotengine/godot/pull/99551
---

---
type: entry
section: systems
subsection: XR
rank: 1
importance: 4
anchor: foveated-rendering-on-vulkan-mobile
title: Foveated rendering on Vulkan Mobile
text: |
  In order to push great visuals on a VR headset, a little cheating is often necessary. The human eye sees more detail at the center of your gaze, and less around your peripheral vision. So, why should we render the edges of the viewport at full resolution?

  This is called "foveated rendering" and it’s something Godot has supported with OpenGL or Vulkan on desktop (via the "Fragement Shading Rate" extension) for a long time.

  However, now support for the "Fragment Density Map" Vulkan extension has been added which also enables this on the Vulkan Mobile renderer, making it a more viable option for standalone VR headsets.
contributors:
- name: Darío
  github: DarioSamo
- name: David Snopek
  github: dsnopek
read_more: 
  https://github.com/godotengine/godot/issues?q=is%3Apr%20state%3Amerged%2099551%2099768
---

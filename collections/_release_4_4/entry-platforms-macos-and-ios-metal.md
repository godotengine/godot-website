---
type: entry
section: platforms
subsection: macos-and-ios
rank: 0
importance: 3
anchor: "metal-rendering-backend"
title: "Metal rendering backend"
blockquote: "Melting the workarounds"
text: |
  Metal is a low-level graphics API similar to Vulkan or D3D12, which are both supported by Godot but not available on macOS and iOS. Until now Godot used a library called MoltenVK to run Vulkan over Metal.

  This direct implementation is more efficient and allows greater control over features and performance trade-offs in the future. Early results have shown that this backend is at least as fast as Vulkan and in many cases much faster on Apple hardware.

  In relation to this new backend, you now have the option to use MetalFX upscaling as an alternative to the existing upscaler.

  Note that Metal support is currently limited to Apple Silicon (ARM) devices.
contributors:
  - name: Stuart Carnie
    github: stuartcarnie
read_more: https://github.com/godotengine/godot/pull/88199
---

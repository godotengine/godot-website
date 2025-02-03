---
type: entry
section: platforms
subsection: macos-and-ios
rank: 0
anchor: "metal-rendering-backend"
title: "Metal rendering backend"
blockquote: "For macOS and iOS"
text: |
  Metal is a low-level graphics API similar to Vulkan or D3D12, which are both supported by Godot but not available on macOS and iOS. Until now Godot used a library called MoltenVK to run Vulkan over Metal.

  This direct implementation is more efficient and allows greater control over features and performance trade-offs in the future. Early results have shown that this backend is at least as fast as Vulkan and in many cases much faster on Apple hardware.

  Note that Metal support is currently limited to Apple Silicon (ARM) devices.
contributors:
  - name: Stuart Carnie
    github: stuartcarnie
read_more: https://github.com/godotengine/godot/pull/88199
---

---
type: entry
section: systems
subsection: rendering
rank: 0
importance: 2
anchor: specular-occlusion-from-ambient-light
title: Specular occlusion from ambient light
blockquote: Added realism for cheap
text: |
  Ever wondered why some objects would eerily shine as if they were lit in an occluded area where they shouldn’t? For example, a common stumbling block for users is seeing light from the sky get reflected in the cracks between bricks in a brick wall.

  That’s because the calculation of the light reflected off a surface didn’t take ambient occlusion into account.

  Fortunately, our renderer now has a cheap option for specular occlusion that should fix this issue.

  For existing projects where it could break the look, don’t fret. A toggle is available in the project settings.
contributors:
- name: Lander
  github: lander-vr
read_more: https://github.com/godotengine/godot/pull/106145
media_position: right
carousel:
  comparison: true
  elements:
  - image_alt: Bathroom scene on Forward+ without specular occlusion from 
      ambient light.
    image_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-1-disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-1-disabled_2x.webp
    image_label: Forward+ w/o
    image_comparison_alt: Bathroom scene on Forward+ with specular occlusion 
      from ambient light.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-1-enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-1-enabled_2x.webp
    image_comparison_label: Forward+ w/
    content_creator: "[@lander-vr](https://bsky.app/profile/landervr.bsky.social)
      (based on [@CihanGurbuz’s scene](https://discussions.unity.com/t/specular-occlusion/807318))"
    position: bottom-center
  - image_alt: Abstract banana on a wooden floor illumuinated behind it by 
      multiple lights scene on Forward+ without specular occlusion from ambient 
      light.
    image_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-2-disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-2-disabled_2x.webp
    image_label: Forward+ w/o
    image_comparison_alt: Abstract banana on a wooden floor illumuinated behind 
      it by multiple lights scene on Forward+ with specular occlusion from 
      ambient light.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-2-enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-2-enabled_2x.webp
    image_comparison_label: Forward+ w/
    content_creator: "[@lander-vr](https://bsky.app/profile/landervr.bsky.social)"
  - image_alt: Car wheel scene on Forward+ without specular occlusion from 
      ambient light.
    image_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-4-disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-4-disabled_2x.webp
    image_label: Forward+ w/o
    image_comparison_alt: Car wheel scene on Forward+ with specular occlusion 
      from ambient light.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-4-enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_forwardplus-4-enabled_2x.webp
    image_comparison_label: Forward+ w/
    content_creator: "[@lander-vr](https://bsky.app/profile/landervr.bsky.social)"
  - image_alt: Bathroom scene on Mobile without specular occlusion from ambient 
      light.
    image_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_mobile-1-disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_mobile-1-disabled_2x.webp
    image_label: Mobile w/o
    image_comparison_alt: Bathroom scene on Mobile with specular occlusion from 
      ambient light.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_mobile-1-enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_mobile-1-enabled_2x.webp
    image_comparison_label: Mobile w/
    content_creator: "[@lander-vr](https://bsky.app/profile/landervr.bsky.social)
      (based on [@CihanGurbuz’s scene](https://discussions.unity.com/t/specular-occlusion/807318))"
    position: bottom-center
  - image_alt: Bathroom scene on Compatibility without specular occlusion from 
      ambient light.
    image_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_compatibility-1-disabled.webp
    image_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_compatibility-1-disabled_2x.webp
    image_label: Compatibility w/o
    image_comparison_alt: Bathroom scene on Compatibility with specular 
      occlusion from ambient light.
    image_comparison_src: 
      /storage/releases/4.5/images/godot_specular-occlusion_compatibility-1-enabled.webp
    image_comparison_src_2x: 
      /storage/releases/4.5/images/godot_specular-occlusion_compatibility-1-enabled_2x.webp
    image_comparison_label: Compatibility w/
    content_creator: "[@lander-vr](https://bsky.app/profile/landervr.bsky.social)
      (based on [@CihanGurbuz’s scene](https://discussions.unity.com/t/specular-occlusion/807318))"
    position: bottom-center
---

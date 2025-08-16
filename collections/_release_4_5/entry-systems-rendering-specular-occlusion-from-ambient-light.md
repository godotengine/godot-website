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
---

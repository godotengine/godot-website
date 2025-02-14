---
type: entry
section: general
subsection: editor
rank: 5
importance: 2
anchor: "shadowmasks-for-lightmapGI"
title: "Shadowmasks for LightmapGI"
blockquote: "Both. Both is good."
text: |
  From now on, you don't have to choose between fully baked or fully dynamic shadows anymore when using LightmapGI.

  By enabling shadowmasks while baking your lightmaps, it is now possible to use static shadows in the distance and dynamic shadows up close. The lower resolutions far away will save precious resources, while the level of detail close to the player is not impacted.

  Shortening the range of your dynamic shadows like so provides very important optimization, especially for mobile applications.
contributors:
  - name: BlueCube3310
    github: BlueCube3310
read_more: https://github.com/godotengine/godot/pull/85653
---

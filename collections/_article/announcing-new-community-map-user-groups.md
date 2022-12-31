---
title: "Announcing the new community map for user groups"
excerpt: "Starting from today, there is a new User groups page on the Godot Engine website! This page replaces the old User groups page by featuring a community map that can be freely navigated and contributed to."
categories: ["news"]
author: Hugo Locurcio
image: /storage/app/uploads/public/600/86b/4bc/60086b4bc8790999054229.png
date: 2021-01-20 17:45:00
---

Starting from today, there is a new <a href="https://godotengine.org/community/user-groups" data-barba-prevent>User groups</a> page on the Godot Engine website! This page replaces the old User groups page by featuring a community map that can be freely navigated and contributed to.

## What is the community map?

The community map on the <a href="https://godotengine.org/community/user-groups" data-barba-prevent>User groups</a> page allows you to see where physical and online communities are located around the world.
In addition, the list of communities below the map is now automatically generated and will always be in sync with the community map.

<a href="https://godotengine.org/community/user-groups" data-barba-prevent>
  <img src="/storage/app/media/new_community_map.png" alt="Screenshot of the community map">
</a>

If you host a physical or online community, feel free to add it to the list by editing the top of [`user-groups.html` in the godot-website repository](https://github.com/godotengine/godot-website/blob/master/themes/godotengine/pages/user-groups.htm) and opening a pull request. Make sure to group it with other communities in the same country (if any).
Alternatively, you can also send an e-mail to *webmaster at godotengine · org* to request your community to be added to the list.

For the curious, the map is powered by the open source [Leaflet.js](https://leafletjs.com/) library and uses the [Mapbox Static Tiles API](https://docs.mapbox.com/api/maps/#static-tiles). You can view the implementation in [this pull request](https://github.com/godotengine/godot-website/pull/201).
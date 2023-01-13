---
title: "Godot gets a new FileSystem dock for 3.1"
excerpt: "Godot's FileSystem dock gets an improved tree view mode with files included in the tree, with thumbnails. This makes it much easier to go through project files from a single dock. Various improvements are also done to the favorites usability, right-click menu and the split view mode."
categories: ["progress-report"]
author: Gilles Roudiere
image: /storage/app/uploads/public/5ba/4cd/937/5ba4cd9370adf233240214.png
date: 2018-09-21 10:53:56
---

Before anything else, we would like to thank our long-time sponsor [Gamblify](https://www.gamblify.com) for having donated this new feature to the community. Their involvement and their constant support to make this engine better are deeply appreciated.

For the upcoming 3.1 release, Godot gets a brand new FileSystem dock. Files, not only folders, are now displayed directly in the tree view :

![New FileSystem dock](/storage/app/media/3.1/FileSystem%20dock/filesystemdock.png)

This new display, which can be switched with the older one with a button on the top of the dock, avoids splitting the dock in two areas. This allows a more compact interface, which also lead us to reconsider the default layout for the editor. As you can see, more space is now available to the inspector, reducing the scrolling needed there:

![New default editor layout](/storage/app/media/3.1/FileSystem%20dock/newlayout.png)

## Features

Amongst a set of more minimal improvements, this new FileSystem dock features several things:

- Files can now be marked as favorites, not only folders.
- Complete drag & drop support, including dragging files and folders into the favorites section:
![Favorites drag and drop](/storage/app/media/3.1/FileSystem%20dock/dragdrop.gif)
- Type icons next to each file name. For textures and materials, this icon is replaced by a mini-thumbnail of the resource:
![Files thumbnails](/storage/app/media/3.1/FileSystem%20dock/thumnails.png)
- A search field, to filter entries in the tree:
![Search filter](/storage/app/media/3.1/FileSystem%20dock/search.gif)
- A right-click menu, to handle files exactly as in the file list.
- The "Mark as favorite" button has been moved to a menu entry, found when you right-click files or folders.
- The "Find current scene in files" button has been moved to a menu entry, when right-clicking on a scene tab.

We hope you will enjoy this new FileSystem dock. We are waiting for your feedback!

*Note: this new feature is outside the scope of the current feature freeze, since it has been on the roadmap and worked on since before the feature freeze took effect.*

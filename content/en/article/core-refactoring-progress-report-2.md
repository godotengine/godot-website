---
title: "Core refactoring progress report #2"
excerpt: "As promised in my previous post, the core refactoring work I am undertaking took two months to complete. This means rewriting large parts of the core engine for consistency and features."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5e7/f74/307/5e7f74307ce34896455561.jpeg
date: 2020-03-28 00:00:00
---

As promised in my previous post, the core refactoring work I am undertaking took two months to complete. This means rewriting large parts of the core engine for consistency and features.

### Core refactoring

Core refactoring is mostly work on the most low level, critical and shared parts of the engine. This work is done only on major versions because it implies breaking compatibility and introducing instability and bugs (because of all the new added code), which is actually the case right now. The major refactoring undertaken for Godot 3.x, two years ago, changed a large part of the internals, but we were unable to do everything we wanted to do.

The migration to Vulkan already implied breaking compatibility and, together with all the user feedback we got since 3.x was released, we have a very good idea of what needed to change in this time.

So following is the list of what changed during March:

#### OS / DisplayServer split

One of the largest singletons in Godot is the [OS](https://docs.godotengine.org/en/3.1/classes/class_os.html) class. It allows access to low-level OS functions as well as window management.

This was cumbersome for many reasons and also imposed limitations, such as:

* Having a large, bloated OS class on every platform.
* Inability to support different display APIs in a single binary. This is specially visible in Desktop Unixes, where you can use X11, Wayland or even EGL directly on Raspberry PI.
* Proper support for multiple windows. This not only allows the editor to make some docks float so you can move them to another monitor (a very requested feature by users). This is also useful for games developed for certain types of dedicated hardware, or just for tools created with Godot as the base platform (which is something several users do).
* Impossible to run the engine as headless (with a dummy display driver) in all platforms. The "server" platform had to be used as a workaround (and will now be deprecated).
* Difficult to abstract window management functions to users, which had to access the OS class directly (and which is not as user friendly as working with nodes).

The new implementation moves all low level window management to a new singleton, **DisplayServer**, which handles everything regarding display. To make implementation simpler and more portable, Godot will always assume you have one _main window_ and, if platform supports, allow you to create _sub windows_.

#### Window node

The new **DisplayServer** allows managing multiple windows, but using it directly is still too low level and unfriendly for most users. To compensate, a new **Window** node has been introduced. This node inherits **Viewport** and gives it the ability to appear as a floating window. Working with it is easy: just place your nodes as children of Window!  You can create UIs (with controls), or display the 3D world on it (just adding a **Camera** node). It' s basically the same as a Viewport, so Using this new node is extremely easy and straightforward.



![embedded2.jpeg](/storage/app/uploads/public/5e7/f73/7eb/5e7f737eb5c64127870073.jpeg)


Additionally, the root node in Godot ({{< highlight gdscript >}}
get_tree().get_root()
{{< /highlight >}}), which used to be of type **Viewport**, has now changed to be of **Window** type. If you want to manage the game window, simple access this node directly.

All input events, which were previously sent to the *MainLoop* class, are now sent directly from **DisplayServer** to *Window* (so MainLoop and hence, *SceneTree* have been stripped of this functionality).

#### Multiple Window Support in Editor

Likewise, the Godot Editor now supports making the docks float. For now, only docks and existing windows are supported but we will extend support for other parts of the editor.

It is important to note that by default **docks will remain *docked* ** and nothing will change. Some users expressed concerns that we would now force them to always use floating windows. This **is not the case**, you can make windows separate from the main one **only if you want** (like as an example, you have a second monitor and you want to make use of more screen-space), but by default **nothing will change**.

#### Embedded mode

But, what if you are working on a full-screen game and need to use windows? Or what about platforms which don't support floating windows such as iOS, Android, HTML5 or even consoles?

One of the new features of this system is that the **Viewport** class can now be instructed to embed all children **Window** nodes and provide internal windows for them, so it will emulate a window manager within it, including decorations, resizing, title bar, close button, etc. This can be done manually by toggling the "embed subwindows" property.

At the same time the new **DisplayServer** can be queried for features and one of them is *subwindow* support, so the new root **Window** will check whether this is supported on each platform and toggle the property automatically. This is completely transparent to the user, so games (or the editor) don't need to be change to run on platforms that don't support subwindows.


![embedded3.png](/storage/app/uploads/public/5e7/f73/92d/5e7f7392d353b123436098.png)


If, for debug purposes, you want to run the editor (or your game) using subwindows instead of hardware windows, use the {{< highlight bash "inline=true" >}}--single-window{{< /highlight >}} command line flag.

### Node renames

The Godot scene system is known for its ease of use and its ability to represent your mental map as a data and file structure. That said, many node names were not clear or confusing. This is mainly evidenced when comparing their 2D and 3D counterparts.

Contrary to what many believe, Godot started as a 3D engine, but soon migrated to be a 2D one. This is why the 3D nodes don't have any suffix (like Area) while the 2D ones do (Area2D). This made it very misleading for users, where its not always obvious whether you are using the 2D or 3D versions.

To solve this, Godot 4.0 will rename all 3D nodes and give them proper suffixes. Nodes like "Area","RigidBody" or "Light" will become "Area3D", "RigidBody3D" and "Light3D" respectively.

Additionally, due to popular demand, the "Spatial" node will be renamed to "Node3D", to further enhance consistency with the 2D engine.



![nodenames.png](/storage/app/uploads/public/5e7/f74/038/5e7f74038bd23290506434.png)


A compatibility system has been added so older scenes will convert the node types to the new ones on load.

### Server renames

Most servers in Godot are very old, and their naming conventions were by now obsolete. Because of this, most are being renamed:

* **VisualServer** (a name that became even more ambiguous thanks to the introduction of DisplayServer) has been renamed to **RenderingServer**.
* **NavigationServer** and **PhysicsServer** have been renamed to **NavigationServer3D** and **PhysicsServer3D** respectively.
* Likewise, to add more consistency, **Physics2DServer** and **Navigation2DServer** are now **PhysicsServer2D** and **NavigationServer2D**.

### Future

My work on core refactoring is mostly done, so next month (April) I will go back to working on Vulkan as promised. Hope to have new and exciting stuff to show by the end of next month!

And as always, please remember than our work on Godot is done out of love for you and the game development community, we want to provide you with a top notch free and open source game engine, so you can own your work down to the last line of engine code. If you are not yet, please consider becoming [our patron](https://www.patreon.com/godotengine) and help us realize this dream sooner.

---
title: "Why does Godot use Servers and RIDs?"
excerpt: "If you ever lurked in Godot source code, and tried to follow the flow of the logic, you most likely noticed that most code related to scene, formats, etc. always ends up in a giant \"server\" class. These really large classes, which Godot calls \"severs\", generally abstract some implementation or architecture."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/57e/85e/895/57e85e89581c7897117696.png
date: 2016-09-24 00:00:00
---

# Servers and RIDs

### Architecture

If you ever lurked in Godot source code, and tried to follow the flow of the logic, you most likely noticed that most code related to scene, formats, etc. always ends up in a giant *server* class. These really large classes, which Godot calls *servers*, generally abstract some implementation or architecture.

No real objects or classes exist but simple references to a *RID* type (that stands for *Resource ID*), and all functions take these objects as their first argument (except those used to create them).

![](/storage/app/media/devlog/dl_image4.png)

This most likely seems really odd to you if you are a programmer, but there is quite an interesting logic behind it all, mainly related to multi-threading.

### Multi-threading

Previous engines we have developed (we as in Juan Linietsky and Ariel Manzur) did not really use this architecture and everything was provided via simple classes with inheritance and polymorphism. 

This was fine, as our engine ran in a single thread (which was common, as most CPU architectures were single-core back then). As multiple core CPUs made it to the mass-market, however, it became obvious that Godot had to go multi-threaded. 

Before going into optimizing for multiple threads, let's first take a look at the typical order of execution of the main blocks of a game engine.

![](/storage/app/media/devlog/image/dl_image5.png)

This order of events can't be escaped, as logic affects physics and rendering needs both information from logic and physics to display.

Research on game engine optimization for multiple threads at the time resulted in documentation and papers for a new technique named *[job scheduling](https://en.wikipedia.org/wiki/Job_scheduler)*. Most popular engines nowadays use this technique and this seems perfectly logical.

The idea behind this technique is not to alter the sequence order, but to make every stage as parallel as possible.
How is this achieved? Rendering, while mostly a sequential process (GPUs are sequential), can be parallelized in a few places, like frustum culling and (in modern APIs such as Vulkan, Metal or DirectX12) creation of command lists.

For Physics, it's a bit more difficult. Physics engines divide their work per frame in the following stages: 

* Force Integration: Compute gravity and external forces and apply them to velocity
* Broad Phase: Finding pairs of close objects
* Near Phase: Generating collision information of overlapping objects
* Solver: Iterative or LCP approximation to collision resolution
* Velocity Integration: Move the objects 

Of those, mainly the near phase and the solver steps can be highly parallelized. Physics engines do this via the creation of *islands*, which are standalone group of objects that don't interact with other groups. This allows to process them in parallel.

If we put all together, rendering a frame with multiple threads, splitting in jobs, becomes something like this:

![](/storage/app/media/devlog/image/dl_image7.png)


### A different parallelism

Implementing a job system in Godot was too challenging, unfortunately. While for high-end game engines this makes sense, usability would end up severely affected. As Godot aims to be an easy to use engine, users would have too many challenges with a system like this:

* It would be too easy for users to step on a piece of code that is currently being modified in a separate thread, resulting in crashes or undefined behaviors.
* To avoid this, locking would have to be put all over the place. This would make code more complex, and likely still impact performance due to waiting for mutexes or semaphores.
* Sync points would help, but it offloads more complexity to the user. For custom engines in large games this can be a benefit, but for us it impacts usability.


All this led to a question: How can we make Godot multi-threaded but keep it easy to use?

The answer to this puzzle lies in understanding the following facts:

* Logic sets information into Physics, but it does not need to retrieve data from it.
* Both Logic and Physics set information into Rendering. Neither need to retrieve data.
* Rendering alone has all the information it needs to display a frame and no one needs to wait for it.
* Physics needs to set back information (bodies that moved and collisions) into the logic layer, but this can be done anytime before the next frame.


If we put everything together, it becomes obvious that all 3 tasks can run in parallel:

1. Physics syncs information from the previous fixed frame to Logic
2. Logic runs the fixed step, syncs back with Physics and then goes on to do the regular step while Physics starts working.
3. Physics pushes data to Rendering.
4. Rendering completes whathever it was doing from the previous frame, syncs (swaps buffers), then takes the info from Logic and starts working on the new frame.

This results in multi-threading, in a way that is transparent to the programmer:

![](/storage/app/media/devlog/image/dl_image6.png)

Basically, the concept of "frame time" (doing everything in less that 1/60 seconds), no longer exists with this approach. Logic, Physics and Rendering have the whole frame time for themselves, and they don't run in sync (i.e. Rendering will process the frame "later", and both Logic and Physics will process their frame at the same time and only spend a bit syncing).
 
This sounds great in theory, but in implementation it's chaos. It means both Physics and Rendering must receive commands, and that commands need to be buffered somehow. With traditional OOP and C++ this is a recipe for spaghetti code. Passing around objects that may not execute functions when you call them is weird.


### Servers

To make this easier, we came up with the concept of *Servers*. They are called like this because of their requirements:

* An entity that contains all the information and state, does the processing and returns the results.
* It runs in parallel, it could be in the same device or even in a remote device.
* The user has no direct access to it.
* All communication is done via commands sent on a single channel.

It's clearly a server pattern!

As this is a command-oriented API, it is exposed via a single class representing the Server. Remote objects are represented with RIDs.

Servers work very well in Godot, and even allow for some extra goodies:

* Background loading and information processing on threads works great (e.g. generating terrain), because each thread can create content, then register it via a single channel.
* It's easy to tell when something has changed by just checking the command data. This allows Godot behaviours such as not redrawing the editor screen if nothing changed.
* Switching between single and multi-threaded server is easy, as it just requires an adapter server that provides the command buffering.


### Future

For Godot 3.0 we are working on improving some aspect of servers. The main one is optimizing RIDs, which will now also cache an opaque pointer to the objects used. Before this, objects had to be looked up internally in a hash table.

The advantage of this is higher performance, while the obvious drawback is that the game can crash on release and less information will be provided. To avoid this, always check the errors reported in debug builds!
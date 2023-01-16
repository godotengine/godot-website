---
title: "Core refactoring progress report #1"
excerpt: "Expecting a Vulkan progress report? Not this month! As Godot 3.2 was released by the end of January, February was purely dedicated to do large core refactoring in preparation for Godot 4.0. This is required to unblock other contributors and their areas."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5e5/a98/38e/5e5a9838e6a8b964298813.png
date: 2020-02-29 00:00:00
---

Expecting a Vulkan progress report? Not this month! As Godot 3.2 was released by the end of January, February was purely dedicated to do large core refactoring in preparation for Godot 4.0. This is required to unblock other contributors and their areas.

### Core refactoring?

Godot 3.0 was released more than two years ago. With it, the amount of Godot users kept growing quickly and steadily. While a lot of core changes happened in 3.0, we were far from doing everything we wanted because it would have taken forever. With the upcoming Godot 4.0, opportunity has arisen yet again to do improvements and refactoring to Godot core.

Following is the list of changes made so far during February:

#### Refactored ObjectID and Variant

This is mostly an internal change that most users won't see outright but, besides improving performance considerably, it allows to fix a design flaw in Godot 3.0, where it was not always possible tell if an object instance was freed or not, resulting in bugs that could not be fixed. This is no longer a problem in the 4.x branch. After it gets some testing, it may get cherry-picked for 3.x branch.


#### Removed PoolArrays (PoolVector in C++), replaced by PackedArrays

Godot offered PoolArray as a type of variable, which was useful for storing large arrays in a compact way. They were designed for 32 bits CPUs with small address space, to allow packing memory and avoiding memory fragmentation.

Given pretty much all mainstream platforms are now 64 bits, this optimization is no longer required (64 bits operating systems have efficient memory allocation for large objects, putting them on opposite ends of the address space, which reduces memory fragmentation to the point of making it not a problem).

Having tightly packed arrays available to the user still makes sense, because regular script array ([]) elements are 24 bytes (containing a Variant). Having packed versions (including bytes) is desired, so they are renamed to "PackedArrays".

This change also improves performance in all operations related to large memory allocations, as locking/unlocking is no longer required. As a side effect, put_pixel/get_pixel in images no longer requires locking either.

#### Reworked signal system to use Callables

Godot now has a Callable type. This allows having a generic interface for calling things from an object. Within GDScript (and C#, as well as other languages) this means more efficiently connecting signals to methods via first class function support (which was not available before) and eventually Lambda expression support on the API for all languages. Signals are also provided as a type, so this type of syntax became valid:

![firtclass.png](/storage/app/uploads/public/5e5/a92/06e/5e5a9206e8437287746735.png)

Besides this, this change allows to improve the internal C++ binding system, taking advantage of C++17 variadic argument templates to do all internal signal connections, without having to register them via ClassDB. It will also help improve usability and performance of C++ via GDNative.

#### Support for named binds in Skin.

Skin system was added in Godot 3.2, but it lacked named binds. This avoided you from merging objects with similar skeletons together (as an example, clothing exported as a separate scene to use for customizing a character).

Named binds ensure that, as long as the bone name exists, the mesh will be able to bind to it. This improvement may eventually be cherry picked to Godot 3.x branch too.

This is not strictly a core change, but was requested by users due to the limitations of the new system.

#### Support for StringNames in binding system.

A lot of APIs in Godot use StringNames instead of Strings. StringNames are special types that contain a unique pointer to a string. When assigned a String, the pointer is always assumed to be the same for that string (no matter when it was assigned), ensuring comparisons are much faster than actual string comparisons (because it's just a pointer comparison).

There are plenty of APIs in Godot that do this for efficiency, like names, method names, property names, class names, animation names, shader parameter names, skeleton bone names, translations keys, etc (the list is very long actually).

Unfortunately GDScript and the binder (for C# and other languages) did not support this type, and all these functions received regular strings, which where very inefficiently converted to StringNames on each call.

With this change, users can pass StringNames directly to the Godot API and improve performance in critical areas.

#### Support for integer vector types

This was a widely requested feature by our users, specially for GDScript. It's useful for games which require cell based integer vector logic in 2D and 3D. Using floats for vector types in these types of games was wasteful and prone to error.

The following new types were added:

![intttypes.png](/storage/app/uploads/public/5e5/a94/3b8/5e5a943b8cb8f883026432.png)

#### Packed arrays are now references in GDScript

Users often complained that PoolArrays were immutable types, so accessing them inside sub-arrays, dictionaries, etc. or passing them to/from functions would always create copies.

In the 4.x branch, besides no longer being pool based, they became references.

#### Packed float and int arrays support 64 bit versions

GDScript uses 64 bits for scalar float and integer, but packed arrays are only 32 bits. Many users requested 64 bits to store more data, so these versions were optionally added.

#### Refactored threaded resource loading

Godot had the old "ResourceInteractiveLoader" class for background loading. This was a vestige from an era where Godot ran mainly on single core devices. While the engine supported loading resources on threads for a long time, the actual loading process (including dependencies) was single threaded.

This is no longer the case in the 4.x branch. The [new API](https://github.com/godotengine/godot/pull/36640) is much simpler to use and can take advantage of as many cores as available by your CPU to do resource loading. This results in 4x to 6x performance increases, and in considerably improves the usability for background loading.

## Future

March will probably be another for core refactoring, and my Vulkan work will resume in April. The main goal for this month is to perform the separation of OS class into OS and DisplayServer. This will allow several things to happen:

* Support for multiple windows (Editor support may or may not happen for 4.0, depending on time).
* Implementation of Wayland and Linux+EGL (needed for official Raspberry PI support) back-ends.
* General clean up of the API, which is messy.

As always, all this work is is done out of love for everybody making games, and because we believe the world needs quality free and open source game technology. If you are not yet, please help us by [becoming our patron](https://www.patreon.com/godotengine).

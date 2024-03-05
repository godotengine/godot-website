---
title: "Godot 3.0 new internals, progress report #4"
excerpt: "Most of the internal code in Godot was written over a decade ago, and many design decisions that were taken back then, did not stand the test of time. January was spent mostly updating Godot internals and breaking compatibility, now that we have the chance."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/589/720/444/5897204442764550068699.png
date: 2017-02-04 00:00:00
---

First of all, apologies for not being able to show flashy stuff this month! January was spent mostly updating Godot internals and breaking compatibility, now that we have the chance.

Most of the internal code in Godot was written over a decade ago, and many design decisions that were taken back then, did not stand the test of time. Nothing serious in general, just stuff that was either incorrect or overdesigned.

The result of this work has been mostly a lot of simplification in the internals, resulting in more performance and more readable code.

We also took the chance to rewrite key parts of Godot, which were considerably overdesigned (and dated), such as the audio engine, and the import framework.


## Big merge

While the 3.0 work was carried in the *gles3* branch, Rémi Verschelde and other main devs kept working on the *master* branch, cleaning up the repo and reorganizing third party libraries into a more maintainable form.

At the begining of January, the *gles3* branch was merged to *master*, which resulted in a pretty unusable repository.

This signalled the start of the process where all features that could not be implemented in previous versions, due to requiring breaking compatibility, could finally be implemented.


## Internal changes

##### New memory management architecture

All the internal memory management code in Godot was rewritten. This resulted in much simpler code and hopefully more performance.

##### Better locking

Godot now implements readers-writers locks in many places, improving locking times when accessing some global data from multiple threads.

##### Local resources

Resources can now be marked as local to the scene. This allows for simplifying some behaviors, such as using a Viewport directly as a texture in a Sprite, or creating button groups without a special control.

##### Fixed rotation angles

Godot used rotations in XY instead of YX. Thanks to the great work of Fernc Arn/tagcup, all Godot math classes and functions should now be mathematically correct.

##### Made signal names more consistent

Signals are now always in past tense (*e.g.* `mouse_exited`) to indicate an event just happened, or as verbs when an action is expected (*e.g.* `_draw`).


## GDScript

##### Scalars are 64-bits.

This means that doing scalar integer math in GDScript, as well as storing these values to files, is fully 64 bits. Both integer and float types.

Support is also in progress (by Ferenc Arn/tagcup) to compile Godot using doubles for all math datatypes and functions. This is useful in case of desiring to create very large world without resorting to hacks such as moving the origin (at the cost of some performance).

##### Arrays are now always shareable

It was previously possible to declare arrays as atomic in GDScript, as in, copies did not keep the data shared. This resulted in several difficult to trace bugs. As a result, this functionality was removed.

##### Pool arrays

Godot always supported these types, but their use was confusing due to their name (ByteArray, IntArray, etc)..

These are now called "Pool Arrays". It means they use memory from the memory pool, which makes them safer to allocate large amounts of memory without causing fragmentation.

##### Renamed many math types

Many math types were also renamed to have more consistent naming.

![](/storage/app/media/devlog/progress4/progress4-10.jpg)

##### Dictionary keeps insertion order

Dictionaries now remember the insertion order. When the list of keys is requested, or dictionaries are iterated, the order should always be the same. This helps make code more deterministic and avoids VCS inconsistencies in saved files.

![](/storage/app/media/devlog/progress4/progress4-9.jpg)

#### Automatically enabled callbacks

Common Godot callbacks such as `_process`, `_input`, etc. required a funtion to enable them.

From Godot 3.0, if a callback is detected in the code, it is enabled automatically. Disabling it manually is still possible.

Additionally, some of the callbacks were renamed (*e.g.* `_input_event` became `_gui_input`).

##### Property access as default

Most of Godot's API was exposed to GDScript as functions. This made browsing the doc and using some data somewhat cumbersome.

In Godot 3.0, most API access is done via properties:

![](/storage/app/media/devlog/progress4/progress-4-4.jpg)

This simplifies code a lot, as well as making the documentation easier to read.

![](/storage/app/media/devlog/progress4/progress-4-5.jpg)

##### Syntax sugar for get_node()

A simple syntax sugar was added for `get_node()`, a very commonly used function in Godot. This is done via the `$` operator:

![](/storage/app/media/devlog/progress4/progress4-6.jpg)

Together with the property accessor, makes GDScript look pretty different now...

![](/storage/app/media/devlog/progress4/progress4-7.jpg)

##### _ready() is called only once.

A common complaint from users is that `_ready()` was called again when a node is re-inserted into the scene after being removed.

By default, this callback is called only the first time. If you need it again, it can be requested with `request_ready()`.


## File formats

##### Filetype deprecation

XML file format was removed in Godot 3.0. The TRES/TSCN formats are faster, more readable and more VCS friendly.

The venerable `engine.cfg` was renamed to `godot.cfg`. This new configuration file uses the same text serialization as .tres/.tscn, and is also versioned (so we can break compatibility more easily in future versions).

##### Better JSON parsing in GDScript

A very requested feature, now JSON supports parsing into any datatype (not just dictionaries), as new built-in functions were added to GDScript to handle it.


## GUI

##### Ratio anchoring removed

Ratio anchoring was removed in controls. It was deprecated a long time ago since Godot added container support, but it could not be removed due to fear of breaking compatibility.

##### Better handling of Stop/Ignore mouse in controls

This area was pretty confusing in Godot 2.x, so the whole amount of options was moved to a single enum. Additionally, Drag&Drop now support these too.

##### Opacity / self opacity removed

Controls (and 2D nodes) now have `modulate` and `self_modulate` properties, which both change the opacity and the color of control and branch.

![](/storage/app/media/devlog/progress4/progress4-8.jpg)


## Editor

##### Settings are better categorized

This is another area where breaking compatibility helped a lot. Both Editor and Project settings are now cleaner and better organized:

![](/storage/app/media/devlog/progress4/progress4-1.jpg)

##### Named layers

Physics, 2D and 3D layers can now be assigned names.

![](/storage/app/media/devlog/progress4/progress4-2.jpg)

##### Better project settings editing

Project settings window was confusing because of the double checkboxes (one for persist and another for option value). This was removed in favor of a "revert" button.

![](/storage/app/media/devlog/progress4/progress4-3.jpg)


## New audio engine

As 3.0 is _the_ compatibility breaking release, we took the chance to rewrite the audio engine too.

##### Only streams

Godot 2.x used a separate concept for _Samples_ and _Streams_. Godot 3.0 simplifies the audio engine enormously by just supporting streams. Streams can be either .ogg or .wav depending on your needs, which are usually:

* .ogg files are small in both disk and memory, but expensive to reproduce and very expensive to resample (change pitch).
* .wav files as PCM take up a lot of disk and RAM, but are cheap to reproduce (in the hundreds simuntaneous streams), can be seeked and played in reverse.
* .wav files as IMA-ADPCM are in the middle of .ogg and PCM: they take up to 4 times less space than PCM, are also cheap to reproduce, but cannot be seeked.

##### Playback

Only 3 nodes are needed to play back audio:

* AudioPlayer, which is a generic player.
* AudioSource, which works for 3D positional audio.
* AudioSource2D, which is the same but for 2D.

##### Buses

The new audio engine has buses. Nodes that play back audio can choose which buses to send audio to.

![](/storage/app/media/devlog/progress4/progress4-11.jpg)

##### Built-in effects

Godot 3.0 also comes with a large library of built-in effects which can be assigned to each bus. As there is not much open source audio code with a MIT compatible license we could re-use, these were written specially for Godot (and sounds great!).

![](/storage/app/media/devlog/progress4/progress4-12.jpg)


## New import system

One common complaint from Godot users is that many asset types need to be imported in order to be used, or in order to change certain types of flags.

For this, they have to be kept outside the project folder, but close enough to be referenced by the import versions.

##### Automatic import

Godot 3.0 simplifies this process a lot, by performing automatic import. Original assets are placed directly in the project folder (*e.g.* .dae scenes, images, etc.), and Godot will perform an internal and automatic import.

Users, then, can still refer to the original assets as if they were the actual resources (while the generated, imported resources are placed in a `res://.import` shadow dir). At export time, the original assets are removed and replaced by the imported versions.

![](/storage/app/media/devlog/progress4/progress4-13.jpg)

##### Import dock

Even though import is automatic, it's still possible to specify large amount of options per asset, and re-import. This is done via the new Import dock.

![](/storage/app/media/devlog/progress4/progress4-14.jpg)

## Future

With this, the large bulk of changes required for breaking compatibility are mostly complete. Next months will be focused in closing the remaining renderer features and stabilizing Godot for an alpha release.

## Seeing the code

If you are interested in seeing what each feature looks like in the code, you can check the [master](https://github.com/godotengine/godot/commits/master) branch on GitHub.

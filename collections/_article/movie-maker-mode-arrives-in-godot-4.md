---
title: "Movie Maker mode arrives in Godot 4.0"
excerpt: "With the addition of non-real-time video recording, Godot opens itself to new use cases such as architecture visualization and cutscene rendering."
categories: ["progress-report"]
author: Hugo Locurcio
image: /storage/app/uploads/public/636/942/fed/636942feda67c584924051.png
date: 2022-11-14 16:00:00
---

The idea of using a game engine for projects other than creating video games is not new. For decades, game engines have been used to create applications, simulations and more. However, with the ever-increasing visual fidelity of their rendering engines, game engines have grown in popularity for situations that demand high-end visuals. These use cases include architecture visualization, cinema, animation and cutscene rendering.

With the addition of non-real-time video recording, Godot opens itself to these new use cases.

### What is Movie Maker mode for?

Godot can record non-real-time video and audio from any 2D or 3D project. There are many scenarios where this is useful:

- Recording game trailers for promotional use.
- Recording cutscenes that will be displayed as pre-recorded videos in the final game. This allows for using higher quality settings (at the cost of file size), regardless of the player's hardware.
- Recording procedurally generated animations or motion design. User interaction remains possible during video recording, and audio can be included as well (although you won't be able to hear it while the video is recording).
- Comparing the visual output of graphics settings, shaders, or rendering techniques in an animated scene.

With Godot's animation features such as the AnimationPlayer node, Tweeners, particles and shaders, it can effectively be used to create any kind of 2D and 3D animations (and still images).

If you are already used to Godot's workflow, you may find yourself more productive by using Godot for video rendering compared to [Blender](https://www.blender.org/). That said, renderers designed for non-real-time usage such as Cycles and Eevee can result in better visuals (at the cost of longer rendering times).

Compared to real-time video recording with tools such as [OBS Studio](https://obsproject.com/) or [SimpleScreenRecorder](https://www.maartenbaert.be/simplescreenrecorder/), some advantages of non-real-time recording include:

- Use any graphics settings (including extremely demanding settings) regardless of your hardware's capabilities. The output video will always have perfect frame pacing; it will never exhibit dropped frames or stuttering. Faster hardware will allow you to render a given animation in less time, but the visual output remains identical.
- Render at a higher framerate than the video's target framerate, then post-process to generate high-quality motion blur. This also makes effects that converge over several frames (such as temporal antialiasing, SDFGI and volumetric fog) look better.

### What is Movie Maker mode NOT for?

Movie Maker mode is not designed for capturing real-time footage during gameplay.

Players should use something like [OBS Studio](https://obsproject.com/) or [SimpleScreenRecorder](https://www.maartenbaert.be/simplescreenrecorder/) to record gameplay videos, as they do a much better job at intercepting the compositor than Godot can do using Vulkan or OpenGL natively.

That said, if your game runs at near-real-time speeds when capturing, you can still use this feature (but it will lack audible sound playback, as sound is saved directly to the video file).

### Example output

https://www.youtube.com/watch?v=e047PL2KyP4

<iframe width="560" height="315" src="https://www.youtube.com/embed/e047PL2KyP4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


### Using Movie Maker mode

Complete documentation on using this new Movie Maker functionality can be found in the [Creating movies](https://docs.godotengine.org/en/latest/tutorials/animation/creating_movies.html) page of the Godot documentation.

Also check out the new [Playing videos](https://docs.godotengine.org/en/latest/tutorials/animation/playing_videos.html) page in the documentation, in case you want to play the videos you've recorded using Godot in a project.

### Technical implementation

Movie Maker works with the following components:

- A class that inherits from the [MovieWriter](https://docs.godotengine.org/en/latest/classes/class_moviewriter.html) abstract class. This allows custom output formats to be implemented with [GDExtension](https://godotengine.org/article/introducing-gd-extensions). For example, GDExtension could be used to implement a [FFmpeg](https://ffmpeg.org/) pipe with Movie Maker mode.
- A special-purpose audio driver, which is automatically enabled when using Movie Maker mode. This audio driver is designed to capture the game's audio output to a buffer, which can then be written to a file (such as an AVI video's audio channel or a WAV file).
- Non-real-time simulation, which is enabled using the `--fixed-fps <fps>` command line argument. This makes the engine simulate gameplay as fast as possible, with `delta` always having the same value (regardless of how long it took to render the frame). This feature has been available since Godot 3.0, but Movie Maker automatically makes use of this feature to ensure consistent frame pacing.
- [Image's new `save_jpg()` function](https://docs.godotengine.org/en/latest/classes/class_image.html#class-image-method-save-jpg), which was added as Movie Maker requires it for MJPEG recording. This complements the existing `save_png()` function, which is used when recording to PNG + WAV.
- Core modifications to allow enabling Movie Maker mode with a command line argument (which is passed by the editor when running the project with Movie Maker mode enabled).

The built-in supported output formats are MJPEG (within an AVI container) and PNG image sequence + WAV file. See [Choosing an output format](https://docs.godotengine.org/en/latest/tutorials/animation/creating_movies.html#choosing-an-output-format) in the documentation for the upsides and downsides of each format.

### References

- [Original pull request](https://github.com/godotengine/godot/pull/62122)
- Follow-up pull requests to improve usability: [#62414](https://github.com/godotengine/godot/pull/62414), [#62415](https://github.com/godotengine/godot/pull/62415), [#67104](https://github.com/godotengine/godot/pull/67104)

### Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, and a handful of part or full-time developers, hired thanks to [donations from the Godot community](https://godotengine.org/donate). A big thankyou to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so on [Patreon](https://www.patreon.com/godotengine) or [PayPal](https://godotengine.org/donate).

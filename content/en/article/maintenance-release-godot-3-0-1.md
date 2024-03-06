---
title: "Maintenance release: Godot 3.0.1"
excerpt: "We are pretty happy with the overall stability of Godot 3.0, that we released in late January. Still, we want to provide the best level of support to our users, so we are going to make regular maintenance releases for the 3.0 branch, to bring backward-compatible bug fixes and enhancements to all users. Our aim is that you should be able to just upgrade to 3.0.1 and continue developing your 3.0 projects without any change (apart from C# support, which is still in alpha and thus a moving target).

Check the detailed release notes to see what's new in Godot 3.0.1, and what bugs have been fixed."
categories: ["release"]
author: HP van Braam
image: /storage/app/uploads/public/5a9/2f7/557/5a92f75575e65533435326.jpg
date: 2018-02-25 20:59:56
---

Since we haven't found any major issues in [our release candidate]({{% ref "article/dev-snapshot-godot-3-0-1-rc1" %}}), we are now releasing Godot 3.0.1! The only regression reported was a renaming issue on Windows which we fixed.

If you were eagerly waiting for 3.0.1, you can go directly to our [Download]({{% ref "download" %}}) page and get the benefits of all the fixes! Both the [itch.io](https://godotengine.itch.io/godot) and [Steam](https://store.steampowered.com/app/404790) distributions are updated.

We have added many new features to the editor (and several to GDScript) in this release which we think will make your use of Godot even better. We've also fixed several nagging issues and generally put together a really nice update for our users of the stable branch. Please note that this is not the much-expected 3.1 release, so OpenGL ES 2.0 is not yet supported. Adding GLES2 support will necessitate some breakage for existing projects, so we will not merge that in this series of stable releases.

Sadly C# export templates weren't finished for this release. Preliminary support has landed in master in [this commit](https://github.com/godotengine/godot/pull/16920), but a little more work and broad testing are required before we can release this for general consumption. We've decided that holding back all of these important fixes and little niceties in the editor to have C# exporting in a release called '3.0.1' wasn't worth the wait. Please note that us releasing 3.0.1 now doesn't mean that C# exporting has been delayed. When C# exporting is ready we will release a new stable patch immediately. This way all our users get the best possible experience while our C# users won't get export capability any later than they otherwise would have.

I'd like to thank all of our wonderful contributers for making 3.0.1 possible. I'd also like to thank the people who took the time to test the release candidate and report back to us. Now back to waiting for 3.0.2!

## What's new in this release

Here are some of the highlights of this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.1/Godot_v3.0.1-stable_changelog.txt) for details.

* The 'server' platform is back as it was in Godot 2.1. It is now again possible to run a headless Godot on Linux.
* Godot can now be started with `--build-solutions` on the command line. This will let you build C# solutions without starting the editor. This is helpful for CI pipelines.
* Another new CLI option is `--quit` which will quit the engine after the first main loop iteration. This is also helpful for CI pipelines.
* It is now possible to scale an .obj mesh when importing.
* Type icons are back! If you missed them you can enable them in the editor settings.
* Several new GLSL built-in functions are exposed to the shader language : `radians` `degrees` `asinh` `acosh` `atanh` `exp2` `log2` `roundEven`.
* It is now possible to center your game window with `OS.center_window()`.
* You can set the `tcp_nodelay` flag on a StreamPeerTCP with the `set_no_delay` method.
* For EditorPlugins, it is possible to remove a control from a container with the new `remove_control_from_container()` method.
* A button has been added to the debugger to copy the error messages, useful for pasting them in bug reports or other community platforms.
* The <kbd>Ctrl</kbd> toggles snapping in the 3D viewport.
* Support has been added for a new `.escn`, similar to `.tscn`, but meant to be converted to a binary `.scn` on import (for use with the work-in-progress [Blender exporter](https://github.com/godotengine/blender-exporter)).
* CA certificates have been updated to the latest Mozilla bundle.
* And many more.

## Fixed issues

Here are some of the more visible bugs fixed in this release. See the [full changelog](http://downloads.tuxfamily.org/godotengine/3.0.1/Godot_v3.0.1-stable_changelog.txt) for details.

* Copy/pasting from the editor on X11 will now work more reliably.
* The lightmap baker will now use all available cores on Windows like it does on macOS and Linux.
* Fixed missing text in some FileDialog buttons.
* Fixes to HTTP requests on the HTML5 platform.
* Many, many fixes and improvements to C# support (including a `[Signal]` attribute).
* Static linking of libgcc_s as well as libstdc++ to allow more portability for Linux Godot templates between older and newer distributions.
* Fix broken APK expansion on Android.
* Several crashes in the editor have been fixed.
* Many documentation fixes.
* Several hiDPI fixes.
* And many more.

## Known incompatibilites with Godot 3.0

* If you use the Bullet physics engine and relied on the fact that the calculated effective gravity on KinematicBodies was always '0' then you will need to fix your code as this is now correctly calculated. See [#15554](https://github.com/godotengine/godot/issues/15554) for details.
* Setting the `v` member of a color did not properly set the `s` member. This is now corrected. See [#16916](https://github.com/godotengine/godot/pull/16916) for details.
* RichTextLabels did not properly determine the baseline of all fonts. If you relied on the look of the previous implementation please let us know. See [#15711](https://github.com/godotengine/godot/pull/15711) for details.
* SpinBoxes didn't calculate their width properly. This is now fixed but could subtly change your GUI layout. See [#16432](https://github.com/godotengine/godot/pull/16432) for details.
* OGG streams now correctly signal the end of playback. If you were relying on this not happening please let us know. See [#15910](https://github.com/godotengine/godot/pull/15910) for details.
* **C# assemblies built with Godot 3.0 won't be compatible with 3.0.1**, and the editor will crash while trying to load old assemblies. Make sure to **delete the `.mono` folder in your project folder** to force a new build (this workflow will be improved in future releases). This version still requires the Mono SDK at **version 5.4** (latest being 5.4.1.7). Older and newer branches are not compatible.

## <a id="known-bugs"></a> Known bugs in Godot 3.0.1

* `Vector3.snapped()` does not work and just returns the original Vector3. Fixing this would have meant breaking ABI between Godot 3.0 and 3.0.1 so this function will remain non-functional.
* The editor fails to auto-complete enums from autoloaded external scripts. This will be fixed in 3.0.2. See [#17025](https://github.com/godotengine/godot/issues/17025) for details. This issue is annoying but largely cosmetic as it doesn't affect running your project.
* Running an individual scene from a project without a main scene defined does not work. This will be fixed in 3.0.2. See [#17028](https://github.com/godotengine/godot/issues/17028) for details. As a workaround please set any scene as a main scene and you can run individual scenes like normal.
* Moving objects around using C# has regressed since 3.0. This will be fixed for 3.0.2. See [#16937](https://github.com/godotengine/godot/issues/16937) for details.
* TextureProgress causes a bad polygon error when the progress percentage is between 62 and 99. This then causes it to disappear. We will fix this for 3.0.2. See [#17102](https://github.com/godotengine/godot/issues/17102) for details.
* RichTextEdit doesn't properly calculate the height of the first line when wrapping text. We will fix this for 3.0.2. See [#17139](https://github.com/godotengine/godot/issues/17139) for details.

## Future releases

To make things clear as many users seem confused about it, we currently support two stable branches (2.1 and 3.0), and the feature development happens on the `master` branch which will become the `3.1` stable branch once its planned features are ready (especially OpenGL ES 2.0 support).

That means that our next releases will be (not in a chronological order):

- 2.1.5: We released a [Beta 1 build]({{% ref "article/dev-snapshot-godot-2-1-5-beta-1" %}}) a week ago. A Beta 2 build will come in the following days to address the main shortcomings reported in the first beta. The 2.1 branch will be supported until the 3.1 release, so at least a few months more, and afterwards with security fixes for games in production.
- 3.0.2: More backward-compatible bug fixes and enhancements to the current stable branch. C# support is still in alpha so backward-incompatible improvements are still allowed in this branch (and will happen).
- 3.1: As soon as the OpenGL ES 2.0 renderer is finalized, we will work on stabilizing the new features and release 3.1-stable.

Have fun with 3.0.1 in the meantime!

## Help make Godot better!

You can greatly help us improve Godot, as well as make it faster and better. Besides contributing code (if you are a programmer), you can help us a lot by [becoming our patron](https://www.patreon.com/godotengine). We still need a last push to reach our third goal and hire Rémi ([Akien](https://github.com/akien-mga)) full-time as project manager and representative!

Additionally, spreading the word will always benefit us, as most game developers still have never tried (or even heard of) Godot. Finally, the best contribution might be to use Godot to develop and publish awesome games!

*The [illustration picture](https://twitter.com/yafd/status/948271213868019712) is courtesy of John Watson ([@yafd](https://twitter.com/yafd)), who does nice PBR scenes using the new features of Godot 3.0.*

---
title: "GSoC 2022 - Progress report #1"
excerpt: "This year we have 3 students working on exciting projects as part of the Google Summer of Code. In this progress report they present their work on refactoring the ColorPicker and its UX, making code editors detachable from the main editor window, and improving the GPU lightmapper."
categories: ["progress-report"]
author: Rémi Verschelde
image: /storage/app/uploads/public/62f/3c8/fac/62f3c8fac0406080699461.png
date: 2022-08-10 15:05:19
---

Like in previous years, Godot is participating again in the [Google Summer of Code](https://summerofcode.withgoogle.com/) program for its 2022 edition.

This year we selected 3 projects, and the 3 students and their mentors have now been working on their projects for two months. We asked them to write a progress report to present what they're working on and the current status.

Here are the 3 projects/students with links to the relevant sections in this post:

- [Refactor and UX updates of ColorPicker](#colorpicker) by Vitika Soni ([Vitika9](https://github.com/Vitika9))
- [Multi window code editors](#multiwindow) by [trollodel](https://github.com/trollodel)
- [GPU lightmapper enhancements](#gpu-lightmapper) by Priyansh Rathi ([techiepriyansh](https://github.com/techiepriyansh))

They've all been doing outstanding work so far, and we're looking forward to integrating all those changes in the engine!

---

<a id="colorpicker"></a>
## Refactor and UX updates of ColorPicker

* Project: Refactor and UX updates of ColorPicker
* Student: Vitika Soni ([Vitika9](https://github.com/Vitika9))
* Mentors: Rémi Verschelde ([akien-mga](https://github.com/akien-mga)) and Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi))
* Branches: [`Vitika9/gsoc-colorpicker`](https://github.com/Vitika9/godot/tree/gsoc-colorpicker), [`Vitika9/gsoc-colorpicker-ux`](https://github.com/Vitika9/godot/tree/gsoc-colorpicker-ux)
* PRs: [#62075](https://github.com/godotengine/godot/pull/62075), [#62910](https://github.com/godotengine/godot/pull/62910)

### Project description
 
RGB, HSV and Raw modes of `ColorPicker` were never properly separated, resulting in lots of messy code like this:

```c++
if (hsv_mode_enabled) {
	set_raw_mode(false);
	btn_raw->set_disabled(true);
} else if (raw_mode_enabled) {
	set_hsv_mode(false);
	btn_hsv->set_disabled(true);
} else {
	btn_raw->set_disabled(false);
	btn_hsv->set_disabled(false);
}
```

With OKHSL mode added in [#59786](https://github.com/godotengine/godot/pull/59786), it was necessary to refactor `ColorPicker` to make color modes more maintainable and easier to add, which is covered in this project along with updating its UX.

This part of the project was complemented and merged in [#62075](https://github.com/godotengine/godot/pull/62075).

### Separation of color modes

With the guidance of my mentors, I worked on reimplementing color modes with an object-oriented approach by making separate classes for each color mode like `ColorModeRGB`, `ColorModeHSV`, etc. and made them inherit from newly made `ColorMode` abstract class. `ColorMode` has the following methods which get called on the selected instance by `ColorPicker`:

- `get_name()`
- `get_slider_count()` (useful if we add CMYK in future)
- `get_slider_step()`
- `get_slider_label(idx)`
- `get_slider_max(idx)`
- `get_slider_value(idx)` (getting the slider value from color)
- `get_color()` (getting the color value from sliders)
- `slider_draw(which)` (function for slider's `draw` signal)
- `apply_theme()`
- `get_shape_override()` (useful for `ColorModeOKHSL` as it needs OKHSL circle as picker shape)

### UX updates

Next to this C++ refactoring, I have been working on improving the UX of ColorPicker. I am taking reference from wireframes provided by Taylor Wright ([redlamp](https://github.com/redlamp)) which can be found [in godot-proposals#4353](https://github.com/godotengine/godot-proposals/issues/4353#issuecomment-1098934700) and trying to follow this design as close as possible. Below are the changes which I have made so far:

| Before | Mode selection | Shape selection  | Preset dragging | Recent presets | Uncolorized sliders |
|-----|-----|------|-------|------|------|
|<img width="166" alt="image" src="/storage/app/media/gsoc/2022-1/colorpicker-before.png">| <img width="155" alt="image" src="/storage/app/media/gsoc/2022-1/colorpicker-mode-selection.png">|<img width="155" alt="image" src="/storage/app/media/gsoc/2022-1/colorpicker-shape-selection.png">|<img width="153" alt="image" src="/storage/app/media/gsoc/2022-1/colorpicker-preset-dragging.png">|<img width="154" alt="image" src="/storage/app/media/gsoc/2022-1/colorpicker-recent-presets.png">|<img width="156" alt="image" src="/storage/app/media/gsoc/2022-1/colorpicker-uncolorized-sliders.png">|

This part of the project is still a work-in-progress, check [#62910](https://github.com/godotengine/godot/pull/62910) for details.

### What's next

Firstly, I will complete the UX part, then the next goal is to reimplement picker shapes with the same approach as color modes without breaking anything. Also, there are some bugs to be fixed.


<a id="multiwindow"></a>
## Multi window code editors

* Project: Allow undocking the Script editor and the Shader editor 
* Student: [trollodel](https://github.com/trollodel)
* Mentors: Hugo Locurcio ([Calinou](https://github.com/Calinou)), Michael Alexsander ([Yeldham](https://github.com/YeldhamDev))
* Branch: [`trollodel/gsoc_2022_multiwindow`](https://github.com/trollodel/godot/tree/gsoc_2022_multiwindow)
* PR: [#62378](https://github.com/godotengine/godot/pull/62378)

### Introduction

Undocking parts of the Godot editor UI is something quite desired in the community. For things like the Script editor, this means you can move it to another screen, move the undocked window to be side-by-side with the main window, or just using <kbd>Alt+Tab</kbd> to change between the main window and the undocked one. 

In this project, I'll focus to make the Script editor and the Shader editor undockable, and keep the undocked windows after editor restarts.

### Current progress

Detaching the Script editor and the Shader editor is done for the most part. Let me show a video demonstration of it.

<video controls muted>
  <source src="/storage/app/media/gsoc/2022-1/multiwindow-showcase.mp4" type="video/mp4">
</video>

Along with the basic feature and controls, some integrations were done:

- When the Script editor is undocked, the last selected Viewport is shown.
- When the Script button is clicked and the Script editor is undocked, the Script editor window is focused.
- Undocking the code editors can be done using shortcuts and command palette too.
  
![Command palette](/storage/app/media/gsoc/2022-1/multiwindow-command-palette.png)

#### Window save and restore

Undocking the Script editor (or the Shader editor) on every editor restart and placing it in the second screen can be annoying. For this reason, the window positions, sizes, and other information for the code editors are saved when saving the editor layout and restored when the editor is reopened.

The new system can take into account changes in the user's screens, like resolution changes or missing screens, and try to put the undocked window into another position. If the recover fails, the windows is attached into the editor window.

### Future

The next step is to implement most of the feature available for the code editor to the docks (which are already undockable).

After them, I plan to work on the following tasks:

- Add an icon for the "Make Floating" button.
- Add a complex UI instead of the simple "Make Floating" action that allows to choose the screen where to place the undocked window.
- Add some editor settings to configure the behavior.
- Test the implement features and fix bugs.

<a id="gpu-lightmapper"></a>
## GPU lightmapper enhancements

* Project: GPU lightmapper enhancements
* Student: Priyansh Rathi ([techiepriyansh](https://github.com/techiepriyansh))
* Mentors: Clay John ([clayjohn](https://github.com/clayjohn)), Joan Fons Sanchez ([jfons](https://github.com/jfons))
* PRs:
  * [Multi Image Atlases](https://github.com/godotengine/godot/pull/61861) (merged) 
  * [Soft Shadows](https://github.com/godotengine/godot/pull/62054) (merged)
  * [UV2 Texel Density Debug Draw Mode](https://github.com/godotengine/godot/pull/62987)

### Introduction

Godot 4.0 announced its new GPU lightmapper back in 2020. It's been two years since then, and a lot of work has gone into it. My project aims to further improve the 4.0 GPU lightmapper by porting some of the essential features from the 3.x CPU lightmapper and adding a new debug draw mode for visualizing the texel density of lightmaps.

### Project overview and progress

#### Multi-image atlases

Previously every `LightmapGI` node used to store its lightmap atlas in a single large image. This meant that the larger scenes might refuse to bake because they don't fit within the size limits of an image. I modified the implementation to allow saving the lightmap atlas as multiple images if it doesn't fit inside a single image.
  
#### Soft shadows

The general idea behind soft shadows is to take into account the light source's size instead of treating the light source as a point. When one also takes the contribution of light rays from parts of the light source other than its centre, there is a gradual transition from shadowed to fully lit instead of an abrupt change.

I added support for soft shadows to the GPU lightmapper by incorporating this idea in the lightmapper's raytracing compute shader.

 No soft shadows           |  With soft shadows
:-------------------------:|:-------------------------:
![No soft shadows](/storage/app/media/gsoc/2022-1/gpu-lightmapper-no-soft-shadows.png)  |  ![With soft shadows](/storage/app/media/gsoc/2022-1/gpu-lightmapper-with-soft-shadows.png)

#### Debug draw mode for texel density

This will be a draw mode that previews the texel density of lightmaps (without actually (re)baking them). It will aid users in adjusting the lightmap scale of their objects.

**How do you show the texel density visually?**  

The idea is to overlay a checkerboard pattern with the same square size (in texels) on the textures of all the meshes. Upon rendering, the checkerboard pattern will appear diminished in the regions with high texel density, and magnified in the regions with low texel density.

For this to work, the `lightmap_size` of each object would need to be read from the draw mode's godot shader. We can conveniently use [Godot 4.0's per-instance uniforms](/article/godot-40-gets-global-and-instance-shader-uniforms) to make this work.

I have created a crude proof of concept for this. Here's a sneak peek:

| UV2 texel density debug draw mode |
|-------|
| ![UV2 texel density debug draw mode](/storage/app/media/gsoc/2022-1/gpu-lightmapper-uv2-texel-density-debug.png) |

### Next steps

My priority would be to complete the texel density debug draw mode PR and get it merged. After that, I would like to take up an experimental task related to rendering.

**Lastly**, shoutout to my awesome mentors ([clayjohn](https://github.com/clayjohn) & [jfons](https://github.com/jfons)) for always coming up with ingenious ways to get around my blockers!


-----

That's it for this progress report! You'll hear more about each project once they're finished at the end of September.

A big thankyou to all students for their quality work and creative ideas to implement or improve those features in Godot, and thanks to all the mentors who support them!
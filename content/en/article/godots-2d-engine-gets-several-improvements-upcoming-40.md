---
title: "Godot's 2D engine gets several improvements for upcoming 4.0"
excerpt: "While the focus of Godot 4.0 Vulkan rewrite has largely been improvements to the 3D engine, the 2D side will also see several improvements."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5fc/2a1/782/5fc2a17821989501808749.png
date: 2020-11-28 00:00:00
---

While the focus of Godot 4.0 Vulkan rewrite has largely been enhancements to the 3D engine, the 2D side will also see several improvements.

### Improved Performance

Thanks to Vulkan (which has a much lower draw-call cost than OpenGL), 2D itself in Godot 4.0 will see a speedup for free. But that's not the only reason, many internal improvements and optimizations also contribute to a smoother experience. Changes in memory allocation strategy and internal simplification in draw call logic make it much more efficient to manually call thousands of draw() functions from a node's _draw() callback. Many of these improvements will also accelerate GLES3 and GLES2 back-ends.


### Improved 2D lighting

Godot 3.x supported 2D lighting, but this did not happen without several constraints. The main one was performance due to every light being rendered in a separate draw pass. This is no longer a problem in 4.0, as all lights are drawn in a single pass.

<video controls>
<source src="/storage/app/media/4.0/16lights.mp4" type="video/mp4">
</video>

Additionally, all 2D shadows and light textures use a single atlas, resulting in improved performance.

### Improved 2D materials

Using normal mapping in 2D was also hit or miss. Some nodes supported the "normal" property, and the look of the lighting was very limited.

For Godot 4.0, the new *CanvasTexture* texture type has been introduced. This new texture type can be used in any node or resource instead of regular textures, and provides not only normal, but specular and shininess maps, allowing for more complex 2D lighting and shading.

![ct.png](/storage/app/uploads/public/5fc/29b/040/5fc29b040313b176851112.png)

In the example below, a regular Button uses a CanvasTexture, allowing even UI to receive 2D lighting:

<video controls>
<source src="/storage/app/media/4.0/gg2.mp4" type="video/mp4">
</video>

### Directional 2D light and shadow support

A very requested feature for the 2D engine is the possibility to have 2D directional lights and shadows. This has been added for 4.0 thanks to the new DirectionalLight2D node.

<video controls>
<source src="/storage/app/media/4.0/dl2.mp4" type="video/mp4">
</video>

### CanvasGroup

Another major annoyance for users in Godot 3.x is that, several times, sprites are separated in many nodes in order to be animated or assembled. If a shader is applied to them, or if transparency is changed, the effect is applied to every node individually, given they each do it in their own draw call. This results in undesired effect overlap (or undesired see-through, like the video below)

<video controls>
<source src="/storage/app/media/4.0/cgroup2.mp4" type="video/mp4">
</video>

The new CanvasGroup node merges the draw calls of its children nodes, allowing effects to apply as a whole.

<video controls>
<source src="/storage/app/media/4.0/cgroup1.mp4" type="video/mp4">
</video>

Custom shaders can be used with CanvasGroup to also apply effects like drop shadows or glows to a group of objects as a single one, greatly enhancing the flexibility of the 2D engine.


### 2D Masking / Clipping

The ability to easily mask out children 2D nodes using the parent shape has been one of the most demanded fetures in Godot. This was only doable with very complex workarounds like using viewports or 2D lights, which where limited and inefficient.

In the 4.0 branch, this will be doable in a much easier way, thanks to the "clip children" property in the visibility section. This happens at literally no cost and allows for maximum flexibility.

![clipchildren.jpeg](/storage/app/uploads/public/5fc/29d/914/5fc29d9142907447129624.jpeg)

### Signed Distance Fields for 2D

Signed Distance Fields (or SDF), are one of the new trendy algorithms in 3D graphics. They allow to do so many things! Beginning Godot 4.0 they are supported for 2D. The regular CanvasOccluders have a new option to enable them for SDF rendering. This means that, from any point in the screen, you can request the distance to the closest solid.

This has several use cases, but the most common one is circle tracing. A new API was added to do this as easy as possible. Here is an example of a long drop shadow (which would be very slow to do with a regular shader), simulating 2D lightshafts.

![shafts.png](/storage/app/uploads/public/5fc/29e/9b6/5fc29e9b68aac765092840.png)

Which uses this code:

{{< highlight glsl >}}

shader_type canvas_item;
render_mode unshaded;

uniform vec4 color : hint_color;
uniform float angle : hint_range(0,360);
uniform float len : hint_range(0,1000) = 300;
uniform float fade_margin : hint_range(0,100) = 5;

void fragment() {

	float ang_rad = angle * 3.1416 / 360.0;
	vec2 dir = vec2(sin(ang_rad),cos(ang_rad));
	float max_dist = len;
	vec2 at = screen_uv_to_sdf(SCREEN_UV);
	float accum = 0.0;

	while(accum < max_dist) {
	    float d = texture_sdf(at);
	    accum+=d;
	    if (d < 0.01) {
	        break;
	    }
	    at += d * dir;
	}
	float alpha = 1.0-min(1.0,accum/max_dist);
	if (accum < fade_margin) {
		alpha *= max(0.0,accum / fade_margin);
	}

	COLOR = vec4(color.rgb,alpha * color.a);
}


{{< /highlight >}}

A large amount of other effects can be easily achieved with SDF, such as mist or heat distortion over the floor, 2D global illumination, rain hitting the floor effects, or even procedural shading for the whole screen. The SDF distance is based on scene global coordinates, so measuring distances can be done in a familiar way.

The 2D GPU particle system will support particle collisions against the whole scene via SDF. Hopefully, users will give many other cool uses to this new feature.

### Future

More work is also going towards the 2D engine. [Gilles Roudiere]({{% ref "article/announcing-new-hire-gilles-roudiere" %}}) is working on a new 2D tilemap system an editor that will hopefully overcome most of the limitations with the current one. You can follow his progress on this [twitter account](https://twitter.com/gr0ud).

As always, keep in mind that we make Godot out of love for you and the whole game development community. We want to make the best and easiest to use game engine, and make it so free and open that you can feel that you made it yourself. If you are not, please consider [becoming our patron](https://www.patreon.com/godotengine) to help us out!

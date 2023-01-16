---
title: "Custom sky shaders in Godot 4.0"
excerpt: ""
categories: ["progress-report"]
author: Clay John
image: /storage/app/uploads/public/5e7/7f2/a75/5e77f2a75cf79778591830.png
date: 2020-03-23 02:00:00
---

___

***Update (2020-03-24):** The API has updated a little bit to reflect a problem explained in this [pull request](https://github.com/godotengine/godot/pull/37268).*

***Update (2021-10-28):** You can find a documentation page about Sky shaders in the [Godot documentation](https://docs.godotengine.org/en/latest/tutorials/shaders/shader_reference/sky_shader.html).*

___

A common problem facing users in Godot 3.x was the inability to create dynamic skies that update in real time. We aim to change that by introducing sky shaders.

If you are interested in the implementation, you can find the code [on GitHub](https://github.com/godotengine/godot/pull/37179).

# Sky resources

In Godot 3.x there were two [`Sky`](https://docs.godotengine.org/en/3.2/classes/class_sky.html) types, [`ProceduralSky`](https://docs.godotengine.org/en/3.2/classes/class_proceduralsky.html) and [`PanoramaSky`](https://docs.godotengine.org/en/3.2/classes/class_panoramasky.html). The common elements between the two came from the parent `Sky` class. In Godot 4.0, you will use the [`Sky`](https://docs.godotengine.org/en/latest/classes/class_sky.html) class directly. The `Sky` class contains 3 properties:
1. A [`Material`](https://docs.godotengine.org/en/latest/classes/class_material.html) (can be [`ShaderMaterial`](https://docs.godotengine.org/en/latest/classes/class_shadermaterial.html), [`PanoramaSkyMaterial`](https://docs.godotengine.org/en/latest/classes/class_panoramaskymaterial.html), [`ProceduralSkyMaterial`](https://docs.godotengine.org/en/latest/classes/class_proceduralskymaterial.html), or [`PhysicalSkyMaterial`](https://docs.godotengine.org/en/latest/classes/class_physicalskymaterial.html)).
2. The radiance size.
3. The update mode.

Instead of subclasses, the behaviour of the `Sky` is contained in its `Material`. For all three \*SkyMaterial types, users can select "Convert to ShaderMaterial" and edit the code directly.

### `PanoramaSkyMaterial`

The `PanoramaSkyMaterial` behaves exactly the same as the previous `PanoramaSky`. Assign a panorama texture to the material and you are all done!

### `ProceduralSkyMaterial`

The `ProceduralSkyMaterial` behaves very similarly to the old `ProceduralSky` with a few important differences:
1. Supports up to 4 suns.
2. Now updates instantly as calculations are done on the GPU.
3. Sun properties (direction, energy, and color) are pulled from the [`DirectionalLight`s](https://docs.godotengine.org/en/latest/classes/class_directionallight.html) in the scene.

These changes make the `ProceduralSkyMaterial` a great option for quickly putting together a sky when realism isn't needed. It is easy to tweak and update and uses a lightweight shader to avoid consuming GPU resources.

### `PhysicalSkyMaterial`

The banner image you see above is from a scene using the new `PhysicalSkyMaterial`. The `PhysicalSkyMaterial` is a new resource that draws the sky based on various physical properties, notable Rayleigh and Mie scattering. The `PhysicalSkyMaterial` is based on the Preetham daylight model (with a few hacks to make it more user friendly at the cost of physical accuracy).

The `PhysicalSkyMaterial` can only have one sun and it requires the presence of a `DirectionalLight` in the scene to illuminate the sky.

The main benefit of the `PhysicalSkyMaterial` is that you define properties of the sky and then plausible looking changes happen in the sky based on time of day (e.g. sunset and sunrise are automatic).

The `PhysicalSkyMaterial` is made to be fast and easy to tweak. There are more realistic models of daylight out there, if users need something more realistic they can use [`ShaderMaterial`s](https://docs.godotengine.org/en/latest/classes/class_shadermaterial.html) to implement their own sky models.

# Sky Shaders

We anticipate that most users will be fine using one of the above three sky materials. But if you need more flexibility, or want to do something more complex (e.g. clouds or nebula) the Sky Shader system is designed to allow you to create whatever you need.

Sky Shaders are another type of shader that can be used in a `ShaderMaterial`.

```
shader_type sky;
```

Everything in Sky Shaders takes place in the `fragment()` function. The output is a single color value, `COLOR`.

The simplest Sky Shader is:

```
shader_type sky;

void fragment() {
    COLOR = vec3(0.2, 0.4, 0.9); // Set the entire sky to a nice shade of blue.
}
```

Most Sky Shaders will rely on the view direction which is named `EYEDIR`. Shaders also provide `POSITION` which is the position of the active camera in world space. This can be used to change the sky depending on the location of the camera.

Sky Shaders draw to the background and to the radiance cubemap. This allows the scene to receive real-time lighting updates from changes to the sky.

Sky Shaders also have two optional built-in subpasses which can be accessed with `HALF_RES_COLOR` and `QUARTER_RES_COLOR`. These subpasses run the sky shader on a half-resolution or quarter-resolution texture to allow expensive calculations to be done fewer times (e.g. for clouds). Currently, to use the subpasses you must set the appropriate render mode `use_half_res_pass` or `use_quarter_res_pass`.

The following image draws clouds at half resolution to improve performance.
![Half-resolution clouds for performance](/storage/app/media/4.0/Sky-Shaders/Godot4-sky-shaders-clouds.png)

Sky Shaders allow users to write different code depending on which render target they are using. This allows users to have one version for the cubemap, and another for each subpass.

```
shader_type sky;
render_mode use_half_res_pass;

void fragment() {
    if (AT_CUBEMAP_PASS) {
        COLOR = vec3(1.0); // Reflections will be all white.
    } else if (AT_HALF_RES_PASS) {
        vec4 col = generate_fancy_clouds(EYEDIR, TIME); // Clouds will be rendered to half res texture.
        COLOR = col.rgb;
        ALPHA = col.a; // Subpasses can use alpha.
    } else {
        COLOR = HALF_RES_COLOR; // Background will read from HALF_RES_PASS.
    }
}
```

Finally, Sky Shaders provide access to information about the first 4 `DirectionalLight`s in the scene.
* `LIGHT0_DIRECTION`: Direction of the first `DirectionalLight`.
* `LIGHT0_ENABLED`: `true` when there is at least one `DirectionalLight` in the scene.
* `LIGHT3_COLOR`: Color of the fourth light in the scene. If `LIGHT3_ENABLED` is `false`, this value is undetermined.
* `LIGHT2_ENERGY`: Energy of the third `DirectionalLight` in the scene.

Sky Shaders should allow users to create arbitrarily complex skies. For example, here is a Sky Shader ported over from a [Shadertoy shader](https://www.shadertoy.com/view/MscXRH) by Shane called "Combustible Clouds":
![Sky shader ported from Shadertoy](/storage/app/media/4.0/Sky-Shaders/Godot4-sky-shaders-nebula.png)


## Performance considerations

The Sky Shader is drawn on a full screen quad after all objects are drawn. This means pixels that are occluded will not be drawn. However, this doesn't apply when updating the radiance map and the subbuffers.

In general the best optimization is to avoid updating the radiance cubemap as much as possible. The radiance cubemap updates every frame: when `TIME` is used in the shader, when a uniform is changed in the shader, when any of the light properties update, when the screen size is updated (is using subpasses), and when the active camera's position changes (when using `POSITION`). The radiance cubemap updates multiple times per frame if multiple `Camera`'s share a `Sky` and `POSITION` is used in the shader.

Users should also try to perform expensive calculations in the subpass buffers and then upscale to the full screen when possible. If the sky is especially smooth, you can even render the entire thing to the radiance cubemap and then read from the cubemap when drawing to the screen.

## Conclusion

Please note, if you have existing scenes using the `ProceduralSky` or `PanoramaSky`, this change will break them and you will have to create a `ProceduralSkyMaterial` or a `PanoramaSkyMaterial.`

Since this devlog hasn't felt very devloggy, here is an in-progess screenshot as a reward for reading! This comes from hunting a bug that arose while working on reading from the radiance cubemap properly.
![Cubemap issue in sky shader](/storage/app/media/4.0/Sky-Shaders/Godot4-sky-shaders-cubemap.png)

Please test out these new shaders and share what you create!

And as always, if you are not yet, consider becoming our [patron](https://www.patreon.com/godotengine). This ensures that Godot development remains free from the control of any company and we can keep working like now, with the freedom to listen to everyone equally.

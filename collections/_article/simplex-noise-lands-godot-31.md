---
title: "Simplex noise lands in Godot 3.1"
excerpt: "Simplex noise generation has just landed in Godot 3.1, using the unencumbered OpenSimplex implementation. It allows generation of 2D, 3D and 4D noise with a few lines of code with applications for procedural generation and visual effects."
categories: ["progress-report"]
author: Joan Fons
image: /storage/app/uploads/public/5ba/21d/1f8/5ba21d1f82c19965936967.png
date: 2018-09-19 10:00:00
---

*Make some noise for Godot 3.1!*

Simplex noise generation [has just landed](https://github.com/godotengine/godot/pull/21569) in Godot 3.1! This noise generation algorithm, originally invented by Ken Perlin, is fast and has really good results but it is still encumbered by some patents. That's why Godot will use [OpenSimplex](https://github.com/smcameron/open-simplex-noise-in-c) noise, a public domain and unencumbered alternative.

## Applications

Simplex noise, like any other type of noise, is especially useful in two areas of game development: procedural generation and visual effects.

### Procedural generation

Generating procedural content in videogames can be challenging, completely random structures tend to turn out as a complete mess and therefore unusable. That's why the "controlled randomness" of simplex noise becomes really useful. If you want to learn more about how fractal noise works and some other terrain generation techniques I strongly recommend [this article](https://www.redblobgames.com/maps/terrain-from-noise/) by Red Blob Games.

![A Minecraft-like world by Zylann](/storage/app/media/3.1/SimplexNoise/minecraft.png)
A Godot [voxel world prototype](https://github.com/Zylann/voxelgame) by Zylann, using his own [OpenSimplex module](https://github.com/Zylann/godot_opensimplex) which can now be replaced by the built-in implementation.

![A simple Terraria tribute.](/storage/app/media/3.1/SimplexNoise/lunaria.png)
Example of a simple Terraria-like world generation using Simplex noise.

### Visual effects

2D noise textures are really useful when creating cloudy or wavy effects. For example, the new `NoiseTexture` resource can be used as a normal map to get a quick and simple water material:

![Simple water material](/storage/app/media/3.1/SimplexNoise/water.png)

Noise textures can also be used as roughness maps, 2D light textures, etc. But the true power of noise textures becomes available when used in combination with text shaders:

<iframe width="640" height="360" src="https://www.youtube-nocookie.com/embed/mhWbDA0yNIc?rel=0&controls=0&showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

## Getting started

**Edit:** After this article was published, the `SimplexNoise` node was renamed to `OpenSimplexNoise` to be more explicit on the algorithm used. The examples below have been updated accordingly.

### GDScript

Generating noise from GDScript is as simple as instancing a new noise generator, setting its parameters, and sampling at the desired positions:

```
# Instantiate
var noise = OpenSimplexNoise.new()

# Configure
noise.seed = randi()
noise.octaves = 4
noise.period = 20.0
noise.persistence = 0.8

# Sample
print(noise.get_noise_2d(1.0, 1.0))
print(noise.get_noise_3d(0.5, 3.0, 15.0))
print(noise.get_noise_3d(0.5, 1.9, 4.7, 0.0))
```

Another way to access noise values is to precompute a noise image:

```
# This creates a 512x512 image filled with simplex noise (using the currently set parameters)
var noise_image = noise.get_image(512, 512)

# You can now access the values at each position like in any other image
print(noise_image.get_pixel(10, 20))
```

For more information about `OpenSimplexNoise` and what is the meaning of each parameter, don't forget to check out the [documentation](http://docs.godotengine.org/en/latest/classes/class_opensimplexnoise.html).

### Noise texture

![](/storage/app/media/3.1/SimplexNoise/noise.png)

If you only need access to a noise texture for visual effects, the new `NoiseTexture` resource type is your best bet. It allows you to specify a noise generator and a texture. The texture data will be automatically filled with noise, using the parameters of the generator. You can also enable the use of seamless noise (only works with square textures) and enable outputting the noise data as a normal map.

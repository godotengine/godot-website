---
title: "State of particles and future updates"
excerpt: "An update on the current state of the particle system in Godot, and some hints about what the future holds!"
categories: ["progress-report"]
author: Ilaria Cislaghi
image: /storage/blog/covers/progress-report-state-of-particles.webp
date: 2023-10-23 13:00:00
---

_TL;DR: In 4.2 GPUParticles were refactored and lots of new features were added. Due to high maintenance cost and bug surface, CPUParticles will keep the current feature set._

-----

Godot 4 offers a great opportunity to make some long-requested and much needed changes in many areas, and one of those areas is particle nodes and resources. Before 4.0 some settings used to be a bit confusing and clunky to work with. Now a lot of things have changed: parameters are set with a range using min and max boundaries instead of value and random deviation; there's a particle collision system; there's a turbulence system, there are sub-emitters, and much more.

All around, particles already received a lot of love during the development of Godot 4. However, a number of key features were still missing as of 4.1. Below I go into detail about additions and improvements made to the particle system in the last few months, which you can test already in the [beta release of Godot 4.2](/article/dev-snapshot-godot-4-2-beta-1/).

<video autoplay loop muted playsinline title="A countdown with particle effects by Rensei">
  <source src="/storage/blog/2023-oct-state-of-particles/final-countdown.mp4" type="video/mp4">
</video>

_A countdown with particle effects by [Rensei](https://twitter.com/TheRensei)._

## Artistic control

Godot's existing particle system made an assumption that people would use it for more physically accurate simulations, which are suited for more realistic games. But in practice a vast majority of projects in the Godot ecosystem choose a stylized art direction.

This creates a big pain point when using current particles. In order to obtain an exaggerated motion and snappy timings in visual effects, an acceleration-based approach just doesn't cut it. It ends up really clunky, hard to use, and sometimes achieving certain effects is not possible.

To address these issues, and more, the `GPUParticles` system has been refactored and expanded upon. Particles can now support not only realistic types of effects, but also more stylized ones with more exaggerated motion. Additionally, a couple of long-requested quality of life features were added.

## The new `GPUParticles`

**NOTE:** These changes should be 100% backwards compatible. If particles look different after updating, please [file a bug report](https://github.com/godotengine/godot/issues/new/choose).

_[Pioneering of this work](https://github.com/godotengine/godot/pull/78851) was kindly sponsored by [Pahdo Labs](https://www.pahdolabs.com/)._ After further iteration, this was eventually merged in [GH-79527](https://github.com/godotengine/godot/pull/79527).

### New parameters for `GPUParticles` nodes

Two new parameters were added to `GPUParticles2D`/`GPUParticles3D` nodes:

- `amount_ratio`: from 0 to 1, a percentage of particles compared to the amount that will be emitted.
- `interp_to_end`: from 0 to 1, allows to interpolate all particles from the same node simultaneously towards the end of their lifetime.

<video autoplay loop muted playsinline title="A Night Elf scythe attack effect by Tuppy">
  <source src="/storage/blog/2023-oct-state-of-particles/night-elf-scythe-by-tuppy.mp4" type="video/mp4">
</video>

_A Night Elf scythe attack effect by [Tuppy](https://twitter.com/onetupthree)._

### Changes in `ParticleProcessMaterial`

The main change in the particle material is the big-big refactor of the internal code. The code was split into smaller, reusable functions, which are
called both from `start()` and `process()`. This ensures better consistency and maintainability.

Multiple configuration options were added or changed to expand control over damping, emission, and velocity.

Damping changes include:

- `damping_as_friction`: flag that changes the behavior of damping from a constant
deceleration to a deceleration based on speed.

Emission changes include:

- `emission_shape_offset`: an offset for the emission shape, in the node's local space.
- `emission_shape_scale`: the scale of the emission shape, in the node's local space.
- `inherit_velocity_ratio`: a percentage of the emitter's velocity to inherit on spawn.

Velocity changes include:

- `velocity_pivot`: a pivot point used for calculating radial and orbital velocity.
- `directional_velocity`: velocity along an axis; requires an XYZ curve.
- `orbit_velocity`: orbit velocity can now be used without toggling `disable_z`; requires an XYZ curve; axes are in the node's local space.
- `radial_velocity`: velocity away or towards the velocity pivot.
- `velocity_limit`: a curve defining a hard limit for the particles' velocity following their lifetime.
- `scale_over_velocity`: a curve that allows to scale particles on a given axis.

On top of that, an optional separation between alpha over lifetime and emission over lifetime was added. Note that emission over lifetime just multiplies the `COLOR` value of the particle by a given value. This needs to be properly read in the display shader.

You can also check out [GH-79527](https://github.com/godotengine/godot/pull/79527), which covers the bulk of these changes.

I can't wait to see all that you'll make with it! In the meantime, enjoy these VFX made by the testers of the PR.

<video autoplay loop muted playsinline title="A compilation of various effects created by community members during testing">
  <source src="/storage/blog/2023-oct-state-of-particles/particle-fiesta-by-community.mp4" type="video/mp4">
</video>

_Various particle effects created by community members to help test the rework. Credits go to [Thibaud](https://gotibo.fr/), [Calinou](https://github.com/Calinou), and myself, [QbieShay](https://social.sparkles.cafe/@qbie)_

## And what about `CPUParticles`?

CPU particles have been maintained alongside GPU particles for a long time, but it's becoming [harder and harder to keep feature parity](https://github.com/godotengine/godot-proposals/issues/7344), especially after big changes such as the ones described above. CPU particles were added at the time of the GLES2 renderer in Godot 3, which did not have the capability to support GPU particles. Godot 4 has Vulkan and GLES3 renderers, both of which support GPU particles. This makes it hard to justify maintaining four separate nodes in two different languages (GLSL and C++).

Because of that, we now see the `CPUParticles` as a lower-end, simpler alternative to GPU particles, instead of a CPU-based, 1-to-1 fallback option. It's likely that no more features will be added to `CPUParticles`, though we still welcome PRs that bring them to parity with the GPU ones. We recommend migrating your effects to `GPUParticles`. To help you with the migration, [a converter from CPU particles to a GPU equivalent](https://github.com/godotengine/godot/pull/80779) was added.

From Godot 4.2 onwards, new features for `CPUParticles` will not be accepted unless they have a counterpart in `GPUParticles`. However, contributions to bring CPU particles to feature parity are welcome.

## The future development

For now, development around particles will remain focused on fixing bugs that may have gotten past the review. While a lot of people tested the PR, there still can be lesser used features and edge cases with issues. Thanks to everyone who helped with the development and testing! It was a huge undertaking and it wouldn't be possible without every single one of you <3

I will be taking time to assess the current needs of the VFX pipeline in Godot. My goal, first and foremost, is to enable an artist-friendly workflow. This means reducing the number of technicalities and "gotchas" that Godot currently puts in front of technical artists. In no specific order, here are a couple of things currently on my mind: visual shader support for process materials, additional visual shader nodes, and more spawn options for particles. You can check the [VFX and Techart wishlist](https://github.com/orgs/godotengine/projects/54) on GitHub for more information on what's in the works.

Note that there's currently no contributor specifically hired to work on particles, therefore I cannot promise any timeline for all this planned work. All those things depend on how much time I can dedicate to Godot and how much time other contributors can offer for this area as well.

If you would like to help with the development of these features, please, consider [supporting the project financially](https://fund.godotengine.org/)! More funding allows us to sponsor volunteer contributors and better respond to technical demands of project users.

You can also help by offering your expertise! If you wish to participate in the development, do reach out either on the [Godot Contributors Chat](https://chat.godotengine.org/channel/rendering) or in the [shader/VFX focused Discord community](https://discord.gg/HX4xAGaGjm).

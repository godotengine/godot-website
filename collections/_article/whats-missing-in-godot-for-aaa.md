---
title: "Godot for AA/AAA game development - What's missing?"
excerpt: "Godot 4.0 is coming out soon. It includes major improvements all across the board in both features, performance and usability. Still, one of the biggest questions the community has is: How does it compare with mainstream commercial offerings?"
categories: ["news"]
author: Juan Linietsky
image: /storage/blog/covers/whats-missing-in-godot-for-aaa.jpg
date: 2023-01-16 00:00:00
---

Godot 4.0 is coming out soon. It includes major improvements all across the board in features, performance, and usability. Still, one of the biggest questions the community has is: How does it compare with mainstream commercial offerings?

## Godot 4.0 improvements

### Rendering

Godot 4.0 has an entirely new rendering architecture, which is divided into *modern* and *compatibility* backends.

The modern one does rendering via [RenderingDevice](https://docs.godotengine.org/en/latest/classes/class_renderingdevice.html) (which is implemented in drivers such as Vulkan, Direct3D 12, and more in the future). Additionally, the modern backend can implement *rendering methods*, such as forward clustered, mobile, and more in the future (such as deferred clustered, cinematic, etc.).

The compatibility backend is based on OpenGL ES 3.0 / OpenGL 3.3 / WebGL 2.0 and is intended to run on very old PC hardware as well as most older (still working) mobile phones.

Rendering is significantly more efficient in Godot 4.0, using data oriented algorithms to process the culling of objects and both secondary command buffers and automatic batching to efficiently submit the draw primitives.

The features offered are also a lot more reminiscent of AAA games, such as far more material options and advanced visual effects (including circle <abbr title="Depth Of Field">DOF</abbr>, volumetric fog, AMD FSR, etc.). Additionally, Godot 4.0 supports advanced global illumination techniques such as lightmapping (including <abbr title="Spherical Harmonics">SH</abbr> lightmapping), Voxel GI (which is fully real-time) and <abbr title="Signed-Distance Field Global Illumination">SDFGI</abbr> (which is a single click, open world GI solution). Screen space GI can be used to enhance the realism even more.

### Physics

After an unsatisfactory attempt at using Bullet, Godot 4.0 returns to its own physics engine which, despite not being a high end physics engine like PhysX, aims to offer a lot more flexibility and "just works" capabilities to users.

Several features were added to Godot Physics since 3.x, such as soft bodies and cylinder shape support, as well as several optimizations to make use of multiple threads.

The custom physics engine still has a considerable amount of issues remaining but we are working hard to ensure it is in a decent state for shipping when 4.0 reaches stability. It will continue seeing improvements afterwards, during the following 4.x release cycles.

That said, Godot 4.0 introduces the ability to bind custom physics engines at runtime (without recompiling Godot) via GDExtension, so it's perfectly possible for the community to integrate other engines such as PhysX, Jolt, or Box2D if need to be.

### Scripting

Godot 4.0 has a new version of GDScript, which is far more powerful and overcomes most shortcomings found in 3.x. Majorly, the addition of lambdas, first class functions/signals and a much reduced reliance on string identifiers (which are prone to errors). It also has more useful built-in data types such as integer vectors.

### Core engine

The core engine has been significantly optimized, especially on the memory and data-oriented areas. Core and Variant have been massively cleaned up and made more extensible. Besides being faster and more modern, the core codebase is now significantly easier to maintain and extend.

### GDExtension

It is now possible to extend Godot and add features to it practically in any language and without recompiling the engine, thanks to the new GDExtension system. Aside from [Godot C++](https://github.com/godotengine/godot-cpp) (which makes it easy to extend Godot as easy as with modules but allowing pluggable, dynamic add-ons), there are other bindings in the work such as Python, Rust, Go, etc.

### A lot more

Several other areas got improvements, like the editor (which has been vastly reworked), UI system, multiplayer, navigation, audio, animation, etc. This is a major release with major improvements all across the board.

## So, what's missing?

Do not be mistaken: A lot is still missing from Godot in order to be used comfortably for large projects and teams. That said, what remains is now much less work than it was for Godot 3.x.

First of all, most of the new features still have significant bugs and performance problems that will not be solved in time for the upcoming 4.0 release (there is just too much new code that needs to be tested thoroughly).

These problems will be fixed across the 4.x point releases (which we are now intending to do more often, allowing several releases per year). It may be an extra year or even two until everything feels as solid and fast as everyone expects. [See this article](https://godotengine.org/article/release-management-4-0-and-beyond) about our plans for 4.0 and beyond.

But other than that, there are still some fundamental aspects missing in Godot. The following is an incomplete list of the most important ones:

### Streaming

The traditional way to make games longer since the beginning of times is to divide them in stages. As soon as one stage is completed, it is unloaded while the new one is loaded.

Many games still use this approach nowadays (after all, if it's not broken, don't fix it) but, increasingly, game design has been moving from "individual stages" to "open" or "continuous" worlds where the boundaries between levels disappear. Creating games this way is, as a result, more challenging.

This is handled nowadays by a type of technology called "streaming". It means that assets are pulled from disk on demand (loaded only at the time they are needed), rather than as a part of a larger stage. The most common types of streaming are:

* **Texture streaming**: All textures are loaded in a tiny size by default. As textures get closer to the camera, higher resolution versions (or mip-maps) are streamed from disk. Textures which haven't been used for some frames are freed instead. At any given time, the textures loaded (and their detail) closely reflect the place the player is in.
* **Mesh streaming**: Models are loaded as low detail (few vertices). As they gradually approach the camera, higher resolution versions are streamed from disk. Models that were not used (displayed) since a while are often just freed and will be loaded again when needed.
* **Animation streaming**: Modern games have long cinematics, which require a lot of animation data. Loading those animations require a lot of memory and loading them takes a lot of time. To avoid this, animations are streamed by generally keeping the first second or two in memory and then new sections are loaded on demand as the animation plays. Godot 4.0 supports strong animation compression and animation pages, so most of the work is already done.
* **Audio streaming**: Similar to animation streaming, it requires storing the first second or two of audio and then streaming the rest directly from disk.

Of the above, most are relatively straightforward to implement. The most complex is *mesh streaming*, which generally needs to be implemented together with a GPU culling strategy to ensure that very large amounts of models can be drawn at no CPU cost. This is more or less what techniques like *Nanite* do in Unreal, although Godot does not need to implement something that complex to be of use in most cases.

Streaming is the most important feature missing for managing large scenes or open worlds. Without it, Godot users are subject to long loading times (as every texture, model and animation has to load before anything is shown). There is also a risk of running out of memory if too many assets are loaded in parallel instead of streaming them.

### Low level rendering access

Despite the new renderer in Godot 4.0, there is no architecture that can be considered a one size fits all solution. Often developers need to implement rendering techniques, post processing effects, etc. that don't come bundled with the engine.

The Godot philosophy has always been to *cater to solving the most common use cases, and leave the door open for users to solve the less common on their own*.

As such, this means that low level access to all the rendering server structures needs to be exposed via GDExtension. This will allow creating custom renderers or plugging custom code during the rendering steps, which is very useful for custom rendering techniques or post processes.

### Scene job system

Most of the work done for the Godot 4.0 involved large feature and performance improvements to all the servers (rendering, physics, navigation, etc.). Servers are also now multithreaded and optimized. Even asset loading can now be done multithreaded (using multiple threads to load multiple assets).

Still, the scene system (which uses those servers), despite several usability improvements, has not seen significant optimization.

Scenes nodes in Godot are mostly intended to carry complex high level behaviors (such as animation trees, kinematic characters, IK, skeletons, etc.) for limited amounts of objects (in the hundreds at most). Currently, no threading happens at all and only a single CPU core is used. This makes it very inefficient.

This makes it an ideal target for optimizing with multithreading. There is [an initial proposal](https://github.com/godotengine/godot-proposals/issues/4962) on threaded processing for scene nodes, which should give complex scenes a very significant performance boost.

### Swarms

Scenes, as mentioned before, are designed for complex high level behaviors in the hundreds of instances. Still, sometimes, some games require larger amounts of instances but less complex behaviors instead.

This is needed for some types of game mechanics such as:

* Projectiles (bullet hell for example).
* Units in some types of strategy games with thousands of entitites roaming across a map.
* Cars/people in city simulators, where thousands appear all across the city.
* Sandbox style simulations.
* Complex custom particles that run on CPU.
* Flocks, swarms, mobs, debris, etc.

More experienced programmers can use the servers directly or even plug C++ code to do the heavy lifting. ECS is often also proposed as a solution for this. Even GPU Compute (which is fully supported in Godot) can be easily used to solve this pattern.

But for the sake of keeping Godot accessible and easy to use, the idea is to create a [swarm system](https://github.com/godotengine/godot-proposals/issues/2380) that takes care of the rendering/physics/etc. in large amounts of those objects and the user only has to fill in the code logic.

### Large team VCS support

Godot's text file formats are very friendly to version control. They only write what is needed (no redundant information), keep the ordering of sections and are simple enough to understand changes by just looking at the diff. Few other technologies work as well in this area.

Despite that, this is far from enough to enable large team collaboration. To enable this, Godot <abbr title="Version Control System">VCS</abbr> support has to improve in several areas:

* Better integration with the filesystem dock.
* Better real-time refresh of assets if they were modified externally (and checked out).
* Support for permissions and file locking: Git does not support this out of the box, but Git LFS and Perforce do. This feature is essential for large teams to avoid conflicts and keep files protected from unintended modifications (e.g. a team member modifying code or a scene they don't own by mistake).

Unless the support for this is solid, using Godot in large teams will remain difficult.

### Commercial asset store

While for very large studios this is not an area of interest, medium-sized studios still rely on significant amounts of assets and pre-made functionality. The Asset Library currently existing in Godot only links to open source resources (e.g. hosted on GitHub or GitLab) and is unable to be used for commercial assets.

For the Godot project, a commercial asset store would be a great way to add an extra source of income, but it was not legally possible given our legal status until recently. With the move to the [Godot Foundation](https://godotengine.org/en/article/godots-graduation-godot-moves-to-a-new-foundation), this is a new possibility that opens up.

## Is solving these problems enough for Godot to become a top AA / AAA game engine?

The answer is "it depends". Godot, at its core, is and will always be (by design) a very general purpose game engine. This mean that the tools provided, while certainly capable, are still game neutral. The goal for Godot is to provide a great set of building blocks that can be used and combined to create more specialized game functions and tools.

In contrast, other types of game engines already come with a lot of high level and ready to use components and behaviors.

I don't meant to say that Godot should not support any of that in the future. If it does, though, it will most certainly be as official extensions.

So, what kind of features are we talking about? Well..

### Game specific templates and behaviors

As an example, Unreal comes with a player controller, environment controller, and a lot of tools to manage the game pacing and flow. Most likely aimed at TPS/FPS games, which is the most popular game type made with the engine.

Some of these can be found as templates in Godot's Asset Library but are nowhere close to that functionality. Eventually, official ones should be created that are more powerful and complete.

### Visual scripting

While Godot had visual scripting in the past, we found that the form we had implemented didn't really prove adequate for the needs of the community, so it was [discontinued](https://godotengine.org/article/godot-4-will-discontinue-visual-scripting).

What we realized is that visual scripting really shines when combined together with the premade behaviors mentioned in the previous section. Without a significant amount of high level behaviors available, visual scripting is cumbersome to use as it requires a lot of work to achieve simple things by itself.

All this means that, if we produce a visual scripting solution again, it needs to go hand in hand with high level behaviors and, as such, it should be part of a set of extensions to the engine.

### Specialized artist UIs

When doing tasks such as shader editing, VFX (particles) or animation, there is a large difference between Godot and engines such as Unreal.

The difference is not so much in features supported. In fact, the feature set is fairly similar! The main actual difference is in how they are presented to the user.

Godot is a very modular game engine: this means that you achieve results by *combining* what is there. As an example, editing a particle system in Godot means a lot of subsystems must be understood and used in combination:

* GPUParticles node.
* GPUParticlesMaterial resource (or even an optional dedicated shader).
* Mesh resource for each pass of the particle.
* Mesh material resource for each surface of the mesh (or even an optional dedicated shader).

As another example, the AnimationTree in Godot requires that AnimationNodes are laid out in a tree fashion. They can export parameters, sections can be reused (because they are resources), etc.

Or even more. Godot's animation system is often praised because anything can be animated. Any property, other nodes, etc.

This makes Godot an extremely powerful engine that gives developers a lot of flexibility, but...

It also assumes that the user is knowledgable enough about Godot and all its inner workings in order to take advantage of it. To clarify, none of these systems are too technically complex and this is part of what makes Godot appealing and accessible, but it _still_ requires a certain level of technical and engine knowledge.

In contrast, engines like Unreal have entirely dedicated and isolated interfaces for each of these tasks (materials, cinematic timeline, VFX, animation, etc.).

Sure, they are monolithic and hence less flexible, but for a large team with high amounts of specialization, an artist does not need to understand as much in-depth how the engine works in order to produce content with it.

This shows the fundamental difference of target user between engines. If Godot wants to appeal to larger studios, it needs to provide simpler and more monolithic interfaces for artists to be able to do their job without requiring significant more time investment in learning the technology.

This could, again, be supplied via official add-ons and, like the sections above, would require a significant amount of research to understand how to build it, since without actual feedback from artists we would only be guessing what is needed. But the question here is, is it worth it?

## So, are we not even close?

While the goal of this article is to make clear how significant is the work remaining to make Godot an offering closer to the ones in the commercial segment, it is important to not forget one key detail:

**Godot is Free and Open Source Software.** And as such, it can be modified by anyone to fit any purpose.

Currently, many large studios have the ability to create their own in-house technology. Still, as hardware becomes more and more complex to develop for, they are giving up in favor of spending money on pre-existing commercial technology offerings.

Godot, on the other hand, serves as an excellent platform to build upon, as it solves the vast majority of problems already. As a result, more and more studios are using Godot as a base to derive their own technology from.

This is a win/win situation, as it allows them to keep their freedom to innovate and, at the same time, avoid paying expensive technology licensing costs.

Time will tell how Godot transitions from its current state to something more widely used by larger studios, but it will definitely need significantly more work from our side.

## Future

I hope that this write up made more evident why Godot is such a key technology for the future of the game industry. We will continue working hard to ensure that more and more individuals and companies find Godot useful! But we need your help to happen, so please consider [donating to the project](https://godotengine.org/donate).

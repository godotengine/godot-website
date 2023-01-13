---
title: "Introducing the Godot glTF 2.0 scene exporter"
excerpt: "To supplement Godot's existing import capabilities for the glTF 2.0 open format for 3D assets, Godot 4.0 now includes support for exporting Godot scenes as glTF 2.0. This import/export workflow allows a seamless transition from and to 3D modelling and animation software, giving artists and designers greater flexibility to use each tool for what it can do best."
categories: ["progress-report"]
author: Ernest Lee
image: /storage/app/uploads/public/5ff/358/855/5ff358855fada706463549.png
date: 2021-01-04 21:20:00
---

## Who am I?

Hi everyone, beginning a new 2021. I am Ernest Lee, a core contributor to the 3D pipeline of Godot. I enjoy contributing to new features and bringing new possibilities to the broader community.

You can contact me on [@iFiery on Twitter](https://twitter.com/iFiery), [fire on GitHub](https://github.com/fire) or on my [chibifire.com website](https://chibifire.com).

## What is glTF 2.0?

glTF 2.0 (*GL Transmission Format*) is a fully open-source, widely implemented interchange format with built-in support for physically-based rendering standards. glTF is a growing 3D format and has received massive adoption in the game industry. Commonly selected as the format for new software and game engines, glTF can also have new functionality added using extensions.

glTF can be used in many diverse ways to import or export models across existing industry-standard tools, either through native glTF support or through third-party plugins.

Godot has had support for importing glTF 2.0 files since Godot 3.0, and we strongly expressed [our support of this open format](https://godotengine.org/article/we-should-all-use-gltf-20-export-3d-assets-game-engines). This support has gradually improved over the years and is now quite mature, at the same time as exporters in software like Blender have also reached a very good state.

## A collaborative 3D workflow

For Godot 4.0, we want a bidirectional workflow with glTF: import and export. We want Godot to be accessible to programmers, animators, and character artists. glTF in Godot Engine allows for a combination of in-engine and out-of-engine tooling to work together seamlessly. We hope that this makes our lives better with asset pipelines for 3D.

## Learning from the difficulties of previous 3D standards

The nature of 3D can complicate the import/export process of a game character. One primary example is character animation support, where mistakes and corrupted animations abound.

With glTF, the standard has been polished and established across diverse uses. Everyone can use the glTF standard freely, adapting it in their software and applications.

## How does glTF export help with making games?

Importing glTF scenes is supported since Godot 3.0, but my contribution makes it possible to *export* scenes from the Godot editor to the glTF 2.0 format. You can now export your Godot scenes to glTF to get it back into Blender or other apps and make edits continuously. This workflow means you can work on your scene in Blender and then bring it back into Godot for more work.

You can also use the Godot glTF export pipeline to create and modify world geometry. For example, creating a *blockout* or prototyping within Godot, then exporting as glTF to further edit in Blender, and finally bringing the geometry back into Godot.

Character animation support was essential to me, as interoperability between applications has been lacking or spotty, even among applications that speak the same format. In some cases, broken animations could take enomous effort to correct.

glTF allows the creation of extensions for any purpose. For example, VRM allows cel-shaded characters with custom hair, clothing and collisions. Godot exposes the internal glTF data structure to allow creating extensions as game developers wish.

<video title="Alicia, an example of the VRM extension for glTF 2.0" width="1280" height="720" controls>
  <source src="/storage/app/media/4.0/vrm_gltf_2_0_extensions_2_sp_go.mp4" type="video/mp4">
  Sorry, your browser doesn't support embedded videos.
</video>

Work from [@viridflow on Twitter](https://twitter.com/viridflow) and the sample model [Alicia from VRM](https://github.com/vrm-c/UniVRM/tree/master/Tests/Models/Alicia_vrm-0.51).

## Taking modifications from Godot into Blender

You can more easily modify levels in Godot, transfer back into Blender and eventually back to Godot.

![Reflection - https://github.com/Calinou/godot-reflection](/storage/app/media/cropped-images/GLTF2%20Exporter%20Screenshot%202021-01-03%20103926-0-0-0-0-1609701236.png)

From [@HugoLocurcio](https://twitter.com/HugoLocurcio)'s [Godot Reflection demo](https://github.com/Calinou/godot-reflection).

## How did we implement glTF export?

Multiple Godot contributors collaborated on developing the glTF export enhancement in their spare time. As it was done in our free time, completing the glTF enhancement was slow.

We started work on glTF export in 2019, but Blender was misreading our output.

Marios Staikopoulos fixed the glTF2 skeleton interpretation. (Thank you so much!)

Afterwards, the [Blender import/export plugin](https://github.com/KhronosGroup/glTF-Blender-IO) before version 2.83 could not import any glTF correctly, and it was fixed thanks to scurest's work. (Note that Blender versions older than 2.83 are not supported.)

We had trouble with Godot instanced scenes. When a skeleton was in the scene multiple times it became merged, which was fixed.

## Roadmap

We will add support for these features along the way:

- Improve support for MultiMeshInstance (performance optimizations).
- Support for importing/exporting GridMaps (3D tilemaps).
- BoneAttachments (lets you attach nodes to bones).

## Limitations

- No support for exporting particles since their implementation varies across engines.
- ShaderMaterials cannot be exported.
- No support for exporting 2D scenes.
- Only supported in editor builds (`tools=yes`).

## Who helped along the way?

I want to thank the following people for contributing to glTF import/export:

- Marios Staikopulos - https://github.com/marstaik
- scurest - https://github.com/scurest
- Lyuma - https://github.com/lyuma/ - https://twitter.com/Lyuma2d
- Godot Engine team - https://github.com/godotengine

## Godot 4.0 changelog for glTF

- Moved glTF to the Godot modules.
- Allowing constructing meshes in Godot and exporting them.
- Making animations in Godot and exporting them.
- We can break apart the glTF data structure into something that can be combined and interpreted.
- Godot works with glTF extensions, such as VRM in external plugins.
- glTF was moved out of the Godot core and made into a Godot module.
- Added editor-only APIs with PackedSceneGLTF's `export_gltf`, `import_gltf_scene` and `pack_gltf`.
- CSG is exportable.
- Cameras and lights are now exportable.
- Forced conversion of PBR specular glossiness, so there isn't a white default material.
- The ability to have Godot modules and have them both in core and as custom modules helped development. (Being able to override the existing glTF support using custom modules to Godot outside of the tree helped significantly with progress.)
- Supports selecting between export as glTF Binary (`.glb`) and glTF Separate (`.gltf` + `.bin` + textures).
- Supports up to 8 bone weights instead of just 4.
- Animation skinning and blend shapes are using compute shaders.

We expect to fix issues along the road. If you have any problems, please report them on the [issue tracker](https://github.com/godotengine/godot/issues). When reporting an issue, make sure to include a minimal reproduction project with the 3D scene in question.

## Addendum: Why not Collada (`.dae`)?

The standards body behind glTF 2.0, Khronos, is also behind Collada (`.dae`). The Collada format has limits that could not be overcome without an entirely new standard.

More information in this article: [*Why we should all support glTF 2.0 as THE standard asset exchange format for game engines*](https://godotengine.org/article/we-should-all-use-gltf-20-export-3d-assets-game-engines).

- The Collada specification was very ambiguous in many aspects.
- Most Collada exporters are, to this day, broken and why the Godot developers made the [Better Collada](https://github.com/godotengine/collada-exporter) Blender add-on.
- The market-leading digital content creation tools worked against the Collada format adoption by including an incomplete and buggy exporter in their software.

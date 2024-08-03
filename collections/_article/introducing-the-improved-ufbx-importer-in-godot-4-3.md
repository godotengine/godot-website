---
title: "Introducing the improved ufbx importer in Godot 4.3"
excerpt: "Godot 4.3 now includes native .fbx support"
categories: ["progress-report"]
author: Lyuma
image: /storage/blog/covers/progress-report-new-ufbx-importer.webp
date: 2024-08-02 20:36:00
---

Thanks to [a very welcome contribution by Samuli Raivio (bqqbarbhg) and Ernest Lee (fire)](https://github.com/godotengine/godot/pull/81746), Godot 4.3 now includes native .fbx support. This was made possible using Samuli’s free and open source [ufbx single-file .fbx library](https://github.com/ufbx/ufbx). The ufbx importer will be used by default for all newly imported .fbx files in Godot 4.3.

# What’s new in ufbx?

First and foremost, it will no longer be necessary to download the external FBX2glTF converter in order to use .fbx files in Godot 4.3 projects. This also enables .fbx support on all platforms Godot supports, as well as script access using the new FBXDocument API.

The new importer also contains many technical improvements and changes:
* Tested against content created in [a wide range](https://github.com/ufbx/ufbx/tree/master/data) of professional 3D DCC (digital content creation) tools
* Imported scenes no longer have an extraneous "RootNode" top-level node in the scene.
* Unit conversion (such as centimeters to meters) is now applied to the mesh itself rather than assigned to the node scale of top-level nodes.
* Improved support for PBR materials and lighting accuracy, within what the .fbx format supports. (.fbx tends to have inconsistent material support between applications).
* Support for geometric pivots. Pivot offsets are applied automatically where possible.
* The option to create geometric helper nodes helps support pivots and inheritance modes not otherwise possible with traditional translation, rotation and scaling node transforms.
* Automatic trimming of animations based on the start and end timestamp encoded in the .fbx file header.
* Preserves the original material order from the DCC tool, rather than sorted by face index.
* Calculates an accurate bone rest using information such as the bind-pose. This can assist with skeleton retargeting.
* The `animation/bake_fps` setting in ufbx now only affects interpolation of curves. Animations natively at 60 fps will now import all keyframes regardless of the bake fps setting in the Import Dock.

# Compatibility with existing projects and FBX2glTF

After upgrading to Godot 4.3, existing files in your projects will continue to import with [FBX2glTF](https://github.com/godotengine/FBX2glTF). By default, only newly added files will import with ufbx. This default may be changed by using the "Preset" button near the top of the Import dock, or in the "Import Defaults" pane of Project Settings.

Use extreme caution when changing the importer of an existing .fbx from FBX2glTF to ufbx: the two will have different node hierarchies, which will break modifications made in instanced scenes, break NodePath references in scripts, adjust rest poses of skeletons, and possibly mix up surface override materials due to the change in surface ordering.

In accordance with [our release policy](https://docs.godotengine.org/en/stable/about/release_policy.html#what-are-the-criteria-for-compatibility-across-engine-versions), we will continue to support projects which have chosen to use FBX2glTF throughout the 4.x cycle for compatibility with existing imports. ufbx will affect new 3d imports by default, but the importer for .fbx files may be changed in the Import dock.

Another slight difference exists in the way FBX units are applied. The ufbx integration in Godot scales meshes directly rather than scaling nodes. Note that Blender by default exports objects at 100x scale, using 1cm units, To avoid unexpectedly scaled transforms, we recommend exporting from Blender with the setting "Apply Scalings" set to "FBX Units Scale", which will export the file as 1m units.

# Improved import of animated characters

Those who have worked with .fbx in the past may have encountered a plethora of issues when importing skeletons and animations, to the extent that it became common practice to import such animation files in Blender and re-export as glTF 2.0. With Godot 4.3, we hope that this will be a thing of the past. We have made the following improvements to the skeleton importer:

* [#89629 (Import rest pose as RESET animation)](https://github.com/godotengine/godot/pull/89629): This enables creating a RESET track to restore the skeleton to its imported pose.
* [#88824 (Retargeting option to use a template for silhouette)](https://github.com/godotengine/godot/pull/88824): This feature can be used to reference the RESET animation of a known good (T-pose) reference file. Having a separate reference pose .fbx is a common practice in some animation sets.
* [#88821 (Allow preserving the initial bone pose in rest fixer)](https://github.com/godotengine/godot/pull/88821): This allows for importing a retargeted skeleton while keeping it in its initial pose.
* [#88819 (Add new scene import option to import as Skeleton)](https://github.com/godotengine/godot/pull/88819): This solves cases especially common in .fbx files without any meshes, where animated skeletons import as a series of nodes.
* Improvements to bone detection [#90050 (Add tips detection to auto mapping in bone mapper)](https://github.com/godotengine/godot/pull/90050): Improves support for Mixamo and ReadyPlayerMe finger bone conventions.
* Several other bugfixes ([#90019](https://github.com/godotengine/godot/pull/90019), [#90064](https://github.com/godotengine/godot/pull/90064), [#90065](https://github.com/godotengine/godot/pull/90065), [#91641](https://github.com/godotengine/godot/pull/91641), [#92012](https://github.com/godotengine/godot/pull/92012)) to retargeting and animation import.

# Issues and testing

Samuli has spent exceptional time and effort testing the ufbx library on tens of thousands of .fbx test cases from a variety of sources, and we are proud to consider the new ufbx importer feature-complete with a high level of certainty.

We expect that bugs with .fbx import are going to be relatively uncommon, but if you encounter something incorrect or broken, please [report the issues you find](https://github.com/godotengine/godot/issues) and include the .fbx files which reproduce the issue or reach out to us with instructions.

# Conclusion

The ufbx importer is a major step in improving the accuracy and ease of use of Godot’s 3D importer. It is but one of many improvements, and there is more to come in future 4.x releases.

There are sure to be many applications for the native .fbx importer. Our hope is it will improve interoperability with a wide variety of animation tools and libraries out in the wild. For example, I and the [V-Sekai](https://v-sekai.org/) team have integrated ufbx into [Unidot Importer](https://github.com/V-Sekai/unidot_importer) to allow for interoperability with asset packs in .fbx format.

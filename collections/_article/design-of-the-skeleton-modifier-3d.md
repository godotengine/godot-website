---
title: "Design of the Skeleton Modifier 3D"
excerpt: "We have reworked the skeleton bone update process to add SkeletonModifier3D for modifying the Skeleton."
categories: ["progress-report"]
author: Silc Renew
image: /storage/blog/covers/design-of-the-skeleton-modifier-3d.webp
date: 2024-08-12 10:00:00
---

<style>article .content img { background-color: initial; }</style>

In Godot 4.3 we are adding a new node called `SkeletonModifier3D`. It is used to animate `Skeleton3D`s outside of `AnimationMixer` and is now the base class for several existing nodes.

As part of this we have deprecated (but not removed) some of the pose override functionality in `Skeleton3D` including:

- `set_bone_global_pose_override()`
- `get_bone_global_pose_override()`
- `get_bone_global_pose_no_override()`
- `clear_bones_global_pose_override()`

# Did the pose override design have problems?

![modification](/storage/blog/design-of-the-skeleton-modifier-3d/mod.webp)

Previously, we recommended using the property `global_pose_override` when modifying the bones. This was useful because the original pose was kept separately, so blend values could be set, and bones could be modified without changing the property in `.tscn` file. However, the more complex people's demands for Godot 3D became, the less it covered the use cases and became outdated.

The main problem is the fact that "the processing order between `Skeleton3D` and `AnimationMixer` is changed depending on the `SceneTree` structure`.

**For example, it means that the following two scenes will have different results:**

![different process orders](/storage/blog/design-of-the-skeleton-modifier-3d/different_process_orders.webp)

If there is a modifier such as IK or physical bone, in most cases, it needs to be applied to the result of the played animation. So they need to be processed after the `AnimationMixer`.

In the old skeleton modifier design with bone pose override you must place those modifiers below the `AnimationMixer`. However as scene trees become more complex, it becomes difficult to keep track of the processing order. Also the scene might be imported from glTF which cannot be edited without localization, so managing node order becomes tedious.

Moreover, if multiple nodes use bone pose override, it breaks the modified result.

**Let's imagine a case in which bone modification is performed in the following order:**

```
AnimationMixer -> ModifierA -> ModifierB
```

Keep in mind that both `ModifierA` and `ModifierB` need to get the bone pose that was processed immediately before.

The `AnimationMixer` does not use `set_bone_global_pose_override()`, so it transforms the original pose as `set_bone_pose_rotation()`. This means that the input to `ModifierA` must be retrieved from the original pose with `get_bone_global_pose_no_override()` and the output must be retreived from the override with `get_bone_global_pose_override()`. In this case, if `ModiferB` wants to consider the output of `ModiferA`, both the input and output of `ModifierB` must be the override with `get_bone_global_pose_override()`.

Then, can the order of `ModifierA` and `ModifierB` be interchanged?

--The answer is "NO".

Because `ModifierB`'s input is now `get_bone_global_pose_override()` which is different from `get_bone_global_pose_no_override()`, so `ModifierB` cannot get the original pose set by the `AnimationMixer`.

As I described above, the override design was very weak in terms of process ordering.

# How does the new skeleton design work with SkeletonModifier3D?

`SkeletonModifier3D` is designed to modify bones in the `_process_modification()` virtual method. This means that if you want to develop a custom `SkeletonModifier3D`, you will need to modify the bones within that method.

`SkeletonModifier3D` does not execute modifications by itself, but is executed by the parent of `Skeleton3D`. By placing `SkeletonModifier3D` as a child of `Skeleton3D`, they are registered in `Skeleton3D`, and the process is executed only once per frame in the `Skeleton3D` update process. Then, **the processing order between modifiers is guaranteed to be the same as the order of the children in `Skeleton3D`'s child list**.

Since `AnimationMixer` is applied before the `Skeleton3D` update process, `SkeletonModifier3D` is guaranteed to run after `AnimationMixer`. Also, they do not require `bone_pose_global_override`; This removes any confusion as to whether we should use override or not.

**Here is a SkeletonModifier3D sequence diagram:**

![skeleton modifier process](/storage/blog/design-of-the-skeleton-modifier-3d/skeleton_modifier_process.webp)

Dirty flag resolution may be performed several times per frame, but the update process is a deferred call and is performed only once per frame.

At the beginning of the update process, it stores the pose before the modification process temporarily. When the modification process is complete and applied to the skin, the pose is rolled back to the temporarily stored pose. This performs the role of the past `bone_pose_global_override` which stored the override pose separate from the original pose.

By the way, you may want to get the pose after the modification, or you may wonder why the modifier in the later part cannot enter the original pose when there are multiple modifiers.

We have added some signals for cases where you need to retrieve the pose at each point in time, so you can use them.

- AnimationMixer: mixer_applied
	- Notifies when the blending result related have been applied to the target objects
- SkeletonModifier3D: modification_processed
	- Notifies when the modification have been finished
- Skeleton3D: skeleton_updated
	- Emitted when the final pose has been calculated will be applied to the skin in the update process

Also, note that this process depends on the `Skeleton3D.modifier_callback_mode_process` property.

![modifier callback mode process property](/storage/blog/design-of-the-skeleton-modifier-3d/modifier_callback_mode_process.webp)

For example, in a use case that the node uses the physics process outside of `Skeleton3D` and it affects `SkeletonModifier3D`, the property must be set to `Physics`.

Finally, now we can say that `SkeletonModifier3D` does not make it impossible to do anything that was possible in the past.

# How to make a custom SkeletonModifier3D?

`SkeletonModifier3D` is a virtual class, so you can't add it as stand alone node to a scene.

![add skeleton modifier](/storage/blog/design-of-the-skeleton-modifier-3d/add_skeleton_modifier.webp)

Then, how do we create a custom `SkeletonModifier3D`? Let's try to create a simple custom `SkeletonModifier3D` that points the Y-axis of a bone to a specific coordinate.

## 1. Create a script

Create a blank gdscript file that extends `SkeletonModifier3D`. At this time, register the custom `SkeletonModifier3D` you created with the `class_name` declaration so that it can be added to the scene dock.

```gdscript
class_name CustomModifier
extends SkeletonModifier3D
```

![register custom modifier](/storage/blog/design-of-the-skeleton-modifier-3d/register_custom_modifier.webp)

## 2. Add some declarations and properties

If necessary, add a property to set the bone by declaring `@export_enum` and set the `Skeleton3D` bone names as a hint in `_validate_property()`. You also need to declare `@tool` if you want to select it in the editor.

```gdscript
@tool

class_name CustomModifier
extends SkeletonModifier3D

@export var target_coordinate: Vector3 = Vector3(0, 0, 0)
@export_enum(" ") var bone: String

func _validate_property(property: Dictionary) -> void:
	if property.name == "bone":
		var skeleton: Skeleton3D = get_skeleton()
		if skeleton:
			property.hint = PROPERTY_HINT_ENUM
			property.hint_string = skeleton.get_concatenated_bone_names()
```

The `@tool` declaration is also required for previewing modifications by `SkeletonModifier3D`, so you can consider it is required basically.

![bones enum](/storage/blog/design-of-the-skeleton-modifier-3d/bones_enum.webp)

## 3. Coding calculations of the modification in `_process_modification()`

```gdscript
@tool

class_name CustomModifier
extends SkeletonModifier3D

@export var target_coordinate: Vector3 = Vector3(0, 0, 0)
@export_enum(" ") var bone: String

func _validate_property(property: Dictionary) -> void:
	if property.name == "bone":
		var skeleton: Skeleton3D = get_skeleton()
		if skeleton:
			property.hint = PROPERTY_HINT_ENUM
			property.hint_string = skeleton.get_concatenated_bone_names()

func _process_modification() -> void:
	var skeleton: Skeleton3D = get_skeleton()
	if !skeleton:
		return # Never happen, but for the safety.
	var bone_idx: int = skeleton.find_bone(bone)
	var parent_idx: int = skeleton.get_bone_parent(bone_idx)
	var pose: Transform3D = skeleton.global_transform * skeleton.get_bone_global_pose(bone_idx)
	var looked_at: Transform3D = _y_look_at(pose, target_coordinate)
	skeleton.set_bone_global_pose(bone_idx, Transform3D(looked_at.basis.orthonormalized(), skeleton.get_bone_global_pose(bone_idx).origin))

func _y_look_at(from: Transform3D, target: Vector3) -> Transform3D:
	var t_v: Vector3 = target - from.origin
	var v_y: Vector3 = t_v.normalized()
	var v_z: Vector3 = from.basis.x.cross(v_y)
	v_z = v_z.normalized()
	var v_x: Vector3 = v_y.cross(v_z)
	from.basis = Basis(v_x, v_y, v_z)
	return from
```

`_process_modification()` is a virtual method called in the update process after the AnimationMixer has been applied, as described in the sequence diagram above. If you modify bones in it, it is guaranteed that the order in which the modifications are applied will match the order of `SkeletonModifier3D` of the `Skeleton3D`'s child list.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/design-of-the-skeleton-modifier-3d/custom_modifier.webm?1" type="video/webm">
</video>

Note that the modification should always be applied to the bones at 100% amount. Because `SkeletonModifier3D` has an `influence` property, the value of which is processed and interpolated by `Skeleton3D`. In other words, you do not need to write code to change the amount of modification applied; You should avoid implementing duplicate interpolation processes. However, if your custom `SkeletonModifier3D` can specify multiple bones and you want to manage the amount separately for each bone, it makes sense that adding the amount properties for each bone to your custom modifier.

Finally, remember that this method will not be called if the parent is not a `Skeleton3D`.

## 4. Retrieve modified values from other Nodes

The modification by `SkeletonModifier3D` is immediately discarded after it is applied to the skin, so it is not reflected in the bone pose of `Skeleton3D` during `_process()`.

If you need to retrieve the modificated pose values from other nodes, you must connect them to the appropriate signals.

For example, this is a `Label3D` which reflects the modification after the animation is applied and after all modifications are processed.

```gdscript
@tool

extends Label3D

@onready var poses: Dictionary = { "animated_pose": "", "modified_pose": "" }

func _update_text() -> void:
	text = "animated_pose:" + str(poses["animated_pose"]) + "\n" + "modified_pose:" + str(poses["modified_pose"])

func _on_animation_player_mixer_applied() -> void:
	poses["animated_pose"] = $"../Armature/Skeleton3D".get_bone_pose(1)
	_update_text()

func _on_skeleton_3d_skeleton_updated() -> void:
	poses["modified_pose"] = $"../Armature/Skeleton3D".get_bone_pose(1)
	_update_text()
```

You can see the pose is different depending on the signal.

![modified pose](/storage/blog/design-of-the-skeleton-modifier-3d/modified_pose.webp)

### Download

[skeleton-modifier-3d-demo-project.zip](/storage/blog/design-of-the-skeleton-modifier-3d/modified_poseskeleton-modifier-3d-demo-project.zip)

# Do I always need to create a custom SkeletonModifier3D when modifying a Skeleton3D bone?

As explained above, the modification provided by `SkeletonModifier3D` is temporary. So `SkeletonModifier3D` would be appropriate for effectors and controllers as **post FX**.

If you want permanent modifications, i.e., if you want to develop something like a bone editor, then it makes sense that it is not a `SkeletonModifier3D`. Also, in simple cases where it is guaranteed that no other `SkeletonModifier3D` will be used in the scene, your judgment will prevail.

# What kind of SkeletonModifier3D nodes are included in Godot 4.3?

For now, Godot 4.3 will be containing only `SkeletonModifier3D` which is a migration of several existing nodes that have been in existence since 4.0.

But, there is good news! We are planning to add some built in `SkeletonModifier3D`s in Godot 4.4, such as new IK, constraint, and springbone/jiggle.

If you are interested in developing your own effect using `SkeletonModifier3D`, feel free to make a proposal to include it in core.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

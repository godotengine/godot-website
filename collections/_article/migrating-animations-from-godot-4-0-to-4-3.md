---
title: "Migrating Animations from Godot 4.0 to 4.3"
excerpt: "In Godot 4.3, a large number of animation features have been reworked since 4.0, so it's time to migrate your animations."
categories: ["progress-report"]
author: Silc Renew
image: /storage/blog/covers/migrating-animations-from-godot-4-0-to-4-3.webp
date: 2024-06-04 00:00:00
---

<style>article .content img { background-color: initial; }</style>

# TL;DR

Animation features were still quite immature in 4.0 and there were many undefined behaviors. 4.3 has redefined many behaviors along with some options, so we recommend that you review your settings.

- For blending and `RESET` animation
  - [Deterministic blending](#deterministic-blending)
- For `Discrete` value (int, resource and etc.) animation
  - [CallbackModeDiscrete](#callbackmodediscrete)
- For `Capture` update mode
  - [capture()](#capture)
- For `AnimationNodeStateMachine`
  - [NodeStateMachine - State Machine Type](#nodestatemachine---state-machine-type)

# Description

I'm glad to write this article because it means that animation in Godot 4 is now reaching a stable phase.

We announced many improvements to Godot's animation systems when we released Godot 4.0. The work hasn't slowed down and there has been a gigantic amount of reworking done internally between Godot 4.0 and Godot 4.3, it has been like driving on a super bumpy road.

![super dirt road](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/drive.webp)

After the launch of Godot 4.0, we have taken care to ensure that each change does not cause a major breakdown in compatibility. However, there are cases where we cannot avoid making changes to old projects. So we always try to provide some options in such cases, but there may be cases where manual configuration by the user is required.

Despite extensive class references and documentation, we've lacked practical migration guidelines. Now, at this ideal time, I will explain how to upgrade your projects using real-world examples

I also recommend that even those who do not need to migrate take a look at these, as you can learn about some interesting new features. 

# Timeline

Here is a timeline of the availability of features by version for features that were temporarily affected by the rework.

![timeline](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/timeline-01.webp)

# Introduce New Features

Here are the options and methods that have been changed or added between 3.x and 4.3. 

## AnimationMixer

`AnimationMixer` is a new Node implemented in 4.2 that becomes the base class for `AnimationPlayer` and `AnimationTree`.

![animation mixer node](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/node_animation_mixer.webp)

The `AnimationMixer` has the role of managing the `AnimationLibrary` list and applying the blending results. In other words, the `AnimationMixer` does not have the role of processing time progression such as playback, but receives time information processed by child classes such as `AnimationPlayer` and `AnimationTree` and blends those key values.

`AnimationTree` now can manage the `AnimationLibrary` list by itself without the need for `AnimationPlayer` by inheriting `AnimationMixer`. For compatibility, it is also possible to specify an `AnimationPlayer` and use its list as before.

This unification of `AnimationPlayer` and `AnimationTree` will ensure the equivalence of most functions after 4.2. This means that prior to 4.2, `AnimationPlayer` and `AnimationTree` worked with different code although there was some duplication.

The `AnimationMixer` fixed a large number of bugs that came from the inconsistencies between `AnimationPlayer` and `AnimationTree`, but it also raised some potential bugs to the surface. We have been hard at work resolving these new bugs.

![bugbugbug](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/bugbugbug.webp)

Also, several options needed to be added to keep old behaviors. After 4.2, AnimationTree and AnimationPlayer have different default values for the AnimationMixer property, which is based on compatibility with the old behavior.

When implementing those base classes, one of the particular difficulties was the compatibility of the blending algorithms. Blendings could be nested many times, and it was necessary to consider what behavior was desirable for the user in each use case. Also, the blending weights calculation in 3.x was not consistent enough, so we needed to rewrite that algorithm to ensure that the result was calculated correctly.

![balance](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/balance.webp)

### Deterministic blending

This is a new option implemented in Godot 4.2. In fact, AnimationTree always had been applied with this option in Godot 4.0 and 4.1.

![deterministic property](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/prop_deterministic.webp)

This is an option mainly to control cases where the total blending weight is `0`.

**For example:**

When comparing two animations, there are cases where only one has a track and the other does not.

![animations with unmatched track count 1](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/anim1.webp)
![animations with unmatched track count 2](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/anim2.webp)

When `animation1` and `animation2` are blended so that `animation2` is 100%, the scale track will have the total blending weight is `0` in the result.

**We can expect two possible behaviors in here:**

1. Do nothing
2. Apply default value

In 3.x both AnimationTree and Animation player used option 1. In Godot 4.0 and 4.1, AnimationPlayer used option 1 but AnimationTree used option 2. 

AnimationTree starting using option 2 in 4.0 because it was necessary to process additive blending correctly.

In additive blending, cases where the total weight of blending is `total_weight < 1` or `total_weight > 1` the value must be interpolated from the default value. This means that if the total blending weight is `0`, the animation will be set to the default value. This means that if one animation has no track in the blending, the default value will be applied, and the result will look like performing a reset.

This reset behavior is also convenient with retargeting which was introduced in 4.0.

Some models may have extra bones between the retargeted bones. In this case, when blending occurs with an animation that does not have extra bones, the appearance will be inconsistent if the extra bones are not reset.

**For example:**

Model A has an animation "look up" with 3 bone tracks.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/retarget1.mp4?1" type="video/mp4">
</video>

Model B has an animation "bow" with 4 bone tracks.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/retarget2.mp4?1" type="video/mp4">
</video>

Then, let's play these animations sequentially without resetting.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/retarget3.mp4?1" type="video/mp4">
</video>

It creates a condition where the appearance of the animations do not match between them. So, as you can see from the results, the 3D model pipeline required that resetting behavior.

However doing this caused issues in some cases. Especially frequently reported were cases using `AnimationNodeStateMachine` with 2D projects.

If there is no crossfade in the `AnimationNodeStateMachine` transition, the animation appears to suddenly switch without blending, but internally it is blending, which causes the resetting. This was confusing because it was appeared to be doing the same thing as AnimationPlayer, but it was behaving differently.

Finally, we added a `Deterministic` option in 4.2 that allows the user to set whether the resetting is enabled or not. Also, now that `Deterministic` blending is available in AnimationPlayer, there are more possibilities for projects that use AnimationPlayer.

**For example, this is useful when animating a GUI:**

#### Non-deterministic behavior

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/non_deterministic.mp4?1" type="video/mp4">
</video>

#### Deterministic behavior

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/deterministic.mp4?1" type="video/mp4">
</video>

Finally, note that if the `Deterministic` option is disabled, the total weight of blending will be normalized, so additive blending will not work as expected.

### CallbackModeDiscrete

From what I have seen so far, not many people understand the behavior of the update mode `Discrete`.

When keying `Discrete` values such as `int`, `bool` and other non-numerical type, the `UpdateMode` defaults to `Discrete`.

![discrete option](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/option_discrete.webp)

On the other hand, `InterpolateType` has a `Nearest`.

![nearest option](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/option_nearest.webp)

What is the difference between them?

**Here is a diagram of how they work as the animation progresses:**

![discrete vs nearest keyframe](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/discrete_keyframe-01.webp)

As you can see, the frequency with which object values are updated is different.

**Not only the frequency, but also the timing of the value updates is different within a single frame:**

![discrete vs linear process](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/mixer_process-01.webp)

Since `Discrete` assumes that there is no blending, it sets the value of the object during the blending process, but `Continuous` sets the value to the object after the blending process has been completed. This means that when blending `Discrete` and `Continuous` tracks, the result of the `Continuous` track will always take precedence over the `Discrete` track.

That was a problem because the `Deterministic` blend resetting behavior explained above is done as a `Continuous` mode.

When implementing the `AnimationMixer` and `Deterministic` options in 4.2, we tried to solve that problem by implicitly converting `Discrete` mode to `Continuous` mode when blending occurs.

However, this implicit conversion created another problem when the user understood the behavior of the `Discrete` track and the project relied on the infrequent application of `Discrete` values.

In 4.3, now the user can choose whether or not to force conversions, so they can be handled them explicitly.

**Here is how the options behave when `Discrete` and `Continuous` are blended:**

There are two animations, one is `Continuous` and one is `Discrete`.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/continuous_and_discrete.mp4?1" type="video/mp4">
</video>

#### Force Continuous

Discrete track is treated as a `Continuous` track and they are blended together.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/force_continuous.mp4?1" type="video/mp4">
</video>

#### Dominant

Only on frames with `Discrete` track keys, the `Continuous` track results are not reflected as the `Discrete` track values are given priority.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/dominant.mp4?1" type="video/mp4">
</video>

Note that instead of respecting the Discrete value, flicker may occur during blending.

#### Recessive

In frames with `Discrete` track keys, the `Discrete` track values are potentially reflected, but are immediately overwritten by the `Continuous` track results, so the final result appears to only `Continuous` track.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/recessive.mp4?1" type="video/mp4">
</video>

Flickering does not occur and tends to look better. But note that if the `Continuous` track is blended even a little, the `Discrete` track result may be hidden.

By the way, note that `AnimationPlayer` is set to `Recessive` by default but `AnimationTree` is set to `Force Continuous` by default. Since it works well with the `Deterministic` mode which is enabled by default, and on the basis of the many issues that have been posted from many users who reported that "discrete tracks cannot blend".

### capture()

The animation `UpdateMode` has an option `Capture` in addition to `Discrete` and `Continuous`.

For those who are not familiar with the capture function, it is a feature that allows an object's current value at the moment of animation playback to be interpolated with the playback animation to allow smooth transition into the animation in cases where the object's value is changed outside of the animation.

<video autoplay loop muted playsinline>
  <source src="/storage/blog/migrating-animations-from-godot-4-0-to-4-3/capture.mp4?1" type="video/mp4">
</video>

This method did not exist between 4.0 and 4.2. Instead, it was supposed to work by having `AnimationPlayer` read the `Capture` flag during playback, but that process was very tightly coupled with `AnimationPlayer`'s internal processing. However, when `AnimationMixer` was implemented in 4.2, the part that handled the capture was removed, so it was not working during 4.2 temporarily.

Now, in 4.3, that tight coupling has been solved and revived in a more generalized and available in the `AnimationTree` as well.

## AnimationPlayer

In 4.2, the root motion which was only available in AnimationTree until 4.1, is now available by the implementation of AnimationMixer.

![root motion property](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/prop_root_motion.webp)

### play_with_capture()

A wrapper function that calls `play()` with `capture()` which was added in 4.3. If the animation has a capture track, capture interpolation is performed. The argument allows for more detailed settings.

### Auto Capture

In short, it is an option that makes play() call `play_with_capture()` instead. The argument of `play_with_capture()` executed by this option refers to these properties.

![auto capture properties](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/prop_auto_capture.webp)

If you want to control the behavior in more detail or specify individual arguments, you can disable `Auto Capture` and use `play_with_capture()` manually.

## AnimationTree

A lot of fundamental reworking has been done to get the time progression right. This provides a way to get semantic time between BlendTrees and should allow users to more strictly control their behavior.

![times](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/times.webp)

Also, the AnimationTree now can work stand-alone without AnimationPlayer to retrieve the animation list.

![libraries property](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/prop_libraries.webp)

### NodeStateMachine - State Machine Type

This option was added by the StateMachine rework in 4.1 to control the behavior of nested StateMachines.

**StateMachines are divided into three types depending on their use cases:**

![state machine type property](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/prop_state_machine_type.webp)

#### Root

The most basic StateMachine.

When this is nested, the parent AnimationNode considers the Root StateMachine to be finished when it is in the End state. If the parent AnimationNode commands the Root StateMachine to play from the beginning, the Start state is set.

#### Nested

This option is for use cases when we want to apply a time processing only to the current State in the StateMachine.

If it is nested, the parent AnimationNode will consider the Nested StateMachine to be finished if it is in the End state, or if the State's transition destination does not exist and it is a dead end. If the parent AnimationNode commands the Nested StateMachine to play from the beginning, the animation in the current State is sequenced to position 0.

This is mainly used in cases where states are not connected by a transition. That is, it can be used to reproduce the behavior of an Any state.

![nested statemachine any state](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/nested_state_machine-01.webp)

#### Grouped

This can be used to visually organize the States to avoid bloat in the StateMachine.

Grouped StateMachines are not allowed to be played directly by the user using the playback object, but must be played from the parent StateMachine. This means that it must always have a Root or Nested StateMachine as an ancestor.

Here is a diagram of the structure and behavior:

![grouped statemachine](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/grouped_state_machine-01.webp)

**For example, if you want to play Attack2 in the above case, the script could be written as follows:**

```gdscript
var state_machine: AnimationNodeStateMachinePlayback = $AnimationTree.get("parameters/playback")
state_machine.play("Attack/Attack2")
```

Also, `Grouped` type never stays in the `Start` state and `End` state. The `Start` state of a `Grouped` type is equal to the next state after the `Start` state of the state machine as seen by the parent state machine. The `End` state of a `Grouped` type is equal to the next state of the state machine in the parent state machine. In other words, those transitions are replaced by the parent state machine transitions.

**In short, a more direct representation of the above diagram is equivalent to the following:**

![omitted grouped statemachine](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/grouped_state_machine_2-01.webp)

Note that currently StateMachine does not have user-controllable indexes for connections and cannot have multiple Start/End states, so Grouped StateMachine is limited to having only one input/output. This limitation may be removed in the future by StateMachine enhancements.

### NodeOneShot / NodeTransiton / StateMachineTransition - Break Loop at End

![break loop property](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/prop_break_loop.webp)

In the 4.1 StateMachine rework, we made the AnimationNode have an infinite-length remain time in a loop and for StateMachines with unpredictable endings as a hack. We did this because the old AnimationNode only returned the remaining time after the processing but there was no information there about whether it was looping or not. This change was necessary to prevent unintended animation interruptions for consistency, but it removed the existing behavior of breaking the loop at `AtEnd` and doing a Transition.

In 4.3, the AnimationNode time progression has been reworked significantly to propagate semantic time information. Now a BreakLoopAtEnd option has been added for use cases where the loop is broken by `AtEnd`.

This option makes it easier to implement things like `AtEnd` transitions after several loops.

### NodeAnimation - Custom Timeline

As a byproduct of the time progression reworking, it is now possible to adjust the period and length of the animation in the AnimationNode.

![custom timeline property](/storage/blog/migrating-animations-from-godot-4-0-to-4-3/prop_custom_timeline.webp)

This should help to solve problems with synchronization of foot step animation when blending walking and sideways walking animations, or walking and running animations.

# The future of the animation feature

Compared to the Godot 3 code, you can see that almost all of the code has been rewritten in the animation area.

I have focused mostly on reworking and stabilizing features from Godot 3 that were unstable or not well-defined. I expect that such fundamental rework will be settled in 4.3, allowing us to focus on adding more features from now on.

I already have several proposals that I have written myself, but I am also interested in some proposals that have come from the community, so I hope to pick up on those as well.

## Support

Godot is a non-profit, open source game engine developed by hundreds of contributors on their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.

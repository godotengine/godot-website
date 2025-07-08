---
title: "Introducing the new axis handling system"
excerpt: "For the past months, popular demand has been growing for a way to propery map controller axes in Godot. For a long time Godot was only able to map a single event to an action, making it impossible to deal with analog strengths. Today (after months of discussions), this problem has been solved, and it only took very little amount of changes to the current input mapping system!"
categories: ["progress-report"]
author: Gilles Roudiere
image: /storage/app/uploads/public/5ad/bb4/fc8/5adbb4fc8b26e174840743.png
date: 2018-04-22 00:00:00
---

For the past months, popular demand has been growing for a way to properly map controller axes in Godot. For a long time Godot was only able to map a single event to an action, making it impossible to deal with analog strengths. Today (after months of discussions), this problem has been solved, and it only took very little amount of changes to the current input mapping system!

## The current action system

Godot provides a simple way to allow mapping a button to an action. A unique string identifier is used to create an *action* (such as "jump", "fire", etc.). Actions can, then, be added several input events to trigger them (such as keys, joy buttons, etc.). Finally, actions can be tested from code, either as an event:

```
func input(event):
  if event.is_action_pressed("fire")
    # do something
```

or from the *Input* singleton:

```
if Input.is_action_pressed("go_left"):
  velocity.x -= 1
```

Up to now, actions were just binary. This means they could be either pressed or not, but not more. Joypad axes would also map to actions as pressed (axis >= 0.5) or not pressed (axis < 0.5).

The examples above show how limited gamepad mapping is: When using an analog axis, a bit more information than just  "pressed" or "not pressed" is needed. These kind of APIs allow reading analog values, which map directly to how much the physical controller is bent on a given direction.

## Adding analog values to actions

After many months of discussion on Github, and almost going with a scheme more similar to other engines, we finally settled on a simpler solution: An analog value was added to every action (along with the existing boolean one).

This means that, besides being able to check on the *pressed* state, actions will now report a *strength*. This is represented as a single floating point value ranging from 0.0 to 1.0.

For basic buttons or keys, strength will always return either 0 or 1. For Joypad axes, intermediate values will be reported, depending on how far away the stick or trigger is from the *deadzone*.

This leads to a simpler API, as almost no changes to the project settings input mapping were required.

To retreive an action strength, just use the following new API:

```
Input.get_action_strength("left")
```
or
```
func input(event):
  event.get_action_strength("left")
```

This scheme can be a bit confusing at first, due to being less explicit than retrieving an axis (with range -1.0 to 1.0). Once used to it, however, it has several advantages.

To map a single axis, the input mapping system will require two different actions (such as *left* and *right*, or *up* and *down*). After mapping then, a full axis (-1.0 to 1.0) can be read using the following code:

```
var horizontal = Input.get_action_strength("right") - Input.get_action_strength("left")
```

## Deadzones

Sometimes, when using analog axes, a threshold is required for activating an action. When moving a character left of right, this threshold is usually small. When moving through UI menu options a larger one is desired.

To actions to be triggered when moving tiny amounts, a single parameter *deadzone* was added to Input mapping. This deazone corresponds to how much a joypad stick (or trigger) needs to be moved before the action is considered *pressed* (and thus the action strength > 0).

The relationship between *deadzone*, *strength* and *pressed* parameters is better illustrated in the following diagram:

![](/storage/app/media/devlog/input_mapping/deadzone.png)

Some modern devices also have analog face buttons (the strength of how much they are pressed is recorded), this system also covers this use case perfectly (InputEventButton still needs to implement this feature though).

## Advantages of the *strength* system

In other game engines, analog input is handled via "axis mapping" systems. These systems allow defining a set of named axes (like "horizontal_motion"), and map them to actual analog axes from joypads.

Depending on the joypad axis, the mapping can use a half range (0 to 1, usually shoulder triggers), or full range (-1 to 1, usually analog sticks). Several proposals to implement this system in Godot were evaluated, including pull requests from [AndreaCatania](https://github.com/godotengine/godot/pull/16797) and [Web-eWorks](https://github.com/godotengine/godot/pull/14641) (thanks a lot to them for their effort!). Ultimately they were not used.

The reasoning behind the decision to use the new *strength* based system is summarized in the following points:

* Even though *axis* and *action* feel like different concepts, they are almost the same. Very often, a key may be used as an axis, or an axis may be used like a button. This makes both systems overlap.

* Writing a controller remapping system (games of usually need this feature after they reach a certain level of complexity), is considerably simpler using the *strength* system. This is because only *actions* are requiered for mapping. A code to read an action and save it is as simple as:

```
func _input(event):
    action_map[current_action]=event
```

and this will handle buttons, keys, axes, triggers, etc. transparently.

Dealing with two separate systems (actions and axis mapping) would have led to many complex GUI settings (up to 15 in Unity) and as considerably more complexity in the Input mapping API.

The solution presented above was implemented by a minimal amount of added lines of code to the existing action system. It requires a tiny bit more code to read an axis, but it makes remapping and action management incredibly easy!

Please take the time to give it a try! Even if this approach is not obvious at first, we strongly believe that users will appreciate it in the long run. If you face problems with it, don't hesitate to give us your feedback in the Github issues. :)

---
title: "Godot 3.1 will get many improvements to KinematicBody"
excerpt: "One of the features that make Godot stand out is how easy it is to use the physics engine for non-physics games. For Godot 3.1, several improvements are being worked on."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5b4/de9/702/5b4de97024c77681425121.gif
date: 2018-07-17 00:00:00
---

## KinematicBody

One of the features that make Godot stand out is how easy it is to use the physics engine for non-physics games.
KinematicBody allows controlling a character entity around with a single function (`move_and_slide`). Simply pass a linear velocity, and it will be returned back adjusted while the player moves around the level.

```
velocity = move_and_slide(velocity)
```

This function tries to move the character using that velocity and every time a collision is found, it will slide against it (and adjust the velocity accordingly). Some extra features are also present, such as specifying the floor direction:

```
velocity = move_and_slide(velocity, Vector2(0, -1)) # floor points up
```

After the call, detecting if a character is on floor can be done with a call to:

```
is_on_floor()
```

Likewise for walls. This allows adjusting the player animation accordingly. Godot also detects if the floor below is moving, and it will adjust the character accordingly too.

Unfortunately, despite the ease of use, this approach had a few limitations that could (or not) be evident depending on the type of game you were working on.

## Snapping

The most obvious problem with this approach is snapping to the floor. As the character slides around the level, some situations may lead to the player flying around:

![ramp_normal.gif](/storage/app/uploads/public/5b4/ddc/4ca/5b4ddc4ca68ec721602355.gif)

In some games, this effect may be desired (looks kind of cool), but in other types of games this is unacceptable.

To easily solve this, Godot 3.1 will introduce a new function: ***`move_and_slide_with_snap`***

This function allows a third parameter for a snap vector. It means that, while the character is standing on the floor, it will try to remain snapped to it. If no longer on ground, it will not try to snap again until it touches down.

The snap argument is a simple vector pointing towards a direction and length (how long it should try to search for the ground to snap)

```
# snap 32 pixels down
velocity = move_and_slide_with_snap(velocity, Vector2(0, -1), Vector2(0, 32))
```

This works very well in practice:

![samp_snap.gif](/storage/app/uploads/public/5b4/ddd/89c/5b4ddd89cf5ab658278686.gif)

Of course, you must make sure to disable snap when the character jumps. Jumping is usually done by setting `velocity.y` to a negative velocity (like -100), but if snapping is active this will not work, as the character will snap back to the floor.

Disabling snap can be done by just passing a snap of length 0 (`Vector2()`) to `move_and_slide_with_snap()` or just by calling `move_and_slide()` instead.

A common trick for this is to have a `jumping` boolean variable and toggle it on when the character jumps:

```
# jump logic example with snapping
if is_on_floor() and Input.is_action_just_pressed("jump"):
    # can jump only when on floor
    velocity.y = -100
    jumping = true

# disable jumping when character is falling again
if jumping and velocity.y > 0:
    jumping = false

# preset for snap, 32 pixels down
var snap = Vector2(0, 32)

# oh, but are we jumping? no snap then
if jumping:
    snap = Vector2()

velocity = move_and_slide_with_snap(velocity, Vector2(0, -1), snap)
```

## RayCast Shapes

Another common situation (when using `move_and_slide()`) is that the character incurs more effort going up slopes than it does going down.

![samp_snap.gif](/storage/app/uploads/public/5b4/ddd/89c/5b4ddd89cf5ab658278686.gif)

This is physically correct, but some types of game expect velocity to be constant when moving up and down in slopes.

The solution for this is now the same as when creating a dynamic character controller (physics-based), which is using RayCast shapes. They work now with KinematicBody.

RayCast shapes separate the body in the direction they are pointed to, and will always return a collision normal along their ray, instead of the one provided by the floor (because, again, their goal is to separate). Yes, the name is confusing, maybe they should be renamed to SeparationRayShape in Godot 4.0 :)

In any case, change the collision shape in your body to include a ray pointing down:

![separator_ray.png](/storage/app/uploads/public/5b4/de1/39c/5b4de139c8635728849121.png)

And now, when moving around the stage, the speed will remain constant:

![snap_raycast_snap.gif](/storage/app/uploads/public/5b4/de1/715/5b4de1715ad28642795319.gif)

Keep in mind that the maximum slope angle where this will work will be geometrically determined by the length of the ray, so make sure to adjust the ray length according to the approximate slope you want to support:

![slope_angle.png](/storage/app/uploads/public/5b4/dee/e3b/5b4deee3bc5bf782874519.png)

As you can see in the picture above, the right slope is so steep that it hits the capsule before the ray, so this effectively disables the ray effect and makes the character incur a lot more effort. It happens naturally, without a single line of code needing to be written.


## Sync to Physics

When a KinematicBody is moved around (be it using `move_and_slide`, or just moved around by modifying the `position`, `rotation`, etc. properties), it automatically computes its linear and angular velocity. This means that if either a box with physics (RigidBody) or a KinematicBody (that moves with `move_and_slide`) are standing over it, they will be moved along together.

This makes KinematicBody also very useful for moving platforms, elevators, scripted doors, etc.

The main limitation until now is that, when used as moving platform, its motion was always a frame ahead than the physics, so the character appears to slowly slide over it:

![moving_plat_old.gif](/storage/app/uploads/public/5b4/de7/118/5b4de71180c66281786233.gif)

To compensate with this, a new option "*Sync to Physics*" was added. This option is useful when animating via AnimationPlayer or tweaking the position/rotation properties manually in the object:

![sync_to_physics.png](/storage/app/uploads/public/5b4/de7/7cf/5b4de77cf3819709564138.png)

When enabled, objects will appear in sync with the KinematicBody:

![moving_plat_new.gif](/storage/app/uploads/public/5b4/de7/c23/5b4de7c231685692508567.gif)


## Future

After these functions are well tested, they will be ported to the 3D engine, where they should work in the exact same way.

Once again, please remember that all this done with love for everyone. Our aim is to make a 100% free and open source game engine where the games you make with it are truly yours.

This progress is made possible thanks to the infinite generosity of our patrons. If you are not one yet, please consider [becoming our Patron](https://www.patreon.com/godotengine). This way, you don't need to be an expert engine programmer to aid with Godot development :)

---
title: "Navigation Server for Godot 4.0"
excerpt: "Feature work has started for the upcoming Godot 4.0, and one of the first major changes is the integration of NavigationServer (and NavigationServer2D) to greatly improve and simplify the navigation workflow in Godot.
This devblog shows how to set things up for a simple example with dynamic collision avoidance and runtime navigation mesh re-baking."
categories: ["progress-report"]
author: Andrea Catania
image: /storage/app/uploads/public/5e4/941/218/5e494121885db845075999.png
date: 2020-02-19 13:23:19
---

*This post is outdated and it does not reflect the current state of the Navigation Server in Godot 4.0. If you want to read more about the most recent version you can do so here:*
- https://docs.godotengine.org/en/latest/classes/class_navigationserver2d.html
- https://docs.godotengine.org/en/latest/classes/class_navigationserver3d.html

----

Godot 4.0 features start to land in the development branch, and I'm pleased to introduce you the new `NavigationServer` and `NavigationServer2D` interfaces.

In previous Godot versions, we didn't have a Navigation server and everything was done through the use of the `Navigation` node. While this was not a problem, it was a limited solution and the user was called to integrate the logic to deal with the navigation.

During the design phase, we researched a solution that provides:

- An effortless way to use the navigation system.
- The possibility to stream in and out of the navigation regions.
- Runtime navigation mesh baking.
- Collision avoidance support.
- Multi-threading safety.
- Backward compatibility.

So, the idea to improve the Godot navigation was to integrate a new server that would provide all the above functionalities; so was the `NavigationServer` born. If you're unfamiliar with the concept of "servers" used in the Godot architecture, you can refer to [this past devblog](/article/why-does-godot-use-servers-and-rids) and [the documentation](https://docs.godotengine.org/en/3.2/tutorials/optimization/using_servers.html).

## What's new

Some new concepts appeared in the Godot world - let's talk about these to get a good overview.

#### Map

The `Map` represents the entire world, it's similar to the `space` for the physics engine, but this one is used for the navigation.

The `Map` is an agglomeration of regions and can be created by adding our old and dear `Navigation` node in the scene.

#### Region

The `Region` is a portion of the map and can be created by adding the `NavigationRegion` node.

Despite the two new keywords, `Map` and `Region`, the `Navigation` node and the `NavigationRegion` node are the same as before, from the editor prospective, so you have full retro compatibility and their usage remain the same.

Now the `NavigationRegion` can be added during gameplay, and it's possible to change its transform or even bake the navigation mesh data at runtime.

#### Navigation Agent

The `NavigationAgent` is a new node that allows to navigate the `Map` easily; indeed you don't need anymore to deal with path resolution and path navigation code.

The agent is also responsible for avoiding collisions.

#### Navigation Obstacle

The `NavigationObstacle` is really simple, and it's used for collision avoidance. You can use it to mark its parent as an obstacle, for example under a `PhysicsBody` or `KinematicBody` node.

## Let's try it!

We saw what's new in the `NavigationServer` but let's have a break with theory and start to use it!

The `NavigationServer` is a Godot 4.0 feature and at the time of this writing is part of the unstable master branch; so as first thing I'm going to [build Godot from source](https://docs.godotengine.org/en/latest/development/compiling/index.html), see you in a moment!

*[... Loading ...]*

#### Static world creation

**Note:** Here I'm showing a 3D example, but you can reproduce the exact same steps to use it in 2D!

Here we go, I assume that you are already comfortable using Godot, so let's create the world scene:

![Initial world scene setup](/storage/app/media/navigation/world_scene_1.png)

As you can see it's similar to the Godot 3.x navigation setup: we have a `Navigation` that represents the entire map and two `NavigationRegion` regions.

You can compose the `NavigationRegion` as you like, mine looks like this:

![Setup for the two navigation regions](/storage/app/media/navigation/world_scene_2.png)

**Note:** The meshes have a common static body under their node.

**Remember** to hit the button `Bake NavMesh` to bake the navigation data, as you used to do in 3.x!

#### Character

A navigable map is nothing without something that navigates it! So guess what? Let's create a character that is able to navigate it.

Open another scene, add a `PhysicsBody` and set its mode to `Character`; then add all the nodes that you see in the picture below:

![Character scene setup](/storage/app/media/navigation/character.png)

The `RayCast` node is used to simplify the code to get the floor normal.

The `NavigationAgent` node is a new addition: it's a handy utility used to navigate the `Map`. It does all the hard work for you: indeed, you don't need anymore to deal with the path, instead each frame you have to query this node using `get_next_location()` to know what is the next location which is free to reach.

This is the character code:

```gdscript
extends RigidBody

export(float) var velocity
export(NodePath) var target_node_1


func _ready():
	$NavigationAgent.set_target_location(get_node(target_node_1).get_global_transform().origin)


func _physics_process(_delta):
	# Query the `NavigationAgent` to know the next free to reach location.
	var target = $NavigationAgent.get_next_location()
	var pos = get_global_transform().origin

	# Floor normal.
	var n = $RayCast.get_collision_normal()
	if n.length_squared() < 0.001:
		# Set normal to Y+ if on air.
		n = Vector3(0, 1, 0)

	# Calculate the velocity.
	var vel = (target - pos).slide(n).normalized() * velocity
	set_linear_velocity(vel)
```

> **For the curious:**
>
> The `get_next_location()` function takes into account:
>
> - `Map` reloading events (`Region` baking, `Region` position change, `Region` addition/removal, etc.).
> - Target location changes.
> - Collision avoidance dynamic map updates.
>
> In these cases the function will reload its internal path, and will return the next free location.<br />
> As before, you are free to manually query the `Navigation` node, but using the new `NavigationAgent` is much simpler and efficient.


We now have a character, so let's add it to the world:

![World scene with character](/storage/app/media/navigation/world_scene_3.png)

It is important that the character is a child of the `Navigation` node, because the `NavigationAgent` has the capability to find the `Navigation` node automatically if it is one of its antecedents, otherwise you must set it manually using `set_navigation()`.

#### Target location

The agent just need a `Vector3` as target to reach, and in our case I want to take this position from a spatial node; notice this code in the character script:

```gdscript
[...]
func _ready():
	$NavigationAgent.set_target_location(get_node(target_node_1).get_global_transform().origin)
[...]
```

I've added a `Position3D` into the world, and set its `NodePath` as the character's `target_node_1` exported property. The result is this:

![Demonstration of NavigationAgent with an unreachable target](/storage/app/media/navigation/navigation_1.gif)

You can notice that even if the target is not reachable, the agent will bring the character as close as possible. What if we added a ramp at runtime‽

#### Runtime baking

I've created a simple ramp in a new scene and added a script with this code to the `NavigationMeshInstance2`:

```gdscript
extends NavigationRegion


func _ready():
    # Wait 10 seconds.
	yield(get_tree().create_timer(10.0), "timeout")
	
	# Create the ramp and add it into the world.
	# 'RampPosition' is a Position3D added as child to NavigationMeshInstance2.
	var ramp = load("res://Ramp.tscn").instance()
	$RampPosition.add_child(ramp)
	
	# Bake the navigation mesh of this region.
	bake_navigation_mesh()
```

![Demonstration of NavigationAgent with the addition of a ramp at runtime](/storage/app/media/navigation/navigation_2.gif)

**Boom!** Once the region rebaking is done, as promised, the agent navigates through the new added ramp to finally reach the target location! It's simple, isn't?

#### Region transform change

Ok, cool... but what does the agent do if I move the region around?

I've added an `AnimationPlayer` node to test this case:

![Demonstration of NavigationAgent with a moving region](/storage/app/media/navigation/navigation_3.gif)

The agent is able to navigate towards the target, and once the two regions are aligned (so again welded together) the agent is able to walk into the region 2.

So once again the agent takes care to do the hard work of checking the map reloading for us.

#### Collision avoidance

Until now everything was static, and we had the need to re-bake the navigation mesh when we added a new piece of map.

The new `Navigation` supports collision avoidance for dynamic obstacles, likes `PhysicsBody`.

The first thing to do is to add some dynamic obstacles into the scene; I've added some physics balls and set their velocity from the editor.

I've also added a `KinematicBody`, and I've animated its motion using an animation player.

![World scene with obstacles](/storage/app/media/navigation/world_scene_4.png)

We still want some control over the things that the collision avoidance takes into account. For this reason, in order to allow the agent to see the dynamic obstacles, you have to add the `NavigationObstacle` node as child of the obstacle.

This node doesn't have any property because it's able to figure out automatically the size, velocity and position of its parent.

By default, the agent collision avoidance is not active. To use it, we have to make sure to set the character velocity using:

```gdscript
$NavigationAgent.set_velocity(vel)
```

Once you set the agent velocity, the agent starts to compute the safe velocity that takes into account dynamic obstacles. Once the safe velocity is calculated, it emits the signal `velocity_computed`.

You have to connect a function to this signal, and use the given `safe_velocity` to move the character.

The final code looks like:
```gdscript
[...]

func _physics_process(_delta):
	# Query the `NavigationAgent` to know the next free to reach location.
	var target = $NavigationAgent.get_next_location()
	var pos = get_global_transform().origin

	# Floor normal.
	var n = $RayCast.get_collision_normal()
	if n.length_squared() < 0.001:
		# Set normal to Y+ if on air.
		n = Vector3(0, 1, 0)

	# Calculate the velocity.
	var vel = (target - pos).slide(n).normalized() * velocity
	
	# Tell the agent the velocity.
	$NavigationAgent.set_velocity(vel)


func _on_NavigationAgent_velocity_computed(safe_velocity):
    # Move the character using the computed `safe_velocity` and avoid dynamic obstacles.
	set_linear_velocity(safe_velocity)
```

Now you can play the scene, and voilà:

![Final demonstration with collision avoidance from moving obstacles](/storage/app/media/navigation/navigation_4.gif) 

**Note:** Collision avoidance behavior can be tweaked per agent, by changing the `NavigationAgent` settings. You can change velocity, time of response to obstacles, and some other useful things.

## Conclusion

This was an introduction to the new `NavigationServer` and `NavigationServer2D` coming up in Godot 4.0. The integration of these new servers was made possible thanks to the sponsoring of IMVU!

Give it a check, and enjoy use Godot! And don't hesitate to provide feedback about this new feature, which we can polish further until the actual 4.0 release.
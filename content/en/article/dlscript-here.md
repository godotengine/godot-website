---
title: "GDNative is here!"
excerpt: "A short introduction to the new GDNative module (formerly DLScript) and how to use it in a project. This is a very early version, but the overall process will stay the same."
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/58e/4eb/cb6/58e4ebcb63d98659868573.png
date: 2017-04-05 00:00:00
---

**Edit:** Based on community feedback and to avoid confusion (DLScript is not yet another domain specific language), the module was renamed to *GDNative*.

----------

... at least the first usable version, there's still work to do, *but* it's usable!

As some of you might have heard, we were working on a module that lets you use shared libraries as scripts.

I'll explain what GDNative exactly is, what it is *not*, what you can use it for and lastly show you *how* to use it.

## So what is GDNative?

It is a module for Godot that adds a new "scripting language" to it. I put "scripting language" in quotes because it's not a language.

A "script" in Godot is defined as something that has methods, properties and signals.
It also offers a way to use these things (calling methods, get and set properties...).
Instead of having a text file representing these things (like a GDScript file for example),
GDNative uses shared libraries, which can be attached to nodes via *Native* "scripts".

In some ways, shared libraries have things in common with scripts.

 - you can load them
 - you can unload them
 - you can load function symbols
 - you can call functions

A method in a Native script is just native machine code. You can call third party libraries from that code as well.
You can call GDScript functions from a Native script and vice versa. When C# will be supported optionally, you'll be able to call C# code as well.

## So what is GDNative not?

I want to keep this section short. A Native script is not a module.
Modules have access to all the C++ classes available in Godot and can extend engine functionality.
You want a different renderer? Module. You want to add networking capabilities to all nodes ([*ahem*](/article/godots-new-high-level-networking-preview))? Modules.

"A Native script", as in "a script you're writing", is just a script, just like a GDScript file, so it doesn't have access to those classes, it also can't extend engine functionality.
But it has access to the whole script API (aka the class API you know from the [docs](http://docs.godotengine.org/en/latest/classes/)).

This is one way of communication. A Native script can access the class API and can register methods and properties.

![godot_dlscript](/storage/app/media/dlscript/godot_dlscript.png)

The other way is like the opposite direction: a Native script can also access code from third party libraries.

![godot_dlscript_thirdparty](/storage/app/media/dlscript/godot_dlscript_thirdparty.png)

Methods that are registered to the scripting system can call third party code, but a Native script can't integrate something into the engine - it can only "proxy" direct calls.

So Native scripts can't "hack the engine", but you can build some nice scripts that enable you to use the steamworks API, or Google Play Services **without recompiling the engine**.

## What can you use GDNative for?

There are basically two big use cases:

 - **performance critical code**. GDScript is an excellent language for making games and quick prototyping. It was designed with simplicity in mind, not performance. Some users report that they reached GDScript's limits while e.g. procedurally generating terrain. Since GDNative runs native code it has literally *zero* overhead when it comes to raw computation power (provided you don't make calls into the script system all the time).

 - **binding third party code to Godot**. The nature of dynamic linking allows Native scripts to load other libraries as well - and use those. Like explained above, Native scripts are not a replacement for modules, but for binding an independent library (for example steamworks) it's a much better choice than developing a module.

## How to use GDNative?

This part is like a little tutorial to get you started.

I mentioned that GDNative is not a *language*. It loads shared libraries. These shared libraries can be written in any language you want. Godot just needs to know how to use them.
Because of that, there's no code editor for GDNative in the Godot editor. Because *there is no source code*. There only is a shared library, nothing more, nothing less.
So you have to write your code outside of the editor.

The GDNative API is a C API. Because writing code in C (especially more "high level code" like you'd write for Godot) can get very messy very fast I wrote C++ bindings.
I'll show how to use these C++ bindings to write a script for a node.

You'll need a relatively fresh build of Godot (for example from [here](https://github.com/GodotBuilder/godot-builds/releases/tag/master_20170405), or you can build it yourself (or wait for 3.0)).
Like I said, the GDNative API is a C API, so you'll need headers to access this C API. Additionally you want C++ headers to use the C++ bindings. You can download a *starter kit* [here](https://github.com/GodotNativeTools/cpp_bindings/releases/download/starter_kit/godot_cpp_starter_kit.zip).

This starter kit is just to get you started. It'll probably be outdated very soon. New versions of the C++ bindings and the C Headers can be found [here](https://github.com/GodotNativeTools/cpp_bindings) and [here](https://github.com/GodotNativeTools/godot_headers). Since this is all very WIP, it's possible that there are no recent uploaded binaries for you on these repos. Just be patient or get in touch with me (you can find out how on the bottom of this blog).

Just leave the starter kit alone for now. We'll create a project and a very basic scene first.
(If you are not familiar with making scenes and setting up nodes you should check out the [step by step tutorial](http://docs.godotengine.org/en/latest/learning/step_by_step/))

### Setting up the scene

Create a project and set up the scene. I just created a Node2D as the root node, added a KinematicBody2D and a Sprite using the lovely default icon.

![](/storage/app/media/dlscript/tutorial/scene_setup.png)

I saved the scene in the project root with the name `main.tscn`.

Okay, for now that's all we do with the scene. Now we'll set up the code for the library. For that you should unpack the zip file you downloaded earlier in your project root.
Your project directory should now look like this. (and two .dll files lying around there too)

![](/storage/app/media/dlscript/tutorial/project_organization.png)

### Building the library

The `include` directory contains all the needed headers. The `lib` directory contains the C++ binding implementation. We'll also compile our game code library into that directory. The `src` directory will contain the source code from which we'll build the library for our game. It contains a simple build script. Fill in the name of the project (into the variable `project_name`) in the SConstruct file.

For this example, we'll create a class called `Player` that will move the KinematicBody2D.

Add a file `src/init.cpp`. For simplicity we'll have all the code in this file. For a more serious project you'd want to split the code in headers and implementations.

Write following code into the `src/init.cpp` file:


	#include <godot_cpp/Godot.hpp>

	#include <godot_cpp/KinematicBody2D.hpp>
	#include <godot_cpp/Input.hpp>

	using namespace godot;

	class Player : public KinematicBody2D {
		GODOT_CLASS(Player, KinematicBody2D)

		float speed = 200; // pixel/second

	public:

		void _fixed_process(float delta)
		{
			Vector2 input;

			if (Input::is_action_pressed("ui_up")) {
				input.y -= 1;
			}
			if (Input::is_action_pressed("ui_down")) {
				input.y += 1;
			}
			if (Input::is_action_pressed("ui_left")) {
				input.x -= 1;
			}
			if (Input::is_action_pressed("ui_right")) {
				input.x += 1;
			}

			self->move(input.normalized() * speed * delta);
		}

		static void _register_methods()
		{
			register_method("_fixed_process", &Player::_fixed_process);
		}

	};

	GODOT_DLSCRIPT_INIT(godot_dlscript_init_options *options)
	{
		register_class<Player>();
	}


If you open a terminal in `src/` and execute `scons p=linux` (or `scons p=windows` for windows) then you should see it successfully compile the code into a library in `lib/`.

Ok, now we only need to do two more things.
 - add a Native script to the KinematicBody2D
 - tell Godot where it can find our library

To add a Native script to the node you attach a script as always *but select Native and type in "Player" for the class name*. Also I'm going to use a built-in-script.

![](/storage/app/media/dlscript/tutorial/attach_script.png)

*Edit:* Since DLScript was renamed to GDNative, the above screenshot is now slightly inaccurate, but should give the idea.

This was the "add a Native script to the node" part. Now we need to tell Godot in which library it can find our class definition.

![](/storage/app/media/dlscript/tutorial/new_dllibrary.png)

Then click the small arrow to the right, fill in path to (`lib/` + projectname) for your OS.
Then save it under `lib/library.tres`.

![](/storage/app/media/dlscript/tutorial/save_dllibrary.png)

If you play the scene now, you should be able to control the icon with your arrow keys.

## Further notes

This C++ binding is subject to change. It's more low level and most stuff is still undocumented (did you notice the `self->move(...)`? You need to use `self` to refer to the node the current class is attached to).
I'll write documentation for the C++ bindings. I'll also write documentation for the C API so the community can create their own language bindings.

I also mentioned that the GDNative module still needs some work. For example in-editor initialization of libraries is currently disabled. This feature is required to have exported properties and signals. This doesn't really make sense without proper reloading of libraries. This is on my TODO list, but everyone is welcome to help with that task.
If you're interested, message me (*karroffel*) on IRC or Discord.

Thanks for reading this and happy waiting for Godot!

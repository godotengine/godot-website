---
title: "Introducing C# in Godot"
excerpt: "The next alpha release of Godot 3.0 is about to be published and it will be the first version that ships with C# support. This post gives an introduction to C# scripting in Godot and how to use it in your project."
categories: ["progress-report"]
author: Ignacio Roldán Etcheverry
image: /storage/app/uploads/public/59e/b96/e71/59eb96e712765766078430.png
date: 2017-10-21 19:19:02
---

Alpha2 is around the corner and I'm glad to announce that it will come with the first usable version of C# as a Godot scripting language.

It's still at an early stage and there is a lot of work ahead, but it's a good opportunity for users to have a first look at it and return feedback.

## Acknowledgements

We did not communicate much about it until the C# support was ready for broader testing in the master branch, but Juan and I have been working on this feature as contractors for the Godot project (I as an intern and Juan as mentor/advisor).

Indeed, when we decided to implement Mono/C# as a scripting language in Godot over a year ago, we reached out to Microsoft with Miguel de Icaza's support to see if they would consider funding this work with a donation. They did, and I'm glad to announce that we received a $24,000 donation from Microsoft, which we used to fund my and Juan's work via our non-profit charity Software Freedom Conservancy.

On behalf of the Godot team, I would like to take this opportunity to thank again Microsoft and Miguel de Icaza for their huge generosity in funding our work on this project.

## Introduction

In order to bring C# programming to Godot, we are [embedding](http://www.mono-project.com/docs/advanced/embedding/) the Mono runtime into the engine. As of alpha2, Godot is using Mono 5.2 and [C# 7.0](https://blogs.msdn.microsoft.com/dotnet/2017/03/09/new-features-in-c-7-0/) is supported.

I will write more posts about the internals and how things work in the future but, for this one, I would like to focus on introducing the language and how to write Godot scripts with it.

## From GDScript to C#* *

The following will be a short tutorial explaining the basics of C# programming in Godot and some of the differences you can expect when coming from a language like GDScript.

### Scripts and classes

The first thing you must know is how to declare the script class. Unlike GDScript, in C# you must declare your script class explicitly. A file can have many classes; a class must have the same name as its file (case sensitive) in order for Godot to know that it's the script class:

```cs
// Coin.cs
using Godot; // Namespace that contains all Godot types

// Class Coin has same name as its file. Godot will detect it
public class Coin : Node
{
    public override void _Ready()
    {
        GD.print("Hello, Godot!");
    }
}
```

The above example would be the equivalent to GDScript's:

```gdscript
extends Node

func _ready():
    print("Hello, Godot!")
```

As you can see, the C# API's naming convention uses PascalCase _(Note: As of alpha2, there are still a few names in snake\_case. Renaming will be finished for the next alpha or beta release)_. Global scope methods and constants are available in the `GD` class, except those that are math related are located in the `Mathf` class.

### Static typing

Let's check the following code in GDScript:

```gdscript
var player = get_node("player")
# player is an instance of type KinematicBody2D
var on_floor = player.is_on_floor()
```

If you try the following in C#, it will fail to compile:

```cs
Node player = GetNode("player");
// Error: 'Node' does not contain a definition for 'IsOnFloor'
bool onFloor = player.IsOnFloor();
```

This happens because C# is statically typed. `GetNode` can return an instance of any type that derives from `Node`, but `Node` itself does not declare the method `IsOnFloor`. You must cast the instance to `KinematicBody2D` in order to use that method:

```cs
KinematicBody2D player = (KinematicBody2D)GetNode("player");
// or a shorter way, thanks to type inference
var player = (KinematicBody2D)GetNode("player");

bool onFloor = player.IsOnFloor(); // Compiles
```

Note that the previous cast will throw an exception if the returned instance is not of type `KinematicBody2D`. If you prefer it, you can use the `as` keyword, which will return `null` instead:

```cs
var scene = ResourceLoader.Load("res://player.tscn") as PackedScene;
if (scene != null)
    AddChild(scene.Instance());
else
    GD.print("Not of type PackedScene");
```

Another way to check if an instance is of a type in specific, is by using the `is` keyword:

```cs
public override void _Input(InputEvent ev)
{
    if (ev is InputEventMouse)
    {
        var mouseEvent = (InputEventMouse)ev;
        Vector2 mousePos = mouseEvent.Position;
    }
    else if (ev is InputEventKey)
    {
        var keyEvent = (InputEventKey)ev;
        bool aPressed = keyEvent.Pressed && keyEvent.Scancode == GD.KEY_A;
    }
}
```

### Other differences

There are many more examples to mention; for the beta release, we will have a page in the documentation with a list. Here are a few more that I deem important:

- The default constructor for `Basis`, `Transform2D` and `Quat` initializes all fields to the default value. If you want the same initial value as in GDScript, you can use `Basis.Identity`, `Transform2D.Identity` and `Quat.Identity`.
- A few methods of the API return `Variant`. This means they can return anything. In C# those methods return `object` (`System.Object`).

## Creating a project

If you are building Godot yourself, you will need to tell SCons to build the Mono module as well. This can be done by passing the following argument to SCons: `module_mono_enabled=yes`. You can find more details in the documentation: [Compiling with Mono](http://docs.godotengine.org/en/latest/development/compiling/compiling_with_mono.html).

Running the editor with Mono support requires [Mono](http://www.mono-project.com/download/) 5.2 or greater to be installed on your system. On Windows you will also need MSBuild 15.0, which is bundled with [Visual Studio 2017](https://www.visualstudio.com/downloads/) but can be installed separately with [Build Tools for Visual Studio 2017]( https://www.visualstudio.com/thank-you-downloading-visual-studio/?sku=BuildTools&rel=15).

The process for creating a Godot project for C# scripts is the same as any normal project. Godot will automatically generate the MSBuild project and solution the first time you create a C# script.

### Configuring an external editor

Most people will likely prefer to use an IDE with great tooling or an external editor for writing C# code. Right now, we support `XamarinStudio` and `Visual Studio Code`, and we plan to add `Visual Studio` to the list soon. You can change the editor in `Editor -> Editor Settings -> Mono -> External Editor`.

### Setting up a scene

For this example, we will have two scenes. The Player scene consists in a KinematicBody2D as the root node and a Sprite with the Godot logo as a child.

![](/storage/app/media/mono/image1.png)

_Player.tscn_

Now, let's proceed to add the script named _Player.cs_ to the root node:

![](/storage/app/media/mono/image0.png)

_Notice how the file name must match the class name_

Since this is the first script we create, Godot will generate a MSBuild project and a solution for your Project.

The script source is the following:

```cs
using Godot;

public class Player : KinematicBody2D
{
   [Export]
   private Vector2 motion = new Vector2(0, 100);

   public override void _PhysicsProcess(float delta)
   {
       MoveAndCollide(motion * delta);
   }
}
```

All this script does is add gravity to the player. As you can see, we use the `Export` attribute to display fields in the Inspector. Unlike GDScript, C# is statically typed, so you don't need to specify the value type in the attribute.

The second scene will be called World, and it will be in charge of instancing our Player nodes:

![](/storage/app/media/mono/image2.png)

_World.tscn_

This is the script for the root node:

```cs
using Godot;

public class World : Node2D
{
   [Export]
   private float instanceInterval = 0.5f;
   [Export]
   private int instanceCount = 100;

   public override async void _Ready()
   {
       var timer = new Timer();
       AddChild(timer);
       timer.WaitTime = instanceInterval;
       timer.Start();

       var scene = ResourceLoader.Load("Player.tscn") as PackedScene;

       for (int i = 0; i < instanceCount; i++)
       {
           var instance = scene.Instance() as KinematicBody2D;
           instance.Position = GetGlobalMousePosition();
           AddChild(instance);

           await ToSignal(timer, "timeout");
       }
   }
}
```

Here things look a bit more interesting. We create a timer that emits timeout every half second, which is the interval we will use to instance our Player nodes.

Now, if you come from GDScript, you probably know about a feature called "yield on signal". It suspends the method and yields the execution to the calling method, and when the signal is emitted, the method will be resumed. You can do the same in C#, by making use of `async` and `await` together with the method `ToSignal`. You can learn more about asynchronous programming in C# by reading [this article](https://docs.microsoft.com/en-us/dotnet/csharp/async).

Your project directory should look like this:

![](/storage/app/media/mono/image3.png)

Godot stores internal files related to your project (assemblies, metadata, temporary build files, etc) in the _.mono_ folder.

### Running the project

Save your scripts and run the project. Godot will automatically build the solution and display any compiler errors in the bottom panel. If everything went well, you will have a game that spawns Godot logos at the mouse position.

## Coming soon

As mentioned in the introduction, there is still a lot of work to be done. Many features are still missing. During the period between alpha2 and the next release, the focus will be on the following features:

### Game exporting

The Godot API (EditorExportPlugin) which allows customizing the export process was added recently, so we still don't make use of it for C#.
Exporting the game will make sure to pack all the required assemblies with your exported game, among other things.

### Android platform

There are three platforms that are not supported right now: Android, iPhone, and WebAssembly. Android will be the first one we will focus on.

iPhone exporting will require the extra step of compiling the assemblies ahead of time (AOT) since JITing is not possible on this platform.

Currently, WebAssembly is not possible, but the people at Mono are experimenting to [bring Mono to WebAssembly](http://www.mono-project.com/news/2017/08/09/hello-webassembly/).

### Debugging extensions

Debugging extensions allow developers to debug their games from their editor. The first extensions will be for XamarinStudio and Visual Studio Code, but we also plan to add editor integration with Visual Studio.

### Usability and feedback

There are many usability improvements and ideas that didn't make it in time for alpha2. We are also expecting a lot of user feedback from this release!

## Further notes

Like always, keep in mind this is an alpha and there may be bugs and crashes. Please, report any issue you encounter on [our bug tracker](https://github.com/godotengine/godot/issues).

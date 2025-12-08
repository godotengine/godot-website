---
title: "More programming languages in Godot, want to help?"
excerpt: "There is a common misundertanding in the industry about us, Godot devs, trying to reinvent the wheel because we like it. This could not be further away from the truth."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/57a/b73/701/57ab73701f653339027447.jpg
date: 2016-08-10 00:00:00
---

## Why more languages, isn't GDScript enough?

There is a common misundertanding about us in the industry: Godot devs, always trying to reinvent the wheel because we like it. This could not be further away from the truth.

The reality is that we are extremely demanding with our requirements from third party solutions and it just happens that very often, even if a library, language, etc. is very popular, it does not satisfy our needs. This was the case of third party scripting languages such as Lua, Python, Squirrel, etc.

When we originally made Godot, we were completely certain that we wanted our main scripting language to be dynamically typed due to the high accessibility this provides. We understood that most of the code written for a game is not performance critical, and that the C++ part of the engine already covers most of the critical parts, so we originally went for Lua, and then for Squirrel (while trying Python in the process).

Unfortunately, we had many problems with those languages. Binding code was always large, complex and prone to bugs. True multi-threading (with a stack per thread, but sharing memory) was not supported, and vector types had to be created with custom userpointers, which provided much slower performance than built-in types. Added to that, we could never completely eliminate the stalls related to the garbage collector.

GDScript was born as a way to make all these problems go away. When users write code in GDScript within the IDE, everything simply "just works" and you have the added value of live code completion. None of this could have been made with a third party language. We tried, we became experts at it, but it just didn't work out.

Because of this, **GDScript will always be the main supported language**, and our recommended choice for all Godot users.


## Why other languages, then?

Even though we will always recommend new users to go the GDScript route, because we know it's the least hassle option, we understand that developers have different needs and experiences, and that believing in "one size fits all" is a mistake. That's why we are working on the support of C# and visual scripting for the upcoming Godot 2.2.

### Why C#?

In the case of **C#**, there is a huge amount of love towards this programming language, which is expected due to the main designer being the same guy who created Object Pascal (which was very popular in the 90s with Borland Pascal and later through Delphi).

Truth is that Mono is very well made, has excellent, modern binding extensions (the complete opposite to Java/JNI) and supports multi-threading just fine. As a result, it should integrate smoothly into Godot. The only reason we did not want to go this route in the past was due to license restrictions, but this ceased to be a problem a few months ago when Microsoft acquired Xamarin and relicensed Mono under the MIT license.

The main benefit of supporting C# is that, all of a sudden, Godot will become a more-than-tempting option to the indie and corporate cultures who are used to products supporting this language. This should greatly help us reach potential users who might have been initially puzzled by having to *learn* GDScript (though we still guarantee that any programmer can pick up GDScript in less than an hour).

This is, however, not the main reason behind our intention to support this language. As always, we want to implement the features that our community wants the most, and C# support is definitely one of the most recurrent topics. We also believe that it will provide a high performance alternative to GDScript without having to compile Godot manually for C++, and a statically typed language for the developers allergic to duck typing.

To clarify things: since the Mono runtime is relatively heavy, and many Godot users will prefer to stick to GDScript, we intend to provide the Mono-enabled version of Godot as a **separate download**. This means that users will have the choice to use Godot with GDScript only, or GDScript and Mono.

### Why Visual Scripting?

Another language currently being added to Godot is **VisualScript**, our take on visual programming. We are using an approach similar on the surface to Unreal's Blueprint, but pretty different under the hood.

As we have seen so far many Godot users and other developers puzzled about Godot adding this functionality, we want to make very clear that it is not our intention to replace GDScript or traditional programming for a visual approach.

To make it clearer, it is *not* our belief that forcing programmers to write code with visual blocks will result in a more efficient workflow. We know other game engines and solutions try to sell you this point of view, but rest assured that this is not our view or intention. We stand by programming and still believe it's the best.

So then, again, why visual scripting? Our goals with it are the following:

* Provide a way for non-programmers to experience what developing in Godot feels like, by ensuring they have a way to manipulate their game's logic.
* Allow programmers to set up their scenes, AI, etc. in a way they can expose the coarse parameters and logic to level designers or game designers. This way, they can do tweaks without bothering programmers.
* Allow programmers to expose how data is organized in a visual way. Godot's VisualScript has so much flexibility in how the graph flows that it allows creating dialogue trees, coarse game flow, event handling, etc. with small effort.

Please understand it as just an extra tool, not as a replacement to programming. It will be possible to use both GDScript and VisualScript as complementary tool in a same project.

## Binding new languages

There currently is a lot of demand for additional languages, such as Java, Haxe, Swift, Object Pascal, etc. As Godot 2.2 will focus on new languages, this a great time to help us develop and improve the binding API. Of course it may seem like a challenging effort.

Officially, our supported languages for now will be GDScript, Mono, VisualScript and C++. If you want to help integrate another language, you should first of all contact us (see contact info at the bottom of the site or use IRC: [#godotengine-devel on Freenode](https://webchat.freenode.net/?channels=godotengine-devel)). The process to add new languages is more or less the following:

1. **Re-create Godot's basic types in your new language**: These are types such as `Vector3`, `int`, `float`, `String`, etc. Many of these are usually provided already.
2. **Create a module**: A C++ module that creates binding code needs to be done ([creating modules in C++ is well documented](https://docs.godotengine.org/en/latest/engine_details/architecture/custom_modules_in_cpp.html)). The entire exposed Godot API can be accessed via the static functions in `ObjectTypeDB`.
3. **Generate binding code** in your new language that accesses the exposed functions in the `MethodBind` class (there is one for each exposed method).
4. **Create a `ScriptLanguage`** class and supply the neccesary methods exposed for debugging, profiling, etc. You can supply symbols, code completion helpers, etc. if this language is meant to be edited inside Godot.

Again, as this process is not fully streamlined yet, we encourage you to get in touch with us if you want to do this effort.

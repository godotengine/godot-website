---
title: "A look at the GDNative architecture"
excerpt: "GDNative changed a lot since it was first introduced. From being a scripting-centered module it quickly became a more general purpose tool than we initially assumed. Here we present the way GDNative and related technologies work together."
categories: ["progress-report"]
author: karroffel
image: /storage/app/uploads/public/5a4/bcf/c4a/5a4bcfc4a5874955869035.png
date: 2018-01-02 00:00:00
---

The GDNative architecture changed a lot since the very first version of the then-called "DLScript". With the release of Godot 3.0 approaching and the API getting more and more stable it is a good time to give an overview of what GDNative actually looks like now.


# GDNativeLibrary

A GDNativeLibrary is a resource type that abstracts over the actual binary files needed for each platform.
It contains a few properties (how Godot should deal with repeated loads of the library, name prefixing, ...), a list of "entry" library paths and a list for libraries that an "entry" library depends on.

Those lists are a simple mapping from a set of feature tags to either a file path or an array of file paths in case of the dependencies.

## Feature tags

Godot has a feature tag system. A feature tag hints that a certain attribute or feature is available. Example tags are `Windows`, `X11`, `32`, `64`, `mobile` and many more. When exporting a game it is also possible to define tags yourself which then might change how the game will work.

For more information on feature tags see this [docs page](http://docs.godotengine.org/en/latest/learning/workflow/export/feature_tags.html).

An entry in either of those lists inside the GDNativeLibrary resource consists of a *key* and a *value*. The key is a `.`-separated list of feature tags that need to be present.

So for example the library that's supposed to be used on a 64 bit Linux machine could have the key `X11.64`, while the same Windows machine could have the key `Windows.64`.

In the Godot editor there is a graphical user interface to make the editing of such a resource more user friendly.

![The GDNativeLibrary editor plugin](/storage/app/uploads/public/5a4/bca/86e/5a4bca86e45b5269790153.png)


All the entries will be checked from top to bottom and entries with a non-existing feature tag will be skipped. The first entry where all the tags are available will be used, **so order is significant**.


## Singleton libraries

One of the properties of a GDNativeLibrary is whether that library is supposed to be used as a singleton library or not.
A singleton library gets loaded at Godot's startup, as early as possible, and the `gdnative_singleton` function inside that library will be called. 
This can be used when a library offers functionality that needs tight integration into Godot. This is usually done via *GDNative extensions* - more on those later.
  


# GDNative

GDNative objects represent loaded libraries. Which library to load will be looked up from a GDNativeLibrary resource. From inside Godot's C++ code it can be used to call functions inside the library. That way to call functions is very flexible, low level and unsafe, which is why this is not possible from a scripting language like GDScript.

If you really want to call functions directly from a scripting language the `GDNative.call_native` method can be used. A so-called *call-type* is used to abstract over the low level details of the function pointer call. There is only one predefined call type, `standard_varcall`, which expects the function to be called to have this signature `godot_variant function_name(godot_array *)`.
A singleton library can register new calling types if needed.

## The GDNative/Godot API

If a library wants to use Godot functionality it needs to call some Godot code in some way. Since portability between C++ compilers is very problematic we chose to have a C API which is wrapping the C++ calls. That opens up a variety of languages to access that API but it also makes it more verbose to work with.

## API struct

In order to call those C wrapper functions the library needs to know the locations of those functions. The naive approach is to simply leave them blank and let the operating system's library loader fill in the addresses.

Unfortunately this doesn't work equally well on all platforms (*cough* Windows *cough*), so in order to keep the code and procedure to set up a GDNative library *mostly the same* on all platforms we decided to take another route: passing a struct of function pointers to the library while loading it.

That struct lives inside of Godot and contains versioning information, fields for future API modifications and also an array of extension APIs.


    struct godot_gdnative_api_struct {
    	unsigned int type;
    	godot_gdnative_api_version version;
    	const godot_gdnative_api_struct *next;
    };
    
    struct godot_gdnative_core_api_struct {
    	unsigned int type;
    	godot_gdnative_api_version version;
    	const godot_gdnative_api_struct *next;
    	unsigned int num_extensions;
    	const godot_gdnative_api_struct **extensions;
    	// ...
    };

The library can then access the needed functions from that struct. Practically that means that instead of writing `godot_some_function();` it would be `api->godot_some_function();`.

Some people prefer to simply write function names instead of accessing them via a struct, so when needed Godot's build system can generate a static library that wraps all the function pointers into static functions with the same name.


## Extensions

GDNative extensions are a way to offer functionality to libraries that aren't a part of the GDNative/Godot API itself. They can be used in different ways and below a few current extensions are listed.

Extensions usually have a C API, possibly with custom data type definitions. Oftentimes inside of Godot there are C++ classes/methods that are used to wrap C functions while being still tightly integrated with other features. ARVR and PluginScript show that.

Every extension has its own sub-API-struct which contains versioning and a field for future API modifications.


# ARVR

The whole ARVR API needed to implement a VR driver using GDNative can be found in this [file](https://github.com/godotengine/godot/blob/9821562b300ecc2401ec1e42600a92053897e51f/modules/gdnative/include/arvr/godot_arvr.h).

The starting point with that API is the `godot_arvr_register_interface` function which needs to be called from a singleton library. The structure that needs to be passed as a parameter contains more function pointers which then will be called by Godot.

There is a [null-driver implementation](https://github.com/BastiaanOlij/ARVRSimple), an [OpenVR implementation](https://github.com/BastiaanOlij/godot_openvr) and a WIP [OpenHMD implementation](https://github.com/BastiaanOlij/godot_openhmd).


# NativeScript

In the earliest days of GDNative development it was only planned to use it for scripting, later it turned out to be much more flexible and useful than that and the scripting part is now *only* an extension.

NativeScript implements a "scripting language" (at least that's how it's called in Godot - something you can use for "scripting"), but instead of using text and files for the logic (like GDScript does for example) it uses a GDNative library for those things.

NativeScript calls a function inside the library, `nativescript_init`, which is supposed to tell Godot about which classes and methods are available. When those classes and methods should be used, NativeScript simply calls into the library to do the work.

All the functions used to pass that information to Godot can be found [here](https://github.com/godotengine/godot/blob/9821562b300ecc2401ec1e42600a92053897e51f/modules/gdnative/include/nativescript/godot_nativescript.h).

A minimal demo can be found [here](https://github.com/GodotNativeTools/GDNative-demos/tree/a02866daffdaf29e53c2fcef250c38dd33b2d1f9/c/SimpleDemo).

Because NativeScript operates on libraries only it doesn't care which language was used to create the library, which makes NativeScript a popular way to use *Your Favorite Programming Language* inside Godot (even thought doing so still requires a lot of effort).

For more flexible and a more *script-like* feeling PluginScript should be used (if it suits the language).


# PluginScript

The PluginScript extension adds a "wrapper scripting language implementation" to Godot. It is a fully working and integrated scripting language as far as Godot is concerned, *but all the logic is implemented inside a library*.

NativeScript uses libraries as "scripts", while PluginScript uses libraries *to define scripts*. That way a new scripting language can be added to Godot just by adding a few files into your Godot project.

For now there is only one major application of it in the wild, which is the [godot-python](https://github.com/touilleMan/godot-python) project.

Similarly to the ARVR extension, the API for PluginScript is [relatively small](https://github.com/godotengine/godot/blob/9821562b300ecc2401ec1e42600a92053897e51f/modules/gdnative/include/pluginscript/godot_pluginscript.h), having only one function to call, `godot_pluginscript_register_language`.
That function accepts a struct with function pointers and other information about the scripting language.

After a restart of the editor the language should be ready to be used.



# Future plans

We are planning to create more extensions, for example for pluggable audio and video codecs.

All in all we are pretty satisfied with the current architecture of GDNative, next steps working towards the release will be more documentation and refining language bindings.
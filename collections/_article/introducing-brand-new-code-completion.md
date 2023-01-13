---
title: "Introducing... brand new code completion!"
excerpt: "It has only been a week since the stable release and development is moving on to other new cool features! This week has been pushed to GitHub a new code completion for the built-in editor."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/56b/c81/867/56bc81867dd4b725475913.png
date: 2014-12-22 00:00:00
---

## Smart completion

It has only been a week since the stable release and development is moving on to other new cool features! This week has been pushed to GitHub a new code completion for the built-in editor.

Godot previously only supported limited code completion (only symbols) in the editor. As GDScript is a dynamically typed scripted language, variables are not necessarily typed, which means at run time the value of a variable can be anything.

## How does it work?

Statically typed languages such as C, C++, Java or C# require the programmer to explicitly specify the type of every variable (variant and generic objects are supported, but these are used only on special cases).  Validating the parse tree for datatype conversions is typical of these kind of languages, so at parse time it’s possible to know the datatype of everything, making the implementation of code completion really easy.

In GDScript this is not possible, because type conversions happens in run-time. However, there are some things that Godot provides to GDScript:

* Engine functions and properties are all typed.
* Function arguments (including those of virtual) are typed.
* Signal arguments are typed.
* Exported variables are typed.
* Constants are typed.
* Preloaded resources (which are initialized at parse time).
* Many built-in functions are deterministic (ie, sin() ).
* Many objects are live at the time code is written (ie scene nodes).

Using this information, The new code completion, then, does something  interesting. It tries to recursively back-parse variables to their origins. Unsurprisingly, most of the time, this origin does have a type, as it is one of the items in the list above.

The smart code completion will trace back identifiers through arrays, dictionaries, functions, local variable blocks, members, constants, etc. It will try by all means to go back to a typed node in the parse tree and, in most cases, it will succeed. For example..

## Global, local & class scope

Global and local variables and functions are the easiest types of completion since it’s they are type independent. Only the identifier name needs to be completed. The algorithm simply goes from the current block upwards from the current block to the global scope trying to find the relevant keywords for completion. The only catch is that it must figure out whether the current block is inside a static function, in which case it must exclude regular functions and member variables.

(*Edit:* image lost in translation)

## Indexing

Indexing refers to completing expressions followed by the ‘.’ (period) token. For this, the type of the preceding expression must be guessed, no matter if it’s a function call, an identifier string a constant, etc. The smart completion will do inverse tracing of identifiers to guess their type, or even their instance (in the case of live objects or preloads).

(*Edit:* image lost in translation)

Even dictionaries or arrays can be traced back to their source to guess their type.

(*Edit:* image lost in translation)

Since in Godot, many of the functions implemented come from signals or virtual functions, so the type of their arguments is known and be completable. For example, the type of the identifier comes from the function in the argument, which in turn comes from the argument of the virtual function.

(*Edit:* image lost in translation)

## Live objects

Scene nodes (for node scripts) and resources can be used to trace types. Functions that return generic objects (and that are const) are called to guess the potential return type too. In the case of nodes, for example, the entire scene tree appears as completion hint:

(*Edit:* image lost in translation)

Or, in the case of an animation player, the animations contained within:

![cc6.png](/storage/app/uploads/public/56c/314/0b4/56c3140b4dac7412191302.png)

Most importantly, connecting signals from code also becomes easier with this feature:

(*Edit:* image lost in translation)

## Argument hinting

The new smart completion will also hint arguments as long as they are completed. For regular script functions, the script form of the method is shown:

(*Edit:* image lost in translation)

For engine functions, their full form with datatypes are displayed.

(*Edit:* image lost in translation)

Finally, built-in types can show constructor hints for their many versions:

(*Edit:* image lost in translation)

## Future

There is probably more room to further improve the smart code completion. If you are using this functionality and you feel Godot should be able to somehow guess the type of the code you are writing, please write to us and we will make sure to add this scenario.

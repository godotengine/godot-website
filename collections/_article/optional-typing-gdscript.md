---
title: "Optional typing in GDScript"
excerpt: "Exposing the new addition to GDScript: optional type hints and all the perks it brings."
categories: ["progress-report"]
author: George Marques
image: /storage/app/uploads/public/5b1/f4f/b2f/5b1f4fb2f023a968578982.png
date: 2018-07-22 17:11:27
---

While GDScript is made with the ease-of-use in mind, many people wanted to add type information into their scripts. This helps avoiding potential bugs and also allows a better code completion. We're now introducing an additional syntax to add type hints to your GDScript code. It is completely optional and old scripts will work as they always did.

**Note:** This is a new feature in the *master* branch, and will be available in Godot 3.1.

## How the type hints can help?

It is quite common to use a variable only with values of the same type. With the dynamic nature of GDScript, you can inadvertently overwrite a variable with a different type and break your code logic in a way that might be hard to realize.

For instance, if your function expects a number, but you missed an input validation somewhere and is passing a string to it instead, you only will see an error at runtime (and only if you reach that point). In a larger code base, it's quite easy to miss things like that.

With type hints, Godot can know beforehand that you are passing the wrong type and show an error while you are editing the related code, even if you never run it.

## Syntax

This is quite a controversial topic (like tabs vs. spaces) and everyone has their own preference that's based on their background in other languages. We adopted a post-fixed type syntax that is very similar to Python (yes, Python has type hints too). This was chosen because GDScript is already similar to Python and this style is easy to integrate in the language parser, also considering that it is still optional.

For variables and constants, you can add a type hint with a colon (`:`) after the name when declaring it. Constants don't need type hints, since their type is inferred from the assignment, but you can add one as well:


```
const GRAVITY : Vector2 = Vector2(0, 9.8)
var power : float = 150.0
```

Type can be inferred from the assigned value if you add the colon (`:`) but omit the type. This can make the code more concise:

```
var direction_vector : = Vector2(1, 0)
# direction_vector is of type Vector2 because of the assigned constant
var my_sprite := $MySprite as Sprite
# my_sprite is of type Sprite because of casting
```

Functions follow the same syntax for the arguments. For the return type, you use a forward arrow (`->`) along with type before the colon to start the function body:


```
func my_func(arg1 : int, arg2 : String = "") -> void:
    return
```

Casting types is accomplished by using the `as` keyword. For built-in types, it errors out if it's not possible to convert. For objects it simply returns `null`:


```
var number_input : int = $LineEdit.text as int
var my_sprite : Sprite = $Sprite as Sprite
```

The type can be: a built-in Variant type (`int`, `Vector3`, `Color`, `Basis`, etc.); a core class (`Node`, `Resource`, `File`, etc.); a named constant that contains a Script resource (`const MyClass = preload("res://my_class.gd"`); a named script class (one made with the `class_name` syntax).

## Introducing the concept of "safe lines"

As suggested by our dear core developer reduz (Juan Linietsky), GDScript now has "safe lines" marked in the editor. The reasoning behind this is that the duck-typing should still work as it always did, so it's not possible to error if some variable or function is not defined on the accessed class.

Something very common is to tell an animation player to start like this:

```
$AnimationPlayer.play("walk")
```

With the type inference, Godot knows that `$AnimationPlayer` is a `Node` but can't tell which subtype it really is (in this case an `AnimationPlayer`). Since the `play()` function is not defined on the inferred type (Node), the engine don't know at this point if it really exists, nor the types for arguments and returns.

A statically typed language, such as C++ and C#, would force you to explicitly cast to the specific subtype, otherwise it would throw an error. So you'd need to do this:


```
($AnimationPlayer as AnimationPlayer).play("walk")
```

This is inconvenient most of the time for GDScript. Many times it's not even really needed. Instead of erroring out, the editor now shows a subtle greenish highlight in the lines that are safe according to type hints:

![Safe line highlight](/storage/app/media/safe-line.png)

Some users might find this *too* subtle. This is actually the idea: it should not stand out for people who aren't really interested in it. In any case, you can change the color in the editor settings and also disable the highlight if you prefer the old full-dynamic style.

## Code completion

The type inference code to provide completion candidates and function hints was rewritten. It fixed some long-standing annoying bugs. The experience is much improved, even if you are not using the type hints.

If your code has type hints, it provides a proper completion even across scripts. This includes singletons and scripts attached to other nodes in the tree.

## How it was implemented

Since many people seem to be interested in the devblogs, I'll add a section here explaining how I did the changes to enable the optional typing in GDScript.

### Tokenizer

The first part of parsing a language is to split the code in recognizable *tokens*. The symbols (`+`, `>=`, `|`), keywords (`if`, `func`, `class`), literal values (`2`, `"string"`), and identifiers ( `Vector2`, `Node`, `my_var`) are all changed to an abstraction This helps the next phase, since it won't need to deal with text anymore, but just a series of tokens. Then all whitespace and comments will simply be ignored and don't have to be taken into consideration.

The changes in the tokenizer are minimal, only to introduce the forward arrow symbol (`->`) and the casting keyword (`as`).

A peculiarity in the compiled scripts on export is that they are stored as a sequence of tokens. Using this new tokens in an old Godot version will cause a big problem. This is avoided by having a version number that was incremented with this change. So compiled scripts in this version won't run with older export templates (that's one reason why it's important to match editor and template version).

### Parser

The next step is make the new syntax be recognized by the parser. A parser takes the sequence of tokens and from them develop a tree structure. This tree resolves what each line is doing and also sorts out the order of operations based on their precedence.

The GDScript parser is relatively simple, so it's just a matter of understanding the small decisions it make to know what's a function declaration, what's a function call, what's an assignment, etc. I looked into the declarations of variables, constants, and functions to enable the parser to recognize the type hints (though it would simply discard them for now). The expression-parsing routine was also change to detect the casting operation.

Casting is a new type of node in the tree, since it'll be handled by the compiler in a particular way.

### Moving inheritance resolution

The old GDScript only resolved the inheritance when compiling the script, which only happens if you save the script and show errors only when you try to load it (i.e. not when you edit it). However, the parser needs this information to know the types of members declared in the parent.

I moved this code from the compiler to the parser (with all the needed adjustments). The compiler simply uses the information from the parser to avoid looking it again. There was also another change in the compiler to fix the order if you are using inner classes, allowing you to reference classes later in the file without problems.

### Static type checks

Now the parser makes the tree and determine the inheritance. Then a pass on the built tree is needed to check if the types used in the code are compatible or not. It is by far the biggest change in the code.

![Static type check](/storage/app/media/type-error.png)

This is done by looking into each statement and applying type-resolution and type-checks depending of the kind of statement. E.g. if it's an assignment, check if the expression type matches the variable being assigned. This also requires knowing what are the base types of the objects, which can be solved now that the inheritance is resolved in the parser itself.

Another required change is having autoload singletons loaded in the editor. This way the parser can look at them as well when trying to figure out the types. That change was added earlier with another pull request.

### New typed instructions

After the parser is done, changes are need in the compiler and the GDScript bytecode to support the type information. GDScript bytecode can be seen as kind of "machine language" that runs on top of the engine core. The compiler is responsible to take the parse tree and create this lower level code.

The new instructions allow a runtime-check in the types that could not be determined in the parser. Albeit this might make things *slower*, it guarantees that the variables will always have the proper type. Since it's different dealing with built-in types, core classes, and scripts, three new assignment instructions were created to deal with each of them. The same applies to the casting operation.

The compiler changes are required to make use of those new instructions, and also to handle the new type of parser node (for casting).

### Editor niceties

With the backend done, it was time to move into the editor. First and somewhat simpler, I added a colored highlight to the type hints, to help visualizing then in the code. Thanks to the work of Paul Batty ([Paulb23](https://github.com/Paulb23)) who isolated the syntax highlighter to the GDScript module, it was simpler to add this small change that didn't need to affect the core.

For the safe lines, however, it required a change in TextEdit and in the script editor to support it.

The completion code was rewritten. It was quite hacked since it grew organically over time, so it was hard to add new features to it. With the new code it can better make use of the type hints, and also fix some long-standing bugs that made the completion not so pleasant to use.

The new code use the old only as reference. The type inference was improved to consider some other cases (like the returned value from a function) and also to heavily rely on recursive structures, making it simpler to supported indexed variables and methods.

## Future

With optional typing, it's possible to improve GDScript further in other directions. Some of the benefits may also apply to people who are not using the type hints. The ideas for the futures are:
co
- Enable type hints for signals.
- Add a system to show warnings in the editor. This allows the game developers to catch things that are not invalid but may cause issues.
- New instructions for typed code to allow faster execution. This includes avoiding the Variant evaluator and using typed arrays as well.
- Further optimizations in the compiling stage to remove redundant instructions, reduce constant expressions to final constant, among other things.

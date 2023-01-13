---
title: "GDScript progress report: New GDScript is now merged"
excerpt: "New GDScript code is now merged. Here I talk a bit of what has changed, report what else I did this month and talk a bit about my current work and plans for the future."
categories: ["progress-report"]
author: George Marques
image: /storage/app/uploads/public/5f2/966/b6d/5f2966b6dca1a217164497.png
date: 2020-08-04 00:00:00
---

As some of you might be aware, the refactor that I have been working on lately is now [merged](https://github.com/godotengine/godot/pull/40598) into the `master` branch. This is the work explained in previous progress reports.

*See other articles in this Godot 4.0 GDScript series:*

1. [GDScript progress report: Writing a tokenizer](https://godotengine.org/article/gdscript-progress-report-writing-tokenizer)
2. [GDScript progress report: Writing a new parser](https://godotengine.org/article/gdscript-progress-report-writing-new-parser)
3. [GDScript progress report: Type checking is back](https://godotengine.org/article/gdscript-progress-report-type-checking-back)
4. (you are here) [GDScript progress report: New GDScript is now merged](https://godotengine.org/article/gdscript-progress-report-new-gdscript-now-merged)
5. [GDScript progress report: Typed instructions](https://godotengine.org/article/gdscript-progress-report-typed-instructions)
6. [GDScript progress report: Feature-complete for 4.0](https://godotengine.org/article/gdscript-progress-report-feature-complete-40)

## Main changes

While I did already open a pull request to [update the documentation](https://github.com/godotengine/godot-docs/pull/3623), I'll put here a short description of what have changed.

### Annotations

We now have annotation support and that is used to replace a few of the keywords that were introduced along the way. This includes the RPC keywords, such as `@master`, `@puppet`, and `@remote`.

The previous `export` keyword is now replaced by a list of specialized annotations for each case. For example, if you want a range, you can use the `@export_range` annotation. There's no need to set the type as an argument anymore, since it can be retrieved from the variable's type specifier (e.g. `@export var my_number: int`).

This has an added benefit because those annotations feature code completion and hints for their arguments, which makes them much easier to use without having to remember all the possible combinations like before.

This also includes an `@icon` annotation that must be used instead of adding after the `class_name` like before.

### Properties

The previous `setget` syntax was removed in favor of [properties](https://github.com/godotengine/godot-proposals/issues/844). It is meant to be more tied to the variable declaration and avoid you having to create dedicated functions (though you still can if you prefer). Another change is that, unlike `setget` properties always call their setter/getter even inside the same class. This gives users a consistent behavior which won't cause confusion or lead to potential mistakes during a refactor.

### `await` instead of `yield`

As you might already know, the `yield` keyword is removed in favor of `await`. It not only have a more meaningful name but it also takes advantage of first-class signals that were introduced in the `master` branch of Godot. The syntax is easier to understand and have less boilerplate (you don't need to write the `"completed"` signal when waiting coroutines.

It is also more transparent if the function you called doesn't always work as a coroutine (you don't need to treat the special case), and it's type-safe since you can't receive a function state when you were expecting the return value.

### `super` keyword

Instead of prefixing the function name with a period (`.`) now you must use the `super` keyword to call a function defined in the superclass instead of the overridden version. This also applies to constructors, making it more consistent in general and improving the flexibility.

Calling `super()` on its own will call the same function you are in but using the superclass implementation. If you need to call a different function you can use `super.function_name()`.

## Code completion

As mentioned in the previous report, code completion was a working in progress. Now it is essentially complete. I am aware that it could use some quality-of-life improvements, but this will be worked on later. For now it should be the same as it was before. If something is missing feel free to report an issue.

## Remove multi-level calls

Another common source of confusion was [removed](https://github.com/godotengine/godot/pull/40670). If you create an override of some lifecycle functions (such as `_process` or `_ready`) it still called the superclass implementation implicitly. Worse yet: some functions called the superclass before the subclass, and some went on the other direction.

This behavior is now completely removed. If you need to call the parent implementation, you can use the `super` keyword as mentioned above. This is common in <abbr title="Object-Oriented Programming">OOP</abbr> languages, so it should be more aligned to what user expects (which is evidenced by multiple issues reporting this behavior in the past). It also gives users control of _when_ the super implementation should be called.

Note that methods defined in the C++ code are still called. This is needed to make sure engine behavior is correct (like the button `_gui_input` which is needed to execute the pressing behavior).

## Testing

I spent a good chunk of the time testing GDScript implementation and fixed an amount of bugs and crashes along the way. If you find crashes or issues don't be afraid to [report it](https://github.com/godotengine/godot/issues) (if it wasn't reported before). Eventually I'll do a big round of bug fixes to stabilize it for release, but for now I'll try to keep GDScript in a workable state and especially without crashes.

## Future

Currently I'm working on an abstraction for the code generation interface. This will be helpful to create an ability to change the target backend language (which currently is only the GDScript VM itself) without having to change the compiler, eventually paving way to code optimization as well. More details on this will come in the next progress report.

After that I'll start adding typed instructions to the VM which should increase the speed massively for when you use static typing in the script.

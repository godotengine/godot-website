---
title: "GDScript progress report: Feature-complete for 4.0"
excerpt: "GDScript is now feature-complete for the upcoming Godot 4.0 version. This article goes through the last bits that were added: typed arrays, lambda functions, builtin static methods, plus a few extra changes for optimization and bug-fixing."
categories: ["progress-report"]
author: George Marques
image: /storage/app/uploads/public/60b/4f2/b0a/60b4f2b0a8130694314324.png
date: 2021-06-02 00:00:00
---

It has been a while since my last report. In my [last post]({{% ref "article/gdscript-progress-report-typed-instructions" %}}), I've mentioned GDNative, but since I've done only a bunch of "boring" stuff, I ended up not writing anything about it. Work on GDNative is not completed yet, so maybe I'll have something interesting to report later on. For now, let me show what was done on GDScript.

*See other articles in this Godot 4.0 GDScript series:*

1. [GDScript progress report: Writing a tokenizer]({{% ref "article/gdscript-progress-report-writing-tokenizer" %}})
2. [GDScript progress report: Writing a new parser]({{% ref "article/gdscript-progress-report-writing-new-parser" %}})
3. [GDScript progress report: Type checking is back]({{% ref "article/gdscript-progress-report-type-checking-back" %}})
4. [GDScript progress report: New GDScript is now merged]({{% ref "article/gdscript-progress-report-new-gdscript-now-merged" %}})
5. [GDScript progress report: Typed instructions]({{% ref "article/gdscript-progress-report-typed-instructions" %}})
6. (you are here) [GDScript progress report: Feature-complete for 4.0]({{% ref "article/gdscript-progress-report-feature-complete-40" %}})

### Typed arrays

One of the most requested features of GDScript is now implemented: [typed arrays](https://github.com/godotengine/godot/pull/46830). Now you can set the element type and let it be validated by the engine. That allows you to do safe operations with homogeneous arrays and also allow the language to optimize a few more code paths.

The syntax is inspired by Python, like most of the type system:

{{< highlight gdscript >}}

var my_array: Array[int] = [1, 2, 3]

{{< /highlight >}}

This allows you to easily change a regular array to typed and vice-versa without changing much code. You can also rely on type inference. If the array has elements of the same type, it will be inferred as typed:

{{< highlight gdscript >}}

var inferred_array := [1, 2, 3] # This is Array[int].

{{< /highlight >}}

Note that types that can't be validated at compile-time (when they are dynamic) will be validated at runtime, which might impact performance slightly if done regularly.

## Lambda functions

Improving the functional side of GDScript, now you can use [lambda functions](https://github.com/godotengine/godot/pull/47454) (or, more specifically, *function literals*). Those are inline functions that are assigned directly to an expression instead of being defined in the class. This is great for functions used only in a small context – like sorting an array or connecting to a signal – without polluting the class scope with those.

The syntax is pretty much the same as a regular function, only that it is placed where an expression should be:

{{< highlight gdscript >}}

func _ready():
    var my_lambda = func(x):
        print(x)
    my_lambda.call("hello")

{{< /highlight >}}

Note that the `.call()` is needed because lambdas are of type Callable.

You can also pass them as function arguments:

{{< highlight gdscript >}}

func _ready():
    button_down.connect(func(): print("button was pressed"))

{{< /highlight >}}

Lambdas can optionally have a name, which is used when viewing stack traces. They are also not limited to a single statement:

{{< highlight gdscript >}}

func _ready():
    var my_lambda = func this_is_lambda(x):
        print("Hello")
        print("This is %s" % x)

{{< /highlight >}}

Last but not least, lambdas can capture variables from the scope they are defined in. This means you can use variables from the outer function or the outer class inside the lambda. Those will be copied when the lambda is created at runtime and passed to function when it's called:

{{< highlight gdscript >}}

func _ready():
    var x = 42
    var my_lambda = func(): print(x)
    my_lambda.call() # Prints "42".

{{< /highlight >}}

The documentation will be updated to explain this in detail in the future.

### Static methods in built-in types

A while back, Juan added support for [static methods on built-in types](https://github.com/godotengine/godot/pull/46378). Now I've [added](https://github.com/godotengine/godot/pull/48767) this change to GDScript so these static methods can actually be called.

This is quite interesting because many times, we had to construct a value just to call a function on it. Now, the function can be called directly:

{{< highlight gdscript >}}

var x = Color.html_is_valid("00ffff") # true

{{< /highlight >}}

Note that in 3.x, you already can use this syntax for some cases (such as `Color.from_hsv()`) but it only works with `const` functions that return the same type as the base and that is actually constructing a value at runtime. In 4.0, this won't be valid anymore for these cases, but we can have actual static functions.

### Further optimizations

I've implemented a couple of things that will help improving GDScript performance (not directly, but we still plan to work on the VM performance before 4.0). Those are internal changes that won't affect the way you code, but I'll mention them here for completeness.

One of those is [reducing the number of addressing modes](https://github.com/godotengine/godot/pull/47727), which will help us eventually have instructions with addressing modes baked in. This will reduce branching in the code which is something CPUs enjoy. Having less modes means we can have less permutations of each instruction, reducing the complexity and code size.

The other is [using a special stack space for typed temporaries](https://github.com/godotengine/godot/pull/47956). This means that results of sub-expressions that are typed can be stored on the stack in a Variant without changing its type nor re-initializing it. This is particularly helpful on types that require memory allocation, such as Transform, since the allocation can be done only once per call.

### Test suite

To improve the quality of the GDScript code and avoid regressions over time, I've [added a test runner](https://github.com/godotengine/godot/pull/47701) that verifies if the language code is performing as intended. I've had some help from [Andrii Doroshenko](https://github.com/Xrayez) who ported my suite to use the new doctest integration, effectively making the tests for GDScript part of the general test for the engine.

We don't have a lot of test cases for now, but the number of tests will increase over time as tests are added together with bug fixes to avoid regressions.

### Bug fixing

I've now shifted the focus to bringing GDScript to a more usable state even before 4.0-alpha, so more users can test it to verify how it's working. For now, my focus are in the game-breaking bugs that stops people from even using GDScript. The small things can wait a bit longer to when we reach the bugfixing round after alpha is released.

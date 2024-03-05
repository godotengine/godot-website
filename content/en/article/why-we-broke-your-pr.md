---
title: "Why we broke your PR"
excerpt: "As some of you probably noticed a lot of PRs on the backlog now need a rebase because of PR 20137"
categories: ["progress-report"]
author: HP van Braam
image: /storage/app/uploads/public/5b5/90c/f2d/5b590cf2dac47927219311.jpg
date: 2018-07-25 23:30:00
---

As some of you probably noticed a lot of PRs on the backlog now need a rebase because of [PR 20137](https://github.com/godotengine/godot/pull/20137). This post is to explain why.

Godot has a copy on write or 'CoW' feature for a lot of its data structures. What this means in practice is basically that:

{{< highlight cpp >}}

Vector<int> vec1;
for (int i = 0; i < MAX_INT; ++i) {
  vec1.push_back(i);
}
Vector<int> vec2 = vec1;

{{< /highlight >}}

Is basically free, vec1 and vec2 will share memory and this basically takes no time. Also please don't write this code :).

Of course someone may take a a copy of a vector and modify it, or the original owner of the vector may want to write to it. At this point CoW comes into play. As soon as a write happens to either vec1 or vec2 we copy the contents and make the vectors unique.

The problem is that in the previous implementation of Vector this no longer worked. When Reduz implemented this compilers were able to deduce what overload to call based on the return type of a method. This is no longer possible so all calls to vector elements actually caused a copy on write. So we were basically doing a 'copy on read' instead of a 'copy on write'. Greatly increasing the cost of a read.

This has now been fixed. So the above code still works as-is:

{{< highlight cpp >}}

Vector<int> vec1;
for (int i = 0; i < MAX_INT; ++i) {
  vec1.push_back(i);
}
Vector<int> vec2 = vec1;

{{< /highlight >}}

However now the following **no longer compiles**
{{< highlight cpp >}}

vec1[200] = 20;

{{< /highlight >}}
Instead you need to write
{{< highlight cpp >}}

vec1.write[200] = 20;

{{< /highlight >}}

The .write proxy will work for read-only access as well, however a copy may be made. From now on it would be better to have a quick think about whether or not the use of the variable you're reading is constant or not. Particularly in loops. Look at [line 220 of visual_server_canvas.cpp for instance](https://github.com/godotengine/godot/blob/master/servers/visual/visual_server_canvas.cpp#L223). Using .write in this case would've worked but wouldn't have actually saved a CoW operation.

I'd also like to ask all PR reviewers to please be mindful of the correct use of .write from now on.

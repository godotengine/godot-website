---
title: "Major update for Visual Shaders in Godot 3.2"
excerpt: "With the Godot 3.1 release, the Visual Shader editor was recreated from the ashes of its Godot 2.x ancestor. While usable and packed with visual features, Visual Shaders lacked many features from their Shader (script) big brother. A new update has been prepared for Godot 3.2 to solve this problem."
categories: ["progress-report"]
author: Yuri Roubinsky
image: /storage/app/uploads/public/5ca/c31/576/5cac315766846559086274.png
date: 2019-05-22 08:48:46
---

With the Godot 3.1 release, the [Visual Shader editor](/article/visual-shader-editor-back) was recreated from the ashes of its Godot 2.x ancestor. While usable and packed with visual features, Visual Shaders lacked many features from their Shader (script) big brother. A new update has been prepared for Godot 3.2 to solve this problem.

My name is Chaosus, I'm the one of the core contributors of Godot, and I'm gladly presenting this update to our beloved engine. So, let's begin reviewing the new features.

## Members menu

The menu which the user used for adding nodes to the shader graph was the most unwieldy part of the old visual shader graph. This menu has been rewritten to a comfortable, tree-based popup.

![Tree-based popup menu](/storage/app/media/vshader2019/vshader1b.png)

As you can see, there are many categories inside, each one with subcategories filled with nodes.

![Categories and subcategories of the popup menu](/storage/app/media/vshader2019/vshader2.png)

If you are lost in this tree or want to find a specific node, you can use the search bar above the tree.

Once you've found the required node, you can add it to the graph by using drag and drop, pressing the Create button, hitting Enter, or double-clicking on the node in the tree.

![Drag and drop workflow](/storage/app/media/vshader2019/vshader_anim1.gif)

Also, this popup has the following properties:

- If you right-click on the graph, this menu will be called at the cursor position and the created node, in that case, will also be placed under that position; otherwise, it will be created at the graph's center.
- It can be resized horizontally and vertically allowing more content to be shown. Size transform and tree content position are saved between the calls, so if you suddenly closed the popup you can easily restore its previous state.
- The *Expand All* and *Collapse All* options in the drop-down option menu can be used to easily list the available nodes.

![Resize, expand and collapse](/storage/app/media/vshader2019/vshader_anim2.gif)

## New API and exposed scalar functions to Vector

There a bunch of new nodes added as the part of this update. Here are the lists of new nodes.

For `Scalar` and `Vector`:

- ACosH
- ASinH
- ATanH
- Clamp
- Degrees
- Distance
- Exp2
- Log2
- SmoothStep
- Step
- FaceForward
- Radians
- Reflect
- Refract
- RoundEven
- Trunc
- InverseSqrt
- Reciprocal
- OneMinus

Exposed to `Vector` from `Scalar`:

- Abs
- ACos
- ASin
- ATan
- Ceil
- Cos
- CosH
- Exp
- Floor
- Frac
- Log
- Round
- RoundEven
- Sign
- Sin
- SinH
- Sqrt
- Tan
- TanH

For `Transform`:

- TransformFunc
- Determinant
- Inverse
- Transpose
- OuterProduct
- Pre-component multiplication modes for TransformMult

For `Color`:

- ColorFunc
- Grayscale
- Sepia

Other:

- Expression
- Fresnel
- BooleanScalar
- BooleanUniform
- ScalarDerivativeFunc
- VectorDerivativeFunc
- If
- Switch

### Notes

- `Vector` now has all the `Scalar` functions which are executed per-component, e.g. *Round* will round all components. These can be used to achieve various effects.

![Per-component Vector function](/storage/app/media/vshader2019/vshader3.png)

- The majority of these new functions reuse standard nodes such as *ScalarFunc* or *VectorFunc* as a base. This is intended, for compactness.

- All the added nodes are compatible with pre-existing visual shaders. There should be **no problems** (i.e. no compatibility breakage) when converting existing visual shaders from 3.1 to the new system; just open it and continue to work.

## Input nodes

These nodes are helpers to link the associated input parameters in the *Input* node. Currently, they are subdivided in *All* (with input parameters which can be used in all three shader modes) and *Vertex/Fragment/Light* categories for comfortability.

![Input nodes](/storage/app/media/vshader2019/vshader4.png)

## Expression node

The *Expression* node allows you to write Godot Shading Language (GLSL-like) expressions inside your visual shaders! The node has buttons to add any amount of required input and output ports and can be resized. You can also set up the name and type of each port. The expression you've entered will apply immediately(after focus leaves out the expression text box) to the material, any parsing or compilation errors will be printed to the Output tab. The outputs are initialized to their zero value by default. The new node is located under the Special tab and can be used in all shader modes.

![Expression node usage](/storage/app/media/vshader2019/vshader_anim4.gif)
*This example gif shows you how to create and use it. It's quite simple as you can see.*

The possibilities of this node are almost limitless – you can write complex procedures, and use all the power of Godot (text-based) shaders, such as loops, `discard` keyword, extended types, etc. For example:

![Swirl shader example by LKS](/storage/app/media/vshader2019/vshader10b.png)
*Swirl shader code by LKS: https://www.reddit.com/r/godot/comments/90de7a/swirl_shader/*

**Many thanks K. S. Ernest Lee (iFire) for helping me fixing the bugs, testing and giving suggestions to create this feature!**

## Fresnel

The *Fresnel* node is designed to accept normal and view vectors and produces a scalar which is the saturated dot product between them. Additionally you can setup the inversion and the power of equation. Currently it is placed under Special menu section.

![Fresnel node usage](/storage/app/media/vshader2019/vshader11.png)

You can read more about this nice effect on [this blog post](https://www.dorian-iten.com/fresnel/)
or the dedicated [Wikipedia article](https://en.wikipedia.org/wiki/Fresnel_equations).

## Boolean node

The *Boolean* node was not exposed to the visual shaders until now. They can be converted to *Scalar* or *Vector* to represent `0` or `1` and `(0, 0, 0)` or `(1, 1, 1)` respectively. This property can be used to enable or disable some effect parts by one click.

![Boolean node usage](/storage/app/media/vshader2019/vshader_anim3.gif)

## Conditional nodes

The *If* node allows you to setup a vector which will be returned after performing comparison between *a* and *b*. There are three vectors which can be returned: *a == b* (in that case the *tolerance* parameter is provided as a comparison threshold – by default it is equal to the minimal value, e.g. `0.00001`), *a > b* and *a < b*.

![If node usage](/storage/app/media/vshader2019/vshader8.png)

The *Switch* node returns a vector if the boolean condition is *true* or *false*. Boolean was introduced above. If you convert a vector to a *true* boolean, all components of the vector should be above zero.

![Switch node usage](/storage/app/media/vshader2019/vshader9.png)

## Grayscale and Sepia nodes

These are useful effects which have been added to *ColorFunc* (a container for such effects), so there is no need to create them manually.

![Grayscale and Sepia node examples](/storage/app/media/vshader2019/vshader5.png)

## Per-component multiplication modes for TransformMult

![TransformMult multiplication modes](/storage/app/media/vshader2019/vshader6.png)

## Derivative nodes

These nodes are Fragment specific, and cannot be used in the Vertex mode context. They are put under the *Special* category tab and divided into *ScalarDerivativeFunc* and *VectorDerivativeFunc*.

![Derivative function nodes](/storage/app/media/vshader2019/vshader7.png)

## Testing these changes

All the above improvements have been made in Godot's *master* branch (the development branch for the future Godot 3.2). As of this writing, you have to build the compile the *master* branch [from GitHub](https://github.com/godotengine/godot/) or use one of the nightly builds provided by community members to test it.

That's all for now, in the future new types of nodes can be easily added to this new system (especially after Vulkan has been implemented), thanks to the magnificent possibilities provided by Godot's design!

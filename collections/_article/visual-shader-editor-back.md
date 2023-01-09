---
title: "Visual Shader Editor is back"
excerpt: "After some weeks of work, the new visual shader editor is ready for testing!"
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5b4/a6e/073/5b4a6e073cc9d628714213.png
date: 2018-07-14 00:59:00
---

After some weeks of work, the new visual shader editor is ready for testing!

## What is a visual shader editor?

This editor allows creating shaders using nodes and connections, instead of typing code. It provides a simple and fool-proof way for those not confident in writing shader code to create complex shaders.


![shader_edit1.png](/storage/app/uploads/public/5b4/a6a/ddd/5b4a6addd1e82963909951.png)


## Why was it gone in the first place?

This editor compiles to shader code. As the shader code format changed significantly between Godot 2.1 and 3.0, this editor no longer worked. The way it was programmed was also too hardcoded and it missed several key functions.

## What's different in the new one?

The new editor is not too different from the original one, but it's considerably more organized. The most significant changes are:

* New full PBR output nodes
* No more Vec3 <-> Scalar adapter nodes, conversion is automatic
* Easier input nodes for more organized graph.
* Extending it via scripting (creating custom nodes) is possible.
* Port previews (see blow)



![preview_ports.gif](/storage/app/uploads/public/5b4/a6c/003/5b4a6c0038ced706516053.gif)

## How do I create a visual shader material?

Here is a quick tutorial:

#### 1. Create a ShaderMaterial


![shadertuto2.png](/storage/app/uploads/public/5b4/a6c/693/5b4a6c6933274758343865.png)

#### 2. Create a Shader

![shadertuto3.png](/storage/app/uploads/public/5b4/a6c/b21/5b4a6cb214067677878892.png)


#### 3. Edit the Shader


![shadertuto4.png](/storage/app/uploads/public/5b4/a6c/f84/5b4a6cf84c360047819202.png)


#### 4. Add new nodes to the canvas!

Try to create something from the Add Node Menu:



![shadertuto5.png](/storage/app/uploads/public/5b4/a6d/53c/5b4a6d53c07af056194443.png)


.. and connect it to any of the outputs:



![shadertuto6.png](/storage/app/uploads/public/5b4/a6d/85e/5b4a6d85e9697002487680.png)


## Future

Eventually as we get feedback, the shader editor will keep improving. 

Remember that all this is possible thanks to the infinite generosity of our patrons. If you haven't already, please don't hesitate to [become one](https://www.patreon.com/godotengine)!
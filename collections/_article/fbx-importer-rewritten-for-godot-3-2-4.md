---
title: "FBX importer rewritten for Godot 3.2.4 and later"
excerpt: "Gordon MacPherson authored the new rewrite of the FBX importer in Godot 3.2. We had originally added alpha FBX support but this first version had many limitations for complex, commercial-grade models, especially around animations.
After a lot of debugging and research, the importer has been fully rewritten to better implement FBX support in Godot specifically, and vastly increase the compatibility with commercial FBX assets. This new importer will be available in the upcoming Godot 3.2.4, as well as Godot 4.0."
categories: ["progress-report"]
author: Gordon MacPherson
image: /storage/app/uploads/public/5fa/3f1/fd2/5fa3f1fd29135851685419.jpg
date: 2020-11-05 12:37:50
---

I'm Gordon MacPherson ([RevoluPowered](https://github.com/RevoluPowered)), a C++ contractor from the United Kingdom. I've worked in games for a while now, building upon general software development experience from electronics and RF equipment. I found Godot while working on personal game projects, and started being involved as a contributor a bit over a year ago. In particular, I was very lucky to work as a consultant at [Prehensile Tales](https://prehensile-tales.com/) for [IMVU](https://about.imvu.com/)'s Godot projects. This work involved adding support for the FBX 3D asset exchange format to Godot.

## First importer in 3.2, now rewritten

The first version of our FBX importer was [added in Godot 3.2](https://godotengine.org/article/here-comes-godot-3-2#3d-assets), and relied on the Open Asset Importer library ([Assimp](https://github.com/assimp/assimp/)). A lot of work was done at that time directly in the upstream Assimp project to improve the FBX support, but we hit roadblocks with the compatibility with Maya's FBX exports. Maya is one of the most used 3D assets creation tools in the game industry, and IMVU needed good support for its FBX files.

Due to these roadblocks, we decided to rewrite the importer fully and tailor it to Godot, instead of trying to keep things generic as done in Assimp - Assimp can importer dozens of file formats, which is great, but imposes many restrictions on the support of individual complex formats like FBX, especially for animations. In the game industry, a lot of people assume that FBX works with traditional animation algorithms but we found that it is simply not the case. FBX has its own standard for handling animations which has not been fully reverse engineered correctly by *any* open source importer/exporter, so we had to start from scratch and only keep the FBX file parser from Assimp.

We removed 70,000 lines of code and our new FBX importer comes in around 12,000 lines of code. The new code has been commented and documented with the things we learned about FBX along the way. It's made so we can make changes easily and improve behaviour on a per-file basis along the road. We expect bugs with the beta, even some regressions which we have seen already, but we are working on fixes to the reported problems to be ready for the 3.2.4 stable release.

It took us about 14 months to get a proper FBX importer working fully, since we had to engineer everything again:

- We rewrote all the mesh code to support all formats of FBX meshes correctly.
- We built an entire abstraction for the FBX transform information, which was a very complex and convoluted undertaking to get working properly.
- We designed a better handler for the animations which can compensate for the complex transform information, which means that we can handle animations correctly.

Our ethos for the importer ended up being: When you import a FBX file, it should import flawlessly like you intended it to be when exporting. This was the new design goal of the importer to ensure we had SOLID importing ability for commercial FBX files and for your own files too!

This complete rewrite has now been merged in the `3.2` branch with [GH-42941](https://github.com/godotengine/godot/pull/42941). We'll focus first on fixing reported issues with the new importer so that it's ready for release in Godot 3.2.4 stable (it will soon be available for testing in 3.2.4 beta 2). Once fixes have been made, we'll also update the foward port to the `master` branch to ensure that the new importer is also available in Godot 4.0.

## So, for the uninitiated, what is FBX?

FBX is the industry-standard 3D asset exchange file format for games. It is developed by Autodesk as a proprietary format and thus not a great philosophical match for Godot, but given its widespread use, we want to support it nevertheless. We're also [hyped about and support glTF 2.0](/article/we-should-all-use-gltf-20-export-3d-assets-game-engines), which is the open source new kid on the block, and thus brilliant for our engine (and especially the Blender pipeline). But a caveat of glTF 2.0 is that it's not officially supported by Autodesk software, which many use for content creation in the game industry.

**FBX has been through 24 years of usage in the game industry.** With its [first revision being back in 1996](
https://en.wikipedia.org/wiki/FBX), this means it's super well tested and pretty much available everywhere by default.

Supporting it is a must, for compatibility with the big wigs but also with the software you might want to try out.

## Whoa, it's been over a year. Why did it take so long?

Reverse engineering a lot of the functionality required to make FBX work properly was very hard. For 2 months we were stuck understanding how pivots mattered in the file format, why they were used internally and where they are supposed to be applied in the animations. Most <abbr title="Free and Open Source Software">FOSS</abbr> tooling could not properly import FBX files or had horrible bugs.

We found the available information to being completely wrong in some cases for determining the skin, bind pose and skeleton information along with animations. It was a nightmare initially, and turned out to be quite time consuming. But we got through and sorted it out, persistence was key.

At some stages we were unsure how the project would get completed and had doubts but we kept hammering away, and eventually, we found a path through in March 2020. Slowly but surely functionality started working bit by bit.

The main problem FBX is that it's closed source, and therefore the official FBX SDK is a black box. It just gives you values and you don't know why it is that value, you just have to trust that it's correct. This means that for some functionality, we literally had to use trial and error to figure out the implementation. Looking at what other importers did was also a serious help.

## Some cool things about FBX

* It does partial updates like a database and won't rewrite the entire file when you make a small change. This is good when you don't want to accidentally break an exported file.
* It handles bones, with a truly robust ID and targeting system which can work easily without relying on path information for bones.
* It supports various unit formats.
* Images can be embedded in the FBX file.
* It's supported by default in most packages for 3D modelling.

## Why did you decide not to use the FBX SDK?

In short, we wanted to add official support directly in the engine, and Godot being open source, it can not (and should not!) depend on any proprietary component. Integrating the proprietary FBX SDK could have been done as a thirdparty plugin, but it would not be officially maintained by the Godot team. It's not just licensing though, here's what motivated the decision not use the Autodesk FBX SDK:

* It's not open source, which is a deal-breaker as mentioned above.
* It's much larger than our importer, we only net 12,000 lines of code (the FBX SDK is over 50 MB - that's bigger than Godot!).
* We can't modify the behaviour to improve performance or increase flexibility.
* Our importer is faster than the official SDK.
* It requires a lot of work. Much like the work we have done with FBX we'd just be repeating work for example with mesh conversion.
* It's a bad move to support it if we don't know what the code is doing, especially when we care about importing things optimally, especially for creating a reliable 3D workflow.
* We have already added proper support for complex features like Segment Scale Compensation, which e.g. [Unity currently does not support directly into the engine](https://knowledge.autodesk.com/support/maya/troubleshooting/caas/simplecontent/content/turning-segment-scale-compensate-maya-how-to-make-maya-rigs-play-nice-unity.html).

## Research & development

How much coding went into this? Less coding than you would think. A lot of the time was establishing why standard algorithms do not solve FBX problems, and in this process we came to the conclusion that FBX does things in a different way to most other formats. For good reasons though, the linear skinning method used in the format is in short absolutely genius. Most of the work was learning about FBX and how it worked, and cross comparing the results across many many many versions of the importer.

Pivots are hard. The formula is simple but their application in the correct places required months of reverse engineering, especially when dealing with animations

We rewrote the importer approximately 4 times during my work on it. Before my involvement, it was rewritten twice by Ernest Lee ([fire](https://github.com/fire)) with help from Juan Linietsky ([reduz](https://github.com/reduz/)), and Assimp had done an astounding job at learning what they did with the time and resources they had.

## Testing & validation

[IMVU](https://about.imvu.com/), who sponsored this work, had a validation team confirming that their Maya models were working correctly, and testing and helping me fix bugs. This means that we know it's good enough for animators and modellers to use in a Maya environment.

Thousands of models we use have been validated in Maya, mostly with default export settings in the application. If you find something which doesn't work, please [file a bug report](https://github.com/godotengine/godot/issues) so we evaluate if we can add support for it.

## Funding

[IMVU](https://about.imvu.com/) not only paid for me to work on this for a year or more but paid for hundreds of hours from various teams internally. Some of the QA engineers also validated the FBX importer in the engine in multiple Godot projects using FBX assets.

Even when the project was stagnated due to research walls (pivot applications) and proprietary information (secret sauce), they continued to support the project. We had many people in the community at our workplace make test assets and validate a lot of models. It was a huge undertaking for them.

Be sure to give [@imvu a follow](https://twitter.com/imvu). We are working in house on some projects in Godot Engine and you can follow us on our journey.

## My personal journey

During this project I had gaps in my knowledge which were filled in with time and experience. Many talented people helped me fill these gaps quickly, and learning from trial and error helped a lot in those cases where things were done "the FBX way", instead of the usual way.

In some cases, FBX did not do what people would consider reasonable.

After researching these methods for pivots and various parts of the skinning, I have found them to improve the behaviour in most cases. Now the differences make a lot of sense to me, even if they are complex.

## Future plans

* Finish porting the rewrite to Godot 4.0 (we use the `3.2` branch in production, so that's where this was developed and quality controlled by many users).
* Locator bones. Right now, you need to bake your animation before exporting.
* Improve material mappings (most are supported, some need mapping).
* Fix bugs in the beta phase, we expect them.

## Known issues

* Sometimes skins will inflate larger than they should be due to ‘remove unused influences setting' in Maya, for now, disable this option in Maya, or you can go to Mesh -> Skin -> Clear temporarily, I expect a fix to land in the next week or so for this problem.
* Some materials might have some properties needing to be fine-tuned, but can be easily fixed.
* It's going to be in the beta release, we will test this and resolve regressions we find with existing projects.

## Huge thanks to:

* Everyone at [IMVU Inc](https://about.imvu.com/), you did an amazing job helping with FBX and ensuring its success. You made Godot have a commercial-grade FBX importer, thank you so much for spending the time and money getting this to be a reality for 2020.
* All the people who helped me debug issues, who helped with various logic and also to the Godot core development team.
* A big shoutout to [Prehensile Tales](https://prehensile-tales.com/) for helping me through the tough FBX project, especially HP van Braam who has been an amazing employer and great person to me personally and professionally.
* Andrea Catania for his amazing work improving our mesh creation code and helping fix hard to find bugs.
* Ernest Lee for his continued support and information, along with helping me get to grips with Godot codebase and many many other things, including the first prototype for the importer :)
* Juan Linietsky for being there when I needed to ask complex questions on his time.
* Rémi Verschelde for helping with the review process and being super helpful.
* [Assimp](https://github.com/assimp/assimp/) for providing an amazing template of a MVP importer which we could improve drastically, Kim Kulling and the various developers who worked on the FBX parser.
* Clay John for helping fix the Z-fighting issue with transparent layers from FBX in the NVIDIA bistro, and for doing the fix in the upstream engine <3
* Ilaria Cislaghi for being a massive help when finding bugs which are hard to spot.
* Everyone who helped on the various PRs with memory leaks and issues.
* I guess my cat too ;)

That's it! As a reminder, the code for the new importer is in [GH-42941](https://github.com/godotengine/godot/pull/42941), and it will be available for testing in Godot 3.2.4 beta 2 in coming days. We're looking forward to your testing results and bug reports!

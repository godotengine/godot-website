---
title: "Dev snapshot: Godot 3.0 alpha1"
excerpt: "There is still a long way to go to finalize Godot 3.0 and release it publicly, but we are now ready for some broader testing of the alpha version. The first alpha build comes with many known issues, but also a lot of interesting (and undocumented) features to experiment with and debug."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/597/8e2/fc4/5978e2fc4ffb4676085667.jpg
date: 2017-07-26 18:44:02
---

After almost one year of development, the *master* branch (future Godot 3.0) is mostly feature-complete and ready for broader testing by the Godot community. We are therefore releasing a first alpha snapshot for existing users to play with and report bugs.

## Disclaimer

**IMPORTANT: This is an [*alpha*](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha) build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.0 would be on its release.**

There is still a long way of bug fixing and usability improvement until we can release the stable version, and this release comes with virtually *no documentation*. This release is exclusively for testers who are already familiar with Godot and can report the issues they experience [on GitHub](https://github.com/godotengine/godot/issues/).

There is also no guarantee that projects started with the alpha1 build will still work in alpha2 or later builds, as we reserve the right to do necessary breaking adjustments up to the *beta* stage. Finally, the desktop platforms (Linux, macOS, Windows) are the only ones in a usable state, Android, iOS, UWP and JavaScript all need further fixes to properly support the new Godot 3.0 features.

**Note:** New Godot users should *not* use this build to start their learning. Godot 2.1 is still supported and [well documented](http://docs.godotengine.org/en/stable/)

## The features

Now, there are still some cool features that can already be played with in this alpha1 build, and we are looking forward to seeing what you will come up with using the new 3D renderer. There is no exhaustive listing of all the new features to experiment with, but you can read past articles of [this blog](/news) and check Juan's [Twitter feed](https://twitter.com/reduzio) for some teasers :)

Please use the [community channels](/community) to discuss with existing users and learn how to use the new workflows of Godot 3.0 - as of this writing there is almost no documentation on the new features, but this alpha1 build should serve as a starting point for documentation writers.

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusion for new users. Instead, browse one of our mirrors and download the editor binary for your platform and the export templates archive:

- [Mirror 1 (HTTPS)](https://downloads.tuxfamily.org/godotengine/3.0/alpha1)
- [Mirror 2 (HTTP)](http://op.godotengine.org:81/downloads/3.0/alpha1)

Also clone the [godot-demo-projects](https://github.com/godotengine/godot-demo-projects/) repository to have demos to play with. Some of them might still need adjustments due to recent changes in the *master* branch, feel free to report any issue.

## Bug reports

There are still many open bug reports for the 3.0 milestone, which means that we are aware of many bugs already. We still release this snapshot to get some early feedback while we work on fixing the known issues.

As a tester, you are encouraged to open bug reports if you experience issues with alpha1. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

You can also consult this list of [known issues](https://pad.sfconservancy.org/p/godot3-alpha-known-issues), which is a hand-picked list of the most visible problems you will likely encounter.

## FAQ

We can already see many questions coming regarding this development snapshot, so here are some answers.

#### What is the ETA for Godot 3.0 stable?

*When it's ready.* We're all working on our free time on this project, and can't commit to a given deadline. We consider the *master* branch to be feature-complete, and we are now working on fixing bugs in the new features and enhancing the usability of the new workflows. Depending on how it goes, we may be able to release 3.0 stable in a couple of months.

#### Does it support C#?

No, the alpha1 build does not contain the [Mono/C# module](https://github.com/neikeq/GodotSharp) yet. It should soon be merged in the *master* branch, so it might be available in alpha2. The 3.0 stable release *will* support C#, the integration is almost ready.

#### Does it support Vulkan?

No, and there are no plans for Vulkan support for the time being. Our resources are too limited to focus on too many renderers at the same time, and the new OpenGL ES 3.0 / OpenGL 3.3 renderer of this build was already a huge refactor. Vulkan being only relevant for a small fraction of our users, it's low priority for now.

#### How to run my 2.1 game in the alpha?

Projects from Godot 2.1 are not compatible with Godot 3.0, as many things changed in the Godot API as well as in GDScript. There is no porting guide for now, but there is an export tool in Godot 2.1.3 and later which can be used to export 2.1 games to the formats expected for Godot 3.0.

Since the *master* branch is a moving target, the exporter in Godot 2.1.3 is already outdated and won't work as smoothly as it should. Your best bet is to compile the [2.1 branch](https://github.com/godotengine/godot/tree/2.1) yourself to use the latest version of the exporter, and report any issue you experience with it.

#### How to use GDNative?

As for most features, it lacks documentation for now. Still, you will find some infos on the [godot_headers](https://github.com/GodotNativeTools/godot_headers) main repository, as well as the [CPP bindings](https://github.com/GodotNativeTools/cpp_bindings). You can use the [Q&A](/qa) with the *gdnative* tag to mark your questions; karroffel will do all she can to help you get started.

#### Will there be more alpha builds?

Yes, as the name "alpha1" suggests, we plan to have newer builds regularly to bring the latest state of the *master* branch. Depending on the user feedback we get, we might make weekly releases or biweekly if it proves too much burden.

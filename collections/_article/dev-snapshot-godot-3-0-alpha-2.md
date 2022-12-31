---
title: "Dev snapshot: Godot 3.0 alpha 2"
excerpt: "One step closer to the release of Godot 3.0! With this alpha 2 development snapshot, Godot users will be able to preview the upcoming C# support and continue testing the advanced 3D features introduced in Godot 3.0. This snapshot is of course expected to be buggy and unstable, so please be aware that it does not reflect the final state of what Godot 3.0 will be like."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/59f/8c3/c91/59f8c3c91a87f065753289.png
date: 2017-10-31 18:23:17
---

A little treat (or is it a trick?) for our community on this Halloween eve: Godot 3.0 *alpha 2* is out, ready for your testing! It's already been 3 months since our previous [official development snapshot](/article/dev-snapshot-godot-3-0-alpha-1), and lots of bugs have been fixed, making us one big step closer to the final 3.0 *stable* release.

It's also the first build to include the long awaited support for the C# programming language using [Mono](http://mono-project.com/)! This is of course still pretty rough, though usable, and we are looking forward to your feedback and bug reports. Some caveats are documented below as well as in the [introduction blog post](/article/introducing-csharp-godot), so make sure to read them before filing issues.

## Disclaimer

**IMPORTANT: This is an *[alpha](https://en.wikipedia.org/wiki/Software_release_life_cycle#Alpha)* build, which means that it is *not suitable* for use in production, nor for press reviews of what Godot 3.0 would be on its release.**

There is still a long way of bug fixing and usability improvement until we can release the stable version, and this release comes with incomplete documentation: the in-editor and [online Class Reference](http://docs.godotengine.org/en/latest/) is quite complete thanks to the awesome work of our documentation team, but there aren't many tutorials about using Godot 3.0 yet. For the Mono build, there is no specific documentation yet. This release is exclusively for testers who are already familiar with Godot and can report the issues they experience on GitHub.

There is also no guarantee that projects started with the alpha 2 build will still work later builds, as we reserve the right to do necessary breaking adjustments up to the *beta* stage.

**Note:** New Godot users should *not* use this build to start their learning. Godot 2.1 is still supported and [well documented](http://docs.godotengine.org/en/stable/).

## The features

Since the previous alpha build, there have been hundreds of bugs fixed, as well as many usability enhancements to make the new features as easy to use as possible.

There was also a [strong focus on the documentation](https://godotengine.org/article/first-godot-3-docs-sprint-sept-9), with the Class Reference close to 70% complete now (which is already much higher than the completion level of the 2.x API documentation).

### Quick Mono howto

Of course, the main feature many have been waiting for is the Mono support. It comes in separate binaries with an additional system requirement: the Mono SDK. You need to install the [current stable version](http://www.mono-project.com/download/) of Mono to use with Godot, as you will be developing applications which require the .NET Framework.

If you installed Mono in the classical system directories (using the upstream macOS or Windows installers, or the Linux repositories), everything should work out of the box.

If you installed Mono in a specific directory, things might get a bit more complex. You can override the `MONO_PATH` environment variable to point to the location of your .NET Framework 4.5, typically `/path_to_mono_root/lib/mono/4.5/`. You will also need `msbuild` in your `PATH`, so if you installed it in a location which is not included in the `PATH`, you can either override the latter or create a symbolic link.

## Downloads

The download links are not featured on the [Download](/download) page for now to avoid confusing new users. Instead, browse one of our mirrors and download the editor binary for your platform and the export templates archive:

- Classical version: [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/alpha2)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/alpha2)]
- Mono version (requires the Mono SDK): [[HTTPS mirror](https://downloads.tuxfamily.org/godotengine/3.0/alpha2/mono)] [[HTTP mirror](http://op.godotengine.org:81/downloads/3.0/alpha2/mono)]

**Note:** Export templates are currently missing due to a last minute regression in the HTML5 platform (**Edit 2017-10-31 23:00 UTC:** They are now available for the classical version).
Export templates for the Mono flavour will not be provided, as exporting Mono games is not completely implemented yet.

Also clone the [godot-demo-projects](https://github.com/godotengine/godot-demo-projects/) repository to have demos to play with. Some of them might still need adjustments due to recent changes in the *master* branch, feel free to report any issue.

## Bug reports

There are still many open bug reports for the 3.0 milestone, which means that we are aware of many bugs already. We still release this snapshot to get some early feedback while we work on fixing the known issues.

As a tester, you are encouraged to open bug reports if you experience issues with alpha 2. Please check first the [existing issues](https://github.com/godotengine/godot/issues), using the search function with relevant keywords, to ensure that the bug you experience is not known already.

Have fun with this alpha 2 and stay tuned for future, more stable releases :)
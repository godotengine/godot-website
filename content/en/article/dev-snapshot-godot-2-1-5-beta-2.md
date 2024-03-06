---
title: "Dev snapshot: Godot 2.1.5 beta 2"
excerpt: "One step closer to releasing 2.1.5 (our \"old stable\" branch) with this new beta 2 build! If you are still working with Godot 2.1 for any reason, make sure to give it a try and ensure that your projects still work as intended. If all goes well we will soon make a release candidate build and then the stable one."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5aa/a32/458/5aaa324584dc2378307816.png
date: 2018-03-15 09:01:21
---

As mentioned in a [previous blog post]({{% ref "article/dev-snapshot-godot-2-1-5-beta-1" %}}), we plan to continue supporting the 2.1.x branch for a while - at least until 3.1 is released, bringing back support for low and mid-end mobile and low-end desktop GPUs via OpenGL ES 2.0 / OpenGL 2.1.

The feedback on the previous 2.1.5 beta 1 build was relatively good, and many fixes have been done since, especially to the (still imperfect, but better) tool to convert 2.1 projects to the Godot 3 API.

## Godot 2.1.5 incoming

The previous stable version, Godot 2.1.4, was released in August 2017. Since then, there have been over 300 commits to the *2.1* branch, with bug fixes, enhancements, and even some new features.

We'll go over the changes more in-depth in the actual release announcement, but until then, we need testers for this new beta 2 build! [Download it](https://download.tuxfamily.org/godotengine/2.1.5/beta2/) and test it with your existing 2.1 projects (make sure to do backups or use version control, as always). If you spot any regression (i.e. something that worked fine in 2.1.4 and is now broken), please make a bug report and mention it in the [tracker bug](https://github.com/godotengine/godot/issues/16813).

- [**Download repository**](https://download.tuxfamily.org/godotengine/2.1.5/beta2/)
- [Tracker bug for regressions](https://github.com/godotengine/godot/issues/16813)

Happy bug hunting!

## Godot 3.1 making good progress

In parallel, work on Godot 3.1 is still ongoing. Support for OpenGL ES 2.0 / OpenGL 2.1 **for 2D** was merged in the *master* branch recently, and [karroffel](https://github.com/karroffel) is now focusing on the more complex 3D part.

Juan ([reduz](https://github.com/reduz)) implemented initial support for 2D meshes, and is now quite busy with preparations for GDC, where he will meet many companies as well as give a talk during our [GDC Meetup]({{% ref "article/join-us-gdc-during-godot-meetup-2018" %}}) at the GitHub HQ.

Other contributors are still quite active, and we're slowly but surely reducing our backlog of [awesome pull requests](https://github.com/godotengine/godot/pulls) done by the community over the last couple of months.

There is still no ETA for 3.1, but basically we will wrap it up as soon as the 3D support via OpenGL ES 2.0 / OpenGL 2.1 is ready for production use.

## Godot 3.0.3 in a few weeks

We will continue pushing bug fixes and improvements in a forward compatible way to the 3.0 branch (i.e. you should be able to use the newer versions on your existing 3.0.x project without logic change). Hein-Peter ([TMM](https://github.com/hpvb)) did a great job so far on [3.0.1]({{% ref "article/maintenance-release-godot-3-0-1" %}}) and [3.0.2]({{% ref "article/maintenance-release-godot-302" %}}), and will continue doing so!

Unless regressions or critical bugs dictate it, we plan to have maintenance releases once a month or so, to keep you up-to-date with the latest and greatest in the stable branch.

Keep having fun working with Godot, and don't hesitate to showcase your work on social media using the [#GodotEngine](https://twitter.com/hashtag/GodotEngine) hashtag!

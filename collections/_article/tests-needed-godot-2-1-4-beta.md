---
title: "Tests needed for Godot 2.1.4-rc"
excerpt: "Today's beta build for the upcoming Godot 2.1.4 version brings two months worth of development, including both bug fixes and new features, some of which potentially bolder than usual - with the long wait for Godot 3.0, many 2.1.x users grow restless and push to get the latest and shiniest included in the stable branch ;) As such, testers needed to make sure everything works flawlessly!"
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/594/ffc/f90/594ffcf90df4b624442486.jpg
date: 2017-06-25 18:14:52
---

**Edit 2017-08-25:** Here's finally the release candidate build. WinRT templates are still missing, but they're not blocking for the release given that they are experimental.

- [~~Download the RC build~~](https://github.com/godotengine/godot-builds/releases/2.1.4-rc/)
- [~~Check the detailed changelog since 2.1.3~~](https://github.com/godotengine/godot-builds/releases/2.1.4/rc-Godot_v2.1.4-rc_changelog.txt)
- [~~Check the changelog diff since the 2017-07-31 build~~](https://github.com/godotengine/godot-builds/releases/2.1.4/rc-Godot_v2.1.4-rc_changelog_since_20170817.txt)
- [Report regressions on GitHub](https://github.com/godotengine/godot/issues/) so that they can be fixed before the stable release.

-----

**Edit 2017-08-17:** And another beta build, probably the last one before the release candidate. Note that WinRT templates are missing in this build, will be fixed for the RC.

- [~~Download the 2017-08-17 build~~](https://github.com/godotengine/godot-builds/releases/2.1.4/beta-20170817/)
- [~~Check the detailed changelog since 2.1.3~~](https://github.com/godotengine/godot-builds/releases/2.1.4/beta/20170817-Godot_v2.1.4-beta_20170817_changelog.txt)
- [~~Check the changelog diff since the 2017-07-31 build~~](https://github.com/godotengine/godot-builds/releases/2.1.4/beta/20170817-Godot_v2.1.4-beta_20170817_changelog_since_20170731.txt)
- [Report regressions on GitHub](https://github.com/godotengine/godot/issues/) so that they can be fixed before the stable release.

-----

**Edit 2017-07-31:** Time for another beta build, with one month's worth of further improvements and especially fixes for various regressions found in the 2017-06-25 build:

- [~~Download the 2017-07-31 build~~](https://github.com/godotengine/godot-builds/releases/2.1.4/beta-20170731/)
- [~~Check the detailed changelog since 2.1.3~~](https://github.com/godotengine/godot-builds/releases/2.1.4/beta/20170731-Godot_v2.1.4-beta_20170731_changelog.txt)
- [~~Check the changelog diff since the 2017-06-25 build~~](https://github.com/godotengine/godot-builds/releases/2.1.4/beta/20170731-Godot_v2.1.4-beta_20170731_changelog_since_20170625.txt)
- [Report regressions on GitHub](https://github.com/godotengine/godot/issues/) so that they can be fixed before the stable release.

-----

**Original 2017-06-25 post:**

Already more than 2 months since the last maintenance release in the 2.1 branch, and many bug fixes as well as new developments have made it to that branch.

Some of those new developments being slightly more experimental than we use to merge in the stable branch, the upcoming 2.1.4 release will need some heavy testing from the community to make sure it does not bring regressions.

So now's your time to shine:

- [~~Download today's beta build~~](http://download.tuxfamily.org/godotengine/2.1.4/beta/20170625/) and test it extensively on your projects, both the editor and the exported games (make sure to install the corresponding templates).
- [~~Check the detailed changelog~~](http://download.tuxfamily.org/godotengine/2.1.4/beta/20170625/Godot_v2.1.4-beta_20170625_changelog.txt) to see what changed since 2.1.3 and should therefore be tested thoroughly.
- [Report regressions on GitHub](https://github.com/godotengine/godot/issues/) so that they can be fixed before the stable release.

What are **regressions**? They are bugs that did not occur in the previous stable release (2.1.3) but which can now be experienced in the beta build. You can also report bugs in the new features of 2.1.4, which, even if not strictly speaking regressions, should be worth looking into before the release.

*Note:* In this build the 32-bit Linux binaries are missing (both for the editor and the export templates) due to a buildsystem issue; this will be fixed before the stable release.

Happy testing, and thanks for your help!

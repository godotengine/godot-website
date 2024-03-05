---
title: "Dev snapshot: Godot 2.1.6 RC 1"
excerpt: "It's been a long time since our previous release in the 2.1 branch! The upcoming 2.1.6 release is intended to address new requirements from Google Play and Apple store, as well as update thirdparty libraries to recent versions to fix known security vulnerabilities (in particular in libpng and openssl)."
categories: ["pre-release"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5cf/69b/132/5cf69b132699d052649367.png
date: 2019-06-04 17:28:31
---

It's been a long time since [our previous release](/article/maintenance-release-godot-2-1-5) in the 2.1 branch!

"Wait," I hear you say, "is the 2.1 branch still maintained 3 years after its first release?"

The answer is yes, on a "best effort" basis and focusing on release critical and security issues. What we consider "release critical" are issues which prevent people using Godot 2.1.x in production from releasing or updating their game, such as crash issues and adapting to the changing requirements of distribution platforms (mainly Google Play and Apple Store).

The upcoming 2.1.6 release is intended to address new requirements from Google Play and Apple store, as well as update thirdparty libraries to recent versions to fix known security vulnerabilities (in particular in libpng and openssl).

Google Play now mandates the support of its two 64-bit architectures, `arm64v8` and `x86_64`. The former was already included in Godot 2.1.5, but `x86_64` was missing and added first in Godot 3.1-stable. The templates for this architecture are now also included in Godot 2.1.6 RC 1, and will be included in an upcoming Godot 3.0.7 for the same reason.

Apple Store now requires binaries compiled against the iOS SDK 12.1 or later to support the latest iterations of its OS, so new binaries were also needed.

### Who is this for?

As mentioned above, this new release is made for people using Godot 2.1.x in production. Many users started projects years ago with Godot 2.1 and are still developing them, about to release them or need to ship updates. Upgrading to Godot 3.0 or later is not straightforward due to various compatibility breakages that we did at the time, so these users need long term support.

If you want to start a new project, there is no reason to use Godot 2.1.6 which is based on a 3 years old code branch. You should instead use the [latest stable release](/download) to benefit from all the new features and bug fixes included over the years.

### Download

As a reminder, Godot 2.1.x does not have an export templates downloader, so you should make sure to download both the editor binary for your platform and the templates archive (`.tpz` file), and install these templates using the dedicated editor feature. You should **not mix versions**, i.e. using a 2.1.6 editor binary with 2.1.5 templates or the other way around. Export templates should match the exact commit used to build your editor binary.

Please test this release candidate on your 2.1 projects and make sure that both the editor and the exports work as expected. If you could test the upload of Android or iOS games to Google Play/Apple Store to confirm that they pass the platforms' requirements, this would be very helpful too.

Please report any regression (a new bug in 2.1.6 RC 1 that you did not have in 2.1.5) or blocking bug in this [tracker bug report](https://github.com/godotengine/godot/issues/29484).

- [Download repository](https://download.tuxfamily.org/godotengine/2.1.6/rc1/)
- [Changelog](https://downloads.tuxfamily.org/godotengine/2.1.6/rc1/Godot_v2.1.6-rc1_changelog.txt)
- [Tracker bug report for regressions](https://github.com/godotengine/godot/issues/29484)

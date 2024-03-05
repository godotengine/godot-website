---
title: "Godot APK Fixer tool"
excerpt: "We have released a tool to repair APK files released with older versions of Godot. A fix for this will also be integrated in upcoming Godot releases."
categories: ["news"]
author: HP van Braam
image: /storage/app/uploads/public/5b1/962/b00/5b1962b00413a990510141.png
date: 2018-06-07 00:00:00
---

As previously mentioned [in this blog post](https://godotengine.org/article/fixing-godot-games-published-google-play) the Godot placeholder permissions are causing some issues on the play store. We are working on fixing this for future versions of Godot but games stuck on older versions have to do a bit of work to get their games showing up on the Play store again.

To aid developers with these types of games we've created a tool that can fix an existing APK without any need to rebuild it. The tool can be downloaded at [https://downloads.tuxfamily.org/godotengine/apkfixer/](https://downloads.tuxfamily.org/godotengine/apkfixer/) for Windows, Linux, and Mac.

The things you will need are:
 * Your original APK
 * A valid android keystore
 * Jarsigner

The tool takes several command-line options:
* -j */path/to/jarsigner*
* -k */path/to/keystore*
* -p *keystore password*
* -a *key alias*
* */path/to/apk*

You should be able to recover these settings from the Android export settings of the original game project from the Godot editor.

An example run of the program looks like this:

{{< highlight bash >}}

./godotapkfixer -k ~/tmp/and/debug.keystore -p android -a androiddebugkey GOLTORUS.apk

{{< /highlight >}}

This is assuming that 'jarsigner' exists in $PATH, or on Windows if the Android studio is installed. If this is not the case the tool can be ran like this:

{{< highlight bash >}}

godotapkfixer.exe -j "C:\Program Files\Java\jdk1.8.0_171\bin\jarsigner.exe" -k "debug store.keystore" -p android -a androiddebugkey GOLTORUS.apk

{{< /highlight >}}

When using jarsigner from the JDK for instance.

After the program has finished you will find an `apkname_fixed.apk` in the same directory as the original APK. This APK should now be good to upload back onto the Play store.

For those who are interested the source code to this tool can be found [on notabug](https://notabug.org/hp/godotapkfixer).

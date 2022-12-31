---
title: "Godot 3.2 will get a new Android plugin system"
excerpt: "Godot has the simplest and most efficient Android deploy system you can find in any game engine. With a single click, your project is runing on the phone. With a single option (network fs deploy) your gigabyte-sized project is running on your device in mere seconds. You can use the editor to debug your running game while it runs on your device and you can make changes in the scenes or scripts and they will reflect in real-time in your phone or tablet. The big drawback, however, was that adding plugins was a pain in the butt."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5cc/0dd/a5a/5cc0dda5a3834246752408.png
date: 2019-04-24 00:00:00
---

Godot has a simple and efficient Android deploy system. With a single click, your project is running on your phone. With a single option (network filesystem deployment) your gigabyte-sized project is running and updating on your device in seconds. You can use the editor to debug your running game while playing on your device and you can make changes in the scenes or scripts and they will reflect in real-time on your phone or tablet. The big drawback until now, however, was that adding plugins was a pain in the butt.

Beginnig with Godot 3.2, the Android plugins system has been overhauled. It is no longer required to recompile the engine to add a new plugin.


### New custom build system

Godot export templates for Android projects are just two *.apk* files, one for debug and one for release. On export, Godot fills them with the project files and tweaks some internal variables of the format. This works well in general, but many times the Android project needs to be actually modified and the current approach is not flexible enough.

Instead of going the way of other engines, which just export an Android project, it was decided to keep the current, easy-to-use approach, but to  make it easier to generate the base templates from source.

To do this, there is a very simple option in the *Project* menu to install the *build template*:

![custom_build_install_template.png](/storage/app/uploads/public/5cc/0d8/411/5cc0d8411779b991254760.png)

When used, the Godot Android project that is used to build Godot for Android is installed in *"res://android/build"*, including full Java source code (a proper *.gdignore* file is added in *"res://android"* to avoid Godot filesystem dock from entering this folder).

When the build template is installed, the following option can be turned on in the Android export presets:

![custom_build_enable.png](/storage/app/uploads/public/5cc/0d9/126/5cc0d9126190b091610560.png)

And from now on, every time the project is exported, *gradle* will be executed to produce fresh export templates from the Android source. The output (as well as potential errors) is displayed in the editor UI:

![custom_build_gradle.png](/storage/app/uploads/public/5cc/0d9/a7f/5cc0d9a7f014b050964561.png)

The generated templates are used automatically without any user intervention.

Setting this system up still requires installing the Java and Android SDK in order for Godot to build, but detailed instructions can be found [in this new tutorial](https://docs.godotengine.org/en/latest/getting_started/workflow/export/android_custom_build.html).


### New plugin system

Having the Godot Android project source built automatically allows doing modifications to it, in a way more similar to how it works in other engines. This way you can keep modifying your Android project and bypass the rigidity of the export system as desired.

Still, however, the problem persists where, if a new Godot version is released, the Android build template will need to be erased and updated, discarding any changes you may have done to it.

To avoid this situation, a new plugin system was also added. This allows adding plugins inside the *"res://android"* directory (with any name other than *"build"*, of course). When Godot exports using the *custom build* option, the plugins are be compiled-in automatically.

Plugins allow extending the existing base build template by adding extra files and resources to it in outside directories. They also support blitting chunks of text into *AndroidManifest.xml* and *build.gradle*, so these files can be modified without risking to lose these changes as soon as the build template is updated.

The code part (Java) for creating plugins remains unmodified so existing plugins should be easy to port to the new system. For more details on how to create them, see [this new tutorial](https://docs.godotengine.org/en/latest/tutorials/plugins/android/android_plugin.html).

As plugins are just extra files that are added to the project, you can now also distribute them via our [asset library](https://godotengine.org/asset-library/asset). This was not possible before.

### Future

With upcoming Godot 3.2, it will be very easy for both our community and third party vendors to create and distribute Android add-ons (such as Ad-Mob, Firebase, Facebook, etc) for others to use. Here's towards a flourishing ecosystem!

And as always, remember that this is done with love from us. This was a highly requested feature that we're glad to finally be able to provide. If you aren't already, please consider [becoming our Patron](https://www.patreon.com/godotengine) and help Godot's main developers work full time on the project, so the world can have a free and open source tool that lets you create games without any restrictions. Even a small donation is a huge help!
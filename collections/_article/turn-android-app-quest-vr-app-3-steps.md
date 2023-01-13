---
title: "Turn an Android App into a Godot Quest VR App in 3 Steps"
excerpt: "Thanks to the XRApp framework, it is now easier to deploy Godot projects to mixed reality platforms on Android."
categories: ["news"]
author: Fredia Huya-Kouadio
image: /storage/app/uploads/public/624/5ba/665/6245ba665ff5d449805122.jpg
date: 2022-03-31 09:40:00
---

Now that we’re past the clickbait title, let’s get to the meat of the matter:

**Designing and building VR applications is hard!**

It’s even more so if you are not familiar with graphics and game engine-related tools and technologies.

This used to be my experience. My primary background was in Android mobile development and so when I initially approached the field of Virtual Reality, I was at a loss and quickly ran into a wall. Through perseverance and hard work, I was able to overcome that wall, but that experience made me realize how steep the learning curve is and how much of a barrier this is for other developers interested in the field.

### [Introducing the Godot XRApp Framework](https://github.com/m4gr3d/GAST/tree/master/core/src/xrapp)

Two components are key for designing and building a VR application:

- A mature UI framework / library to design and build flexible and features rich UI interfaces for the user to interact with.
- A game engine to generate the environment, and power the experience (tracking, input handling, collision, physics, lighting, ambisonic audio, …).

Given my background, selecting the UI framework was easy. The Android UI framework has been maturing for more than a decade, and powers the rich and diverse set of apps that make the Google Play store one of the leading app stores.



![2-play-song-screenshot.png](/storage/app/uploads/public/624/5d5/5ce/6245d55ce259a809037900.png)



And for the game engine, Godot’s **flexibility** ([can be used as a library](https://github.com/godotengine/godot/pull/31919) and [embedded within an application](https://github.com/godotengine/godot-proposals/issues/1064)), **size** (less than 50 MB for the full Android library and the [ability to shrink further](https://docs.godotengine.org/en/stable/development/compiling/optimizing_for_size.html)) and [**feature set**](https://docs.godotengine.org/en/stable/about/list_of_features.html) (with [more features on the way for Godot 4.x](https://docs.godotengine.org/en/latest/about/list_of_features.html)) made that an easy choice.

By combining these two components, the [Godot XRApp framework](https://github.com/m4gr3d/GAST/tree/master/core/src/xrapp) is able to position, and render an Android app and its UI layout in a Godot defined environment. Thus providing developers with the ability to easily and quickly develop, build and test Godot Quest VR applications from new or existing Android code and libraries.

### Usage

The [Godot XRApp framework](https://github.com/m4gr3d/GAST/tree/master/core/src/xrapp) can be integrated within a new or existing code base in three steps.

#### Step 1: Add the framework dependencies

Within the app's `build.gradle` file, add the following dependencies:

```
dependencies {
    ...

    implementation "io.github.m4gr3d:godot:3.4.4.stable"
    implementation "io.github.m4gr3d:godot-openxr:1.3.0.beta5"
    implementation "io.github.m4gr3d:gast-xrapp:0.2.0"

    ...
}
```

#### Step 2: Update the app's main Activity

- Have the app's main Activity extend `org.godotengine.plugin.gast.xrapp.GastActivity`.
- In the app's main Activity, overrides the `isXREnabled()` method and return `true`.
  - As its name implies, this method can be used to enable/disable XR support allowing to **use and run the same code** on regular Android devices.

```
import android.os.Bundle
import org.godotengine.plugin.gast.xrapp.GastActivity

class MainActivity : GastActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
    }

    override fun isXREnabled() = true
}
```

#### Step 3: Update the app's `AndroidManifest.xml`

This is primarily to comply with the requirements for running on the [Meta Quest](https://en.wikipedia.org/wiki/Oculus_Quest).

Add the following tag to the main Activity's `intent-filter`: `<category android:name="com.oculus.intent.category.VR" />`

```
<activity android:name=".MainActivity" android:exported="true">

    <intent-filter>
        <action android:name="android.intent.action.MAIN" />

        <category android:name="com.oculus.intent.category.VR" />

        <category android:name="android.intent.category.LAUNCHER" />
    </intent-filter>

</activity>
```

#### Build and run!

That's all! Your app should now build and run on the Quest as a Godot VR app!

For more information, please take a look at the [Godot XRApp framework guide](https://github.com/m4gr3d/GAST/tree/master/core/src/xrapp#usage).

### Additional features

#### Automatic support for hand tracking

The framework has built-in support for hand tracking, enabling interaction with the VR app without the need for controllers.

![feature-quest-hands-play-song-screenshot.jpg](/storage/app/uploads/public/624/5c5/2f7/6245c52f78c89435559563.jpg)

#### Passthrough environment

The framework provides the ability to toggle [passthrough](https://support.oculus.com/articles/in-vr-experiences/oculus-features/what-is-passthrough/) on the Quest, enabling the user access to your app while interacting with their real-time surroundings.

See the [documentation](https://github.com/m4gr3d/GAST/tree/master/core/src/xrapp#available-passthrough-environment) for instructions on how to enable it.

#### Oculus Keyboard support

The framework leverages the Oculus Keyboard for input.

### And More!

We have more features in the pipeline for upcoming releases! Please take a look at the [Godot XRApp framework roadmap](https://github.com/m4gr3d/GAST/blob/master/core/src/xrapp/ROADMAP.md) to learn more.

## Contributing and Reporting Issues

The [Godot XRApp framework](https://github.com/m4gr3d/GAST/tree/master/core/src/xrapp) is an open source, MIT-licensed project. As such, [contributions](https://github.com/m4gr3d/GAST/blob/master/core/src/xrapp/README.md#contributions) are encouraged and welcome!

Please feel free to report any issues, or provide feedback on the project's [github issues page](https://github.com/m4gr3d/GAST/issues).

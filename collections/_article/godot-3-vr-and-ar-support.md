---
title: "Godot 3's VR and AR support"
excerpt: "The past year we've been hard at work behind the scenes adding support for AR and VR to Godot. Support for basic mobile VR and full support for OpenVR is ready for Alpha 2. OpenHMD support is being worked on and we have a working ARKit implementation."
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/app/uploads/public/5a0/060/6e2/5a00606e2f006284076643.png
date: 2017-11-06 13:29:34
---

With Alpha 2 now out and C# rightfully stealing the spotlight for this release, there is another long awaited new feature that has been added to Godot: VR support. We're also making good progress on the AR front, however it is unlikely for AR to be added to the official 3.0 release at this time.

Time for a proper introduction into how you can get into this, what is currently finished and what is on the horizon.

## The ARVR Server

Part of the Alpha 2 release is the [ARVR Server](http://docs.godotengine.org/en/latest/classes/class_arvrserver.html) architecture that makes VR and AR possible in Godot. This server allows VR and AR platforms to make themselves known to Godot and handles the interaction with the rest of the engine, including some pretty direct access to the rendering pipeline to allow for as low lag as possible between updating positional tracking and rendering to the device.

For now the following parts are important for you as a developer:

First, to enable VR in your game you need to execute the following code in your main scenes _ready function:
```
var arvr_interface = ARVRServer.find_interface("Name of the interface")
if arvr_interface and arvr_interface.initialize():
    get_viewport().arvr = true
```

- The first line finds the interface you want to use, you can use `get_interface_count` and `get_interface(index)` to scan through the available interfaces and present your user with a selection, but more often then not you'll likely be developing against a specific platform. I'm planning on adding a function that returns an array of names for convenience but at the time of writing this, that is not yet available.
- The second line initializes the interface.
- The third line tells the main viewport that it should render and output our AR/VR output. Where the device you are working on is the output device, e.g. mobile VR, AR, etc. you must enable this on the main viewport. Where output is to a secondairy device you can use a separate viewport. In this latter case if the main viewport is used, the main viewport will show a raw version of the left eyes render while the stereoscopic result is sent to the headset.

## New ARVR nodes

The second thing you need for your game to use the new AR/VR system is to use a couple of new nodes we've introduced. Your scene should always contain the following nodes in the following arrangement:
```
 - ARVROrigin
   - ARVRCamera
   - any number of ARVRController nodes
   - any number of ARVRAnchor nodes (AR only)
```

The [ARVROrigin](http://docs.godotengine.org/en/latest/classes/class_arvrorigin.html) node is a node that maps a location in our virtual world to a real world location. Everything is tracked in relation to this node and it is this node that you (re)position inside of your game if the player moves outside of physical movement, e.g. teleporting, moving with controller input, etc.
Any of the ARVR child nodes placed under the ARVROrigin node will have their position and orientation automatically updated by the AR/VR system.

The [ARVRCamera](http://docs.godotengine.org/en/latest/classes/class_arvrcamera.html) is a special subclass of the standard camera node in Godot. Obviously it is positionally tracked by the AR/VR system but it also interacts in other ways to enable for instance stereoscopic rendering. Now note that there are no special properties added to the camera for this. The active interface overrides most of the cameras properties as the AR/VR system dictates these properties. The only properties that are important here are the near and far properties.

The [ARVRController](http://docs.godotengine.org/en/latest/classes/class_arvrcontroller.html) node is a node that automatically tracks any VR controller that is available. The controllers are numbered in order in which they are turned on and you simply map the node to one of the controller. If the node is mapped to a controller that isn't active, a property on the node will tell you it's not active. If you know that your game is always played with two controllers, you can add those directly into your scene and react to them becoming active/inactive. Alternatively you can add these nodes to your scene as new controllers are turned on, signals have been added to the ARVRServer to let you know when this happens.

Finally the [ARVRAnchor](http://docs.godotengine.org/en/latest/classes/class_arvranchor.html) is a new node specifically made for AR platforms. AR platforms will attempt to detect and track real world objects. This can be anything from the basic plane detection in ARKit and ARCore which will identify flat spaces in the real world and map them to virtual location, to detecting objects in the real world that are automatically positionally tracked.

## Interfaces as GDNative modules

While there will be interfaces implemented directly into the Godot source, the preferred deployment method of the interfaces is through GDNative modules. These modules will generally consist of two files. A dynamic library and a GDNative library resource file. This resource file should be added to the list of singleton GDNative libraries in your `project.godot` files (Godot will do this automatically when you open the resource file in the editor). This will load the module when your game starts and make the AR/VR interface available to the ARVRServer.

If an interface is supported on multiple OSs there will be a dynamic library for each OS. Eventually Godot will export the correct dynamic library when exporting your game, we are still working on this.

Some interfaces will have additional GDNS files that allow you to access nodes offering platform specific logic but we're trying to design all the interfaces in such a way that using these is optional.

### Mobile VR

There is one interface that is part of the core Godot release and it's called "Native Mobile". This is a really straightforward cardboard-esk implementation for mobile VR that only supports headset orientation and basic lens distortion, but it is very functional for making lightweight mobile VR solutions. You can find more detail about it in the [MobileVRInterface](http://docs.godotengine.org/en/latest/classes/class_mobilevrinterface.html) documentation.

We are looking into Daydream and Gear VR support for more serious mobile VR games. This however is dependent on both time and hardware availabity (I don't own any Android device). If anyone wants to help out here please shoot me (Mux213) a message on IRC.

### OpenVR

<iframe width="560" height="315" src="https://www.youtube.com/embed/v291rMWCMRw" frameborder="0" allowfullscreen></iframe>
OpenVR is now supported in Godot through a GDNative module and is pretty much feature-complete and can be considered in beta. You can find the source and compile it for your platform in the [godot_openvr](https://github.com/BastiaanOlij/godot_openvr) repository.

I have put a Windows 64-bit build based on the Alpha 2 release online, [you can find it here](https://www.dropbox.com/s/y7mmklm1zu8373h/GDNative%20OpenVR%20Alpha%202.zip?dl=0).
This download also contains a very simple boilerplate demo to get you up and running.

The module has been successfully tested on Windows and Linux but as I only have access to a Windows machine I'm not able to provide Linux builds at this time. I do not know anyone with capable Mac hardware and an HTC Vive, so it is unknown at this time if the module will work on Mac OS X.

It has been successfully tested on both Oculus and HTC hardware and should in theory work with any hardware supported by the Steam VR platform.

### OpenHMD


![2](http://www.openhmd.net/wordpress/wp-content/uploads/2017/09/Godot-OpenHMD-Research.png)


[OpenHMD](http://www.openhmd.net/) is a great open source project that enables cross platform support for a number of major headset without relying on pre-installed SDKs. Especially on Linux this project shines as it allows you to use hardware that isn't supported on Linux by their hardware vendors. But equally on Windows it brings in native support for devices such as the NOLO VR controllers and even the PSVR headset!

The module we are building for Godot is still very experimental and incomplete but I'm putting it in the mix here as it would be good to have people offering a helping hand to further complete it. It may change drastically before we're done with it. You can find the current version of the OpenHMD GDNative module in the [godot_openhmd](https://github.com/BastiaanOlij/godot_openhmd) repository.

### ARKit

Godot fully supports ARKit but it is unlikely to be added into the core any time soon. The biggest issue holding us back with ARKit is Apple's requirement to compile the source code against iOS 11 and that means dropping support for the iPhone 5. Also Apple does not allow dynamic libraries being deployed over the AppStore, removing GDNative as an option (though potential workarounds for this are being discussed).

If you want to give ARKit a try the only option is to compile Godot yourself. You can locally merge the [pull request](https://github.com/godotengine/godot/pull/9967) with the ARKit implementation, or simply clone the [ARKit branch](https://github.com/BastiaanOlij/godot/tree/arkit) on my GitHub fork.

### Future interfaces

The interfaces discussed above are the ones in development or finished at this time. Other interfaces are being discussed but for the most part it is a function of availability of hardware and time. My time is currently consumed by bugfixing what we already have :)

Anyone wanting to give us a hand testing or developing interfaces can find us on the IRC channel #godotengine-vr on Freenode (#vr:godotengine.org on Matrix). I can usually be found there a few days a week at night or in the weekend, but do note I'm in Australia.

Finally, I have taken the lead on this project but the list of people who have helped out by testing, bugfixing, lending out hardware, discussing code, etc. is long. So thanks, loads of thanks, to all involved!

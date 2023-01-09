---
title: "Update on recent VR developments"
excerpt: "Godot VR support is slowly improving. The OpenVR drivers are now supplied through the asset library and we have the first version of our Oculus drivers available!"
categories: ["progress-report"]
author: Bastiaan Olij
image: /storage/app/uploads/public/5a8/aa0/2a3/5a8aa02a3024a585722524.png
date: 2018-02-21 02:00:40
---

It has been a very busy month on the VR front in Godot.

## OpenVR

The focus for development has remained on OpenVR support for the most part and it is slowly finding use within the community.

With the release of Godot 3.0 the OpenVR module can now be downloaded directly [from the asset library](https://godotengine.org/asset-library/asset/150).

It comes with support for OpenVR on 64-bit Windows and on Linux. We'll add more platforms as testing is rounded off. On Linux it is important that Godot is started from the Steam runtime or it will not find Steam VR.

There are also several premade scenes in the module to help you get set up faster.

For more information on the asset or to let us know of any problems you encounter please visit [our issue repository on GitHub](https://github.com/BastiaanOlij/godot-openvr-asset/issues).

## Oculus

There is now also a native driver for the Oculus SDK. As the Oculus SDK is only available on Windows this driver is only available for that platform.

The Oculus driver is now also available [in the asset library](https://godotengine.org/asset-library/asset/164).


It comes with the same premade scenes as the OpenVR module. There are only small differences in the controller scenes but most of the others are interchangeable. If you use your own controller meshes (e.g. use hands) it is fully possible to create a Godot game where you can interchange the two drivers depending on which platform you want to deploy to.

For more information on the asset or to let us know of any problems you encounter please visit [our issue repository on GitHub](https://github.com/BastiaanOlij/godot-oculus-asset/issues).

## Future

Work will continue on improving these two drivers, especially the Oculus one which is still very new. A temporary fix is being tested to solve the HDR issue on the OpenVR driver so work continues on that as well.

Work on Gear VR is progressing slowly, we need more people who are more familiar with the Android system but we do hope to have something here in the not too distant future. Come find us on IRC on #godotengine-vr (#vr:godotengine.org on Matrix) if you're able and willing to offer help.

Finally the last bit of news is that we're going to support Leap Motion, initially on desktop but likely also on mobile some time in the future. More on this once we actually get started.
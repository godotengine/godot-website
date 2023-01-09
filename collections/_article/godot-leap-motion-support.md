---
title: "Godot Leap Motion Support"
excerpt: "Leap Motion hand tracking support arrives with Godot 3.0.3"
categories: ["news"]
author: Bastiaan Olij
image: /storage/app/uploads/public/5b2/78c/51c/5b278c51c79b7843614393.jpg
date: 2018-06-19 12:35:32
---

Support for the [Leap Motion](http://www.leapmotion.com/) sensor was added as a [GDNative plugin](https://godotengine.org/asset-library/asset/215) a few months back however full support for this sensor required changes made in Godot 3.0.3. 

With Godot 3.0.3 officially released we can now announce support for this wonderful device. The module uses Leap Motions latest LeapC libraries which are a big improvement on their older API. This new API has only been released for Windows at this point in time so there is no support for Linux and Mac yet.

The Leap Motion sensor tracks hand and finger movement and in such offers a very natural interface. Leap Motion made the change to using their technology in the AR and VR space a year or two ago and it is a wonderful fit. Being able to use your hands directly in virtual reality is a great experience.

**Using the Leap Motion**

To use the Leap Motion in Godot couldn't be simpler. Just download the [Leap Motion asset](https://godotengine.org/asset-library/asset/215) from the asset library into your project. You will find several scenes inside this module that you can add that immediately set up the device.

In a non-VR application just place the sensor node somewhere in your scene and the hands will magically appear in relation to that node.
For a VR application you should place the sensor node as a child node of your `ARVROrigin` node and turn the ARVR mode of the sensor on. It will automatically take into account that the Leap Motion sensor is attached to your HMD.

When you select your sensor node you will see that all the properties to configure the sensor are shown:

![leap_motion_property_inspector.png](/storage/app/uploads/public/5b2/78a/611/5b278a6119098012275993.png)
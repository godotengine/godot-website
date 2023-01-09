---
title: "Godot in Google Summer of Code 2018"
excerpt: "Godot has been accepted into the Google Summer of Code program in 2018. This summer we will have 5 students working on new features to the engine."
categories: ["progress-report"]
author: George Marques
image: /storage/app/uploads/public/5ad/f38/7a8/5adf387a8d4f0692142419.png
date: 2018-04-24 11:04:00
---

For those who might not be aware, the Google Summer of Code is a yearly program that brings students from all over the world into open source projects. The students have the opportunity to get involved into a real software development process, while the organizations can welcome a new contributor working on a valuable feature, potentially becoming a regular after the summer is over.

We developed a [list of ideas](https://github.com/godotengine/godot-roadmap/blob/master/GSOC-2018.md) to apply to the program (though students are free to come with their own proposals). Everything was made in a bit of a rush and without many announcements since we were quite busy with Godot 3.0 release and a few big events in the schedule. In February 12 we [got the good news](https://twitter.com/reduzio/status/963113170301865985) that Godot was accepted as participant organization.

This is the first year Godot is participating in the program and we got the chance to accept five student projects that will be developed from May to August. The projects were just announced publicly and we are looking forward to see the development of the features.

We hope that the Godot community will give a warm welcome for these new contributors that will be working with us during the summer. I'm sure that if the students feel the good vibes from the community they'll hang around and keep contributing to our engine.

Without further ado, let's go through the list of accepted proposals:

## Support for video decoder modules with GDNative

This project will be about creating an interface into GDNative so custom video decoders can be added without the need of recompiling the engine. It'll enable Godot to support several video formats that are hard to integrate because of patents or licenses, while also avoiding the bloat in the base engine for those who don't need it.

[Anish Bhobe (KidRigger)](https://github.com/KidRigger) will work on this project with the help of [karroffel](https://github.com/karroffel) and [Hein-Pieter van Braam (TMM/hpvb)](https://github.com/hpvb).

## WebRTC support for multiplayer games

The proposal by Brandon Michael Makin will add support for the WebRTC protocol into Godot's high-level network layer. This will make possible to create multiplayer games in the HTML5 platform among other benefits. [Max Hilbrunner (mhilbrunner)](https://github.com/mhilbrunner) and [Fabio Alessandrelli (faless)](https://github.com/faless) will help him in this endeavor.

## GearVR and Daydream support

With the help of [Bastiaan Olij (Mux213)](https://github.com/BastiaanOlij), who added the AR/VR system into Godot, [Paritosh Sharma](https://github.com/Paritosh97) will extend the system to support two mobile VR platforms: Samsung's GearVR and Google's Daydream.

## Support for MIDI playback

Daniel Matarov proposal's include the development of a MIDI bus, similar to Godot's audio buses, along with a sampler to allow the playback of MIDI songs. He'll be mentored by [Gilles Roudiere (Groud)](https://github.com/groud), [Marcelo Fernandez (marcelofg55)](https://github.com/marcelofg55), and [myself](https://github.com/vnen).

## TSCN exporter for Blender

While [already in development](https://github.com/godotengine/godot-blender-exporter), the plugin that exports Godot scenes directly from Blender is still in its infancy. With the help of [Geoff (sdfgeoff)](https://github.com/sdfgeoff), who's already improving the plugin, and [Juan Linietsky (reduz)](https://github.com/reduz), the student [Jiacheng Lu](https://github.com/Jason0214) will further work on it to get into a fully usable state. The exporter will help the workflow by removing the intermediary formats, such as Collada and glTF, so the output can be specifically tailored for Godot's needs.

----

We from the Godot team want to thank Google for this great program that bridges the connection from universities to open source projects. We also want to give a big welcome for the students and wish them the best of luck. Hopefully we all will get great things from this experience. Now let the work begin!
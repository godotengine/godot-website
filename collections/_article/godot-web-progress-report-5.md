---
title: "Web Editor release candidate, HTML5 gamepads and more!"
excerpt: "The Web Editor has reached release candidate state,  improved HTML5 gamepad support allows supporting more devices out of the box."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/601/c12/f25/601c12f25ba04034388411.png
date: 2021-02-04 16:00:00
---

Howdy Godotters! Time for another brief update on the HTML5 export for Godot.

Web Editor
==========

First of all, the Web Editor reached release candidate state, and now has a [dedicated address](https://editor.godotengine.org/) where you can also browse [previous releases](https://editor.godotengine.org/releases/). There are still few issues ([#44754](https://github.com/godotengine/godot/issues/44754), [44755](https://github.com/godotengine/godot/issues/44755)) we are ironing out, but it should be gold by the end of the month.

Gamepad API
===========

During December, realizing how poor gamepad support was on the web, I spent some time fiddling around with the [HTML5 Gamepad API](https://developer.mozilla.org/en-US/docs/Web/API/Gamepad_API/Using_the_Gamepad_API) trying to improve the situation. The standard itself is sadly incomplete (see [w3c/gamepad#7](https://github.com/w3c/gamepad/issues/7) and [w3c/gamepad#9](https://github.com/w3c/gamepad/issues/9)) making remapping of controllers hard guesswork.

**Important:** When talking about mapping in this post, I'm not referring to your game action mapping, but making sure that pressing the button labelled "`A`" in your Xbox controller is correctly recognized by Godot as `JOY_XBOX_A` (i.e. `JOY_BUTTON_0`, i.e. `JOY_SONY_X`, i.e. the button labelled "`X`" in your DualShock controller).

First of all, gamepads cannot be detected on the Web until a button is pressed on them. Then, the controller is either remapped to a [`standard`](https://w3c.github.io/gamepad/#remapping) mapping by the browser, or its raw inputs are used.

Normally, Godot and other software would remap raw inputs using a [database](https://github.com/godotengine/godot/blob/master/core/input/gamecontrollerdb.txt) of known controllers and detecting them based on information passed by the operating system like the device vendor and product ID, and its "connection type" (bus information). As mentioned above, those information are not always available using the Web Gamepad API, but can sometimes be obtained via guesswork.

The main issues are:

- The `gamepad.id` does not always contain vendor and product ID, additionally its format differs across browsers. Bus informations are not available.
- The same product/vendor IDs results in different raw inputs on different operating systems.
- Some `[browsers,OS,gamepad]` combinations produce inputs or mappings outside of the specification (e.g. axis values outside the `[-1,1]` range, or `gamepad.mapping` set to `standard` but not actually following the standard specification).

In case you are wondering: yes! This is quite a mess! As you can also see from browsers issue trackers about the subject ([Firefox](https://bugzilla.mozilla.org/buglist.cgi?quicksearch=gamepad), [Chromium](https://bugs.chromium.org/p/chromium/issues/list?q=component%3ABlink%3EGamepadAPI&can=2), [Safari/WebKit](https://bugs.webkit.org/buglist.cgi?bug_status=UNCONFIRMED&bug_status=NEW&bug_status=ASSIGNED&bug_status=REOPENED&component=WebCore%20Misc.&order=bug_id%20DESC&product=WebKit&query_format=advanced&short_desc=gamepad&short_desc_type=allwordssubstr)).

But nevertheless, we can do something to better our gamepad support on the Web for many devices. To do this, we need to guess the operating system the browser is running on, then try to read informations about vendor and product from the `gamepad.id` string, and finally provide mapping informations for that gamepad on that OS. Of course, none of this is necessary in the (rare for now) cases where the browser already remaps the gamepad following the standard.

![Remapping UI in joypads demo](/storage/app/uploads/public/601/bfe/670/601bfe6702061798439389.png)


A simple UI is being added to the [joypads demo](https://github.com/godotengine/godot-demo-projects/tree/master/misc/joypads) that allows to easily generate a controller mapping for a new device. That UI was used to generate mapping for all controllers I could come across on Linux/Windows/macOS after bothering friends and family during the holidays. This includes most (all?) official Xbox controlers (wired), and two compatibles I had lying around.

You can check if your device is mapped correctly on the web [here](https://no-war.fales.me/joy/), and try to remap it in case it's not (reporting your fixed mapping in [#45078](https://github.com/godotengine/godot/pull/45078)).

**Please note**: If the controller is detected as `standard` but it's not correctly mapped or if moving any axis shows a value outside the range `[-1,1]`, it's probably a browser bug and we can't do much about it (probably worth reporting to the browser issue tracker).

Future work
===========

There are quite a few things I've been working on during January: the Godot <-> JavaScript [interface](https://twitter.com/falessandrelli/status/1354106707866218498) for HTML5, some refactoring of [custom HTML templates](https://github.com/godotengine/godot-proposals/issues/2182) and fixes to fullscreen/HiDPI support on the web. Stay tuned for another post soon.

References
==========

[Gamepad API](https://github.com/godotengine/godot/pull/45078) ([3.2](https://github.com/godotengine/godot/pull/45079))

[Demo addition PR](https://github.com/godotengine/godot-demo-projects/pull/575)

[New Web Editor Address](https://editor.godotengine.org/)
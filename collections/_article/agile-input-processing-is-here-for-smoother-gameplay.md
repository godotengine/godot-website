---
title: "Agile input processing is here for smoother, more responsive gameplay"
excerpt: ""
categories: ["progress-report"]
author: Pedro J. Estébanez
image: /storage/app/uploads/public/612/136/3cc/6121363ccb95e735957693.png
date: 2021-08-21 17:00:00
---

Since it's not very usual I post here, let me remind you who I am. I'm Pedro, a.k.a. [RandomShaper](https://twitter.com/RandomPedroJ) in the Godot community. I've been contributing to the engine since 2016, when I discovered it –version 2.1 was the newest– and decided to use it to create my game [Hellrule](http://pedrocorp.net/#hellrule). Precisely while testing this project on different models of Android phones, I found the need to make the improvements I'm explaining in this post.

### Old behavior in Godot 3.3.x and before

In a game engine, the *engine loop* is the sequence of steps that is happening again and again to let the game run. This includes rendering, physics, input processing, and more. Optimizing this loop to run with as little CPU time as possible is important to have smooth gameplay on high-end and low-end hardware alike.

Godot's engine loop used to look like this (this is heavily simplified to just show what we are talking about here):

![loop_before.png](/storage/app/uploads/public/611/d83/0a3/611d830a38eb5069138855.png)

The key element of this is the possibility of multiple physics steps being processed per cycle of the engine loop. Consider a game that wants its gameplay logic and physics to run at 60 FPS. To achieve this, the engine needs to poll for the player's inputs from various sources, such as a mouse, keyboard, gamepad or touchscreen. Ideally, the engine would read the player's inputs once per each of those gameplay-physics steps so it reacts as quickly as possible to player actions. Also, rendering would happen at that very same pace, so everything stays in sync.

However, depending on the demands of the game and the hardware it's running on at a given time, that may not be possible. If the device running the game is not powerful enough to keep everything at 60 FPS, the engine will run at a lower effective FPS rate. Rendering and idle processing will then occur less than 60 times per second, but the engine will do its best to have the gameplay-physics running at the target rate, by executing more than one of those physics steps per visible frame.

If you look again at the game loop above, you'll understand that a consequence of the engine looping at a lower frequency is that, user input is also pumped and handled less frequently, which leads to having a **lower responsiveness** in addition to a less smooth update of the display.

#### New behavior in Godot 3.4 beta and later

In order to avoid that, Godot needed to somehow **uncouple input from render** so the engine main loop looked more like this:

![loop_after.png](/storage/app/uploads/public/611/d83/0c8/611d830c8ef48415300361.png)

To make that happen, I've added the concept of **input buffering**, which allows that one thread –usually the one consuming events from the OS– stores the input events from the player in a buffer as they are received while the main thread of the engine **flushes them at key points of the cycle**. This new approach improves the responsiveness of the game in situations of lower-than-ideal FPS.

### Remarks

- This enhancement is implemented in two pieces. One belongs to the core of the engine, whereas the other must be implemented on each platform. At this point, only Android has the platform-specific part implemented. (To be honest, that's most likely the platform where agile input flushing is needed the most, due to the huge range of hardware capabilities found across devices.)
- However, the doors are open wide for it to be implemented for other platform given the base is already done.
- **Both Godot 3.4 and 4.0** will enjoy agile input, exposed as the `input_devices/buffering/agile_event_flushing` project setting.
- The project setting mentioned above is **disabled by default**. The rationale is that not every project may want to have batches of input events coming multiple times per frame. Also, until this feature is implemented universally, enabling it causes differences of behavior across platforms. Nonetheless, elaborating on the latter, my game has been in the wild for months with agile input flushing on Android and without it on iOS with no issues. As long as you make your game physics-centric, whether agile input is enabled or not won't have any side effects. The game will just be more responsive when it's enabled and available, but it will keep working without agile input.
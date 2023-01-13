---
title: "Godot 3.2 will get new audio features"
excerpt: "I left these out of 3.0 and never managed to work on it again, yet users requested them a lot this past year. Finally, they will be available for Godot 3.2."
categories: ["progress-report"]
author: Juan Linietsky
image: /storage/app/uploads/public/5ca/e12/bb1/5cae12bb15e13776060470.png
date: 2019-04-10 00:00:00
---

I left these out of 3.0 and never managed to work on it again, yet users requested them a lot this past year. Finally, they will be available for Godot 3.2.


### Audio Generators

This is a new type of *AudioStream* that can be put in the regular stream players (normal, 2D and 3D): *AudioStreamGenerator*. Just put it anywhere and then get the *Playback* object, in this case *AudioStreamGeneratorPlayback*.

```
var playback = $StreamPlayer.get_stream_playback()
```

Once this object is obtained, push stereo audio frames to it. You can do this by supplying *Vector2* objects via buffers or individual audio frames. From GDScript, it's simpler to push individual frames (though less efficient). GDNative and C# allow pushing buffers.

Here is some example code on how to fill the buffer with a sine wave:

```
func _fill_buffer():
        var increment = (1.0 / (hz / pulse_hz))

        var to_fill = playback.get_frames_available()
        while (to_fill > 0):
                playback.push_frame( Vector2(1.0,1.0) * sin(phase * (PI * 2.0))
                phase = fmod((phase + increment), 1.0)
                to_fill-=1;

```

Just call this function before AudioStreamPlayer.play() (to ensure buffer is full before playback begins),
and then call it from _process(), to ensure it remains full.


### Spectrum Analyzer

There is also a new effect named *AudioEffectSpectrumAnalyzer*. It can be set as an audio bus insert. Once there, just obtain the *AudioEffectSpectrumAnalyzerInstance* instance via API:

```
    # This gets the first effect in the Master bus (0)
    spectrum = AudioServer.get_bus_effect_instance(0,0)

```

This instance synchronizes with the audio playback, so the magnitudes of the frequency ranges should be *exactly* what is playing right now (or as close as possible). This uses Fast Fourier Transform, so you can change the buffer size to a smaller one for more accurate timing (but less accurate frequency information).

To get the magnitude of a frequency range, use the following function:

```
var f = spectrum.get_magnitude_for_frequency_range(from_hz,to_hz)
```

This returns a normalized value in linear scale (DC at 0, saturation at 1). Use the linear2db() helper to convert to Decibels if needed.

Here is a simple example for drawing a spectrum, using linear frequencies:

```
    var w = WIDTH / VU_COUNT
    var prev_hz = 0
    for i in range(1,VU_COUNT+1):
        var hz = i * FREQ_MAX / VU_COUNT;
        var f = spectrum.get_magnitude_for_frequency_range(prev_hz,hz)
        var energy = clamp((MIN_DB + linear2db(f.length()))/MIN_DB,0,1)
        var height = energy * HEIGHT
        draw_rect(Rect2(w*i,HEIGHT-height,w,height),Color(1,1,1))
        prev_hz = hz


```

And a video of this code in action:

<iframe width="560" height="315" src="https://www.youtube.com/embed/5z9uuU0xVX4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

### Examples

Example code for both projects can be found in the [demo repository](https://github.com/godotengine/godot-demo-projects/tree/master/audio).


### Future

I wanted to add a BPM detector for rhythm games, but all the open source code I found is GPL (incompatible with Godot MIT), so we will probably need to roll our own. I am too busy for this at the time, but if you want to help contribute to one, let me know (I can lend a hand explaining how it's done).

As mentioned before, this month I will be working in adding missing features for Godot 3.2. Next month I will start the Vulkan port. If you are not yet, please consider [becoming our patron](https://www.patreon.com/godotengine). It's easy, and you help the project enormously, even if just a small donation.

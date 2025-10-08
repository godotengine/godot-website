---
title: "GSoC 2019 progress report #2"
excerpt: "Godot takes part in the Google Summer of Code for the second year, and this time we have 8 students working on awesome features for the engine. With the programme coming close to an end, they each share their recent progress since the first report with a short devlog. A final report will be posted in coming weeks with an overview of the work done and how to get started using the features they worked on."
categories: ["progress-report"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5d5/d4e/904/5d5d4e9043f37492937462.png
date: 2019-08-21 14:01:20
---

[As announced previously](https://godotengine.org/article/godot-google-summer-code-2019), Godot is participating for the second time in the [Google Summer of Code](https://summerofcode.withgoogle.com) (GSoC) programme, which lets students from all over the world work for three months on specific projects thanks to a Google stipend.

The GSoC coding period is close to the finish line, and our 8 students are hard at work to finalize their projects as best as they can, while writing their final evaluation report. Yet, I've asked them for a quick update on what they've been working on over the past few weeks since the first progress report (read [part 1](/article/gsoc-2019-progress-report-1-part-1) and [part 2](/article/gsoc-2019-progress-report-1-part-2)).

This second progress report is shorter so we can fit everything in one article. At the end of GSoC, we'll have a final progress report where each student will outline how to get started using their project, and share their impressions of the experience as a whole.

Here is the list of projects and students with links to the relevant sections.

- <a href="#lightmapper">Rewriting Godot's Light Mapper</a> by Joan Fons Sanchez
- <a href="#static-analyzer">Static Analyzer for GDScript</a> by Suhas Prasanna
- <a href="#visual-scripting">Improvements to the Visual Scripting System</a> by Swarnim Arun
- <a href="#async-file-access">Asynchronous Cached File Access</a> by Raghav Shankar
- <a href="#gdscript-lsp">GDScript Language Server</a> by Ankit Priyarup
- <a href="#interactive-music">Interactive Music</a> by Daniel Matarov
- <a href="#motion-matching">Motion Matching Implementation Using KD Trees</a> by Aditya Abhiram
- <a href="#vcs-integration">Version Control Systems Integration</a> by Twarit Waikar

-----

<a id="lightmapper"></a>
## Rewriting Godot's Light Mapper – *Joan Fons Sanchez*

- **Project:** Rewriting Godot's Light Mapper
- **Student:** Joan Fons Sanchez ([JFonS](https://github.com/JFonS))
- **Mentors:** Juan Linietsky ([reduz](https://github.com/reduz)) and Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij))
- **Repository:** https://github.com/JFonS/godot/tree/lightmapper

### Current progress

A lot has happened since the last progress report. I finished integrating [Embree](https://www.embree.org) into the engine's build system and also added a simple ray tracing API that allows for defining a set of meshes and perform ray intersection tests among them.
This API currently uses Embree as a backend, but should allow adding a different backend (GPU-based maybe?) if we ever decide to go down that route.

With that new tool, adding occlusion for direct lighting was relatively straightforward:

![Sponza scene without and with occlusion for direct lighting](/storage/app/media/gsoc/2019-2/lightmap-001.png)
*Top: direct light without occlusion. Bottom: direct light with occlusion testing.*

Completing that last step meant that we had some really valuable information: which parts of the scene were receiving direct illumination from lights and which parts were in the shadow. But this information alone is not enough, light bounces on objects and tends to fill every possible corner of a scene, with varying intensity, of course. So it was time to add indirect lighting to the mix. Using the new ray tracing API we can randomly throw rays from each surface position and, depending on the surface they hit, get the average amount of light reaching that spot.
Here we can see the difference between having only direct lighting and having direct and indirect lighting combined:

![Sponza scene without and with indirect lighting](/storage/app/media/gsoc/2019-2/lightmap-002.png)
*Top: no indirect lighting. Bottom: 2 bounces of indirect light.*

Finally, I can show the current light mapper results in the Sponza demo:

![Sponza scene with both direct and indirect lighting](/storage/app/media/gsoc/2019-2/lightmap-003.png)

This image uses real-time direct lighting (regular Godot light nodes) and a light map for the indirect light bounces.

### Next steps

The basic structure of the new light mapper is quite settled, but there are still lots of things to work on before it can be merged into Godot. There are three aspects that need to be improved: performance, usability and results quality.
The performance improvements will likely involve adding muti-threading support and some minor improvements here and there. In order to improve user experience, we will restore the previous progress bar display (it was lost during the rewrite). Finally, the light map results will be improved by applying some artifact reduction techniques and also an AI-based denoiser.

-----

<a id="static-analyzer"></a>
## Static Analyzer for GDScript – *Suhas Prasanna*

- **Project:** Static Analyzer for GDScript
- **Student:** Suhas Prasanna ([psuhas77](https://github.com/psuhas77))
- **Mentors:** George Marques ([vnen](https://github.com/vnen)) and Bojidar Marinov ([bojidar-bg](https://github.com/bojidar-bg))
- **Repository:** https://github.com/psuhas77/godot/tree/gsoc

Since the first progress report, I've been able to complete the script traversal system and have started working on implementing static checks.
Static checks that are fully finished:

* Script inherits the Object type that it is attached to.

Static checks that work for general use cases:

* Node referenced in a `get_node()` call exists.
* Function connected to a signal has arguments of correct arity (working on extending this to the type of arguments as well).

It's been a blast working on this project so far. Hopefully by this last week or so, I can implement as many of these static checks as possible.

-----

<a id="visual-scripting"></a>
## Improvements to the Visual Scripting System – *Swarnim Arun*

- **Project:** Improvements To Visual Scripting System
- **Student:** Swarnim Arun ([swarnimarun](https://github.com/swarnimarun))
- **Mentors:** Ernest Lee ([fire](https://github.com/fire)) and Anish Bhobe ([KidRigger](https://github.com/KidRigger))
- **Repositories:**
  * https://github.com/swarnimarun/godot/tree/vs-graph-unification and other branches with `vs` prefix
  * PRs on upstream repository: [PR-29681](https://github.com/godotengine/godot/pull/29681), [PR-30852](https://github.com/godotengine/godot/pull/30852), [PR-31044](https://github.com/godotengine/godot/pull/31044)

### Current progress

It has been a couple of months since I started this project and one since the last update.
This month I worked on features for further refining the Visual Scripting interface to make it more usable while also fixing some old misgivings,
that have been there with the Visual Scripting system.

Some of the changes are:

- Making the search more reliable overall.
- Improving the usability of dialogs.
- Use the top bar instead of filling up the left panel.
- Adding dialog to add functions.
- Working on the `tool` script feature.
- Adding a Construct / Instance node.
- Overall fixes for things in Visual Script.

The search system is a little more forgiving in terms of allowing for incomplete word matching.

The dialogs are made smaller to allow for greater control over them. And make them less intrusive.

Using top bar to free up space in the left panel to allow for better use on smaller screens.

Adding functions quickly was quite a bit of pain, to help with this we now have a dedicated dialog to add functions.

Supporting `tool` scripts was an old feature request for the Visual Script and it a bother not have it working until now. This has been now fixed.

Construct / Instance is added to allow to create new Objects or Resources of any type which was impossible to do before in Visual Script. This feature is still a work in progress.

Other fixes for the Visual Script included minor bugs such as empty NodePath initialization issue when not having a currently active scene, fixing bugs in my current PRs, etc.

![New Create Function dialog](/storage/app/media/gsoc/2019-2/vs-001.png)

![Improved top bar with new options](/storage/app/media/gsoc/2019-2/vs-002.png)

### What's next?

To fix some other long-standing issues with Visual Script, get the current PRs merged or at least most of them.
Also work on the documentation.

-----

<a id="async-file-access"></a>
## Asynchronous Cached File Access – *Raghav Shankar*

- **Project:** Asynchronous Cached File Access
- **Student:** Raghav Shankar ([WarpspeedSCP](https://gist.github.com/WarpspeedSCP))
- **Mentors:** Ariel Manzur ([punto-](https://github.com/punto-)) and HP van Braam ([hpvb](https://github.com/hpvb))
- **Repository:** https://github.com/WarpspeedSCP/godot/tree/wip-patch

### Current progress

Since the last update, I've fixed a lot of bugs and made a bunch of simplifications to the design of the cache module.

* Lots of bug fixes.
* Reduced the use of synchronization primitives. Greatly reduces the complexity.
* It's possible to write to files as well now.

I've ended up straying from the schedule I set for myself in May in that I haven't finished implementing all the unbuffered file IO classes I had planned to, but they aren't strictly necessary for the module to function.

I would like to make things nicer by using some of the C++11 features when the engine moves to it for Godot 4.0, but until then, I'll continue improving things as they currently are.

-----

<a id="gdscript-lsp"></a>
## GDScript Language Server – *Ankit Priyarup*

- **Project:** GDScript Language Server
- **Student:** Ankit Priyarup ([ankitpriyarup](https://github.com/ankitpriyarup))
- **Mentors:** [Geequlim](https://github.com/Geequlim) and Lu Jiacheng ([Jason0214](https://github.com/jason0214))
- **Repositories:**
  * Student server working branch: https://github.com/ankitpriyarup/godot/tree/update-lsp
  * Mentor server working branch: https://github.com/GodotExplorer/godot/tree/gdscript-lsp
  * Student client working branch: https://github.com/ankitpriyarup/godot-tools/tree/updated-lsp-client
  * Mentor client working branch: https://github.com/GodotExplorer/godot-tools/tree/lsp-client

### Current progress

Since my first report on the GDScript Language Server, there have been a handful of improvements mostly in the Markdown documentation system.

- Better doc item indexing which parses the entire class structure and stores it in an `index.json` file within the Markdown documentation directory for faster lookups.
- Hyperlink support in Markdown docs so that by clicking on any link (class or method name) within the doc it will directly open that class or method.
- Visual improvements in the Markdown doc such as better spacing, indentation & paragraph shifts. Support for bold, italic and underline.
- Autocompletion for some methods also had an issue with its insert text bracket placement which has been now resolved.
- Rename symbol feature from before had a huge drawback i.e. it is incapable of renaming symbols found within different classes searching and replacing it won't be an efficient solution. GDScript is a dynamic typed language so it is hard to track references for symbols. So it's better to not implement this feature as it may cause bugs randomly. I suggest you use search and replace to do this kind of operations manually to avoid errors.

We are currently testing the framework on larger open source GDScript projects. Bugs are regularly being tracked at [ankitpriyarup/godot](https://github.com/ankitpriyarup/godot/issues). Any feedback and issues are welcomed, please feel free to put it on the GitHub issues.

### Coming up next

Our major task for now is fixing bugs within the current implementation and merging them with Godot's *master* branch. Later on we are also planning to port it to more popular editors like Atom and Emacs.

-----

<a id="interactive-music"></a>
## Interactive Music – *Daniel Matarov*

- **Project:** Interactive Music for Godot Engine
- **Student:** Daniel Matarov ([DanielMatarov](https://github.com/DanielMatarov))
- **Mentors:** Juan Linietsky ([reduz](https://github.com/reduz))
- **Repository:** https://github.com/DanielMatarov/godot/tree/Interactive-Music/modules/InteractiveMusic

### Current progress

For those who are not familiar with the project I suggest you check out [last month's blog post](/article/gsoc-2019-progress-report-1-part-1) so you are brought up to speed with what the project entails.

First I will begin with an update on how I've dealt with some of the issues I mentioned last time, specifically the memory leak crash in `AudioStreamPlaylist`, which was causing the preview generator to generate an endless preview.
Thanks to last month's blog post I got in contact with a game developer who was interested in the feature and we started having a back and forth conversation about the project. I sent him the most current build and after he tested it I got a question about why playlist is looping indefinitely and I realized that it's not actually meant to do that. After looking at the code, I noticed that the line which updates the current stream did not have a safety check:

```
current = (current + 1) % playlist->stream_count;
```

I have now changed this and also added looping and shuffle functionalities and now it looks like this:

```
if ((current+1) < playlist->stream_count) {
    current = (current + 1) % playlist->stream_count;
    playback[current]->start();
} else {
    if (playlist->loop == true) {
        current = 0;
        if (playlist->shuffle == true) {
            for (int i; i < playlist->stream_count; i++) {
                std::swap(playback[i], playback[std::rand() % playlist->stream_count]);
            }
        }
    } else {
        stop();
    }
}
```

Apart from fixing this, I have also been implementing `AudioStreamTransitioner`. My implementation however is slightly different from what I described last month. Initially I intended to have transitions and clips tied together, however after discussions with my mentor I decided it would be best if they are separate. The way it works now is the following:

1. The user selects the active clip .
2. The user activates the transition they want to use.

I managed to fit everything into the inspector and this is what it currently looks like:

![Empty AudioStreamTransitioner](/storage/app/media/gsoc/2019-2/interactive-music-001.png)

![AudioStreamTransitioner populated with some clips](/storage/app/media/gsoc/2019-2/interactive-music-002.png)

Transitioner has a default BPM which is used when a clip doesn't have an imported tempo. The BPM is used when the fading happens, which is based on beats — when a transition is active it fades based on the clips' BPM — the clip which fades out fades based on it's own BPM, and the same is for the clip which fades in. That allows the user to have clips with different tempos. Also, unless a transition is activated, a clip will loop indefinitely.
Another feature which I recently added was a transition clip, meaning that when this property is active, a clip set by the user will play in between the clips when transitions are activated.

Here is a video of the transitioner in action, showcasing most of its features. The clips which I'm playing are not specifically made for the purpose of this video but it still gives a decent idea of how the feature works:

<video controls>
  <source src="/storage/app/media/gsoc/2019-2/interactive-music-transitioner-demo.mp4" type="video/mp4">
</video>

### What's left to do

In the next couple of weeks until the deadline I will try to smooth out some of the fades and BPM functionalities in the transitioner, such as potentially having the fades only start on exact beats rather than as soon as a transition is activated, which makes more sense. I will also fix some of the clicks that happen during the fades.

Some other things to fix is to figure out why `.ogg` files seem to not be importing beat information properly.
Another thing to do is to add documentation for the two classes with brief explanations for the GDScript functions, since most of the in-game implementation will happen through script. And lastly, I would like to potentially make a video tutorial explaining how to use the feature.

Apart from this the feature is mostly complete and I am quite happy with the results. If anyone is interested in getting a current build of it, email me at *daniel.matarov at gmail · com* and I would love to hear your feedback!

-----

<a id="motion-matching"></a>
## Motion Matching Implementation Using KD Trees – *Aditya Abhiram*

- **Project:** Motion Matching Implementation Using KD Trees
- **Student:** Aditya Abhiram ([Aa20475](https://github.com/Aa20475))
- **Mentors:** Juan Linietsky ([reduz](https://github.com/reduz)) and [karroffel](https://github.com/karroffel)
- **Repository:** https://github.com/Aa20475/godot/tree/godot-motion-matching

So the final week is here! Some small but crucial things left.
I am currently working to my fullest to complete as much as possible!

### What's done

* Basic Motion Matching is working with Pose and Trajectory matching.
* Exposed controllable variables to user.
* UI is close to fully done.

### What's left

* Adding velocity matching.
* Replacing Brute force with KDTree for trajectory.
* Blending between chosen frames.
* Perfecting prediction mechanism.

### Current state of `AnimationNodeMotionMatch`

![GIF demo of AnimationNodeMotionMatch](/storage/app/media/gsoc/2019-2/motion-matching-001.gif)

-----

<a id="vcs-integration"></a>
## Version Control Systems Integration – *Twarit Waikar*

- **Project:** Version Control Systems (VCS) editor integration framework and Git plugin
- **Student:** Twarit Waikar ([IronicallySerious](https://github.com/IronicallySerious))
- **Mentors:** Gilles Roudiere ([groud](https://github.com/groud)) and Jairo Honorio ([jahd2602](https://github.com/jahd2602))
- **Repositories:**
  * Godot's framework for VCS integration (PR candidate): https://github.com/IronicallySerious/godot/tree/add-vcs-integration
  * Git interaction API plugin: https://github.com/IronicallySerious/godot-git-plugin

### Re-cap from progress report #1

The version control systems integration proposes to add a new UI to the editor which lets the user commit, stage, and view file differences from the last version and the current state of the file, in a presentable manner which helps improve the workflow of the user using the editor in terms of managing versions of the source code.

The integration mainly required 3 distinct verticals:

1. A version control themed editor plugin to place all the UI elements required.
2. An interface/API for the Godot editor to extract all VCS metadata from.
3. An implementation of the VCS interface for any of the popular VCSs in use.

Out of these, only the first and the second verticals are planned to be merged into Godot's *master* branch and the third vertical will be kept in a separate repository. The third vertical is a GDNative plugin (referred to as 'addon' further) that implements the VCS interface for interacting with Git.

Keeping the implementation separated from the interface helps us to create different behaviors of the VCS interface depending on what VCS is at use in the project. I have worked on the Git implementation as a part of GSoC 2019 and for any of the other VCSs, we are depending upon future work by fellow contributors.

### Complications faced since progress report #1

My mentors, Groud and jahd, and I realized the kind of architecture that we were hoping to accomplish was unsuitable for the kind of functionality that the existing engine API has. I have tried to summarize my entire research surrounding the topic of creating a GDNative addon that extends an API which is called to from within the editor, [in this devlog](https://github.com/IronicallySerious/gsoc-godot-vcs-devlogs/blob/master/2019-8-2.md).

You can also have a look at the [predecessor of the above-mentioned devlog](https://github.com/IronicallySerious/gsoc-godot-vcs-devlogs/blob/master/2019-7-08.md) to know more about what different types of complications we faced while designing the architecture for this sort of an involvement between the editor and the GDNative addons.

### 1. Version control editor plugin

This editor plugin is responsible for providing all VCS integration UI elements to the editor and hands the data extraction and error handling related to the VCS interface/API.

The entire VCS interaction is fired off by the `Set Up Version Control` dialog (same as previously reported but with an internal working change):

![Set Up Version Control dialog](/storage/app/media/gsoc/2019-2/vcs-001.png)

In the above screenshot, the name `GitAPI` is coming directly from the GDNative addon that implements the Git interaction. If you'd like to know how we managed to detect addons from the editor and use it to implement an API which is consumed by the editor, you can refer to the devlog links in the previous section. The solution came out to be rather simple but it required some extensive research from both my mentors and me since this use case of GDNative was rather an odd one. Anyway, we are happy to share the results that we have found.

When the Git addon is initialized, the addon also initializes a bare `.gitignore` file. All these behaviors are handled by the addon so the engine is not required to do any of the VCS specific tasks.

Currently, we can expect the Commit panel to look similar to what is shown below (not representative of the final version):

![Current state of the Commit panel](/storage/app/media/gsoc/2019-2/vcs-002.png)

You may notice in the panel above that the 'Refresh' button has recently been clicked and the 'New' section of the tree has been populated.

![Commit panel with expanded New tree](/storage/app/media/gsoc/2019-2/vcs-003.png)

Upon opening this tree, you shall see a list of all the new files that have been added to the Git repository. Since the demo project doesn't come with a pre-initialised Git repository, all the files of the project are currently recognized as newly created files. The checkboxes shall be indicative of whether a file will be added to the stage or not. This is similar to selecting what input we need to provide the `git add` command.

The next major UI element that the Version Control Editor Plugin provides is the Version Control dock which will likely be placed among the bottom docks likewise:

![Version Control bottom dock](/storage/app/media/gsoc/2019-2/vcs-004.png)

The left side will be showing the version of the file in the previous commit, and the right side will be showing the newer changes for the file. The panel UI will remain, however, the logic which displays the difference contents is in works.

### 2. Editor VCS interface

As explained earlier, the engine editor is theoretically not allowed to even know the name of the version control system that is in use. This means that the editor needs to consult an API that extracts all such data from the GDNative based VCS addons available to the engine.

This interface is functionally complete. It currently defines all methods that the editor requires, which act as proxies to the methods defined in the GDNative addon. Thus, a function like `get_vcs_name()` would reply with a "Git" response, which has essentially originated from the GDNative addon.

The proxy architecture in play here has particularly helped us to create an API which does not require the implementation addon to implement the entire variety of methods defined in the API. The addon can accomplish far less and still provide enough data for the editor to correctly display the data extracted by the GDNative addon.

### 3. GDNative-based Git addon

We are using [libgit2](https://libgit2.org), which is a C library described by the libgit2 developers themselves at [their Github project](https://github.com/libgit2/libgit2):

> libgit2 is a portable, pure C implementation of the Git core methods provided as a linkable library with a solid API, allowing to build Git functionality into your application.

Since it is a C implementation, we have successfully linked libgit2 to the GDNative C++ bindings along with our addon logic for extraction of Git metadata as well as repository data. The architecture being followed to call into libgit2 has been explained in the devlog that I mentioned in the previous section.

So far, with the help of libgit2 we have been able to replicate the functionality of Git commands like `git init`, `git commit`, `git add`, and `git diff` using libgit2 with the help of their extremely thorough [user guides](https://libgit2.org/docs/guides/101-samples/).

### Closing notes

I am glad to be working on this project idea, and seeing it in its close-to-mature form as it is currently is a delight. I plan to finish the remaining bits in the next week and deliver some instructions to use this feature in the next report.

-----

That's it for this second progress report from our 8 GSoC students.
We hope that you will find good use cases for all the features that are being worked on, and we thank all students and mentors for their dedicated work on these projects!

---
title: "GSoC 2019 progress report #3"
excerpt: "For the second time, Godot took part in the Google Summer of Code (GSoC) programme, which lets students from all over the world work for three months on specific projects thanks to a Google stipend.
We had 8 students working for on great new features all around the engine, and in this third and last progress report, they outline the final state of their GSoC work, how to use it (when relevant) and future steps that they might envision for the feature they worked on."
categories: ["progress-report"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5d7/52f/458/5d752f4583d2e116311872.png
date: 2019-09-08 16:42:54
---

For the second time, Godot took part in the [Google Summer of Code](https://summerofcode.withgoogle.com) (GSoC) programme, which lets students from all over the world work for three months on specific projects thanks to a Google stipend.

We had 8 students working for on great new features all around the engine, and they reported on their progress regularly on this blog, with a first ([part 1]({{% ref "article/gsoc-2019-progress-report-1-part-1" %}}) and [part 2]({{% ref "article/gsoc-2019-progress-report-1-part-2" %}})) and [second]({{% ref "article/gsoc-2019-progress-report-2" %}}) progress report.

In this third and final progress report, we asked the students to outline the final state of their GSoC work, how to use it (when relevant) and future steps that they might envision for the feature they worked on. We also encouraged them to share words on their personal experience as GSoC students working with the Godot community.

Here is the list of projects and students with links to the relevant sections.

- <a href="#visual-scripting">Improvements to the Visual Scripting System</a> by Swarnim Arun
- <a href="#gdscript-lsp">GDScript Language Server</a> by Ankit Priyarup
- <a href="#async-file-access">Asynchronous Cached File Access</a> by Raghav Shankar
- <a href="#motion-matching">Motion Matching Implementation Using KD Trees</a> by Aditya Abhiram
- <a href="#interactive-music">Interactive Music</a> by Daniel Matarov
- <a href="#vcs-integration">Version Control Systems Integration</a> by Twarit Waikar
- <a href="#static-analyzer">Static Analyzer for GDScript</a> by Suhas Prasanna
- <a href="#lightmapper">Rewriting Godot's Light Mapper</a> by Joan Fons Sanchez

-----

<a id="visual-scripting"></a>
## Improvements to the Visual Scripting System – *Swarnim Arun*

- **Project:** Improvements To Visual Scripting System
- **Student:** Swarnim Arun ([swarnimarun](https://github.com/swarnimarun))
- **Mentors:** Ernest Lee ([fire](https://github.com/fire)) and Anish Bhobe ([KidRigger](https://github.com/KidRigger))
- **Repositories:**
  * https://github.com/swarnimarun/godot/tree/vs-graph-unification and other branches with `vs` prefix
  * PRs on upstream repository: [GH-29681](https://github.com/godotengine/godot/pull/29681), [GH-30852](https://github.com/godotengine/godot/pull/30852), [GH-31044](https://github.com/godotengine/godot/pull/31044)

It's been a long fun experience working on improving one of the tools I so love to use and have been using for a very long time now. This experience has made me aware of a lot of new things and has allowed me to cherish the <abbr title="Open Source Software">OSS</abbr> community and the effort of all the contributors to Godot even more.

If you want to try the new changes outlined below, you can use this [custom build](https://drive.google.com/open?id=1D-IEYguJPcNkqhfh8TItgmvGH0tKhR41) (Linux, Windows).

### Work done

A detailed list of all the work done in this GSoC project.

-> Each PR will have its own list of changes mentioned.

#### Visual Script graph unification

**Branch:** https://github.com/swarnimarun/godot/tree/vs-graph-unification

**Pull Request:** [GH-29681](https://github.com/godotengine/godot/pull/29681)

- The graph for the **Visual Script has been unified**, that is, all the functions are shown in the graph simultaneously. As of now, there's a default function behind the scenes that makes this possible. It's supposed to be changed to refactoring the ownership model of the Visual Script graph by making the VisualScript nodes held by a list inside the graph and not inside the functions.
- The VisualScript nodes figure out which function they belong to from the connections that they have.
- **Port connection swapping** was also added as a minor UX improvement. Basically, the nodes are aware of whether the changed port already had a connection or not; if it does then the connections are swapped on reconnection, otherwise it's ignored.
- There's also **auto constructor addition** to the graph in case there's a need for type conversion, completely incompatible type ports don't connect which makes committing silly mistakes much more difficult but the `Any` type can still connect to all the ports.
- Then there are **in-graph editable nodes**, which provide a simple yet powerful UX improvement to the Visual Script. These nodes need to inherit from the `VisualScriptLists` virtual class which has certain conditions for itself hardcoded in the editor that provide the Node with editable input and output value ports.
- A **right-click "popup" search menu** was also added, and the sidebar was mostly moved to the top providing more room for the member list and the graph as well.
- A **helper dialog to add functions** was also created to make adding new functions more straightforward.
- And dozens or other fixes involving VisualScript nodes, adding Fuzzy Search functionality, working on improving Type Guessing, and more.

**Graph unification**
![Demo of graph unification](/storage/app/media/gsoc/2019-3/vs-001.gif)

**Port swapping**
![Demo of port swapping](/storage/app/media/gsoc/2019-3/vs-002.gif)

**In-graph editable nodes**
![Demo of in-graph editable nodes](/storage/app/media/gsoc/2019-3/vs-003.gif)

**Right-click menu**
![Demo of right-click menu and topbar](/storage/app/media/gsoc/2019-3/vs-004.gif)

**Helper dialog for function creation**
![Demo of helper function creation dialog](/storage/app/media/gsoc/2019-3/vs-005.png)

#### Visual Script tool script

**Branch:** https://github.com/swarnimarun/godot/tree/vs_tools_script

**Pull Request:** [GH-30852](https://github.com/godotengine/godot/pull/30852)

This is the tool script functionality for VisualScript. It simply adds the UI and the internals to allow for tool scriptability. There is not much extra to the visual script and this means that the compatibility has not been broken and this might even allow the PR to be cherry-picked for the older versions of Godot.

#### Visual Script Instance/Construct node

**Branch:** https://github.com/swarnimarun/godot/tree/vs_construct_node

**Pull Request:** [GH-31044](https://github.com/godotengine/godot/pull/31044)

Allows to instance any of the instantiable classes from ClassDB similar to how GDScript does it. With managed memory allocations. It's still to be decided if the memory should be managed or not, most probably it will take a flag to decide if the memory is supposed to be managed or not.
Or we will have to create a wrapper class to allow for proper ref counted allocations and deallocations inside Visual Script. And mostly needs further testing to figure out which approach would be the best overall.

The current implementation directly references and deallocates the reference on the Script destruction or next compute cycle of the Visual Script Node system's step function.

#### Visual Script getters and setters

**Branch:** https://github.com/swarnimarun/godot/tree/vs-getset

**Pull Request:** [GH-31572](https://github.com/godotengine/godot/pull/31572)

This is meant to add getter and setter functionality to the Visual Script variables similar to the GDScript getters and setters.
The functionality is added directly to the VisualScript language, by additions to the Get and Set functions, with indirect function calls and the GUI is supposed to allow for the nodes to select a function from the graph from a drop down list.

### Getting started with these features

For now, I have made [custom builds](https://drive.google.com/open?id=1D-IEYguJPcNkqhfh8TItgmvGH0tKhR41) including my changes for Linux and Windows.
You can build the Godot source as well just as you would normally but you would have to pull [from my branch](https://github.com/swarnimarun/godot/tree/vs-graph-unification).

If you find any bugs feel free to report it in the PR itself ([GH-29681](https://github.com/godotengine/godot/pull/29681)).
If it has been merged you could also create it as a separate issue on GitHub and ping me using my handle `@swarnimarun`.

#### Walkthrough/tutorial

Here's a quick walkthrough of the features changes of the project from a usability perspective that you might want to read to quickly get used to all the changes done.

The basic process of everything remains the same and so I will just highlight the pertinent changes in the project.

- You can now right-click to bring up the Node Search menu.
- You now have a proper dialog box to create functions, it's much easier to add input arguments and such.
- Type Conversion nodes are now added on their own, just to ease the overhead of adding an extra node. Incompatible type ports don't usually connect either.
- All the functions are now in the same graph but interconnection between the functions are not there (at least not yet).
- Data nodes are disconnected; in case connections from multiple connections are present the current connection that you make takes precedence.
- The connection is what derives which function a node is a part of, by default the functions are part of a default function which is inaccessible.
- You can use Ctrl + G to quick create functions from the selected nodes.

### About the project experience

#### Minor regrets

There were a few things I think I could have done better which would involve a better testing and debugging setup. Setting up the debugging caused me to waste some of my time, and I should probably have had a testing workflow prepared for stress testing the changes I was going to make.

But things can always be better ;)

#### Things that went well

To be honest things went a lot better than I had expected, other than a few minor setbacks and changes in the plan most of the work has been completed and we're getting close to having the PR for the graph unification merged. I know there will be bugs but there always are...

I enjoyed every single day I spent working on the project (apart maybe from the mindless debugging :)), and especially following a more thoughtful method of working on project goals.

#### Is anything else left?

Not really but perhaps, to be honest, there are a lot more things that I would want to do and I do intend to work on them.
And not just the Visual Scripting part but the editor as a whole and probably some other aspects as well. I really would like more joints to make the 2D physics applications simpler, or some changes with the rendering as well. Several of my ideas might be compatibility breaking changes, so I will create PRs once we have moved on to working for Godot 4.0.

### Final words

To sum it all up, the journey of GSoC has been a really amazing one and I not only learned new things in the process but also hopefully made some constructive contributions to the project. And hopefully I will be able to continue to help the project as a whole in whatever capacity I can. :)

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
- **Pull Requests:**
  * [godot#31937](https://github.com/godotengine/godot/pull/31937)
  * [godot-vscode-plugin#112](https://github.com/godotengine/godot-vscode-plugin/pull/112)

It was an incredible learning experience with GSoC and Godot Engine! I can’t believe three months have passed so quick that I’m writing this final report, summarizing all the exciting work I did this Summer (27 May - 26 Aug 2019).

### What's the project?

The integrated script editor in Godot lacks features found in editors like VS Code, Sublime, Emacs, etc. These editors are also more popular among developers and therefore many want to switch to them for their usability. However, to implement core functionalities such as diagnosis, registering custom symbols, jumping to definition, etc. a Language Server structure has to be adopted. For example, the client (say VS Code) will communicate with the Godot Language Server to get desired results.

Microsoft's Language Server Protocol (LSP) is flexible and powerful to implement these functionalities. It also supports many editors - VS Code, Atom, Sublime, etc. Hence, instead of writing complete extensions for each editor (client), using LSP the server is the same for all and only the clients have to be implemented as an editor extension.

### Installation

Currently, the pull request has yet to be merged with the actual Godot working repository. To run the LSP implementation, client (extenral editor) and server (Godot) both need to be run seperately. The client implemented in this project is a [VS Code extension](https://github.com/godotengine/godot-vscode-plugin). Open it inside VS Code and first install required dependencies using the `npm install` command; after that, running it will simply open the client in the Extension Development Environment. To create an output extension format from the project use `vsce`, you can learn more about it from the [VS Code documentation](https://code.visualstudio.com/api/working-with-extensions/publishing-extension).

### GSoC journey

**Community bounding period**<br>
I started off with getting familiar with Godot's code base and understanding the previous implementation of Godot Tools (a pre-exisiting VS Code integration plugin). I also got familiar with my mentor and other developers over IRC.

**Coding period #1 (May 27, 2019 - June 24, 2019)**<br>
My mentor Geequlim already had a basic version of LSP server and client for VS Code implemented, so my task was to improve upon it, try to identify possible point of failures and also include all the expected features. At first we implemented Error Diagnostics: every time a change is detected by the LSP Server from the client, diagnostics are updated i.e. errors and warnings along with their relevant informations such as range and message are being parsed by an Extended GDScript Parser.

**Coding period #2 (June 28, 2019 - July 22, 2019)**<br>
Geequlim has been very active throughout, during this period initially he implemented an entire symbol cache pool while I was working on the Code Completion feature. The cache pool is filled at the startup by parsing all scripts in the workspace for script symbols and loading native symbols from Godot's `DocData`. Later on I used that symbol pool to implement features such as - Hover Provider, Function Assist, Symbol Resolve & Go to definition.

At the end of this period I started implementing a documentation system. It started off with me understanding what will be necessary for the VS Code plugin, as Godot's online documentation relies on Sphinx for rendering docs in ReStructuredText format, but I realized that it would be better to have docs in Markdown for compatibility with VS Code.

I've also worked on a rename symbol feature during this time which I couldn't complete as there were cases which it was still missing (see [this issue](https://github.com/ankitpriyarup/godot/issues/5)), I'm looking forward to fixing it post-GSoC period.

**Coding period #3 (July 26, 2019 - August 19, 2019)**<br>
I improved upon the Markdown rendering system, I added a link system in it so that one can jump to the documentation of another class by clicking on its name within the docs. Next I added a regex parser capable of parsing the class name on 'View Symbol Documentation'. In case the parsed symbol isn't recognised, a list of all the symbols will be shown.

Lastly I implemented Document Link support for direct access of files within GDScript using Ctrl+Click or Cmd+Click on path strings. Relative paths are also supported.

The majority of my tasks within the final month revolved around testing the framework on larger open source GDScript projects. Bugs are regularly being tracked.

### Acknowledgments

I would like to thank my mentor and the folks at Godot for offering their advice and help when reviewing my code and also when answering my queries on the community IRC chat. These three months have been the best coding experience of my life. Thanks to Google for providing me this amazing opportunity of working with Godot. I've learnt a lot within this period.

I'm looking forward to contribute and work upon things that I missed post-GSoC and also encourage others who wish to contribute to this part of codebase.

-----

<a id="async-file-access"></a>
## Asynchronous Cached File Access – *Raghav Shankar*

- **Project:** Asynchronous Cached File Access
- **Student:** Raghav Shankar ([WarpspeedSCP](https://gist.github.com/WarpspeedSCP))
- **Mentors:** Ariel Manzur ([punto-](https://github.com/punto-)) and HP van Braam ([hpvb](https://github.com/hpvb))
- **Repository:** https://github.com/WarpspeedSCP/godot-cacheserv

### Motivation

The goal of my project was to replace the already existing `FileAccessBuffered` class with a more flexible and robust solution for caching IO without relying on the OS, on any platform including desktop and consoles.

The old solution to the problem of cached IO was to use `FileAccessBuffered`. This was a problem because `FileAccessBuffered` only supported reading ahead and did not allow for seeking.

### Current state

The solution I have developed is to provide a separate "cache server" module to allow for caching within the engine. This module's functionality is focussed around two classes: `FileAccessCached` and `FileCacheManager`. `FileCacheManager` is a custom server class that performs the caching and manages all the cached files. It acts as a middleman between the engine and the OS.

`FileAccessCached` is the interface through which the engine interacts with `FileCacheManager`. It provides an interface similar to the built in `FileAccess` API and supports all operations that can be performed on a normal `FileAccess`.

Though `FileCacheManager` has only one front end, it is possible to use any class that inherits from `FileAccess` as the backing interface. Ideally, the user would want to use an unbuffered interface on the backend (like the `FileAccessUnbufferedUnix` class I've included in the module as an example). It should even be possible to use classes such as `FileAccessNetwork` with this module.

Currently, there is no way to select the backing file interface in `FileCacheManager`, but I will include a way to do that soon. I also need to finish the implementation of `FileAccessWindows`, and there's still at least one bug left to solve.

This project is by no means complete, but it's getting there. I'll continue working on it to get it in a better state.

If you'd like a clearer picture of how the module works, I suggest you look in the [GitHub repository](https://github.com/warpspeedscp/godot-cacheserv).

There's also a [test repository](https://github.com/WarpspeedSCP/godot-cacheserv-test-project) I made to sort of stress-test the module.

*Beware, the code in the repo is not currently in a ready state, and it will spew a ton of log messages at you if you try it out.*

### A brief history

This project had quite a bumpy beginning. While the design I'd envisioned used a technique known as [paging](https://en.wikipedia.org/wiki/Paging) to provide the caching behaviour, what I started out with was quite off the mark; it was more akin to [memory management](https://en.wikipedia.org/wiki/Memory_management) than paging. Punto caught me out on this when I talked to him about it, and from there, I got started with the module in earnest.

A similar thing happened later on as well when I tried to make a very convoluted system to handle the problem of keeping files cached even if the backing source was closed.

Throughout June, the basic framework of the module was established. In July, I focussed on getting the kinks out for the design and making incremental improvements. Sadly, I didn't really follow any testing methodology while developing this module, which is something I regret now. I spent most of August weeding out bugs. It was a mostly successful endeavour.

### Bugs

Speaking of bugs, the one major bug that's blocking me right now has to do with the read operation.

`FileCacheManager` internally uses a Multiple-Producer Single-Consumer (MPSC) queue to atomically send messages for reads and writes to the IO thread from other threads. In certain cases, successive read operations which are pushed onto the queue seem to overwrite each other.

For example, this means that enqueueing three separate operations results in all but the last operation from actually being enqueued.

### What I've learnt

- Designing a system is hard. But it's pretty fun too.
- Make any system multithreaded and its complexity immediately skyrockets.
- Always remember to run your code through the debugger once, without breakpoints. It helps a lot when looking for (non)obvious runtime errors.
- It's ok not to be perfect. It all comes in due course.
- Don't overthink things. It's not worth the effort.

### Acknowledgements

I'm really grateful to my mentor punto for his help. He always has great advice for me, and he's a really chill guy. Actually, that could apply to the entire Godot engine community too. You're all awesome, guys.

I'd also like to thank all the other GSoC students who completed their journey with me. It was a fun ride. 11/10, would do it again.

I couldn't thank my parents and my friends enough for the encouragement and support they've given me. I wouldn't have thought of participating in GSoC if it weren't for them.

-----

<a id="motion-matching"></a>
## Motion Matching Implementation Using KD Trees – *Aditya Abhiram*

- **Project:** Motion Matching Implementation Using KD Trees
- **Student:** Aditya Abhiram ([Aa20475](https://github.com/Aa20475))
- **Mentors:** Juan Linietsky ([reduz](https://github.com/reduz)) and [karroffel](https://github.com/karroffel)
- **Repository:** https://github.com/Aa20475/godot/tree/godot-motion-matching

First of all, I want to thank the Godot project and my mentors, Juan Linietsky and karroffel, for giving me a chance to work on this project.

I'm so excited to share my experience while working on   this project! This project changed my perspective towards open source.

### Motivation

Godot, being an open source game engine, was built with a *never-ending wish of adding new features to it*.

Motion matching is one of the latest features in game animation which is quite revolutionary. Usually, setting up a basic animation system needs a lot of work and time. Even after that, we barely manage to make a perfect one. Motion matching, on the other hand is a method where the computer chooses the best pose for each frame by itself from a huge database of motion capture (*MoCap*) data using some algorithm.

> Choose the best pose for each frame and jump to it!

This wonderful feature needs to be included in Godot!

### How to use this?

Here is a small tutorial on how to use it... It's still not stable and needs a lot of optimization.

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/TSyEniSzVfo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

**If you are interested to know how we worked on the project... read on!**

### What was the plan?

- Starting by implementing simple Pose and Trajectory matching using brute force approach.
- Building on it by adding KDTree for optimization.
- Experimenting with it as much as possible!

**How does motion matching work?**

![Motion matching](/storage/app/media/gsoc/2019-3/motion-matching-001.png)

### How it went!

**Community bonding period**<br>
I started getting familiar with Godot's API and trying to implement simple projects in it. I also got familiar with my mentor and other developers.

**Coding period #1 (May 27, 2019 - June 24, 2019)**<br>
We started by collecting datasets for testing while reduz worked on the UI of the editor. By mid-June, reduz made a basic structure where I needed to plugin my functions in. And by the time of the first evaluation, I had a barebones KDTree and KNNSearch up and running!
I then tried implementing a basic future trajectory prediction function.

**Coding period #2 (June 28, 2019 - July 22, 2019)**<br>
I started building a Simple Pose and Trajectory Matching System which uses a brute force approach and added some UI improvements. Started working on some small crashes and minor details.

**Coding period #3 (July 26, 2019 - August 19, 2019)**<br>
Started working on exposing needed parameters to the users.
Bugs persisted but I worked my best to fix stuff. Tried to replace brute force approach with KDTrees. It worked but was considerably heavy, with a **strong need for optimization**. Started working on fixing parameter issues (*it is not choosing while playing the scene because of these errors)*, which I kept struggling with during the final work submission period.

### My thoughts about this project

Godot and its people are amazing! I enjoyed working with them a lot! My mentors were especially very helpful. They taught me even the smallest of things, patiently. I'm very thankful for giving me a chance to work on this project.

Coming to the project: Understanding the awesome Godot API was a good experience. Initially, I thought that motion matching could be completed in a considerably short time. But it turned out to be more complicated than I expected.

#### Challenges I faced

- Implementing KDTrees and KNN search was itself a challenging task. I tried my best but was unable to optimize it.
- Choosing a proper prediction function took some thinking. Implementing a simple trajectory and pose choosing system was easier.
- Filling tracks with incomplete keyframes.
- Making a way through which the user can set the velocity.
- Get it to run when playing the scene.

### What's left?

- Add velocity matching.
- **Get it to work when the scene is playing.**
- Optimizing the KDTree and KNNSearch algorithms.
- Considering past samples too in matching.

-----

<a id="interactive-music"></a>
## Interactive Music – *Daniel Matarov*

- **Project:** Interactive Music for Godot Engine
- **Student:** Daniel Matarov ([DanielMatarov](https://github.com/DanielMatarov))
- **Mentors:** Juan Linietsky ([reduz](https://github.com/reduz))
- **Repository:** https://github.com/DanielMatarov/godot/tree/Interactive-Music/modules/InteractiveMusic

### Project overview

The aim of this project was to implement an interactive music feature to Godot Engine, which consists of adding tempo and beat functionalities to existing `AudioStream`s and adding two new classes, called `AudioStreamPlaylist` and `AudioStreamTransitioner`.
The new BPM functionalities work by setting a BPM to an `AudioStream`, and transitioner and playlist are able to count the samples with accuracy, the number of which depending on how many beats the user has input, either on a stream in Playlist, or fades in Transitioner.

`AudioStreamPlaylist` can play multiple `AudioStream`s in a sequence, based on their tempo and beats. The class has options for looping and shuffling the clips, and can take up to 64 clips.

The way the code works is by calculating the length in samples of a stream's beat count, based on their or the playlist's default tempo, and processes them in small blocks. When the frames are all processed, the next stream's samples are calculated, and the process starts again, then the previous stream has a brief and unnoticable fade out while the next stream starts. This allows for accurate time keeping and seamless change in clips.

`AudioStreamTransitioner` can crossfade between different streams, or "clips". Because a transition can be activated at any time, clips will loop indefinitely until a transition is triggered. Each transition has times for fading out and fading in, based on beats. The length in samples of the fades is determined by the user input beats and the BPM of the two streams, meaning the fading out stream's fade in samples are calculated through its own BPM, and the fading in stream's samples are calculated through the BPM of that stream. Optionally a transition clip can also be used, which allows for a transitionary clip to be played in between the current and previous clip. The transition clip fades in while the previous fades out, plays through its samples, based either on its length or beats, and finally fades out as the new clip fades in.

### How to use the feature

I have made two video tutorials, explaining how to use each class, and I have also created documentation explaining what each GDScript function does, which can be found in the docs help in the editor.

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/RKMyb0WuBMc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/1aNV5DjJu58" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

### Challenges encountered

One of the first challenges I faced was to figure out how the initial code was going to work. With some help from my mentor who explained a lot of the basics to me, I managed to get a very basic version of Playlist working, however it had the problem of a memory leak, which took me a while to fix. As mentioned in the [previous]({{% ref "article/gsoc-2019-progress-report-1-part-1" %}}#interactive-music) [two]({{% ref "article/gsoc-2019-progress-report-2" %}}#interactive-music) progress reports, the issue was that the preview generator for audio streams was trying to create an infinite preview and that would take up all of my computer's RAM. The issue was solved through communicating with a developer interested in the feature who asked me why does Playlist loop indefinitely, at which point I realized somethig was not right. More info on this can be found in [Progress report #2]({{% ref "article/gsoc-2019-progress-report-2" %}}#interactive-music).

Another big challenge was figuring out the logic for Transitioner, and then adding functionalities for a transition clip in the logic. This was probably the biggest piece of mixing logic I have ever written and it was a very interesting challenge to do it properly and also debug any issues with it.
One of the problems with this was that I could hear a click when fades were happening. Figuring out the source took some back and forth in the dev chat and it was noticed that what was happening was extra frames were being processed ([screenshot of the signal](https://imgur.com/a/egL7Gua)).
I realised that the reason this was happening was because, at the end of a transition, the samples left to process would be smaller than the buffer size, which is what the mix logic uses as block size.

{{< highlight cpp >}}

for (int i = 0; i < to_mix; i++) {
    p_buffer[i + dst_offset] = pcm_buffer[i];
}
dst_offset += to_mix;
p_frames -= to_mix;
clip_samples_total -= to_mix;

{{< /highlight >}}

The way I fixed it was by adding a check to see if the remaining transition samples are smaller than 0. The reason I am checking if they are smaller than 0 is that the buffer size will be subtracted from the number of remaining transition samples before the frames are sent to the final buffer. Meaning that if `transition_samples < 0`, that means the last block of transition samples is about to be processed.

{{< highlight cpp >}}

if (transition_samples < 0) {
    for (int i = 0; i < transition_samples + to_mix; i++) {
        p_buffer[i + dst_offset] = pcm_buffer[i];
    }
    dst_offset += transition_samples + to_mix;
    p_frames -= transition_samples + to_mix;
    clip_samples_total -= transition_samples + to_mix;
    transition_samples = 0;
} else {
    for (int i = 0; i < to_mix; i++) {
        p_buffer[i + dst_offset] = pcm_buffer[i];
    }
    dst_offset += to_mix;
    p_frames -= to_mix;
    clip_samples_total -= to_mix;
}

{{< /highlight >}}

### What's next

Ideally, I would like to merge the project with Godot's master branch and for it to become the go-to feature for music implementation. I plan to keep working on the two classes and try and take feedback from other users on what could be improved. I think the video tutorials I have made for this will show people how they currently work and hopefully receive useful input on how I can make them better.

Some other things I would like to add is a counter which waits until a single beat is finished before it starts transitioning, which would make more sense than a transition starting immediately when it is triggered. I also think that it would be good to change the way crossfading works. Currently, the volume values of the fading streams are not connected to each other.

{{< highlight cpp >}}

float fade_out_start_volume = 1.0 - float(fade_out_samples_total - fade_out_samples) / fade_out_samples_total;
float fade_out_end_volume = 1.0 - float(fade_out_samples_total - (fade_out_samples - to_fade_out)) / fade_out_samples_total;
float fade_in_start_volume = 1.0 - float(fade_in_samples) / fade_in_samples_total;
float fade_in_end_volume = 1.0 - float(fade_in_samples - to_fade_in) / fade_in_samples_total;

{{< /highlight >}}

When fade times are different, it's possible to get the sum of their values to go over 1.0, which would cause a click. I think that finding out how to fix that will be one of the first things I will change moving forward.

### What I learned throughout GSoC and closing remarks

This project has been a very interesting experience in terms of learning how audio really works behind the scenes. Learning how the logic behind things I use almost every day works, and coming up with my own versions of them was very challenging and worthwhile. I now feel a lot more confident in my coding skills than I did before this year's GSoC. I also got the chance to talk to some very good developers in the dev chat who gave me some important insight into some of the issues encountered along the way. The complexity of this project also led me to learn how to operate a debugger, in order to find the sources of various crashes, and clicks in my crossfading logic.

I would strongly encourage future students to participate in Google Summer of Code with Godot Engine, as the community is very welcoming to all levels of experience and I have personally learned a lot!
Thanks to this project and my last year's work I have managed to secure interviews with game studios so I think that for anyone looking to get that important initial experience in game engines working with Godot is an amazing opportunity!

-----

<a id="vcs-integration"></a>
## Version Control Systems Integration – *Twarit Waikar*

- **Project:** Version Control Systems (VCS) editor integration framework and Git plugin
- **Student:** Twarit Waikar ([IronicallySerious](https://github.com/IronicallySerious))
- **Mentors:** Gilles Roudiere ([groud](https://github.com/groud)) and Jairo Honorio ([jahd2602](https://github.com/jahd2602))
- **Repositories:**
  * Godot's framework for VCS integration: [GH-31461](https://github.com/godotengine/godot/pull/31461) (merged!)
  * Git API GDNative plugin: https://github.com/godotengine/godot-git-plugin

### Project description

The Version Control Systems Integration project introduces VCS (short for 'Version Control System') management from within the Godot editor. Currently, we have a Git management implemented for Godot and ready to use. However, support for other VCSs is supported and addons for these projects can be easily implemented using Godot's scripting API. Thus, Git management has been implemented in C++ with GDNative using [libgit2](https://libgit2.org).

### Installation

1. Download the latest release from the [Git addon GDNative plugin repository](https://github.com/godotengine/godot-git-plugin/releases). Extract the contents in the root of your Godot project folder.
2. Open the Godot project in the editor. You need a recent nightly build (or upcoming official alpha build) of Godot 3.2 with the VCS integration to test this feature.

That is it! This is the courtesy of how we have used GDNative and the existence of GDNative singleton libraries that are instantiated at runtime.

### Instructions

When the project loads up, you are greeted with the Godot editor that you know and love. However, you now have the option to set up a VCS addon from the editor.

1. Open `Project` > `Version Control`. Select `Set Up Version Control`. If that menu is missing, your Godot build is not recent enough to include the merged interface.

![Set Up Version Control](/storage/app/media/gsoc/2019-3/vcs-001.png)

2. A popup will ask you which VCS addon would you like to use. In our case we are using Git, so select `GitAPI` from the drop-down menu. Then click `Initialize` and close the popup.

![Initalize the GitAPI plugin](/storage/app/media/gsoc/2019-3/vcs-002.png)

*If you are not able to see a `GitAPI` option then this means that you don't have the addon binaries present in your project folder.*

3. Open the `Commit` tab that you can see alongside the `Inspector` and `Node` tabs. At first, you will see that every file in the project folder is counted as a new addition to the repository since we have started from a VCS-less project. If you already have Git running on your project then the addon should be able to just use your existing repository.

![Staging area in the Commit tab](/storage/app/media/gsoc/2019-3/vcs-003.png)

  * The `.gitignore` and `.gitattributes` are Git-specific configuration files and creating them in the project folder is handled by the Git addon, without consult from the Godot editor. You can edit them afterwards for a customized Git experience. If you are using an existing Git repository then the Git addon will use your existing Git configuration files by default.

  * To manually enforce a change in the project files, we have also provided a `Refresh` button that detects changes manually. If your file change is not showing up in the staging area, then consider checking `.gitignore` to see if your file has been ignored by Git in the first place.

4. Stage the files that you would like to commit in the next version by checking the required files and clicking `Stage Selected`. If you are working in a new Git repository then `Stage All` will stage all the files present in the staging area.

5. After staging, the staging area will acknowledge the file changes with a green tick.

![Overview of staged files](/storage/app/media/gsoc/2019-3/vcs-004.png)

Alternatively, if you would like to not stage `default_env.tres` (for example) then you should be able to just uncheck `default_env.tres` and press `Stage Selected`. Thus, you may get a view similar to the one below.

![Staged files with one file ignored](/storage/app/media/gsoc/2019-3/vcs-005.png)

This way, `default_env.tres` will not get committed in the next version.

6. Add a nice commit message and click `Commit Changes`.

![Typing a commit message](/storage/app/media/gsoc/2019-3/vcs-006.png)

You may also notice that the number of staged files is also reported. This is for your utility where you may like to confirm if you are committing the correct project files.

7. After clicking `Commit Changes` you can start working on the next version of your project!

8. When you are done, you can choose to shut down the VCS API with the selected addon by selecting `Project` > `Version Control` > `Shut Down Version Control`. This will take away the VCS integration related GUI and return you to the normal state of the editor without the VCS integration.

### Useful features

#### Stage status

At every Git index change, you are notified of the number of files in the stage, the number of files committed and any errors that you may like to fix before committing the next version in history.

#### Diff viewer

You would have also noticed the `Version Control` dock at the bottom of the Godot editor.

![Version Control bottom dock](/storage/app/media/gsoc/2019-3/vcs-007.png)

While staging files to the next version, you can view the file changes in the diff viewer. Just click on the file name in the Staging Area and you will see the diff appear in the bottom Version Control dock. Git doesn't show a diff for new files, thus to test this you will have to commit a file first before making changes to it.

For example, let's say we committed `new_script.gd` once, and then made some changes to it. After saving the changes, we shall see the following view.

![Adding a change to a committed script](/storage/app/media/gsoc/2019-3/vcs-008.png)

Clicking the file name in the Staging Area will show us the following diff.

![Viewing the diff in the Version Control dock](/storage/app/media/gsoc/2019-3/vcs-009.png)

The diff area also has a manual refresh button on the top right of the Version Control panel to refresh the diff if you feel your changes have not been reflected in the diff shown.

### Closing notes

The VCS Integration has a basic set of tools available at your disposal to maintain the versions of your game from within the editor. The integration is in an improvable state where it demands more attention to incorporate features such as solving merge conflicts, adding diff-based colored gutters in the script editor, and some more conventional VCS uses. However, the current feature set should benefit the editor to improve upon the limitation where the Godot editor was completely unaware of any VCS in use.

### Experience of working with the Godot community

I am delighted to work with the Godot community and I plan to keep contributing to Godot Engine in the future. I would like to thank my mentors Gilles Roudiere (@Groud) and Jairo Honorio (@jahd) for the constant support they gave me while developing the VCS integration. Also, I am thankful to all the people who helped me learn GDNative at #godotengine-devel and #godotengine-gdnative and special thanks to karroffel for her guidance that helped us in building the powerful VCS API with elegant simplicity. A final thanks to the Godot Engine developer community that considered me as one of their GSoC students for 2019 and allowed me to implement my project idea of a VCS integration for Godot throughout the GSoC coding period.

-----

<a id="static-analyzer"></a>
## Static Analyzer for GDScript – *Suhas Prasanna*

- **Project:** Static Analyzer for GDScript
- **Student:** Suhas Prasanna ([psuhas77](https://github.com/psuhas77))
- **Mentors:** George Marques ([vnen](https://github.com/vnen)) and Bojidar Marinov ([bojidar-bg](https://github.com/bojidar-bg))
- **Repository:** https://github.com/psuhas77/godot/tree/gsoc

### Background

For those who haven't read the previous progress reports, I'll do a quick recap of the background of this project.
While making medium to large scale games in Godot, many small bugs start to creep in that cannot be caught by the compiler. These can only be dealt with manually while debugging. This project will build a tool to be used semi-regularly to highlight these problematic pieces of code in an automated fashion. This essentially extends the scope of static checks, currently just being within each script, to operate across scripts and scenes.

### Current state

So far, it will still take a bit of work to merge with the main branch, however I will continue working on it to ensure that it will be done as soon as I can.

### Work done in the GSoC period

Foundations:

- Scene traversal mechanism.
- Script traversal mechanism.

Static checks that are complete:

- Script inherits the Object type that it is attached to.

Static checks that work for general use cases:

- Node referenced in a `get_node()` call exists.
- Function connected to a signal has arguments of correct arity.

### Future work

Future work includes ensuring that it can work with types and providing a lot of functionality around this. As well as finalizing a UI and hopefully merging it with the main branch.

-----

<a id="lightmapper"></a>
## Rewriting Godot's Light Mapper – *Joan Fons Sanchez*

- **Project:** Rewriting Godot's Light Mapper
- **Student:** Joan Fons Sanchez ([JFonS](https://github.com/JFonS))
- **Mentors:** Juan Linietsky ([reduz](https://github.com/reduz)) and Bastiaan Olij ([BastiaanOlij](https://github.com/BastiaanOlij))
- **Repository:** https://github.com/JFonS/godot/tree/lightmapper

### The project

Google Summer of Code has been a great experience overall. I really enjoy working on graphics related projects and this was an awesome opportunity to focus on one for a rather long period of time.

I won't go into detail over what has or hasn't been done, since the [two]({{% ref "article/gsoc-2019-progress-report-1-part-1" %}}#lightmapper) [previous]({{% ref "article/gsoc-2019-progress-report-2" %}}#lightmapper) progress reports already cover that, but unfortunately the new light mapper is not ready to be used yet. That being said, these three months served as a way to kickstart the project at a steady pace that I couldn't have afforded otherwise. The basic structure is settled and the core bits of the new mapper are mostly complete. All that's missing is improvements on the performance and some cleaning up of the noise and artifacts generated by the ray tracing process.

### The future

I have been a Godot contributor for more than a year now, and I don't have any intention to leave such a great project. I will continue working on the light mapper and I will do my best to have it ready for 4.0 next year. Finally, I want to thank the Google Open Source initiative as well as Godot itself for giving me this awesome opportunity and Juan and Bastiaan for helping me throughout the whole process.

-----

That's it for this third and last progress report from our 8 GSoC students.
We hope that you will find good use cases for all the features that they have being working on, and we thank all students and mentors for their dedicated work on these projects!

Remember that while the GSoC 2019 has ended, many of the features worked on by the students have yet to be formally merged in Godot Engine's repository. The most mature ones will likely be merged in time for the Godot 3.2 release, while others might have to wait for Godot 4.0's development cycle.

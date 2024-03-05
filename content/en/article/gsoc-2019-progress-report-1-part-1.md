---
title: "GSoC 2019 progress report #1 (part 1)"
excerpt: "Godot takes part in the Google Summer of Code for the second year, and this time we have 8 students working on awesome features for the engine. They each share their project aim and current progress with a short devlog. This common progress report is split over two blog posts for readability.
This post covers work on VCS integration (Twarit Waikar), interactive music (Daniel Matarov), a GDScript language server (Ankit Priyarup) and Visual Script improvements (Swarnim Arun)."
categories: ["progress-report"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5d2/f37/8f4/5d2f378f489ad333505584.png
date: 2019-07-17 14:58:28
---

[As announced previously](https://godotengine.org/article/godot-google-summer-code-2019), Godot is participating for the second time in the [Google Summer of Code](https://summerofcode.withgoogle.com) (GSoC) programme, which lets students from all over the world work for three months on specific projects thanks to a Google stipend.

In 2018 we had 5 students working on various features for Godot Engine, and you can read about their work in [last year's progress report](https://godotengine.org/article/gsoc-2018-progress-report-1).

This year we had the opportunity to select 10 students to work on many interesting projects. I missed the chance to blog about their projects and present them when the coding period started in late May, sorry about that. We'll make up for this in this progress report where each student will present themselves and their project. We are now at the middle of the coding period, so students have around 6 weeks left in the GSoC programme.

This progress report will be split over two posts covering 4 projects each (for diverse reasons we had to stop the GSoC programme for two students after the first month, so we now have 8 active projects with great progress).

Here is the list of projects and students with links to the relevant sections.

**Part 1 (this post):**

- <a href="#vcs-integration">Version Control Systems Integration</a> by Twarit Waikar
- <a href="#interactive-music">Interactive Music</a> by Daniel Matarov
- <a href="#gdscript-lsp">GDScript Language Server</a> by Ankit Priyarup
- <a href="#visual-scripting">Improvements to the Visual Scripting System</a> by Swarnim Arun

**Part 2 ([next post](/article/gsoc-2019-progress-report-1-part-2)):**

- <a href="/article/gsoc-2019-progress-report-1-part-2#lightmapper">Rewriting Godot's Light Mapper</a> by Joan Fons Sanchez
- <a href="/article/gsoc-2019-progress-report-1-part-2#static-analyzer">Static Analyzer for GDScript</a> by Suhas Prasanna
- <a href="/article/gsoc-2019-progress-report-1-part-2#motion-matching">Motion Matching Implementation Using KD Trees</a> by Aditya Abhiram
- <a href="/article/gsoc-2019-progress-report-1-part-2#async-file-access">Asynchronous Cached File Access</a> by Raghav Shankar

-----

<a id="vcs-integration"></a>
## Version Control Systems Integration – *Twarit Waikar*

- **Project:** Version Control Systems (VCS) editor integration framework and Git plugin
- **Student:** Twarit Waikar ([IronicallySerious](https://github.com/IronicallySerious))
- **Mentors:** Gilles Roudiere ([groud](https://github.com/groud)) and Jairo Honorio ([jahd2602](https://github.com/jahd2602))
- **Repositories:**
  * Godot's framework for VCS integration:
     - Dev: https://github.com/IronicallySerious/godot/tree/vcs-api-expand
     - Final (PR candidate): https://github.com/IronicallySerious/godot/tree/add-vcs-integration
  * Git interaction API plugin: https://github.com/IronicallySerious/godot-git-plugin

### Introduction

Since Godot is gradually entering the competitive market, dominated by only a handful of fully featured engines, it is only intuitive that it should support Godot game developers with a strong version control integration from within the editor. This project aims at creating a GUI interface to the user's version control system deployed on their project and create a versioning system agnostic API that caters to all version control systems (VCSs) at once.

This integration can further be used to create more in-depth interactions to a VCS like viewing file diffs right in the editor, committing code with a simple click, resetting to a previous state almost instantly without leaving the Godot editor.

### How does it look like?

We have taken inspiration from the diff UI currently present in Atom, Visual Studio Code and various other popular text editors and IDEs. We also have adopted some UX tips from Unreal Engine 4 for the initialisation of a VCS in a new project, however since Unreal Engine uses an external editor for C++ code by default, we found ourselves looking at something similar to what we already have in Visual Studio/Visual Studio Code.

![Version Control docks in the editor](/storage/app/media/gsoc/2019-1/vcs-001.png)

In the above screenshot, you can notice:

* A Version Control dock at the bottom.
* A Version Commit dock on the right-hand side (a list of staged and modified files is also planned).
* A Version Control Actions popup menu under Project Menu at the top left. This should behave like a quick VCS action toolbar.
* A Version Control dedicated settings tab in the Project Settings menu. This is planned to also let the VCS addon (a.k.a. implementation of the VCS API) add a bunch of VCS-specific settings to this tab.

![Version Control setup dialog](/storage/app/media/gsoc/2019-1/vcs-002.png)

Choosing Set Up Version Control brings up this menu. This is to detect all the different VCS API implementations available with the engine. The initialise button does some basic registrations and it will also let the VCS implementation provide their own initialisation steps depending on their type.

### Breaking down the framework

The integration project has several vertical slices present in it:

1. A version control themed editor plugin.
2. An interface for the Godot editor to extract all VCS metadata from.
3. An implementation of the VCS interface for any of the popular VCSs in use.

Our target for minimally complete support is focused on Git currently. By the end, we should be able to display file diffs in the editor, commit changes, stage/unstage files and extract other types of important metadata for use in the editor.

### How do we plan to manage distributed and centralised VCS?

We plan to split the API into two when the time comes to implement a centralised VCS. This is a development style decision amongst many others as suggested by my mentors, Groud and jahd, so that we make as much progress as we can without worrying about a problem that will only come once in the future.

### Which VCS are planned for support?

Although we will be focusing only on Git for the duration of this year's GSoC, we also recognise that Perforce and SVN are also some widely used VCS candidates for future support.

We should theoretically support all publically available VCSs so that integrating them into Godot is much easier by just implementing an API correctly and not worrying about how the data should be displayed in the editor.

### Coming up next

For the remaining of the coding period, I will be focusing on getting data from Git displayed in the editor, in different forms of commits, diffs, staging areas, and initialisation of Git dotfiles, to name a few. Since one of the long term goals is to keep the API independent of each VCS' specifities, I will also be paying attention to the design I will be using in the future to create the VCS API. In the end, we will be putting the entire integration in a GDNative plugin so as to provide a plug-and-play-like experience with the Git interaction implementation.

You can also have a look at my [personal devlogs](https://github.com/IronicallySerious/gsoc-godot-vcs-devlogs) to have a deeper look into what all decisions are going into realising this integration.

-----

<a id="interactive-music"></a>
## Interactive Music – *Daniel Matarov*

- **Project:** Interactive Music for Godot Engine
- **Student:** Daniel Matarov ([DanielMatarov](https://github.com/DanielMatarov))
- **Mentors:** Juan Linietsky ([reduz](https://github.com/reduz))
- **Repository:** https://github.com/DanielMatarov/godot/tree/Interactive-Music/modules/InteractiveMusic

Hi! My name is Daniel and I am working on implementing a feature for interactive music in Godot, as part of the Google Summer of Code programme.

### Project overview and what I have done so far

The idea of this project is to create a new feature which allows game music to implement their tracks in a more fluid way, similar to how Wwise works with music. The reason Wwise or FMOD were not integrated instead is because they are proprietary, and that would be against the open source and free to use nature of Godot. Nevertheless, it is still an interesting challenge to create my own interactive music engine, based around Godot's existing audio functionalities.

The feature adds two classes to Godot, both inheriting `AudioStream`. The first is `AudioStreamPlaylist`, which is a class that enables the user to play multiple audio files in a sequence, switching between clips based on their tempo and length in bars. The way this works is by the user inputting the tempo and beats information to the import dialogue for each file, and the rest happens behind the scenes. A beat's length in samples is calculated based on the sample rate and the tempo, and that way the player knows how many audio frames it needs to play for each file.

![BPM and Beats import options for audio files](/storage/app/media/gsoc/2019-1/interactive-music-001.png)

Over on the class's inspector view, the user can select the amount of streams the playlist will have, and can drag and drop them into the blank spaces.

![AudioStreamPlaylist configuration in inspector (no streams)](/storage/app/media/gsoc/2019-1/interactive-music-002.png)

![AudioStreamPlaylist configuration in inspector (with streams)](/storage/app/media/gsoc/2019-1/interactive-music-003.png)

There are also default BPM and beats values for the playlist, which are used if the file being played has not had tempo and beats information imported by the user. Here is a screencap of the class in action:

<video controls>
  <source src="/storage/app/media/gsoc/2019-1/interactive-music-bmp-test.mp4" type="video/mp4">
</video>

The next class is called `AudioStreamTransitioner`, which is what I am currently working on. It will be an `AudioStream` that can switch between audio clips, based on in-game events, and it will also be able to fade between clips, using BPM and beats information, similar to playlist.

![Mockup of AudioStreamTransitioner interface](/storage/app/media/gsoc/2019-1/interactive-music-004.png)

Initially the user interface was supposed to go on the bottom panel, however after discussions with reduz, it was decided it would be better to have it all go in the inspector. To accommodate this use I am considering changing some of the functionalities so it fits solely into the inspector. The way I see it working would be to not have a list of clips in the class, and rather have a list of transitions and a starting clip which is triggered when the class starts. Each transition will have a clip which is transitioned to (maybe called `to_clip`), fade out beats, which specifies for how many beats the previous stream fade out for, based on bpm, fade in beats, which specifies for how long the new stream will fade in for. Fade in and fade out can be different lengths and there won't be restrictions on either being longer than the other which will make the transitioner quite flexible for music makers.

I have written some pseudocode for the behind the scenes mix logic which can be found [here](https://snipsave.com/danielmatarov/#/snippet/4f146cGYQg51SXx9ST). This will likely change in the future but I think it is a good initial representation of how it will likely end up working.

### Challenges encountered

While working on this project I encountered a number of issues, such as taking a bit long to figure out why my code was crashing the engine, and later on a memory leak the reason for which is yet to be discovered. What I learned from that is how to use a debugger which is something I hadn't had to do before and as someone who is fairly inexperienced in programming it is definitely some of the most valuable things I have learned this year.

As mentioned previously I am dealing with a memory leak which is yet to be identified. It seems to be a problem with the preview generator `AudioStreamPreviewGenerator`, which tries to create a preview of `AudioStreamPlaylist` and it seems to do it indefinitely until it eats up all the RAM on my computer. Here is a video of this happening:

<video controls>
  <source src="/storage/app/media/gsoc/2019-1/interactive-music-ram-test.mp4" type="video/mp4">
</video>

Through discussions on the IRC channel it was discovered that the code just crashes on a Linux system (I use Windows). When I ran it through VS 2017's debugger it seemed to be a case of `generate_preview()` being called constantly, however I could not quite identify why that is happening. Currently I have disabled the preview generator in order to be able to work and for a while that problem still persisted until I added some safeguards in my playlist mix logic, but when the generator is turned on it still creates that problem. It will likely be something I try to fix later on, potentially by disabling the preview generator for playlist and probably transitioner specifically, instead of disabling it for all streams. I don't see a need for these classes to have a waveform preview displayed below `AudioStreamPlayer`, since they contain multiple audio files, rather than one.

### What is next

I aim to have transitioner functional by the beginning of August which will give me time to debug any potential issues and come up with a fix for the memory leak. Some of the things I wrote about here such as changes to how transitioner will be layed out need to be further discussed and approved by my mentor reduz. I will also aim to create an example project that displays the functionalities of the new feature, probably something simple such as pressing a few different buttons playing different music loops fading in and out. I think it will be a nice way to show it working and also give an example of the functions exposed to GDScript being used in context.

-----

<a id="gdscript-lsp"></a>
## GDScript Language Server – *Ankit Priyarup*

- **Project:** GDScript Language Server
- **Student:** Ankit Priyarup ([ankitpriyarup](https://github.com/ankitpriyarup))
- **Mentors:** [Geequlim](https://github.com/Geequlim) and Lu Jiacheng ([Jason0214](https://github.com/jason0214))
- **Repositories:**
  * Student server working branch: https://github.com/ankitpriyarup/godot/tree/lsp
  * Mentor server working branch: https://github.com/GodotExplorer/godot/tree/gdscript-lsp
  * Student client working branch: https://github.com/ankitpriyarup/godot-tools/tree/lsp-client
  * Mentor client working branch: https://github.com/GodotExplorer/godot-tools/tree/lsp-client

### What is the project?

The integrated script editor in Godot lacks features found in editors like VS Code, Sublime, Emacs, etc. These editors are also more popular among developers and therefore many want to switch to them for their usability. However, to implement core functionalities such as diagnosis, registering custom symbols, jumping to definition, etc. a Language Server structure has to be adopted. For example, the client (say VS Code) will communicate with the Godot Language Server to get desired results.

Microsoft's Language Server Protocol (LSP) is flexible and powerful to implement these functionalities. It also supports many editors - VS Code, Atom, Sublime, etc. Hence, instead of writing complete extensions for each editor (client), using LSP the server is the same for all and only the client have to be implemented as an editor extension.

### How it's like to work with Godot

I had a wonderful time coding with the fantastic and helpful community at Godot. I am mentored by Jason0214 and Geequlim. Jason0214 is very responsible as he always points out my mistakes and potential weekness from the regular code review. Geequlim is very active in the project and I always get to learn a lot from his commits. Besides that, it's an amazing experience to talk to other students and share whatever we learned. Writing clear and well-structured code to meet standards, and making sure your changes does not break anything else was a truly educational experience.

I have the freedom to arrange my time and set my own plan, there's no pressure at all. Mentors encourage me to be as creative as I can and I'm free to choose how to finish my work. Summing it all up working at Godot has been a really great experience for me.

### Current progress

I started off by getting familiar with the existing Godot tool for VS Code, improving existing `configuration` and `grammers`, we had to remove most of client-side code because we wanted to rely on LSP server (Godot) for most of the task for two reasons:

- To make the client smaller and easy to port to other editors such as Atom and Emacs.
- To reuse the existing implementation of the built-in GDScript editor and reduce duplication.

The [LSP Specification](https://microsoft.github.io/language-server-protocol/specification) is based on an extended version of JSON RPC which can be basically used for sending notifications, requests and responses. For example: VS Code (client) will first send a notification that the opened file is GDScript by matching its extension, and then the Language Server will be connected. Client then again sends a notification defining what capabilities it can provide. Then most of the tasks can be broken down into a request-response structure, where the client requests something and the server responds with a result.

#### 1) Diagnostics

An Extended GDScript Parser is created inheriting from the original GDScript parser with the aim to carry specialized parsing task for LSP. Everytime a code change is notified to the LSP Server by the client, diagnostics (i.e. errors and warnings) are updated along with their relevant details such as range (line and column number for both start and end) and message, which are stored in a map for faster lookups.

#### 2) Code completion

The existing `complete_code` implementation for the built-in code editor is reused, however Godot also matches written code continuously to filter possible options, while in LSP the complete list of possible items is sent to the client by the server initially. The client then handles the matching part, and typically does it better than the built-in editor. In the example below writing `texture` in the LSP client matches not only initial characters but also substrings present anywhere within the item.

![Comparison of LSP client with builtin editor](/storage/app/media/gsoc/2019-1/gdscript-lsp-001.png)

#### 3) Symbol cache pool

To provide lookup functionalities such as Function Assist, Hover Provider, Symbol Resolve and Go to Definition, we use a symbol pool to cache all of the symbols (both native and script symbols). The cache pool is filled at the startup by parsing all scripts in the workspace for script symbols and loading native symbols from `DocData`.

![Symbol cache pool](/storage/app/media/gsoc/2019-1/gdscript-lsp-002.gif)

#### 4) Documentation provider

To provide quick lookup of a class documentation, the entire Godot docs are converted and dumped into system files which can be directly opened by the editors. A simple regex parser is capable of parsing the class name on 'View Symbol Documentation'. In case the parsed symbol isn't recognised, a list of all the symbols will be shown.

![ocumentation provider](/storage/app/media/gsoc/2019-1/gdscript-lsp-003.gif)

#### 5) Rename symbol

Besides these other features such as Rename symbol is also implemented, it first finds out the position of symbol definition and then the code replaces the previous name to the newly specified name from the position of definition until the end of its scope (by checking the indentation).

![Rename symbol](/storage/app/media/gsoc/2019-1/gdscript-lsp-004.gif)

### Future steps

For the remaining of the coding period, we'll be focusing on:

- `CodeLens` support for disable warnings and show slots informations connected nodes.
- Adding a way to auto insert the signal connection code via the LSP.
- Fixing bugs in current implementation and merging them in Godot's `master` branch.
- Porting the client to other popular editors like Atom and Emacs.

-----

<a id="visual-scripting"></a>
## Improvements to the Visual Scripting System – *Swarnim Arun*

- **Project:** Improvements To Visual Scripting System
- **Student:** Swarnim Arun ([swarnimarun](https://github.com/swarnimarun))
- **Mentors:** Ernest Lee ([fire](https://github.com/fire)) and Anish Bhobe ([KidRigger](https://github.com/KidRigger))
- **Repositories:**
  * https://github.com/swarnimarun/godot, branches `vs-test`, `vs-graph-unification`, `vs-groups`
  * PR on upstream repository: https://github.com/godotengine/godot/pull/29681

### Project overview

This is a project dedicated to reworking/refactoring/improving the Visual Scripting system that exists in Godot as a whole to make it a viable option for the people who choose to use it.

The main goals of the project are to simplify the UI/make the system more accessible and increase the ease of use.

The steps taken in that direction include unifying the Visual Scripting Graph, and making the functions system much simpler and easier to use, while adding usability changes that have long since been due for the system, and have been discussed in some length or the other in the various groups and platforms of the Godot communities.

Tasks completed are:

- Unifying the Graph.
- Adding basic usability changes:
  * Port swapping.
  * Automatic type cast nodes.
  * In-graph editable nodes
  * Right-click for node search dialog.
  * And a few others...
- Changing the Layout structure for more efficient use of the precious space.

Tasks planned that still remain are:

- Bug fixing and error debugging.
- Testing and further improvements via quality of life changes.
- Work of the Super Node or Visual Script-based custom nodes/modules feature for greater reusability and modularity of the Visual Scripting system.

### Demo clips of the progress so far

#### Unified graph (all functions in the same view)

![Unified Visual Script graph](/storage/app/media/gsoc/2019-1/visual-script-001.gif)

#### Port swapping

![Port swapping](/storage/app/media/gsoc/2019-1/visual-script-002.gif)

#### In-graph editable node

![In-graph editable node](/storage/app/media/gsoc/2019-1/visual-script-003.gif)

#### Right-click for nodes

![Right-click for nodes](/storage/app/media/gsoc/2019-1/visual-script-004.gif)

-----

That's it for this first batch of progress reports from our GSoC students. Four more reports are in the [part 2 blog post](/article/gsoc-2019-progress-report-1-part-2), and we should have a second progress report from all students towards the end of the coding period.

We hope that you will find good use cases for all the features that are being worked on, and we thank all students and mentors for their dedicated work on these projects!

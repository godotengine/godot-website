---
title: "Godot Editor running in a web browser"
excerpt: "Bringing the Godot Editor to the web: lowering the barrier for newcomers while enhancing the HTML5 export."
categories: ["news"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5ec/fac/efa/5ecfacefaeb1e933757325.png
date: 2020-05-29 10:00:00
---

Hello Godotters! It's-a me, Fabio! In the last few months, thanks to the great sponsorship of [Mozilla](https://godotengine.org/article/godot-engine-awarded-50000-mozilla-open-source-support-program) I've been working on a big surprise for Godot 4.0, namely making the editor available as an HTML5 application.

This **DOES NOT** mean that we will move completely to the Web like other engines did. It will only be provided as a complementary option to the native editor, as a way to lower the entry barrier. Let me explain further.

Rationale
=========

Godot Engine supports exporting games to the HTML5 platform (i.e. browsers). Given that the editor itself is written using the Godot Engine API it should be possible to run the editor in browsers as well.

The reason why the editor wasn’t able to run in browsers up until now was due to some historical Web browsers limitations, mostly lack of support for threading, but also file system access.

With the  introduction of [WebAssembly](https://webassembly.org/), WebAssembly threads, Javascript [SharedArrayBuffer](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/SharedArrayBuffer), and possibly an upcoming [Native FileSystem API](https://wicg.github.io/native-file-system/), it should now be possible to have an almost-native user experience when running the editor on the Web.

This will be beneficial in many ways to the engine itself for multiple reasons:

1. It will **lower the barrier** for new users, which will be able to try out the engine without the need to download anything.
2. Any modification towards reaching that goal **will also improve the HTML5 export itself** (given that the editor is made like a Godot game).
3. It will allow to use Godot in a reasonable way in environments where installing/downloading applications is not an option (e.g. schools’ computers and tablets), **fostering the usage of the engine for educational purposes** (which is something we, as an open source community, deeply believe in).

This DOES NOT mean that Godot will move completely to the Web, nor that the Web browsers version will be the recommended way for professional development, but it will be an additional option for cases where it might be useful (again, pick the education sector as an example).

To stress this out again: **The good-old native editor will always be our main focus**.


After this necessary preface, let’s get to the news: a Godot Editor prototype running in browsers is being presented at this address this address `https://godotengine.org/online/godot.tools.html` (Edit: As of December 2022, the editor can be found on https://editor.godotengine.org/releases/latest/)



**Note:** As of this writing, this prototype requires a **recent Chromium-based** browser or **Firefox Nightly**.


This is a very **early stage** version, but it allows to run the editor (including the project manager), and make simple projects, while storing the files in either your browser local storage, or an external cloud service (Dropbox is currently supported, but not recommended due to speed limitations. In the future, standard WebDAV support will allow for more providers and better speeds.) See the *"Known limitations"z section below.


Usage
=====

When opening the URL you will be asked how to load the engine, specifically, selecting the persistence support. There are 4 options available:

- **None** – no persistence will be used, you will lose everything when you close the browser or refresh the page.
- **IndexedDB** – will use the IndexedDB API to store your files. This is usually limited to 50 megabytes on desktop, and 5 megabytes on mobile (this is the RECOMMENDED storage type for now).
- **Dropbox** – will store your files in a Dropbox folder, created specifically for the test application. You will also be able to upload files directly to Dropbox and they will be available in the engine (after refreshing the page!). This is a very powerful tool, but is currently quite slow, both when loading and saving (it will need to download the whole folder on startup, and changes will be stored asynchronously). Improvements in this area are much needed, and Dropbox support is provided as a proof-of-concept for now and in no way recommended. Cloud support (via standard WebDAV) will in time become the preferred way to use the web editor. *Note: At the time of your reading, Dropbox support might not work due to limits in terms of maximum number of users.*
- **FileSystem API** – will use the new Web FileSystem API, which could potentially expose native file system support in the future, if browser vendors agree on a safe way to do that. This is, again, provided as a proof-of-concept and browser support is very limited for now.

![persistence.png](/storage/app/uploads/public/5ec/fab/40c/5ecfab40cc43e902530760.png)

You can also opt to preload a zip file to the chosen virtual file system, allowing you to quickly test demo projects and load your offline projects inside the editor browser. Once the project manager starts, you will need to scan the virtual file system for new projects via the “Scan” option when preloading a zipped project. The editor config with the available projects list and other options will be stored according to your persistence method.

![preload.png](/storage/app/uploads/public/5ec/fab/650/5ecfab6500451585441017.png)

![scan1.png](/storage/app/uploads/public/5ec/fab/9db/5ecfab9db77ed097759444.png)

Editing & running the project
=============================

Once you have imported a project, or after creating a new one, you will be able to edit it, create new  scenes, create new scripts, and upload assets via drag and drop. You will also be able to run your editor project inside the editor via the play button. Extra HTML UI allows you to close the game and the editor, and switch between them.

![edit.png](/storage/app/uploads/public/5ec/fab/e00/5ecfabe00b0f9402944496.png)

![editor.png](/storage/app/uploads/public/5ec/fac/2a0/5ecfac2a03bc1119573590.png)

![game.png](/storage/app/uploads/public/5ec/fac/334/5ecfac334405b789986563.png)

Known limitations
=================

As stated above, this is a very early stage prototype, and there are some known limitations:

- [SharedArrayBuffer support](https://caniuse.com/#feat=sharedarraybuffer) is still limited among browsers. Recent versions of **Chrome** will work, as well as Mozilla **Firefox Nightly** builds (the beta and stable versions don’t have SharedArrayBuffer enabled yet). Other browsers are untested.
- Importing and using audio assets is still not well supported (and may cause a deadlock prompting the browser to ask the user to stop the script).
- Closing the project manager and game the via the HTML UI works, but closing the editor might deadlock and will always cause a memory leak.
- Sometimes refreshing the page when an error occurs is not enough, this is mostly due to browsers not clearing WebAssembly memory correctly. You might find yourself in a situation (after many realoads usually) where you have to open a new browser window/tab and visit the URL again for the editor to be able to run.
- The debugger connection between the editor instance and the running game does not work currently, so `print()` output or errors will not be raised in the editor. They are however accessible from the browser console.

Work done so far
================

Getting this far required quite a bit of time (I've been working on it since February), but a lot of this work will greatly improve the HTML5 export too. Here are a few nice things that you will see in Godot 4.0:

- The exported game can now exit properly, calling `get_tree().quit()` will work as expected in HTML5 exports, freeing up the memory in the user machine (this could for example be useful if you present more games in the same page, and allow the user to switch among them, so you don't have to reload the page to free up memory).
- Files drop support. The user will be able to drop files in the game window, and you will get them available in the game via the [`files_dropped` signal](https://docs.godotengine.org/en/stable/classes/class_scenetree.html#signals)
- Thread support! The HTML5 plaform will finally support the [`Thread`](https://docs.godotengine.org/en/stable/classes/class_thread.html) class.
- Rudimental [`OS.execute`](https://docs.godotengine.org/en/stable/classes/class_os.html#class-os-method-execute) support has been added to the HTML5 export, allowing you to "catch" those call via JavaScript code. (This is used in the prototype to switch between project manager/project editor, and to run the game.)
- Simpler JS `Engine` code that gives you more control over the game lifecycle.
- Safer and smaller JS code, via Closure Compiler to better minify the required JS support code.

More to come
============

There are still quite a few improvements that I will work on in the HTML5 platform, some of which will also benefit other platforms. Here is a sneak peak:

- Virtual keyboard in the HTML5 plaform, for working text input in mobile devices.
- Persistence support, WebDAV integration.
- Gestures for the editor, allowing using the editor from touch devices (this will also be beneficial to make native Android or iOS versions of the editor for example).
- Better HTML5 Audio support, trying to offload audio processing (e.g. effects, mixing) into a separate thread.
- GDNative support in the HTML5 platform.
- Easier interface to external JS libraries (expecially asynchronous ones), so you don't have to rely on complex [`JavaScript.eval`](https://docs.godotengine.org/en/stable/classes/class_javascript.html#class-javascript-eval).

References
==========

[The prototype branch](https://github.com/godotengine/godot/tree/js/editor_prototype) (still based on 3.2).

[PR that forward ports most of the changes to `master` branch](https://github.com/godotengine/godot/pull/38587).
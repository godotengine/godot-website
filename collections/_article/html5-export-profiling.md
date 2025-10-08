---
title: "HTML5 export profiling for Godot 4.0"
excerpt: "HTML5 debug export profiling is coming for Godot 4.0"
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/5e0/78b/00a/5e078b00a7171714583829.png
date: 2019-12-28 15:09:29
---

Hello Godotters, as part of my October work (sponsored, as always, by [Mozilla](https://godotengine.org/article/godot-engine-awarded-50000-mozilla-open-source-support-program)) I've been working on getting the script debugger and profiler to work with HTML5 exports. This, along with the ability to [run HTML5 exports in debug mode](https://godotengine.org/article/websocket-ssl-testing-html5-export), is a powerful new tool in the hand of Godot users who want to develop or port the game and applications to run inside the browser.

The following section is a brief technical excursus on the internals of godot debugging and profiling. You can jump to the next section to see all the cool things that will be available for HTML5 debug exports.

Debugger Connection
===================

`ScriptDebuggerRemote` and `ScriptEditorDebugger` are the two classes that manages respectively the exported client and the editor server connection for the debugger.

Those classes have seen quite a few updates in the past years, grew quite a bit since their original design, and for this reason most of the serialization and message logic is hard-coded.

This will likely change in the future, but in the meantime, I focused on extracting the low level handling of the connection from them to accommodate the need to support other protocols beside TCP (in this case, WebSocket for HTML5).

First, two new interfaces where created: `ScriptDebuggerConnection` and `ScriptEditorDebuggerServer`. Their implementation, provides access to the low level network connection, without the need to know about serialization and messages. Both a `ScriptDebuggerTCP` and a `ScriptEditorDebuggerTCP` where created as default, and the websocket module now provides its own `ScriptDebuggerWebsocket` and `ScriptEditorDebuggerWebsocket` implementation.

The Javascript platform, and javascript ["run native"](https://godotengine.org/article/websocket-ssl-testing-html5-export) will automatically select websocket for you.

Supported features
==================

All the supported feature of the debugger should work, except for breakpoints. This is a limitation due to the asynchronous nature of browser networking and might potentially be addressed in the future using WebAssembly threads or emscripten asyncify.

**Note: This work is not merged yet into master.**

Here are a few screenshot of what the profiler connected to the HTML5 export.



![usage3.png](/storage/app/uploads/public/5e0/78b/73c/5e078b73c3e45112706983.png)


![usage.png](/storage/app/uploads/public/5e0/78b/886/5e078b886caec316065171.png)


Reference Work
==============

[The pull request for this work](https://github.com/godotengine/godot/pull/33925) (still in review)

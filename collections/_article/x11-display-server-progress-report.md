---
title: "X11 display server progress report"
excerpt: "Progress report on the changes made in the X11 display server, the window management system for Godot 4 on Linux."
categories: ["progress-report"]
author: Camille Mohr-Daurat
image: /storage/app/uploads/public/5f8/d66/bae/5f8d66bae9125677247883.png
date: 2020-10-20 07:40:00
---

Hi everybody!

I'm Camille, aka PouleyKetchoupp. I use Godot as an indie game developer ([Nekomatata](http://www.nekomatata.com/)) and I've been a Godot contributor for a while ([Github](https://github.com/pouleyKetchoupp)). Recently I was hired to work as a contractor on fixes and improvements for the Linux port of Godot 4.

Most of the work was dedicated to fixing regressions due to the new Display Server used for window management, which allows support for multiple windows. I've also spent some extra time fixing old issues we had with X11 which required some refactoring in how the engine communicates with the X server. Some of them will be available in a later Godot 3.2 release as well.

In this post I'm summarizing all the changes I've made in the X11 Display Server, in order to (hopefully) clarify how the X server works and how Godot communicates with it.

The fixes for multi-windows are about:
* Delay with showing popups
* Popups position on multiple screens
* Drag & drop between windows

The more general X11 fixes are about:
* Delay with keyboard inputs
* Clipboard fixes

# General things for starters

**X11** is the current protocol used in Unix window systems, describing how the X server works. It was designed more than 30 years ago, so despite its flexibility, some aspects of it can be troublesome in modern systems.

**Xlib** is the original X client implementation. It's the one used in Godot at the moment.

**XCB** is a modern implementation of X11, which allows more flexibility in asynchronous exchanges with the X server. Recent versions of Xlib are actually built on top of XCB.

**Wayland** is a new communication protocol, meant to replace X11 in modern systems even though it's still not widely used.

# Popups delay

After switching to a multi-windows system, some difficult problems started to show, especially on Linux. In the Godot 4 editor, we're using separate windows for popup menus, tooltips and property fields when editing them.

The main issue was that all these windows were slow to show, causing a delay when interacting with almost anything in the editor.

The solution: override-redirect flag.

By default, any new window on the X server is handled through the Window Manager, responsible for switching focus between windows, moving, resizing and closing. But that comes with extra delays, which are unnecessary for simple enough windows like popups.

In order to fix that, the override-redirect flag can be set on those windows. To make it simple, it just tells the window manager to leave this window alone.

In the code, we set the [`override_redirect`](https://tronche.com/gui/x/xlib/window/attributes/override-redirect.html) flag in [`XSetWindowAttributes`](https://tronche.com/gui/x/xlib/window/attributes/#XSetWindowAttributes) - the structure we pass to [`XCreateWindow`](https://tronche.com/gui/x/xlib/window/XCreateWindow.html), the function that creates the window on the X server.

```
XSetWindowAttributes windowAttributes = {};
unsigned long valuemask = 0;

// override_redirect forces the WM not to interfere with the window,
// to avoid delays due to handling decorations and placement.
windowAttributes.override_redirect = True;

// save_under is an extra hint for the WM to keep the content of
// windows behind to avoid repaint.
windowAttributes.save_under = True;

// valuemask is used in XCreateWindow to specify which attributes are defined.
valuemask |= CWOverrideRedirect | CWSaveUnder;
```

But is it that simple? Not exactly. While it solves the delay problem, it also leaves us with all the responsibility to handle the window's focus, which can be a hassle when dealing with stacks of windows, like in the case of sub-menu popups.

So in order to deal with that, our display server code has to take care of setting the focus on popups when they are created (after receiving an appropriate event from the X server), and switching focus back to the previous window when they are closed.

Most situations seem to work fine in the current version and it was tested on all the most common Window Managers. Contributions are welcome if specific cases still cause issues on certain Window Managers.

More details about popup windows in the X11 documentation [here](https://www.x.org/releases/X11R7.6/doc/xorg-docs/specs/ICCCM/icccm.html#pop_up_windows).

Pull Request: [GH-41456](https://github.com/godotengine/godot/pull/41456)

# Popups on multiple screens

When working with multi-windows, we need to make sure the popup windows don't show up outside of the available desktop area. So not only do we need to take into account the monitor size, but also decorations like the application bar.

Depending on the desktop environment you use and your custom settings, these decorations can be on any side of the screen.

That becomes even trickier on a multihead setup, as the decorations can be on one or more monitors, and the desktop manager doesn't always provide all the information you need.

There are two properties which can help figuring out this available size in most cases: [_NET_WORKAREA](https://specifications.freedesktop.org/wm-spec/wm-spec-1.3.html#idm45805408034336) and `_GTK_WORKAREAS_Dx` (I couldn't find a link with proper specifications).

They are both accessed from the X server using atoms and the [`XGetWindowProperty`](https://tronche.com/gui/x/xlib/window-information/XGetWindowProperty.html) function.

An atom is just an integer identifier paired with a string that represents the property name, so the client code can work with names, while communication with the X server uses integer values.

Accessing a property looks like this:

```
// Get _NET_WORKAREA atom from name.
Atom workarea_prop = XInternAtom(x11_display, "_NET_WORKAREA", True);

// Get _NET_WORKAREA property value, in this case an array of values.
Atom type;
int format = 0;
unsigned long len = 0;
unsigned long remaining = 0;
unsigned char *data = nullptr;
XGetWindowProperty(x11_display, x11_window, workarea_prop,
        0, // data offset
        LONG_MAX, // data length
        False, // should the property be deleted?
        XA_CARDINAL, // expected property type
        &type, // returned property type
        &format, // returned data format
        &len, // returned data length
        &remaining, // returned remaining length for partial data
        &data); // returned data pointer
```

#### _NET_WORKAREA
This property gives you the size and position of each desktop. But in the case of multiple monitors, it can still return only a global rectangle for all of them, which is not accurate when it comes to decorations, or for L shape configurations.

#### _GTK_WORKAREAS
This property has been introduced by GNOME to provide a solution to this problem, and Godot will use it when possible. It's similar to `_NET_WORKAREA`, but provides per-monitor desktop information, which is exactly what we need.

In order to be as accurate as possible when not on GNOME, the information from `_NET_WORKAREA` is cross-referenced with the monitors' total size. It works ok in most cases, but this is not a perfect solution. For instance, in a vertical setup, it's not possible to take a top bar into account on the bottom screen. So this area is still open for improvements if a better solution comes up in the future.

Pull Request: [GH-41565](https://github.com/godotengine/godot/pull/41565)

# Drag & drop between windows

In order to make drag & drop work properly from one window to another, we need to identify the top-most window at a certain screen position in any situation (overlapping floating windows is the most complex case).

A specific API is available on Windows or Mac for this purpose, but not on the Linux X server, so this had to be worked around a different way.

In order to solve this problem, Godot will have its own algorithm which:
- Goes through each window to check which ones contain a certain position,
- Picks the top-most transient window in case of a stack,
- Picks the last one focused in case of separate floating windows.

Pull Request: [GH-41596](https://github.com/godotengine/godot/pull/41596)

# Keyboard inputs delay

A delay was sometimes visible when typing on the keyboard on Linux, especially on low-end configurations. This happened to be due to how Godot processed input events and handled the X11 Input Method.

The Input Method (IM) is the part of the X server responsible for handling inputs, mainly for the purpose of handling international characters. It's used to filter key inputs, take some key combinations into accounts for special characters and display decorations when needed to give feedback to the user.

For this system to work properly, several steps are needed before X11 applications can use keyboard events:
1. The application receives a key event from the X server
2. The application sends the key event to the IM for filtering
3. The IM sends a new key event to the X server
4. The application receives a new key event that it can use

The problem was that Godot was processing events from the X server only on the main thread. Because this process doesn't happen all synchronously, Godot had to wait for one more frame after first detecting the input before it could use it. Depending on how fast your computer renders, this lag could be more or less noticeable.

In order to improve the situation, Godot is now running a separate thread where it receives X events. In the case of keyboard events, it can send it to the IM for filtering right away, and receive the new event all before the next loop, when input events are propagated to the engine.

More details about event filtering in the X11 documentation [here](https://www.x.org/releases/X11R7.6/doc/libX11/specs/XIM/xim.html#filtering_events).

Pull Request: [GH-41910](https://github.com/godotengine/godot/pull/41910)

# Clipboard fixes

In a similar way as for keyboard events, copy/paste protocols in X11 are highly asynchronous, which doesn't play well with the way Godot was processing X events only on the main thread, and expects any action to be synchronous.

This has led to multiple issues around clipboard which are difficult to solve without a refactoring of the way X events are processed.

As a workaround, based on the work made for the keyboard inputs, I've made fixes to several cases using the new event processing loop, without the need for a full refactoring.

#### 1. Delay when pasting from Godot into other apps

When working with X11, clipboard data is not just saved in the system and sent to an app when pasting is requested. Instead, communication is needed with the app that the data comes from in order to convert it to the desired format and send it through the X server to the other app.

The steps for copy/pasting are as follows:
- Copy happens in App A, which is registered as the clipboard owner
- Paste happens in App B, which requests data from the X server
- The X server sends a SelectionRequest event to the owner, App A
- App A converts the data and sends a SelectionNotify event to the X server
- The X server transfers the SelectionNotify event to App B
- App B accesses the converted data from the X server

It usually takes even more steps, because multiple requests are actually needed, first to get the list of all possible formats the data can be converted to, then to request several formats if needed.

In the case events are only processed on the main thread, that leads to a very long delay when another application asks for clipboard data that comes from Godot, because each SelectionRequest has to wait for one more frame to be processed. This lag is even amplified when Godot is unfocused, as it runs at a lower frequency to save system resources.

This case was fixed by processing SelectionRequest events on a separate thread, so the data can be sent immediately to the X server.

Pull Request: [GH-41910](https://github.com/godotengine/godot/pull/41910)

#### 2. SAVE_TARGETS protocol (keep clipboard data on exit)

Because clipboard data is sent by the source application at the moment it's pasted, there are cases where it can be lost when the application closes.

As a note, most modern desktop environments have a clipboard manager which keeps a backup to avoid this problem, but not all of them, so it still happens in some cases.

The proper way to make the clipboard always work after Godot has closed is to implement `SAVE_TARGETS` protocol. The principle is that just before the closing, the application transfers the clipboard data to the clipboard manager, if supported.

There's not much documentation I could find about this protocol, but there are implementation examples [here](https://github.com/glfw/glfw/blob/master/src/x11_window.c) and [there](https://gitlab.gnome.org/GNOME/gtk/-/blob/master/gdk/x11/gdkclipboard-x11.c).

The first step to start the protocol is to call [`XConvertSelection`](https://tronche.com/gui/x/xlib/window-information/XConvertSelection.html) on the X server just before the application exits, using `CLIPBOARD_MANAGER` as the selection atom and `SAVE_TARGETS` as the target atom. This asks the X server to transfer ownership of the clipboard data from the current owner (Godot in this case) to the clipboard manager.

```
Atom clipboard_manager = XInternAtom(x11_display, "CLIPBOARD_MANAGER", False);
Atom save_targets = XInternAtom(x11_display, "SAVE_TARGETS", False);
XConvertSelection(x11_display, clipboard_manager, save_targets, None,
        x11_window, CurrentTime);
```

This protocol then requires sending events back and forth with the X server, so I've implemented it by reusing the event polling system described in previous sections, but this time in a blocking call on the main thread. We wait to receive specific events, or abort in case of timeout.

Pull Request: [GH-42652](https://github.com/godotengine/godot/pull/42652)

#### 3. INCR protocol (handle large amount of data from other apps)

Another limitation of the X11 clipboard is it doesn't allow sending data over 256KB at once.

That was causing issues when pasting large amounts of text, and the only way to solve it is by implementing the `INCR` protocol, which allows sending data in chunks through the X server.

It mostly consists in detecting we're receiving incremental data when accessing the clipboard selection property:

```
// Set the selection atom to XA_PRIMARY, the main clipboard selection.
Atom selection = XA_PRIMARY;

// Get the selection property value, which type is not always the same.
Atom type;
int format = 0;
unsigned long len = 0;
unsigned long remaining = 0;
unsigned char *data = nullptr;
XGetWindowProperty(x11_display, x11_window, XA_PRIMARY,
        0, // data offset
        0, // data length
        False, // should the property be deleted?
        AnyPropertyType, // expected property type
        &type, // returned property type
        &format, // returned data format
        &len, // returned data length
        &remaining, // returned remaining length for partial data
        &data); // returned data pointer

// Get INCR atom from name.
Atom incr_prop = XInternAtom(x11_display, "INCR", False);

// Check if the selection data is actually of type INCR.
if (type == incr_prop) {
    // Handle INCR protocol (see PR for more details).
}
```

Because this protocol requires asynchronous communication to receive each chunk of data and send notifications for the next one, I've implemented it in a similar way as for `SAVE_TARGETS`, with a blocking call that handles all events or aborts in the case of timeout.

More details about `INCR` protocol in the X11 documentation [here](https://www.x.org/releases/X11R7.6/doc/xorg-docs/specs/ICCCM/icccm.html#incr_properties).

Pull Request: [GH-42676](https://github.com/godotengine/godot/pull/42676)

# What next?

After completing this work package, most regressions related to X11 should be fixed now for Godot 4, even if there will still be some maintenance to do on all platforms before the release.

**Xlib or XCB:** While working on the X11 Display Server, I've chosen to focus on fixing specific issues in the current system with minimal refactoring, but using XCB to modernize the implementation is currently in discussion among contributors.

**Wayland:** Support for Wayland will be added to Godot in the future. It will be done as a separate Display Server implementation.

I hope this post put some light on the way Godot works under the hood in this specific area, for current and future contributors. See you around!

---

*Credits illustration: Tux logo by rafael3334 (modified from [source](https://www.onlinewebfonts.com/icon/45465))*

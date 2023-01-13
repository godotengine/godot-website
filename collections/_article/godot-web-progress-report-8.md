---
title: "Godot Web progress report #8: Progressive Web Apps"
excerpt: "One-click Progressive Web Apps are coming to Godot, along with easier testing for your HTML5 exports."
categories: ["progress-report"]
author: Fabio Alessandrelli
image: /storage/app/uploads/public/60c/72b/dc3/60c72bdc393a4838114722.png
date: 2021-06-16 16:00:00
---

Howdy Godotters! Time for another update on the status of Godot on the web.

It's been a while since [the last web report](https://godotengine.org/article/godot-web-progress-report-7) as we were busy releasing [Godot 3.3](https://godotengine.org/article/godot-3-3-has-arrived) and the following hotfixes, but as we move onto preparing for Godot `3.4` and the first alpha of Godot `4.0` (soon™), I'm happy to announce that starting from Godot `3.4` you will finally be able to export your HTML5 game as a [Progressive Web App](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps) (PWA)!

PWA
===

Progressive Web App is a term to define a web application that uses a set of technologies to provide a more native-like experience to the user. Godot exports will leverage those technologies to provide out-of-the-box PWA of your game by enabling the relevant switch.

![HTML5 export PWA section](/storage/app/uploads/public/60b/a81/df7/60ba81df7c61d867142125.png)

Enabling PWA will generate a few extra files that will need to be distributed along with your game, including the [service worker](https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API), the [web app manifest](https://developer.mozilla.org/en-US/docs/Web/Manifest), and the relevant icons.

When a user visits the web page it will be presented with the option to install your application if the browser supports this feature. The way the installation is proposed to the users depends on the browser, here is an example on Chrome for Android:

![PWA Install Suggestion](/storage/app/uploads/public/60c/393/280/60c3932805c1f343459058.png)


![PWA Install Prompt](/storage/app/uploads/public/60c/393/340/60c393340bb55765498231.png)


Once installed, the web app will be added to the home screen, and will be able to start like a native app, even when the device is offline.

Extra features may also be avaible for installed web apps like locking the device orientation, and starting in fullscreen.

![Installed PWA Running](/storage/app/uploads/public/60c/393/39b/60c39339bab5c662844052.png)

Better HTTP "run" server
===

Testing Godot Web exports on different devices can be cumbersome when you have to re-deploy your application multiple times.

A while ago we introduced an HTTP debug server to the editor be able to run your game in the browser, or on a device on your local network.

The HTTP server was never meant for production use, and never implemented SSL. Over time though, more and more features like threads, gamepads, clipboard access, etc., have been disabled by browser vendors when running from a page served without HTTPS.

For this reason SSL support has been added to the HTTP debug server, making it easier to debug your fully featured web export from a different device than the one running the editor.

You will find the relevant options in `Editor -> Editor Settings` under the section `Export -> Web`:


![Web Export editor settings](/storage/app/uploads/public/60c/3a3/8b6/60c3a38b6a8b8254809818.png)

* `Http Host` defines the address the server will listen to. By default, it will only listen to local connections for security. Change it to `0.0.0.0` to listen to connections on any interface.
* `Http Port` defines the port the HTTP server will listen to.
* `Use Ssl` will enable HTTPS for the server.
* `Ssl Key` and `Ssl Certificate` can be optionally specified to provide your own SSL certificate and key (otherwise, a self-signed certificate will be generated).


More news coming soon
===

There is more news coming very soon, since the long awaited [`Godot <-> JavaScript`](https://github.com/godotengine/godot-proposals/issues/1852) interface for HTML5 exports has also landed in `master` and will be included in future `3.4` releases.

That's a very exciting topic that deserves its own blog post, so stay tuned for more ;-).

References
===

[HTTP editor server refactor](https://github.com/godotengine/godot/pull/47386)

[HTTP editor server SSL](https://github.com/godotengine/godot/pull/47974)

[Export as Progressive Web App](https://github.com/godotengine/godot/pull/48159)

[3.x backport](https://github.com/godotengine/godot/pull/48250)

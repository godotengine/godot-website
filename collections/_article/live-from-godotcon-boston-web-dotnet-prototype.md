---
title: "Live from GodotCon Boston: Web .NET prototype"
excerpt: "We managed to do the impossible: we created a Godot-based prototype for the Web that runs .NET! Come and try it!"
categories: ["events", "progress-report"]
author: "Adam Scott"
image: /storage/blog/covers/live-from-godotcon-boston-web-net-prototype.jpg
date: 2025-05-09 12:00:00
---

<style>
.godot-dotnet-web-link {
  margin: 2em auto;
  display: block;
  width: max-content;
  background-color: rgb(54, 137, 201);
  text-decoration: none;
  border-radius: 1em;
  color: white;
  padding: 1em;
  box-shadow: var(--more-shadow);
}
blockquote {
  font-size: 95%;
  padding: 1em;
  background-color: rgba(0, 0, 0, 0.03);
}
blockquote p, blockquote ul li {
  font-style: italic;
}
blockquote p:first-child {
  margin-top: 0;
}
blockquote p:last-child {
  margin-bottom: 0;
}
</style>

Hi there! I'm Adam Scott ([@adamscott on GitHub](https://github.com/adamscott)), the Godot Engine Web team lead, live from the GodotCon Boston 2025!

On May 6, during my [State of Godot and the Web talk](https://talks.godotengine.org/godotcon-us-2025/talk/UCLFXR/), [I revealed a world premiere](https://slides.com/scottmada/state-of-the-godot-and-the-web-2025/#/35/2) to the GodotCon attendees. It was something some thought impossible, and others were resigned to not seeing during their lifetime.

_Please note that the VOD isn't available yet. The link to the recording will be added to the article once available. Meanwhile, you can access [the slides of the presentation](https://slides.com/scottmada/state-of-the-godot-and-the-web-2025)._

The .NET team lead, Raul Santos ([@raulsntos on GitHub](https://github.com/raulsntos)), managed to create a prototype running C# on the Web.

<div>
  <a href="https://lab.godotengine.org/godot-dotnet-web/" class="godot-dotnet-web-link" target="_blank">
    <span>Click here to see the prototype!</span>
  </a>
</div>


## Wasn't it impossible?

We tried `dotnet.js`. [It didn't work.](https://github.com/godotengine/godot/issues/70796#issuecomment-2524834258)

We tried NativeAOT-LLVM. [It didn't work.](https://github.com/godotengine/godot/issues/70796#issuecomment-2524834258)

We (initially) tried statically linking Mono. [It didn't work.](https://github.com/godotengine/godot/issues/70796#issuecomment-2524834258)

Well, Raul gave it another shot recently and managed to make it work. [Here's how he explains his accomplishment.](https://github.com/godotengine/godot/issues/70796#issuecomment-2855430724)

> As mentioned in my last update, the option of statically linking Mono seemed the most promising so we went ahead with that.
>
> I have opened a draft PR with the latest changes, but keep in mind it's still a work in progress:
>
> - [\[.NET\] Add web export support #106125](https://github.com/godotengine/godot/pull/106125)
>
> As a reminder, this approach still seems very brittle to me and has some limitations. The C# project must match the WASM features supported by the Godot template (this includes things like the threading model, exception handling, SIMD support, etc.). The TargetFramework version of the C# project must also match the one that was used to build the template.
>
> Additionally, since we currently don't load any globalization data, we only support invariant mode. This is not a big problem because most users will likely rely on Godot's localization features, so it's not a blocker.
>
> On the last update the issue we run into was retrieving function pointers. We were able to workaround that by declaring stub C# methods on the project we use to retrieve the Mono runtime. When building the Godot templates, this ensures these methods are included in the generated table which seems to be enough to let us retrieve the function pointer at runtime.
>
> In a regular C# application built for the web platform you'd use dotnet.js which acts as a loader for the WASM file and other required assets. In Godot we have our own way of doing this, and as a result we're currently missing a key part of the process.
>
> The Mono runtime exports some JavaScript functions but at the time of building the templates these are stubs. The dotnet.js loader takes care of replacing these stubs with their real implementation in dotnet.runtime.js. We're currently missing this step so they remain stubs.
>
> This means some .NET APIs that rely on these exported JavaScript functions will not work, resulting in unexpected behavior. This includes things that must be implemented using browser APIs such as cryptography.
>
> Nonetheless, I think this is significant progress and has allowed us to build a demo running on the browser.


## What's next for C\#/.NET on the Web
Raul has published [his pull request](https://github.com/godotengine/godot/pull/106125) as a draft so far. It means that there's a lot of work and testing to do.

We're working as fast as we can to enable you to export C#/.NET to the Web, but we cannot commit to a specific timeline yet. If everything works great, it should be available in the next Godot release.

### What about file size? My `.pck` size has exploded!
Currently, we do have to include some `.dll` files in your main `.pck` file in order to be able to run a C# project. For the simple prototype, the `.pck` file size is at an astounding 72 MiB. Fortunately, when Brotli-compressed, the file can be reduced to 23.8 MiB.

It's not perfect, as we often suggest targeting the smallest size when deploying to the Web. But the following announcement should help at least somewhat concerning this issue.


## Introducing built-in (pre)compression

[I also revealed](https://slides.com/scottmada/state-of-the-godot-and-the-web-2025/#/41) my upcoming built-in (pre)compression PR to the public.

It will do the following:
- add an option to compress template files when compiling the engine
- add export options to compress exported files
- if the target server doesn't support serving pre-compiled files, the preloading script will take over as a fallback, ensuring to download compressed files instead of non-compressed ones in order to save bandwidth.

## The future is bright

C#/.NET support on the Web and file compression are two important features that will come to the platform. These features will push the limits of what can be done by Godot users on the Web. I do hope that you are as excited as we are!

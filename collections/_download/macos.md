---
title: MacOS downloads - Godot Engine
platform: macos
downloads:
  - caption: Universal 64-bit (x86_64 + Apple Silicon)
    url: osx.universal.zip
downloads_mono:
  - caption: Universal 64-bit (x86_64 + Apple Silicon)
    url: mono_osx.universal.zip
redirect_from:
  - /download/osx
---

#### Instructions

- Extract and run. Godot is self-contained and does not require installation.
- If you run into an issue, check the [Troubleshooting](https://docs.godotengine.org/en/stable/about/troubleshooting.html) page for common issues and their solutions.


Since Godot 3.3, Godot is code-signed and notarized for macOS. This means it should run out of the box even if Gatekeeper is enabled on the system (which is the default).

For older Godot versions, see the last section of [this page](https://support.apple.com/en-us/HT202491) for instructions on allowing Godot to run anyway. Alternatively, you can install [Godot from Steam](https://store.steampowered.com/app/404790) and switch to an older branch in the Steam application settings to work around this.


You can also get Godot with [Homebrew](https://brew.sh/)

<pre><code class="hljs lua">brew install <span class="hljs-comment">--cask godot</span></code></pre>

or [MacPorts](https://www.macports.org)

<pre><code class="hljs nginx"><span class="hljs-attribute">sudo</span> port install godot</code></pre>
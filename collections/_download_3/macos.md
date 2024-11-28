---
title: Download for macOS - Godot Engine
description: Download the latest stable version of the Godot Engine 3 for macOS
platform: macOS

downloads:
  - platform: "macos.universal"
    featured: true

  - platform: "macos.universal"
    mono: true
    featured: true
    featured_flavor: .NET

content_instructions: |
  <ul>
    <li>Extract and run. Godot is self-contained and does not require installation.</li>
    <li>If you run into an issue, check the <a href="https://docs.godotengine.org/en/stable/tutorials/troubleshooting.html">Troubleshooting</a> page for common issues and their solutions.</li>
  </ul>

  <p>
    Since Godot 3.3, Godot is code-signed and notarized for macOS by <em>Prehensile Tales B.V.</em>.
    <br>This means it should run out of the box even if Gatekeeper is enabled on the system (which is the default).
  </p>

  <p>
    For older Godot versions, see the last section of <a href="https://support.apple.com/en-us/HT202491">this page</a> for instructions on allowing Godot to run anyway. Alternatively, you can install <a href="https://store.steampowered.com/app/404790">Godot from Steam</a> and switch to an older branch in the Steam application settings to work around this.
  </p>

  <p>
    You can also get Godot with <a href="https://brew.sh/">Homebrew</a>

    <pre><code class="hljs lua">brew install <span class="hljs-comment">--cask godot</span></code></pre>

    or <a href="https://www.macports.org">MacPorts</a>

    <pre><code class="hljs nginx"><span class="hljs-attribute">sudo</span> port install godot</code></pre>
  </p>
---

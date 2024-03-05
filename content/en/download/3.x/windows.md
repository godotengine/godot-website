---
title: Download for Windows - Godot Engine
description: Download the latest stable version of the Godot Engine 3 for Windows
platform: Windows
type: download/3.x

downloads:
  - platform:  "windows.64"
    featured: true
    tags:
      - 64 bit

  - platform:  "windows.32"

  - platform:  "windows.64"
    mono: true
    featured: true
    featured_flavor: .NET

  - platform:  "windows.32"
    mono: true

content_note: |
  <p>
    <strong>Note:</strong> The 32-bit .NET binaries do not run on 64-bit Windows systems at the time being. Make sure to export 64-bit .NET binaries for your 64-bit target platforms.
  </p>

content_instructions: |
  <ul>
    <li>Extract and run. Godot is self-contained and does not require installation.</li>
    <li>If you run into an issue, check the <a href="https://docs.godotengine.org/en/stable/tutorials/troubleshooting.html">Troubleshooting</a> page for common issues and their solutions.</li>
  </ul>

  <p>
    You can also get Godot with <a href="https://scoop.sh/">Scoop</a>.

    <pre><code class="hljs csharp">scoop bucket <span class="hljs-keyword">add</span> extras
      scoop install godot</code></pre>
  </p>

  <p>
    Windows executables are code-signed by <em>Prehensile Tales B.V.</em>
  </p>
---

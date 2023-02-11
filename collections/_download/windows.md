---
title: Download for Windows - Godot Engine
description: Download the latest stable version of the Godot Engine for Windows
platform: Windows

downloads:
  - caption: Standard (x86_64)
    slug: win64.exe.zip
    featured: true
    tags:
      - 64 bit

  - caption: Standard (x86)
    slug: win32.exe.zip
    tags:
      - 32 bit
  
  - caption: .NET (x86_64)
    slug: mono_win64.zip
    mono: true
    featured: true
    featured_flavor: .NET
    tags:
      - 64 bit
      - C# support
  
  - caption: .NET (x86)
    slug: mono_win32.zip
    mono: true
    tags:
      - 32 bit
      - C# support

content_note: |
  <p>
    <strong>Note:</strong> The 32-bit .NET binaries do not run on 64-bit Windows systems at the time being. Make sure to export 64-bit .NET binaries for your 64-bit target platforms.
  </p>

content_instructions: |
  <ul>
    <li>Extract and run. Godot is self-contained and does not require installation.</li>
    <li>If you run into an issue, check the <a href="https://docs.godotengine.org/en/stable/about/troubleshooting.html">Troubleshooting</a> page for common issues and their solutions.</li>
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

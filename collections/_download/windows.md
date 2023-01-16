---
title: Windows downloads - Godot Engine
platform: windows

downloads:
  - caption: 64-bit (x86_64)
    url: win64.exe.zip
  - caption: 32-bit (x86)
    url: win32.exe.zip

downloads_mono:
  - caption: 64-bit (x86_64)
    url: mono_win64.zip
  - caption: 32-bit (x86)
    url: mono_win32.zip

mono_note: "<p><strong>Note:</strong> The 32-bit Mono binaries do not run on 64-bit Windows systems at the time being. Make sure to export 64-bit Mono binaries for your 64-bit target platforms.</p>"
---

#### Instructions
- Extract and run. Godot is self-contained and does not require installation.
- If you run into an issue, check the [Troubleshooting](https://docs.godotengine.org/en/stable/about/troubleshooting.html) page for common issues and their solutions.


You can also get Godot with [Scoop](https://scoop.sh/).

<pre><code class="hljs csharp">scoop bucket <span class="hljs-keyword">add</span> extras
scoop install godot</code></pre>

Windows executables are code-signed by <em>Prehensile Tales B.V.</em>

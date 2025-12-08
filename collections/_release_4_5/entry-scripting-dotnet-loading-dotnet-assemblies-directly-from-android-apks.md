---
type: entry
section: scripting
subsection: dotnet
rank: 0
importance: 2
anchor: loading-dotnet-assemblies-directly-from-android-apks
title: Loading .NET assemblies directly from Android APKs
blockquote: Straight from the source
text: |
  [Assemblies](https://learn.microsoft.com/en-us/dotnet/standard/assembly/) are the building blocks of any C#/.NET application as they provide types and resources for different functionalities. Functionalities range from system <abbr title="input/output">I/O</abbr> utilities to your own game logic.

  In the past, for Android, we’ve been extracting the .NET assemblies from the exported APK and stored them in cache. While this works well on other platforms, it caused issues on Android, such as outdated assemblies or permission errors.

  We now load those assemblies directly from the APK, which solves all those issues.
contributors:
- name: Raul Santos
  github: raulsntos
- name: Youngmin Koo
  github: youngminz
read_more: 
  https://github.com/godotengine/godot/issues?q=is%3Apr%20state%3Amerged%20105262%20105853
---

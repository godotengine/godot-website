---
type: entry
section: general
subsection: core
rank: 1
importance: 4
anchor: manifold-library-replaces-CSG-implementation
title: Manifold library replaces CSG implementation
blockquote: Reaping the benefits of open source
text: |
  Support for Constructive Solid Geometry (CSG) has been in the engine since Godot 3.1 and is a great tool for rapid prototyping.

  Nonetheless, our internal implementation suffered from stability issues and other bugs. This is one of the engine areas that does not have a dedicated maintainer to look after it, so when an open source library with the same functionality was released, we jumped at the opportunity.

  Manifold completely replaces the existing implementation, which is a fairly big change in how Godot handles CSG internally, but only minimally impacts the user API. Please check your projects after upgrading and report any negative consequences to us so they can be tackled!
contributors:
  - name: K. S. Ernest (iFire) Lee
    github: fire
  - name: Emmett Lalish
    github: elalish
read_more: https://github.com/godotengine/godot/pull/94321
---

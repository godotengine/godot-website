---
category: scripting
rank: 0
state: "active"
anchor: "implement-namespaces-for-scripting-languages"
title: "Implement namespaces for scripting languages"
description: |
  One of the main complaints of the GDScript language is the lack of namespaces. A namespace is a way to group code by a common name. This permits the reuse of classes using the same name, as long as they can be differentiated by their namespace.

  But the problem can be found with .NET and GDExtension too. The problem occurs at the registration phase of classes in our internal database.

  With namespaces, plugin developers could use their own class names without worrying about clashing with users' internal ones.
details:
---

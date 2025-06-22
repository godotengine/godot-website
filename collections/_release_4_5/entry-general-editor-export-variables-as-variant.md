---
type: entry
section: general
subsection: editor
rank: 5
importance: 3
anchor: export-variables-as-variant
title: Export variables as ``@[Variant](basetype)``
text: |
  With this new update, it is now possible to export variables as ``@[Variant](basetype)``.

  Previously, a variable could only be exported as a ``@[Variant](basetype)`` if it had an initialized value. Also, the editor would stick to the actual type of said value, making it impossible to change the value to another supported ``@[Variant](basetype)`` type, such as a ``@[String](basetype)`` or ``@[Color](basetype)``.

  Now, if the exported variable is of type ``@[Variant](basetype)``, the editor reacts accordingly, permitting the user to assign any compatible ``@[Variant](basetype)`` value. There’s even a nifty type selector that changes the input widget accordingly.
contributors:
- name: Tomasz Chabora
  github: KoBeWi
read_more: https://github.com/godotengine/godot/pull/89324
image_alt: Godot Editor with an exported variable as Variant.
image_src: /storage/releases/4.5/images/godot_export-variant.webp
image_src_2x: /storage/releases/4.5/images/godot_export-variant_2x.webp
position: center-right
media_position: right
inverted: true
---

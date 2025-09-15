---
type: entry
section: scripting
subsection: gdscript
rank: 1
importance: 3
anchor: abstract-classes-and-methods
title: Abstract classes and methods
blockquote: U Can’t Touch This
text: |
  You can now declare GDScript classes to be abstract. Declaring a class abstract means that the class is not meant to be instantiated directly. That means that you can prevent instances of a class, let’s say, ``@[Animal](usertype)``, that doesn’t have any purpose on its own other than to be extended by "concrete" classes like ``@[Cat](usertype)`` and ``@[Dog](usertype)``.

  Abstract classes can also have abstract methods. This means that the method must be implemented in any class that extends it.

  <figure class="file">
    <figcaption>animal.gd</figcaption>

    ```manual
    @[@abstract](gdscript-annotation)
    @[class_name](keyword) Animal @[extends](keyword) @[Node](enginetype)


    @[@abstract](gdscript-annotation)
    @[func](keyword) @[cry](function)@[&lpar;&rpar; ->](symbol) @[void](basetype)
    ```

  </figure>

  <figure class="file">
    <figcaption>cat.gd</figcaption>

    ```manual
    @[class_name](keyword) Cat @[extends](keyword) @[Animal](usertype)


    @[func](keyword) @[cry](function)@[&lpar;&rpar; ->](symbol) @[void](basetype)
      @[# Must be implemented, otherwise an error will be thrown.](comment)
      @[print](function)@[&lpar;](symbol)@["Meow!"](string)@[&rpar;](symbol)
    ```

  </figure>
contributors:
- name: Aaron Franke
  github: aaronfranke
- name: Danil Alexeev
  github: dalexeev
- name: Ryan Brue
  github: ryanabx
read_more: 
  https://github.com/godotengine/godot/pulls?q=is%3Apr+is%3Amerged+67777+106409+107717
image_alt: "Image of the Add Node window displaying the dimmed out abstract Animal
  node, and its two extending classes Cat and Dog."
image_src: /storage/releases/4.5/images/gdscript-abstract.webp
image_src_2x: /storage/releases/4.5/images/gdscript-abstract-2x.webp
media_position: top
position: center-left
---

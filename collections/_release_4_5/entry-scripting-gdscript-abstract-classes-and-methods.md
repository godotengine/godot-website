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
  You can now declare GDScript classes to be abstract. Declaring a class abstract means that the class is not meant to be instantiated directly. That means that you can prevent instances of a class, let’s say, `Animal`, that doesn’t have any purpose on its own other than to be extended by "concrete" classes like `Cat` and `Dog`.

  Abstract classes can also have abstract methods. This means that the method must be implemented in any class that extends it.

  <code class="highlight">
    <span class="comment"># 📄 animal.gd</span><br>
    <span class="gdscript-annotation">@abstract</span><br>
    <span class="keyword">class_name</span> Animal <span class="keyword">extends</span> <span class="enginetype">Node</span><br>
    <br>
    <span class="gdscript-annotation">@abstract</span><br>
    <span class="keyword">func</span> <span class="function">cry</span><span class="symbol">() -></span> <span class="enginetype">void</span>
  </code>

  <code class="highlight" style="margin-top: 1em;">
    <span class="comment"># 📄 cat.gd</span><br>
    <span class="keyword">class_name</span> Cat <span class="keyword">extends</span> <span class="usertype">Animal</span><br>
    <br>
    <span class="keyword">func</span> <span class="function">cry</span><span class="symbol">() -></span> <span class="enginetype">void</span><span class="symbol">:</span><br>
    &nbsp;&nbsp;<span class="comment"># Must be implemented, otherwise an error will be thrown.</span><br>
    &nbsp;&nbsp;<span class="function">print</span><span class="symbol">(</span><span class="string">"Meow!"</span><span class="symbol">)</span>
  </code>
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

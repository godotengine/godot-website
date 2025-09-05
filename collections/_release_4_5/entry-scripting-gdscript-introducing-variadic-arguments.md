---
type: entry
section: scripting
subsection: gdscript
rank: 0
importance: 4
anchor: introducing-variadic-arguments
title: Introducing variadic arguments
text: |
  GDScript functions can now accept an arbitrary number of parameters!

  ```manual-highlight
  @[extends](keyword) @[Node](enginetype)


  @[func](keyword) @[sum](function)@[&lpar;](symbol)first_number@[:](symbol) @[float](basetype)@[,](symbol) @[...](symbol)numbers@[:](symbol) @[Array](basetype)@[&rpar; ->](symbol) @[float](basetype)@[:](symbol)
    @[var](keyword) total @[:=](symbol) first_number
    @[for](keyword) number @[in](symbol) numbers@[:](symbol)
      total @[+=](symbol) number
    @[return](keyword) total


  @[func](keyword) @[_ready](function)@[&lpar;&rpar; ->](symbol) @[void](basetype)@[:](symbol)
    @[sum](function)@[&lpar;](symbol)@[1](basetype)@[&rpar;](symbol)  @[# 1.0](comment)
    @[sum](function)@[&lpar;](symbol)@[1](basetype)@[,](symbol) @[2](basetype)@[,](symbol) @[3](basetype)@[&rpar;](symbol)  @[# 6.0](comment)
    @[sum](function)@[&lpar;](symbol)@[1](basetype)@[,](symbol) @[2](basetype)@[,](symbol) @[3](basetype)@[,](symbol) @[4](basetype)@[,](symbol) @[5](basetype)@[&rpar;](symbol)  @[# 15.0](comment)
  ```
contributors:
- name: Danil Alexeev
  github: dalexeev
read_more: https://github.com/godotengine/godot/pull/82808
---

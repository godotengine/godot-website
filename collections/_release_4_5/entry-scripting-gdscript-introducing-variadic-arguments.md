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

  <code class="highlight">
    <span class="keyword">extends</span> <span class="enginetype">Node</span><br>
    <br>
    <span class="keyword">func</span> <span class="function">sum</span><span class="symbol">(</span>first_number<span class="symbol">:</span> <span class="basetype">float</span><span class="symbol">,</span> <span class="symbol">...</span>numbers<span class="symbol">:</span> <span class="basetype">Array</span><span class="symbol">) -></span> <span class="enginetype">float</span><span class="symbol">:</span><br>
    &nbsp;&nbsp;<span class="keyword">var</span> total <span class="symbol">:=</span> first_number<br>
    &nbsp;&nbsp;<span class="keyword">for</span> number <span class="keyword">in</span> numbers<span class="symbol">:</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;total <span class="symbol">+=</span> number<br>
    &nbsp;&nbsp;<span class="keyword">return</span> total<br>
    <br>
    <span class="keyword">func</span> <span class="function">_ready</span><span class="symbol">() -></span> <span class="enginetype">void</span><span class="symbol">:</span><br>
    &nbsp;&nbsp;<span class="function">sum</span><span class="symbol">(</span><span class="basetype">1</span><span class="symbol">)</span><wbr>&nbsp;<wbr>&nbsp;<wbr><span class="comment"># 1.0</span><br>
    &nbsp;&nbsp;<span class="function">sum</span><span class="symbol">(</span><span class="basetype">1</span><span class="symbol">,</span> <span class="basetype">2</span><span class="symbol">,</span> <span class="basetype">3</span><span class="symbol">)</span><wbr>&nbsp;<wbr>&nbsp;<wbr><span class="comment"># 6.0</span><br>
    &nbsp;&nbsp;<span class="function">sum</span><span class="symbol">(</span><span class="basetype">1</span><span class="symbol">,</span> <span class="basetype">2</span><span class="symbol">,</span> <span class="basetype">3</span><span class="symbol">,</span> <span class="basetype">4</span><span class="symbol">,</span> <span class="basetype">5</span><span class="symbol">)</span><wbr>&nbsp;<wbr>&nbsp;<wbr><span class="comment"># 15.0</span><br>
  </code>
contributors:
- name: Danil Alexeev
  github: dalexeev
read_more: https://github.com/godotengine/godot/pull/82808
---

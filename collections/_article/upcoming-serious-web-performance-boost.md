---
title: "Upcoming (serious) Web performance boost"
excerpt: "Compiling the Godot Engine with WASM SIMD support truly is a game changer."
categories: ["progress-report"]
author: Adam Scott
image: /storage/blog/covers/upcoming-serious-web-performance-boost.webp
date: 2025-05-21 18:00:00
---

Sometimes, just adding a compiler flag can yield significant performance boosts. [And that just happened.](https://github.com/godotengine/godot/pull/106319)

[For about two years now](https://caniuse.com/wasm-simd), all major browsers have supported WASM ([WebAssembly](https://en.wikipedia.org/wiki/WebAssembly)) SIMD. [SIMD stands for "Single instruction, multiple data".](https://en.wikipedia.org/wiki/Single_instruction,_multiple_data) It is a technology that permits CPUs to do some parallel computation, often speeding up the whole program. And that's exactly why we tried it out recently.

We got positive results.

## The need for performance on the Web

The Web platform is often overlooked as a viable target, because of it's less-than-ideal environment and it's percieved poor performance. And the perception is somewhat right: the Web environment has a lot of security-related quirks to take into account—the user needs to interact with a game frame before the browser allows it to play any sound[^1]. Also, due to bandwidth and compatibility-reasons, you rarely see high-fidelity games being played on a browser. Performance is better achieved when running software natively on the operating system.

But don't underestimate the potential of the Web platform. As I explained in broad terms at the talk I gave at the last GodotCon Boston 2025, the Web has caught up a lot since the days of Flash games. Not only there's more and more people playing Web games every year, but standards and browsers improve every year in functionality and in performance too.

And that's why we are interested in using WASM SIMD.

## WASM SIMD Benchmarks

Our resident benchmark expert Hugo Locurcio (better known as [Calinou](https://github.com/Calinou/)) ran the numbers for us on a stress test I made. We wanted to compare standard builds to builds with WASM SIMD enabled.

<div class="note" markdown=1>
**Note:** You may try to replicate his results, but be aware that he has a beast of a machine. Here are his PC's specifications:

- **CPU:** Intel Core i9-13900K
- **GPU:** NVIDIA GeForce RTX 4090
- **RAM:** 64 GB (2×32 GB DDR5-5800 C30)
- **SSD:** Solidigm P44 Pro 2 TB
- **OS:** Linux (Fedora 42)
</div>

I built a Jolt physics stress test from a scene initially made by [passivestar](https://bsky.app/profile/passivestar.bsky.social). By spawning more and more barrels into the contraption, we can easily test the performance difference between the WASM SIMD build and the other.

| | Without WASM SIMD | With WASM SIMD | Improvement (approx.) |
| :---: | :---: | :---: | :---: |
| Test links | <a href="https://adamscott.github.io/godot-physics-demo-without-simd/" target="_blank">Link</a> | <a href="https://adamscott.github.io/godot-physics-demo-with-simd/" target="_blank">Link</a> | - |
| Firefox 138<br>("+100 barrels" 3 times) | ![Firefox 138 "+ 100 barrels" 3 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-firefox138-3times-without-wasm-simd.webp) | ![Firefox 138 "+ 100 barrels" 6 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-firefox138-3times-with-wasm-simd.webp) | **2×** |
| Firefox 138<br>("+100 barrels" 6 times) | ![Firefox 138 "+ 100 barrels" 3 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-firefox138-6times-without-wasm-simd.webp) | ![Firefox 138 "+ 100 barrels" 6 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-firefox138-6times-with-wasm-simd.webp) | **10.17×**\* |
| Chromium 134<br>("+100 barrels" 3 times) | ![Chromium 134 "+ 100 barrels" 3 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-chromium134-3times-without-wasm-simd.webp) | ![Chromium 134 "+ 100 barrels" 6 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-chromium134-3times-with-wasm-simd.webp) | **1.37×** |
| Chromium 134<br>("+100 barrels" 6 times) | ![Chromium 134 "+ 100 barrels" 3 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-chromium134-6times-without-wasm-simd.webp) | ![Chromium 134 "+ 100 barrels" 6 times without SIMD](/storage/blog/upcoming-web-serious-performance-boost/calinou-chromium134-6times-with-wasm-simd.webp) | **14.17×**\* |

_\*Please note that once the physics engine enters a "spiral of death", it is common for the framerate to drop to single digits, SIMD or not. These tests don't prove 10× to 15× CPU computing speed improvements, but rather that games will be more resilient to framerate drops on the same machine in the same circumstances. The 1.5× to 2× numbers are more representative here of the performance gains by WASM SIMD._

## What it means for your games

Starting with 4.5 dev 5, you can expect your Web games to run a little bit more smoothly, without having to do anything. Especially when things get chaotic (for your CPU). It isn't a silver bullet for poorly optimized games, but it will help nonetheless. Also, note that it cannot do anything for GPU rendering bottlenecks.

Be aware that the stress tests are meant by nature to only test the worst case scenarios, so you may not see such large improvements in normal circumstances. But it's nice to see such stark improvements when the worst happens.

## Availability

From here on out, the 4.5 release official templates will only support WebAssembly SIMD-compatible browsers in order to keep the template sizes small. We generally aim to maintain compatibility with the oldest devices we can. But in this case, the performance gains are too large to ignore and the chances of users having browsers that are that far out of date is too small relative to the potential benefits.

If you need to use non-SIMD templates, don't fret. You can always [build](https://docs.godotengine.org/en/stable/contributing/development/compiling/index.html) the Godot Editor and the engine templates without WebAssembly SIMD support by using the `wasm_simd=no` build option.

## What's next?

As I wrote in [my last blog post](/article/live-from-godotcon-boston-web-dotnet-prototype/), we're currently working very hard to make C#/.NET exports a reality. We do have [a promising prototype](https://lab.godotengine.org/godot-dotnet-web/), we just need to make sure that it's production-ready.

I also mentionned in that article that I wanted to concentrate on improving our asset loading game. Preloading an entire game before even starting it hinders the ability to use Godot for commercial Web games. Once something is implemented to improve that issue, count on me to share you the news.

[^1]: It's either that, or we return to the old days of spam-webpages using the ["Congratulations, you won!"](https://www.youtube.com/watch?v=WckVsX5-uyE) sound effect when you least expect it.

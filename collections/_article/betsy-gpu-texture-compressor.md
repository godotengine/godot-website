---
title: "Introducing the Betsy GPU texture compressor"
excerpt: "My name is Matias N. Goldberg, I normally maintain the 2.x branch of Ogre, and I wrote Betsy, a GPU texture compressor that runs on GPUs."
categories: ["progress-report"]
author: Matias Goldberg
image: /storage/app/uploads/public/5fb/e92/016/5fbe920160a53834592537.jpg
date: 2020-11-25 00:00:00
---

My name is [Matias N. Goldberg](https://twitter.com/matiasgoldberg), I normally maintain the [2.x branch of Ogre](https://www.ogre3d.org/download/sdk/sdk-ogre-next) aka [ogre-next](https://github.com/OGRECave/ogre-next) and I wrote Betsy, a GPU texture compressor that runs on GPUs.

This work was commissioned by Godot Engine through the Software Freedom Conservancy to solve a major complaint: importing textures is excruciantly slow and takes many minutes.

Certain compression algorithms such as BC1-5 are quite simple and there are already fast high quality compression algorithms.

However algorithms such as BC6, ETC1, ETC2 and EAC are currently taking the majority of time and thus considerably attention were given to these.

Nonetheless Betsy implemented compute-shader versions for BC1,3,4,5,6, ETC1,2 and EAC algorithms.

Betsy works as a standard Command Line tool which means it can be used like any other exe tool outside of Godot.

More importantly, Betsy was developed with integration to Godot in mind, which is why its code has been isolated and abstracted from API details, written in GLSL shaders since Godot uses Vulkan.

Godot can make further performance improvements a standard CLI tool can't, because Godot doesn't have to initialize the graphics API every time it is invoked to compress a texture; and Godot can upload a texture just once and then encode into multiple formats (e.g. compress into BC1 and ETC1, or EAC and BC4 at the same time); rather than re-upload the texture again for every format we need to compress into.

Theoretically the CLI tool could accept to encode many textures in a single invocation (e.g. encode A.png into A.etc1.ktx A.etc2.ktx A.bc1.ktx and B.etc1.ktx B.etc2.ktx B.bc1.ktx) but we were worried that could complicate the code and make its integration with Godot harder. Additionally it's hard to write a generic tool interface that would take advantage of such command line syntax.

# What is texture compression and why you care

GPUs have precious limited available RAM. Too many big textures and you can see yourself running out of RAM.

When that happens, the GPU driver may fallback to streaming from regular system RAM over the PCI-E bus.

When this works, a significant performance degradation can happen.
When this doesn't, the game will just crash.

On phones, lower RAM consumption isn't the only reason. Smaller textures mean less bandwidth. And less bandwidth means better battery life (and sometimes less bandwidth can also mean higher performance on both desktop and mobile).

There are three major types of texture compression categories, but only one is useful for GPUs:

## Lossless (e.g. PNG)

This compression family lower the size of the texture using algorithms such as [gzip](https://en.wikipedia.org/wiki/Gzip), [bzip](https://en.wikipedia.org/wiki/Bzip2) or [LZMA](https://en.wikipedia.org/wiki/Lempel%E2%80%93Ziv%E2%80%93Markov_chain_algorithm), among others. The main advantage is that the bits of the original texture are preserved. That's why it's **loss**-**less** i.e. no quality is lost.

The disadvantage is that they take a variable time to decompress i.e. it can take anywhere as 1 nanosecond to 30 seconds, or who knows, maybe more.

Unfortunately, due to this variable-time in decompression, these family of texture compression algorithms are of no use for a GPU.

Another disadvantage is that the compression ratio is unknown. A 1024x1024 may compress to 10kb, while another 1024x1024 texture may compress to 0.7MB.

This large unknown disparity in size also makes them inviable for GPUs.

This means that a 1024x1024 RGBA PNG texture that is only 10kb on disk **must** be decompressed before uploading to the GPU, thus always occupying 4MB of video RAM.

## Lossy (e.g. JPEG)

This compression family uses algorithms like [Discrete Cosine Transform](https://en.wikipedia.org/wiki/Discrete_cosine_transform) (aka DCT) to discard some details of the original image in order to hugely reduce their size.

That is: they do lose quality, but it is often hard to notice and achieve huge size reductions.

Unfortunately, they're still a no-go for GPUs due to how expensive it is to decode DCT, and because decompressing often requires 'postprocessing' passes that looks on the whole texture to hide artifacts and improve quality.

Therefore, just like in the PNG case, a 1024x1024 RGB JPEG texture that is only 120kb on disk **must** be decompressed before uploading to the GPU, thus always occupying 4MB of video RAM.

## GPU lossy (e.g. BC1-7, ETC1-2, EAC, PVRTC, ASTC)

We finally arrive at the family this article is about!

This family of compression algorithms meet two criterias that are *key* for GPUs:

 1. Decompression is fast and easy, and can be done in constant O(1) time. i.e. it always takes the same amount of time. e.g. if it takes 20 nanoseconds on a given GPU, it *always* takes 20 nanoseconds, no matter which pixel you need to fetch.
 2. Compression ratio is constant. For example BC1 has a 1:8 compression ratio. That means that a 1024x1024 RGB texture which on RAM would occupy 4MB uncompressed, using BC1 it will *always* occupy 0.5MB

**To be clear:** except rare occassions, these formats cannot compete in quality against the other family of lossy formats (like JPEG), and they do not intend to.

Fast decompression and reasonable quality are the goals here. If you don't like it and have infinite money, you can always buy a 24GB RAM GPU.

But for the rest of us, this compression family is a good deal.

**Why are there so many formats (BC1, BC4, ETC1, etc, etc) you ask?**

Well, one reason is patents. For example ETC1, ETC2 and EAC appeared because phone vendors didn't want to pay the patent for the BC1-5 family of compression algorithms. This patent [expired on March 16, 2018](https://en.wikipedia.org/wiki/S3_Texture_Compression#Patent). However plenty of phones came before 2018.

Another reason is that some algorithms are better suited for different content. For example BC5 & EAC are very good at compressing *normal maps*, while BC1 & ETC1 are reasonably good for compressing RGB *photo-like* textures, and BC3 and ETC2 are reasonably good for RGBA photo-like textures.

Then some formats simply are improvements over time: BC7 came *much* later and is BC1 on steroids. Although it is double the size of BC1, it preserves quality much better than BC1 ever did. If your card supports DirectX10, then it supports BC7. But if it's older than that, it won't.

Then there is the relatively-new ASTC which is a very good and flexible patent-free compression format, but desktop vendors resist it because it is very expensive in terms of HW manufacturing costs and die area size. Also not all phones support it, either because they're too old, or due to costs.

# GPU compression can take (a lot of) time

OK, so we just have to use those formats I mentioned above right? We use BC1, BC3, ETC1, etc.

Hold on! Not so fast:

Some GPUs support some textures but not others. While there are assumptions that can be made (e.g. all desktop DX10-class GPUs and newer support BC1-7), if you aim at different platforms (Windows, iOS, Android) the answer to the question '*which format should we use?*' then the answer will be: **All of them**.

Games usually have to bundle the same textures in all suitable formats and pick the best supported variation based on the HW it is running.

This isn't good for package sizes on disk, but we ensure compatibility. Some mobile games decide to download the texture pack after installation once it knows which device it is running on.

Other solutions like [Basis Universal](https://github.com/BinomialLLC/basis_universal) use the term 'transcoding' to generate an ETC1 or BC1 texture based on a single binary package. By trading off some quality and saving shared information, an ETC1 or BC1 texture can be generated on the fly.

The main problem is that some formats like BC1 are easy to encode. **But other formats like ETC2 or BC7 can take a lot of time**. Encoding a bunch of small textures can take literal minutes!

If an artist needs to wait 30 seconds to deploy to his phone every time he changes a few textures to see how it looks like, then we've got a big iteration problem!

That's where betsy comes in.

# Not all encoders are born equal

Performance isn't the only metric! Another issue is that not all compressors produce the same quality!

There are many ways to encode a texture, and arriving to each solution will achieve slightly different results. Some compressors are better at preserving quality than others.

Betsy aims at encoding in high quality. Even if we may not end up being *the* best encoder, we can't sacrifice quality for speed (unless it's configurable and the user wants to)

# Betsy is a GPU encoder

Regular code is written to be run on a CPU. Betsy runs on a GPU.
GPUs are massively parallel machines. And GPU compression happens to parallelize quite well (some formats better than others)

What is faster depends on what CPU do you own vs what GPU do you own, and which compression format is selected.
A 64-core Ryzen Threadripper paired with a GeForce 1030 or Radeon HD 7350, the CPU will obviously beat the GPU.

However if you own the latest GeForce 3080 or Radeon 6800 XT, chances are a GPU encoder will win in encoding time.

It is important to mention that my work was mostly porting existing codecs written in C or C++ for the CPU, and convert them into GPU-friendly compute shaders. A notable exception is ETC2's P-mode which has been extended with our own efforts to significantly improve encoding quality of this mode.

You can find more information in the [LICENSE](https://github.com/darksylinc/betsy/blob/master/LICENSE.md) and [README](https://github.com/darksylinc/betsy/blob/master/README.md) pages.

# Benchmark Performance

OK enough boring explanation! Let's see how Betsy fares against other encoders:

Notes:

 1. CPU is Intel i7 7700 3.6Ghz (4.2Ghz turbo). 2x16GB RAM 3000Mhz. 4 core, 8 threads.
 1. GPU is AMD Radeon HD 560 2GB VRAM
 1. Benchmark was done on Linux Ubuntu 18.04 LTS (HWE), Mesa 20.1.3
 1. [etc2comp](https://github.com/google/etc2comp) is what Godot currently uses
 1. [ConvectionKernels](https://github.com/elasota/ConvectionKernels) aka CVTT, which uses SIMD/SSE to run compress multiple blocks at once, similarly to what Betsy does.
 1. Multithreaded tests were done spawning one process for each texture. This is suboptimal as it results in oversubscription for CVTT, and excessive contention of access to GPU for Betsy. The exception is etc2comp which supports native per-texture multithreading out of the box.
 1. Single threaded numbers for CVTT are included because multithreading is not supported out of the box by CVTT
 1. Single threaded numbers for etc2comp are not included because it supports multithreading out of the box, and single threaded version is simply way too slow.
 1. The original Kodim set's resolution was too small to fully saturate the GPU in Betsy (according to radentop, around 60% GPU usage), which is why there is a strong difference between the 'multithreaded' and 'singlethreaded' versions. This difference gets much smaller for the 2048 upscaled set (keeping aspect ratio).
 1. Betsy was run for every texture independently, which includes a small overhead for initializing OpenGL every time. This could be further improved to support encoding multiple textures with one single invocation.
 1. Betsy's first run in a system may take considerably larger time as compute shaders must be compiled and will later be cached by the driver in subsequent runs. This will happen again if the driver is updated.
 1. All values are time in seconds.
 1. Betsy's Quality = 1 (medium quality) was included because it only affects ETC1 modes (not the extended T, H and P ETC2 modes), the quality difference is very low, but the performance gains are gigantic.
 1. The scripts used to run this benchmark can be found on [Github/betsy_benchmark](https://github.com/darksylinc/betsy_benchmark)

## ETC1

| Set                          | **Betsy MT (q = 1)** | **Betsy ST (q = 2)** | **Betsy MT (q = 2)** | **CVTT ST** | **CVTT MT** | **etc2comp MT** |
| ---------------------------- | -------------------- | -------------------- | -------------------- | ----------- | ----------- | --------------- |
| Kodim (25 textures)          | 1,36                 | 11,45                | 9,01                 | 34,88       | 6,85        | 18,35           |
| Upscaled to 2048xN Kodim     | 3,6                  | 56,95                | 52,72                | 244,14      | 48,29       | 138,5           |

## ETC2 RGB

| Set                          | **Betsy MT (q = 1)** | **Betsy ST (q = 2)** | **Betsy MT (q = 2)** | **CVTT ST** | **CVTT MT** | **etc2comp MT** |
| ---------------------------- | -------------------- | -------------------- | -------------------- | ----------- | ----------- | --------------- |
| Kodim (25 textures)          | 3,16                 | 13,21                | 10,85                | 45,44       | 8,16        | 39,29           |
| Upscaled to 2048xN Kodim     | 14,68                | 69,55                | 65,41                | 322,26      | 57,81       | 253,48          |

## BC1

| Set                          | **Betsy ST** | **Betsy MT** | **nvcompress ST (CPU)** | **nvcompress MT (CPU)** |
| ---------------------------- | ------------ | ------------ | ----------------------- | ----------------------- |
| Kodim (25 textures)          | 3,12         | 0,6          | 12,6                    | 2,4                     |
| Upscaled to 2048xN Kodim     | 4,87         | 1,34         | 85,07                   | 16,17                   |

*Notes:*

 1. *This needs more research, but it appears BC1 is bottleneck by GPU initialization, GPU uploads and data download, rather than encoding time*
 1. *CVTT supports BC1, however its CLI tool doesn't come with BC1 support out of the box and I had no time to add support for it to do the benchmark*

## BC5

|                              | **Betsy ST** | **Betsy MT** | **nvcompress ST (CPU)** | **nvcompress MT (CPU)** |
| ---------------------------- | ------------ | ------------ | ----------------------- | ----------------------- |
| Kodim set (25 textures)      | 2,94         | 0,73         | 1,97                    | 0,42                    |
| Upscaled to 2048xN Kodim set | 5,84         | 1,70         | 13,18                   | 0,86                     |

*Notes:*

 1. *This needs more research, but it appears BC5 is bottleneck by GPU initialization, GPU uploads and data download, rather than encoding time*
 1. *CVTT supports BC5, however its CLI tool doesn't come with BC5 support out of the box and I had no time to add support for it to do the benchmark*

# Benchmark quality

Notes:

 1. RSMLE: **Lower is better**. It means Root Mean Squared Logarithmic Error.
 1. Betsy q = 1 is medium quality
 1. Betsy q = 2 is maximum quality
 1. It is unknown why ConvectionKernels some RSMLE increased in ETC2 over ETC1. It could be a CVTT bug, or a difference in how CVTT measures error vs how I measured it.
 
## ETC1 RGB

|             | Betsy (q = 1) | Betsy (q = 2) | ConvectionKernels | etc2comp |
| ----------- | ------------- | ------------- | ----------------- | -------- |
| **Average** |	**0.0244532** | **0.02389376**| **0.02383864**    | **0.02502284** |
| kodim01.png | 0.027957      | 0.027166      | 0.026895          | 0.028578 |
| kodim02.png | 0.021755      | 0.021433      | 0.021336          | 0.021954 |
| kodim03.png | 0.019651      | 0.019205      | 0.01924           | 0.019886 |
| kodim04.png | 0.021453      | 0.021123      | 0.020989          | 0.021704 |
| kodim05.png | 0.033579      | 0.032763      | 0.032588          | 0.034686 |
| kodim06.png | 0.024893      | 0.024265      | 0.024038          | 0.02545  |
| kodim07.png | 0.021911      | 0.021344      | 0.021057          | 0.022076 |
| kodim08.png | 0.032968      | 0.032022      | 0.031604          | 0.034042 |
| kodim09.png | 0.02002       | 0.019602      | 0.01945           | 0.020201 |
| kodim10.png | 0.01986       | 0.019409      | 0.019306          | 0.020063 |
| kodim11.png | 0.023587      | 0.023122      | 0.022928          | 0.024056 |
| kodim12.png | 0.018662      | 0.018255      | 0.018087          | 0.018833 |
| kodim13.png | 0.035328      | 0.034559      | 0.034416          | 0.036992 |
| kodim14.png | 0.030336      | 0.029845      | 0.029985          | 0.030972 |
| kodim15.png | 0.02186       | 0.021373      | 0.021296          | 0.02207  |
| kodim16.png | 0.019238      | 0.018806      | 0.018663          | 0.019542 |
| kodim17.png | 0.020262      | 0.019792      | 0.019767          | 0.020738 |
| kodim18.png | 0.027783      | 0.02724       | 0.02728           | 0.028719 |
| kodim19.png | 0.023358      | 0.022718      | 0.022477          | 0.023831 |
| kodim20.png | 0.019751      | 0.019281      | 0.019395          | 0.020377 |
| kodim21.png | 0.025063      | 0.024488      | 0.024325          | 0.025592 |
| kodim22.png | 0.02337       | 0.022873      | 0.023036          | 0.023909 |
| kodim23.png | 0.020536      | 0.020071      | 0.020435          | 0.021016 |
| kodim24.png | 0.028179      | 0.027181      | 0.028165          | 0.029515 |
| kodim25.png | 0.02997       | 0.029408      | 0.029208          | 0.030769 |

## ETC2 RGB

|             | Betsy (q = 1) | Betsy (q = 2) | ConvectionKernels | etc2comp |
| ----------- | ------------- | ------------- | ----------------- | -------- |
| **Average** |	**0.02432348**| **0.02378536**| **0.02400548**    | **0.02412212** |
| kodim01.png | 0.027986      | 0.027183      | 0.027318          | 0.027943 |
| kodim02.png | 0.021448      | 0.021169      | 0.020991          | 0.020887 |
| kodim03.png | 0.019842      | 0.019471      | 0.018829          | 0.018195 |
| kodim04.png | 0.021408      | 0.021105      | 0.020959          | 0.020991 |
| kodim05.png | 0.03355       | 0.032722      | 0.033068          | 0.033774 |
| kodim06.png | 0.02492       | 0.024283      | 0.024317          | 0.024731 |
| kodim07.png | 0.02115       | 0.020651      | 0.020834          | 0.020812 |
| kodim08.png | 0.033198      | 0.032233      | 0.03278           | 0.033356 |
| kodim09.png | 0.019712      | 0.019335      | 0.019633          | 0.01955  |
| kodim10.png | 0.019716      | 0.019285      | 0.019424          | 0.019459 |
| kodim11.png | 0.023473      | 0.022995      | 0.023223          | 0.023395 |
| kodim12.png | 0.018597      | 0.018215      | 0.018109          | 0.017998 |
| kodim13.png | 0.03541       | 0.034635      | 0.035375          | 0.036008 |
| kodim14.png | 0.030282      | 0.029791      | 0.029887          | 0.029976 |
| kodim15.png | 0.021945      | 0.021515      | 0.021449          | 0.021243 |
| kodim16.png | 0.01877       | 0.018382      | 0.01866           | 0.018717 |
| kodim17.png | 0.020175      | 0.019729      | 0.019988          | 0.019844 |
| kodim18.png | 0.028034      | 0.027471      | 0.027707          | 0.02808  |
| kodim19.png | 0.023166      | 0.022545      | 0.022932          | 0.023125 |
| kodim20.png | 0.019773      | 0.019299      | 0.019545          | 0.019642 |
| kodim21.png | 0.02487       | 0.024313      | 0.024721          | 0.024833 |
| kodim22.png | 0.02336       | 0.022859      | 0.023109          | 0.02323  |
| kodim23.png | 0.019306      | 0.018971      | 0.019284          | 0.018592 |
| kodim24.png | 0.028032      | 0.027072      | 0.02846           | 0.028448 |
| kodim25.png | 0.029964      | 0.029405      | 0.029535          | 0.030224 |

## BC1

|             | **Betsy**    | **nvcompress** |
| ----------- | ------------ | -------------- |
| **Average** | **0.028589** | **0.026943**   |
| kodim01.png | 0.034792     | 0.032564       |
| kodim02.png | 0.02562      | 0.024146       |
| kodim03.png | 0.020277     | 0.018898       |
| kodim04.png | 0.023814     | 0.022424       |
| kodim05.png | 0.040001     | 0.037991       |
| kodim06.png | 0.0298       | 0.028163       |
| kodim07.png | 0.024172     | 0.022762       |
| kodim08.png | 0.042638     | 0.040288       |
| kodim09.png | 0.022284     | 0.020803       |
| kodim10.png | 0.022031     | 0.020619       |
| kodim11.png | 0.028216     | 0.026493       |
| kodim12.png | 0.020243     | 0.01892        |
| kodim13.png | 0.045498     | 0.042873       |
| kodim14.png | 0.034357     | 0.032726       |
| kodim15.png | 0.024274     | 0.023026       |
| kodim16.png | 0.021505     | 0.019977       |
| kodim17.png | 0.023141     | 0.021715       |
| kodim18.png | 0.033236     | 0.031521       |
| kodim19.png | 0.027642     | 0.025856       |
| kodim20.png | 0.02268      | 0.021438       |
| kodim21.png | 0.029862     | 0.028107       |
| kodim22.png | 0.026809     | 0.02531        |
| kodim23.png | 0.020595     | 0.019312       |
| kodim24.png | 0.034883     | 0.033199       |
| kodim25.png | 0.036355     | 0.034444       |

## BC5

|             | **Betsy**      | **nvcompress** |
| ----------- | -------------- | -------------- |
| **Average** | **0,40713988** | **0,4071152**  |
| kodim01.png | 0,380992       | 0,380943       |
| kodim02.png | 0,147688       | 0,147673       |
| kodim03.png | 0,341727       | 0,341719       |
| kodim04.png | 0,35518        | 0,355176       |
| kodim05.png | 0,317971       | 0,317893       |
| kodim06.png | 0,467379       | 0,467362       |
| kodim07.png | 0,368736       | 0,368721       |
| kodim08.png | 0,507863       | 0,507801       |
| kodim09.png | 0,511146       | 0,511134       |
| kodim10.png | 0,482672       | 0,482662       |
| kodim11.png | 0,364467       | 0,364442       |
| kodim12.png | 0,570088       | 0,570084       |
| kodim13.png | 0,388023       | 0,387951       |
| kodim14.png | 0,313848       | 0,313811       |
| kodim15.png | 0,495639       | 0,49563        |
| kodim16.png | 0,404634       | 0,404633       |
| kodim17.png | 0,329696       | 0,329685       |
| kodim18.png | 0,229002       | 0,228954       |
| kodim19.png | 0,424489       | 0,424464       |
| kodim20.png | 0,70348        | 0,703468       |
| kodim21.png | 0,487161       | 0,487138       |
| kodim22.png | 0,393033       | 0,393022       |
| kodim23.png | 0,364163       | 0,364154       |
| kodim24.png | 0,424539       | 0,424513       |
| kodim25.png | 0,404881       | 0,404847       |

# Get Technical

If you're a GPU nerd, we have an [in-depth analysis](https://github.com/darksylinc/betsy/blob/master/Docs/technical_doc_advanced.md) of how betsy's compute shaders are implemented.

Keep in mind it is quite advanced and assumes you're somewhat familiar with GPU shader coding.
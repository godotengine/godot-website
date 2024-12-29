---
title: "2024 in Review"
excerpt: "This year was almost as packed as the 4.3 release, so let's go through the months and engine areas together and talk highlights."
categories: ["newsletter"]
author: Nat
image: 
date: 2024-12-31 10:00:00
---
 
And with that, the 2024 season comes to an end. What a year it has been, with the number of Godot submissions in game jams rising to new heights, [more people working for the Godot Foundation than ever before](https://godotengine.org/article/godot-foundation-update-dec-2024/), and most industry award shows featuring one if not more games #MadeWithGodot. 

So let us celebrate the past year by looking back at one key highlight per month - an event the team attended, a major project milestone being reached, or a fun moment online the Godot community gathered around. Likewise, we looked at the release dates of notable [Godot games on Steam](https://steamdb.info/tech/Engine/Godot/) and decided to introduce you to some favorites alongside our own news. 

Of course, we cannot forget the sheer amount of technological progress being made by thousands of contributors, so for the purpose of this review we checked in with the different maintainers as well. Find a summary of the most notable change per engine area below (and tell us about your personal highlight [in the comments](https://forum.godotengine.org/))!

## January
<img alt="the commit that open-sourced Godot" src="/storage/blog/2024-review/commit.jpg"/>

Nostalgia became the theme of January, as we compiled a small [game showcase](https://x.com/godotengine/status/1754601111229497650) leading up to Godot’s 10-year-anniversary (counting from the moment the engine was first open sourced). For every year from 2014 to 2024 we shared two gems found on Steam and itch.io with the community, celebrating an ever growing list of Godot releases since the beginnings of the project. 

Have a look at that [monumental commit](https://github.com/godotengine/godot/commit/0b806ee0fc9097fa7bda7ac0109191c9c5e0a1ac) all those years ago!

<hr>
[KinitoPET](https://store.steampowered.com/app/2075070/KinitoPET)

Desktop pets have risen to new popularity in 2024. *KinitoPET* combines this trend with the evergreen horror-genre to bring you a unique experience about virtual assistants.
<hr>

## February
As part of our social media expansion, we also created an [*_official* Godot Engine account](https://www.twitch.tv/godotengine_official) on the streaming platform Twitch. 

Using it to check on Godot game development streamers resulted in [this funny compilation](https://www.youtube.com/watch?v=Ed9xuwtmoUw) - both the content creators and their viewers expressed happiness that the communities they had built were being recognized.

Logically, the next step was to hand over the reins of the channel to some of these talented developers. You can find the [takeover recordings](https://youtube.com/playlist?list=PLeG_dAglpVo5vWX06WyYThUOydLVmb1Iu&si=WBi8qIJEaSHh42NN) on [our YouTube](https://www.youtube.com/@GodotEngineOfficial).

<hr>
[Windowkill](https://store.steampowered.com/app/2726450/Windowkill)

Another twist on “gaming directly on a desktop” came in the form of the action roguelike *Windowkill*. The twin-stick shooter requires you to keep track of and fight the ever-closing game windows when evading enemies.
<hr>

## March
In March, the Godot Foundation team assembled in San Francisco to meet community members at our biggest event booth yet. We shared the space with our sponsor [W4 Games](https://www.w4games.com/) and a wide array of [Godot games](https://godotengine.org/article/gdc-2024-godot-games/) we were fortunate enough to invite to attend GDC with us.

<img alt="group picture at the GDC booth" src="/storage/blog/2024-review/gdc.jpg"/>

We had a great time, both on the event grounds and at our own gatherings, and made sure to recount our full experience in a [blog post](https://godotengine.org/article/gdc-2024-retrospective/) - see you next year?

<hr>
[Backpack Battles](https://store.steampowered.com/app/2427700/Backpack_Battles)

*Backpack Battles* decided to make inventory management the main game mechanic. The PvP auto-battler with a medieval fantasy theme has quickly gained popularity with content creators!
<hr>

## April
Towards the end of 2023 we [announced a collaboration with Google and The Forge](https://godotengine.org/article/collaboration-with-google-forge-2023/) to improve the performance of our Vulkan mobile backend. The work concluded in April, with the [matching PR](https://github.com/godotengine/godot/pull/90284) being split into the 4.3 and 4.4 releases. 

A few highlights: 
- Usage of Unified Memory Architecture (UMA) buffers when available
- Add Android [Thermal API](https://developer.android.com/games/optimize/adpf/thermal) support
- Replace large push constants with dynamic uniform buffers
- Optimize descriptor sets and descriptor set batching
- Optimize swapchain operations
- Integrate [Swappy frame pacing](https://developer.android.com/games/sdk/frame-pacing) from the Google AGDK
- Read more about the changes in our [collaboration update] (https://godotengine.org/article/update-on-google-forge-2024/).

<hr>
[Of Life and Land](https://store.steampowered.com/app/1733110/Of_Life_and_Land)

Build your own settlements in *Of Life and Land* and experience different maps, scenarios, and rich simulations. Strategize with animals and nature in mind!
<hr>

## May
Did you know that we still update Godot 3? Not everyone upgraded their projects when the big codebase refresh happened last year, so by offering two versions alongside each other we aim to accommodate these existing games as well as lower-end systems used by developers.

The feature freeze for 3.6 happened in May, leading up to the most recent [release in September](https://godotengine.org/article/godot-3-6-finally-released/).

Look at these shiny highlights:
- [2D Physics Interpolation](https://godotengine.org/article/godot-3-6-finally-released/#2d-physics-interpolation-gh-76252)
- [2D Hierarchical Culling](https://godotengine.org/article/godot-3-6-finally-released/#2d-hierarchical-culling-gh-68738) 
- [Tighter Shadow Culling](https://godotengine.org/article/godot-3-6-finally-released/#tighter-shadow-culling-gh-84745) 
- [Mesh Merging](https://godotengine.org/article/godot-3-6-finally-released/#mesh-merging-gh-61568) 
- [Discrete Level of Detail (LOD)](https://godotengine.org/article/godot-3-6-finally-released/#discrete-level-of-detail-lod-gh-85437) 
- [ORM Materials](https://godotengine.org/article/godot-3-6-finally-released/#orm-materials-gh-76023)

<hr>
[Arctic Eggs](https://store.steampowered.com/app/2763670/Arctic_Eggs) 

This game about cooking eggs in a cold climate found great reception on the internet. There is just something about the frustratingly fun mechanics of *Arctic Eggs* that captured quite an audience - who are we to judge your taste?
<hr>

## June
Our annual community poll rolled around in June. We want to know who our users are, so we can learn about common needs and offer the best support possible. 

[This year’s poll](https://docs.google.com/forms/d/1eicOppRQG2RFZ8CjIGFf5Kha5yklO854fV8-YFtlWxk/viewanalytics) had more responses than ever before, once again proving the incredible growth the Godot community is experiencing.

<img alt="poll results: programming languages" src="/storage/blog/2024-review/poll1.jpg"/>
<img alt="poll results: donations" src="/storage/blog/2024-review/poll2.jpg"/>

<hr>
[Until Then](https://store.steampowered.com/app/1574820/Until_Then)

Nominated for a plethora of awards, the visual novel *Until Then* tells the emotional story of the highschooler Mark in polished pixel art. Build relationships, play minigames, use social media, and most importantly: solve the mystery at hand.
<hr>

## July
The [Godot robot plushies](https://www.makeship.com/products/godot-robot-plush) took the internet by storm. In a collaboration with Makeship, we finally proved our infamous logo’s worth. Toothy grin and googly eyes translated adorably into the 3D medium. By the end of the campaign, almost 4.000 cuddly coding companions were headed towards new homes. 

Aside from the profits being funneled into the [Godot Development Fund](https://fund.godotengine.org/) and thereby opening an additional path to supporting the project financially, the plush also became a beloved community icon. Fanart was made, models of the robot were shared, and the character was granted countless cameos in games made with the engine.

<img alt="3D model of the Godot robot plush" src="/storage/blog/2024-review/plush.jpg"/>
[CC0 model by FR3NKD](https://fr3nkd.gumroad.com/l/vhfvy)

While the plush is currently sold out, we are working on bringing it back soon!

<hr>
[Forgotten Mines](https://store.steampowered.com/app/2238630/Forgotten_Mines)

This tactical roguelite invites you to go on runs in the *Forgotten Mines*. Turn-based mechanics and an RPG flavor round off the experience.
<hr>

## August
Instead of our usual release blogposts, we tried something new for Godot 4.3: a fully fledged [release page](https://godotengine.org/releases/4.3/) detailing all the juicy features awaiting you. 

Highlights of the biggest release yet:
- [Interactive Music](https://godotengine.org/releases/4.3/#highlights-interactive-music)
- [2D Physics Interpolation](https://godotengine.org/releases/4.3/#highlights-2d-physics-interpolation)
- [TileMapLayer nodes](https://godotengine.org/releases/4.3/#highlights-new-tilemaplayer-node)
- [Overhauled Visual Shader editor](https://godotengine.org/releases/4.3/#highlights-visual-shader) 
- [Multi-threading improvements](https://godotengine.org/releases/4.3/#highlights-general-multi-threading-improvements) 
- [Single-threaded Web exports](https://godotengine.org/releases/4.3/#highlights-single-threaded-web-export) 

All in all, **3,520 commits from 521 contributors** came together in this shared effort!

<hr>
[Megaloot](https://store.steampowered.com/app/2440380/Megaloot)

More inventory management mechanics come to you in the form of *Megaloot*, a roguelite allowing for diverse and powerful builds each run. Looting strategically is key.
<hr>

## September
As an open-source community, the Godot project thrives in matters of community maintained extensions. To ensure that valuable knowledge does not get lost once a creator decides to step down, we opened a new GitHub organization called [Godot SDK Integrations](https://github.com/godot-sdk-integrations) to host such projects.

Read more in our detailed [blogpost on the topic](https://godotengine.org/article/godot-sdk-integrations/). 

<hr>
[Halls of Torment](https://store.steampowered.com/app/2218750/Halls_of_Torment)

Survive monster hordes in this bullet hell roguelite set in the underworld. *Halls of Torment* is also available on SteamDeck and GooglePlay for gaming on the go!
<hr>

## October
We listened to the feedback of last year’s [GodotCon](https://conference.godotengine.org/past/) attendees and did the unthinkable: doubling the ticket amount once more, allowing 600 people onto the premises. 

On top of that, we introduced a game showcase and activities to the event schedule. Increasing our scope like so, we hoped to invite a wider variety of visitors to enjoy mingling with other community members and facilitate networking.

Read the full [GodotCon 2024 review](https://godotengine.org/article/review-godotcon24/) to reminisce together with us or (re-)watch the [talks on YouTube](https://www.youtube.com/watch?v=hKLl03A9Kws&list=PLeG_dAglpVo6TS0q858NajyeglRuvb7hs&index=12).

<hr>
[Psychopomp GOLD](https://store.steampowered.com/app/3243190/Psychopomp_GOLD)

Atmospheric psychological horror awaits you in the catacombs of *Psychopomp*. Solve the secrets of these new levels or mod your own.
<hr>

## November
Watch this year’s [Godot Engine showreel](https://www.youtube.com/watch?v=n1Lon_Q2T18) and join us in awe of the variety of projects being created by this community. Every year our expectations are exceeded all over again!

Submissions are handled via our own [showreel page](https://showreel.godotengine.org/about) and always [announced on our blog](https://godotengine.org/article/submissions-open-godot-2024-showreel/), so keep a close eye on those if you are interested in pitching your own game for the next one.

<hr>
[Unrailed 2: Back on Track](https://store.steampowered.com/app/2211170/Unrailed_2_Back_on_Track)

The second installment of this railroad construction game is made in Godot. Enjoy co-op gaming and procedurally generated worlds in *Unrailed 2*.
<hr>

## December
The [Godot Engine GitHub repository](https://github.com/godotengine/godot) is not only the most popular one in the game development category and has been starred 92,300 times at the time of writing, but we also reached yet another milestone this December: [crossing the threshold of 100,000 issues](https://github.com/godotengine/godot/issues/100000). 

To celebrate the occasion (and snatch the coveted number, before a minor issue receives the honor) our Release Manager wrote a [heartwarming blogpost](https://godotengine.org/article/beyond-100000-you-re-breathtaking/) that cannot be done justice by summarizing - so go read it for yourself!

<hr>
[Ballionaire](https://store.steampowered.com/app/2667120/Ballionaire)

The “autobonker” *Ballionaire* shows how fun physics can be. Assemble your pachinko boards strategically and watch the effects go wild.
<hr>

# Technological Highlights

### 2D
[2D parallax](https://docs.godotengine.org/en/stable/tutorials/2d/2d_parallax.html)

### 3D
[3D physics interpolation](https://github.com/godotengine/godot/pull/92391)

### Core 
Typed dictionaries

### GUI
Many localization improvements

### Editor
[Project Manager refresh](https://godotengine.org/releases/4.3/#editor-layout-ux-improvements-project-manager)

### Scripting
- **GDScript:**
- **.NET:**

### Platforms
- **Android:** [Android Editor](https://godotengine.org/download/android/) feature complete with export support
- **Web:** [Single-threaded export with audio samples](https://godotengine.org/releases/4.3/#editor-layout-ux-improvements-project-manager) 
- **Linux:** [Wayland](https://godotengine.org/releases/4.3/#display-wayland-support) 
- **macOS/iOS:** Metal renderer
- **Windows:** [Direct3D 12](https://godotengine.org/download/android/) 

### Systems
- **Animation:** [migrating from Godot 4.0 to 4.3](https://godotengine.org/article/migrating-animations-from-godot-4-0-to-4-3/)
- **Audio:** [interactive music](https://godotengine.org/releases/4.3/#highlights-interactive-music)
- **Import**: [new ufbx importer](https://godotengine.org/article/introducing-the-improved-ufbx-importer-in-godot-4-3/)
- **Navigation:** enabled [chunk & obstacle baking](https://godotengine.org/releases/4.3/#navigation-splitting-navigation-meshes-into-chunks) 
- **Networking:**
- **Physics:** [Jolt merged](https://github.com/godotengine/godot/pull/99895) as alternative to the default 3D physics engine
- **Rendering:**re-introducing [ubershaders](https://docs.godotengine.org/en/latest/tutorials/performance/pipeline_compilations.html) 
- **VFX:** [Visual Shader overhaul](https://godotengine.org/releases/4.3/#highlights-visual-shader)
- **XR:** [Godot Editor now available on the Meta Horizon Store](https://godotengine.org/article/godot-editor-horizon-store-early-access-release/) 

### Documentation
[Comment section added](https://godotengine.org/releases/4.3/#documenation-commenting-enabled-on-the-online-docs) 

<hr>

Concluding our review, the only thing left to say is **thank you**. To those of you who contribute to the engine by code, donations, or growing the community through content creation. To our users, who help promote the project with their own success and battletest new features in real time. We also want to once again thank our [corporate sponsors](https://fund.godotengine.org/#credits) for believing in what we do. Lastly, I want to give a shoutout to my wonderful colleagues, for if they weren’t so incredibly dedicated to organizing and maintaining a collaboration this big, none of this would be possible either.

Are you too excited what the future will bring for the Godot Engine project?

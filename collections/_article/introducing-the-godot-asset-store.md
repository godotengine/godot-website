---
title: "Introducing the Godot Asset Store"
excerpt: "We've been working on replacing the Asset Library with something built for the present and future. Here's what's coming."
categories: ["news"]
author: Emi
image: /storage/blog/covers/godot-asset-store.jpg
date: 2026-05-22 15:00:00
---

The [Asset Library](https://godotengine.org/asset-library/asset) has served for many years as the official place to publish and acquire assets, fulfilling a valuable community need. 
However with the [rapid growth of the Godot community and ecosystem](https://godotengine.org/article/godot-growth-stats-2026/), it was time to come up with a new infrastructure.

After a couple years of work and a few months of beta testing, we are pleased to introduce the new [Godot Asset Store](https://store.godotengine.org/).

![A screenshot of the Godot Asset Store](/storage/blog/asset-store/godot-asset-store-screenshot.webp)

## The [Godot Asset Store](https://store.godotengine.org/)

The new Asset Store is live and stable and will be fully integrated in Godot 4.7. The Asset Store leverages Godot's shared account system, which means that if you have donated to the [development fund](https://fund.godotengine.org), participated on [the forum](https://forum.godotengine.org/) or on the [developer chat](https://chat.godotengine.org/), or voted for [showreel candidates](https://showreel.godotengine.org/), you already have an account. And if you haven't, creating one is easy.

The Asset Store introduces several new features:

- User reviews and ratings
![A screenshot showing the Reviews page of an asset](/storage/blog/asset-store/asset-store-reviews.png)

- Analytics for publishers
![A screenshot of the analytics page](/storage/blog/asset-store/asset-store-analytics.png)

- Multiple download versions per asset
![A screenshot of the download per version drop-down](/storage/blog/asset-store/asset-store-multiple-versions.png)

- A changelog page for asset
![A screenshot of an asset changelog page](/storage/blog/asset-store/asset-store-changelog.png)

- The ability to tag asset, including creating custom tags
![A screenshot of an asset's tags](/storage/blog/asset-store/godot-asset-store-tags.png)

In addition, many more features are [coming in the near future](https://store.godotengine.org/roadmap/) including the ability to [buy and sell assets](https://github.com/godotengine/godot-asset-store-tracker/issues/14).

We encourage users to visit the store, either through the [website](https://store.godotengine.org/) or through the [preview builds for Godot 4.7](https://godotengine.org/article/dev-snapshot-godot-4-7-beta-3/) and start providing feedback. 

And we encourage publishers to start migrating their assets to the Asset Store. 
Note that we considered automatically moving the assets from the library to the new store but decided against due to numerous issues:

- Need every publishers to create a new account and link them to their previous account
- Require permission from each publisher to republish on their behalf
- Need to re-upload all assets from the Asset Library to the new hosting solution as the Asset Library doesn't actually host any of the assets it distributes
- Auto-migrating abandoned or no longer supported assets would just create a lot of irrelevant entries in the new store

## What about the Asset Library?

We initially didn't have plans to run an asset store operated by the Foundation, as with most projects outside of the Godot Engine itself, we try to foster an ecosystem that provides solutions Godot developers need. There were also existing stores that people use (like [itch](https://itch.io/search?q=godot)), so we assumed the community would centralize around the one that worked best for them.

Unfortunately this approach and resulting gap led to confusion within the community as to which of those existing stores were backed by the Godot Foundation (e.g., the Foundation started receiving regular support emails from users). Some of these stores were also hosting paid versions of free assets (such as [Kenney's](https://www.kenney.nl/)) with unclear information about ownership or transparency.

Among these concerns, we were also running into growing tech debt with the Asset Library given that its architecture and infrastructure were not designed for the current present needs:

- The Asset Library doesn't use Godot shared account system, so users and publishers have to use yet another account for it, and the Foundation has to spend resources supporting and maintaining that account system.
- Existing infrastructure was hard to evolve while maintaining compatibility with older versions of the Godot editor.

We will keep the Asset Library running since many older versions of the engine still need it, but it should be considered deprecated, and will be set as a read-only repository in the near future.


## Future

Our core goals for the Asset Store in Godot 4.7 and 4.8 are to ensure that the transition away from the Asset Library is fully complete, and to make the Asset Store a space that's safe, functional, and up to the quality standards you'd expect.

Following that, we have several items on the [Asset Store roadmap](https://store.godotengine.org/roadmap/), the most anticipated one being the ability to sell and buy assets.
We also want to make it easier for users to donate to free plugins so we can improve support for many popular projects such as [Phantom Camera](https://store.godotengine.org/asset/ramokz/phantom-camera/), [Dialogue Manager](https://store.godotengine.org/asset/nathanhoad/dialogue-manager/), and [GodotSteam](https://store.godotengine.org/asset/godotsteam/godotsteam-gdextension/).

As a mean to promote Godot's extensibility, the Godot Foundation will use the Asset Store to publish official plugins and extensions we are working on and that we don't believe should be part of the core out-of-the-box experience.

This is just the beginning, and we really value your feedback and input. We want to hear your thoughts, and we will keep making changes and adjusting to make sure the [Godot Asset Store](https://store.godotengine.org/) delivers on the wants and needs of the community. So feel free create an [issue on our tracker](https://github.com/godotengine/godot-asset-store-tracker/issues), [open a discussion](https://github.com/godotengine/godot-asset-store-tracker/discussions), or get in touch via email at [contact@godot.foundation](mailto:contact@godot.foundation). 

We'll keep you all posted regarding the improvements of the store so expect to hear from us soon.
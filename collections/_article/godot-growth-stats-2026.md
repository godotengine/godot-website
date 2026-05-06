---
title: "Godot usage and engine growth"
excerpt: "Godot adoption has rapidly increased in the last few years. Here is a look at the hard numbers."
categories: ["news"]
author: Clay John
image: /storage/blog/godot-usage-2026/stonks.jpg
date: 2026-05-06 18:00:00
---

I like to keep track of Godot's growth. Since we don't have any tracking information in the engine itself, this can be challenging. So I use a variety of sources to try to get a full picture of how Godot is growing over time. I have been collecting data long enough now that I can finally put together some graphs that illustrate the growth of the engine. 

This data comes from many different sources and is collected in different ways, so it can be a little bit scattered. For example, I have data for the total number of downloads of each version of the engine from our website at a given point in time, but I don't have downloads per month. Whereas on Steam and Google Play, I have total downloads for all versions and monthly downloads. Finally, the data generally runs up into February 2026 since that is the last time I updated the data (and when I started the first draft of this post).

Overall, this data can give us some insight into the growth of Godot and its trajectory, but is not an exact picture. 

## Engine usage

Our data for engine usage is a little messy, partly owing to the mechanism we use for collecting the data and partly due to fragmentation within the ecosystem. I track engine usage primarily from 3 sources:

1. Downloads from our website/GitHub (we host the engine on GitHub and provide a link via our website)
2. Downloads via Steam
3. Downloads via Google Play

Steam and Google Play provide data on cumulative installs by unique users while our website/GitHub only provides data about total download count and includes duplicates when a user downloads the engine multiple times. 

#### Steam and Google Play - Cumulative Installs

<img alt="Graph of Godot editor downloads on Steam and Google Play" src="/storage/blog/godot-usage-2026/steam-google-play-installs.png" />

#### Website downloads

We have shifted to a better method of tracking downloads from the website that will provide us with more granular data in the future, but since the shift was so recent, we don't have good data yet. So we need to make do with my imperfect data collection.

<img alt="Graph of Godot editor downloads from the website" src="/storage/blog/godot-usage-2026/website-installs.png" />

We seem to be getting pretty consistently up to the 2ish million download mark with each release. You can see that quick patch releases partially cannibalize the stable release. Importantly for us, we can see that very few people are downloading earlier releases once a patch release has come out (e.g. very few people downloaded 4.4 once 4.4.1 was available). That differs from stable release to stable release (e.g. people continued to download 4.3 to some extent once 4.4 released). This is great news and confirms that users are mostly behaving the way that we expect: they are sticking to major versions in general and upgrading to new minor versions carefully, while being a lot less cautious about upgrading to a newer patch release.

I am looking forward to seeing how this data looks over the next few years as the current information is too sparse to draw many conclusions. 

## Community

For those who have been around the community for the last few years, this won't come as a surprise. Our community has doubled in size in the last couple of years. The growth appears to be slowing down in the last year, but it's too early to know if that is a trend or not. 

<img alt="Graph of Godot's growth in various social networks" src="/storage/blog/godot-usage-2026/community.png" />

My method of collecting data is just viewing whatever public-facing number is available when I remember to check and write it down. I have not been very scientific about my data collection practice as you can see. 

Notably, this data only tracks our large communities on social media which are predominantly English-speaking and Western-influenced. This data leaves out the growth in communities from countries that use different social networks. For example, we know that Godot usage is growing a lot in China where Reddit, Twitter, and Bluesky usage is a lot lower than it is in North America and Europe. Also, this data doesn't include Discord, which has a major Godot community. That is a limitation from the fact that I didn't think to include Discord when I started collecting this data!

## Games releases

#### Steam

Using SteamDB, we can keep track of approximately how many Godot games are released on Steam. We use SteamDB to source the header images for our dev release blog posts. It is a very helpful resource for us. The data is approximate, and it can change when SteamDB updates their algorithm, but the overall picture stays the same. The number of Godot games being released on Steam is exhibiting strong signs of exponential growth! For me personally, this has to be the most exciting statistic. It is amazing that many people are adopting the engine and using it, but as a person on the technical side of things, I also want to see that users are successfully using the engine to make their games. 

<img alt="Graph of Godot games released on Steam per year" src="/storage/blog/godot-usage-2026/steam-games.png" />

*source: https://steamdb.info/stats/releases/?tech=Engine.Godot*

#### Itch.io

We also monitor itch.io. There is a much lower barrier of entry to releasing games on itch.io than on other platforms. So we see a much higher number of Godot games there. I collect this data manually by going to itch.io and recording the total number of Godot games. So the data isn't as pretty, but it is still nice to look at.
<img alt="Graph of Godot's growth in various social networks" src="/storage/blog/godot-usage-2026/games-on-itch.png" />

*source: https://itch.io/tags/tools*

## Game jams

#### Global Game Jam

<img alt="Graph of Godot's growth in the Global Game Jam" src="/storage/blog/godot-usage-2026/ggj-games.png" />

Seeing consistent growth in usage in the Global Game Jam is very rewarding. It tells us that Godot usage is growing consistently in the next generation of developers and especially in educational settings. We hope that this generational growth continues and we see even higher rates in the coming generation of game developers. 

#### GMTK Game Jam

<img alt="Graph of Godot's growth in the GMTK Game Jam" src="/storage/blog/godot-usage-2026/gmtk-games.png" />

The GMTK Game Jam growth chart looks very similar to the Global Game Jam one, especially the jump between 2023 and 2024. However, it consistently features a higher proportion of Godot users. We hope to see Godot hit 50% or more one day!

*source: https://bsky.app/profile/gamemakerstoolkit.com/post/3lvkrymak5s26*

### Donations

Finally, let's compare the above growth to the growth in donations. 

We launched our development fund in September 2023 and have tracked how it has changed since then. As you can see below, the total monthly income from the dev fund hasn't changed all that much since its inception. We had an initial spike, that slowly dropped. Then in October 2024 we had a sudden spike in donations. In August 2025 we realized that we hadn't been properly tracking when subscriptions were cancelled through PayPal. When we corrected the tracking information it looked like a sudden drop in subscriptions, but in reality, our data was just artificially high for all the preceding dates.   
  
The final spike in December 2025 was from our latest fundraising campaign. As it turns out, asking for donations is the best way to increase donations. So expect to hear us asking more often. 

<img alt="Graph of Godot's Dev Fund" src="/storage/blog/godot-usage-2026/dev-fund.png" />

Overall, we see our funding as a very healthy and consistent amount. Consistency is the most important thing for us since it makes it easier to budget and means we aren't constantly laying off and re-hiring contractors. 

We are still trying to understand why donations don't track with the increase in users. We have a few theories:

1. New users see the Foundation as a well-entrenched player in the market that doesn't need funding
2. Users are happy with the pace of development and we aren't communicating the value/need of further donations well
3. New users see Godot as the free alternative to the other big engines

Notably this data does not track one-time donations. Most of our corporate sponsorships come through as one-time donations and represent a significant portion of our funding. They are still relatively random and sporadic, so it is difficult to draw any conclusions. 

## Support

Godot is a non-profit, open-source game engine developed by hundreds of contributors in their free time, as well as a handful of part or full-time developers hired thanks to [generous donations from the Godot community](https://fund.godotengine.org/). A big thank you to everyone who has contributed [their time](https://github.com/godotengine/godot/blob/master/AUTHORS.md) or [their financial support](https://github.com/godotengine/godot/blob/master/DONORS.md) to the project!

If you'd like to support the project financially and help us secure our future hires, you can do so using the [Godot Development Fund](https://fund.godotengine.org/) platform managed by [Godot Foundation](https://godot.foundation/). There are also several [alternative ways to donate](/donate) which you may find more suitable.
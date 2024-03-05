---
title: "Godot Showcase - Usagi Shima"
excerpt: "A relaxing, idle bunny collecting game made by Jess, a solo indie developer"
categories: ["showcase"]
author: Emi
image: /storage/blog/covers/usagi-shima.webp
date: 2023-09-01 15:00:00
---

Most of the games we highlighted so far on our blog are PC/console games, but today we are going to talk about a mobile game! Usagi Shima is a relaxing, idle bunny collecting game made by Jess, a solo indie developer. We had the chance to interview her about her experience of developing the game using the Godot Engine.

<iframe width="560" height="315" src="https://www.youtube.com/embed/FWOKjCe9Ljw" frameborder="0" allowfullscreen style="width: 100%; aspect-ratio: 16 / 9; height: auto;"></iframe>

## Could you tell us a bit about yourself and how you got started in game development?

Hi, I’m Jess! I’m a solo indie developer working on Usagi Shima. I actually started out as a Linux developer and worked on operating system internals for 5 years before I decided to make the leap to game development. Back in 2019 I made a Stardew Valley mod for my partner’s birthday and since then, I have craved for more creative and artistic work. Thus began my journey into digital art, animation, and game development - a perfect blend of technical and creative work!

## Can you tell us a bit about your game?

Usagi Shima is a relaxing, idle bunny collecting game. It started out as my passion project that I’d work on evenings and weekends while juggling a full time job as a Software Developer. Its premise is simple - decorate an empty island, and bunnies will come visit you! Pet, feed, and play hide and seek with your bunnies! You can even put hats on them!

Usagi Shima was inspired by my childhood love of rabbits and pet simulator games. It is also heavily inspired by cozy games like Animal Crossing and Neko Atsume. I wanted to make a cute, calming game where the player can just relax and decorate with their virtual bunny friends!

![](/assets/images/showcase/usagi-shima-4.webp)

## What were some of the biggest challenges you faced during the development process, and how did you overcome them?

By far the biggest challenge for me was not even making the game itself, but integrating the game with each platform’s ecosystem. That means integration with Admob, Google Play Game Services, Google Play Billing, iCloud, Game Center, etc. I was juggling this mixture of third party plugins and SDKs, and that honestly makes me a bit nervous about potential difficulties ahead maintaining the game long term.

Keeping up with Google Play’s constantly changing requirements and policies was also challenging. Sometimes I had to keep my eyes on open issues on Godot’s Github page to see when a required Android change would land in the next release so that I could ensure my app would remain compliant with Google Play policies. A similar issue arose when Google Play started to enforce a new minimum version of the Google Play Billing library, but the latest official release from the Godot Google Play Billing plugin was still behind.

Indeed, having been part of the Linux community in my past job, I completely understand the growing pains of any open source community. Maintainers are often overworked and stretched super thin. But at the same time, what’s totally awesome about open source is how other users can step up and help each other and contribute to the project. That was the case with the Google Play Billing plugin where one user kindly created a release candidate that fixed the minimum library version requirement. I’m still using that rc and am hoping the repo gets an official update at some point 😉

If I had a Godot wishlist, it would be a first-class plugin for Google Play Game Services, and maybe even a dedicated maintainer for all things Android/Google Play plugin related. Although the community has done a fantastic job creating plugins, I worry that third-party plugins will stop being maintained and as mobile devs we’ll thus be forced to switch to yet another plugin, that may or may not be actively maintained in the future.


## How did you discover Godot? What made you pick it for your project?

I was already coming from an open source background when I worked on Linux, so it felt very natural for me to pick an open source game engine. The open source aspect is a big draw for me as I’m used to looking through source code and discussions on Github if I get stuck on an issue. In addition I’m pretty sure it was recommended on [/r/gamedev](https://www.reddit.com/r/gamedev/) for being a solid, intuitive engine for newcomers as well. I was also able to hit the ground running with Godot just after just watching [Heartbeast’s beginner RPG series](https://www.youtube.com/watch?v=mAbG8Oi-SvQ). I just love how intuitive the node structure is and Godot’s ease-of-use - it was so easy to prototype things with GDScript!

![](/assets/images/showcase/usagi-shima-5.webp)

## What advice would you give to aspiring game developers who are just starting out in the field?

If you’re working alone and just starting out, I definitely recommend a solid programming foundation! Copying code from tutorials can only go so far. Don’t be afraid of tinkering and just make things! Make ridiculously simple games first and take the lessons learned with you onto bigger projects. And lastly, your estimated time to complete your game is always more than you initially thought. Always.



## What was your experience when working on a mobile-first game?

Making a mobile game was very challenging! Mobile has a variety of different challenges compared to PC games. Both the App Store and Google Play have review processes that can be frustrating and cryptic at times. Additionally, developers need to make sure their app is continually compliant with each platform’s policies in order to stay on their respective stores. Especially with Google Play, it’s important to keep up-to-date with their policies.

Performance was also a big challenge on Android. Your mobile game has to be able to run across a wide spectrum of devices. I had some performance issues with lighting and large sprites in the game, especially on lower-end Android devices. I had to experiment with things like multithreaded loading and splitting up large sprites to reduce overdraw in order to gain some frames back.

Monetization is also completely different on mobile. Mobile players have come to expect games to be free, so developers tend to monetize using other strategies. There’s also a lot of integration with third-party SDKs in order to make your game work with ads, achievements, analytics, and in-app purchases. Additionally, mobile publishers and platforms like Google Play often want your KPI statistics to be considered for a publishing deal or featuring, respectively.
All-in-all, mobile is definitely a different beast compared to releasing a PC game on Steam!


## Finally, what do you hope players will take away from your game, and how do you see it contributing to the broader gaming landscape?

I hope mobile games make a comeback as a reputable platform for gaming, and that one day it could also be a place where indies can shine. I really like mobile as a platform because it opens up new and different genres by virtue of having a device that is constantly in your pocket. It’s a platform that accompanies players throughout their days, unlike a console or PC. Not only that, it’s massively accessible too - while not everybody has a PS5 or Switch, nearly everybody has access to a smartphone these days.

Admittedly, mobile games are not as common a target platform for indie game developers compared to PC and console. Mobile games have earned a negative reputation because of how aggressively they are usually monetized (e.g. microtransactions), and because of how the mobile market is unfortunately plagued with poor quality apps, shovelware, and clones. I hope to one day contribute to the idea that mobile can be a viable platform for indie developers to thrive too!

![](/assets/images/showcase/usagi-shima-scr03.webp)

Usagi Shima is available in the [App Store](https://apps.apple.com/us/app/usagi-shima/id1632728038) and [Google Play Store](https://play.google.com/store/apps/details?id=com.pank0.usagishima). You can also find more about the game on [their website](https://usagishima.net/).

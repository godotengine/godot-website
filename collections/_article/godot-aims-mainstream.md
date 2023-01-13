---
title: "Godot aims for mainstream"
excerpt: "APRIL FOOLS' DAY JOKE! -- The most important feedback we got at GDC is that Godot is different from the most popular game engines, and thus confusing and quite badly known in the industry. So in order to become more popular we decided to make Godot more like the other mainstream engines, by taking some radical decisions."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/56f/e06/275/56fe06275ca75941745597.jpg
date: 2016-04-01 00:00:00
---

**Edit: This was of course a joke for April Fools' Day 2016.** Stay tuned for some real news though, as an asset sharing platform *is* being worked on for Godot 2.1.

[After attending this year's GDC](/article/godot-gdc-2016-aftermath), we realized that Godot, though a good engine that we believe ready for the industry, is still hardly known by professional game developers.

The most important feedback we got is that Godot is different from the most popular game engines, and thus confusing. So in order to become more popular we decided to make Godot more like the other mainstream engines. This should leave everyone happy since, after all, half the planet uses the same game engine.

We started this work a year ago by [making Godot really free](/article/godot-now-really-free). Today, we want to announce our plans to follow up on this work.

#### Download size

Godot is downloaded as a single executable that takes up a little more than a dozen megabytes and, just by executing it, contains the project manager and editor runtimes. No installation is required.
This is obviously wrong and against the trend in modern game engines. As an example, Lumberyard, the new amazing Amazon game engine, uncompresses to 40 GB after download.

It's a basic rule in marketing that public visibility depends on how big you are. So starting from Godot 2.1, users will finally be able to download an installer that takes up 2.7 GB of your hard drive. This increase size should hopefully help increase our visibility and give our users the feeling that they are installing a feature-packed engine. Of course this won't just be bloat, the additional size will be due to many important new features: for example, the internal PI constant will provide the first 2<sup>31</sup> decimals of π (Pi), as we know that mathematical precision is an important concern in the gaming industry.

#### Asset Store

It is clear that our current approach to offering an editor with the most common tools and aiming at improving the built-in tools in each new Godot release is wrong and against the trends too. Users have a hard time finding their way through the tons of features that Godot supports right now, so we need to remedy that to become more mainstream.

From Godot 2.1 onward, we want to do away with this monolithic approach and provide an editor with a limited set of tools. This will make it easier to learn the engine at first as there won't be much to do, and most actual features will have to be downloaded and purchased from the new Godot Asset Store.

![godot-addonlib2.jpg](/storage/app/uploads/public/56f/da7/d8d/56fda7d8d27f2797251759.jpg)

We will stop merging pull requests on the core engine and editing tools. Instead, contributors will be asked to sell their improvements via the Godot Asset Store, thus making it more enticing to contribute features to the engine ecosystem, and thus benefiting the users as a whole.

#### Built-in monetization

Everyone wants to use ads systems from Google, Microsoft, etc. within Godot, but so far we had refused to include such modules in the core tree. Since we know users only care about making mobile apps to make money together with advertising companies, we will provide support for such APIs out of the box.

More than that, Godot will keep being free but you will only be able to use Google services for ads and server services. Games shipped will also send analytics to us the developers so we can better make money by selling your information.

We will soon publish an updated EULA dated **April 1st 2016**, to ensure that every Godot user starting with version 2.1 knows and accepts these new usage conditions.

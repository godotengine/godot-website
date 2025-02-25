---
title: "Godot Showcase - Museum of All Things"
excerpt: "What if Wikipedia was a place you could visit? That’s the idea behind The Museum of All Things, a free and open-source procedurally-generated museum built on Wikipedia’s vast knowledge base."
categories: ["showcase"]
author: Emi
image: /storage/blog/covers/moat_logo_large_colorful_over_screenshot.webp
date: 2025-02-25 15:00:00
---

What if Wikipedia was a place you could visit? That’s the idea behind [The Museum of All Things](https://may.as/moat), a [free and open-source](https://github.com/m4ym4y/museum-of-all-things) procedurally-generated museum built on Wikipedia’s vast knowledge base.

In this interview, we talk to [Maya](https://may.as), the creator of The Museum of All Things, about the challenges of turning an entire encyclopedia into an walkable space, why she chose Godot for development, and how VR transformed the project into something even more immersive.


## Can you tell us a little bit about your project?
The Museum of All Things (or the MoAT) is a free virtual museum that lets you explore any topic you can imagine! It does this by procedurally generating its exhibits using Wikipedia.

Every exhibit you enter in the museum corresponds to an article on Wikipedia. Text and images from the Wikipedia article cover the walls of the exhibit, and you can find hallways leading to other related exhibits based on the links in the exhibit’s Wikipedia article.

![A screenshot of the museum (article: Peach)](/storage/blog/moat/peach.webp)

I’ve been making video games for most of my life, but The Museum of All Things is the biggest game I’ve made so far. It’s also my first real 3D game. I have prototypes of the game going back a few years, but I started really working on this iteration in November 2024.

Ever since I was a kid I’ve loved museums, so being able to make my own museum is so exciting to me. I love that the skills of game development let me create a project like this, even though it’s outside the traditional genres of video games.

## What were some of the biggest challenges you faced during the development process, and how did you overcome them?
The hardest part of this project has been turning something as huge as Wikipedia into a procedurally-generated space that makes sense and is fun to explore.

The Museum of All Things has about the same square footage as Philadelphia based on my rough calculation. It’s different from most procedurally-generated worlds because all the text and images displayed in that whole area are actually unique. But it’s still really hard to make all of that area interesting to the player.

I’ve worked hard on adding interest to the museum, and on making the museum feel more like a physical space. I’m using [Godot’s GridMap feature](https://docs.godotengine.org/en/stable/tutorials/3d/using_gridmaps.html) to randomly generate a unique floorplan for every exhibit. The exhibit generation is seeded, so everyone is visiting the same version of each exhibit. There are several different interior themes used in the exhibits to add visual variety. Ambient sounds and music create an atmosphere. And in addition to the images and text pulled from Wikipedia to fill the exhibits, the museum also pulls images from [Wikimedia Commons](https://commons.wikimedia.org/wiki/Main_Page) to make exhibits larger and 
more interesting to explore.

![A screenshot of the museum (article: Chongqing)](/storage/blog/moat/chongqing.webp)


## The project is under the MIT license and available for everyone [at GitHub](https://github.com/m4ym4y/museum-of-all-things). What made you decide to make the project free and open source?
This project would have been totally impossible without the wealth of knowledge compiled by Wikipedia’s community and the APIs which Wikimedia makes freely available. So I really want my project to pay that goodwill forward as much as I can. And the beauty of this museum being a virtual experience is that there’s no space to rent or building to upkeep, so I can afford to make it free!

## How did you discover Godot? What made you pick it for your project?
I discovered Godot a few years ago when I was looking for an engine to use for a game jam, and I had a good experience with it! Using open-source tools is really important to me, because I don’t want to learn skills that could become obsolete if a company decides to change their pricing model. The cross-platform support was a big selling point to me as well!

I’ve used Godot several more times for game jams (most of my [Ludum Dare entries](https://ldjam.com/users/maymay/games) are in Godot). I’ve gotten more comfortable with the features and workflow now, so Godot was the first tool I reached for when I started prototyping my museum!

## The museum can be visited in VR. How was your experience implementing VR with Godot?
I was really intimidated by VR, but I actually found it to be straightforward! I didn’t go into this project knowing anything about developing in VR, so the [godot-xr-tools](https://github.com/GodotVR/godot-xr-tools) addon was extremely helpful. All the elements like movement and interaction came out of the box and fit into the game world I had written.

I’m really happy that I took the leap and added VR. For a project like this where the objective is just to explore a world, VR makes a big difference in the experience. I went from thinking “hey I made a cool game” to thinking “wow I created a world that I can actually visit.” And that’s kinda the coolest feeling ever for me.

## How can people visit the museum?
You can download the Museum of All Things for free on Windows, Linux, or macOS! If you have a headset compatible with OpenXR (the Oculus Quest is not supported currently) you can download the OpenXR release.

You can visit the project’s official homepage at [https://may.as/moat](https://may.as/moat) or download the [Museum of All Things from Itch.io](https://mayeclair.itch.io/museum-of-all-things).

## Do you have any other projects in mind for the future?
I’m waiting for another idea to come along that captures my attention. I’m working on my art and writing skills, so I think my next game may be something that includes more of a story. I’ll probably be participating in game jams too!

I’m going to be taking a break from working on the Musuem of All Things, but I want to return to it and publish updates in the future too. There are big features that I’d still like to add – for example the ability to visit the museum with others in multiplayer is something many people have requested. I’d also like to add more variety to the museum’s layout, and maybe the ability to pull in more types of content from Wikimedia where available, such as audio and 3D models. It’s one of these projects where every time I touch it there’s more things I want to add.

![A screenshot of the museum (article: Geometry)](/storage/blog/moat/geometry.webp)


### Thank you for sharing your experience using Godot. Is there anything you would like to plug?

You can find me and my socials at [https://may.as/](https://may.as/) if you’d like to stay up to date on all my future projects! I hired Willow Wolf from [https://neomoon.one/](https://neomoon.one/) to create sound and music for my project. Check out her site if you’re looking for game audio services!

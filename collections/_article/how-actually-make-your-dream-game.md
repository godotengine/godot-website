---
title: "How to make your dream game, publish it and not die in the process"
excerpt: "Many devs asked me to write about this for a long time, so sharing my experience for this process."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/598/fb6/1bb/598fb61bb576f136583931.png
date: 2017-08-11 00:00:00
---

### Motivation

Today I'm reinstalling my development computer, so I can't do much programming. Compiling Godot takes increasingly more time, so I guess a new setup is one more way to [accelerate Godot development](https://www.patreon.com/godotengine).

The motivation for this article is that many devs asked me to write it for a long time. Despite being the lead developer of Godot, I have almost 20 years of experience developing and shipping games, and a decade of experience as technical consultant.

Generally, my responsibility ranged from programmer to project owner, but most of the time as technical director or technical consultant.

I also owned several companies and helped others on the business side so I believe I have a clear enough picture of the whole process (which does not meant it's failure proof, it never is).

I didn't become rich (yet :D) making games, but I learned a lot in the process... and nowadays I enjoy developing Godot more than anything else.

I'm sure others have written about the same topic, but this article is written from my own experience, in hopes of it being useful.

Since Godot was released, I saw many developers work on awesome projects with it. The biggest strength of Godot is that, due to its design, it makes it really easy to throw in code that works (and scales to large projects) without worrying about the game architecture. Many games were released, but a large amount were abandoned.

I tried to contact many of the devs to ask them what the reasons were and, in most cases, they were not technical but related to the scope of the project being difficult to manage.

### Making games is very fun, but very difficult

Developing games _is_ difficult. It covers many disciplines but can't borrow much from their processes.

From the artistic and creative side, artists (painters, musicians, writers) will usually conceptualize something and later add depth to it. In game development, your initial implementation of gameplay is always broken, and needs iteration to improve. In many situations, it's just impossible to get it to work and realizing it has to be abandoned in favor of something else is a very difficult decision to make.

From the technical side, the processes taught in university don't generally apply. Software engineering is based on listing requirements and developing use cases from them. From the use cases, all interactions are conceptualized. This does not work in game programming, because you are more concerned about how the player feels than what he or she will do.

### Design patterns, or lack thereof

Even applying standard design patterns isn't warranted to work. One situation I've seen repeated over and over as a consultant is having to deal with engineers that lie to themselves about successfully applying MVC to their game architecture (and making a complete dish of spaghetti and meatballs as a result). Another case is engineers claiming they find success in not using OOP design (while they use it anyway, without realizing it or admitting it). I've seen this so many times I can't count it with my fingers.

This overlaps with another situation I've seen countless times, which is programmers caring too much about "doing things correctly" and "good practices". This often results in code with excess encapsulation, which in turn results in codebases that become a severe pain to modify when your spec changes.

If you are writing a game, just write things as fast as you can and as simple as you can. Do not bother with design. Don't apply design patterns or encapsulation for the sake of it. Make it quick and dirty and just get it to work. If you are planning to make the code cleaner at some point, it has to be because it gets difficult to work with it. If it doesn't, don't touch it.

A common excuse for this is teamwork and many programmers working on a game. Lead programmers require clean and organized code, which results in very slow development. The rationale is "We should be able to replace programmers at any time, so code must be readable and maintainable". In reality, it takes way longer to develop this way and it's hardly cheaper in the long term.

Just make it clear that every programmer in the team has a clear role and area of responsibility. Let them work the way they like, quick and dirty, but just make sure they write clean APIs to communicate with other programmers. What you lose in organization, you win by orders of magnitude in development speed.

When I work on Godot, I make sure the design and architecture are as flawless as possible. When I work on a game, I want to get things done as quick as possible.

At this point, many readers might have noticed that Godot was created to develop games this way. It encourages productivity above all else in the design. The way the scene system works allows to apply a "divide and conquer" approach to developing games (instead of caring about meaningless things like MVC, subdividing in components, etc.). The simplicity of GDScript allows to just write large chunks of code that "just work" and once it does, you don't really touch them again. Achieving that "feeling" that things just fit into place was something we worked a lot with Ariel Manzur over the years, before Godot was open sourced.

This is also why we all spend so much effort developing Godot. Even though a lot of things are still missing, we know we have something special that no one has done before.

### The engine is not enough, it's how you face the development that matters

One of the questions that appear the most in social networks is "I want to do a X type of game, what engine is the best for this?". As much as an engine might help a specific use case, truth is that success depends above all else on how feasible your development process is.

The first big mistake most developers make is starting with pretty art, making a simple prototype, and then expect to develop the rest of the game the same way. Over time, a number of situations are highly likely to arise:

* Assets are OK, but gameplay sucks. Feels like starting over is the best, but this is too demotivating due to the time spent on it.
* Game is OK, but the realization that assets could be done better happens and re-creating them is demotivating.
* Game goes well, but it just feels like so many things could be implemented, yet creating assets for it feels like a hurdle at this point, making it really demotivating.
* For the game to be made, the need to get investment appears due to the unexpected complexity.

These are common scenarios and the reason most projects fail. I'm sure many of them sound pretty familiar.
Let's start over the process and make it right this time, from conceptualizing to publishing!

### Starting over, is the game commercially viable?

Wait, shouldn't a prototype come first? After a good idea, the most natural action is to prototype it...

Well not really. This is where 99.99% of indie developers and studios make their main and most fatal mistake.

And no, it's not the scope that makes the game viable or inviable. A lot of articles you read about making a successful game will tell you to keep your scope small to avoid risks. This is bad and inexperienced advice.
Don't follow it. Without risk there is no gain in this world. The key is understanding how to manage this risk.

Just do the scope you want to do. It will be the development process in itself that will reveal, based on your strengths and limitations, what your boundaries are. Ambition is needed to succeed, don't cut your wings early.

Before prototyping, you must be able to answer the following four questions:

* Who will play the game?
* How will you reach the target players?
* How will development be financed?
* What makes your game different?

Elaborated below:

##### 1) Who will play the game?

This is the first question you must ask yourself. Just try to picture who is going to play the game. Common answers are:

* Everyone, e.g.: this is a nice puzzle, tower defense, casual, etc. game.
* A mainstream audience, e.g.: an RPG, FPS or strategy game.
* A niche audience, e.g.: an adventure game, turn-based strategy, etc.
* Indie gamers, e.g.: People looking for cool, smaller games to play, no matter the type.
* etc.

Just try to understand this very well before going to the next question, which is...

##### 2) How will you reach the target players?

This is where things start getting difficult. Let's develop the cases from above:

**A Casual Game**: Simple, casual games (like Angry Birds, 2048, runners, etc.) are often played by everyone. Yes, your market is huge, billions of players are your potential customers... so, you just make it and publish it... voilà? Not really, the asset stores are so saturated that anything you publish will immediately go unnoticed.

Publicity for a mobile game is out of the question, it's too expensive. You can get a publisher, but most mobile publishers are scammers. If they tell you they will gladly publish your game, don't believe them! They will just launch your game with banners that point to games they own (that actually do make money) via cross promotion. Yes, they will launch your game and use it for their own benefit, not yours.

True mobile publishers will ask you this question: "What are you KPIs?" or more like "What are the conversion and retention rates for your game?". That's a real mobile publisher! That's the one that will invest money in your game.

Unfortunately this is a very difficult question to answer positively. To give you an idea, the most popular way to make money in mobile is via the "free-to-play" (a.k.a. "in-app purchases") model. Anything else does not work. Paid games (free or with paywalled content) don't make money and banners make so little that it's not even enough for you to survive (even if they get millions of downloads). Yes, the only way to economical succeed is to make your game  "free to play", which means that download is free but in-game content is sold to the player to a) make the game easier b) get cool customization options.

This is pretty complex to explain and beyond the scope of this article, but the idea is that, in the free to play model, the "players" (called "users" in the trade) need to be purchased. There are companies that for, say $5, will get _one_ user to play your game. This is not a joke and it generally costs even more. Most users won't spend a dime inside your game, but some (called "whales") will spend a lot more than $5. That moves the average income per user up considerably.

The term "Conversion" means how much on average you make per player per amount spent on it. If you spend $5 per player, but get $8 on average, you have a positive conversion rate of 1.6. Once you have a positive conversion rate, your game literally becomes a money printing machine.

This is where you can easily find publishers to invest on "UA" (short for "User Acquisition", or just purchasing users for you for a % cut). Needless to say, reaching this point is incredibly difficult without enough investment and these types of games spend years in development, at a loss, while tweaked until their conversion rates go positive.

To make it short, your chances of being successful on mobile with casual games are slim to nonexistent (even though now and then miracles happen). Just don't do it unless it's for fun and/or learning.

Marketing experts will always tell you that, contrary to common sense, the broader the market, the more difficult it is to reach.

**A Mainstream Game**: These games sell with a lot of investment in publicity to reach their users (and they also cost a lot of money to make). If you have enough experience developing games, you can attempt to go this route.

**A Niche Game**: Niches are generally easy to reach. There are dedicated sites, forums, Facebook groups, etc. There are also specialized publishers in each genre (i.e., turn based strategy, adventure, etc.), that can tell you numbers about their reach if you ask.

**An Indie or Experimental Game**: Steam, GOG, etc. are still a good place for this, provided your game is interesting enough (more on this topic in question 4). Keep in mind most games either sell well or don't sell, there is no middle ground you can aspire to.


##### 3) How will development be financed?

You need to think about how the game will need to be financed. I will explain below what are common approaches to get funding:

**Publisher**: You can get financing from publishers relatively easily if you follow the right steps (this is because pretty much no one does... but rest assured, this will be explained in sections below).

The most common way is that publishers will give you an advance in sales and also take a cut. You will only see money after the publisher recovers the advance (this is a typical return of investment).

When looking for publishers, try to look for games similar to yours and see who published them. In general, they understand the market better and will better be able to assess the risks on your title.

**Crowdfunding**: Sites like Kickstarter, Indiegogo or Patreon are considerably difficult nowadays to get funding (next question will help you on this). One common strategy is to ask for far less money (and offer a smaller game) and then, if successful, go to a publisher or private investor and show them your success (basically, that people is interested in your game) so you get the rest of the money needed.

**Subsidies**: Check with your local government. Many countries want their game industry to grow, so they offer subsidies for game development.

**Investors**: There are investors specialized on games, but in general they will be more interested in owning part of your company or intellectual property. The most common type is seed capitals (more on this later).

**Advance Sales and Community Development**: This is one of the best ways to finance development IMO, but it needs to be done right. The idea is to develop your game and form a loyal community around it during the development. You need to be really good at this, include them in the development and listen to them. As the community grows, more and more people will pre-purchase the game until the time it's finally complete. Your community will also be in charge of letting others know about the game, so it will grow itself.

Finally, the most important question and the most difficult one to answer:

##### 4) What makes your game different?

If your game is not different enough to what is out there (in some very clear way), it will fail. People will not play it, publishers will not be interested in it, and no community will form around it.

What makes things worse, you must be able to communicate this differentiator very easily and with just one sentence, image or short video. If it fails to impress, it will most likely fail. If it looks too similar to other games, it will also most likely fail. It needs to be different.

The difference can be with either an innovative gameplay concept, or an art style that was not seen before in a game. Unique character designs can also generate interest. For an RPG or adventure game, the story and artwork are key.

### Making a prototype

If you are confident that you can answer the questions above, it's time to make a prototype. The goal of a prototype is to prove that your idea works, and that your aesthetics (art, sound, etc.) are on the right path.

I've met a lot of designers that could easily bet money on their ideas working, only to see them fail when prototyped. Never ever avoid this stage.

Your artwork (or sound) might not be final here. Your code can be incredibly sloppy too. This is not a problem.
What matters is that _the experience_ feels great. Usability wise, the prototype must feel final or near final. It must convey your idea as best as possible.

Iterating in this phase before moving to the next is vital. Don't leave any core functions left to test, and keep doing changes to it until it feels perfect.

Anything core not resolved here will be a pain to fix later on. This means that controls have to feel smooth and action rewarding. It has to click and show your idea.

Ask for feedback as much as possible here!

Money wise, the prototype stage is the best to find seed capital investment. These type of investors will give you enough money to develop a vertical slice (next section), and will ask for a considerable chunk of your gross earnings (usually around 30/40%).

The rationale behind seed capital investment is that they invest tiny amounts on a large amount of unproven, high-risk projects. If one of them is a critical success, they make a huge amount of money.

### Making a vertical slice

If you are making the whole game on your own, on your free time, or have some investment it may not be necessary to do this step. Otherwise, this is the key step to secure investment for the whole game (or until Alpha).

The idea of a vertical slice is to have a small chunk of your game, but this chunk must be _final quality_.

As an example, if your game has 30 levels (missions, scenes, locations, etc), you make 2 or 3 of them. They need to be absolute and final quality. Even references to the rest of the content must be there and visible, even if trying to access it does not work.

They don't need to be the first parts of the game, it can be random sections (though a good intro scene can be really good, even if more difficult to achieve).

Why is the vertical slice so important to get investment? For the following reasons:

##### 1) It reduces risk for the investor

Investment is all about risk. The lowest the risk, the highest the chance to get investment. If a prototype shows that the idea works, a vertical slice shows that you are capable of creating the whole game.

##### 2) It makes the development cost estimation reliable

Up to this point, you should know how much did it cost and how long did it take to make the vertical slice.

This makes extrapolation possible: If creating 10% of the game (the scope of the vertical slice) costs $20k, you can easily estimate that the final cost (100% of the game) will be around $200k.

##### 3) It makes it easier to adjust to different budgets

Many publishers and investors may not have enough money available to make a game for the length and content you want. The vertical slice allows you to extrapolate how much content you would need to cut in order to fit their available budget.

### Developing until Alpha

This is where most developers make another fatal mistake. **Do not** add any more final assets (art, sound, etc.) until you hit the *Alpha* stage. Always use placeholder art. The only exception here, if the type of game requires it (e.g. a fighting game), is animation.

The whole game, as in, all the content *must* be developed with placeholders (i.e. rough sketches, blocks, CSG, etc.).

I know it can be very frustrating, as seeing things come to life is enormously rewarding. Still, however, the temptation must be resisted.

There are many key reasons for doing this:

##### 1) Gameplay is top priority

What defines your game is good gameplay. It must work as best as possible, so it only makes sense to develop all the content first. Make sure all features are implemented and that the game can be played from start to finish. Control must feel great, usability must feel great.

Ironing out all problems here is cheap because the art does not need to be redone.

##### 2) Alpha is great to get funding

Alpha is the point in development when you have the most strength (and ease) to negotiate investment and publishing. This is because:

* You can show that you can make all the final assets and you know how long it takes (thanks to the vertical slice).
* You can show that the game, with the full content, works (you can literally play it and show that it's good/fun/etc.), so there is no risk it will turn out bad.
* You didn't spent that much yet, as this was only done with mostly programmers and one or two artists/animators/game designers.
* Real investment is hiring the rest of the artists (animation, graphics, music, sfx, vfx, etc.). to finalize the game.

As a result, the development risk is much lower here. This makes it easier to get a better deal.


### Fill it with assets, go towards Beta!

Beta is pretty much finishing the whole, entire final game (save for bugs and maybe small very minor tweaks). It means creating all the missing assets to complete it.

This stage is very rewarding and enjoyable, but it's pretty difficult. From a large company to a sole indie developer, filling the game with the final assets is always done near the end of development.

For indies, this is the right time to hire someone to do the art, music, vfx, etc. You know that requirements (and the game itself) won't change so you will spend less money. You will be able to ask for precise budgets and sign specific contracts for the content that needs to be done.

This avoids the very common problem of having to hire an artist on a monthly basis and then running out of money to pay him/her because development took longer than expected.

Typical Alpha->Beta tasks, besides final assets, are translations, cinematics, voice recording, etc.

### Gold

A game goes gold when all bugs and small minor quirks are ironed out and the game feels stable enough. This can take a considerable amount of time, so many studios just launch the game before the actual gold and fix bugs with updates. This sucks, but the industry got used to it.


### Publishing

My experience with publishing is mixed. Publishers generally play bets with their games. They finance many projects, but only really invest (in promotion) in those that do well in sales. The ones that don't will rarely get any money spent and will be left to die. This is the law of life.

It's as you heard. Even if you get a publishing deal, it does not warrant you get money invested in promotion. The only situation that can get you a better deal (publisher will accept spending up to certain amount on promotion) is approaching a publisher with a finished game, or in Alpha at most.

At first, I was angry at this fact, but I understand now that it's the most natural course of action to do for a publisher. They are companies, not charities.

Also, don't get me wrong on this. Publishers still make a big difference. Even if they don't invest *money* in promotion, they usually have very oiled channels with media and many even have cult following (like Atlus or Daedalic) that will purchase their games. They also know their target markets well so, even if your game doesn't sell, it does not mean they did nothing by not promoting it.

In most cases, I found out you can negotiate with the publisher that they return the publishing rights to you if the game makes less than a certain threshold of earnings... so hope exists to pitch it somewhere else. Of course, if you got investment from a publisher, they will require you to pay it back before this happens (which can be negotiated with the new publisher).

That said, my experience on this is that if a game is not selling well, the chances of it doing better with a lot of promotion money thrown on it are still slim.

Regarding engines, you might have heard some people say that publishers request you to use Unity, Unreal or a specific engine. This is a lie, I published dozens of games with Godot for console, mobile and PC and none ever questioned the technology.

The only case where you might hear this is when making work for hire games for third party intellectual properties (such as Disney, Lego, etc.). Some of them ask you for the source code in order to do changes themselves without your support. It's up to you to negotiate this.

### Self publishing

Self publishing is extremely difficult. Doing all the promotion work can take a long time, even if you learn how to do it. I know some smaller publishers can do this in exchange of sales cuts (or a monthly pay). I feel most are scammers though, so just check how well did their other published games do. SteamSpy can be a great tool.

### Closing words

As you see, the whole process of making a game is incredibly complex and success is not warranted, but this article hopefully got you through the most important parts of the process (any feedback welcome from those with more experience).

Nowadays, it is estimated that one in ten games that get investment is a success, and only two or three recover the investment (this may vary depending on the source of course...).

But if you get good at it, it's something you can live of. If you repeat the prototype/vertical slice/alpha/beta/gold/publishing cycle enough times, I think the chances of being really successful in your lifetime are actually very high.

Just don't give up!

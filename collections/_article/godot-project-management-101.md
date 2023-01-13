---
title: "Godot project management 101"
excerpt: "As we just reached our third goal on Patreon, we are now able to hire Rémi Verschelde (Akien) as full-time project manager and representative! In this article, he gives some insights on what brought him to Godot, how he helped organize the teamwork and became the de facto project manager, as well as plans for the future."
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5ab/a37/9bc/5aba379bcde42258374818.jpg
date: 2018-03-27 12:24:07
---

If you are eagerly watching our [Patreon page](https://www.patreon.com/godotengine) for news or following [Juan on Twitter](https://twitter.com/reduzio/status/978288010117529600), you might have seen that we just reached our third Patreon goal at a very generous USD 7,500 per month!

After hiring our lead developer [Juan Linietsky](https://github.com/reduz) full-time in [September 2017](/article/patreon-first-goal-achieved), and our GDNative and GLES 2 developer [karroffel](https://github.com/karroffel) part-time in [December 2017](/article/please-help-us-reach-our-second-patreon-goal), we can now hire myself ([Rémi Verschelde](https://github.com/akien-mga)) full-time too as project manager, release manager, and representative!

Given the good progress of our Patreon campaign, we actually anticipated this goal and I have been working full-time since early March (after quitting my previous job in February). Reaching the goal means that we'll be able to honor our payroll without having to eat into our limited pre-existing assets, which is more sustainable :)

In this post I will try to highlight a bit what those three "positions" mean, to shed some light on the less glamorous but very needed management and public relations of a community-led <abbr title="Free and Open Source Software">FOSS</abbr> project like Godot. For those interested, I'll start by a ~~quick~~ history of how I came to Godot and my involvement so far, which can give you a "real life" illustration of what community-led project management means. You can also skip directly to the <a href="#what-now">"What now?" section</a> if it's TL;DR for you ;)

## From user to contributor and project manager

I first heard of Godot in December 2014, [when version 1.0 was released](/article/godot-engine-reaches-1-0) (note that author information on those old blog posts is incorrect, I was not posting articles at that time :)). I was (and still am) quite fond of Free Software, including libre games, and a free and open source engine that runs natively on Linux was very appealing to me. My first interest was actually to package Godot for my Linux distribution [Mageia](https://www.mageia.org), which was the first one with an official Godot package. Like Godot, it's a community-led not-for-profit free and open source project, so I could eventually reuse my Mageia experience to help improve Godot's development.

I read some of the documentation and tried demos, but only started learning and using the engine for real mid 2015 with [version 1.1](/article/godot-1-1-out). Since I was familiar with open source projects, I quickly found my way to the GitHub repository to report a few bugs and enhancement requests.

I saw that there was a great momentum and that Juan was a very friendly and caring project maintainer, but that there were some things hindering the project's full potential:

1. The issues repository was a mess. Most issues lacked the information that could actually be of use to developers (detailed bug description, steps to reproduce, affected version and platform, etc.), and a big part of the issues were actually fixed already in released versions of Godot, but nobody had taken care to close them. Juan (and [Ariel](https://github.com/punto-) too to a lesser extent) was the only one able to manage the issue tracker, and did not have time nor bug triage experience to do it efficiently.

2. Similar story for pull requests (PRs). Most PRs had inconsistent code quality and style, and a relatively messy git history (e.g. 3 or 4 merge commits in the same PR for a simple change in one file). Here again Juan was the only one "in charge" of reviewing PRs, and that showed. Worse for the momentum of the project: Juan likes to stay focused when developing features, so he would not check PRs often. He would usually check all PRs at the same time once a month, and merge most of them after a quick glance, then do fixes himself for what was problematic in some of the merged PRs. This had two negative effects:

  * No real code review was done, and good features with not-so-good code were merged, slightly increasing the technical debt.
  * Most contributors had to wait for weeks if not months to get feedback on their PRs. Since most of those were first-time contributors, they would eventually stop caring about the project and move to something else.

3. It was almost impossible to contribute to the documentation. We were using the GitHub wiki feature at that time, which meant that only users with write access to the git repo could modify documentation. At that time, that meant only Juan and Ariel, since they were understably not willing to give full permissions on the repo to new contributors.

4. Release cycles for minor versions were long (6 months from 1.0 to 1.1, 8 months from 1.1 to 2.0), and in the meantime some users were stuck on an outdated stable versions while others were putting up with the occasional post-mass-merge instability in the *master* branch.

Back then I did not formalize those issues as clearly, but I saw that stuff needed to be done and that I had experience with it thanks to my involvement in Mageia as a packager, QA tester and bug triager. As a jack of all trades and master of none, I started working on a bit of everything that seemed necessary for the project to continue growing and be successful.

### Bugsquad

So I started with the most pressing issue: developers (be it Juan or any other contributor) can't work efficiently if they don't know what are the bugs users are experiencing in the engine, and how to reproduce them. I started by going through issues, asking reporters for more details or to check if their issue was still valid in Godot 1.1 or the master branch... it was tedious work but helped us close some obsolete issues and prioritize some valid ones. I still wasn't able to press the "Close" button on issues myself though, due to GitHub's restriction that only people with write access to the repo (i.e. able to push commits live without making PRs) could triage issues, though I was still dependent on the issue reporter or Juan closing the fixed issues.

Eventually I harassed Juan so much that he agreed to give me write access to the repo, as well as to a couple other trustworthy contributors, to organize the "Bugsquad" or bug triage team. Its role was (and still is) to assign labels to issues (bug report, enhancement request, what platform does it affect, what part of the engine is it about, etc.) and pull requests, and ensure that fixed or invalid issues were actually closed and that open ones were descriptive enough to be useful. It took us several weeks of work to go through the backlog of 2,000 issues, but we could close about half of them and give more visibility to the still valid ones (leading to a much better user experience in Godot 2.0, since contributors could find and fix usability quirks much faster). I did a big part of that work initially, and little by little I encouraged more experienced Godot users to join the Bugsquad and help spread the workload.

### Merging PRs

In parallel, I started bugging Juan regularly about pull requests. It was hard for me to review them with very little experience with the engine's internals, but some were simple enough even for me to understand: typo fixes, documentation updates, compilation fixes (there was no <abbr title="Continous Integration">CI</abbr> and some platforms broke regularly), or usability improvements in the editor. It made no sense for such changes to wait in the limbo for the next "big merge" a month later, so I sent Juan links to PRs to review and merge in priority on IRC.

Eventually, since I had full write access to the repo because of the Bugsquad's work, Juan told me that I could merge such PRs myself if I was confident enough. I was a bit impressed to have so much responsibility while being a quite average developer (I'm energy engineer initially, not engine programmer :)), and afraid to do mistakes. But I went ahead and merged some stuff, at first very conservatively, and later on a bit boldly. The first reverts when I merged something that I shouldn't have arrived quickly, but I got better at reviewing PRs and got more familiar with the engine itself.

And what we saw happen was well worth the effort: in the months following the initial big Bugsquad triage of the issues backlog and the faster PR reviews, we saw a lot of new contributors come to the engine, and many existing ones staying and gradually becoming our first "core contributors", doing several PRs each month. In one month we doubled the number of monthly PRs, and it kept on increasing. Existing and new contributors were more motivated when seeing that contributions were valued, reviewed and merged (or refused, if need be) quickly.

Eventually I spent so much of my (free) time reviewing and merging PRs that it was not sustainable in the long run, so with Juan we created a "PR mergers" team and invited some core contributors to it, so that they could review and merge PRs themselves (they could already review them without merge permissions, but it's more effective to get contributors to do work for free when they have a responsibility ;)).

### Migrating the documentation to ReadTheDocs

As mentioned, Godot's documentation was initially in a GitHub wiki, and could only be edited by developers with write access (so only Juan and Ariel initially, later on the Bugsquad too). It was a big issue as the docs were far from perfect, and many users wanted to contribute.

Thanks to [Theo Hallenius](https://github.com/TheoXD), we migrated our Wordpress website, phpBB forum and GitHub wiki to a common [OpenProject](https://www.openproject.org) instance. Theo did a lot of work to convert the GitHub wiki (in Markdown) to the Textile markup format used by OpenProject, and it was great: we finally had a wiki that any logged user could edit, and we even had localized versions of the wiki (far from completion, but there were starts of Spanish, Chinese, French wiki, etc.). Sadly we quickly started to have big performance issues with OpenProject, making it often unreachable or very slow. After trying several things to fix those issues, we eventually decided to migrate everything again to a new modular setup (the current one): the website and blog on OctoberCMS, the forum outsourced to the nascent [GodotDevelopers](https://godotdevelopers.org/forum) community, a new Q&A to replace it in the main website and be more focused on a StackOverflow-like platform, and the docs moved to a git repository using [Sphinx](http://sphinx-doc.org/) and [ReadTheDocs](https://readthedocs.org).

Understandably, Theo did not wish to work on yet another migration after we decided to abandon the work he had just did, so others had to take over. I naturally took on the "manager" hat and helped coordinate the work of our contributors (especially [Alket Rexhepi](https://github.com/alketii)) on the website's backend, design, etc.

And on my end I looked into how to migrate the OpenProject wiki to something better. I was no happy with the wiki system as it typically lets anyone make edits, and you have to review edits afterwards and correct issues, if any. It seemed to me that using a GitHub repository for the documentation, with the same PR workflow as for the engine code, would be the most efficient. Sure, learning how to use git and our PR workflow would be a hindrance to some technical writers, but we found that the pros outweighed the cons.

I settled on the Sphinx doc builder, which generates static HTML pages based on source files in the reStructured Text markup language (yet another conversion needed, [Julian Murgia](https://github.com/StraToN) and I became pretty good at regular expressions!), and the ReadTheDocs platforms, which provided hosting, automated builds on new commits, and a great looking theme. This is still the system that we're using today for the [official documentation](http://docs.godotengine.org/) and we are pretty happy about it!

For the first year and a half or so Julian and I did our best with limited time to manage the [docs repository](https://github.com/godotengine/godot-docs). Then a year ago or so, we encouraged professional tutorial makers like Nathan Lovato ([GDquest](https://github.com/NathanLovato)) and Chris Bradfield ([KidsCanCode](https://github.com/KidsCanCode)) to help us, and they eventually completely took over, making our 3.0 documentation the most complete and well-written so far! And with "recent" contributors like [Max Hilbrunner](github.com/mhilbrunner), they are now reproducing the workflow that I outlined above, with a better issue triage and reviews of pull requests, so that the godot-docs repository is becoming a hive full of buzzing documentation bees working everyday to improve your learning experience!

### Making stable and develpoment releases

The last big issue I had noticed was the long release cycles and lack of bugfix/maintenance releases in the stable branches. Coming from the Free Software ecosystem, I knew the value of the *release early, release often* saying, and wanted more frequent releases for Godot.

At the same time, we started running out of credits on the build server that Ariel was using to make the official binaries, so we needed to look into (cheap or free) alternatives.

With the help of various contributors, we setup a full buildsystem (ab)using [Travis CI](https://travis-ci.org) to build Godot binaries for all platforms, and then upload them to a [GitHub repository](https://github.com/GodotBuilder/godot-builds) (since then we replaced the cross-compiled MinGW Windows builds on Travis by native Visual Studio builds on AppVeyor, but it's still the same idea). Though CI services are not designed for this, it allowed us to get binaries for a wide variety of platforms, including macOS and iOS without needing to buy/rent a macOS server ourselves.

Using this new system, I could prepare official builds of Godot more often (still not in a nightly fashion, as the whole setup would still take 5 to 10 hours to build everything, and I didn't want to DoS Travis' infrastructure with Godot builds). We could publish frequent beta builds of Godot 2.0 to get more testing before the final release in [February 2017](/article/godot-engine-reaches-2-0-stable), which turned out pretty good!

Once 2.0 was out, I decided to keep maintaining a stable 2.0 branch with bugfix releases, while development was ongoing for Godot 2.1. So I branched off at the 2.0 release commit, and started cherry-picking bugfixes and usability improvements to this stable 2.0 branch. We [released 2.0.1](/article/updates-on-the-release-cycle-and-godot-2-0-1) a couple of weeks after 2.0, and so on and so forth up to 2.0.4.1. And we did the same for the 2.1 branch.

Now with [Godot 3.0 released in January 2018](/article/godot-3-0-released) and the huge community growth that we experienced over the last year, we decided that stable branches needed more guarantee of forward compatibility (you should be able to run your 3.0.1 project in Godot 3.0.4 for example). [Hein-Pieter van Braam](https://github.com/hpvb) proposed to offload me of this responsibility and to be the official maintainer of the 3.0 branch, which I gladly accepted. For now I'm still handling the buildsystem and helping review what should be backported to the stable branch, but he's taking on more and more of the work so that I can focus on the master branch.

<a id="what-now"></a>
## What now?

The above was meant to be a *quick* (haha) overview of how I came to Godot and what I helped setup for the project to be as successful and fast-growing as possible. It turned out to be a very detailed history (I hope not too boring, but as you can see I like talking of things I'm passionate about :)), but the conclusion of each part is: I set up and maintained a ton of stuff, and now I'm offloading more and more of this ever-increasing workload to new contributors.

So what's next? What am I going to work on especially now that thanks to our generous patrons, I can work on Godot full-time?

### Keep doing it

Well the first part of my "new job" is not really revolutionary: I'll keep doing what I have been doing for 2.5 years. Even though I'm offloading more and more of those tasks to other contributors, the community is growing at a tremendous pace, and at each major or minor release that we have the workload basically doubles.

So I'll continue working on sharing and even giving over more of my responsibilities to other contributors, but as I just wrote it, that's work too. And we still need someone to coordinate the work of the different teams.

Moreover, I'm now working full-time on Godot as my paid job, but I was already basically working 30+ hours a week for free previously next to my normal full-time paid job (and partly overworking myself), so I don't have so much more time right now if I want to keep some more of my newly found free time for different healthy activities :)

### Be Godot's representative for the industry

Thankfully I haven't detailed it in my long history of all the Godot things I've been doing in the past, but I have also taken the role of communications manager (writing blog posts, managing social media accounts and Godot email addresses, etc.) and events organiser (FOSDEM, GodotCon, etc.), and I'll continue doing that.

But now I have actual time that I can allocate to create and nurture Godot's relationships with the gamedev industry and the educational world, as the project's representative. As Juan mentioned in his [GDC 2018 review](/article/godot-doing-well-gdc-2018), with events such as GDC he has to spend a lot of time doing communication and relations work instead of writing code and (more importantly) help contributors write code. At the same time he lives in Argentina and many industry events take place in Europe, where I live.

So the idea is that I should take over part of those tasks, and push them further: I'll give talks and workshops at universities, meet companies to talk to them about Godot (and sponsorship!), participate in industry events, etc.

This also includes all kinds of administrative tasks needed for the project, such as applying for grants or programmes like the Google Summer of Code (GSoC), and then following up on them. For example I've spent most of the past week answering questions from prospective GSoC students and reviewing their draft applications, as well as encouraging fellow contributors to volunteer as mentors for the GSoC programme.

Just like all the other things I've been working on in Godot, I'll also gradually find ways to offload more of this work to the community: that might include helping setup local communities which could organize events of their own in the town/region, collect and improve presentation and teaching material for users and teachers to use in their talks or curricula, etc.

What it will all be *exactly* is still to be determined, but we definitely agree with Juan and other core contributors that Godot needs public figures who can do the link between our hardly-known yet awesome bundle of technology and the real world, with its needs and expectations. This should eventually help us gain more adoption, more contributions, more funding and more awesome features and – that part is yours – games!

## Next goals

With the impressive USD 7,500 milestone reached, we can now pay salaries for Juan and I (USD 3,000 each) and karroffel (who works part-time and as an intern, so she's exploited for USD 1,050 from us + USD 400 from a generous thirdparty interested in her work). That's actually slightly less than we needed for this payroll as we also give 10% of our donations to our fiscal and legal sponsor [Software Freedom Conservancy](https://sfconservancy.org), so strictly speaking we need over USD 7,800 per month. But 7,500 was a rounder symbolic value :)

On top of that, we'd like to have some cash flow to pay for travel expenses, as when Juan goes to Europe for GodotCon or to the US for GDC 2018, plane tickets are pretty expensive. As the project representative, I'll also be travelling a lot in Europe to meet companies, universities and take part in industry events. In first approximation we're setting a goal at USD 9,000 that should reflect the monthly expenses we expect to have in the near future (if you've followed, that USD 8,100 for Godot, so ca. USD 1000 for variable expenses after paying salaries).

Once we've secured that, we'll think about growing the team of paid contributors again, as we have quite a few very talented contributors who would welcome a part-time job to work on the engine.

Another, simpler alternative to get more paid developer time on the engine is for thirdparty companies to hire Godot contributors themselves to work on what they need and contribute it upstream. That's what Pedro J. Estébanez [is doing with AdPotNet](/article/let-people-touch-godot) for example, and we want to encourage more companies to do the same, as it's much more flexible than going through Conservancy and donation-based income (and should also be more lucrative for contributors hired for such contracts! ;)).

I hope this writeup helped shed some light on how the Godot project is managed, including how we handle donations and what we use them for. If you have any question, you can ping me on IRC or Discord (Akien).

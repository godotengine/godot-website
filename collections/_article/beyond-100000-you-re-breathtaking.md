---
title: "Beyond #100000: You're breathtaking!"
excerpt: "As we reach issue #100,000 on GitHub, we celebrate with a little retrospective on our issue and pull request growth."
categories: ["news"]
author: "Rémi Verschelde"
image: /storage/blog/covers/beyond-100000-you-re-breathtaking.webp
image_caption_title: "\"You're breathtaking!\""
image_caption_description: "Sketch of Keanu Reeves at the 2019 #XboxE3 event"
date: 2024-12-04 19:00:00
---

<div markdown=1 class="card card-info" style="margin-top: 1em;">
This blog post was originally posted on [GH-100000](https://github.com/godotengine/godot/issues/100000).
</div>

It's been over 10 years now that Godot has been developed in the open, with code contributions from 2,800 users.

The total count of people who helped build Godot is actually far greater, as it should include documentation writers, testers, bug reporters, translators, moderators, content creators, users doing community support or talking at events, folks making games that credit Godot visibly, everyone supporting the project financially, and many other types of contributions which I can't keep enumerating.

All these people brought Juan and Ariel's little-engine-that-could from this:

![Screenshot of the isometric 2D demo in Godot 1.0](/storage/blog/beyond-100000-you-re-breathtaking/godot-1-0.webp)
<div markdown=1 class="small text-center">
*Screenshot of the isometric 2D demo in Godot 1.0.*
</div>

To this:

![Screenshot of PVKK: Planetenverteidigungskanonenkommandant in Godot 4.3](/storage/blog/beyond-100000-you-re-breathtaking/godot-4-3.webp)
<div markdown=1 class="small text-center">
*Screenshot of [PVKK: Planetenverteidigungskanonenkommandant](https://store.steampowered.com/app/2956040/PVKK_Planetenverteidigungskanonenkommandant/) in Godot 4.3.*
</div>

That's no small achievement, so I encourage all contributors to take a minute to contemplate the progress that we've made together over this journey so far!

Amidst the daily churn of fixing issues, reviewing <abbr title="pull requests">PRs</abbr>, making releases, etc., it's important to remind ourselves of where we are, and how we got there.

<video autoplay loop muted>
  <source src="/storage/blog/beyond-100000-you-re-breathtaking/cozy-space-survivors.webm">
</video>
<div markdown=1 class="small text-center">
*GIF of [Cozy Space Survivors](https://store.steampowered.com/app/2657850/Cozy_Space_Survivors/) where asteroids form the word "GO♥DOT".*
</div>

## Some stats about Godot usage on GitHub

Between our usual traditions of either [making silly jokes](https://github.com/godotengine/godot/issues/10000) or [sharing some inspiring stats](https://github.com/godotengine/godot/issues/30000) for round issue numbers, I picked the latter for this 100,000th issue[^1], and wanted to look a bit closer at our issue and <abbr title="pull request">PR</abbr> numbers over time.

A lot of people coming to Godot's repository to see over 10,000 open issues and 3,000 open <abbr title="pull requests">PRs</abbr> might rightfully wonder whether this is normal, or a sign of a maintenance issue.
I will make the case that it is a bit of both :)

### Issues

![Graph showing issue count over time](/storage/blog/beyond-100000-you-re-breathtaking/issue-history.webp)
<div markdown=1 class="small text-center">
*Visualization from OSS Insight showing issue count over time, [see the interactive version](https://ossinsight.io/analyze/godotengine/godot#issue-history).*
</div>

The two accumulated curves show the total number of issues created over the lifetime of the repository (topmost curve), and the subset of those which have been closed (as fixed or invalid). The difference between the two curves represents the number of issues still open at a given point in time - currently exactly 11,000, out of 53,648 issues total, so roughly 20%.

This is a fairly normal percentage of yet-unresolved issues in software projects of this scale, but it can definitely be better.

I annotated the graph with some key events of Godot's development which match peaks in either reported bugs (usually at the start of a beta phase, or shortly after a stable release), or closed issues (when we do a "spring cleaning" going through old issues to check if they are still reproducible in a newly released Godot version). You can see notably two big peaks of closed issues around the 3.2 release, when we had a coordinated effort from maintainers to go through the whole backlog and ask reporters to confirm whether their issues were still valid, or had been fixed. This reduced the percentage of open issues from 29% to 19%, and it's been mostly stable since, with minor fluctuations.

We are preparing a new "spring cleaning" to properly reassess a lot of the old issues which have been opened before the 4.0 release, or in the early days of 4.0 or 4.1, and may no longer be relevant nowadays with 4.3 and soon 4.4 beta.

As the volume of issues keeps increasing steadily, but the number of active bug triagers doesn't really grow as fast, we are working on improving and documenting our workflows so that we can:

- Onboard new volunteers to help triage new and old issues;
- Spread the workload and be more consistent with our issue triage;
- Be confident that while doing so, we do increase the _quality_ of our open issues, which isn't something that can be easily tracked in numbers.

We will share more details here and on the Godot blog when this process is ready to welcome new volunteers.

In the meantime, you can already do some simple things which help greatly the existing bug triage team:
- [**Regularly re-assess your own issues**](https://github.com/godotengine/godot/issues?q=is%3Aissue%20state%3Aopen%20author%3A%40me) (you can bookmark that URL). Make sure that they are reproducible in the latest stable release and dev snapshots, and that there is a minimal reproduction project that contributors can use to reproduce and fix the issue. If your issue is no longer relevant, please close it with a comment explaining why.
- Feel free to apply the same process to other people's issues that you stumble upon, especially if their last update was a long time ago. In this case you can't close issues yourself, but you can suggest it by commenting that the issue is no longer reproducible in the version you tested. Bug triagers will get a notification and can double check.

### Pull Requests

![Graph showing pull request count over time](/storage/blog/beyond-100000-you-re-breathtaking/pull-request-history.webp)
<div markdown=1 class="small text-center">
*Visualization from OSS Insight showing pull request count over time, [see the interactive version](https://ossinsight.io/analyze/godotengine/godot#pr-history).*
</div>

I didn't annotate this one, but a few takeaways:

- Godot gets almost the same number of new pull requests per month as new issues, roughly 600 of each per month (that's 20 <abbr title="pull requests">PRs</abbr> and 20 issues per day).
- The <abbr title="pull request">PR</abbr> volume increased a lot over the lifetime of the project to culminate at over 700 <abbr title="pull requests">PRs</abbr> per month at the end of the 4.0 development. Since then, as the Godot userbase grew a lot and we are more careful with compatibility and API design, reviews can take a bit longer and the total monthly volume seems to have plateaued around 500-600. That's still plenty enough for a fairly small group of reviewers.
- Someone should plot this data with relative percentages, but it seems like the size/complexity of pull requests is slightly increasing recently. Whether that trend gets confirmed or not, I can attest that reviewing 600 <abbr title="pull requests">PRs</abbr> per month is hard, and that we need more help for interested contributors and users to both test and review the <abbr title="pull requests">PRs</abbr> that get opened on a daily basis.

---

That's all for now, I was already way too long and verbose while drafting this at the last minute to (try to) snatch the 100,000th issue number ;)

Aside from showing some cool numbers, I mostly want to convey that we are well aware that we have a significant backlog, though it's not as dire as it might look from the outside.

To deal with it, we need better triage and review processes (which we are designing now), more volunteers involved in these processes, but also importantly [**more funding**](https://fund.godotengine.org/). Volunteer contributors do a ton of work, but many critical parts of the workflow depend on a few paid contractors, and we need to grow that group to better manage the increasing scale of the project.

[^1]: I'll make a quick note that 100,000 is the combined number of issues and <abbr title="pull requests">PRs</abbr>, which share the same index system on GitHub.<br><br>At the time of writing, we've actually had 53,648 issues and 45,213 <abbr title="pull requests">PRs</abbr> created. Astute minds will notice that the sum is not 100,000; the difference comes from spam issues or <abbr title="pull requests">PRs</abbr> which have been deleted by GitHub.

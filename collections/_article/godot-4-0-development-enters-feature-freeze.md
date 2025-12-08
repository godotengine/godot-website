---
title: "Godot 4.0 development enters feature freeze ahead of the first beta"
excerpt: "We're determined to deliver a stable release of Godot 4.0 as soon as possible. To achieve this, we are going to enter the feature freeze phase (beta) for Godot 4.0, to shift our focus towards stabilizing the existing functionality and fixing bugs."
categories: ["news"]
author: Yuri Sizov
image: /storage/app/uploads/public/62e/270/9fc/62e2709fc2b4a078799068.png
date: 2022-07-28 13:00:00
---

We're determined to deliver a stable release of Godot 4.0 as soon as possible. To achieve this, we need to shift the focus from implementing new and exciting features towards stabilizing the existing functionality and fixing bugs.

### The road to Beta 1

With that in mind, effective **August 3rd** we're entering a feature freeze stage, and no changes to _the roadmap for Godot 4.0_ will be expected. If you have pending work that you absolutely want to see in Godot 4.0, submit it before **August 3rd**. You can either open a pull request or contact the [Production team](/teams#production) directly for your work to be considered.

Please, do not exhaust yourself and avoid crunching. There are always future releases, _especially if your enhancement doesn't break compability_. Once 4.0 is released, we aim to have much shorter development cycles for 4.x releases so the wait for new features shouldn't be long.

In the meantime we have begun reassessing every submitted PR marked for the 4.0 milestone. We want to evaluate if the proposed fix or feature is absolutely necessary for the project going into the next big stable release. Features that demonstrate no urgency will be pushed to future releases. This helps us narrow the scope and make sure we can finish this development cycle.

By **August 17th**, we want to have a good understanding of what features are going into _beta 1_. Which is why it is important that you submit your pending work long before that. If all goes according to our plan, we should have the first Godot 4.0 beta release within the next 5-6 weeks.

To reiterate the plan:

* **August 3rd** — the roadmap for 4.0 enters feature freeze; submit your work before that.
* **August 17th** — the scope of beta 1 is determined; reviews and assessment of PRs continues.
* **Early September** — beta 1 is released.

### Beta phase considerations

Please note that the beta phase does not mean that the engine is stable and ready for production use. We cannot guarantee that Godot 4 betas won't have compatibility breaking changes or critical bugs. If you want to make a commercial project with the engine, please wait for at least the first release candidate. Until then, we will continue fixing bugs and improving existing features, breaking compatibility if absolutely needed so that the friction is low and effectiveness is high.

Some work can still be permitted during the beta phase. Bigger features can still be merged, if they have been approved before the release of beta 1. Smaller enhancements can also be approved, given that they have reasonably high support. Compatibility breakage at this point should be minimal or better yet avoided at all. The beta phase would be very similar to our policies for the current development of the 3.x branch, so you can refer to your experience with that.

---

If you want to contribute to the engine, now is a great time to do so! The faster we can fix the outstanding issues, the sooner everyone can enjoy a brand new iteration of Godot. You can start by reading our [guidelines for contributors](https://contributing.godotengine.org/en/latest/organization/how_to_contribute.html). Then look on GitHub for issues that [may be interesting to you](https://github.com/godotengine/godot/issues?q=is%3Aopen+is%3Aissue+milestone%3A4.0), try to reproduce them, and figure out a fix.

Thank you for your support!

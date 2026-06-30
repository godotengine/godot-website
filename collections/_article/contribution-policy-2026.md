---
title: "Changes to our Contribution Policies"
excerpt: "Godot is growing fast, so here is how we are dealing with the huge increase in contributions."
categories: ["news"]
author: Godot Foundation
image: /storage/blog/covers/contribution-policy-2026.jpg
date: 2026-06-30 18:00:00
---

Over the last several years we have become overwhelmed by the large number of
code contributions (pull requests), especially those from new contributors.
The number of open PRs has become a meme in the community. In part, the number
of open PRs is a healthy sign that:

1.	People are interested in contributing to Godot and are willing to put in time to contribute,
2.	We are being cautious about feature creep,
3.	We are dedicated to high code quality.

But ultimately, a large part of the backlog comes from the fact that the number
of qualified reviewers is small, reviewing PRs is demanding, and we can't keep up
with everything coming in. 

This problem is compounded by the recent increase in AI-generated contributions,
both by AI agents and by humans submitting AI-generated code. The amount of
effort required to make a PR has gone down (and number of PRs has increased as a
result), while the amount of work to review PRs and the amount of people
available to review has stayed the same. This reviewer shortage was already a
problem, but it was one that we successfully ignored. We can no longer ignore it.

AI contributions have the added pain of being demoralizing. Reviewing PRs is
already tedious work, but it is rewarding because reviewers generally feel
that their efforts are contributing to educating a new contributor (who may
become a future maintainer/reviewer). If your feedback on PRs is just being
absorbed by a machine and not going towards mentoring a potential future
maintainer, it becomes much harder to justify spending your free time on PR
review.

It is time for us to recognize that these problems aren't going away and
therefore we need to take steps to reduce the burden on maintainers while
ensuring we still have a pipeline to mentor new contributors to become future
maintainers. 

Accordingly, we are in the process of updating our contribution policies,
including adding a stricter policy on AI contributions. The Foundation board
and maintainers have been discussing a new policy for several months. Our focus will be on:

- **Encouraging new contributors to become future maintainers, that involves teaching and growing the understanding of new contributors.**
    - LLMs can't learn from specific feedback and thus can't benefit from maintainers providing feedback.
- **Ensuring all contributions are made by humans who can take responsibility for their code and be able and willing to fix it when needed.**
    - AI cannot take responsibility, and we can't trust heavy users of AI to understand their code enough to fix it.
- **Adding barriers to low-effort slop.**
    - Unfortunately, this means we need to add barriers to contribution, but want to do it in a way that does not cut off our maintainer pipeline.
- **Increasing the incentive to review PRs.**
    - PR review is the largest bottleneck in the engine right now. We need to ensure that people who choose to review PRs feel their time is well spent.

We will amend our [contributing
policy](https://contributing.godotengine.org/en/latest/pull_requests/pull_request_guidelines.html)
to include a prohibition on new features or significant
re-factoring from new contributors without explicit permission from maintainers.
This ensures that new contributors take the time to learn the codebase and
engage with maintainers to build trust by working on bug fixes and documentation
before diving into significant projects. We consider a new contributor to be
someone with 3 or fewer merged pull requests.

Shortly we will also amend our contributing policy to align with the values described above. Our
amended policy will include that:
- **No autonomous AI agent use or vibe coding**
    - This already leads to an auto-ban from our GitHub repository and will continue to do so.
- **No use of AI to generate substantial pieces of code**
    - We require all code to be human authored. AI assistance should be limited to menial things (like code completion, regex, or find and replace).
    - If you do use AI in some capacity to author code, you must disclose it in the PR discussion.
- **No AI-generated text in human-to-human communication**
    - When our maintainers volunteer their time to review your issue, PR, or proposal, they do not want to talk to a machine. This is a basic principle of respect.
    - Machine translations are still acceptable as long as the original content was written by a human.
- **All PRs must be reviewed and approved by a human before merging**
    - This is the case already, but we will make it more explicit in our policy. 

Things change every day with respect to the current suite of AI tools available.
We will continue taking a conservative approach in our policies towards them,
but we will re-evaluate as things evolve. 

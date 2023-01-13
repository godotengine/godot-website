---
title: "Introducing the Godot Proposals repository"
excerpt: "The past two years, the project kept growing at a steady pace. One of the most important consequences of this growth process is that our GitHub issue tracker has exploded with ideas, proposals and bug reports."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/5d7/025/084/5d70250842430761259264.png
date: 2019-09-04 00:00:00
---

The past two years, the project kept growing at a steady pace. One of the most important consequences of this growth process is that our GitHub issue tracker has exploded with ideas, proposals and bug reports.

### Too many proposals

While we have a very clear guideline on how bugs have to be reported, proposals went usually from simple ideas like "Implement bluetooth multiplayer" to detailed plans for enhancements. Because the entry barrier is so low, our main issue tracker got quickly flooded with too many ideas and proposals. There are so many of them that it's just impossible to seriously discuss them all, so our issue count kept growing way past 5k.



![issuecount.png](/storage/app/uploads/public/5d7/01f/1e2/5d701f1e2addc491682904.png)

### Quality over Quantity

As this situation went beyond our control, we hosted several discussions about ways to improve the proposal workflow. The first task was to identify the problems with the current system:

* We have too many proposals, way more than we could ever discuss.
* Proposals are, most of the time, too many, too vague and difficult to discuss, we need to be more strict in our requirements, similar to how bugs are reported.
* External contributors often create feature/enhancement PRs that we don't know if are wanted, whether they solve actual problems, or if the way they are implemented (usability wise) is right. These are very difficult to review because we, as developers, don't even know this most of the time, so we would prefer they go via community filter. It's easier to review, discuss, approve or reject a proposal than a PR.
* The whole process must not become more bureaucratic for core contributors than it already is. In fact, the goal is to make it less bureaucratic, given that most core contributors are doing this work on their free time.
* We constantly get asked by potential new contributors what kind of work they can do and it's not always easy to answer. By better filtering proposals, the new system can also be used to better organize new and existing contributors.

Based on this, a new proposal submission system was created. Submitting a proposal now has stricter requirements and fields that need to be filled:

* Users must first describe the project they are working on, and based on it, how the proposal will be of benefit for them. This gives more importance to proposals that are helpful for real-life situations, rather than ideas that sound cool but their real benefit is unknown.
* Users must show exactly how the proposed enhancement / new feature will work. Mock-ups, flow diagrams, anything that helps understand how something will be implemented is of vital importance. This puts more burden in the proposal submission, and less in the contributors reviewing it.
* We want to emphasize that even pull requests for new features and enhancements can be closed if a proper proposal does not precede it. This will ease our work reviewing PRs, as we usually don't know if the proposed code addition is wanted by the community.
* Finally, we ensure that core developers (who own an area of the engine and already have significant experience) can discretionally fast-track these processes, to avoid bureaucracy.

In short, this new process aims to shift the burden from those reviewing to those proposing, so we can better utilize the time and resources kindly donated by the community to the project.

### Proposal Repository

Attempting to open a feature request or enhancement issue in the main Godot issue tracker will ask you to, instead, open it in the new proposals one:

https://github.com/godotengine/godot-proposals

Over the next weeks, old proposals in the main issue tracker will be closed, asking those who opened the issue to please re-open them in the new one. Proposal topics with already lengthy discussions that remain open will be moved as-is directly.

The result of this is that the main issue tracker will only be for bug reports, hopefully reducing the amount of them significantly and making it more manageable.


### Future

No system is perfect and, over time, we may find ways to enhance this new workflow. A common question is whether simple proposals need to go via this new process. The answer is *yes*, because defining "simple" is actually very difficult. Hopefully, over time we will be able to better improve this workflow.

---
title: "Godot SDK Integrations"
excerpt: "A new GitHub organization to centralize the community efforts to provide support for third-party SDKs for Godot."
categories: ["news"]
author: Godot Foundation
image: /storage/blog/covers/godot-sdk-integrations.jpg
date: 2024-09-24 14:30:00
---

### Third party services SDKs and their circumstances

Developing and publishing games often involves relying on third-party services, middleware, or platforms. Numerous vendors offer commercial products like advertising networks, backend services, sound engines, user authentication, and more. These tools simplify the process of monetization, expanding player reach, storing data on servers, and performing other functions beyond what a game engine typically provides.

To facilitate integration, these vendors often supply SDKs tailored for specific game engines, allowing developers to easily install them and interact with their products.

Godot, while rapidly growing in popularity, is still relatively a newcomer. As such, while some vendors are beginning to support the engine, many others have not yet invested on it, given the necessary development and maintenance costs.

For some, this is due to the significant resources required (finding the right developers to hire to make the SDKs), while for others, it's simply a matter of being unaware of Godot's growing market or dealing with internal bureaucracy that slows down the process of supporting the engine.

As the Godot Foundation is committed to using donations solely for creating <abbr title="Free and Open Source Software">FOSS</abbr> and prioritizing open standards, it does not allocate resources from the general pool of donations to integrate proprietary SDKs into the engine.

While officially incorporating monetization SDKs into Godot might not align with the project's goals, for example, there is still a widely recognized need within the community for such support to help developers make a living. As there is a need for many other SDKs.

### Community to the rescue

To tackle this challenge, many in the Godot community have taken matters into their own hands, developing proper integrations for third-party services. Talented developers have done an incredible job to bring the most popular services into Godot, enabling the community to publish games on their desired platforms using the necessary third-party tools.

However, this approach still presents several issues for the community:

* Not everyone is committed to creating and maintaining a full SDK integration. Often, developers only implement the features they need for their specific game.
* Developers may not have the time or inclination to support other users’ issues as long as their integration works for their project. Likewise, they may not continue developing the integration after their project has been published.
* As a result this means that, over time, multiple forks of the same integration can be found on GitHub, maintained by different individuals who needed it at different times, leading to fragmentation.

Adding to this, some vendors who provide SDKs for other game engines have expressed interested in supporting Godot but are not ready to allocate internal resources to develop an integration due to costs or other constraints. They might be willing to donate their integration (or donate the money to do an integration) to the Godot Foundation and collaborate with the community.

While this is amazing, the Foundation doesn't want to become responsible for maintaining such integrations using general funds once the specific donation runs out.

### The Godot Engine Community SDK Integrations GitHub organization

After extensive discussions with the community and various vendors, the Godot Foundation has decided to maintain its stance on not directly developing SDKs. However, recognizing the need for a more organized approach, the Foundation has established an official centralized GitHub organization for hosting SDK integrations, thereby encouraging community contributions.

This organization eases the burden on developers who create their own SDK bindings, as they will now be able to accept contributions without bearing the sole responsibility for maintaining the integration. It also provides a clear and official platform for companies that wish to donate their SDK integrations, offering a centralized location for these contributions.

The new [**Godot SDK Integrations**](https://github.com/godot-sdk-integrations) organization has its own GitHub page already. Developers who have been working on SDK integrations are invited to move their work here, if they desire so. You can join the new [`sdk-integrations` channel](https://chat.godotengine.org/channel/sdk-integrations) to discuss this transfer.

Likewise, vendors interested in donating integrations for their first-party SDKs are also welcome to move them to this new organization, if they deem it preferable to hosting SDKs themselves. Please contact the [Godot Foundation](https://godot.foundation/) in order to make arrangements. Likewise, if you would like to finance the development of Godot integrations for your SDKs, the Godot Foundation can help facilitate contacts with trusted community maintainers or companies who can take on such work.

Please note that this organization is a public space for centralizing SDK integration efforts and collecting repositories. The Foundation will not manage or update the integrations, so ongoing development will depend on the community and vendor contributions. This initiative is intended to be a collective effort.

### Contributing to the Godot SDK Integrations organization

As we mentioned, the Godot Foundation is hosting this new space, but doesn't intend to spend its resources on maintaining it.

We are therefore calling for motivated community members to get in touch and help organize the structure of this new organization, and help support developers and vendors who want to provide new SDK integrations for Godot.

Aside from the actual work of developing and maintaining SDK integrations, we foresee the need for contributors with a production profile who can help write common contribution guidelines, instructions on how to "recruit" new maintainers, or generally ensure some quality and fitness for purpose of the various SDKs offered by and to the community.

For the time being, we are going to discuss and organize the work of this community organization on the [`#sdk-integrations` channel](https://chat.godotengine.org/channel/sdk-integrations) of the [Godot Contributors Chat](https://chat.godotengine.org/). See you there!

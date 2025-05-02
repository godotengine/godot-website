---
title: "Godot Showcase - Somar"
excerpt: "We interviewed Frederic Plourde from Collabora and Daniel Castellanos from Decasis about the Somar project."
categories: ["showcase"]
author: Bastiaan Olij
image: /storage/blog/covers/godot-showcase-the-somar-project.webp
date: 2025-05-02 15:00:00
---

<style>
.fred {
	color: #aa77e2;
}
.daniel {
	color: #40b99f;
}
</style>

Today we present a showcase that is a little different. We interviewed Frederic Plourde and Daniel Castellanos who used Godot to create an educational XR experience for [SOMAR](https://somarbio.pt/), a non-profit association focusing on the conservation of marine life in the Algarve.

Frederic Plourde is the XR Lead at Collabora where he drives AR/VR strategy, business development, and open-source innovation, leading a team of talented engineers working on XR customer projects and Monado, the cross-platform open-source OpenXR runtime. He is also Vice Outreach Officer at the Khronos Group where he promotes the OpenXR standard, fosters industry collaboration, and advocates for open and interoperable XR solutions. In the SOMAR project, Frederic took on a technical leadership role, overviewing the development of an immersive XR experience and leading Collabora’s efforts toward developing a Cardboard driver for Monado.

Daniel Castellanos is the owner of Decacis Studio, and was contracted by Collabora to work mainly as a programmer/developer on the SOMAR project.

<iframe width="512" height="512" style="width: 100%; height: 100%; aspect-ratio: 16/9;" src="https://www.youtube.com/embed/JqeOwLQ4wGs" title="The Somar Project" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

### Can you tell us a little more about the non-profit organisation behind the SOMAR project, who they are and what their mission is?

<strong class="fred">Fred:</strong> SOMAR is a non-profit organization that focuses on protecting dolphins, whales, and marine life in the Algarve. Their mission is to raise awareness about the impact of human activities—like underwater noise pollution—on marine ecosystems. By combining scientific research, education, and innovative technology, SOMAR promotes sustainable practices and works to preserve the region’s ocean biodiversity for future generations.

### Can you tell us a bit about the XR experience you have created, and what you set out to achieve?

<strong class="fred">Fred:</strong> The XR experience developed for the SOMAR project was designed to provide an immersive, educational tool to raise awareness about the impact of underwater noise pollution on marine life. By immersing users in realistic coastal and offshore environments of the Algarve, the experience showcases the effects of noise from tourist boats, particularly whale and dolphin-watching activities. Users can witness firsthand how these essential marine mammals are disrupted in their communication and hunting activities, gaining a deeper understanding of the challenges they face. Through this interactive experience, we aimed to engage users emotionally and inform them about the urgent need for conservation efforts to protect these creatures and their habitats.

<img alt="SOMAR selection menu" src="/storage/blog/godot-xr/somar-showcase/somar-selection-menu.webp"/>

### I understand the project is focused on being deployed in museums and in classrooms in Portugal. Can you tell us more about how this works?

<strong class="fred">Fred:</strong> The SOMAR project was designed with flexibility in mind and offers content in both English and Portuguese through Godot’s built-in localization functionality. Built on OpenXR, the project benefits from a standardized framework that simplifies deployment across multiple devices, allowing us to target both museums and classrooms across Portugal. In museums and institutional venues, the Meta Quest version of the XR experience offers a high-fidelity, immersive experience with detailed visuals, allowing visitors to explore the application in a captivating, educational environment. Meanwhile, the PhoneXR version, optimized for accessibility, is intended for use in classrooms, where students can experience the same core content through low-cost [Google Cardboard](https://arvr.google.com/cardboard/)-type phone holders. By running the open-source cross-platform OpenXR runtime [Monado](https://monado.dev/) on those phones, this version is designed to be more accessible and straightforward, making it possible for kids to dive into XR for the first time, all while learning about conservation in an interactive way. This dual deployment strategy ensures that the SOMAR project can reach diverse audiences, from the general public to younger generations, fostering environmental awareness across different settings.

### Will the experience be available to play by the general public and if so, where can they find it?

<strong class="fred">Fred:</strong> Yes — the SOMAR experience is now available for everyone to explore! 🐬 Dive into our open-source XR project and discover the impact of underwater noise pollution on marine life. You can download and try it out for free on [SOMAR’s official itch.io page](https://somar-project.itch.io/somar-project).

<img alt="SOMAR whale" src="/storage/blog/godot-xr/somar-showcase/somar-whale.webp"/>

### What were your main considerations in choosing Godot as the XR platform to create this experience?

<strong class="fred">Fred:</strong> One of the main considerations for selecting Godot as the game engine for this project was finding an open-source engine that could provide flexibility, scalability, and a strong support community. Godot stood out for its robust 3D capabilities, ease of use, and ability to run on multiple platforms. Godot's open-source nature felt like a perfect match for the Monado-driven experience and our collaboration with a non-profit as part of Collabora’s 1% for the Planet initiative, reinforcing our commitment to both innovation and social impact.  Additionally, Godot’s growing reputation within the XR and gaming communities, coupled with its ongoing OpenXR development via a [Khronos-funded project](https://www.khronos.org/rfp/godot-integration), gave us confidence in its future-proof capabilities, ensuring that the SOMAR project could evolve and expand over time.

### What was the most enjoyable part of using Godot?

<strong class="daniel">Daniel:</strong> I’ve been using Godot for a few years now, and the most enjoyable part of it for me is being able to iterate quickly. Throughout its development, the project experienced numerous revisions, but implementing these changes was generally straightforward and quick.

### What was the most difficult issue to overcome?

<strong class="daniel">Daniel:</strong> Having a balance between creating the most realistic or immersive experience possible while having to keep the experience performant on mobile devices apart from the Quest.

### Did you use any existing toolkits/plugins in developing this experience and what was the motivation behind choosing these or building your own solution?

<strong class="daniel">Daniel:</strong> Not really! The project doesn’t feature movement, and user input is limited, so building a custom solution was not a problem. Furthermore, keeping the project as simple as possible was one of my goals, both to prevent bugs and keep the code clean and easy to understand.

<img alt="SOMAR boats and dolphins" src="/storage/blog/godot-xr/somar-showcase/somar-boats-dolphins.webp"/>

### What would you like to see evolve within Godot's XR support that would have made building this project easier?

<strong class="daniel">Daniel:</strong> There was a single bug or unexpected behavior that I found during development, but nothing that couldn’t be worked around. For this project, I believe Godot was the right choice and made things as easy as they could be.

### I understand the project currently targets the Meta Quest headsets. What motivated this choice?

<strong class="fred">Fred:</strong> The Meta Quest headset was chosen for the SOMAR project due to its strong popularity, excellent performance, and ease of use. As a standalone device, the Quest 3 delivers high-quality visuals and immersive experiences without needing a PC or external sensors, making it ideal for both museum venues and broader accessibility. Its widespread presence in the XR market ensures compatibility with future updates, allowing us to reach a wide audience while providing a seamless and engaging experience.

### How was the experience of using Godot with the Meta Quest?

<strong class="daniel">Daniel:</strong> Awesome! I used Meta Quest Link for most of the development to quickly test things, but every once in a while I deployed the project directly into the Meta Quest to measure performance. Fun fact: the project uses the Khronos OpenXR runtime, and it worked flawlessly first time.

### I also understand the project is also capable of using the Monado OpenXR runtime. Can you tell me a bit more about the motivation and goals of this port?

<strong class="fred">Fred:</strong> The motivation behind also targeting the Monado OpenXR runtime was to ensure broader accessibility and compatibility across different platforms, particularly for low-cost, phone-based VR systems. Monado’s open-source nature aligns with our goal of creating a flexible, cost-effective solution that’s not reliant on proprietary ecosystems. For this project, Collabora dedicated engineering resources to develop a new Monado Cardboard driver, which enables the experience to run on Android phones with Cardboard VR headsets, making the immersive content accessible to a wider audience, including kids and students. This port reinforces our commitment to open standards, allowing for future enhancements and maintaining the project’s long-term sustainability.
You can find the code for that driver on the [freedesktop.org GitLab](https://gitlab.freedesktop.org/bl4ckb0ne/monado/-/tree/cardboard-sdk). It will be upstreamed soon.

### Fred, specifically for you, can you give us a synopsis of what Monado is and your perspective on the combination of using Godot with Monado?

<strong class="fred">Fred:</strong> [Monado](https://monado.dev/) is an open-source, cross-platform OpenXR runtime designed to provide the fundamental building blocks for XR device vendors and developers. By offering compatibility with major platforms like Linux, Windows, and Android, Monado serves as a versatile foundation for creating and deploying XR applications. Combining Monado with Godot, an open-source game engine, creates a powerful synergy. Godot’s flexibility, combined with Monado’s OpenXR support, enables both the simplicity of Godot’s development environment and the vast compatibility of Monado’s runtime.

<img alt="SOMAR info panels" src="/storage/blog/godot-xr/somar-showcase/somar-info-panels.webp"/>


### Are there any plans to bring this project to other VR headsets?

<strong class="fred">Fred:</strong> Yep, we’re currently testing the SOMAR application on other platforms and devices. Since Monado is built on OpenXR, it’s designed to be highly adaptable and should be able to run on many other platforms and devices with minimal effort. However, as an open-source project, the real strength lies in the community. While we continue to extend support for more headsets, we encourage developers and enthusiasts to contribute to the project and help expand its reach even further. The open-source nature of Monado makes it easy for anyone to pitch in and bring support to new platforms, creating a collaborative and growing ecosystem.

### What’s next for you, anything interesting on the horizon?

<strong class="daniel">Daniel:</strong> Sure. I’m currently working on my next game: [Stellar Checkpoint](https://stellar.decacis.com/), which will be available in both VR and desktop/flat modes. It should come out later this year, so stay tuned!

### Finally, is there any advice you’d like to share especially to someone considering using Godot for their next XR project?

<strong class="fred">Fred:</strong> Absolutely! One of the most exciting things about using Godot for XR projects is the incredible community that surrounds it. Godot has such a passionate and supportive group of developers, artists, and creators, and it’s all accessible through platforms like [the Godot Discord](https://discord.com/invite/godotengine). If you’re just getting started with XR in Godot, I highly recommend joining the Discord first.

<strong class="daniel">Daniel:</strong> Just try it. Read the official documentation, place a couple of cubes as hands and experience how easy it is to get started! And if you get stuck, there is always someone from the community willing to help. Godot scales really well, and it works for both simple and complex projects, and best of all, being open-source means you can extend it to fit your needs.

### Some extra information about the organisations involved

[Collabora](https://www.collabora.com/) is a global consultancy specializing in delivering the benefits of open-source software to the commercial world. Whether it's the Linux kernel, graphics, multimedia, machine learning or XR, Collabora’s expertise spans across all key areas of open-source software development. By harnessing the potential of community-driven open-source projects, and re-using existing components, Collabora helps its clients reduce time to market and focus on creating product differentiation. To learn more, please visit [collabora.com](https://www.collabora.com/).

[Decasis studio](https://decacis.com/) is an independent development studio run by Daniel Castellanos.

[SOMAR](https://somarbio.pt/) is a non-profit association founded in 2020, dedicated to the conservation of the Algarve’s dolphins, whales, and broader marine life. With a focus on protecting the oceans, SOMAR operates through a variety of initiatives aimed at safeguarding the region’s rich biodiversity. The organization is driven by its commitment to raise awareness about the negative impacts of human activities, such as underwater noise pollution, on marine fauna. By combining scientific research, environmental education, and innovative technologies, SOMAR seeks to promote sustainable practices and inspire collective action to preserve the natural marine ecosystems of the Algarve for future generations.

<img alt="SOMAR orca" src="/storage/blog/godot-xr/somar-showcase/somar-orca.webp"/>

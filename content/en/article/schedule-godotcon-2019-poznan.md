---
title: "Schedule for GodotCon 2019 in Poznań"
excerpt: "The GodotCon 2019 in Poznań, Poland is nearing, so here is the preliminary schedule of talks and demos, as well as presentations of the speakers. Content will be updated with the actual time schedule for the two days of GodotCon, and possibly additional talks."
categories: ["events"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5d9/f48/9c4/5d9f489c43a54009438616.png
date: 2019-10-10 15:05:03
---

**Update 2019-10-16:** Here is the current schedule with time table: **[Link to PDF](/storage/app/media/events/godotcon-2019/Program%20GodotCon%20Poznan.pdf)**.

Livesteam of the event is **[online on YouTube](https://www.youtube.com/c/GodotEngineOfficial/live)**.

-----

As announced [a few months back]({{% ref "article/meet-community-godotcon-poznan-2019" %}}), we are organizing a Godot Conference (**GodotCon**) in **Poznań, Poland** next week, on 16 & 17 Oct 2019. We expect close to 90 attendees, so this should be a great event!

Thanks again to the organizers of the [Game Industry Conference](https://gic.gd) for hosting us as a pre-GIC event, as well as hosting the **Godot Sprint** on 14 & 15 Oct at the same venue, where engine contributors will meet to work together, discuss the roadmap for 4.0 and future releases and many other technical topics :)

Below you will find the preliminary schedule for GodotCon Poznań, as well as a short description of the talks and the speakers. The order of the talks is still likely to change, and a few more talks may be added as we often get last minute proposals (especially from core contributors who tend to prefer making Pull Requests over preparing talks ;)).

**Note for GodotCon attendees:** Always refer to the **[Events page](https://godotengine.org/events)** when in doubt about specifics regarding the event (time, location). We'll update this page in priority whenever there is new details (especially more precise indications about how to find the conference room).

For people who cannot attend GodotCon, do not despair―we plan to have a livestream on [Godot's YouTube channel](https://www.youtube.com/c/GodotEngineOfficial/live), which will also be available in replay.


## GodotCon schedule

**Update 2019-10-16:** Here is the current schedule with time table: **[Link to PDF](/storage/app/media/events/godotcon-2019/Program%20GodotCon%20Poznan.pdf)**.

Livesteam of the event is **[online on YouTube](https://www.youtube.com/c/GodotEngineOfficial/live)**.

Note: This is currently an unordered list of talks we will have. This post will be updated with a plan for *when* each talk should be in coming days.

- **Demo:** *Diving into the Vulkan: Presentation and demo of the Godot 4.0 rendering backend* | Juan Linietsky ([reduz](https://github.com/reduz))
  * Juan will show us the current state of the (work-in-progress) Vulkan branch, and explain how it was designed and the main differences with the Godot 3.x backend. He will show new features such as the reworked Global Illumination probes, anisotropy, and how a project like the [TPS demo](https://github.com/godotengine/tps-demo) fares on Vulkan.

- **Talk:** *Creating open games together with Godot* | Nathan Lovato ([NathanLovato](https://github.com/NathanLovato))
  * At [GDQuest](https://www.gdquest.com), we've learned to make free software creating small demos, tools, and tutorials for the community. This year was essential for us as we focused on complex projects and learned to work as a team. The next step is to build free and open-source games that both go beyond entertainment and benefit the community. Everyone is welcome to join us on this journey to become better game developers and create meaningful projects together.

- **Talk:** *GPU procedural map generation in Godot* | Paweł Mogila
  * Godot has support for simplex noise and you can generate procedural 2D or even 3D noise with with various parameters. If we use and mix one or more of such noises in proper way you can get nice looking maps. All that happens on the CPU. In my talk I would like to show another approach which uses the GPU for making 2D maps. It's much faster and we can instantly see the effects as we modify the shader. That gives us much faster iterations and more possibilities.

- **Talk:** *GDScript coding guidelines at GDQuest* | Răzvan Cosmin Rădulescu ([razcore-art](https://github.com/razcore-art))
  * Through the nature of Imperative Programming coupled with Object Oriented Programming countless solutions for solving a problem emerge. This flexibility comes with a cost: beginners struggle with knowing where to start while advanced users seek out coding patterns for simplifying their projects, picking the helpful path not necessarily being an easy task. The GDQuest Coding Guidelines have emerged as a "standardized coding layout system" to improve code readability and project workflow by providing a way to think about code structure and object coupling in Godot.

- **Talk:** *Practical music composition for video games* | Pedro J. Estébanez ([RandomShaper](https://github.com/RandomShaper))
  * This talk will teach the foundations of music composition and will show a workflow by which anyone can create his own instrumental tracks combining that knowledge with the aid of certain software. That's the exact same workflow the speaker used to create the music for his upcoming game.

- **Demo:** *My first PR - how to start contributing to Godot* | Tomasz Chabora ([KoBeWi](https://github.com/KoBeWi))
  * Ever wanted to become a Godot contributor, but don't know where to start? This little guide will show how to identify the cause for a simple issue and make a Pull Request (PR) fixing it, following Godot's contribution workflow.

- **Talk:** *WebRTC: Low-latency, encrypted, peer-to-peer multiplayer for Godot Engine* | Fabio Alessandrelli ([Faless](https://github.com/Faless))
  * Overview of the new WebRTC support in the upcoming Godot 3.2: why and how to use it, how it is implemented, etc.

- **Talk:** *Using Godot for economic simulation and agent-based modelling* | Jeremiah Lasquety-Reyes
  * Economic models are difficult to understand for ordinary people. I talk about how Godot can be used for more intuitive and understandable economic models especially through combining a certain school of economics (Austrian economics) and a certain kind of simulation (agent-based modelling). I consider how Godot's unique scene-node system, flexible graphics, scripting language, and open source code make it a promising alternative to standard agent-based modelling software.

- **Talk:** *Implementing game programming patterns in Godot* | Giovanny Beltrán
  * A software design pattern is a repeatable solution that can be useful in many different scenarios. In this talk, I want to share with you how after developing several games in our studio using Godot, we have started improving our software design practices by implementing design patterns that make coding easier for us while making our games easier to maintain.

- **Demo:** *Enhance your Godot game with PBD based soft bodies* | Leszek Nowak ([JohnMeadow1](https://github.com/JohnMeadow1))
  * Leszek will show how to implement various soft bodies using Position Based Dynamics in Godot. Followed by discussion about advantages of using Position Based Dynamics instead of Mass Spring Systems.

- **Talk:** *Trip the Ark Fantastic* | Aleksandar Gavrilović
  * A short presentation of an upcoming Godot based video game called Trip the Ark Fantastic. It is a fable-based RPG cofunded by the MEDIA fund of the European Union which will be released in 2021/2022.

- **Demo:** *Character rigging using Skeleton2D* | Matejs Balodis
  * A quick demo on how to set up, rig and animate a 2D character in Godot Engine using 2D meshes and the Skeleton2D node. In the process you'll learn some tips and tricks that Matejs has picked up from his experience while creating characters for a stream overlay game.

- More demos of current and upcoming games by several attendees.

- Possibly a talk on the FBX support in the upcoming Godot 3.2.


### The speakers

Here's some info about our GodotCon speakers. Note that we're still accepting late proposals, so you could be one of those too :)


<div class="speaker">
<div class="speaker-img">
    <img alt="Fabio Alessandrelli" src="/storage/app/uploads/public/5bb/a11/ba2/5bba11ba28760619192748.png" />
</div>
<div class="speaker-text">
    Fabio Alessandrelli (Italy) is a core Godot developer and maintainer of the networking stack of the engine, among other contributions. As an indie dev, he also published <a href="http://orbis.cc/">Aequitas Orbis</a> in early access, a multiplayer 2D space game using Godot 2.1.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Matejs Balodis (Latvia) is a game developer, streamer and member of <a href="https://rocknightstudios.com/">Rocknight Studios</a>, where the development is done using <abbr title="Free and Open Source Software">FOSS</abbr> tools. He actively promotes Godot Engine and other FOSS tools during livestreams on <a href="https://www.twitch.tv/rocknightstudios">Twitch</a> by showing viewers the creative process. As part of Rocknight, Matejs hosts a 3-hour game jam every weekend since January 2019 called <a href="https://itch.io/jam/trijam-40">Trijam</a>, where over 325 games in 40 jams have been created thus far.
</div>
<div class="speaker-img">
    <img alt="Matejs Balodis" src="/storage/app/uploads/public/5da/05c/055/5da05c0555cf6056169968.jpeg" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Giovanny Beltrán" src="/storage/app/uploads/public/5d9/f45/22a/5d9f4522a71f4836788094.png" />
</div>
<div class="speaker-text">
    Giovanny Beltrán (Colombia) is a software engineer with experience working with JavaScript and Python. After working for startups in California, he is now the lead programmer and producer of <a href="https://black-mamba-studio.itch.io/">Black Mamba</a>, an independent game studio located in Bogotá, Colombia, which uses Godot for their projects. He is also co-organizer of BogotaJs, a huge JavaScript meetup in Bogota, co-host of JuegosIndies, a YouTube channel about game design, and just founded a Godot Bogotá meetup.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Tomasz Chabora (Poland) is a passionate game developer and gamer. He is a member of Gamedev Students Association at Jagiellonian University, where he actively promotes Godot engine. He also happens to be an active contributor to the engine, fixing and implementing random stuff.
</div>
<div class="speaker-img">
    <img alt="Tomasz Chabora" src="/storage/app/uploads/public/5d9/f45/3c1/5d9f453c10e23274466142.png" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Pedro J. Estébanez" src="/storage/app/uploads/public/5d9/f45/4f3/5d9f454f3aa48279579515.png" />
</div>
<div class="speaker-text">
    Pedro J. Estébanez (Spain) has been involved in different kinds of software development across the years, his main interest and focus regarding computers being multimedia, computer graphics and video game development. He has been contributing to Godot for some years and providing consultancy about it. Currently he's working on his video game <a href="https://twitter.com/RandomPedroJ/status/1180689212296830977">Hellrule</a>.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Aleksandar Gavrilović (Croatia) is the CEO of <a href="https://game-chuck.com/">Gamechuck</a>, a Croatian video game company. Aleksandar previously worked on award winning and critically acclaimed point-and-click adventures, and is now a producer for <a href="https://www.facebook.com/tripthearkfantastic/">Trip the Ark Fantastic</a>.
</div>
<div class="speaker-img">
    <img alt="Aleksandar Gavrilović" src="/storage/app/uploads/public/5d9/f45/a27/5d9f45a27a029831909357.jpg" />
</div>
</div>



<div class="speaker">
<div class="speaker-img">
    <img alt="Jeremiah A. Lasquety-Reyes" src="/storage/app/uploads/public/5d9/f45/ba3/5d9f45ba37171965636298.jpg" />
</div>
<div class="speaker-text">
    Jeremiah A. Lasquety-Reyes (Germany) is a researcher at the Institute for Advanced Study on Media Cultures of Computer Simulation (<a href="https://www.leuphana.de/en/dfg-programme/mecs.html">MECS</a>) at the Leuphana Universität Lüneburg, Germany. Much of his work deals with ethics and medieval philosophy. He plans to use Godot for his upcoming project, the <a href="http://austrianeconomicsmodel.com/">Austrian Economics Model</a>.
</div>
</div>



<div class="speaker">
<div class="speaker-text">
    Juan Linietsky (Argentina) is Godot's co-creator and lead developer, and oversees most of the features added to the engine to keep it efficient and well-designed. He splits his work time between writing code himself, and helping other contributors make good changes.
</div>
<div class="speaker-img">
    <img alt="Juan Linietsky" src="/storage/app/uploads/public/5bb/a3e/e7c/5bba3ee7c6344594625565.jpg" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Nathan Lovato" src="/storage/app/uploads/public/5d9/f45/d18/5d9f45d18f96a953974804.png" />
</div>
<div class="speaker-text">
    Nathan Lovato (France) is a game creation tutor and free software advocate. With <a href="https://www.gdquest.com/">GDQuest</a>, he makes tutorials for programs like Godot and Krita, and releases all his code as source.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Paweł Mogiła (Poland) teaches game programming and motion capture at Jagiellonian University in Krakow. He also creates his own stuff and recently released his last game <a href="https://store.steampowered.com/app/927840/Clinically_Dead"><em>Clinically Dead</em></a> on Steam. His next game will be in Godot.
</div>
<div class="speaker-img">
    <img alt="Paweł Mogiła" src="/storage/app/uploads/public/5c5/0ce/14d/5c50ce14d5cf5616852281.jpg" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Leszek Nowak" src="/storage/app/uploads/public/5bb/a17/027/5bba170273575707075447.jpg" />
</div>
<div class="speaker-text">
    Leszek Nowak (Poland) teaches Game Development at the Jagiellonian University in Krakow, where they are now using Godot as default teaching software for Simulation and Geometry courses. He also made over 20 games with Godot during game jams.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Răzvan Cosmin Rădulescu (Romania) is a programming freelancer working at <a href="https://www.gdquest.com/">GDQuest</a> on creating tools & plugins for <abbr title="Free and Open Source Software">FOSS</abbr>. He's also the lead developer on GDQuest's latest 2D platformer game demo. Holds a masters in physics, but slowly drifted away from academia being drawn more by the idea of game development. He also has a keen interest in digital painting & drawing and generally tech-related craft. His latest big dream is to create a highly dynamic community in his (small) home town in Romania, centered around the FOSS philosophy stretching across domains, not just tech.
</div>
<div class="speaker-img">
    <img alt="Răzvan Cosmin Rădulescu" src="/storage/app/uploads/public/5d9/f79/d31/5d9f79d31bba2164908517.png" />
</div>
</div>


<style>
div.speaker {
    display: table;
    padding: 5px;
    width: 100%;
    margin: 5px 0; /* you can change/remove margin */
}
div.speaker-text {
    vertical-align: middle;
    display: table-cell;
    text-align: justify;
    padding-left: 10px;
    padding-right: 10px;
}
div.speaker .speaker-img{
    vertical-align: middle;
    display: table-cell;
    width: 100px; /* you can change width */
}
div.speaker-img img{
    width: 100%;
    height: 100px; /* you can change height */
    vertical-align: middle;
}
</style>

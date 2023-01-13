---
title: "Schedule for GodotCon 2019 in Brussels"
excerpt: "GodotCon, the yearly Godot Engine event in Brussels, Belgium, is right around the corner! Here's the current schedule of talks and workshops for the event, with a short presentation of the speakers.
You can still register to join us on February 4 & 5, 2019, as well as propose a talk or workshop."
categories: ["events"]
author: Rémi Verschelde
image: /storage/app/uploads/public/5c5/0d7/091/5c50d7091778e055267584.png
date: 2019-01-29 22:40:35
---

January is coming to an end, and we're about to have great Godot events in the coming days in **Brussels**, Belgium, with the **Godot Sprint** (for contributors), [**FOSDEM**](http://fosdem.org) (for thousands of free software users and developers) and our biggest **GodotCon** so far (for everyone!).

If you missed our [previous](/article/meet-community-fosdem-and-godotcon-2019) [announcements](/article/call-participation-godotcon-2019), see the [**Events**](/events) page for details. You can still register and join us at either event :)

## GodotCon schedule

The schedule is not 100% final yet, but here's an overview of the talks/workshops that we planned so far, and some information on the speakers. The order shown below is not necessarily the one that talks will be given in, details may change until the event.

In particular, some additional talks or workshops may typically be planned by Godot contributors at the last minute during the Godot Sprint :)

- **Talk/demo:** *Making the next blockbuster game with FOSS tools: Director's Cut* | Juan Linietsky ([reduz](https://github.com/reduz))
  * Juan will give a talk [at FOSDEM](https://fosdem.org/2019/schedule/event/blockbuster_game/) showing how to create high quality 3D games like the recent [TPS demo](https://github.com/godotengine/tps-demo) with FOSS tools like Godot, Blender, GIMP and Krita. Given the time constraint at FOSDEM, he won't be able to go into too much detail, so we'll ask him to share more insights during GodotCon.
- **Talk:** *The good, the bad, and the ugly: 3D features of Godot* | Paweł Fertyk
  * More and more 2D games are being made with Godot. But what 3D tools are available for the most popular open-source game engine? In this talk Paweł will tell you about his experiences while developing a 3D game ([Intrepid](https://store.steampowered.com/app/992860/Intrepid/)), the features he's used, and the problems he's encountered.
- **Demo:** *Visual Debugger for the Godot community* | Jānis Mancēvičs
  * Jānis will showcasing a cool set of tools that allow you to debug your game visually similarly to Unity's Scene view. The debugger can be used in a build and there should not be limitations of a device running the game. Visual Debugger is a tool allowing developers to debug their Godot projects while the application is running in the editor or in a build.
- **Talk:** *GPU colliding particles in Godot* | Paweł Mogiła
  * There are GPU accelerated particles in Godot, but they don't support collisions. Paweł will present a simple and effective way of implementing collision response with a dynamically destructible 2D object.
  He will then explain the problem of transferring the data back to CPU side if we would like to get back the information about the collision (e.g. to have the particles as collectibles).
- **Workshop:** *Creating reuseable components with Godot* | Bojidar Marinov ([bojidar-bg](https://github.com/bojidar-bg))
  * How to use nodes and scripts to create components which can be easily reused in a game.
- **Talk:** *Playing with Neuroscience: How can we use games to study the mind and brain?* | Tiago Quendera
  * In the field of neuroscience, the study of how the mind and brain make decisions relies heavily on observing, classifying and dissecting behaviour. Due to the difficult nature of this issue, neuroscience has historically studied very simple decision problems. Most decisions are not, however, simple. Throughout the last century, scientists have developed amazingly controlled environments and, in parallel, and often unknowingly, so have game developers. Despite doing so, these two fields do not create these environments with the same goals, principles, or even tools. By bridging the two we hope to create environments that are both complex enough to mimic "real decisions" and retain the elegance and analytical prowess of the simple scientific tasks. So how can we make games that, while analytically tractable and scientifically relevant, remain engaging and fun for the player?
- **Workshop:** *Solving targeting solution for your game* | Leszek Nowak ([John Meadow](https://github.com/JohnMeadow1))
  * Depending on interests from the audience, John will run a workshop about [2D target leading](https://github.com/JohnMeadow1/GodotGeometryElements/blob/master/assets/examples_animations/targeting.gif), seeking AI or [solving for 3D ballistic trajectory](https://blog.forrestthewoods.com/solving-ballistic-trajectories-b0165523348c).
- **Demo:** *Make your own cross-platform builds easily with the upcoming godot_build tool* | Hein-Pieter van Braam-Stewart ([hpvb](https://github.com/hpvb))
  * Godot comes bundled with many great features, but sometimes you need to roll your own build to add specific features (Steam integration, mobile monetization SDKs, etc.). Setting up cross-platform build environments can be a daunting and error-prone task, so Hein-Pieter is developing a standalone tool to build Godot using containerized build environments, which he uses for official 3.1 builds and will make available for everyone.
- **Talk:** *Re-making Triple Triad with Godot* | Davide Cristini
  * Davide has this question: "How difficult is it to re-create the Triple Triad card game from Final Fantasy 8 with the Godot Engine?" He will talk about the challenges of creating this simple card-game and how he solved them.
- **Demo:** *Daki-chan's Great Expectations* | Piet Bronders & Laurent Van Acker
  * Daki-chan's Great Expectations is a short point-and-click game made with a custom engine in Godot 3.1. This talk will showcase the finished game and a small presentation (max. 5 slides) will be held on a select few of the problems and inventive solutions encountered during development.
  Afterwards, you are free to play the entire game and analyze the source code at your own leisure.
- More demos of current and upcoming games by several attendees.

### The speakers

Here's some info about our GodotCon speakers. Note that we're still accepting late proposals of activities, so you could be one of those too :)


<div class="speaker">
<div class="speaker-img">
    <img alt="Hein-Pieter van Braam-Stewart" src="/storage/app/uploads/public/5c5/0d7/96a/5c50d796a4c37792972855.jpg" />
</div>
<div class="speaker-text">
    Hein-Pieter van Braam-Stewart is one of the more experienced developers of the community, often asked to investigate the most esoteric bugs involving compiler quirks or crafting platform-specific incantations.
    Aside from maintaining Godot's stable branches and doing all the official builds for 3.1, he runs his own Godot consulting company <a href="https://www.prehensile-tales.com/">Prehensile Tales</a>.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Davide Cristini is a proud <abbr title="Free and Open Source Software">FOSS</abbr> supporter. He was so fascinated by Metal Gear Solid that he wanted to study how technologies and arts can unite into a unique interactive experience.
    Nowadays he is making Godot-related <a href="https://www.youtube.com/channel/UCFVgUrvckqp0i_pbCj3wjfA">video tutorials</a> for the Italian community.
</div>
<div class="speaker-img">
    <img alt="Davide Cristini" src="/storage/app/uploads/public/5c5/0d8/0b9/5c50d80b92317907730383.jpg" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Paweł Fertyk" src="/storage/app/uploads/public/5c5/0d2/d35/5c50d2d352a64731237478.png" />
</div>
<div class="speaker-text">
    Paweł Fertyk is a long-time coder who recently founded <a href="https://miskatonicstudio.com">Miskatonic Studio</a> to get into game development, and published the Godot-made <a href="https://store.steampowered.com/app/992860/Intrepid"><em>Intrepid</em></a> on Steam in December.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Juan Linietsky is Godot's co-creator and lead developer, and oversees most of the features added to the engine to keep it efficient and well-designed. He splits his work time between writing code himself, and helping other contributors make good changes.
</div>
<div class="speaker-img">
    <img alt="Juan Linietsky" src="/storage/app/uploads/public/5bb/a3e/e7c/5bba3ee7c6344594625565.jpg" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Jānis Mancēvičs" src="/storage/app/uploads/public/5c5/0d8/676/5c50d86765174378189820.jpg" />
</div>
<div class="speaker-text">
    Jānis Mancēvičs is a co-founder and lead game developer at <a href="https://www.rocknightstudios.com">Rocknight Studios</a>, working on <a href="https://gamejolt.com/games/rough-rush/277086"><em>Rough Rush</em></a>. He has a tremendous passion for video games and <abbr title="Free and Open Source Software">FOSS</abbr> which is shared with the world through livestreams of his work process on Twitch.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Bojidar Marinov is a young software developer and open source contributor to the Godot engine. His main interests are in the design of programming languages, elegant algorithms, and generally in doing more with less. He regularly visits various Godot community channels, helping newcomers to learn the engine's specifics.
</div>
<div class="speaker-img">
    <img alt="Bojidar Marinov" src="/storage/app/uploads/public/5c5/0d2/2d5/5c50d22d504a3472572317.jpg" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Paweł Mogiła" src="/storage/app/uploads/public/5c5/0ce/14d/5c50ce14d5cf5616852281.jpg" />
</div>
<div class="speaker-text">
    Paweł Mogiła teaches game programming and motion capture at Jagiellonian University in Krakow. He also creates his own stuff and recently released his last game <a href="https://store.steampowered.com/app/927840/Clinically_Dead"><em>Clinically Dead</em></a> on Steam. His next game will be in Godot.
</div>
</div>


<div class="speaker">
<div class="speaker-text">
    Leszek Nowak teaches Game Development at the Jagiellonian University in Krakow, where they are now using Godot as default teaching software for Simulation and Geometry courses. He also made over 10 games with Godot during game jams.
</div>
<div class="speaker-img">
    <img alt="Leszek Nowak" src="/storage/app/uploads/public/5bb/a17/027/5bba170273575707075447.jpg" />
</div>
</div>


<div class="speaker">
<div class="speaker-img">
    <img alt="Tiago Quendera" src="/storage/app/uploads/public/5c5/0d0/191/5c50d0191767d908679037.jpg" />
</div>
<div class="speaker-text">
    Tiago Quendera is a passionate lifelong student of human behaviour. His first lines of code were WoW macros and the corresponding guild website.
    Today, while still not an avid coder, he uses Godot to make videogames to help us further understand the human mind and brain as a neuroscientist.
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

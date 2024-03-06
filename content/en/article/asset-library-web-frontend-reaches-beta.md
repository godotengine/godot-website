---
title: "The Asset Library web frontend reaches beta"
excerpt: "After several months of development, the web frontend to Godot's Asset Library finally reached the beta status!"
categories: ["news"]
author: Rémi Verschelde
image: /storage/app/uploads/public/581/7c8/856/5817c8856eccf877486140.png
date: 2016-10-31 22:44:33
---

After several months of waiting ([obligatory joke](https://en.wikipedia.org/wiki/Waiting_for_Godot)) and more importantly of development, the web frontend to Godot's [*Asset Library*](/asset-library/) finally reached the [beta status](https://github.com/godotengine/asset-library/milestone/2?closed=1)!

What does it mean? That the Asset Lib frontend is now [officially public](/asset-library/) and that the community can start using it extensively. It is still [in development](https://github.com/godotengine/asset-library), but we have a pretty solid base that should allow you to create your account, submit and update your assets - as well of course as seeing the existing assets in the library.

Many thanks to [Bojidar Marinov](https://github.com/bojidar-bg) for the huge work he did on the Asset Lib so far! [Others](https://github.com/godotengine/asset-library/graphs/contributors) have started to contribute too, don't hesitate to join in if you like (or at least know) PHP :)

If you missed the inline links, here they are in clear:

* [Asset Library](/asset-library) - browse anonymously or register and login to submit new assets
* [Source repository](https://github.com/godotengine/asset-library) - to partake in the development
* [Issue tracker](https://github.com/godotengine/asset-library/issues) - to report any issues you may encounter (also usability wise, it's still a work in progress)

## How does it work?

The Asset Library is composed of three parts:

* The engine frontend in Godot itself (since 2.1 stable), that you can access via the project manager (to install templates and demos) or via the *AssetLib* tab in your opened project (for all other types of assets).
* The web backend, which is queried by the engine frontend to retrieve the list of assets and related metadata.
* The web frontend, which allows you to see the contents of the library in your browser ([see this asset](/asset-library/asset/4) for example), and most importantly to submit new assets and edit existing ones registered to your account.

## What assets can be submitted?

The exact policy for the Asset Lib still needs to be formally written down, but here are the general rules that apply so far:

* All assets should be licensed under a *free and [open source](https://opensource.org/osd) license* (e.g. MIT, BSD, GPL, CC0, etc.). When picking a license for your assets, you should of course ensure that you have the appropriate rights (i.e. you can't relicense assets from someone else to submit them to the Asset Lib).
* All assets should be hosted in a [Git](https://git-scm.com/) repository, and accessible through a web frontend. The supported frontends so far are GitHub, GitLab (both gitlab.com and self hosted), Bitbucket, gogs and cgit (those two are also typically self hosted).
* Each asset should be hosted in its own Git repository, i.e. one asset = one repo.

Why do we request this? We are not a company, and we want to give the priority to open source contributions that will benefit all users without having to care for the legal burden of running a commercial asset store. It does *not* mean that Godot's engine frontend will not support paid assets in the future, but it is not our focus right now for the godotengine.org platform. People who want to run commercial stores are free to extend on our (obviously open source) [web frontend and backend code](https://github.com/godotengine/asset-library) and to host their own platform that can talk to Godot.

We also enforce the usage of Git and code hosting platforms such as GitHub or GitLab for security reasons: it allows moderators to review the code included in each asset before accepting them. The specific commit or git tag provided as the version to download in the Asset Lib can be used to generate an archive with a unique cryptographic hash – moderators have to enter this hash when they accept new assets or edits, and Godot users will only be able to download files with a valid hash from within the engine – this ensures that what users download is what moderators approved.

## How to submit/edit assets

Once logged in, click "Submit Asset" in the navigation bar. You will then see a form asking for various details about your git repository and the asset you want to package:

* Asset name
* Category: 2D Tools, 3D Tools, Shaders, Materials, Tools, Scripts, Misc, Templates, Projects, Demos (subject to change as we gather community feedback)
* Frontend type: GitHub, GitLab, Bitbucket, gogs or cgit
* Repository URL
* Download commit or tag: this identifies the version you want to submit to the Asset Lib. It will not be automatically updated for the security reasons mentioned above, so please edit your asset to update this hash or tag when needed.
* Icon URL
* License
* Description
* Optionally image and video previews

Once you submit your asset, you will have to wait for an Asset Lib maintainer to review it and accept it (it can take several hours, though we're usually quite fast).

## How to setup assets in your git repositories

We will provide more information about this in the docs in the coming weeks, but in the meantime, please check existing assets and their git repositories to see how it was done.

Keep in mind that assets are unzipped directly at the root of your project's folder. Therefore, for plugins, you should use a `addons/yourassetname/` folder in your git repository.

If you are in doubt, don't hesitate to ask for guidance on one of the many [community channels]({{% ref "community" %}})!

## Future developments

As you will probably notice, the frontend is not finished yet. For example, rating assets is not implemented in the beta. You can check the existing [list of issues](https://github.com/godotengine/asset-library/issues) as well as the [milestone to the 1.0 release](https://github.com/godotengine/asset-library/milestone/3) to see what is in the works. If you have issues to report or suggestions to make, please use the issue tracker.

For now, enjoy the existing assets and the web frontend, and give us your feedback!

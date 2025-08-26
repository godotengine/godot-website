# Godot Engine Website

Welcome to the source code for the Godot Engine website. This is a static website, generated offline using
[Jekyll](https://jekyllrb.com/).   


### Table of Contents
  - [Contributing](#contributing)
  - [Browser Support](#browser-support)
  - [Development](#development)
    - [Building](#building)
      - [Pre-requisites](#pre-requisites)
      - [Building the website locally](#building-the-website-locally)
      - [Building the website using Docker](#building-the-website-using-docker)
      - [Local server](#local-server)
    - [Deployment](#deployment)
  - [Project structure](#project-structure)
    - [Content data and metadata](#content-data-and-metadata)
    - [Content pages and templates](#content-pages-and-templates)
    - [File storage](#file-storage)
    - [Build system](#build-system)
  - [Content update guidelines](#content-update-guidelines)
    - [Updating Godot download version](#updating-godot-download-version)
    - [Localizing the website](#localizing-the-website)
    - [Adding a mirrorlist host](#adding-a-mirrorlist-host)
  - [Resources](#resources)
***

## Contributing
Contributions[^1] are always welcome! Godot's website is open source, just like Godot Engine.

However, when contributing to the website, it is important to keep in mind that it acts as a public face of the Godot
organization and community. Thus, substantial changes must be discussed ahead of time. You don't necessarily need to
open a formal Godot improvement proposal like you do with engine features, but starting an issue on this repository
or joining the discussion on the [Godot Contributors Chat](https://chat.godotengine.org/channel/website) is a good
idea.

[^1]: https://contributing.godotengine.org/en/latest/other/website.html
[^2]: https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/CSS_layout/Supporting_Older_Browsers
[^3]: https://developer.mozilla.org/en-US/docs/Mozilla/Add-ons/WebExtensions/Browser_support_for_JavaScript_APIs

## Browser Support

When working on new features[^2][^3], keep in mind this website only supports _evergreen browsers_:

- **Chrome** (latest version and N-1 version)
- **Edge** (latest version and N-1 version)
- **Firefox** (latest version, N-1 version, and latest ESR version)
- **Opera** (latest version and N-1 version)
- **Safari** (latest version and N-1 version)

> [!IMPORTANT]
> Internet Explorer isn't supported.

## Development

### Building

#### Pre-requisites
- On Local Machine:
  - Ruby 3.1.2 with [rbenv](https://github.com/rbenv/rbenv) and [*(For windows)*](https://github.com/RubyMetric/rbenv-for-windows#readme)
  - Jekyll - [Jekyll Website](https://jekyllrb.com/)
  - Minify - [Minify GitHub](https://github.com/tdewolff/minify)
- On Docker:
  - [Docker](https://www.docker.com/) installed on your system.
  - Jekyll Docker image - [Jekyll Docker Image](https://hub.docker.com/r/jekyll/jekyll)
* For Local Server One of the following is required:
  - Jekyll - [Jekyll Website](https://jekyllrb.com/) (with `jekyll serve` command)
  - Python 3.x [Python](https://www.python.org/)
  - Docker - If you run on Docker, also you can use the Jekyll Docker image to serve the site.

> [!CAUTION]
> If you use latest versions of Ruby, you may encounter issues on building process.  
> Use the specific version of Ruby that is mentioned above.

#### Building the website locally

To build the website locally, follow these steps:

1. Install Ruby 3.2 or later and Jekyll.
  - If you don't have access to Ruby 3.2 or later in your distribution's repositories, install a compatible version of Ruby using `rbenv`:
    - Install in Ubuntu:
      - `sudo apt install rbenv`
    - Install in Fedora:
      - Install `rbenv` with dnf
      - Run `echo 'eval "$(rbenv init -)"' >> ~/.bashrc` to add the rbenv init to `.bashrc` (or `.bash_profile`)
  - Set up `rbenv` running the following:
    - `rbenv install 3.4.4`
    - `rbenv global 3.4.4`
2. Install [Minify](https://github.com/tdewolff/minify/tree/master/cmd/minify).
	- Make sure either `minify` or `gominify` is available from the command line.
3. Clone this repository.
4. Install the necessary dependencies: `bundle install`.
5. Build the site: `bundle exec jekyll build`.
   - Append `--config _config.yml,_config.development.yml` to use the development config with your build.

For simplicity, these two commands are also available as a `build.sh` script in this repository.

#### Building the website using Docker
Alternatively, you can also use the official Docker container for Jekyll. This container is designed to be run once
to perform the build, so you don't need to compose and permanently store it in your Docker setup. If you're on Linux,
execute the following command:

```shell
docker run --rm --volume="$PWD:/srv/jekyll" -it jekyll/jekyll:stable ./build.sh
```

On Windows (from `CMD.exe`):

```shell
docker run --rm --volume="%CD%:/srv/jekyll" -it jekyll/jekyll:stable ./build.sh
```

Building may take several minutes to finish.

#### Local server
As this is a static website, it can be served locally using any server stack you want.

- It is possible to use Jekyll and `bundle` to immediately serve the pages upon building it. To do this, replace the final build
step with `bundle exec jekyll serve`.
   - When using Docker, you need to add a new argument to the `docker run` command, `-p 4000:4000`, and change
   the shell script to `build-and-serve.sh`.

      ```shell
      docker run --rm --volume="$PWD:/srv/jekyll" -p 4000:4000 -it jekyll/jekyll:stable ./build-and-serve.sh
      ```
      or
      ```shell
      docker run --rm --volume="%CD%:/srv/jekyll" -p 4000:4000 -it jekyll/jekyll:stable ./build-and-serve.sh
      ```
- You can also use Python, which is likely pre-installed on your system. To serve the pages with its local server, run
`python -m http.server 4000 -d ./_site`.

After following either one of these steps the site will be available at `http://localhost:4000`.

### Deployment

The project is built automatically by GitHub Actions whenever the `master` branch receives a new commit. The `master` branch
itself should not be deployed, as it only contains the source files. The built version of the website is available as the
`published` branch instead.

Note that this is not relevant for local development. Locally you would build the website in place and then serve the `_site`
folder. See the detailed instructions above.

## Project structure

### Content data and metadata

The following folders contain data files, used for generating more dynamic parts of the website, such as the blog,
the showcase, and the downloads page. These pages are written in Markdown and contain a metadata header used by the
generator. Markdown files form Jekyll collections with the same name as their containing folder. To create a new
Markdown document, you can start by copying an existing one and then change its content.

- `collections/_article` contains articles for the blog. Each article is written in Markdown with a metadata header located at
the top of the file. The following metadata fields are required for the article to be correctly displayed throughout
the website: `title`, `excerpt`, `categories`, `author`, `image`, and `date`. The name of the file acts as a slug in
the generated URL.

- `collections/_download` contains the download instructions for Godot builds per platform. Each document is written in Markdown
with a metadata header located at the top of the file. Download links are generated from the `downloads` field in the
metadata. When adding a new platform, make sure to create a new tab for it in the `/_layouts/download.html` template.

- `collections/_showcase` contains entries for the showcase. Each article is written in Markdown with a metadata header located at
the top of the file. Showcase entries can be featured on the home page by setting the `featured_in_home` field to
`true`. The image used is the one from the `image` field.

Some information is also stored in YAML files, acting as a file-based database for several meta properties.

- `_data` contains various metadata files for the website:
  - `authors.yml` contains a list of authors used for the blog articles;
  - `categories.yml` contains a list of categories for the blog articles;
  - `communities.yml` contains a list of user communities for the `/community/user-groups` page.

### Content pages and templates

The following folders contain entry points for almost every website page, as well as shared templates and assets. The
templating language used in Jekyll is [liquid](https://jekyllrb.com/docs/liquid/).

- `_i18n` contains translations for the website. The default language is English. Only static information is
translated, with the blog and the showcase being displayed in English. **Currently disabled and a work in progress.**

- `_includes` contains navigation and footer elements used by most pages. If you want to create an element to reuse
in multiple pages, you can create a new include file here.

- `_layouts` contains the wrapping content for the pages. Each layout inherits from `_layouts/default.html` which
contains the main structure of the page, including the head and meta tags. Other layouts are used for specific pages,
like the blog, download, and showcase pages.

- `assets` contains static assets for the website. This includes the CSS, JS, and images used in the theme and layout.
For media content used in articles and other pages check the `storage` folder. **Some files may be obsolete and
unused.**

- `pages` contains most of the pages for the website. The final URL for each page is specified in the metadata header
using the `permalink` field. Generally, it should map to the file's path inside `pages`. Dynamic content pages are
generated using Markdown collections and layouts.

### File storage

- `storage` contains media and other files uploaded for use in dynamic content pages, such as the blog, the showcase,
the events. **Some files may be obsolete and unused.**

### Build system

This project is build with Jekyll, with the build instructions located in `Gemfile` and `_config.yml`. When building
locally, some configuration options may need to be different. To define those, `_config.development.yml` is used.

## Content update guidelines

### Updating Godot download version

All download information on the website is data-driven. This means that to change the information about the current
stable version, or on-going version previews, you don't need to modify pages directly. Instead, data files must be
updated.

The main file for keeping track of every official version is `data/_versions.yml`. It contains exactly one record
per each official release, including pre-releases. This file should be updated every time there is a new official
build available for download.

To create a new version, add the following block to the file:

```
- name: "4.0.1"
  flavor: "stable"
  release_date: "20 March 2023"
  release_notes: "/article/maintenance-release-godot-4-0-1/"
```

Make sure to order entries correctly, with the higher version number being closer to the top. Use the `flavor` field
to mark release as stable or as one of the pre-release builds. Make sure to always fill out the release date, and the release
notes link, if available.

When a new build for an existing version is published, update its corresponding block, changing the flavor and the release
information. Make sure to update this information when publishing the release notes.

Stable releases featured across the website, must be marked with the `featured` field and the corresponding major version number. Only one record must be marked as featured per version, so don't forget to remove it from the current holder of the mark.

```
- name: "4.0.3"
  flavor: "stable"
  release_date: "19 May 2023"
  release_notes: "/article/maintenance-release-godot-4-0-3/"
  featured: "4"
```

There are two additional files providing data for download pages and links: `_data/download_configs.yml` and
`_data/download_platforms.yml`. These files don't normally require changes and are used as a static reference table.
They define descriptions, tags, and filename slugs for all downloadable builds, as well as order for downloads on
some pages.

### Localizing the website

To localize the website, the `_i18n` folder contains translation files for each language. The default and fallback language is English `/_i18n/en.yml`.

If you want to add a new language, create a new file in the `_i18n` folder with the language code as the filename and add the label for that language at `/assets/js/localize.js`. For example, for French, create `/_i18n/fr.yml` and add `'fr': 'Français'` in the `languageMap` const.

The translations are handled by a jekyll plugin that contains a few tags you can use inside the templates. You can read more at `/_plugins/localize.rb`. But the tl'dr is:
- Use the '{% t useyourkeyhere %}' tag to translate text
- Use the '{% current_lang %}' tag to get the current page language
- Use the '{% tlink /your/path %}' tag to get the localized URL


### Adding a mirrorlist host

If a new host needs to be supported by the mirrorlist, it needs to be added in a few places. For the data side of
things you need to update `_data/mirrorlist_configs.yml` and add another record for the major-minor version code.

```
  - name: "4.1"
    stable: [ "github" ]
    preview: [ "github_builds" ]
```

The `stable` key refers to hosts available for the stable release of that version, while the `preview` key refers
to all pre-releases and dev snapshots, which typically share all their characteristics. If in future there is a
need for finer control, some overrides system needs to be implemented.

For the logic side of things, the new host needs to be supported by the `_plugins/make_download.rb` script. Refer
to how other hosts are handled in that file and do the necessary adjustments. We assume that the final filenames
are standard across all hosts, so `_data/download_configs.yml` is respected.

## Resources

- Join the discussion on Godot Contributors Chat in the [#website](https://chat.godotengine.org/channel/website)
  channel.
- Please consider [website usage stats](https://caniuse.com/) when relying on modern
  web technologies (web standards support, file type support, etc).

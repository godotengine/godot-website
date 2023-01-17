# Godot Engine Website

Welcome to the source code for the Godot Engine website. This is a static website, generated offline using
[Jekyll](https://jekyllrb.com/).

## Contributing

Contributions are always welcome! Godot website, just like Godot engine, is open source.

However, when contributing to the website, it is important to keep in mind that it acts as a public face of Godot
organization and community. Thus, substantial changes must be discussed ahead of time. You don't necessarily need to
open a formal Godot improvement proposal like you do with engine features, but starting an issue on this repository
or joining the discussion on the [Godot Contributors Chat](https://chat.godotengine.org/channel/website) is a good
idea.

## Browser support

When working on new features, keep in mind this website only supports _evergreen browsers_:

- Chrome (latest version and N-1 version)
- Edge (latest version and N-1 version)
- Firefox (latest version, N-1 version, and latest ESR version)
- Opera (latest version and N-1 version)
- Safari (latest version and N-1 version)

**Internet Explorer isn't supported.**

## Development

### Building

To build the website locally, follow these steps:

1. Install [Jekyll prerequisites](https://jekyllrb.com/docs/installation/).
   - Make sure `bundle` is available from the command line.
2. Clone this repository.
3. Install the necessary dependencies: `bundle install`.
4. Build the site: `bundle exec jekyll build`.
   - Append `--config _config.yml,_config.development.yml` to use the development config with your build.

For simplicity, these two commands are also available as a `build.sh` script in this repository.

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

### Local server

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
itself should not be deployed, as it only contains the source files. The build version of the website is available as the
`published` branch instead.

This branch has a detached history and always contains the single commit with the most recent build. As such simple `git pull`
doesn't work with it. To deploy it you must either pull the branch anew, removing and recreating your local branch, or reset
the local branch with `git reset --hard`. Make sure to perform `git fetch` beforehand to receive the latest changelog from
the remote.

Note, that this is not needed for local development. Locally you would build the website in place and then serve the `_site`
folder. See the detailed instructions above.

## Project structure

### Content data and metadata

The following folders contain data files, used for generating more dynamic parts of the website, such as the blog,
the showcase, the downloads page. These pages are written in Markdown and contain a metadata header used by the
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

When a new stable build of the engine is released, you need to update the number and date in the `/_config.yml` file.
This looks like this:

```
# Godot download version
stable_version: "3.5.1"
stable_version_date: "28 September 2022"
```

After this change is merged and the website is built, everything referencing the engine version should be updated
automatically, including download links for every platform.

## Resources

- Join the discussion on Godot Contributors Chat in the [#website](https://chat.godotengine.org/channel/website)
  channel.
- Please, consider the [website usage stats](https://stats.tuxfamily.org/godotengine.org) when relying on modern
  web technologies (web standards support, file type support, etc).

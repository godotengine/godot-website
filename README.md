# Godot Website

This repository contains the theme used by the Godot Engine's OctoberCMS/WinterCMS
instance. The theme describes both the styling of the website and the components
of its layouts, as well as some of its content.

- [OctoberCMS](https://github.com/octobercms/october) is the original CMS platform
  of choice.
- [WinterCMS](https://github.com/wintercms/winter) is the current CMS platform, a fork
  of October with more active development.

_WinterCMS_ is compatible with _OctoberCMS_, and uses the same plugin system. This is
at least true for the version of the project that we use.

This repository also contains a Docker setup to be used by contributors. It
is not used for production.

## Contributing

Contributions are always welcome! Godot website, just like Godot engine, is open source.

However, when contributing to the website, it is important to keep in mind that it
acts as a public face of Godot organization and community. Thus, substantial
changes must be discussed ahead of time. You don't necessarily need to open a formal
Godot improvement proposal like you do with engine features, but starting an issue
on this repository or joining the discussion on the
[Godot Contributors Chat](https://chat.godotengine.org/channel/website) is a good idea.

### Browser support

When working on new features, keep in mind this website only supports
_evergreen browsers_:

- Chrome (latest version and N-1 version)
- Edge (latest version and N-1 version)
- Firefox (latest version, N-1 version, and latest ESR version)
- Opera (latest version and N-1 version)
- Safari (latest version and N-1 version)

**Internet Explorer isn't supported.**

### Dependencies

This project requires the following stack:

- PHP 7.2+ & Composer 2
- MySQL/MariaDB
- OctoberCMS/WinterCMS v1.0.xxx

There are also some linting tools that can be run locally that require Node.js.

### Local development setup

This project comes with a [Docker](https://docker.com) setup that can be used to quickly
create a network of compatible ready-to-use containers.

Using this setup, you can have a local copy of the project, without the production database.
For development purposes, you don't need that database, as the only thing that is specific
to production is blog posts, which can be easily recreated if required. Everything else
is located in the `./themes/godotengine` folder, including all static pages and their content.

To start contributing, please follow this [Local development setup](DEVELOPMENT_SETUP.md) guide.

### Syntax highlighting

If you use Visual Studio Code, you can install the
[OctoberCMS Template Language](https://marketplace.visualstudio.com/items?itemName=dqsully.octobercms-template-language)
extension to benefit from syntax highlighting in `.htm` templates.

## Resources

- Join the discussion on Godot Contributors Chat in the
  [#website](https://chat.godotengine.org/channel/website) channel.
- When working on the theme, please take note of the
  [website stats](https://stats.tuxfamily.org/godotengine.org).

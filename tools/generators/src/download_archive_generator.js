import yaml from 'js-yaml';
import fs from 'fs';
import {generateLink, getDownloadSlugs} from './url_util.js';

const HOSTS = ['github_builds', 'github'];
const TEMPLATES_PLATFORM = 'templates';
const exportPath = 'download/archive';

/**
 * @typedef {Object} Version
 * @property {string} name
 * @property {string} flavor
 * @property {string} release_version
 */


(function main() {
  const hugoConfigFile = loadHugoConfigFile();
  const supportedLanguages = hugoConfigFile.languages;
  const versions = loadVersions();
  const downloadPlatforms = {}
  const supportedLanguagesISO = Object.keys(supportedLanguages);
  for (const iso of supportedLanguagesISO) {
    downloadPlatforms[iso] = loadDownloadPlatforms(iso);
  }

  for (let i = 0; i < versions.length; i++) {
    const version = versions[i];

    const frontmatter = {
      title: `Download Godot ${version.name} (${version.flavor}) - Godot Engine`,
      type: 'download/archive',
      name: version.name,
      flavor: version.flavor,
      featured: version.featured,
      release_date: convertDateFormat(version.release_date) ?? "",
      release_notes: version.release_notes ?? "",
    };

    if (!frontmatter.featured) {
      delete frontmatter.featured
    }

    const links = generateVersionDownloadLinks(version, downloadPlatforms);
    frontmatter.primaryPlatforms = links.primary;

    for (const iso of supportedLanguagesISO) {
      const config = supportedLanguages[iso];
      if (config.disabled) continue;

      frontmatter.links = links.linksPerLanguage[iso];
      writeArchiveVersion(config.contentDir, version.name, version.flavor, frontmatter);
    }

    if (version.releases) {
      for (let j = 0; j < version.releases.length; j++) {
        const release = version.releases[j];

        frontmatter.title = `Download Godot ${version.name} (${release.name}) - Godot Engine`;
        frontmatter.flavor = release.name;
        frontmatter.featured = release.featured;
        frontmatter.release_date = convertDateFormat(release.release_date) ?? "";
        frontmatter.release_notes = release.release_notes ?? "";
        if (!frontmatter.featured) {
          delete frontmatter.featured
        }

        const links = generateVersionDownloadLinks({name: version.name, flavor: release.name}, downloadPlatforms);
        frontmatter.primaryPlatforms = links.primary;

        for (const iso of supportedLanguagesISO) {
          const config = supportedLanguages[iso];
          if (config.disabled) continue;

          frontmatter.links = links.linksPerLanguage[iso];
          writeArchiveVersion(config.contentDir, version.name, release.name, frontmatter);
        }
      }
    }
  }
})();

/**
 * @typedef {Object} DownloadPlatforms
 * @property {string} iso
 * @property {DownloadPlatform[]} downloadPlatforms
 */

/**
 * @param {Version} version
 * @param {DownloadPlatforms} downloadPlatformsByIso
 * @return {Object}
 */
function generateVersionDownloadLinks(version, downloadPlatformsByIso) {
  const downloadPlatformsIsos = Object.keys(downloadPlatformsByIso);
  const downloadPlatformsMap = {};
  const linksPerLanguage = {};

  for (let i = 0; i < downloadPlatformsIsos.length; i++) {
    const iso = downloadPlatformsIsos[i];
    linksPerLanguage[iso] = {}
    const downloadPlatforms = downloadPlatformsByIso[iso];
    downloadPlatformsMap[iso] = {};

    for (let j = 0; j < downloadPlatforms.length; j++) {
      const platform = downloadPlatforms[j];
      downloadPlatformsMap[iso][platform.name] = platform;
    }
  }

  const downloadSlugs = getDownloadSlugs(version);
  const primary = [];

  function generateHosts(version, platform) {
    const hosts = {}

    for (let i = 0; i < HOSTS.length; i++) {
      const host = HOSTS[i];
      hosts[host] = {};
      hosts[host].regular = generateLink(version, platform, false, host);
      hosts[host].mono = generateLink(version, platform, true, host);
    }

    return hosts;
  }

  if (downloadSlugs.editor.primary) {
    const primaryPlatforms = Object.keys(downloadSlugs.editor.primary);
    for (let i = 0; i < primaryPlatforms.length; i++) {
      const platform = primaryPlatforms[i];
      primary.push(platform);
      const hosts = generateHosts(version, platform);

      for (let j = 0; j < downloadPlatformsIsos.length; j++) {
        const iso = downloadPlatformsIsos[j];
        linksPerLanguage[iso][platform] = {
          ...downloadPlatformsMap[iso][platform],
        }
        linksPerLanguage[iso][platform].hosts = hosts;
      }
    }
  }

  if (downloadSlugs.editor.secondary) {
    const secondaryPlatforms = Object.keys(downloadSlugs.editor.secondary);
    for (let i = 0; i < secondaryPlatforms.length; i++) {
      const platform = secondaryPlatforms[i];
      const hosts = generateHosts(version, platform);

      for (let j = 0; j < downloadPlatformsIsos.length; j++) {
        const iso = downloadPlatformsIsos[j];
        linksPerLanguage[iso][platform] = {
          ...downloadPlatformsMap[iso][platform],
        }
        linksPerLanguage[iso][platform].hosts = hosts;
      }
    }
  }

  if (downloadSlugs.extras) {
    const extras = Object.keys(downloadSlugs.extras);
    for (let i = 0; i < extras.length; i++) {
      const extra = extras[i];
      const hosts = generateHosts(version, extra);

      for (let j = 0; j < downloadPlatformsIsos.length; j++) {
        const iso = downloadPlatformsIsos[j];
        linksPerLanguage[iso][extra] = {
          ...downloadPlatformsMap[iso][extra],
        }
        linksPerLanguage[iso][extra].hosts = hosts;
      }
    }
  }

  const templateHosts = generateHosts(version, TEMPLATES_PLATFORM);

  for (let j = 0; j < downloadPlatformsIsos.length; j++) {
    const iso = downloadPlatformsIsos[j];
    linksPerLanguage[iso][TEMPLATES_PLATFORM] = {
      ...downloadPlatformsMap[iso][TEMPLATES_PLATFORM],
    }
    linksPerLanguage[iso][TEMPLATES_PLATFORM].hosts = templateHosts;
  }

  // Templates always appear at the bottom
  primary.push(TEMPLATES_PLATFORM);

  return {
    linksPerLanguage,
    primary,
  };
}

function writeArchiveVersion(contentDir, name, flavor, data) {
  const frontmatter = `---\n# Generated by /tools/generators/src/download_archive_generator !!! do not edit by hand !!!\n${yaml.dump(data, {forceQuotes: true})}---`;
  fs.writeFile(`${contentDir}/${exportPath}/${name}-${flavor}.md`, frontmatter, (err) => {
    if (err) throw err;
  });
}

function convertDateFormat(input) {
  const date = new Date(input);
  return date.toISOString().slice(0, 19) + "-00:00";
}

/**
 * @typedef {Object} DownloadPlatform
 * @property {string} name
 * @property {string} title
 * @property {string} caption
 * @property {string[]} tags
 */

/**
 * @returns {DownloadPlatform[]}
 */
function loadDownloadPlatforms(iso) {
  const fileContents = fs.readFileSync(`data/${iso}/download_platforms.yml`, 'utf8');
  return yaml.load(fileContents);
}

function loadVersions() {
  const fileContents = fs.readFileSync('data/versions.yml', 'utf8');
  return yaml.load(fileContents);
}

function loadHugoConfigFile() {
  const fileContents = fs.readFileSync('hugo.yml', 'utf8');
  return yaml.load(fileContents);
}


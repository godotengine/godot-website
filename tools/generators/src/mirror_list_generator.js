import yaml from 'js-yaml';
import fs from 'fs';
import {COMMON_PLATFORM, generateLink, HOST} from './url_util.js';

const DATA_VERSIONS_PATH = 'data/versions.yml';
const MIRROR_LIST_CONFIGS_PATH = 'data/mirrorlist_configs.yml';
const EXPORT_PATH = 'content/en/mirrorlist';

(function main() {
  const versions = loadVersions();

  for (let i = 0; i < versions.length; i++) {
    const version = versions[i];

    writeMirrorList(version, {mirrors: createMirrorList(version, false)}, false);
    writeMirrorList(version, {mirrors: createMirrorList(version, true)}, true);

    if (version.releases) {
      for (let j = 0; j < version.releases.length; j++) {
        const release = version.releases[j];
        const releaseName = release.release_version ?? version.name;
        const innerVersion = {
          name: releaseName,
          flavor: release.name,
        }

        writeMirrorList(innerVersion, {mirrors: createMirrorList(innerVersion, false)}, false);
        writeMirrorList(innerVersion, {mirrors: createMirrorList(innerVersion, true)}, true);
      }
    }
  }
})();

/**
 * @param {Version} version
 * @param {Object} mirrorList
 * @param {boolean} isMono
 */
function writeMirrorList(version, mirrorList, isMono) {
  let fileName = `${version.name}.${version.flavor}`;

  if (version.name === '3.0') {
    fileName = `${version.name}-${version.flavor}`;
  }

  if (isMono) {
    fileName = `${fileName}.mono`;
  }

  fs.writeFile(`${EXPORT_PATH}/${fileName}.json`, JSON.stringify(mirrorList), (err) => {
    if (err) throw err;
  });
}


/**
 * @param {Object} version
 * @param {string} version.name
 * @param {string} version.flavor
 * @param {boolean} isMono
 */
function createMirrorList(version, isMono) {
  const mirrors = []
  const mirrorListConfigs = loadMirrorListConfigs();
  const mirrorListHosts = mirrorListConfigs.hosts;

  const versionBits = version.name.split('.');
  const versionMajMin = `${versionBits[0]}.${versionBits[1]}`;
  const versionDefaults = mirrorListConfigs.defaults.find((mirror) => mirror.name === versionMajMin);

  if (versionDefaults) {
    const mirrorHosts = version.flavor !== "stable" ? versionDefaults.preview : versionDefaults.stable;

    for (let i = 0; i < mirrorHosts.length; i++) {
      const hostName = mirrorHosts[i];
      const mirrorHost = mirrorListHosts.find((host) => host.name === hostName);
      const mirrorUrl = generateLink(version, COMMON_PLATFORM.templates, isMono, hostName);

      if (mirrorUrl !== '#') {
        const mirror = {
          name: mirrorHost.title,
          url: mirrorUrl,
        }
        mirrors.push(mirror);
      }
    }
  } else {
    const mirrorHost = mirrorListHosts.find((host) => host.name === HOST.tuxfamily);
    const mirrorUrl = generateLink(version, COMMON_PLATFORM.templates, isMono, HOST.tuxfamily);

    if (mirrorUrl !== '#') {
      const mirror = {
        name: mirrorHost.title,
        url: mirrorUrl,
      }
      mirrors.push(mirror);
    }
  }

  return mirrors;
}


/**
 * @typedef {Object} MirrorHost
 * @property {string} name
 * @property {string} title
 */

/**
 * @typedef {Object} Mirror
 * @property {string} name
 * @property {string[]} stable
 * @property {string[]} preview
 */

/**
 * @typedef {Object} MirrorListConfig
 * @property {MirrorHost[]} hosts
 * @property {Mirror[]} defaults
 */

/**
 * @returns {MirrorListConfig}
 */
function loadMirrorListConfigs() {
  const fileContents = fs.readFileSync(MIRROR_LIST_CONFIGS_PATH, 'utf8');
  return yaml.load(fileContents);
}

/**
 * @typedef {Object} VersionRelease
 * @property {string} name
 * @property {string} release_date
 * @property {string} release_notes
 */

/**
 * @typedef {Object} Version
 * @property {string} name
 * @property {string} falvor
 * @property {string} release_date
 * @property {string} release_notes
 * @property {boolean} featured
 * @property {VersionRelease[]} releases
 */

/**
 * @returns {Version[]}
 */
function loadVersions() {
  const versions = fs.readFileSync(DATA_VERSIONS_PATH, 'utf8')
  return yaml.load(versions);
}


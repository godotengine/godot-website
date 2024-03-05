import yaml from 'js-yaml';
import fs from 'fs';
import {generateLink} from './url_util.js';

const exportPath = 'content/en/mirrorlist';

(function main() {
  const fileContents = fs.readFileSync(`data/versions.yml`, 'utf8');
  const versions = yaml.load(fileContents);

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
 * @param {Object} version
 * @param {string} version.name
 * @param {string} version.flavor
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

  fs.writeFile(`${exportPath}/${fileName}.json`, JSON.stringify(mirrorList), (err) => {
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
  const versionBits = version.name.split('.');
  const versionMajMin = `${versionBits[0]}.${versionBits[1]}`;

  const mirrors = []

  const mirrorListConfigs = loadMirrorListConfig();
  const mirrorListHosts = mirrorListConfigs.hosts;

  const versionDefaults = mirrorListConfigs.defaults.find((mirror) => mirror.name === versionMajMin);

  if (versionDefaults) {
    const mirrorHosts = version.flavor !== "stable" ? versionDefaults.preview : versionDefaults.stable;

    for (let i = 0; i < mirrorHosts.length; i++) {
      const hostName = mirrorHosts[i];
      const mirrorHost = mirrorListHosts.find((host) => host.name === hostName);
      const mirrorUrl = generateLink(version, 'templates', isMono, hostName);

      if (mirrorUrl !== '#') {
        const mirror = {
          name: mirrorHost.title,
          url: mirrorUrl,
        }
        mirrors.push(mirror);
      }
    }
  } else {
    const mirrorHost = mirrorListHosts.find((host) => host.name === 'tuxfamily');
    const mirrorUrl = generateLink(version, 'templates', isMono, 'tuxfamily');

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
function loadMirrorListConfig() {
  const fileContents = fs.readFileSync('data/mirrorlist_configs.yml', 'utf8');
  return yaml.load(fileContents);
}

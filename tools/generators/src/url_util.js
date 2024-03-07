import yaml from 'js-yaml';
import fs from 'fs';

const DATA_DOWNLOAD_CONGIG_PATH = 'data/download_configs.yml';

const FLAVOR_MATRIX = {
  'dev': 1,
  'alpha': 2,
  'beta': 3,
  'rc': 4,
  'stable': 10
}

export const COMMON_PLATFORM = {
  templates: 'templates',
  aarLibrary: 'aar_library',
}

export const HOST = {
  github: 'github',
  githubBuilds: 'github_builds',
  tuxfamily: 'tuxfamily',
}

const HOST_BASE_URL = {
  github: 'https://github.com/godotengine/godot/releases/download',
  githubBuilds: 'https://github.com/godotengine/godot-builds/releases/download',
  tuxfamily: 'https://downloads.tuxfamily.org/godotengine',
}

/**
 * @typedef {Object} Version
 * @property {string} name
 * @property {string} flavor
 * @property {string} release_version
 */

/**
 * @param {Version} version
 * @param {string} platform
 * @param {boolean} isMono
 * @param {string} host
 * @return {string}
 */
export function generateLink(version, platform, isMono = false, host = HOST.github) {
  const versionName = getVersionName(version);

  const versionBits = versionName.split('.');
  const slugsDefaults = getDownloadSlugs(version, isMono);

  if (!slugsDefaults) {
    return '#';
  }

  const slug = getDownloadSlug(platform, slugsDefaults);
  if (slug === '#') {
    return '#';
  }

  const file = getDownloadFileName(platform, versionName, version.flavor, versionBits, slug);
  return getUrlFromHost(host, versionName, version.flavor, file, isMono);
}

function getDownloadSlug(platform, slugsDefaults) {
  if (platform === COMMON_PLATFORM.templates && slugsDefaults.templates) {
    return slugsDefaults[platform];
  }

  if (slugsDefaults.editor.primary[platform]) {
    return slugsDefaults.editor.primary[platform];
  }

  if (slugsDefaults.editor.secondary[platform]) {
    return slugsDefaults.editor.secondary[platform];
  }

  if (slugsDefaults.extras && slugsDefaults.extras[platform]) {
    return slugsDefaults.extras[platform];
  }

  // Unknown platform key.
  return '#';
}

/**
 * @param {string} platform
 * @param {string} versionName
 * @param {string} versionFlavor
 * @param {string[]} versionBits
 * @param {string} downloadSlug
 * @return {string}
 */
function getDownloadFileName(platform, versionName, versionFlavor, versionBits, downloadSlug) {
  if (platform === COMMON_PLATFORM.aarLibrary) {
    return `godot-lib.${versionName}.${versionFlavor}.${downloadSlug}`;
  } else {
    if (versionBits[0] === '1' || (versionBits[0] === '2' && versionBits[1] === '0')) {
      return `Godot_v${versionName}_${versionFlavor}_${downloadSlug}`;
    } else {
      return `Godot_v${versionName}-${versionFlavor}_${downloadSlug}`;
    }
  }
}

/**
 * @param {string} host
 * @param {string} versionName
 * @param {string} versionFlavor
 * @param {string} downloadFileName
 * @param {boolean} isMono
 * @return {string}
 */
function getUrlFromHost(host, versionName, versionFlavor, downloadFileName, isMono) {
  switch (host) {
    case HOST.github:
      return `${HOST_BASE_URL.github}/${versionName}-${versionFlavor}/${downloadFileName}`;
    case HOST.githubBuilds:
      return `${HOST_BASE_URL.githubBuilds}/${versionName}-${versionFlavor}/${downloadFileName}`;
    case HOST.github.tuxfamily:
      const monoSlug = isMono ? '/mono' : '';
      if (versionFlavor === 'stable') {
        return `${HOST_BASE_URL.tuxfamily}/${versionName}${monoSlug}/${downloadFileName}`;
      } else {
        return `${HOST_BASE_URL.tuxfamily}/${versionName}/${versionFlavor}${monoSlug}/${downloadFileName}`;
      }
  }
}

/**
 * @param {Version} version
 * @return {string}
 */
export function getVersionName(version) {
  return version['release_version'] ?? version['name'];
}

/**
 * @param {Version} version
 * @param {boolean} isMono
 * @return {Object|null}
 */
export function getDownloadSlugs(version, isMono = false) {
  const versionName = getVersionName(version);
  const versionMajor = versionName.split('.')[0];

  const downloadConfigs = loadDownloadConfig();
  let slugsData = downloadConfigs.defaults[versionMajor];

  if (!slugsData) {
    return null;
  }

  if (downloadConfigs.overrides) {
    const versionBitsHash = getVersionBitsHash(parseVersionName(versionName));
    const flavorBitsHash = getFlavorBitsHash(parseVersionFlavor(version.flavor));

    for (let i = 0; i < downloadConfigs.overrides.length; i++) {
      const override = downloadConfigs.overrides[i];
      if (override.version !== versionMajor) {
        continue;
      }

      if (isInVersionRange(versionBitsHash, flavorBitsHash, override.range)) {
        slugsData = override.config;
      }
    }
  }

  if (isMono) {
    slugsData = slugsData.mono;
  }

  return slugsData;
}

/**
 * @param {number[]} versionBits
 * @return {number}
 */
export function getVersionBitsHash(versionBits) {
  let hash = 0;
  for (let i = 0; i < versionBits.length; i++) {
    const bit = versionBits[i];
    const powIndex = versionBits.length - i;
    const powValue = 100 ** powIndex;
    hash += powValue ** bit
  }

  return hash;
}

/**
 * @param {string} versionName
 */
export function parseVersionName(versionName) {
  const parsedVersion = [0, 0, 0, 0];
  const versionBits = versionName.split('.');

  for (let i = 0; i < parsedVersion.length; i++) {
    if (versionBits[i]) {
      parsedVersion[i] = parseInt(versionBits[i]);
    }
  }

  return parsedVersion;
}

/**
 * @param {Object} flavorBits
 * @param {string} flavorBits.flavorName
 * @param {number} flavorBits.flavorNumber
 * @return {number}
 */
export function getFlavorBitsHash(flavorBits) {
  let hash = 0;

  if (FLAVOR_MATRIX[flavorBits.flavorName]) {
    hash += FLAVOR_MATRIX[flavorBits.flavorName] * 1000;
  }

  hash += flavorBits.flavorNumber;

  return hash;
}

/**
 * @param {string} versionFlavor
 * @return {Object}
 */
export function parseVersionFlavor(versionFlavor) {
  let flavorName = versionFlavor;
  let flavorNumber = 0;

  const match = versionFlavor.match(/(?<name>\D*)(?<number>[0-9]+)$/);
  if (match) {
    flavorName = match.groups.name;
    flavorNumber = match.groups.number;
  }

  return {
    flavorName,
    flavorNumber
  }
}

/**
 * @param {number} versionBitsHash
 * @param {number} flavorBitsHash
 * @param {string[]} versionRange
 * @return {Object}
 */
export function isInVersionRange(versionBitsHash, flavorBitsHash, versionRange) {
  const rangeFrom = parseVersionString(versionRange[0]);
  const rangeTo = parseVersionString(versionRange[1]);

  const fromVersionHash = getVersionBitsHash(rangeFrom.versionBits);
  const toVersionHash = getVersionBitsHash(rangeTo.versionBits);

  if (versionBitsHash < fromVersionHash || versionBitsHash > toVersionHash) {
    return false;
  }

  if (versionBitsHash === fromVersionHash && flavorBitsHash < getFlavorBitsHash(rangeFrom.flavorBits)) {
    return false;
  }

  if (versionBitsHash === toVersionHash && flavorBitsHash > getFlavorBitsHash(rangeTo.flavorBits)) {
    return false;
  }

  return true;
}

/**
 * @param {string} versionString
 */
export function parseVersionString(versionString) {
  const stringBits = versionString.split('-');
  const versionBits = parseVersionName(stringBits[0]);
  const flavorBits = parseVersionFlavor(stringBits[1]);

  return {
    versionBits,
    flavorBits,
  }
}

/**
 * @typedef {Object} DownloadConfigEditor
 * @property {Object} primary
 * @property {Object} secondary
 */

/**
 * @typedef {Object} DownloadConfigMono
 * @property {string} templates
 * @property {DownloadConfigEditor} editor
 * @property {Object} extras
 */

/**
 * @typedef {Object} DownloadConfig
 * @property {string} templates
 * @property {DownloadConfigEditor} editor
 * @property {Object} extras
 * @property {DownloadConfigMono} mono
 */

/**
 * @typedef {Object} DownloadConfigsDefaults
 * @property {DownloadConfig} 4
 * @property {DownloadConfig} 3
 * @property {DownloadConfig} 2
 * @property {DownloadConfig} 1
 */

/**
 * @typedef {Object} DownloadConfigsOverride
 * @property {string} version
 * @property {string[]} range
 * @property {DownloadConfig} config
 */

/**
 * @typedef {Object} DownloadConfigs
 * @property {DownloadConfigsDefaults} defaults
 * @property {DownloadConfigsOverride[]} overrides
 */

/**
 * @returns {DownloadConfigs}
 */
export function loadDownloadConfig() {
  const fileContents = fs.readFileSync(DATA_DOWNLOAD_CONGIG_PATH, 'utf8');
  return yaml.load(fileContents);
}

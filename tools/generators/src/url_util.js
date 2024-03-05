import yaml from 'js-yaml';
import fs from 'fs';

const HOST_TUXFAMILY = "https://downloads.tuxfamily.org/godotengine"
const HOST_GITHUB = "https://github.com/godotengine/godot/releases/download"
const HOST_GITHUB_BUILDS = "https://github.com/godotengine/godot-builds/releases/download"

const FLAVOR_MATRIX = {
  "dev": 1,
  "alpha": 2,
  "beta": 3,
  "rc": 4,
  "stable": 10
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
export function generateLink(version, platform, isMono = false, host = "github") {
  const versionName = getVersionName(version);
  const versionFlavor = version.flavor;

  const versionBits = versionName.split(".");
  const slugsDefaults = getDownloadSlugs(version, isMono);

  if (!slugsDefaults) {
    return '#';
  }

  let monoSlug = '';
  if (isMono) {
    monoSlug = '/mono';
  }

  let downloadSlug = '';
  if (platform === 'templates' && slugsDefaults.templates) {
    downloadSlug = slugsDefaults[platform];
  } else if (slugsDefaults.editor.primary[platform]) {
    downloadSlug = slugsDefaults.editor.primary[platform];
  } else if (slugsDefaults.editor.secondary[platform]) {
    downloadSlug = slugsDefaults.editor.secondary[platform];
  } else if (slugsDefaults.extras && slugsDefaults.extras[platform]) {
    downloadSlug = slugsDefaults.extras[platform];
  } else {
    // Unknown platform key, abort.
    return '#';
  }

  let downloadFile = '';
  if (platform === 'aar_library') {
    downloadFile = `godot-lib.${versionName}.${versionFlavor}.${downloadSlug}`;
  } else {
    if (versionBits[0] === '1' || (versionBits[0] === '2' && versionBits[1] === '0')) {
      downloadFile = `Godot_v${versionName}_${versionFlavor}_${downloadSlug}`;
    } else {
      downloadFile = `Godot_v${versionName}-${versionFlavor}_${downloadSlug}`;
    }
  }

  switch (host) {
    case 'github':
      return `${HOST_GITHUB}/${versionName}-${versionFlavor}/${downloadFile}`;
    case 'github_builds':
      return `${HOST_GITHUB_BUILDS}/${versionName}-${versionFlavor}/${downloadFile}`;
    case 'tuxfamily':
      if (versionFlavor === 'stable') {
        return `${HOST_TUXFAMILY}/${versionName}${monoSlug}/${downloadFile}`;
      } else {
        return `${HOST_TUXFAMILY}/${versionName}/${versionFlavor}${monoSlug}/${downloadFile}`;
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
 * @return {Object}
 */
export function getDownloadSlugs(version, isMono = false) {
  const versionName = getVersionName(version);
  const versionMajor = versionName.split(".")[0];

  const downloadConfigs = loadDownloadConfig();
  let slugsData = downloadConfigs.defaults[versionMajor];

  if (!slugsData) {
    return null
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
  const versionBits = versionName.split(".");

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
  const stringBits = versionString.split("-");
  const versionBits = parseVersionName(stringBits[0]);
  const flavorBits = parseVersionFlavor(stringBits[1]);

  return {
    versionBits,
    flavorBits,
  }
}

/**
 * @typedef {Object} DownloadConfigMono
 * @property {string} templates
 * @property {Object} editor
 * @property {Object} extras
 */

/**
 * @typedef {Object} DownloadConfig
 * @property {string} templates
 * @property {Object} editor
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
  const fileContents = fs.readFileSync('data/download_configs.yml', 'utf8');
  return yaml.load(fileContents);
}

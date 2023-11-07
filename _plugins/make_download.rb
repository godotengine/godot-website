# Generate a download URL for a particular version of the engine.
#
# See `_data/download_configs.yml` for a reference table of slugs.

HOST_TUXFAMILY = "https://downloads.tuxfamily.org/godotengine"
HOST_GITHUB = "https://github.com/godotengine/godot/releases/download"
HOST_GITHUB_BUILDS = "https://github.com/godotengine/godot-builds/releases/download"

module MakeDownloadFilter
  # Input should be a value from versions.yml or the output of make_release_version().
  def get_download_platforms(input, mono = false)
    slugs_defaults = get_download_slugs(input, mono)
    if slugs_defaults.nil?
      return []
    end

    platforms = slugs_defaults["editor"].keys

    if slugs_defaults.key?("templates")
      platforms.push("templates")
    end

    if slugs_defaults.key?("extras")
      extras = slugs_defaults["extras"].keys
      for extra in extras do
        platforms.push(extra)
      end
    end

    return platforms
  end

  # Input should be a value from versions.yml or the output of make_release_version().
  def get_download_primary(input, mono = false)
    slugs_defaults = get_download_slugs(input, mono)
    if slugs_defaults.nil?
      return {}
    end

    primary = {}

    platforms = slugs_defaults["editor"].keys
    for platform in platforms do
      platform_key = platform.split(".")[0]

      unless primary.key?(platform_key)
        primary[platform_key] = platform
      end
    end

    if slugs_defaults.key?("templates")
      primary["templates"] = "templates"
    end

    return primary
  end

  # Input should be a value from versions.yml or the output of make_release_version().
  def make_download(input, platform, mono = false, host = "github")
    version_name = get_version_name(input)
    version_flavor = input["flavor"]

    version_bits = version_name.split(".")
    version_majmin = "#{version_bits[0]}.#{version_bits[1]}"

    slugs_defaults = get_download_slugs(input, mono)
    if slugs_defaults.nil?
      return "#"
    end

    mono_slug = ""
    if mono
      mono_slug = "/mono"
    end

    download_slug = ""
    if platform == "templates" and slugs_defaults.key?(platform)
      download_slug = slugs_defaults[platform]
    elsif slugs_defaults["editor"].key?(platform)
      download_slug = slugs_defaults["editor"][platform]
    elsif slugs_defaults.key?("extras") and slugs_defaults["extras"].key?(platform)
      download_slug = slugs_defaults["extras"][platform]
    else
      # Unknown platform key, abort.
      return "#"
    end

    download_file = ""
    if platform == "aar_library"
      download_file = "godot-lib.#{version_name}.#{version_flavor}.#{download_slug}"
    else
      # Format was slightly different up until 2.1.
      if version_bits[0] == "1" or (version_bits[0] == "2" and version_bits[1] == "0")
        download_file = "Godot_v#{version_name}_#{version_flavor}_#{download_slug}"
      else
        download_file = "Godot_v#{version_name}-#{version_flavor}_#{download_slug}"
      end
    end

    if host == "github"
      return "#{HOST_GITHUB}/#{version_name}-#{version_flavor}/#{download_file}"
    elsif host == "github_builds"
      return "#{HOST_GITHUB_BUILDS}/#{version_name}-#{version_flavor}/#{download_file}"
    elsif host == "tuxfamily"
      if version_flavor == "stable"
        return "#{HOST_TUXFAMILY}/#{version_name}#{mono_slug}/#{download_file}"
      else
        return "#{HOST_TUXFAMILY}/#{version_name}/#{version_flavor}#{mono_slug}/#{download_file}"
      end
    end
  end

  # Input and release should be values from versions.yml or strings.
  def make_release_version(input, release)
    site_data = @context.registers[:site].data

    version_data = nil
    # Input can be a version string, e.g. 4.1. Try to match it against version data.
    if input.is_a? String
      version_data = site_data["versions"].find { |item| item["name"] == input }
    else
      version_data = input
    end
    if version_data.nil?
      return nil
    end

    release_data = nil
    # Release name can be a string as well. Try to match it with the current version flavor
    # or with one of previous releases.
    if release.is_a? String
      if version_data["flavor"] == release
        release_data = nil
      elsif version_data.key?("releases")
        release_data = version_data["releases"].find { |item| item["name"] == release }
      end
    else
      release_data = release
    end
    if release_data.nil?
      return version_data
    end

    new_version = version_data.dup
    new_version["flavor"] = release_data["name"]
    new_version["release_version"] = release_data.key?("release_version") ? release_data["release_version"] : version_data["name"]
    new_version["release_date"] = release_data["release_date"]
    new_version["release_notes"] = release_data["release_notes"]

    return new_version
  end

  private

  # Input should be a value from versions.yml or the output of make_release_version().
  def get_version_name(input)
      return input.key?("release_version") ? input["release_version"] : input["name"]
  end

  # Input should be a value from versions.yml or the output of make_release_version().
  def get_download_slugs(input, mono = false)
    version_name = get_version_name(input)
    version_major = version_name.split(".")[0].to_i

    # Access the site data for the slug reference table.
    site_data = @context.registers[:site].data
    download_configs = site_data["download_configs"]

    # If there is no config for this major version, abort.
    if not download_configs["defaults"].key?(version_major)
      return nil
    end

    slugs_defaults = download_configs["defaults"][version_major]
    if mono
      # Requesting mono, but there is no config for mono, abort.
      if not slugs_defaults.key?("mono")
        return nil
      end
      slugs_defaults = slugs_defaults["mono"]
    end

    return slugs_defaults
  end

end

Liquid::Template.register_filter(MakeDownloadFilter)

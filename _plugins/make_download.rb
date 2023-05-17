# Generate a download URL for a particular version of the engine.
#
# See `_data/download_configs.yml` for a reference table of slugs.

HOST_TUXFAMILY = "https://downloads.tuxfamily.org/godotengine"
HOST_GITHUB = "https://github.com/godotengine/godot/releases/download"

module MakeDownloadFilter
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

  def make_download(input, platform, mono = false, host = "github")
    version_name = input["name"]
    version_flavor = input["flavor"]

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
      download_file = "Godot_v#{version_name}-#{version_flavor}_#{download_slug}"
    end

    if host == "github"
      return "#{HOST_GITHUB}/#{version_name}-#{version_flavor}/#{download_file}"
    elsif host == "tuxfamily"
      if version_flavor == "stable"
        return "#{HOST_TUXFAMILY}/#{version_name}/#{mono_slug}/#{download_file}"
      else
        return "#{HOST_TUXFAMILY}/#{version_name}/#{version_flavor}#{mono_slug}/#{download_file}"
      end
    end
  end

  private

  def get_download_slugs(input, mono = false)
    version_major = input["name"].split(".")[0].to_i

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

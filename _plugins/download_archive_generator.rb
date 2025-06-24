module DownloadArchiveGeneratorPlugin
	class DownloadArchiveGenerator < Jekyll::Generator
	  safe true

	  def generate(site)
		puts "Generating download archive pages..."

		versions = 0

		site.data["versions"].each do |version|
		  version_name = version["name"]
		  versions += 1

		  # Generate files for the current main flavor (stable or latest pre-release).
		  site.pages << DownloadArchivePage.new(site, version, nil)

		  # Iterate through previous releases and generate files for them as well.
		  if version.key?("releases")
			version["releases"].each do |release|
				site.pages << DownloadArchivePage.new(site, version, release)
			end
		  end
		end

		puts "Finished generating the download archive (#{versions} versions generated)."
	  end
	end

	class DownloadArchivePage < Jekyll::Page
	  def initialize(site, version, release)
		# Configure static information and path.
		@site = site
		@base = site.source

		version_data = make_release_version(version, release)

		# Generate the version identificator.
		version_name = version_data["name"]
		version_flavor = version_data["flavor"]
		version_id = "#{version_name}-#{version_flavor}"

		version_bits = version_name.split(".")
		version_majmin = "#{version_bits[0]}.#{version_bits[1]}"

		# Configure the permalink information.
		@dir      = "download/archive/#{version_id}"
		@basename = 'index'
		@ext      = '.html'
		@name     = 'index.html'

		# Initialize data hash to pass objects to the template.
		@data = {
		  'title' => "Download Godot #{version_name} (#{version_flavor}) - Godot Engine",
		  'description' => "Download Godot Engine version #{version_name} (#{version_flavor}) for Linux, macOS, Windows, or Android",
		  'version' => version_data,
		  'version_name' => version_name,
		  'version_flavor' => version_flavor,
		}

		# Defaults can be configured via the `_config.yml`, same as with normal
		# collections.
		data.default_proc = proc do |_, key|
		  site.frontmatter_defaults.find(relative_path, :download_archive, key)
		end
	  end

	  def make_release_version(version, release)
		if release.nil?
		  return version
		end

		new_version = version.dup
		new_version["flavor"] = release["name"]
		new_version["release_version"] = release.key?("release_version") ? release["release_version"] : version["name"]
		new_version["release_date"] = release["release_date"]
		new_version["release_notes"] = release["release_notes"]

		return new_version
	  end

	  def url_placeholders
		{
		  :path       => @dir,
		  :basename   => basename,
		  :output_ext => output_ext,
		}
	  end
	end
  end

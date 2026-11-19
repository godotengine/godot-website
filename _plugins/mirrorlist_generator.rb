module MirrorlistGeneratorPlugin
	class MirrorlistGenerator < Jekyll::Generator
	  safe true

	  def generate(site)
		puts "Generating mirrorlist pages..."

		versions = 0

		site_versions = site.data["versions"]
		limit = site.config["dev_versions_limit"]
		site_versions = site_versions.first(limit) if limit

		site_versions.each do |version|
		  version_name = version["name"]
		  versions += 1

		  # Generate files for the current main flavor (stable or latest pre-release).
		  site.pages << MirrorlistPage.new(site, version, false)
		  site.pages << MirrorlistPage.new(site, version, true)

		  # Iterate through previous releases and generate files for them as well.
		  if version.key?("releases")
			version["releases"].each do |release|
				version_name = release.key?("release_version") ? release["release_version"] : version["name"]

				prerelease = {
					'name' => version_name,
					'flavor' => release["name"]
				}
				site.pages << MirrorlistPage.new(site, prerelease, false)
				site.pages << MirrorlistPage.new(site, prerelease, true)
			end
		  end
		end

		puts "Finished generating the mirrorlist (#{versions} versions generated)."
	  end
	end

	class MirrorlistPage < Jekyll::Page
	  def initialize(site, version, mono)
		# Configure static information and path.
		@site = site
		@base = site.source
		@dir  = 'mirrorlist'

		# Generate the version identificator.
		version_name = version["name"]
		version_flavor = version["flavor"]

		version_id = "#{version_name}.#{version_flavor}"
		if version_name == "3.0" # Hack for the only version before the naming scheme has been changed.
			version_id = "#{version_name}-#{version_flavor}"
		end
		if mono
			version_id = "#{version_id}.mono"
		end

		version_bits = version_name.split(".")
		version_majmin = "#{version_bits[0]}.#{version_bits[1]}"

		# Configure the permalink information.
		@basename = version_id
		@ext      = '.json'
		@name     = "#{version_id}.json"

		# Generate the list of mirrors.
		mirrors = []

		mirrorlist_configs = site.data["mirrorlist_configs"]
		mirrorlist_hosts = mirrorlist_configs["hosts"]

		version_defaults = mirrorlist_configs["defaults"].find { |config| config["name"] == version_majmin }

		unless version_defaults.nil?
			mirror_hosts = version_defaults["stable"]
			unless version_flavor == "stable"
				mirror_hosts = version_defaults["preview"]
			end

			mirror_hosts.each do |host_name|
				mirror_host = mirrorlist_hosts.find { |host| host["name"] == host_name }
				mirror_url = make_download(version, "templates", mono, host_name)

				# TODO: Don't hardcode the list of export template platforms/architectures
				# (source it from `download_configs.yml` instead).
				mirror_debugsymbols = {
					'templates' => {
						'android.debug.apk' => make_download(version, "debugsymbols_templates_android.debug.apk", mono, host_name),
						'android.release.apk' => make_download(version, "debugsymbols_templates_android.release.apk", mono, host_name),
						'linux.debug.64' => make_download(version, "debugsymbols_templates_linux.debug.64", mono, host_name),
						'linux.release.64' => make_download(version, "debugsymbols_templates_linux.release.64", mono, host_name),
						'linux.debug.32' => make_download(version, "debugsymbols_templates_linux.debug.32", mono, host_name),
						'linux.release.32' => make_download(version, "debugsymbols_templates_linux.release.32", mono, host_name),
						'linux.debug.arm64' => make_download(version, "debugsymbols_templates_linux.debug.arm64", mono, host_name),
						'linux.release.arm64' => make_download(version, "debugsymbols_templates_linux.release.arm64", mono, host_name),
						'linux.debug.arm32' => make_download(version, "debugsymbols_templates_linux.debug.arm32", mono, host_name),
						'linux.release.arm32' => make_download(version, "debugsymbols_templates_linux.release.arm32", mono, host_name),
						'macos.debug.arm64' => make_download(version, "debugsymbols_templates_macos.debug.arm64", mono, host_name),
						'macos.release.arm64' => make_download(version, "debugsymbols_templates_macos.release.arm64", mono, host_name),
						'macos.debug.x86_64' => make_download(version, "debugsymbols_templates_macos.debug.x86_64", mono, host_name),
						'macos.release.x86_64' => make_download(version, "debugsymbols_templates_macos.release.x86_64", mono, host_name),
						'windows.debug.64' => make_download(version, "debugsymbols_templates_windows.debug.64", mono, host_name),
						'windows.release.64' => make_download(version, "debugsymbols_templates_windows.release.64", mono, host_name),
						'windows.debug.32' => make_download(version, "debugsymbols_templates_windows.debug.32", mono, host_name),
						'windows.release.32' => make_download(version, "debugsymbols_templates_windows.release.32", mono, host_name),
						'windows.debug.arm64' => make_download(version, "debugsymbols_templates_windows.debug.arm64", mono, host_name),
						'windows.release.arm64' => make_download(version, "debugsymbols_templates_windows.release.arm64", mono, host_name),
					}
				}

				unless mirror_url == "#"
					mirror = {
						'name' => mirror_host["title"],
						'url' => mirror_url,
						'debugsymbols' => mirror_debugsymbols
					}
					mirrors.push(mirror)
				end
			end
		else
			mirror_host = mirrorlist_hosts.find { |host| host["name"] == "tuxfamily" }
			mirror_url = make_download(version, "templates", mono, "tuxfamily")

			unless mirror_url == "#"
				mirror = { 'name' => mirror_host["title"], 'url' => mirror_url }
				mirrors.push(mirror)
			end
		end

		# Debug symbols are available in 4.8.beta1 and later.
		version_major = Integer(version_bits[0])
		version_minor = Integer(version_bits[1])
		debugsymbols_available = version_major >= 5
		unless debugsymbols_available
			debugsymbols_available = version_major == 4 && version_minor >= 9
		end
		unless debugsymbols_available
			debugsymbols_available = version_major == 4 && version_minor == 8 && (version_flavor.start_with?("beta") || version_flavor.start_with?("rc"))
		end

		# Initialize data hash to pass objects to the template.
		@data = {
		  'version_mirrors' => mirrors,
		  'debugsymbols_available' => debugsymbols_available
		}

		# Defaults can be configured via the `_config.yml`, same as with normal
		# collections.
		data.default_proc = proc do |_, key|
		  site.frontmatter_defaults.find(relative_path, :mirrorlist, key)
		end
	  end

	  # This is a hack to generate the URL from code. I don't know a better way to hook into Liquid and use its
	  # registered filters. But it's short and sweet enough for now (or for... ever).
	  def make_download(version, platform, mono, host)
		template = Liquid::Template.parse('{{ version | make_download: platform, mono, host }}')

		assigns = {
			'version' => version,
			'platform' => platform,
			'mono' => mono,
			'host' => host
		}
		# We need to pass the site reference to registers because make_downloads relies on this context being
		# present.
		return template.render(assigns, registers: { site: @site })
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

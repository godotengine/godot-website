module MirrorlistGeneratorPlugin
	class MirrorlistGenerator < Jekyll::Generator
	  safe true

	  def generate(site)
		puts "Generating mirrorlist pages..."

		site.data["versions"].each do |version|
		  version_name = version["name"]
		  puts "    Rendering version '#{version_name}'."

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

		puts "Finished generating the mirrorlist."
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
				mirror_url = make_download(version, mono, host_name)

				unless mirror_url == "#"
					mirror = { 'name' => mirror_host["title"], 'url' => mirror_url }
					mirrors.push(mirror)
				end
			end
		else
			mirror_host = mirrorlist_hosts.find { |host| host["name"] == "tuxfamily" }
			mirror_url = make_download(version, mono, "tuxfamily")

			unless mirror_url == "#"
				mirror = { 'name' => mirror_host["title"], 'url' => mirror_url }
				mirrors.push(mirror)
			end
		end

		# Initialize data hash to pass objects to the template.
		@data = {
		  'version_mirrors' => mirrors
		}

		# Defaults can be configured via the `_config.yml`, same as with normal
		# collections.
		data.default_proc = proc do |_, key|
		  site.frontmatter_defaults.find(relative_path, :mirrorlist, key)
		end
	  end

	  # This is a hack to generate the URL from code. I don't know a better way to hook into Liquid and use its
	  # registered filters. But it's short and sweet enough for now (or for... ever).
	  def make_download(version, mono, host)
		template = Liquid::Template.parse('{{ version | make_download: "templates", mono, host }}')

		assigns = {
			'version' => version,
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

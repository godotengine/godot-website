require 'yaml'

module Jekyll
  module VersionFilter
    def get_latest_patch(input)
      base_version_split = input.split(".")
      if base_version_split.length() != 2
        raise Exception.new "Base version must be in format 'major.minor'"
      end

      site = @context.registers[:site]
      versions = YAML.load_file(File.join(site.source, "_data/versions.yml"))
      latest_patch = 0

      versions.each do |version|
        version_split = version["name"].split(".")

        if version_split.length() != 3
          next
        end

        if base_version_split[0] != version_split[0] || base_version_split[1] != version_split[1]
          next
        end

        version_patch = version_split[2].to_i
        if version_patch > latest_patch
          latest_patch = version_patch
        end
      end

      if latest_patch == 0
        return input
      end

      "#{base_version_split[0]}.#{base_version_split[1]}.#{latest_patch.to_s}"
    end
  end
end

Liquid::Template.register_filter(Jekyll::VersionFilter)

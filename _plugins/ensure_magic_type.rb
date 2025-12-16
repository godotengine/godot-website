#!/usr/bin/env ruby

require 'magic'

module Jekyll
  module EnsureMagicTypeFilter
    @@known_types = {
      "jpeg" => "JPEG image data",
      "png" => "PNG image data",
      "gif" => "GIF image data",
      "webp" => "Web/P image",
    }

    def ensure_magic_type(input, type, error_context = nil)
      types = type.split(",")
      types.each do |type|
        if not @@known_types.key? type
          raise Exception.new "\"#{type}\" is not a \"known type\" registered in `_plugins/ensure_magic_type.rb`. Please add the type in the `@@known_types` hash before testing."
        end
      end

      site_config = @context.registers[:site].config
      site_source = site_config["source"]

      input_path = File.join(site_source, input)

      magic = Magic.new
      magic_of_input = magic.file(input_path)
      magic_of_input_split = magic_of_input.split(", ")

      detected_type = nil
      @@known_types.each do |known_type_name, known_type_magic|
        if magic_of_input_split.include? known_type_magic
          detected_type = known_type_name
          break
        end
      end

      raise_exception = false

      if detected_type == nil
        raise_exception = true
        detected_type = magic_of_input
        raise Exception.new
      end

      if not types.include? detected_type
        raise_exception = true
      end

      if raise_exception
        msg = "\"#{input}\" is not of type \"#{types.join(", ")}\" (is of type \"#{detected_type}\")"
        if error_context != nil
          msg += "\nContext: #{error_context}"
        end
        raise Exception.new msg
      end

      input
    end
  end
end

Liquid::Template.register_filter(Jekyll::EnsureMagicTypeFilter)

# Plugin for Jekyll that ensures known magic types.
# `ensure_magic_type` always returns the passed value.
# Though, it will raise an exception if the types don't match.
#
# Usage:
# {% assign page_image = page.image | ensure_magic_type: 'webp', 'WebP are preferred.', 'jpg:JPGs are way too big!' %}
#
# The first argument is a list of "known types". It's a comma-separated string of the below @@known_types keys.
#
# The last arguments are error contexts.
# If the error context begins with `<known_type>:`, it will be printed to add context to the exception.
# If the error don't begin with this prefix, it will be used as a general context to explain why checks are made.

require 'magic'

module Jekyll
  module EnsureMagicTypeFilter
    @@known_types = {
      "jpeg" => "JPEG image data",
      "jxl" => "JPEG XL codestream",
      "png" => "PNG image data",
      "gif" => "GIF image data",
      "webp" => "Web/P image",
      "avif" => "AVIF Image",
    }

    def ensure_magic_type(input, type, *error_contexts)
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

      detected_type = false
      detected_type_key = nil
      detected_type_text = ""
      @@known_types.each do |known_type_name, known_type_magic|
        if magic_of_input_split.include? known_type_magic
          detected_type = true
          detected_type_key = known_type_name
          detected_type_text = known_type_name
          break
        end
      end

      raise_exception = false
      if detected_type
        if not types.include? detected_type_key
          raise_exception = true
        end
      else
        raise_exception = true
        detected_type_text = magic_of_input
      end

      if raise_exception
        msg = "\"#{input}\" is not of type \"#{types.join(", ")}\" (is of type \"#{detected_type_text}\")"

        if error_contexts.size > 0
          generic_error_context = nil
          specific_error_context = nil

          error_contexts.each do |error_context|
            starts_with_known_type = false
            @@known_types.keys.each do |known_type_key|
              prefix = "#{known_type_key}:"
              if error_context.start_with? prefix
                starts_with_known_type = true
                if detected_type && known_type_key == detected_type_text
                  specific_error_context = error_context[prefix.length..]
                end
                break
              end
            end

            if not starts_with_known_type
              if generic_error_context != nil
                raise Exception.new "Multiple generic errors given."
              end
              generic_error_context = error_context
            end
          end


          if generic_error_context != nil
            msg += "\n#{generic_error_context}"
          end

          if detected_type and specific_error_context != nil
            msg += "\n[#{detected_type_text}]: #{specific_error_context}"
          end
        end
        raise Exception.new msg
      end

      input
    end
  end
end

Liquid::Template.register_filter(Jekyll::EnsureMagicTypeFilter)

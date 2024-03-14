module Jekyll
  class InlineSVG < Liquid::Tag
    include Jekyll::LiquidExtensions

    FILE_PATH_PATTERN = /^(?<path>.+\.svg)(?<params>.*)/
    VARIABLE_PATTERN = /\{\{\s*([\w.\-]+)\s*\}\}/i
    SVG_CONTENT_PATTERN = /<svg(.*?)>/m
    KEY_VALUE_PATTERN = /(\w+)="([^"]*)"/

    def initialize(tag_name, markup, tokens)
      super
      @markup = markup
    end

    def render(context)
      params = parse_params(@markup, context)
      svg = File.read(params['path'])

      # Params that go inside the opening tag, ex: width -> <svg width="100">
      current_svg_params = svg.match(SVG_CONTENT_PATTERN)[1]
      new_svg_params = params['svg_params']
      new_svg_params_inline = ""

      new_svg_params.map do |key, value|
        # Svg already has param, so we replace it
        if current_svg_params.match(/#{key}="[^"]+"/)
          current_svg_params = current_svg_params.sub(/#{key}="[^"]+"/, "#{key}=\"#{value}\"")
        # Svg doesnt have param, save it for latter
        else
          new_svg_params_inline += "#{key}=\"#{value}\" "
        end
      end

      # Add new params
      current_svg_params += new_svg_params_inline
      svg = svg.sub(/<svg(.*?)>/, "<svg#{current_svg_params}>")

      # Params that go between the opening and closing tag, ex: <title> -> <svg><title>Hello</title></svg>
      block_params = params['block_params']
      block_params.map do |key, value|
        svg = svg.sub(/<\/svg>/, "<#{key}>#{value}</#{key}></svg>")
      end

      svg
    end

    private

    def parse_params(markup, context)
      match = markup.strip.match(FILE_PATH_PATTERN)

      path = match["path"]
      path = path.gsub!(/^\"|\"?$/, '').strip
      path = hydrate_markup(context, path)

      params = match["params"]
      # Params that go inside the opening tag, ex: width -> <svg width="100">
      svg_params = {}
      # Params that go between the opening and closing tag, ex: <title> -> <svg><title>Hello</title></svg>
      block_params = {}
      params.scan(KEY_VALUE_PATTERN) do |key, value|
        case key
        when "title", "desc"
          block_params[key] = hydrate_markup(context, value)
        else
          svg_params[key] = hydrate_markup(context, value)
        end
      end

      {
        'path' => path,
        'svg_params' => svg_params,
        'block_params' => block_params,
      }
    end

    def hydrate_markup(context, markup)
      # Converts liquid {{ }} to the actual variable using the context
      markup.scan VARIABLE_PATTERN do |variable|
        markup = markup.sub(VARIABLE_PATTERN, lookup_variable(context, variable.first))
      end
      markup
    end
  end
end

Liquid::Template.register_tag('inline_svg', Jekyll::InlineSVG)

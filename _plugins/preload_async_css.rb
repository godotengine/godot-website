# https://web.dev/articles/defer-non-critical-css
module Jekyll
  class PreloadAsyncCSS < Liquid::Tag

    def initialize(tag_name, markup, tokens)
      super
      @params = parse_params(markup)
    end

    def render(context)
      href = @params['href']
      priority = @params['priority']
      output = "<link rel=\"preload\" href=\"#{href}\" as=\"style\" fetchpriority=\"#{priority}\" onload=\"this.onload=null;this.rel='stylesheet'\"><noscript><link rel=\"stylesheet\" href=\"#{href}\"></noscript>"
      return output
    end

    private

    def parse_params(markup)
      params = {
        'priority' => 'low'
      }
      # Match key="value"
      markup.scan(/(\w+)="([^"]*)"/) do |key, value|
        params[key] = value
      end
      params
    end
  end
end

Liquid::Template.register_tag('preload_async_css', Jekyll::PreloadAsyncCSS)

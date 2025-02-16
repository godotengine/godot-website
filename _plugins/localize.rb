# Simple localization plugin for Jekyll by Emilio Coppola v0.1
#
# Usage:
# - Add 'localize' front matter to pages that should be localized
# - Add 'lang' front matter to pages that should have a specific language
# - Add translations to _i18n/{lang}.yml files
# - Use the '{% t useyourkeyhere %}' tag to translate text
# - Use the '{% current_lang %}' tag to get the current page language
# - Use the '{% tlink /your/path %}' tag to get the localized URL
# ----------------------------------------
# Example `index.html`:
# ---
# localize: [en, fr]
# ---
# <h1>{% t home.title %}</h1>
# <p>Current language: {% current_lang %}</p>
# <a href="{% tlink /about %}">About</a>
#
# _i18n/en.yml:
# home:
#   title: "Welcome"
#
# _i18n/fr.yml:
# home:
#   title: "Bienvenue"
#
# This will generate the following pages:
# - /index.html
# - /fr/index.html
#
# ----------------------------------------
# Todo:
# - Add fallback to default language if translation is missing
# - Add support for localized front matter

require 'yaml'
module Jekyll
  class TranslateTag < Liquid::Tag
    def initialize(tag_name, text, tokens)
      super
      @text = text.strip
    end

    def render(context)
      site = context.registers[:site]
      page = context.registers[:page]
      lang = page['lang'] || site.config['lang'] || 'en'
      
      translations = YAML.load_file(File.join(site.source, "_i18n/#{lang}.yml"))
      
      @text.split('.').reduce(translations) { |result, key| 
        result&.[](key) or return "Translation missing: #{@text}"
      }
    end
  end

  class CurrentLangTag < Liquid::Tag
    def render(context)
      site = context.registers[:site]
      page = context.registers[:page]
      page['lang'] || site.config['lang'] || 'en'
    end
  end

  class TranslateUrlTag < Liquid::Tag
    def initialize(tag_name, url, tokens)
      super
      @url = url.strip
    end

    def render(context)
      site = context.registers[:site]
      page = context.registers[:page]
      lang = page['lang'] || site.config['lang'] || 'en'
      default_lang = site.config['lang'] || 'en'

      # If we're in the default language, return the URL as is
      return @url if lang == default_lang

      # Otherwise, prepend the language code
      # Ensure the URL starts with a forward slash
      url = @url.start_with?('/') ? @url : "/#{@url}"
      "/#{lang}#{url}"
    end
  end

  class LocalizationGenerator < Generator
    safe true
    priority :high

    def clean_url(url)
      # Remove any file with extension from the end of the URL
      # This will match 'index.html', 'index.php', etc.
      cleaned_url = url.sub(/index\.[^\/]+$/, '')
      
      # Ensure trailing slash
      cleaned_url.end_with?('/') ? cleaned_url : "#{cleaned_url}/"
    end

    def create_page(site, original_page, lang, is_default = false)
      new_page = Jekyll::Page.new(
        site,
        site.source,
        File.dirname(original_page.path),
        File.basename(original_page.path)
      )
      
      new_page.data.merge!(original_page.data)
      new_page.content = original_page.content.dup
      new_page.data['lang'] = lang
      
      unless is_default
        base_url = clean_url(original_page.url)
        new_page.data['permalink'] = "/#{lang}#{base_url}"
      end
      
      new_page
    end

    def generate(site)
      default_lang = site.config['lang'] || 'en'
      
      # Process pages with localization front matter
      localizable_pages = site.pages.select { |page| page.data['localize'].is_a?(Array) }
      
      new_pages = localizable_pages.flat_map do |page|
        # Create default language page
        default_page = create_page(site, page, default_lang, true)
        
        # Create pages for other languages
        other_pages = page.data['localize']
          .reject { |lang| lang == default_lang }
          .map { |lang| create_page(site, page, lang) }
        
        [default_page, *other_pages]
      end
      
      # Replace original pages with localized versions
      site.pages.delete_if { |page| page.data['localize'].is_a?(Array) }
      site.pages.concat(new_pages)
    end
  end
end

Liquid::Template.register_tag('t', Jekyll::TranslateTag)
Liquid::Template.register_tag('current_lang', Jekyll::CurrentLangTag)
Liquid::Template.register_tag('tlink', Jekyll::TranslateUrlTag)
require "jekyll"


# Minify assets after each build
Jekyll::Hooks.register :site, :post_write do
  puts "Minifying assets"
  `minify -r -o _site/ _site/`
end

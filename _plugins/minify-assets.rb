require 'pathname'

# Minify assets after each build
Jekyll::Hooks.register :site, :post_write do
  puts "Minifying assets"
  # Project path
  Pathname here = Pathname.new(Dir.pwd)
  Pathname from = Pathname.new(File.join(Dir.pwd, "_site"))
  Pathname to = Pathname.new(Dir.pwd)
  `minify -r -o #{to.relative_path_from(here)} #{from.relative_path_from(here)}`
end

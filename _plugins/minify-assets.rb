require 'pathname'

# Minify assets after each build
Jekyll::Hooks.register :site, :post_write do
  puts "Minifying assets"
  # Project path
  Pathname here = Pathname.new(Dir.pwd)
  Pathname from = Pathname.new(File.join(Dir.pwd, "_site"))
  Pathname to = Pathname.new(Dir.pwd)
  # Attempt to minify using 'minify', fallback to 'gominify' if not present
  minify_command = `which minify`.empty? ? 'gominify' : 'minify'
  if `which #{minify_command}`.empty?
    puts "Error: Neither 'minify' nor 'gominify' is installed. Please install 'minify'."
    exit 1
  end
  `#{minify_command} -r -o #{to.relative_path_from(here)} #{from.relative_path_from(here)}`
end

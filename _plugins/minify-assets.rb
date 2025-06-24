require 'pathname'

# Minify assets after each build
Jekyll::Hooks.register :site, :post_write do
  puts "Minifying assets"
  # Project path
  Pathname here = Pathname.new(Dir.pwd)
  Pathname from = Pathname.new(File.join(Dir.pwd, "_site"))
  Pathname to = Pathname.new(Dir.pwd)
  # Attempt to minify using 'minify', fallback to 'gominify' if not present
  `command -v minify`
  minify_command = $?.exitstatus != 0 ? 'gominify' : 'minify'
  `command -v #{minify_command}`
  if $?.exitstatus != 0
    puts "ERROR: Neither 'minify' nor 'gominify' is installed. Please install 'minify'."
    exit 1
  end
  `#{minify_command} -r -o #{to.relative_path_from(here)} #{from.relative_path_from(here)}`
end

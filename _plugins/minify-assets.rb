# Minify assets after each build
Jekyll::Hooks.register :site, :post_write do
  puts "Minifying assets"
  # Project path
  site_path_from = File.join(Dir.pwd, "_site")
  site_path_to = Dir.pwd
  `minify -r -o #{site_path_to} #{site_path_from}`
end

build: build-hugo index-articles

build-hugo: install-tools update-mirrorList update-download-archive
	hugo --gc --minify

serve:
	hugo server -D

serve-minify:
	hugo server -D --minify

serve-nocache:
	hugo server -D --ignoreCache --disableFastRender

serve-profile:
	hugo server --templateMetrics --templateMetricsHints

serve-no-reload:
	hugo server --disableLiveReload

install-tools:
	cd ./tools/generators && npm install

update-mirrorList: install-tools
	node ./tools/generators/src/mirror_list_generator.js

update-download-archive: install-tools
	node ./tools/generators/src/download_archive_generator.js

index-articles:
	npx --yes pagefind --site "public" --glob "**/article/*/*.{html}"

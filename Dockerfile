# Stage 1: Build the Jekyll site.
FROM ruby:3.2 AS build

# Native gem deps + tdewolff/minify for asset minification.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        build-essential \
        libffi-dev \
        libmagic-dev \
    && curl -fsSL https://github.com/tdewolff/minify/releases/latest/download/minify_linux_amd64.tar.gz \
        | tar -xz -C /usr/local/bin minify \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /srv/jekyll

# Cache gem installation in its own layer.
COPY Gemfile ./
RUN bundle install

# Build with production config only.
COPY . .
RUN bundle exec jekyll build

# Stage 2: Serve with nginx.
FROM nginx:alpine
COPY --from=build /srv/jekyll/_site /usr/share/nginx/html
EXPOSE 80

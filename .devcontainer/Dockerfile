# Ruby 3.2 on Debian (Alpine's musl breaks sass-embedded).
FROM ruby:3.2

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

EXPOSE 4000

FROM dunglas/frankenphp

COPY . /app

RUN install-php-extensions \
 gd \
 intl \
 imap \
 zip \
 opcache

#COPY --from=caddy:builder /usr/bin/xcaddy /usr/bin/xcaddy

# CGO doit être activé pour construire FrankenPHP
#ENV CGO_ENABLED=1 XCADDY_SETCAP=1 XCADDY_GO_BUILD_FLAGS="-ldflags '-w -s'"
#RUN xcaddy build \
#	--output /usr/local/bin/frankenphp \
#	--with github.com/dunglas/frankenphp=./ \
#	--with github.com/dunglas/frankenphp/caddy=./caddy/ \
#	# Mercure et Vulcain sont inclus dans la construction officielle, mais n'hésitez pas à les retirer
#	--with github.com/dunglas/mercure/caddy \
#	--with github.com/dunglas/vulcain/caddy
#	# Ajoutez des modules Caddy supplémentaires ici
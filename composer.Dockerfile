FROM composer

WORKDIR /var/www/zeltlager
CMD ["composer", "install"]
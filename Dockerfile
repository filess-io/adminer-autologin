FROM adminer

WORKDIR /var/www/html
COPY files/autologin.php plugins
COPY files/index.php .

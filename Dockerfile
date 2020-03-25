FROM httpd:latest
COPY . /var/www
WORKDIR /var/www
RUN echo "<?php" > config.php


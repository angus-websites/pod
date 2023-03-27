
## Install PECL
RUN apt-get install -y php-pear php8.1-dev php8.1-xml
### Making sure we're using the correct php version
RUN rm /etc/alternatives/php
RUN ln -s /usr/bin/php8.1 /etc/alternatives/php


## MongoDB
RUN pecl install mongodb-1.13.0
RUN echo "extension=mongodb.so" | tee -a /etc/php/8.1/cli/conf.d/20-mongodb.ini

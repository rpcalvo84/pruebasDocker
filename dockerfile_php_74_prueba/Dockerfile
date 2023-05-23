#Para generar un contenedor a partir de esta imagen, se ejecuta:
## docker build . -t php_74_prueba
## donde:
### '.' es la ruta donde se encuentra este Dockerfile. Es decir, el comando se debe lanzar desde donde se encuentre este fichero
### '-t' es un parámetro que se utiliza para indicar el nombre del contendor donde se va a ejecutar la imagen
### 'php_74_prueba' es un nombre lo suficientemente descriptivo como para saber que esto lo hemos creado nosotros
#Para ver los cambios que hace docker build sobre la imagen en base a las instrucciones que se ponen aquí, se ejecuta (no sé si es muy útil):
## docker history php_74_prueba:latest
## y ahí se ve que a parte de las cosas que se especifican en el Dockerfile, se hacen otro chorro de cosas
FROM php:7.4-fpm

RUN apt-get -qq update 

#Git:
RUN apt-get install -y git

#Utilidades:
RUN apt-get install -y apt-utils unzip xmlsec1 vim wget libzip-dev libicu-dev g++ libmcrypt-dev libxml2-dev libbz2-dev libcurl4 libcurl4-gnutls-dev libssl-dev libpcre3-dev

RUN apt-get update -yqq && apt-get -y install build-essential 
#RUN docker-php-ext-configure intl && docker-php-ext-install intl pdo_mysql mysqli zip calendar pcntl bcmath exif soap xmlrpc bz2
#RUN apt-get update && apt-get install -y default-mysql-client mariadb-client
RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && apt-get install -y libvpx-dev libjpeg-dev libxpm-dev libpng-dev libfreetype6 libfreetype6-dev

#RabbitMQ:
# Para habilitar la extensión, he tenido que crear manualmente el fichero docker-php-ext-sockets.ini, 
# cosa que no recuerdo haber tenido que hacer con los otros .ini que hay en php_prueba_config_4docker
RUN apt-get update && \
    docker-php-ext-install sockets

#Oci8 (para oracle):
#RUN apt-get update -yqq && apt-get -y install build-essential libaio1 alien
#.. otras cosas .. (https://hub.docker.com/layers/sgadops/php-fpm-7.4/latest/images/sha256-160b2fe5c7aa47bd0951e451355c5140db3ba92cd88d5d23a742147b29d03423?context=explore)
#RUN curl https://pecl.php.net/get/oci8-2.2.0.tgz > /tmp/oci8.tgz     && tar -xzvf /tmp/oci8.tgz     && mv oci8-2.2.0 /usr/src/php/ext     && docker-php-ext-install oci8-2.2.0

#Xdebug:
##RUN curl https://xdebug.org/files/xdebug-2.9.4.tgz > /tmp/xdebug.tgz     && tar -xpzf /tmp/xdebug.tgz     && mv xdebug-2.9.4 /usr/src/php/ext     && docker-php-ext-install xdebug-2.9.4
RUN pecl install xdebug-3.1.2 && docker-php-ext-enable xdebug

#Redis:
#RUN curl https://pecl.php.net/get/redis-3.1.6.tgz > /tmp/redis.tgz     && tar -xpzf /tmp/redis.tgz     && mv redis-3.1.6 /usr/src/php/ext      && docker-php-ext-install redis-3.1.6

#Stomp (esto no se lo que es):
#RUN curl https://pecl.php.net/get/stomp-2.0.2.tgz > /tmp/stomp.tgz     && tar -xpzf /tmp/stomp.tgz     && mv stomp-2.0.2 /usr/src/php/ext     && docker-php-ext-install stomp-2.0.2

#Composer:
# No me gusta esta opción, simplemente por el directorio donde lo copia: #COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
##RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

#ldap:
#RUN apt-get update && apt-get install -y libldap-2.4-2 libsasl2-2 libldb-dev libldap2-dev     && ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so     && ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so     && docker-php-ext-configure ldap     && docker-php-ext-install ldap

#oauth:
#RUN curl https://pecl.php.net/get/oauth-2.0.5.tgz > /tmp/oauth.tgz     && tar -xpzf /tmp/oauth.tgz     && mv oauth-2.0.5 /usr/src/php/ext     &&  docker-php-ext-install oauth-2.0.5

#Mongo:
#RUN curl https://pecl.php.net/get/mongodb-1.3.4.tgz > /tmp/mongo.tgz     && tar -xpzf /tmp/mongo.tgz     && mv mongodb-1.3.4 /usr/src/php/ext     && docker-php-ext-install mongodb-1.3.4

#Kafka:
# Para habilitar la extensión, he tenido que crear manualmente el fichero docker-php-ext-rdkafka.ini, 
# igual que hice para habilitar la extensión de rabbitMq (aunque no con otras)
#RUN apt update && apt -y install php-pear 
RUN apt-get update && apt-get -y install librdkafka-dev
#RUN pecl install rdkafka
RUN git clone https://github.com/arnaud-lb/php-rdkafka.git \
	&& cd php-rdkafka \
	&& phpize \
	&& ./configure \
	&& make all -j 5 \
	&& make install

#locales (lo que sea, creo que de config de la region):
RUN apt-get -y install locales
RUN locale-gen es_ES.utf8
ENV LANG=es_ES.UTF-8
ENV LANGUAGE=es_ES

#Limpiar paquetes:
RUN apt-get -y purge

#EXPOSE 9000

WORKDIR /var/www/html


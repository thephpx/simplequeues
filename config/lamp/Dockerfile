FROM mattrayner/lamp:latest-1604-php7
RUN rm /etc/apache2/sites-available/000-default.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf 
RUN a2enmod headers
RUN service apache2 restart
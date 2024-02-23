# FROM php:7.4-apache
# COPY . /var/www/html/
# #RUN docker exec -it tickets_app_1 /bin/bash
# RUN apt-get update && apt-get install nano
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
# RUN echo "Listen 8000" >> /etc/apache2/apache2.conf
# #RUN a2enmod rewrite
# RUN service apache2 restart
# EXPOSE 8000

# FROM php:7.4-apache

# # Copy application files to container
# COPY . /var/www/html/

# # Install nano text editor
# RUN sudo apt-get update && sudo apt-get install -y nano

# # Set ServerName and Listen on port 8000
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
#     && echo "Listen 8000" >> /etc/apache2/apache2.conf

# RUN service apache2 restart


# # Expose port 8000
# EXPOSE 8000

# CMD ["bash", "-c", "service apache2 start && docker exec -it tickets_app_1 /bin/bash"]


FROM php:7.4-apache

# Copy application files to container
COPY . /var/www/html/

# Install nano text editor
RUN apt-get update && apt-get install -y nano \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql

# Copy the script into the container
COPY entrypoint.sh /entrypoint.sh

# Make the script executable
RUN chmod +x /entrypoint.sh

#COPY ./mysql_db.sql /docker-entrypoint-initdb.d/mysql_db.sql

# Set the entrypoint to execute the script
ENTRYPOINT ["/entrypoint.sh"]

# Expose port 8000
EXPOSE 8000


# FROM php:7.4-apache

# # Copy application files to container
# COPY . /var/www/html/

# # Install nano text editor
# RUN apt-get update && apt-get install -y nano

# # Set ServerName and Listen on port 8000
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
#     && echo "Listen 8000" >> /etc/apache2/ports.conf \
#     && a2enmod rewrite \
#     && service apache2 restart

# # Expose port 8000
# EXPOSE 8000

# # Start a bash shell and execute nano to edit the apache2.conf file
# CMD ["bash", "-c", "docker exec -it tickets_app_1 /bin/bash && nano /etc/apache2/apache2.conf && service apache2 restart"]

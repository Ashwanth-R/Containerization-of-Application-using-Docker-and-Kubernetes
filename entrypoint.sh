#!/bin/bash

# Start Apache
apachectl start

# Open a shell inside the container
/bin/bash -c "apt-get update && apt-get install -y nano && echo 'ServerName localhost' >> /etc/apache2/apache2.conf && echo 'Listen 8000' >> /etc/apache2/apache2.conf && service apache2 restart"

# Keep the container running
tail -f /dev/null


 
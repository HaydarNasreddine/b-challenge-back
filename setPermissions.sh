#!/bin/sh

chown -R ubuntu:www-data /home/ubuntu/project/bchallenge/
find /home/ubuntu/project/bchallenge -type f -exec chmod 664 {} \;
find /home/ubuntu/project/bchallenge -type d -exec chmod 775 {} \;
chgrp -R www-data /home/ubuntu/project/bchallenge/storage /home/ubuntu/project/bchallenge/bootstrap/cache
chmod -R ug+rwx /home/ubuntu/project/bchallenge/storage /home/ubuntu/project/bchallenge/bootstrap/cache

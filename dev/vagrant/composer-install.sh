#!/bin/bash

PATH=/usr/local/bin:/usr/bin:/usr/local/sbin:/usr/sbin

# If we don't do this, composer dump-autoload will fail:
#                                         
#  [ErrorException]                       
#  chdir(): Permission denied (errno 13)  
#                                         
cd /vagrant

for i in /vagrant/*/composer.json; do
    name=$(dirname $i)
    echo $name
    composer install -d $name -n -vvv --no-scripts
    composer dump-autoload -d $name -n -vvv
done

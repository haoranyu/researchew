#!/bin/bash

#Get composer from http://getcomposer.org/ - follow the installation instructions for your operating system.
#If you haven't installed composer globally, replace "composer" with "php composer.phar".

root_dir=`dirname $0`'/../../'
root_dir=`readlink -e $root_dir`
apps="laravel"
for app in $apps;do
    #composer create-project laravel/laravel $app --prefer-dist
    #sed -i '/lock/d' $app/.gitignore
    cd $root_dir"/$app"
    if [ -z "$1" ];then
        composer install
        chmod 777 -R app/storage
    else
        composer $1
    fi
done;
exit 0

#!/usr/bin/env bash

yum install -y openssl-devel libxml2-devel libxslt-devel perl-ExtUtils-Embed \
               GeoIP-devel gperftools-devel gd-devel nginx mariadb-server \
               mariadb redis hiredis hiredis-devel memcached memcached-devel \
               libmemcached libmemcached-devel
yum install -y --enablerepo="remi,remi-php56" \
                php56 php-cli php-devel \
                php-mysqlnd php-gd php-mcrypt php-pdo php-pear \
                php-pecl-sqlite php-pecl-memcache php-pecl-memcached \
                php-mbstring php-pecl-msgpack php-bcmath gd-last php-fpm

systemctl enable nginx
systemctl enable php-fpm
systemctl enable memcached
systemctl enable redis
systemctl enable mariadb

systemctl start nginx
systemctl start php-fpm
systemctl start memcached
systemctl start redis
systemctl start mariadb

mysqladmin -u root password vagrant
#sudo yum -y install expect
#expect -c "
#    set timeout 10
#    spawn mysql_secure_installation
#    expect \"Enter current password for root (enter for none):\"
#    send \"\r\"
#    expect \"Set root password\"
#    send \"y\r\"
#    expect \"Change the root password?\"
#    send \"y\r\"
#    expect \"New password:\"
#    send \"vagrant\r\"
#    expect \"Re-enter new password:\"
#    send \"vagrant\r\"
#    expect \"Remove anonymous users?\"
#    send \"y\r\"
#    expect \"Disallow root login remotely?\"
#    send \"y\r\"
#    expect \"Remove test database and access to it?\"
#    send \"y\r\"
#    expect \"Reload privilege tables now?\"
#    send \"y\r\"
#    expect eof
#"

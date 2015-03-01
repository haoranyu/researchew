#! /bin/bash
DIR="/var/www/"
if [ ! -d $DIR"phpmyadmin" ]; then
    echo "Installing phpmyadmin"
    wget https://codeload.github.com/phpmyadmin/phpmyadmin/tar.gz/RELEASE_4_3_2
    tar xf RELEASE_4_3_2 -C $DIR
    rm -f RELEASE_4_3_2
    cd $DIR
    mv phpmyadmin-RELEASE_4_3_2 phpmyadmin
    sed -i "s/\$cfg\['LoginCookieValidity'\]\s*=\s*1440/\$cfg\['LoginCookieValidity'\] = 14400/g"  phpmyadmin/libraries/config.default.php
    chmod 777 -R phpmyadmin
    chmod 777 -R /var/lib/php/session/
fi

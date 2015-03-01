#! /bin/bash
ssh -o UserKnownHostsFile=/dev/null \
    -o StrictHostKeyChecking=no \
    root@192.168.33.10 \
    'mount -t vboxsf -o uid=`id -u vagrant`,gid=`getent group vagrant | cut -d: -f3` vagrant /vagrant; systemctl reload nginx; systemctl reload php-fpm; systemctl restart supervisord.service'

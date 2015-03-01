#!/bin/bash
vagrant_ip='192.168.33.10'
host="root@$vagrant_ip"

#set -x
function daemon_mode {
    while true; do
        sleep 1000
        #check wether dir exists
        if (! ssh $host '[ -d /vagrant/laravel ]'); then 
            ssh $host \
                'mount -t vboxsf -o uid=`id -u vagrant`,gid=`getent group vagrant | cut -d: -f3` vagrant /vagrant; systemctl reload nginx; systemctl reload php-fpm; systemctl restart supervisord.service'
        fi;
    done
}

if [ ! -f ~/.ssh/id_rsa.pub ]; then
   ssh-keygen -t rsa
fi

if (! ssh $host -qo PasswordAuthentication=no -o ConnectTimeout=2 'exit'); then
    cat ~/.ssh/id_rsa.pub | ssh $host "mkdir -p ~/.ssh; cat >> ~/.ssh/authorized_keys; chmod 600 ~/.ssh/authorized_keys"
fi;

pkill -f $(basename $0)

daemon_mode </dev/null >/dev/null 2>&1 &
disown

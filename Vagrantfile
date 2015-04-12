# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # All Vagrant configuration is done here. The most common configuration
  # options are documented and commented below. For a complete reference,
  # please see the online documentation at vagrantup.com.

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "researchew"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network "forwarded_port", guest: 80, host: 80  # nginx
  config.vm.network "forwarded_port", guest: 8088, host: 8088  # phpmyadmin
  config.vm.network "forwarded_port", guest: 3306, host: 3306  # mysql
  #config.vm.network "forwarded_port", guest: 6379, host: 6379  # redis
  #config.vm.network "forwarded_port", guest: 11211, host: 11211  # memcached
  #config.vm.network "forwarded_port", guest: 11300, host: 11300  # beanstalkd

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # If true, then any SSH connections made will enable agent forwarding.
  # Default value: false
  # config.ssh.forward_agent = true

  config.ssh.pty = true

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder ".", "/vagrant", create: true

  config.vm.provider "virtualbox" do |vb|
    # Don't boot with headless mode
    #vb.gui = true
    vb.memory = 2048
    vb.cpus = 2

    # Use VBoxManage to customize the VM.
    #vb.customize ["modifyvm", :id, "--memory", "1024"]
    vb.customize ['modifyvm', :id, '--natdnshostresolver1', 'on']
    vb.customize ['modifyvm', :id, '--natdnsproxy1', 'on']
  end

  config.vm.provision :shell, path: 'dev/vagrant/nginx-concat.sh'

  #install phpmyadmin
  config.vm.provision :shell, path: 'dev/vagrant/phpmyadmin-install.sh'

  config.vm.provision :shell, inline: <<SCRIPT
    echo "Populating conf."

    # https://docs.vagrantup.com/v2/synced-folders/virtualbox.html
    sed -i '/sendfile \\+on/s/on/off/' /etc/nginx/nginx.conf

    for i in /vagrant/dev/vagrant/nginx/*.conf; do
      name=$(basename $i)
      echo "Copy $i -> /etc/nginx/conf.d/$name"
      /bin/cp --remove-destination $i /etc/nginx/conf.d
    done
    systemctl restart nginx.service

    rm -f /etc/php-fpm/*.researchew.com.conf
    for i in /vagrant/dev/vagrant/php-fpm/*.conf; do
      name=$(basename $i)
      echo "Copy $i -> /etc/php-fpm.d/$name"
      /bin/cp --remove-destination $i /etc/php-fpm.d
    done
    systemctl restart php-fpm.service

    if ! /usr/local/bin/composer &>/dev/null; then
      curl -sS https://getcomposer.org/installer | php
      mv composer.phar /usr/local/bin/composer
      chmod +x /usr/local/bin/composer
    elif expr $(date +%s) - $(stat -c %Y /usr/local/bin/composer) '>' 86400; then
      /usr/local/bin/composer self-update
    fi
SCRIPT

  config.vm.provision :shell, inline: <<NPMSCRIPT
  if ! npm version &>/dev/null; then
    yum install -y npm
  fi

NPMSCRIPT

  config.vm.provision :shell, privileged: false, inline: <<SCRIPT

    echo "Composer installing."

    # If there's composer command, whole outputs will disappear. Why???

    #runuser -u apache -- /vagrant/dev/vagrant/composer-install.sh

    for i in /vagrant/*/composer.json; do
      name=$(dirname $i)
      /usr/local/bin/composer install -d $name -n -v --prefer-dist --no-scripts
      php $name/artisan clear-compiled
      /usr/local/bin/composer dump-autoload -d $name -n -v
    done

SCRIPT

  config.vm.provision :shell, inline: <<HOSTSSCRIPT
  echo "manipulating /etc/hosts"
  if ! ruby --version &>/dev/null; then
    yum install -y ruby
  fi
  if ! env PATH=$PATH:/usr/local/bin ghost &>/dev/null; then
    gem install ghost
  fi
  env PATH=$PATH:/usr/local/bin ghost add researchew.com 127.0.0.1
HOSTSSCRIPT

  config.vm.provision :shell, inline: <<SCRIPT
    mkdir -p /var/log/researchew /data/code
    chown vagrant:vagrant /var/log/researchew /data/code -R

    if ! pip --version &>/dev/null; then
      echo "Installing pip"
      easy_install pip
    fi

SCRIPT

  config.vm.provision :shell, inline: <<SCRIPT
    cp -pf /vagrant/dev/vagrant/laravel-env.sh /etc/profile.d/laravel-env.sh
    mysql -uroot -pvagrant -e 'create database if not exists researchew'
SCRIPT

end

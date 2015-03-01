#!/usr/bin/env bash

mkdir /home/vagrant/.ssh
wget --no-check-certificate -O /home/vagrant/.ssh/authorized_keys 'https://github.com/mitchellh/vagrant/raw/master/keys/vagrant.pub'
chown -R vagrant:vagrant /home/vagrant/.ssh
chmod -R go-rwsx /home/vagrant/.ssh

mkdir -p /vagrant
chown vagrant:vagrant /vagrant

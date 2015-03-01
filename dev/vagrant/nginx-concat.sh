#!/bin/bash

args=$(nginx -V 2>&1 | grep ^configure | cut -d: -f2-)

if echo $args | grep nginx-http-concat > /dev/null; then
    echo "nginx-http-concat installed. skip."
    exit 0;
fi


yum install -y openssl-devel libxml2-devel libxslt-devel perl-ExtUtils-Embed GeoIP-devel gperftools-devel gd-devel

rm -rf nginx-*.src.rpm nginx-src nginx-http-concat/
yumdownloader --source nginx
git clone https://github.com/alibaba/nginx-http-concat.git

cmd="./configure $args --add-module=../../nginx-http-concat/"

mkdir nginx-src
(cd nginx-src/; rpm2cpio ../nginx-*.src.rpm | cpio -idmv)
nginxname=$(cd nginx-src/; ls nginx-*.tar.gz)
nginxname=${nginxname%\.tar\.gz}

(cd nginx-src/; tar xf $nginxname.tar.gz)
(cd nginx-src/$nginxname; eval $cmd; make -j4 && make install )

rm -rf nginx-*.src.rpm nginx-src nginx-http-concat/

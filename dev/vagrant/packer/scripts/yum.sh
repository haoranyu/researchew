#!/usr/bin/env bash

yum update -y --exclude='kernel*'

yum install -y ruby \
               python python-pip python-setuptools

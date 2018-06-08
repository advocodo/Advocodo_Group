#!/bin/bash

set -e
set -x

echo "START OF TEST.SH"

TRAVIS_TAG="v5.5.5"

if [ -z $TRAVIS_TAG ]; then
    TRAVIS_TAG="1.1.2"
else
    TRAVIS_TAG=$(echo $TRAVIS_TAG | cut -c2-)
fi


echo $TRAVIS_TAG

echo "END OF TEST.SH"

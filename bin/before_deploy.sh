#!/bin/bash

set -e
set -x

echo "================================================ INIT PACKING ================================================"

mkdir travis_release

# Get buildenv var
cd /tmp/mageteststand.* && BUILDENV=`pwd`

# Create folder
ls -lsha $BUILDENV/.modman
mkdir -p $BUILDENV/.modman/Advocodo_Group/var/connect/ #$BUILDENV/.modman/Advocodo_Group/var/downloader/


echo $TRAVIS_BUILD_DIR # /home/travis/build/advocodo/Advocodo_Group
ls -lsha $TRAVIS_BUILD_DIR

echo $BUILDENV
ls -lsha $BUILDENV

# Copy old .xml
cp -a $TRAVIS_BUILD_DIR/var/connect/* $BUILDENV/.modman/Advocodo_Group/var/connect/

# Set new version to xml
#$TRAVIS_BUILD_

# Run modman update to re-create these files under [magento]/var/connect folder as symlinks
cd $BUILDENV #&& ./tools/modman update Advocodo_Group

ls -lsha $BUILDENV/htdocs

echo "ENV: BUILDENV/htdocs/app/code/community/Advocodo/Group"
ls -lsha $BUILDENV/htdocs/app/code/community/Advocodo/Group

# Give rights and execute mage
cd $BUILDENV/htdocs && chmod +x mage
ls -lsha $BUILDENV/htdocs

cat /home/travis/build/advocodo/Advocodo_Group/var/connect/package.xml

# Build package
./mage package $TRAVIS_BUILD_DIR/var/connect/package.xml

ls -lsha $TRAVIS_BUILD_DIR/var/connect/

cp -a $TRAVIS_BUILD_DIR/var/connect/Advocodo_Group-*.tgz $TRAVIS_BUILD_DIR/travis_release

ls -lsha $TRAVIS_BUILD_DIR/travis_release

echo "================================================ PACKING DONE ================================================"

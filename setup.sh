#!/bin/sh

echo "[INFO] hello, training setup is starting"

WORKDIR=`pwd`
echo "[INFO] installing zip"
apt-get install zip -y

echo "[INFO] downloading drupal with drush to htdocs"
drush make drupal-training.make htdocs

echo "[INFO] copy training profiles"
cp -a $WORKDIR/code/profiles/ $WORKDIR/htdocs/profiles/

echo "[INFO] copy training modules"
mkdir -p $WORKDIR/htdocs/sites/all/modules/custom
cp -a $WORKDIR/code/modules/* $WORKDIR/htdocs/sites/all/modules/custom/

echo "[INFO] copy training themes"
cp -a $WORKDIR/code/themes/ $WORKDIR/htdocs/sites/all/themes/

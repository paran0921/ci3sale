#!/bin/sh
# ls -l gubun* | awk '{ print "cp -v ./"$9 "  ./product"substr($9,6) }' > multicopy.sh

cp -v ./gubun_add.php  ./product_add.php
cp -v ./gubun_edit.php  ./product_edit.php
cp -v ./gubun_list.php  ./product_list.php
cp -v ./gubun_view.php  ./product_view.php

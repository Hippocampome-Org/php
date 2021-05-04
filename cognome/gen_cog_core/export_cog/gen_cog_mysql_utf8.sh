#!/bin/bash
#
# This makes a copy of the full cognome db
# converted to mysql_utf8 for the cng server
#

ADDR="localhost"; # db address
FULL_DB="cognome";
FULL_DB_EXPORT="cognome.sql";
DB_MYSQL_UTF8="cognome_mysql_utf8"; # converted name
DB_MYSQL_UTF8_EXPORT="cognome_mysql_utf8.sql"; # converted export file
read -p "Please enter your MySQL username: " USER &&
read -sp "Please enter your MySQL password: " PASS &&

echo "" && # new line
echo "" && # new line
echo "Recreating database schema" &&
mysql -h $ADDR -u $USER -p$PASS $FULL_DB < create_mysql_utf8.sql &&

echo "" && # new line
echo "Exporting full Cognome" &&
mysqldump -h $ADDR -u $USER -p$PASS $FULL_DB > $FULL_DB_EXPORT &&

echo "" && # new line
echo "Importing full Cognome" &&
mysql -h $ADDR -u $USER -p$PASS $DB_MYSQL_UTF8 < $FULL_DB_EXPORT &&
rm $FULL_DB_EXPORT &&

echo "" && # new line
echo "Converting to MySQL UTF8 format" &&
mysql -h $ADDR -u $USER -p$PASS $DB_MYSQL_UTF8 < convert_to_utf8.sql &&

echo "" && # new line
echo "Exporting Converted Version" &&
mysqldump -h $ADDR -u $USER -p$PASS $DB_MYSQL_UTF8 > $DB_MYSQL_UTF8_EXPORT &&

echo "" && # new line
echo "Processing completed"
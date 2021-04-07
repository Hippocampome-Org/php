#!/bin/bash

ADDR="localhost"; # db address
DB="cognome_core"; # cognome core name
DB_EXPORT="cognome_core.sql"; # cognome core exported file name
FULL_DB="cognome"; # full cognome name
FULL_DB_EXPORT="full_cognome.sql"; # full cognome exported file name
read -p "Please enter your MySQL username: " USER &&
read -sp "Please enter your MySQL password: " PASS &&

echo "" && # new line
echo "" && # new line
echo "Recreating database schema" &&
mysql -h $ADDR -u $USER -p$PASS $DB < create_cog_core.sql &&

echo "" && # new line
echo "Exporting full Cognome" &&
mysqldump -h $ADDR -u $USER -p$PASS $FULL_DB > $FULL_DB_EXPORT &&

echo "" && # new line
echo "Importing full Cognome" &&
mysql -h $ADDR -u $USER -p$PASS $DB < $FULL_DB_EXPORT &&
rm $FULL_DB_EXPORT &&

echo "" && # new line
echo "Converting to MySQL UTF8 format" &&
mysql -h $ADDR -u $USER -p$PASS $DB < convert_to_utf8.sql &&

echo "" && # new line
echo "Building content removal scripts" &&
echo "Note: user must be signed into hippocampome site running on local server" &&
echo "" && # new line
php gen_sql.php &&

echo "" && # new line
echo "Removing content" &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_articles.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_authors.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_details.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_implementations.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_keywords.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_neurons.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_regions.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_scales.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_subjects.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_subjects_evi.sql &&
mysql -h $ADDR -u $USER -p$PASS $DB < remove_theories.sql &&

echo "" && # new line
echo "Updating properties" &&
mysql -h $ADDR -u $USER -p$PASS $DB < update_properties.sql &&

echo "" && # new line
echo "Exporting Cognome Core" &&
mysqldump -h $ADDR -u $USER -p$PASS $DB > $DB_EXPORT &&

echo "" && # new line
echo "Processing completed"
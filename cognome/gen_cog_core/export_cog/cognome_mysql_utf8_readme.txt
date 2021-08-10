Currently to convert cognome_core.sql to utf8 format needed for the cng server:

1. Manually drop and recreate blank database

2. For some reason since the addition of full text articles to the db it seems creating this
version of the db only works by manually running all of the steps in the gen_cog_mysql_utf8.sh
script by entering them into the command line. It is suspected that some text in the full text
material is causing an issue with utf8.

3. Manual text replacement in the cognome_core.sql file is needed with:
utf8mb3 --> utf8
utf8mb4 --> utf8
utf8_unicode_ci --> utf8_general_ci

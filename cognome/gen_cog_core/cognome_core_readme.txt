Currently to convert cognome_core.sql to utf8 format needed for the cng server:

1. Manaully drop and recreate blank database

2. The gen_cog_core.sh script will hang on the line "Using database: cognome_core..."
for a while but it normally will finish after that.

3. Manual text replacement in the cognome_core.sql file is needed with:
utf8mb3 --> utf8
utf8mb4 --> utf8
utf8_unicode_ci --> utf8_general_ci

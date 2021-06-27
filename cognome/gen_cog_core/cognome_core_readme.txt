Currently to convert cognome_core.sql to utf8 format needed for the cng server:

1. Manaully drop and recreate blank database

2. Manual text replacement in the cognome_core.sql file is needed with:
utf8mb3 --> uft8
utf8mb4 --> uft8
utf8_unicode_ci --> utf8_general_ci

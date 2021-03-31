use cognome_core_conv;
ALTER DATABASE cognome_core_conv CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_author CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_detail CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_implmnt CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_keyword CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_neuron CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_neuronfuzzy CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_region CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_scale CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_subject CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE article_has_theory CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE articles CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE authors CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE counters_db_id CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE details CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE dimensions CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_details CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_implmnts CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_keywords CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_neurons CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_regions CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_scales CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_subjects CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE evidence_of_theories CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE implementations CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE keywords CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE network_scales CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE neuron_types CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE properties CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE regions CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE subjects CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE theory_category CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE theory_has_competition CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE user CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
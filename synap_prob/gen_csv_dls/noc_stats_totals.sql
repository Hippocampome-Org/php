CREATE VIEW SynProNOCStatsTotals AS 
SELECT source_name, source_id, target_name, target_id,
CAST(number_of_contacts AS DECIMAL (5,2)) AS total
FROM number_of_contacts
WHERE number_of_contacts!='' AND number_of_contacts!=0 AND neurite LIKE '%:All:Both'
GROUP BY source_name, source_id, target_name, target_id limit 50000;
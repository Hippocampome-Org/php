CREATE VIEW SynProNOCStats AS 
SELECT source_name, source_id, target_name, target_id,
#CAST(AVG(number_of_contacts) AS DECIMAL(10,5)) AS avg,
CAST(SUM(number_of_contacts) AS DECIMAL (5,2)) AS total,
CAST(STD(number_of_contacts) AS DECIMAL(10,2)) AS std_noc, 
CAST(COUNT(number_of_contacts) AS DECIMAL(10,0)) AS count_noc
FROM number_of_contacts
WHERE number_of_contacts!='' AND number_of_contacts!=0 AND neurite NOT LIKE '%:All:Both'
GROUP BY source_name, source_id, target_name, target_id limit 50000;
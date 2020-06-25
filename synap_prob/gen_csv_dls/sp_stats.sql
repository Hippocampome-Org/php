CREATE VIEW SynProSPStats AS 
SELECT source_name, source_id, target_name, target_id,
CAST(AVG(probability) AS DECIMAL(10,5)) AS avg,
CAST(STD(probability) AS DECIMAL(10,5)) AS std_sp, 
CAST(COUNT(probability) AS DECIMAL(10,0)) AS count_sp
FROM number_of_contacts
WHERE probability!='' AND probability!=0 AND neurite NOT LIKE '%:All:Both'
GROUP BY source_name, source_id, target_name, target_id limit 50000;
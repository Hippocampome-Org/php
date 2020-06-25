CREATE VIEW SynProADLStats AS 
SELECT hippocampome_neuronal_class, unique_id, neurite, neurite_id, 
CAST(STD(CAST(filtered_total_length AS DECIMAL(10,2))) AS DECIMAL(10,2)) AS std_tl, 
CAST(AVG(CAST(filtered_total_length AS DECIMAL(10,2))) AS DECIMAL(10,2)) AS avg, 
CAST(COUNT(CAST(filtered_total_length AS DECIMAL(10,2))) AS DECIMAL(10,2)) AS count_tl
FROM neurite_quantified 
WHERE filtered_total_length!='' AND filtered_total_length!=0 AND neurite NOT LIKE '%:All:A'
AND neurite NOT LIKE '%:All:D'
GROUP BY neurite, hippocampome_neuronal_class limit 50000;
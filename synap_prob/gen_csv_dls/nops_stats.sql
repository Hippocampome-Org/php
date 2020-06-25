CREATE VIEW SynProNOPSStats AS 
SELECT source_name, source_id, target_name, target_id,
CAST(AVG(potential_synapses) AS DECIMAL(5,5)) AS nops_avg,
CAST(STD(potential_synapses) AS DECIMAL(5,5)) AS std_nops, 
CAST(COUNT(potential_synapses) AS DECIMAL(10,0)) AS count_nops
FROM potential_synapses
WHERE potential_synapses!='' AND potential_synapses!=0 AND neurite NOT LIKE '%:All:Both'
GROUP BY source_name, source_id, target_name, target_id limit 50000;
SELECT tr1.type_name as source_name, tr1.type_id as source_id, tr2.type_name as target_name, 
tr2.type_id as target_id, CP_mean_total as synaptic_probabilties_mean, 
CP_stdev_total as synaptic_probabilties_stdev
FROM SynproTypeTypeRel as tr1, SynproTypeTypeRel as tr2, SynproCPTotal as cp
WHERE tr1.type_id = cp.source_id
AND tr2.type_id = cp.target_id
ORDER BY tr1.id, tr2.id;
SELECT tr1.type_name as source_name, tr1.type_id as source_id, tr2.type_name as target_name, 
tr2.type_id as target_id, NPS_mean_total as number_of_potential_synapses_mean, 
NPS_stdev_total as number_of_potential_synapses_stdev, parcel_count
FROM SynproTypeTypeRel as tr1, SynproTypeTypeRel as tr2,SynproNPSTotal as nps
WHERE tr1.type_id = nps.source_id
AND tr2.type_id = nps.target_id
ORDER BY tr1.id, tr2.id;
SELECT tr1.type_name as source_name, tr1.type_id as source_id, tr2.type_name as target_name, 
tr2.type_id as target_id, NC_mean_total as number_of_contacts_mean, 
NC_stdev_total as number_of_contacts_stdev, parcel_count
FROM SynproTypeTypeRel as tr1, SynproTypeTypeRel as tr2, SynproNOCTotal as noc
WHERE tr1.type_id = noc.source_id
AND tr2.type_id = noc.target_id
ORDER BY tr1.id, tr2.id;
SELECT SynProSDStats.hippocampome_neuronal_class as neuron, unique_id, SynProSDStats.neurite as parcel, neurite_id,
SynProSDStats.`avg` as somatic_distance_avg, std_sd as somatic_distance_std, 
count_sd as somatic_distance_values_count,
min_sd as somatic_distance_min, max_sd as somatic_distance_max
FROM SynProSDStats, SynproTypeTypeRel, SynProNetlistParcels
WHERE SynProSDStats.unique_id=SynproTypeTypeRel.type_id
AND SynProSDStats.neurite=SynProNetlistParcels.parcel
ORDER BY SynproTypeTypeRel.id, SynProNetlistParcels.id;
SELECT 
    SynProSDStats.hippocampome_neuronal_class AS neuron,
    unique_id,
    SynProSDStats.neurite AS parcel,
    neurite_id,
    SynProSDStats.`avg` AS somatic_distance_avg,
    std_sd AS somatic_distance_std,
    count_sd AS somatic_distance_values_count,
    min_sd AS somatic_distance_min,
    max_sd AS somatic_distance_max
    #GROUP_CONCAT(DISTINCT SynProSDStats.hippocampome_neuronal_class) AS neuron,
    #GROUP_CONCAT(DISTINCT unique_id),
    #GROUP_CONCAT(DISTINCT SynProSDStats.neurite) AS parcel,
    #GROUP_CONCAT(DISTINCT neurite_id),
    #GROUP_CONCAT(DISTINCT SynProSDStats.`avg`) AS somatic_distance_avg,
    #GROUP_CONCAT(DISTINCT std_sd) AS somatic_distance_std,
    #GROUP_CONCAT(DISTINCT count_sd) AS somatic_distance_values_count,
    #GROUP_CONCAT(DISTINCT min_sd) AS somatic_distance_min,
    #GROUP_CONCAT(DISTINCT max_sd) AS somatic_distance_max    
FROM
    SynProSDStats,
    SynproTypeTypeRel,
    SynProNetlistParcels
WHERE
    SynProSDStats.unique_id = SynproTypeTypeRel.type_id
	AND SynProSDStats.neurite = SynProNetlistParcels.parcel
    #AND unique_id=4054
ORDER BY SynproTypeTypeRel.id , SynProNetlistParcels.id;
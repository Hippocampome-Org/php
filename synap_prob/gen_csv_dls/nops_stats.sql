CREATE VIEW SynProNOPSStats AS 
SELECT source_name, source_id, target_name, target_id,
CAST(potential_synapses AS DECIMAL (10 , 5 )) AS val
#FROM potential_synapses
#WHERE potential_synapses!='' AND potential_synapses!=0 AND neurite NOT LIKE '%:All:Both'
#GROUP BY source_name, source_id, target_name, target_id 
FROM
    number_of_contacts AS nc,
    SynproTypeTypeRel AS ttr
WHERE
        nc.source_id = ttr.type_id
        AND nc.potential_synapses != ''
        AND nc.neurite = CONCAT((SELECT 
                    subregion
                FROM
                    SynproTypeTypeRel
                WHERE
                    type_id = nc.source_id),
            ':All:Both') limit 500000;
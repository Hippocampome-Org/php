CREATE VIEW SynProSPStats AS
    SELECT 
        source_name,
        source_id,
        target_name,
        target_id,
        CAST(probability AS DECIMAL (10 , 5 )) AS val
#    FROM
#        number_of_contacts
#    WHERE
#        probability != '' AND probability != 0
#            AND neurite NOT LIKE '%:All:Both'
#    GROUP BY source_name , source_id , target_name , target_id
#    LIMIT 50000;
#
#SELECT 
#    CAST(probability AS DECIMAL (10 , 5 )) AS val
FROM
    number_of_contacts AS nc,
    SynproTypeTypeRel AS ttr
WHERE
		nc.source_id = ttr.type_id
        AND nc.probability != ''
        AND nc.neurite = CONCAT((SELECT 
                    subregion
                FROM
                    SynproTypeTypeRel
                WHERE
                    type_id = nc.source_id),
            ':All:Both') LIMIT 500000;
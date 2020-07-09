CREATE VIEW SynProNOCStats AS
    SELECT 
        source_name,
        source_id,
        target_name,
        target_id,
        CAST(number_of_contacts AS DECIMAL (5 , 2 )) AS val
#    FROM
#        number_of_contacts
#    WHERE
#        number_of_contacts != ''
#            AND number_of_contacts != 0
#            AND neurite NOT LIKE '%:All:Both'
#    GROUP BY source_name , source_id , target_name , target_id
#    LIMIT 50000;
#
#SELECT 
#    CAST(number_of_contacts AS DECIMAL (5 , 2 )) AS val
FROM
    number_of_contacts AS nc,
    SynproTypeTypeRel AS ttr
WHERE
		nc.source_id = ttr.type_id
        AND nc.number_of_contacts != ''
        AND nc.neurite = CONCAT((SELECT 
                    subregion
                FROM
                    SynproTypeTypeRel
                WHERE
                    type_id = nc.source_id),
            ':All:Both') LIMIT 50000;
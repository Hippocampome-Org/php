SELECT SynProNOCStats.source_name as source_name, source_id,
SynProNOCStats.target_name as target_name, target_id, 
SynProNOCStats.`val` as number_of_contacts
FROM SynProNOCStats, SynproTypeTypeRel as tt1, SynproTypeTypeRel as tt2
WHERE source_id = tt1.type_id AND target_id = tt2.type_id
ORDER BY tt1.id, tt2.id;
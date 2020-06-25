SELECT s2.source_name, s2.source_id, s2.target_name, s2.target_id, s2.total, s1.std_noc, s1.count_noc 
FROM SynProNOCStats as s1, SynProNOCStatsTotals as s2, SynproTypeTypeRel as tt1, SynproTypeTypeRel as tt2
WHERE s1.source_id = tt1.type_id AND s1.target_id = tt2.type_id
AND s2.source_id = tt1.type_id AND s2.target_id = tt2.type_id
AND s1.source_id = s2.source_id AND s2.target_id = s2.target_id
#AND source_id = 6094 AND target_id = 6095
ORDER BY tt1.id, tt2.id;
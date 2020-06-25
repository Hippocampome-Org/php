SELECT SynProNOPSStats.source_name as source_name, source_id, 
SynProNOPSStats.target_name as target_name, target_id,
nops_avg as number_of_potential_synapses_avg, 
std_nops AS number_of_potential_synapses_std, 
count_nops AS number_of_potential_synapses_value_count
FROM SynProNOPSStats, SynproTypeTypeRel as tt1, SynproTypeTypeRel as tt2
WHERE source_id = tt1.type_id AND target_id = tt2.type_id
ORDER BY tt1.id, tt2.id;
use cognome_core;

# remember: don't perminanty delete anything from the original cognome database.
# That might mess with ids, etc., in unwanted ways

# set anonymous access to 0 
UPDATE user SET `permission` = '0' WHERE (`id` = '2');

# neuron type changes
INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('8', '123');
DELETE FROM article_has_neuronfuzzy WHERE (`id` = '320');
DELETE FROM article_has_neuronfuzzy WHERE (`id` = '279');
UPDATE evidence_of_neurons SET `evidence_position` = 'N/A', `evidence_description` = 'N/A' WHERE (`id` = '138');

UPDATE evidence_of_neurons SET `evidence_position` = 'pg 1, 4', `evidence_description` = 'pg 4: The model contains a population of inhibitory neurons and a population of excitatory neurons.\npg 1: The model presented here focuses on stellate cells in layer 2 (L2SCs) and their indirect interactions through inhibitory interneurons. In the model, L2SCs and inhibitory interneurons are represented as distinct excitatory and inhibitory cell populations.' WHERE (`article_id` = '40');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('80', '123');
UPDATE evidence_of_neurons SET `evidence_position` = 'N/A', `evidence_description` = 'N/A' WHERE (`article_id` = '80');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('136', '123');
UPDATE evidence_of_neurons SET `evidence_position` = 'pg 1, 2', `evidence_description` = 'pg 1: we developed an interneuron network model based on experimentally determined properties\npg 2: Networks of fast-spiking inhibitory interneurons were modeled...\nNote: the article refered to simulated neurons generally as interneurons and therefore they were interpreted to represent that rather than any specific interneuron neuron type. Although experimentally-derived properties were used, the general interneuron description was interpreted as the intended types of neurons modeled.' WHERE (`article_id` = '136');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('137', '123');
UPDATE evidence_of_neurons SET `evidence_position` = 'pg 2', `evidence_description` = 'pg 2:...our neuron model displays two salient properties of hippocampal and neocortical fast-spiking interneurons.\nNote: the neurons were described as general fast-spiking interneurons and that was not a specific enough description to assign them a particular neuron type based on the neurons in hippocampome.org.' WHERE (`article_id` = '137');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('153', '123');
UPDATE evidence_of_neurons SET `evidence_position` = 'pg 1, 2', `evidence_description` = 'pg 1: In network models deduced from our data, feedback inhibition supports coexistence of theta-nested gamma oscillations with attractor states that generate grid firing fields.\npg 2: We recorded activity from neurons in layer II of the MEC in brain slices prepared from adult mice.\nNote: no specific neuron type was explicitly described as simulated.' WHERE (`article_id` = '153');

# remove extra neuron types
DELETE FROM neuron_types WHERE (`id` = '135');
DELETE FROM neuron_types WHERE (`id` = '134');
DELETE FROM neuron_types WHERE (`id` = '133');
DELETE FROM neuron_types WHERE (`id` = '132');
DELETE FROM neuron_types WHERE (`id` = '131');
DELETE FROM neuron_types WHERE (`id` = '130');
DELETE FROM neuron_types WHERE (`id` = '129');
DELETE FROM neuron_types WHERE (`id` = '128');
DELETE FROM neuron_types WHERE (`id` = '127');
DELETE FROM neuron_types WHERE (`id` = '126');
DELETE FROM neuron_types WHERE (`id` = '125');
DELETE FROM neuron_types WHERE (`id` = '124');

DELETE FROM regions WHERE (`id` = '9');
DELETE FROM regions WHERE (`id` = '8');
DELETE FROM regions WHERE (`id` = '7');

DELETE FROM subjects WHERE (`id` = '13');
DELETE FROM subjects WHERE (`id` = '10');
DELETE FROM subjects WHERE (`id` = '8');
DELETE FROM subjects WHERE (`id` = '9');
DELETE FROM subjects WHERE (`id` = '4');

DELETE FROM article_has_region WHERE (`region_id` = '7');
DELETE FROM article_has_region WHERE (`region_id` = '8');
DELETE FROM article_has_region WHERE (`region_id` = '9');

DELETE FROM article_has_neuron WHERE (`neuron_id` = '124');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '125');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '126');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '127');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '128');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '129');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '130');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '131');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '132');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '133');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '134');
DELETE FROM article_has_neuron WHERE (`neuron_id` = '135');

DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '124');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '125');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '126');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '127');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '128');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '129');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '130');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '131');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '132');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '133');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '134');
DELETE FROM article_has_neuronfuzzy WHERE (`neuron_id` = '135');

DELETE FROM article_has_subject WHERE (`article_id` = '435' AND `subject_id` = '8');
UPDATE evidence_of_subjects SET `evidence_description` = 'pg 4: This form of encoding, which we call sparse, random, conjunctive coding, produces sparsification directly through the choice of (a); it\r\nproduces separation effects comparable to values of R in the range of about 3-5, with smaller values of a corresponding to larger values of R.\r\npg 6: Because of the random relationship, the association between these patterns must be learned; but\r\nbecause it must be learned, it provides a potential locus for\r\ninterference among memory traces.\r\nNote: The recognition of letters was interpreted as sematic memory.' WHERE (`article_id` = '435');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('204', '123');
UPDATE evidence_of_neurons SET `evidence_position` = 'N/A', `evidence_description` = 'N/A' WHERE (`article_id` = '204');

UPDATE evidence_of_subjects SET `evidence_position` = 'pg 7', `evidence_description` = 'pg 7: In each network we stored 200 engrams with independent proximal inputs, to reflect DG pattern separation, but identical distal (EC) inputs, to model the limiting case of high memory similarity.\r\nNote: the pattern storage and retrieval in the simulation were interpreted as delarative memories with short-term memory processes.' WHERE (`article_id` = '411');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('214', '123');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('248', '123');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('255', '123');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('288', '123');
UPDATE evidence_of_subjects SET `evidence_position` = 'pg 3', `evidence_description` = 'pg 3: The main components of the system are sensory array (V), array of place cells (P), array of integrator cells (I), motion cells (M), and the head direction system; W stands for synaptic efficacy.
Note: specific cell types were not found to be described in the simulation.' WHERE (`article_id` = '288');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('319', '123');
UPDATE evidence_of_subjects SET `evidence_position` = 'pg 12, 13', `evidence_description` = 'pg 13: The parameters of the neurons were selected to reproduce the experimentally observed spiking properties of single cells in response to somatic current injections recorded in vitro.
pg 12: For the experiment conducted in Supplementary Fig. 7, an ipsilateral craniotomy targeting the CA1 region (-2.0 mm from bregma, 2.0 mm from the midline) was made for simultaneous CA3 + CA1 recordings.
pg 12: Following a brief protocol to assess the intrinsic properties of the recorded neuron, optical stimulation of mossy fibers was achieved by full-field illumination through a 60 x objective using 470-nm light with a pE-2 LED system (CoolLED Ltd. Andover, UK).
Note: although mossy fibers were mentioned, it did not seem that Granule cells were modeled by the simulation description, therefore they are not annotated here. The CA1 and CA3 neurons were not described as specific neuron types, only that in vivo properties were included, therefore no specific neuron type annotations were made with them. Also, the simulation described the neurons as only excitatory or inhibitory, and not specific types, and therefore it was interpreted that the general types were the intention of neuron representation in the simulation.' WHERE (`article_id` = '319');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('320', '123');

INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('345', '123');

UPDATE evidence_of_neurons SET `evidence_position` = 'pg 3, 7, 9', `evidence_description` = 'pg 3: Both synaptic potentiation and depression are applied probabilistically to reduce the rate at which stored memories are overwritten by the storage of more recent memories (Amit and Fusi, 1992, 1994).\r\nNote: the timing of memory storage was studied and interpreted to include short-term memories.\r\npg 7: In each network we stored 200 engrams with independent proximal inputs, to reflect DG pattern separation, but identical distal (EC) inputs, to model the limiting case of high memory similarity.\r\nNote: the memory similarities studied was interpreted as investigating semantic memories. This quote is additionally evidence of pattern separation as a subject.\r\npg 9: We thus see that this model-motivated entirely by considerations of circuit anatomy, nonlinear dendritic integration, and hippocampal memory function-accurately accounts for experimentally observed differences in the remapping properties of CA3 and CA1 place cells, as well as the differential importance of proximal and distal inputs to CA1 place field properties.\r\nNote: this is evidence of spatial memory as a subject.' WHERE (`article_id` = '411');

DELETE FROM details WHERE (`id` = '9');
DELETE FROM details WHERE (`id` = '5');
DELETE FROM details WHERE (`id` = '4');

DELETE FROM theory_category WHERE (`id` = '5');

DELETE FROM network_scales WHERE (`id` = '9');
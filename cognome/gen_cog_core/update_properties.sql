use cognome_core;

# neuron type changes
INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('8', '123');
DELETE FROM article_has_neuronfuzzy WHERE (`id` = '320');
DELETE FROM article_has_neuronfuzzy WHERE (`id` = '279');
UPDATE evidence_of_neurons SET `evidence_position` = 'N/A', `evidence_description` = 'N/A' WHERE (`id` = '138');

UPDATE evidence_of_neurons SET `evidence_position` = 'pg 1, 4', `evidence_description` = 'pg 4: The model contains a population of inhibitory neurons and a population of excitatory neurons.\npg 1: The model presented here focuses on stellate cells in layer 2 (L2SCs) and their indirect interactions through inhibitory interneurons. In the model, L2SCs and inhibitory interneurons are represented as distinct excitatory and inhibitory cell populations.' WHERE (`article_id` = '40');

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
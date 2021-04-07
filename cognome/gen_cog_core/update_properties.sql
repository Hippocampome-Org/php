use cognome_core;

# neuron type changes
INSERT INTO article_has_neuron (`article_id`, `neuron_id`) VALUES ('8', '123');
DELETE FROM article_has_neuronfuzzy WHERE (`id` = '320');
DELETE FROM article_has_neuronfuzzy WHERE (`id` = '279');
UPDATE evidence_of_neurons SET `evidence_position` = 'N/A', `evidence_description` = 'N/A' WHERE (`id` = '138');

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

DELETE FROM article_has_region WHERE (`id` = '7');
DELETE FROM article_has_region WHERE (`id` = '8');
DELETE FROM article_has_region WHERE (`id` = '9');
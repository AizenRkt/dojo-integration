INSERT INTO cours (label) VALUES
('Karate debutant'),
('Karate avance'),
('Judo intermediaire'),
('Aïkido tous niveaux'),
('Taekwondo enfants'),
('Self-defense adultes'),
('Yoga martial'),
('Muay Thaï competiteur');

INSERT INTO genre (label) VALUES ('Homme'), ('Femme');

INSERT INTO admin (nom, prenom, contact, email)
VALUES ('Admin', 'Principal', '0123456789', 'admin@dojo.com');


INSERT INTO login (username, mot_de_passe, role, id_personnel)
VALUES (
  'superviseur',
  'mdp2',
  'superviseur',
  2
);

INSERT INTO login (username, mot_de_passe, role, id_personnel)
VALUES (
  'prof',
  'mdp2',
  'prof',
  1
);

INSERT INTO login (username, mot_de_passe, role, id_personnel)
VALUES (
  'admin',
  'mdp2',
  'admin',
  3
);

INSERT INTO personnel (nom, prenom, date_naissance, adresse, contact, id_genre, type_personnel)
VALUES
  ('Rakoto', 'Jean', '1990-05-12', 'Lot II F 45 Antananarivo', '0321234567', 1, 'professeur'),
  ('Randrianarivelo', 'Sahondra', '1985-11-23', 'Ambatonakanga, Tana', '0339876543', 2, 'admin'),
  ('Rasoanaivo', 'Michel', '1978-01-30', 'Analamahitsy', '0348765432', 1, 'professeur'),
  ('Rajaonarivelo', 'Noro', '1993-09-10', 'Ambohijatovo', '0325567788', 2, 'superviseur');
-- Remplacez 1 et 3 par les vrais ID si générés dynamiquement
INSERT INTO prof (id_prof)
VALUES
  (1),  -- Rakoto Jean
  (3);  -- Rasoanaivo Michel
INSERT INTO evolution (id_prof, id_eleve, avis, note, date_evolution) VALUES
(1, 1, 'Très bon travail, continuez ainsi !', 4, '2025-01-01'),
(1, 2, 'Des progrès notables, peut encore améliorer la concentration', 4, '2025-02-02'),
(3, 3, 'Excellent en maths, doit travailler son français', 3, '2025-03-03'),
(3, 4, 'Participation active en cours, résultats en hausse', 4, '2025-04-04'),
(1, 5, 'Bon potentiel mais travail irrégulier', 2, '2025-05-05'),
(3, 1, 'Très créatif, excellente approche des problèmes', 4, '2025-06-06'),
(1, 3, 'Doit revoir certaines bases en sciences', 3, '2025-07-07');

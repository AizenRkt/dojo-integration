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


INSERT INTO login (username, mot_de_passe, role)
VALUES (
  'superviseur',
  'mdp2',
  'superviseur'
);

INSERT INTO login (username, mot_de_passe, role)
VALUES (
  'prof',
  'mdp2',
  'prof'
);

INSERT INTO login (username, mot_de_passe, role)
VALUES (
  'admin',
  'mdp2',
  'admin'
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
(1, 1, 'Bon potentiel mais travail irrégulier', 2, '2025-05-05'),
(3, 2, 'Très créatif, excellente approche des problèmes', 4, '2025-06-06'),
(1, 3, 'Doit revoir certaines bases en sciences', 3, '2025-07-07');



INSERT INTO gestion_taxe (taux_tva, date_application)
VALUES (20.00, '2024-07-09 08:00:00');

-- Élève 1 : Inscrit en janvier 2023
INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, date_inscription, id_genre)
VALUES (
    'Rakoto', 
    'Jean', 
    '2010-05-15', 
    'Lot II A 123 Bis, Antananarivo', 
    '0341234567', 
    '2023-01-10 09:30:00', 
    1  -- id_genre pour Masculin
);

-- Élève 2 : Inscrit en mars 2023
INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, date_inscription, id_genre)
VALUES (
    'Rasoa', 
    'Marie', 
    '2012-08-22', 
    'Lot VF 45, Antsirabe', 
    '0329876543', 
    '2023-03-15 14:15:00', 
    2  -- id_genre pour Féminin
);

-- Élève 3 : Inscrit en septembre 2023
INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, date_inscription, id_genre)
VALUES (
    'Randria', 
    'Paul', 
    '2000-11-30', 
    'Rue du Commerce 12, Fianarantsoa', 
    '0334567890', 
    '2023-09-05 10:45:00', 
    1
);

-- Élève 4 : Inscrit en décembre 2023
INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, date_inscription, id_genre)
VALUES (
    'Andriamalala', 
    'Sofia', 
    '2011-03-18', 
    'Ampasamadinika, Toamasina', 
    '0387654321', 
    '2023-12-20 08:00:00', 
    2
);

-- Élève 5 : Inscrit en avril 2024
INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, date_inscription, id_genre)
VALUES (
    'Ravelojaona', 
    'Tiana', 
    '2013-07-25', 
    'Ankadifotsy, Antananarivo', 
    '0345678912', 
    '2024-04-02 11:20:00', 
    2
);

SELECT 
    mois,
    annee,
    SUM(montant) AS montant_total,
    ARRAY_AGG(TO_CHAR(date_paiement, 'DD/MM/YYYY HH24:MI')) AS dates_paiement,
    ARRAY_AGG(statut) AS statuts
FROM ecolage WHERE id_eleve = 4 GROUP BY annee, mois ORDER BY annee DESC, mois DESC;

SELECT 
                    mois,
                    annee,
                    SUM(montant) AS montant_total,
                    ARRAY_AGG(TO_CHAR(date_paiement, 'DD/MM/YYYY HH24:MI')) AS dates_paiement,
                    ARRAY_AGG(statut) AS statuts
                FROM ecolage
                WHERE id_eleve = 4
                GROUP BY annee, mois
                ORDER BY annee DESC, mois DESC;
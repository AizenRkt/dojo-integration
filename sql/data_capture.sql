-- 1. Insertion du personnel de type 'prof'
INSERT INTO personnel (nom, prenom, date_naissance, adresse, contact, id_genre, type_personnel) VALUES
('Rakoto', 'Prof1', '1980-01-01', 'Tana', '0341110001', 1, 'prof'),
('Rabe', 'Prof2', '1985-02-02', 'Tana', '0341110002', 1, 'prof'),
('Randria', 'Prof3', '1990-03-03', 'Tana', '0341110003', 1, 'prof'),
('Razanaka', 'Prof4', '1982-04-04', 'Tana', '0341110004', 1, 'prof'),
('Rala', 'Prof5', '1987-05-05', 'Tana', '0341110005', 1, 'prof');

-- 2. Ajout des profs dans la table prof (en supposant que prof.id_prof = personnel.id_personnel)
INSERT INTO prof (id_prof)
SELECT id_personnel FROM personnel WHERE type_personnel = 'prof';

-- 3. Insertion des élèves
INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, id_genre) VALUES
('Rakoto', 'Jean', '2010-05-01', 'Antananarivo', '0341000001', 1),
('Rasoa', 'Marie', '2009-07-15', 'Fianarantsoa', '0341000002', 2),
('Andry', 'Hery', '2011-03-22', 'Toamasina', '0341000003', 1),
('Rabe', 'Tiana', '2008-10-09', 'Mahajanga', '0341000004', 2),
('Rajaona', 'Luc', '2010-12-03', 'Antsirabe', '0341000005', 1),
('Rahari', 'Lova', '2012-01-19', 'Toliara', '0341000006', 2),
('Rakotobe', 'Koto', '2009-11-25', 'Antananarivo', '0341000007', 1),
('Randria', 'Fanja', '2010-06-30', 'Fianarantsoa', '0341000008', 2),
('Ranaivo', 'Joel', '2011-02-14', 'Toamasina', '0341000009', 1),
('Andriama', 'Lina', '2008-08-17', 'Mahajanga', '0341000010', 2),
('Rasoanaivo', 'Lala', '2010-09-23', 'Antsirabe', '0341000011', 2),
('Rakotonirina', 'Soa', '2009-04-10', 'Antananarivo', '0341000012', 2),
('Randriamanana', 'Niry', '2011-12-20', 'Toliara', '0341000013', 1),
('Andrianina', 'Miora', '2008-03-28', 'Fianarantsoa', '0341000014', 2),
('Ando', 'Hasina', '2009-06-16', 'Toamasina', '0341000015', 1),
('Harifetra', 'Manoa', '2012-07-04', 'Mahajanga', '0341000016', 1),
('Fidy', 'Ketaka', '2011-11-11', 'Antsirabe', '0341000017', 2),
('Mamy', 'Tahina', '2010-01-02', 'Antananarivo', '0341000018', 1),
('Lalao', 'Voahirana', '2008-05-29', 'Toliara', '0341000019', 2),
('Solo', 'Tina', '2009-09-18', 'Fianarantsoa', '0341000020', 1);

-- 4. Insertion des cours
INSERT INTO cours (label) VALUES
('Karaté'),
('Judo'),
('Taekwondo'),
('Boxe'),
('Aïkido');

-- 5. Insertion des séances (en supposant que les id_prof vont de 1 à 5, et id_plage de 1 à 4 existent)
INSERT INTO seances_cours (id_cours, date, id_plage, id_prof) VALUES
(1, '2025-07-01', 1, 1),
(2, '2025-07-01', 2, 2),
(3, '2025-07-02', 3, 3),
(4, '2025-07-02', 4, 4),
(5, '2025-07-03', 1, 5),
(1, '2025-07-04', 2, 1),
(2, '2025-07-04', 3, 2),
(3, '2025-07-05', 4, 3),
(4, '2025-07-06', 1, 4),
(5, '2025-07-06', 2, 5);

-- 6. Présence des élèves aux séances
INSERT INTO presence (id_eleve, id_seances, present, remarque) VALUES
(1, 1, TRUE, NULL),
(2, 1, TRUE, NULL),
(3, 2, TRUE, NULL),
(4, 3, FALSE, 'Absence justifiée'),
(5, 3, TRUE, NULL),
(6, 4, TRUE, NULL),
(7, 5, TRUE, NULL),
(8, 6, TRUE, NULL),
(9, 6, TRUE, NULL),
(10, 7, FALSE, NULL),
(11, 8, TRUE, NULL),
(12, 8, TRUE, NULL),
(13, 9, TRUE, NULL),
(14, 9, TRUE, NULL),
(15, 10, TRUE, NULL),
(16, 10, TRUE, NULL),
(17, 1, TRUE, NULL),
(18, 2, TRUE, NULL),
(19, 3, TRUE, NULL),
(20, 4, TRUE, NULL);

-- 7. Paiements d'écolage
INSERT INTO ecolage (id_eleve, montant, date_paiement, mois, annee, statut) VALUES
(1, 50000, '2025-07-01', 7, 2025, 'paye'),
(2, 50000, '2025-07-02', 7, 2025, 'paye'),
(3, 50000, '2025-07-03', 7, 2025, 'paye'),
(4, 50000, '2025-07-04', 7, 2025, 'non paye'),
(5, 50000, '2025-07-05', 7, 2025, 'en retard'),
(6, 50000, '2025-07-01', 7, 2025, 'paye'),
(7, 50000, '2025-07-01', 7, 2025, 'paye'),
(8, 50000, '2025-07-01', 7, 2025, 'paye'),
(9, 50000, '2025-07-01', 7, 2025, 'non paye'),
(10, 50000, '2025-07-01', 7, 2025, 'paye'),
(11, 50000, '2025-07-01', 7, 2025, 'paye'),
(12, 50000, '2025-07-01', 7, 2025, 'paye'),
(13, 50000, '2025-07-01', 7, 2025, 'en retard'),
(14, 50000, '2025-07-01', 7, 2025, 'paye'),
(15, 50000, '2025-07-01', 7, 2025, 'paye'),
(16, 50000, '2025-07-01', 7, 2025, 'paye'),
(17, 50000, '2025-07-01', 7, 2025, 'paye'),
(18, 50000, '2025-07-01', 7, 2025, 'paye'),
(19, 50000, '2025-07-01', 7, 2025, 'non paye'),
(20, 50000, '2025-07-01', 7, 2025, 'annule');

-- 8. Abonnements (en supposant que id_club = id_eleve ici)
INSERT INTO abonnement (id_club, jour, mois, annee, actif) VALUES
(1, 1, 7, 2025, TRUE),
(2, 2, 7, 2025, TRUE),
(3, 3, 7, 2025, TRUE),
(4, 4, 7, 2025, TRUE),
(5, 5, 7, 2025, TRUE),
(6, 6, 7, 2025, TRUE),
(7, 7, 7, 2025, TRUE),
(8, 8, 7, 2025, TRUE),
(9, 9, 7, 2025, TRUE),
(10, 10, 7, 2025, TRUE),
(11, 11, 6, 2025, FALSE),
(12, 12, 6, 2025, FALSE),
(13, 13, 6, 2025, FALSE),
(14, 14, 6, 2025, FALSE),
(15, 15, 6, 2025, FALSE),
(16, 16, 6, 2025, TRUE),
(17, 17, 6, 2025, TRUE),
(18, 18, 6, 2025, TRUE),
(19, 19, 6, 2025, TRUE),
(20, 20, 6, 2025, TRUE);
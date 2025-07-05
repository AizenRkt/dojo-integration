INSERT INTO cours (label) VALUES
('Karaté débutant'),
('Karaté avancé'),
('Judo intermédiaire'),
('Aïkido tous niveaux'),
('Taekwondo enfants'),
('Self-défense adultes'),
('Yoga martial'),
('Muay Thaï compétiteur');


-- Insérer des données de test pour les réservations
INSERT INTO reservation (id_club, date_reserve, heure_debut, heure_fin, valeur) VALUES
    (1, '2025-01-15', '08:00', '10:00', 'confirme'),
    (2, '2025-01-15', '14:00', '16:00', 'confirme'),
    (1, '2025-01-16', '10:30', '12:00', 'confirme'),
    (2, '2025-01-17', '16:30', '18:00', 'confirme'),
    (1, '2025-01-20', '08:00', '10:00', 'demande'),
    (2, '2025-01-22', '18:30', '20:00', 'confirme');

INSERT INTO club_groupe (nom_responsable, contact, nombre)
VALUES ('Rakoto Jean', '0341234567', 15);

INSERT INTO club_groupe (nom_responsable, contact, nombre)
VALUES ('Rasolonjatovo Lova', '0339876543', 10);

INSERT INTO genre (label) VALUES ('Homme'), ('Femme');

INSERT INTO prof (nom, prenom, date_naissance, adresse, contact, id_genre) VALUES
   ('Rakoto', 'Jean', '1980-01-01', 'Antananarivo', '0321123456', 1),
   ('Rabe', 'Pauline', '1985-06-15', 'Fianarantsoa', '0321987654', 2);

-- 3. Élèves
INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, id_genre) VALUES
    ('Andrianina', 'Sarah', '2010-04-12', 'Antsirabe', '0341122334', 2),
    ('Ravelo', 'Marc', '2009-08-23', 'Mahajanga', '0334455667', 1),
    ('Rakotovao', 'Lova', '2011-11-01', 'Toamasina', '0339988776', 1),
    ('Rasoa', 'Miora', '2010-02-18', 'Toliara', '0322345678', 2);

-- 5. Paiement ecolage pour affectation des groupes (ex. Juin 2025)
INSERT INTO ecolage (id_eleve, montant, date_paiement, mois, annee) VALUES
    (1, 30000, '2025-07-01', 7, 2025),
    (2, 30000, '2025-06-02', 6, 2025),
    (3, 30000, '2025-06-03', 6, 2025),
    (4, 30000, '2025-06-03', 6, 2025);

SELECT
    r.date_reserve,
    r.heure_debut,
    r.heure_fin,
    g.nom_responsable as group_name,
    g.discipline,
    g.nombre as participants
FROM reservation r
         JOIN club_groupe g ON r.id_club = g.id
WHERE r.date_reserve BETWEEN '25-01-01' AND '25-01-31'
  AND r.valeur = 'confirme'
ORDER BY r.date_reserve, r.heure_debut;
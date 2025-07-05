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
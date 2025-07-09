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
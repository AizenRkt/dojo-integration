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
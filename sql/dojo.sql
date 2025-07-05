-- Type ENUM
CREATE TYPE etat AS ENUM ('neuve', 'usee', 'abimee');
CREATE TYPE paiement_statut AS ENUM ('paye', 'en_retard', 'annule'); --Mbl tsy teo
CREATE TYPE statut AS ENUM ('cree','modifie','annule');
CREATE TYPE statut_ecolage AS ENUM ( /* Wanda - update 29-06-25 */
  'non paye',
  'paye',
  'en retard',
  'annule',
  'en attente'
);

-- Tables principales
CREATE TABLE genre (
  id_genre SERIAL PRIMARY KEY,
  label VARCHAR
);

CREATE TABLE superviseur (
  id_superviseur SERIAL PRIMARY KEY,
  nom VARCHAR,
  prenom VARCHAR,
  date_naissance TIMESTAMP,
  adresse VARCHAR,
  contact VARCHAR,
  id_genre INTEGER REFERENCES genre(id_genre)
);

CREATE TABLE prof (
  id_prof SERIAL PRIMARY KEY,
  nom VARCHAR,
  prenom VARCHAR,
  date_naissance TIMESTAMP,
  adresse VARCHAR,
  contact VARCHAR,
  id_genre INTEGER REFERENCES genre(id_genre)
);

CREATE TABLE eleve (
  id_eleve SERIAL PRIMARY KEY,
  nom VARCHAR,
  prenom VARCHAR,
  date_naissance TIMESTAMP,
  adresse VARCHAR,
  contact VARCHAR,
  date_inscription TIMESTAMP, /* Wanda - update 29-06-25 */
  id_genre INTEGER REFERENCES genre(id_genre)
);

CREATE TABLE parent (
  id_parent SERIAL PRIMARY KEY,
  nom VARCHAR,
  prenom VARCHAR,
  contact VARCHAR,
  adresse VARCHAR
);

CREATE TABLE parent_eleve (
  id SERIAL PRIMARY KEY,
  id_parent INTEGER REFERENCES parent(id_parent),
  id_eleve INTEGER REFERENCES eleve(id_eleve)
);


-- Matériel et suivi : Dylan modification (28-06-25)

CREATE TABLE materiel_type (
   id_type     SERIAL PRIMARY KEY,
   reference   VARCHAR(50) UNIQUE NOT NULL,
   label       VARCHAR(255) NOT NULL,
   description TEXT
);

ALTER TABLE materiel_type
    ADD COLUMN prix NUMERIC(10,2) DEFAULT 0; -- Dylan modification (29-06-25)


CREATE TABLE materiel_item (
   id_item    SERIAL PRIMARY KEY,
   id_type    INTEGER NOT NULL
       REFERENCES materiel_type(id_type)
           ON DELETE CASCADE,
   num_serie  VARCHAR(100) UNIQUE,
   etat       etat NOT NULL DEFAULT 'neuve'
);

CREATE TABLE stock_materiel (
    id_suivi        SERIAL PRIMARY KEY,
    id_type         INTEGER NOT NULL
        REFERENCES materiel_type(id_type)
            ON DELETE RESTRICT,
    type_mouvement  CHAR(1) NOT NULL             -- 'I' pour entrée, 'O' pour sortie
        CHECK (type_mouvement IN ('I','O')),
    quantite        INTEGER NOT NULL CHECK (quantite > 0),
    date            TIMESTAMP NOT NULL DEFAULT now()
);

CREATE TYPE etat_suivi AS ENUM ('disponible','endommage');

CREATE TABLE club_groupe (
     id SERIAL PRIMARY KEY,
     nom_responsable VARCHAR,
     contact VARCHAR,
     nombre INTEGER
);
CREATE TABLE suivi_salle (
     id_suivi_salle SERIAL PRIMARY KEY,
    id_club integer references club_groupe(id),
     id_superviseur   INTEGER NOT NULL
         REFERENCES superviseur(id_superviseur)
             ON DELETE RESTRICT,
     id_item          INTEGER NOT NULL
         REFERENCES materiel_item(id_item)
             ON DELETE CASCADE,
     date             TIMESTAMP NOT NULL DEFAULT now(),
     description      TEXT,
     etat             etat_suivi NOT NULL DEFAULT 'disponible'
);
 --Dylan modification (29-06-25)

CREATE TABLE facture_materiel (
      id_facture SERIAL PRIMARY KEY,
      id_suivi_salle INTEGER REFERENCES suivi_salle(id_suivi_salle) UNIQUE,
      date TIMESTAMP DEFAULT NOW(),
      destinataire VARCHAR(255),  -- nom club ou superviseur
      montant NUMERIC(10,2)
);
ALTER TABLE facture_materiel ADD COLUMN est_paye BOOLEAN DEFAULT FALSE;


UPDATE materiel_type
SET prix = 45000.00
WHERE id_type = 1;

INSERT INTO materiel_type (reference, label, description, prix)
VALUES ('TAP-001', 'Tapis de sol', 'Tapis antidérapant pour arts martiaux', 35000.00);


-- Dylan modification (28-06-25)

CREATE TABLE historique_garde (
  id_historique SERIAL PRIMARY KEY,
  id_superviseur INTEGER REFERENCES superviseur(id_superviseur),
  date DATE,
  heure TIMESTAMP
);


-- Cours
CREATE TABLE cours (
  id_cours SERIAL PRIMARY KEY,
  label VARCHAR
);

CREATE TABLE plage_horaire (
    id SERIAL PRIMARY KEY,
    heure_debut TIME UNIQUE,
    heure_fin TIME UNIQUE
);

INSERT INTO plage_horaire (heure_debut, heure_fin) VALUES
    ('08:00', '10:00'),
    ('10:00', '12:00'),
    ('13:00', '15:00'),
    ('15:00', '17:00');

CREATE TABLE maximum (
     nombre_eleve_cours INTEGER,
     nombre_eleve INTEGER
);

-- Clubs


CREATE TABLE seances_cours (
   id_seances SERIAL PRIMARY KEY,
   id_cours INTEGER REFERENCES cours(id_cours),
   date DATE,
   id_plage INTEGER REFERENCES plage_horaire(id),
   id_prof INTEGER REFERENCES prof(id_prof)
--    heure_debut TIME,
--    heure_fin TIME
);

CREATE TABLE historique_seances (
  id_historique SERIAL PRIMARY KEY,
  id_seances INTEGER REFERENCES seances_cours(id_seances),
  date DATE,
  statut statut
);

CREATE TYPE valeur AS ENUM ('demande', 'confirme', 'payee', 'annule');


CREATE TABLE status (
    id_status SERIAL PRIMARY KEY,
    id_reservation INTEGER REFERENCES reservation(id_reservation),
    valeur valeur
);

CREATE TABLE ecolage (
  id_ecolage SERIAL PRIMARY KEY,
  id_eleve INTEGER REFERENCES eleve(id_eleve),
  montant FLOAT,
  date_paiement TIMESTAMP,
  mois INTEGER,
  annee INTEGER,
  statut statut_ecolage DEFAULT 'non_payé' /* Wanda - update 29-06-25 */
);


CREATE TABLE reservation (
  id_reservation SERIAL PRIMARY KEY,
  id_club INTEGER REFERENCES club_groupe(id),
  date_reservation TIMESTAMP,
  date_reserve TIMESTAMP,
  heure_debut TIME,
  heure_fin TIME
);

-- CREATE TABLE paiement (
--   id_payement SERIAL PRIMARY KEY, -- Jhoanito id_paiement
--   id_groupe INTEGER REFERENCES club_groupe(id),
--   montant FLOAT,
--   date_paiement TIMESTAMP
-- );

CREATE TABLE paiement (
  id_payement SERIAL PRIMARY KEY,
  id_reservation INTEGER REFERENCES reservation(id_reservation), /* Wanda - update 29-06-25 */
  montant FLOAT,
  date_paiement TIMESTAMP
);

CREATE TABLE tarif_ecolage (
  id_tarif SERIAL PRIMARY KEY,
  montant FLOAT,
  adult BOOLEAN
);

CREATE TABLE tarif_club (
  id_tarif SERIAL PRIMARY KEY,
  montant_par_heure FLOAT
);

CREATE TABLE abonnement (
  id_abonnement SERIAL PRIMARY KEY,
  id_club INTEGER REFERENCES club_groupe(id),
  jour INTEGER,
  mois INTEGER,
  annee INTEGER,
  actif BOOLEAN
);
ALTER table abonnement ADD COLUMN annee INTEGER; -- 03/07/25 modif Jhoanito

-- modif Jhoanito
CREATE TABLE evolution (
  id_prof INTEGER REFERENCES prof(id_prof) ON DELETE RESTRICT,
  id_eleve INTEGER REFERENCES eleve(id_eleve) ON DELETE CASCADE,
  avis TEXT,
  PRIMARY KEY (id_prof, id_eleve) -- Clé primaire composite
);

CREATE TABLE tarif_abonnement (
  id_tarif SERIAL PRIMARY KEY, -- Ajout d'une clé primaire
  montant NUMERIC(10,2) NOT NULL
);

-- Index pour optimiser les requêtes de reporting
CREATE INDEX idx_ecolage_date_paiement ON ecolage(date_paiement);
CREATE INDEX idx_ecolage_mois_annee ON ecolage(mois, annee);
CREATE INDEX idx_abonnement_mois_annee ON abonnement(mois, annee);
CREATE INDEX idx_abonnement_actif ON abonnement(actif);
CREATE INDEX idx_seances_cours_date ON seances_cours(date);
CREATE INDEX idx_seances_cours_id_cours ON seances_cours(id_cours);
CREATE INDEX idx_historique_seances_id_seances ON historique_seances(id_seances);

-- Créer la table gestion_groupe
CREATE TABLE gestion_groupe (
    id SERIAL PRIMARY KEY,
    id_eleve INTEGER REFERENCES eleve(id_eleve),
    mois INTEGER,
    annee INTEGER,
    groupe INTEGER,
    UNIQUE (id_eleve, mois, annee)
);

-- Créer la table planification_cours
CREATE TABLE planification_cours (
    id SERIAL PRIMARY KEY,
    id_seance INTEGER REFERENCES seances_cours(id_seances),
    groupe INTEGER,
    UNIQUE (id_seance, groupe)
);

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
-- Type ENUM
\c postgres;
   Drop DATABASE IF EXISTS dojo_integration;
    CREATE DATABASE dojo_integration;
\c dojo_integration;

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
CREATE TYPE valeur AS ENUM ('demande', 'confirme', 'payee', 'annule');
CREATE TYPE type_employe AS ENUM ('prof', 'superviseur');
CREATE TYPE mode_paiement AS ENUM ('espece', 'virement', 'cheque', 'mobile_money', 'carte');
CREATE TYPE categorie_depense AS ENUM ('materiel', 'maintenance', 'facture', 'salaire');
CREATE TYPE activite AS ENUM ('actif', 'inactif');
CREATE TYPE etat_suivi AS ENUM ('disponible','endommage');

-- Tables principales
CREATE TABLE genre (
  id_genre SERIAL PRIMARY KEY,
  label VARCHAR
);

CREATE TABLE personnel (
      id_personnel SERIAL PRIMARY KEY,
      nom VARCHAR NOT NULL,
      prenom VARCHAR NOT NULL,
      date_naissance TIMESTAMP,
      adresse VARCHAR,
      contact VARCHAR,
      id_genre INTEGER REFERENCES genre(id_genre)
);
ALTER TABLE personnel ADD COLUMN type_personnel VARCHAR;

CREATE TABLE prof (
    id_prof INTEGER PRIMARY KEY REFERENCES personnel(id_personnel) ON DELETE CASCADE
);

CREATE TABLE superviseur (
    id_superviseur INTEGER PRIMARY KEY REFERENCES personnel(id_personnel) ON DELETE CASCADE
);

CREATE TABLE employe (
     id_employe SERIAL PRIMARY KEY,
     id_personnel INTEGER NOT NULL UNIQUE REFERENCES personnel(id_personnel) ON DELETE CASCADE,
     type_employe type_employe NOT NULL,
     activite activite,
     date_embauche TIMESTAMP DEFAULT NOW(),
     date_fin TIMESTAMP
);


CREATE TABLE eleve (
  id_eleve SERIAL PRIMARY KEY,
  nom VARCHAR,
  prenom VARCHAR,
  date_naissance TIMESTAMP,
  adresse VARCHAR,
  contact VARCHAR,
  date_inscription TIMESTAMP DEFAULT NOW(), /* Wanda - update 29-06-25 */
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

CREATE TABLE materiel_type (
   id_type     SERIAL PRIMARY KEY,
   reference   VARCHAR(50) UNIQUE NOT NULL,
   label       VARCHAR(255) NOT NULL,
   prix NUMERIC(10,2) NOT NULL CHECK (prix >= 0),
   description TEXT
);

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

CREATE TABLE club_groupe (
     id SERIAL PRIMARY KEY,
     nom_responsable VARCHAR,
     contact VARCHAR,
     nombre INTEGER,
    discipline VARCHAR
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

CREATE TABLE facture_materiel (
      id_facture SERIAL PRIMARY KEY,
      id_suivi_salle INTEGER REFERENCES suivi_salle(id_suivi_salle) UNIQUE,
      date TIMESTAMP DEFAULT NOW(),
      destinataire VARCHAR(255),
      est_facture BOOLEAN DEFAULT false,
      montant NUMERIC(10,2)
);

CREATE TABLE historique_garde (
  id_historique SERIAL PRIMARY KEY,
  id_superviseur INTEGER REFERENCES superviseur(id_superviseur),
  date DATE,
  heure TIMESTAMP
);

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

CREATE TABLE seances_cours (
   id_seances SERIAL PRIMARY KEY,
   id_cours INTEGER REFERENCES cours(id_cours),
   date DATE,
   id_plage INTEGER REFERENCES plage_horaire(id),
   id_prof INTEGER REFERENCES prof(id_prof)
);

CREATE TABLE historique_seances (
  id_historique SERIAL PRIMARY KEY,
  id_seances INTEGER REFERENCES seances_cours(id_seances),
  date DATE,
  statut statut
);


CREATE TABLE reservation (
     id_reservation SERIAL PRIMARY KEY,
     id_club INTEGER REFERENCES club_groupe(id),
     date_reservation TIMESTAMP DEFAULT NOW(),
     date_reserve DATE,
     heure_debut TIME,
     heure_fin TIME,
     valeur valeur DEFAULT 'demande'
);

CREATE TABLE suivi_reservation (
    id_suivi SERIAL PRIMARY KEY,
    id_reservation INTEGER REFERENCES reservation(id_reservation),
    montant FLOAT,
    date TIMESTAMP DEFAULT NOW(),
    statut statut
);

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
  statut statut_ecolage DEFAULT 'non paye'
);

CREATE TABLE paiement (
  id_payement SERIAL PRIMARY KEY,
  id_reservation INTEGER REFERENCES reservation(id_reservation),
  montant FLOAT,
  date_paiement TIMESTAMP
);

CREATE TABLE tarif_ecolage (
  id_tarif SERIAL PRIMARY KEY,
  montant FLOAT,
  adult BOOLEAN
);

CREATE TABLE tarif_inscription (
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

CREATE TABLE evolution (
  id_prof INTEGER REFERENCES prof(id_prof) ON DELETE RESTRICT,
  id_eleve INTEGER REFERENCES eleve(id_eleve) ON DELETE CASCADE,
  avis TEXT,
  PRIMARY KEY (id_prof, id_eleve)
);

CREATE TABLE tarif_abonnement (
  id_tarif SERIAL PRIMARY KEY,
  montant NUMERIC(10,2) NOT NULL
);

CREATE TABLE presence (
      id_presence SERIAL PRIMARY KEY,
      id_eleve INTEGER REFERENCES eleve(id_eleve),
      id_seances INTEGER REFERENCES seances_cours(id_seances),
      present BOOLEAN,
      date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      remarque TEXT DEFAULT NULL
);

CREATE TABLE status (
    id_status SERIAL PRIMARY KEY,
    id_reservation INTEGER REFERENCES reservation(id_reservation),
    valeur valeur
);

CREATE TABLE horaire (
     id_horaire SERIAL PRIMARY KEY,
     jour VARCHAR,
     debut TIME,
     fin TIME
);

CREATE INDEX idx_ecolage_date_paiement ON ecolage(date_paiement);
CREATE INDEX idx_ecolage_mois_annee ON ecolage(mois, annee);
CREATE INDEX idx_abonnement_mois_annee ON abonnement(mois, annee);
CREATE INDEX idx_abonnement_actif ON abonnement(actif);
CREATE INDEX idx_seances_cours_date ON seances_cours(date);
CREATE INDEX idx_seances_cours_id_cours ON seances_cours(id_cours);
CREATE INDEX idx_historique_seances_id_seances ON historique_seances(id_seances);

CREATE TABLE gestion_groupe (
    id SERIAL PRIMARY KEY,
    id_eleve INTEGER REFERENCES eleve(id_eleve),
    mois INTEGER,
    annee INTEGER,
    groupe INTEGER,
    UNIQUE (id_eleve, mois, annee)
);

CREATE TABLE planification_cours (
    id SERIAL PRIMARY KEY,
    id_seance INTEGER REFERENCES seances_cours(id_seances),
    groupe INTEGER,
    UNIQUE (id_seance, groupe)
);

CREATE TABLE admin (
   id_admin SERIAL PRIMARY KEY,
   nom VARCHAR NOT NULL,
   prenom VARCHAR NOT NULL,
   contact VARCHAR,
   email VARCHAR,
   actif BOOLEAN DEFAULT TRUE,
   date_creation TIMESTAMP DEFAULT NOW()
);

CREATE TABLE salaire (
    id_salaire SERIAL PRIMARY KEY,
    type_employe type_employe NOT NULL,
    montant_mensuel NUMERIC(10,2) NOT NULL CHECK (montant_mensuel >= 0),
    date_changement TIMESTAMP NOT NULL DEFAULT NOW(),
    actif BOOLEAN DEFAULT TRUE,
    UNIQUE (type_employe, actif) DEFERRABLE INITIALLY DEFERRED
);

CREATE TABLE suivi_salaire (
    id_suivi_salaire SERIAL PRIMARY KEY,
    id_employe INTEGER NOT NULL REFERENCES employe(id_employe) ON DELETE RESTRICT,
    montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0),
    date_paiement TIMESTAMP NOT NULL DEFAULT NOW(),
    mois_a_payer INTEGER NOT NULL CHECK (mois_a_payer BETWEEN 1 AND 12),
    annee_a_payer INTEGER NOT NULL CHECK (annee_a_payer >= 2020),
    mode_paiement mode_paiement NOT NULL DEFAULT 'espece',
    remarques TEXT,
    UNIQUE (id_employe, mois_a_payer, annee_a_payer)
);

INSERT INTO salaire (type_employe, montant_mensuel) VALUES
('prof', 450000.00),
('superviseur', 500000.00);

CREATE INDEX idx_salaire_type_actif ON salaire(type_employe, actif);
CREATE INDEX idx_suivi_salaire_employe ON suivi_salaire(id_employe);
CREATE INDEX idx_suivi_salaire_date ON suivi_salaire(date_paiement);
CREATE INDEX idx_suivi_salaire_periode ON suivi_salaire(mois_a_payer, annee_a_payer);

CREATE TABLE suivi_depense (
       id_depense SERIAL PRIMARY KEY,
       categorie categorie_depense NOT NULL,
       montant NUMERIC(10,2) NOT NULL CHECK (montant > 0),
       date_depense TIMESTAMP NOT NULL DEFAULT NOW(),
       mode_paiement mode_paiement NOT NULL,
       validee BOOLEAN DEFAULT FALSE,
       id_admin_validateur INTEGER REFERENCES admin(id_admin),
       date_validation TIMESTAMP,
       id_stock_materiel INTEGER REFERENCES stock_materiel(id_suivi),

       CONSTRAINT chk_validation_depense CHECK (
           (validee = FALSE AND id_admin_validateur IS NULL AND date_validation IS NULL) OR
           (validee = TRUE AND id_admin_validateur IS NOT NULL AND date_validation IS NOT NULL)
           )
);

CREATE TABLE gestion_taxe (
      id_taxe SERIAL PRIMARY KEY,
      taux_tva NUMERIC(5,2) NOT NULL CHECK (taux_tva >= 0 AND taux_tva <= 100),
      date_application TIMESTAMP NOT NULL DEFAULT NOW()

);

CREATE TABLE facturation (
     id_facture SERIAL PRIMARY KEY,
     numero_facture VARCHAR(50) UNIQUE NOT NULL,
     id_depense INTEGER REFERENCES suivi_depense(id_depense),
     fournisseur VARCHAR(255) NOT NULL,
     date_facture DATE NOT NULL,
     montant_ht NUMERIC(10,2),
     montant_ttc NUMERIC(10,2) NOT NULL,
     id_taxe INTEGER REFERENCES gestion_taxe(id_taxe),
     statut_facture VARCHAR(20) DEFAULT 'en_attente' CHECK (statut_facture IN ('en_attente', 'payee', 'annulee')),
     date_echeance DATE,
     notes TEXT
);

CREATE INDEX idx_employe_type ON employe(type_employe);
CREATE INDEX idx_employe_actif ON employe(actif);
CREATE INDEX idx_salaire_employe ON salaire(id_employe);
CREATE INDEX idx_salaire_actif ON salaire(actif);
CREATE INDEX idx_suivi_salaire_date_paiement ON suivi_salaire(date_paiement);
CREATE INDEX idx_suivi_salaire_mois_annee ON suivi_salaire(mois_a_payer, annee_a_payer);
CREATE INDEX idx_suivi_salaire_employe ON suivi_salaire(id_employe);
CREATE INDEX idx_suivi_depense_date ON suivi_depense(date_depense);
CREATE INDEX idx_suivi_depense_categorie ON suivi_depense(categorie);
CREATE INDEX idx_suivi_depense_validee ON suivi_depense(validee);
CREATE INDEX idx_suivi_depense_stock ON suivi_depense(id_stock_materiel);
CREATE INDEX idx_facturation_numero ON facturation(numero_facture);
CREATE INDEX idx_facturation_statut ON facturation(statut_facture);
CREATE INDEX idx_gestion_taxe_actif ON gestion_taxe(actif);

CREATE TABLE motif_sortie (
  id_motif SERIAL PRIMARY KEY,
  libelle VARCHAR(255) NOT NULL UNIQUE,
  categorie categorie_depense NOT NULL,
  actif BOOLEAN DEFAULT TRUE,
  date_creation TIMESTAMP DEFAULT NOW()
);

CREATE TABLE statut_sortie (
   id_statut SERIAL PRIMARY KEY,
   libelle VARCHAR(50) NOT NULL UNIQUE,
   couleur VARCHAR(20),
   actif BOOLEAN DEFAULT TRUE
);

CREATE TABLE historique_statut_sortie (
  id_historique SERIAL PRIMARY KEY,
  id_depense INTEGER REFERENCES suivi_depense(id_depense) ON DELETE CASCADE,
  ancien_statut INTEGER REFERENCES statut_sortie(id_statut),
  nouveau_statut INTEGER REFERENCES statut_sortie(id_statut),
  date_changement TIMESTAMP DEFAULT NOW(),
  id_admin INTEGER REFERENCES admin(id_admin),
  commentaire TEXT
);

ALTER TABLE suivi_depense
    ADD COLUMN IF NOT EXISTS id_motif INTEGER REFERENCES motif_sortie(id_motif),
    ADD COLUMN IF NOT EXISTS id_statut INTEGER REFERENCES statut_sortie(id_statut) DEFAULT 3,
    ADD COLUMN IF NOT EXISTS description TEXT,
    ADD COLUMN IF NOT EXISTS date_demande TIMESTAMP DEFAULT NOW(),
    ADD COLUMN IF NOT EXISTS id_demandeur INTEGER REFERENCES admin(id_admin);

ALTER TABLE suivi_depense
DROP CONSTRAINT IF EXISTS chk_validation_depense;


ALTER TABLE suivi_depense
    ADD CONSTRAINT chk_validation_depense CHECK (
        (validee = FALSE AND id_admin_validateur IS NULL AND date_validation IS NULL) OR
        (validee = TRUE AND id_admin_validateur IS NOT NULL AND date_validation IS NOT NULL)
        );

-- Statuts possibles
INSERT INTO statut_sortie (libelle, couleur) VALUES
     ('EN ATTENTE', 'warning'),
     ('VALIDE', 'success'),
     ('REFUSE', 'danger'),
     ('ANNULE', 'secondary'),
     ('EN COURS', 'info');

CREATE TABLE login (
  id_login SERIAL PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  mot_de_passe TEXT NOT NULL,
  role VARCHAR(50) NOT NULL CHECK (role IN ('admin', 'prof', 'superviseur')),
  id_personnel INTEGER REFERENCES personnel(id_personnel) ON DELETE CASCADE,
  actif BOOLEAN DEFAULT TRUE,
  date_creation TIMESTAMP DEFAULT NOW()
);


CREATE TYPE role_utilisateur AS ENUM ('admin', 'prof', 'superviseur');


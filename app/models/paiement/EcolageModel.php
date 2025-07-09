<?php

 namespace app\models\paiement;
 use Flight;
 use PDO;
 use Exception;

 class EcolageModel {
     private $db;
     private $table = 'ecolage';


     public function __construct() {
         $this->db = Flight::db();
     }

     public function resteEcolageApayer($id_eleve, $mois, $annee, $tarif_total) {
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(montant), 0) AS total_paye
            FROM {$this->table}
            WHERE id_eleve = :id_eleve
              AND mois = :mois
              AND annee = :annee
        ");
    
        $stmt->execute([
            ':id_eleve' => $id_eleve,
            ':mois' => $mois,
            ':annee' => $annee
        ]);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_paye = (float)$row['total_paye'];
        
        $reste = $tarif_total - $total_paye;
        return $reste > 0 ? round($reste, 2) : 0.0;
    }

    public function getDernierMoisPaye($id_eleve) {
        $stmt = $this->db->prepare("
            SELECT mois, annee
            FROM {$this->table}
            WHERE id_eleve = :id_eleve AND statut = 'paye'
            ORDER BY annee DESC, mois DESC
            LIMIT 1
        ");
        $stmt->execute([':id_eleve' => $id_eleve]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProchainMoisA_Payer($id_eleve) {
        $dernier = $this->getDernierMoisPaye($id_eleve);
    
        if ($dernier && isset($dernier['mois']) && isset($dernier['annee'])) {
            $mois = (int)$dernier['mois'];
            $annee = (int)$dernier['annee'];
    
            if ($mois < 12) {
                return ['mois' => $mois + 1, 'annee' => $annee];
            } else {
                return ['mois' => 1, 'annee' => $annee + 1];
            }
        } else {
            // Aucun paiement trouvé, utiliser date_inscription
            $stmt = $this->db->prepare("SELECT date_inscription FROM eleve WHERE id_eleve = :id");
            $stmt->execute([':id' => $id_eleve]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($row && isset($row['date_inscription'])) {
                $date = new \DateTime($row['date_inscription']);
                return [
                    'mois' => (int)$date->format('m'),
                    'annee' => (int)$date->format('Y')
                ];
            } else {
                // Par sécurité : par défaut janvier année actuelle
                $now = new \DateTime();
                return ['mois' => 1, 'annee' => (int)$now->format('Y')];
            }
        }
    }

    public function checkSiEcolagePayeAvec($id_eleve, $mois, $annee, $tarif_total, $montant) {
        // Récupérer le montant déjà payé
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(montant), 0) AS total_paye
            FROM {$this->table}
            WHERE id_eleve = :id_eleve
              AND mois = :mois
              AND annee = :annee
        ");
    
        $stmt->execute([
            ':id_eleve' => $id_eleve,
            ':mois' => $mois,
            ':annee' => $annee
        ]);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_paye = (float)$row['total_paye'];
    
        // Addition du montant en cours
        $somme = $total_paye + $montant;
    
        // Vérifie si on atteint exactement le tarif
        return abs($somme - $tarif_total) < 0.01; // tolérance d'arrondi
    }

    public function create($data) {
        $isAdult = true;
        $tarif = $this->getTarif($isAdult);
    
        // 1. Insérer d'abord avec statut temporaire
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (id_eleve, montant, date_paiement, mois, annee, statut) 
            VALUES (:id_eleve, :montant, :date_paiement, :mois, :annee, 'non paye')
        ");
        $stmt->execute([
            ':id_eleve' => $data['id_eleve'],
            ':montant' => $data['montant'],
            ':date_paiement' => date('Y-m-d H:i:s'),
            ':mois' => $data['mois'],
            ':annee' => $data['annee']
        ]);
    
        // 2. Vérifier si le paiement est maintenant complet
        $stmt2 = $this->db->prepare("
            SELECT COALESCE(SUM(montant), 0) AS total_paye
            FROM {$this->table}
            WHERE id_eleve = :id_eleve
              AND mois = :mois
              AND annee = :annee
        ");
        $stmt2->execute([
            ':id_eleve' => $data['id_eleve'],
            ':mois' => $data['mois'],
            ':annee' => $data['annee']
        ]);
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        $somme = (float)$row['total_paye'];
    
        // 3. Si paiement complet => update toutes les lignes du mois à "paye"
        if (abs($somme - $tarif) < 0.01) {
            $stmt3 = $this->db->prepare("
                UPDATE {$this->table}
                SET statut = 'paye'
                WHERE id_eleve = :id_eleve
                  AND mois = :mois
                  AND annee = :annee
            ");
            $stmt3->execute([
                ':id_eleve' => $data['id_eleve'],
                ':mois' => $data['mois'],
                ':annee' => $data['annee']
            ]);
        }
    
        return true;
    }

    
    public function isEcolagePaye($id_eleve, $mois, $annee) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS nb
            FROM {$this->table}
            WHERE id_eleve = :id_eleve
              AND mois = :mois
              AND annee = :annee
              AND statut = 'paye'
        ");
    
        $stmt->execute([
            ':id_eleve' => $id_eleve,
            ':mois' => $mois,
            ':annee' => $annee
        ]);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && $row['nb'] > 0;
    }

    public function getTarif(bool $adult): ?float {
        $stmt = $this->db->prepare("
            SELECT montant 
            FROM tarif_ecolage 
            WHERE adult = :adult
            LIMIT 1
        ");
        $stmt->execute([':adult' => $adult ? 'true' : 'false']);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result ? (float)$result['montant'] : null;
    }

    // deplacer dans model eleve
    // public function find($id) {
    //     $stmt = $this->db->prepare("
    //         SELECT e.*, g.label as genre 
    //         FROM eleve e
    //         JOIN genre g ON e.id_genre = g.id_genre
    //         WHERE e.id_eleve = :id
    //     ");
    //     $stmt->execute([':id' => $id]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    
    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT 
                e.*, 
                g.label as genre,
                CASE
                    WHEN DATE_PART('year', AGE(CURRENT_DATE, e.date_naissance)) >= 18 THEN true
                    ELSE false
                END AS est_adulte,
                t.montant AS tarif_ecolage
            FROM eleve e
            JOIN genre g ON e.id_genre = g.id_genre
            LEFT JOIN tarif_ecolage t ON t.adult = (
                CASE
                    WHEN DATE_PART('year', AGE(CURRENT_DATE, e.date_naissance)) >= 18 THEN true
                    ELSE false
                END
            )
            WHERE e.id_eleve = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllEleves() {
        $query = "
            SELECT
                e.id_eleve,
                e.nom,
                e.prenom,
                e.date_naissance,
                e.adresse,
                e.contact,
                e.date_inscription,
                CASE
                    WHEN DATE_PART('year', AGE(CURRENT_DATE, e.date_naissance)) >= 18 THEN true
                    ELSE false
                END AS est_adulte,
                t.montant AS tarif_ecolage
            FROM eleve e
            LEFT JOIN tarif_ecolage t
                ON t.adult = (
                    CASE
                        WHEN DATE_PART('year', AGE(CURRENT_DATE, e.date_naissance)) >= 18 THEN true
                        ELSE false
                    END
                )
            ORDER BY e.nom, e.prenom
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

     
    //  public function getHistoriqueEcolage($id_eleve) {
    //     $sql = "SELECT 
    //                 mois,
    //                 annee,
    //                 SUM(montant) AS montant_total,
    //                 ARRAY_AGG(TO_CHAR(date_paiement, 'DD/MM/YYYY HH24:MI')) AS dates_paiement,
    //                 ARRAY_AGG(statut) AS statuts
    //             FROM ecolage
    //             WHERE id_eleve = :id_eleve
    //             GROUP BY annee, mois
    //             ORDER BY annee DESC, mois DESC";
    
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam(':id_eleve', $id_eleve, PDO::PARAM_INT);
    //     $stmt->execute();
    
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getHistoriqueEcolage($id_eleve) {
    //     $sql = "SELECT 
    //                 mois,
    //                 annee,
    //                 SUM(montant) AS montant_total,
    //                 ARRAY_AGG(TO_CHAR(date_paiement, 'DD/MM/YYYY HH24:MI')) AS dates_paiement,
    //                 ARRAY_AGG(statut) AS statuts
    //             FROM ecolage
    //             WHERE id_eleve = :id_eleve
    //             GROUP BY annee, mois
    //             ORDER BY annee DESC, mois DESC";
    
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam(':id_eleve', $id_eleve, PDO::PARAM_INT);
    //     $stmt->execute();
    
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function getHistoriqueEcolage($id_eleve) {
        $sql = "SELECT 
                    mois,
                    annee,
                    SUM(montant) AS montant_total,
                    ARRAY_AGG(TO_CHAR(date_paiement, 'DD/MM/YYYY HH24:MI')) AS dates_paiement,
                    ARRAY_AGG(statut) AS statuts
                FROM ecolage
                WHERE id_eleve = $1
                GROUP BY annee, mois
                ORDER BY annee DESC, mois DESC";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_eleve]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


 }
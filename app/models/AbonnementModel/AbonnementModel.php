<?php
namespace app\models\AbonnementModel;

use PDO;
use Flight;

class AbonnementModel {
   
    public function getAll() {
        try {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM abonnement");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }
    public function getById($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM abonnement WHERE id_abonnement = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }
    public function create($data) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO abonnement (id_club, jour, mois, actif) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['id_club'], $data['jour'], $data['mois'], $data['actif']]);
            return "Insertion réussie !";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
     public  function update($id, $data) {
        try {
             $db = Flight::db();
            $stmt = $db->prepare("UPDATE abonnement SET id_club=?, jour=?, mois=?, actif=? WHERE id_abonnement = ?");
             $stmt->execute([$data['id_club'], $data['jour'], $data['mois'], $data['actif'], $id]);
             return "Mise à jour réussie !";
        } catch (\PDOException $e) {   
            return "Erreur de mise à jour : " . $e->getMessage();
        } 
        
    }
    public function delete($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("DELETE FROM abonnement WHERE id_abonnement = ?");
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0 ? "Suppression réussie." : "Aucun abonnement trouvé.";
        } catch (\PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }   
    }
    
    public function renouveler($id, $nom, $prix, $duree) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("UPDATE abonnement SET mois = mois + 1 WHERE id_abonnement = ? AND actif = true");
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0 ? "Renouvellement automatique réussi." : "Échec.";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
    public function annuler($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("UPDATE abonnement SET actif = false WHERE id_abonnement = ?");
            $stmt->execute([$id]);
            return "Abonnement annulé avec succès.";
        } catch (\PDOException $e) {
            return "Erreur lors de l'annulation : " . $e->getMessage();
        }
    }
    public function isActive($id) {
        $abonnement = $this->getById($id);
        return $abonnement && $abonnement['actif'];
    }

    public function daysRemaining($id) {
        $abonnement = $this->getById($id);
        if ($abonnement && $abonnement['actif']) {
            return $abonnement['mois'] * 30; // Approximation en jours
        }
        return 0;
    }


    public function getExpirationsDans7Jours() {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM abonnement WHERE actif = true AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) >= DATE_ADD(CURDATE(), INTERVAL mois MONTH)");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }
   
    /**
     * Vérifie si un abonnement peut être renouvelé*/
    public function canRenew($id) {
        $abonnement = $this->getById($id);
        return $abonnement && $abonnement['actif'];
    }

    /**
     * Génère une facture pro-forma pour un abonnement
     */
    public function generateProforma($id) {
        $abonnement = $this->getById($id);
        if (!$abonnement) {
            return null;
        }
        // Supposition : tarif fixe de 100 par mois (à ajuster selon notre logique)
        $montantParMois = 100;
        $total = $abonnement['mois'] * $montantParMois;
        return [
            'id' => $id,
            'mois' => $abonnement['mois'],
            'total' => $total
        ];
    }
  
   
}

?>
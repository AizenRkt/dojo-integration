<?php

namespace app\models\individu;

use PDO;
use Flight;

class LoginModel {
    public static function verifyCredentials($username, $password) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM login WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['mot_de_passe']) {
            return $user;
        }
        return false;
    }
}
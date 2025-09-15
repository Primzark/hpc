<?php
class Utilisateur
{
    /**
     * Retourne une connexion PDO configurée pour cette application.
     */
    private static function getPDO()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function ajouter($nom, $email, $age, $mdp, $token, $imageConsent)
    {
        $pdo = self::getPDO();

        $sql = "INSERT INTO utilisateur (uti_nom, uti_email, uti_age, uti_mdp, uti_approval_token, uti_image_consent)"
            . " VALUES (:nom, :email, :age, :mdp, :token, :consent)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':age', $age, PDO::PARAM_INT);
        $stmt->bindValue(':mdp', password_hash($mdp, PASSWORD_DEFAULT));
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':consent', $imageConsent, PDO::PARAM_INT);
        $stmt->execute();
    }



    public static function getByEmail($email)
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_uti, uti_nom, uti_email, uti_age, uti_mdp, uti_admin, uti_approved, uti_approval_token,
                uti_reset_token, uti_reset_expires, uti_image_consent
                FROM utilisateur WHERE uti_email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getById($id_uti)
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_uti, uti_nom, uti_email, uti_age, uti_mdp, uti_admin, uti_approved, uti_approval_token,
                uti_reset_token, uti_reset_expires, uti_image_consent
                FROM utilisateur WHERE id_uti = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id_uti);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByNom($nom)
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_uti, uti_nom, uti_email, uti_age, uti_mdp, uti_admin, uti_approved, uti_approval_token,
                uti_reset_token, uti_reset_expires, uti_image_consent
                FROM utilisateur WHERE uti_nom = :nom";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nom', $nom);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll()
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_uti, uti_nom FROM utilisateur WHERE uti_admin = 0 ORDER BY uti_nom ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne la liste des emails de tous les membres approuvés (admins inclus) ayant un email.
     */
    public static function getAllApprovedEmails()
    {
        $pdo = self::getPDO();
        $sql = "SELECT uti_email FROM utilisateur WHERE uti_approved = 1 AND uti_email IS NOT NULL AND uti_email <> ''";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $emails = [];
        foreach ($rows as $row) {
            if (filter_var($row['uti_email'], FILTER_VALIDATE_EMAIL)) {
                $emails[] = $row['uti_email'];
            }
        }
        return $emails;
    }

    public static function setApproved($id_uti, $approved)
    {
        $pdo = self::getPDO();
        $sql = "UPDATE utilisateur SET uti_approved = :approved, uti_approval_token = NULL WHERE id_uti = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':approved', $approved, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id_uti, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function updateToken($id_uti, $token)
    {
        $pdo = self::getPDO();
        $sql = "UPDATE utilisateur SET uti_approval_token = :token WHERE id_uti = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':id', $id_uti, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function setResetToken($email, $token, $expires)
    {
        $pdo = self::getPDO();
        $sql = "UPDATE utilisateur SET uti_reset_token = :token, uti_reset_expires = :expires WHERE uti_email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':expires', $expires);
        $stmt->bindValue(':email', $email);
        return $stmt->execute();
    }

    public static function getByResetToken($token)
    {
        $pdo = self::getPDO();
        $sql = "SELECT id_uti, uti_email, uti_reset_token, uti_reset_expires FROM utilisateur WHERE uti_reset_token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user['uti_reset_expires'] && strtotime($user['uti_reset_expires']) >= time()) {
            return $user;
        }
        return false;
    }

    public static function updatePassword($id_uti, $password)
    {
        $pdo = self::getPDO();
        $sql = "UPDATE utilisateur SET uti_mdp = :mdp, uti_reset_token = NULL, uti_reset_expires = NULL WHERE id_uti = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':mdp', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(':id', $id_uti, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Supprime un utilisateur ainsi que ses inscriptions.
     */
    public static function delete($id_uti)
    {
        $pdo = self::getPDO();

        $stmt = $pdo->prepare("DELETE FROM s_inscrit_a WHERE id_uti = :id");
        $stmt->bindValue(':id', $id_uti, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE id_uti = :id");
        $stmt->bindValue(':id', $id_uti, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

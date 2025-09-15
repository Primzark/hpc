<?php
class Evenement
{
    /**
     * Retourne une instance PDO configurée.
     */
    private static function getPDO()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function ajouter($titre, $lieu, $date, $heure, $description, $image, $id_type_eve)
    {
        $pdo = self::getPDO();

        $sql = "INSERT INTO evenement (eve_titre, eve_lieu, eve_date, eve_heure, eve_description, eve_image, id_type_eve)
                VALUES (:titre, :lieu, :date, :heure, :description, :image, :id_type_eve)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':lieu', $lieu);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':heure', $heure);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':id_type_eve', $id_type_eve);
        $stmt->execute();

        return $pdo->lastInsertId();        /**
     * Retourne l'index du dernier événement inséré.
     */
    }

    public static function getAll()
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_eve, eve_titre, eve_lieu, eve_date, eve_heure, eve_description, eve_image, id_type_eve
                FROM evenement ORDER BY eve_date DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les évènements à venir à partir d'une date (par défaut aujourd'hui).
     */
    public static function getUpcoming($fromDate = null)
    {
        $pdo = self::getPDO();
        if ($fromDate === null) {
            $fromDate = date('Y-m-d');
        }
        $sql = "SELECT id_eve, eve_titre, eve_lieu, eve_date, eve_heure, eve_description, eve_image, id_type_eve
                FROM evenement WHERE eve_date >= :fromDate ORDER BY eve_date ASC, eve_heure ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':fromDate', $fromDate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les évènements sur une plage de dates incluse.
     */
    public static function getByDateRange($startDate, $endDate)
    {
        $pdo = self::getPDO();
        $sql = "SELECT id_eve, eve_titre, eve_lieu, eve_date, eve_heure, eve_description, eve_image, id_type_eve
                FROM evenement
                WHERE eve_date >= :startDate AND eve_date <= :endDate
                ORDER BY eve_date ASC, eve_heure ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':startDate', $startDate);
        $stmt->bindValue(':endDate', $endDate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les évènements correspondant à une liste d'identifiants.
     */
    public static function getByIds($ids)
    {
        $pdo = self::getPDO();
        if (!is_array($ids) || empty($ids)) {
            return [];
        }
        $clean = [];
        foreach ($ids as $id) {
            $id = (int) $id;
            if ($id > 0) {
                $clean[] = $id;
            }
        }
        if (empty($clean)) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($clean), '?'));
        $sql = "SELECT id_eve, eve_titre, eve_lieu, eve_date, eve_heure, eve_description, eve_image, id_type_eve
                FROM evenement WHERE id_eve IN ($placeholders)
                ORDER BY eve_date ASC, eve_heure ASC";
        $stmt = $pdo->prepare($sql);
        foreach ($clean as $i => $val) {
            $stmt->bindValue($i + 1, $val, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id_eve)
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_eve, eve_titre, eve_lieu, eve_date, eve_heure, eve_description, eve_image, id_type_eve
                FROM evenement WHERE id_eve = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id_eve);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateEvenement($id_eve, $data)
    {
        $pdo = self::getPDO();

        $sql = "UPDATE evenement 
            SET eve_lieu = :lieu, eve_date = :date, eve_heure = :heure, eve_description = :description, eve_image = :image 
            WHERE id_eve = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id_eve);
        $stmt->bindValue(':lieu', $data['lieu']);
        $stmt->bindValue(':date', $data['date']);
        $stmt->bindValue(':heure', $data['heure']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':image', $data['image']);
        return $stmt->execute();
    }

    /**
     * Supprime un événement et ses inscriptions.
     */
    public static function delete($id_eve)
    {
        $pdo = self::getPDO();

        $stmt = $pdo->prepare("DELETE FROM s_inscrit_a WHERE id_eve = :id");
        $stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $pdo->prepare("DELETE FROM evenement WHERE id_eve = :id");
        $stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Récupère les derniers événements pour le type spécifié.
     */
    public static function getLatestByType($type, $limit)
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_eve, eve_titre, eve_date, eve_heure, eve_lieu, eve_description, eve_image
                FROM evenement
                WHERE id_type_eve = :type
                ORDER BY eve_date DESC
                LIMIT :lim";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->bindValue(':lim', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

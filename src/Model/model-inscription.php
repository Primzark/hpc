<?php
class Inscription
{
    /**
     * Obtient une connexion PDO pour les opérations en base de données.
     */
    private static function getPDO()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function dejaInscrit($id_eve, $id_uti)
    {
        $pdo = self::getPDO();

        $sql = "SELECT id_uti, id_eve FROM s_inscrit_a WHERE id_eve = :id_eve AND id_uti = :id_uti";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_eve', $id_eve, PDO::PARAM_INT);
        $stmt->bindValue(':id_uti', $id_uti, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch() !== false;
    }
    public static function inscrire($id_eve, $id_uti)
    {
        $pdo = self::getPDO();

        $sql = "INSERT INTO s_inscrit_a (id_uti, id_eve) VALUES (:id_uti, :id_eve)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_uti', $id_uti, PDO::PARAM_INT);
        $stmt->bindValue(':id_eve', $id_eve, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function desinscrire($id_eve, $id_uti)
    {
        $pdo = self::getPDO();

        $sql = "DELETE FROM s_inscrit_a WHERE id_uti = :id_uti AND id_eve = :id_eve";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_uti', $id_uti, PDO::PARAM_INT);
        $stmt->bindValue(':id_eve', $id_eve, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Compte combien d'utilisateurs sont inscrits pour un événement donné.
     */
    public static function countByEvent($id_eve)
    {
        $pdo = self::getPDO();

        $sql = "SELECT COUNT(*) FROM s_inscrit_a WHERE id_eve = :id_eve";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_eve', $id_eve, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    /**
     * Récupère la liste des participants inscrits à un événement donné.
     */
    public static function getParticipantsByEvent($id_eve)
    {
        $pdo = self::getPDO();

        $sql = "SELECT u.id_uti, u.uti_nom
                FROM s_inscrit_a s
                JOIN utilisateur u ON s.id_uti = u.id_uti
                WHERE s.id_eve = :id_eve
                ORDER BY u.uti_nom ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_eve', $id_eve, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère la liste des tournois à venir auxquels un utilisateur est inscrit.
     */
    public static function getUpcomingByUser($id_uti)
    {
        $pdo = self::getPDO();

        $sql = "SELECT e.id_eve, e.eve_titre, e.eve_date, e.eve_heure, e.eve_lieu, e.eve_description, e.eve_image
                FROM s_inscrit_a s
                JOIN evenement e ON s.id_eve = e.id_eve
                WHERE s.id_uti = :id_uti
                  AND e.id_type_eve = 2
                  AND e.eve_date >= CURDATE()
                ORDER BY e.eve_date ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_uti', $id_uti, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

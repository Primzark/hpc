<?php
class Inscription
{
    /**
     * Get a PDO connection for database operations.
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
}
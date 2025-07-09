<?php
class Donation
{
    private static function getPDO()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function createPending($id_uti, $amount)
    {
        $pdo = self::getPDO();
        $sql = "INSERT INTO donation (id_uti, amount) VALUES (:id_uti, :amount)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_uti', $id_uti, PDO::PARAM_INT);
        $stmt->bindValue(':amount', $amount);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    public static function getById($id)
    {
        $pdo = self::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM donation WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

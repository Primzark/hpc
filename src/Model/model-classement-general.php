<?php
class ClassementGeneral
{
    private static function getPDO()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function getAll()
    {
        $pdo = self::getPDO();
        $sql = "SELECT cg.id_gen, cg.id_uti, cg.points, cg.bounty, u.uti_nom
                FROM classement_general cg
                JOIN utilisateur u ON cg.id_uti = u.id_uti
                ORDER BY u.uti_nom ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUserId($id_uti)
    {
        $pdo = self::getPDO();
        $sql = "SELECT id_gen, id_uti, points, bounty FROM classement_general WHERE id_uti = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id_uti, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insert($id_uti)
    {
        $pdo = self::getPDO();
        $sql = "INSERT INTO classement_general (id_uti, points, bounty) VALUES (:id_uti, 0, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_uti', $id_uti, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function update($id_gen, $points, $bounty)
    {
        $pdo = self::getPDO();
        $sql = "UPDATE classement_general SET points = :points, bounty = :bounty WHERE id_gen = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':points', $points, PDO::PARAM_INT);
        $stmt->bindValue(':bounty', $bounty, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id_gen, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function delete($id_gen)
    {
        $pdo = self::getPDO();
        $stmt = $pdo->prepare("DELETE FROM classement_general WHERE id_gen = :id");
        $stmt->bindValue(':id', $id_gen, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

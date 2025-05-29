<?php
class Classement
{
    private static function getPDO()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function ajouter($nomjoueur, $rang, $points, $id_uti)
    {
        $pdo = self::getPDO();

        $sql = "INSERT INTO classement (cla_nomjoueur, cla_rang, cla_points, id_uti)
            VALUES (:nomjoueur, :rang, :points, :id_uti)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nomjoueur', $nomjoueur);
        $stmt->bindValue(':rang', $rang, PDO::PARAM_INT);
        $stmt->bindValue(':points', $points, PDO::PARAM_INT);
        $stmt->bindValue(':id_uti', $id_uti, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function getAll()
    {
        $pdo = self::getPDO();

        $sql = "SELECT * FROM classement ORDER BY cla_rang ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id_cla)
    {
        $pdo = self::getPDO();

        $sql = "SELECT * FROM classement WHERE id_cla = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id_cla, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateClassement($id_cla, $data)
    {
        $pdo = self::getPDO();

        $sql = "UPDATE classement 
                SET cla_rang = :rang, cla_nomjoueur = :nomjoueur, cla_points = :points 
                WHERE id_cla = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id_cla, PDO::PARAM_INT);
        $stmt->bindValue(':rang', $data['rang'], PDO::PARAM_INT);
        $stmt->bindValue(':nomjoueur', $data['nomjoueur']);
        $stmt->bindValue(':points', $data['points'], PDO::PARAM_INT);
        return $stmt->execute();
    }
}

<?php
class Trombinoscope
{
    private static function getPDO()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function ajouter($pseudo, $image)
    {
        $pdo = self::getPDO();
        $sql = "INSERT INTO trombinoscope (tro_pseudo, tro_image) VALUES (:pseudo, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':image', $image);
        return $stmt->execute();
    }

    public static function getAll()
    {
        $pdo = self::getPDO();
        $sql = "SELECT * FROM trombinoscope ORDER BY id_tro DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<?php
class Evenement
{

    public static function ajouter($titre, $lieu, $date, $heure, $description, $image, $id_type_eve)
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    }

    public static function getAll()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM evenement ORDER BY eve_date DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id_eve)
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM evenement WHERE id_eve = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id_eve);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateEvenement($id_eve, $data)
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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


}

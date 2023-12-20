<?php
class Crud {
    private $connexion;

    public function __construct() {
        $host = "localhost";
        $db = "tp_1";
        $user = "root";
        $password = "";
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $this->connexion = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getAll(string $table): array {
        try {
            $PDOStatement = $this->connexion->query("SELECT * FROM $table ORDER BY id ASC");
            return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }

    public function getById(string $table, int $id): array {
        try {
            $PDOStatement = $this->connexion->prepare("SELECT * FROM $table WHERE id = :id");
            $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
            $PDOStatement->execute();
            return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération de l'élément : " . $e->getMessage());
        }
    }

    public function add(string $request, array $itemdata): int|bool {
        try {
            $PDOStatement = $this->connexion->prepare($request);
            foreach ($itemdata as $key => $value) {
                $PDOStatement->bindValue(':' . $key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
            $PDOStatement->execute();
            return $PDOStatement->rowCount() > 0 ? $this->connexion->lastInsertId() : false;
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout de l'élément : " . $e->getMessage());
        }
    }

    public function delete(string $table, int $id): bool {
        try {
            $PDOStatement = $this->connexion->prepare("DELETE FROM $table WHERE id = :id");
            $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
            $PDOStatement->execute();
            return $PDOStatement->rowCount() > 0;
        } catch (PDOException $e) {
            die("Erreur lors de la suppression de l'élément : " . $e->getMessage());
        }
    }

    public function __destruct() {
        $this->connexion = null;
    }
}

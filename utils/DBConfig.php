<?php
class DbConfig {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'test';
    protected $connexion;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=UTF8";

        if (!isset($this->connexion)) {
            try {
                $this->connexion = new PDO($dsn, $this->username, $this->password);
                // Ligne de débogage, à commenter ou supprimer en production
                // echo "Connected to the $this->database database successfully";
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
    }

    // Méthode pour récupérer l'objet PDO
    public function getConnection() {
        return $this->connexion;
    }
}
?>

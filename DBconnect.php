<?php 

class DBConnect
{
    public function getPDO(): PDO
    {
        $dsn = 'mysql:dbname=blog;host=127.0.0.1;charset=utf8';
        $user = 'root';
        $password = '';

        try {
            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            // Affichage de confirmation
            echo "Connexion réussie à la base de données !\n";

            return $pdo;

            // En cas d'erreur, on attrape l'exception et on affiche un message d'erreur
        } catch (PDOException $e) {
            echo "Échec de la connexion à la base de données : " . $e->getMessage() . "\n";
            throw $e; // On relance l'exception pour être averti du problème
        }
    }
}

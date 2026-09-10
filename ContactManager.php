<?php

require_once 'Contact.php';

class ContactManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT id, name, email, phoneNumber FROM contacts');
        // Utilisation de PDO::FETCH_FUNC pour créer des instances de Contact directement à partir des résultats de la requête
        return $statement->fetchAll(PDO::FETCH_FUNC, function($id, $name, $email, $phoneNumber)
        {
            return new Contact(
                $id ? (int)$id : null,
                $name,
                $email,
                $phoneNumber
            );
        });
    }
}
<?php

require_once 'DBconnect.php';
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
        $statement = $this->pdo->query('SELECT id, name, email, phone_number FROM contacts');
        // Utilisation de PDO::FETCH_FUNC pour créer des instances de Contact directement à partir des résultats de la requête
        return $statement->fetchAll(PDO::FETCH_FUNC, function($id, $name, $email, $phoneNumber)
        {
            return new Contact(
                $id ? (int)$id : null,
                $name,
                $email,
                $phoneNumber,
            );
        });
    }
    public function findById(int $id) : ?Contact     
    {
        $statement = $this->pdo->prepare('SELECT id, name, email, phone_number FROM contacts WHERE id = ?');
        $statement->execute([$id]);
        $ligne = $statement->fetch(PDO::FETCH_ASSOC); 
            if ($ligne === false)
                {
                return null;
                }
            else
                {
                    return new Contact(
                        (int) $ligne['id'],
                        $ligne['name'],
                        $ligne['email'],
                        $ligne['phone_number']);
                }
    }
        public function create(string $name, string $email, string $phoneNumber) : void  
    {
        $statement = $this->pdo->prepare('INSERT INTO contacts (name, email, phone_number) VALUES (?, ?, ?)');
        $statement->execute([$name,$email,$phoneNumber]);
    }
}
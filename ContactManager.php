<?php

require_once 'dbconnect.php';
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
        $statement = $this->pdo->query('SELECT * FROM contacts');
        return $statement->fetchAll();
    }
}

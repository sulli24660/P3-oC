<?php

require_once 'DBConnect.php';
class ContactManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllbillets(): array
    {
        $statement = $this->pdo->query('SELECT * FROM billets');
        return $statement->fetchAll();
    }

    public function getBilletsById(int $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM billets WHERE id = :id');
        $statement->execute(['id' => $id]);
        return $statement->fetch() ?: null;
    }

    public function addBillet(string $name, string $email): void
    {
        $statement = $this->pdo->prepare('INSERT INTO billets (name, email) VALUES (:name, :email)');
        $statement->execute(['name' => $name, 'email' => $email]);
    }

    public function updateBillet(int $id, string $name, string $email): void
    {
        $statement = $this->pdo->prepare('UPDATE billets SET name = :name, email = :email WHERE id = :id');
        $statement->execute(['id' => $id, 'name' => $name, 'email' => $email]);
    }

    public function deleteBillet(int $id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM billets WHERE id = :id');
        $statement->execute(['id' => $id]);
    }
}

var_dump(new ContactManager((new DBConnect())->getPDO()));
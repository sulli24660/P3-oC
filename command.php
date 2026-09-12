<?php

class Command
{
    public function execute(string $line): bool
    {
        return match ($line)
        {
            'exit' => $this->quit(),
            'list' => $this->showMenu(),
            'display' => $this->display(),
            'connect' => $this->connect(),
            default => $this->unknownCommand($line),
        };
    }

    private function quit(): bool
    {
        echo "Au revoir !\n";
        return false;
    }

    private function showMenu(): bool
    {
        Functions::afficherMenu();
        return true;
    }

    private function display(): bool
    {
        echo "Voici la liste des contacts :\n";
        $pdo = (new DBConnect())->getPDO(); //J'instancie la classe DBConnect pour établir une connexion à la base de données et récupérer l'objet PDO
        $manager = new ContactManager($pdo); //J'instancie la classe ContactManager en lui passant l'objet PDO pour pouvoir gérer les contacts dans la base de données
        $contacts = $manager->findAll(); //Je récupère tous les contacts de la base de données

        foreach ($contacts as $contact)
        {
            echo $contact->__toString() . "\n"; //J'affiche les informations de chaque contact
        }

        return true;
    }

    private function connect(): bool
    {
        echo "Tentative de connexion à la base de données...\n";
        try
        {
            $pdo = (new DBConnect())->getPDO(); //J'instancie la classe DBConnect pour établir une connexion à la base de données et récupérer l'objet PDO
            echo "Connexion réussie à la base de données !\n";
        }
        catch (Exception $error)
        {
            echo "Échec de la connexion : " . $error->getMessage() . "\n";
        }

        return true;
    }

    private function unknownCommand(string $line): bool
    {
        echo "Commande inconnue : '$line'. Tapez 'list' pour voir les commandes.\n";
        return true;
    }

    private function detail(string $line) 
    {
        $resultat = preg_match('/^detail (\d+)$/', $line, $matches);
            if ($resultat === 1)
            $resultConverts = (int) $matches[1];
            




            }

}


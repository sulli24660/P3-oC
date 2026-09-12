<?php

require_once 'dbconnect.php'; //J'appelle le fichier dbconnect.php pour pouvoir utiliser la classe DBConnect et établir une connexion à la base de données
require_once 'ContactManager.php'; //J'appelle le fichier ContactManager.php pour pouvoir utiliser la classe ContactManager et gérer les contacts dans la base de données
require_once 'Functions.php'; //J'appelle le fichier Functions.php pour pouvoir utiliser la classe Functions et afficher le menu des commandes disponibles


Functions::afficherMenu(); //J'appelle la méthode afficherMenu() de la classe Functions pour afficher le menu des commandes disponibles

while (true) 
{
    $line = trim(readline("\nEntrez votre commande : ")); 

    if ($line === "exit") 
    {
        echo "Au revoir !\n";
        break; 
    }

    elseif ($line === "list") 
    {
        Functions::afficherMenu(); 
    } 
    elseif ($line === "display")
    {
        echo "Voici la liste des contacts :\n";
        $pdo = (new DBConnect())->getPDO(); //J'instancie la classe DBConnect pour établir une connexion à la base de données et récupérer l'objet PDO
        $manager = new ContactManager($pdo); //J'instancie la classe ContactManager en lui passant l'objet PDO pour pouvoir gérer les contacts dans la base de données
        $contacts = $manager->findAll(); //J'appelle la méthode findAll() de la classe ContactManager pour récupérer tous les contacts de la base de données et les stocker dans un tableau
        foreach ($contacts as $contact)
        {    
            echo $contact->__toString() . "\n"; //J'appelle la méthode __toString() de la classe Contact pour afficher les informations de chaque contact dans le tableau
        }
    }

    elseif ($line === "connect") 
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
    } 
    else 
    {
        echo "Commande inconnue : '$line'. Tapez 'list' pour voir les commandes.\n";
    }
}
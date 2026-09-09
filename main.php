<?php

require_once 'dbconnect.php';
require_once 'ContactManager.php';

function afficherMenu(): void
{
    echo "Voici la liste des commandes disponibles :\n";
    echo "- list    : Affiche la liste des commandes\n";
    echo "- connect : Teste la connexion à la base de données\n";
    echo "- exit    : Quitte le programme\n";
    echo "- display : Affiche tous les contacts de la base de données\n";
}

afficherMenu();

while (true) 
{
    $line = trim(readline("\nEntrez votre commande : "));

    if ($line === "exit") 
    {
        echo "Au revoir !\n";
        break;
    }

    if ($line === "list") 
    {
        afficherMenu();
    } 
        if ($line === "display")
            {
            echo "Voici la liste des contacts :\n";
            $pdo = (new DBConnect())->getPDO();
            $manager = new ContactManager($pdo);
            $contacts = $manager->findAll();
            foreach ($contacts as $contact) 
                 echo "- " . $contact['id'] . " - " . $contact['name'] . " - " . $contact['email'] . " - " . $contact['phone_number'] . "\n";
            }

    elseif ($line === "connect") 
    {
        echo "Tentative de connexion à la base de données...\n";
        try 
        {
            $pdo = (new DBConnect())->getPDO(); 
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
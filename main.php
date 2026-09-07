<?php

require_once 'database.php';

while (true) 
{
    $line = trim(readline("Entrez votre commande : "));

    if ($line === "exit") 
    {
        echo "Au revoir !\n";
        break;
    }

    if ($line === "list") 
    {
        echo "Voici la liste des commandes disponibles :\n";
        echo "- list    : Affiche la liste des commandes\n";
        echo "- connect : Teste la connexion à la base de données\n";
        echo "- exit    : Quitte le programme\n";
    } 
    elseif ($line === "connect") 
    {
        echo "Tentative de connexion à la base de données...\n";
        try {
            $pdo = connectToDB();
            echo " Connexion réussie à la base de données !\n";
        } catch (Exception $error) {
            echo " Échec de la connexion : " . $error->getMessage() . "\n";
        }
    } 
    else 
    {
        echo "Commande inconnue : '$line'. Tapez 'list' pour voir les commandes.\n";
    }
}
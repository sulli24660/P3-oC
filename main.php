<?php

require_once 'dbconnect.php'; //J'appelle le fichier dbconnect.php pour pouvoir utiliser la classe DBConnect et établir une connexion à la base de données
require_once 'ContactManager.php'; //J'appelle le fichier ContactManager.php pour pouvoir utiliser la classe ContactManager et gérer les contacts dans la base de données
require_once 'Functions.php'; //J'appelle le fichier Functions.php pour pouvoir utiliser la classe Functions et afficher le menu des commandes disponibles
require_once 'command.php'; //J'appelle le fichier command.php pour pouvoir utiliser la classe Command et gérer l'exécution des commandes


Functions::afficherMenu(); //J'appelle la méthode afficherMenu() de la classe Functions pour afficher le menu des commandes disponibles

$command = new Command(); //J'instancie la classe Command pour gérer l'exécution de chaque commande saisie

while (true) 
{
    $line = trim(readline("\nEntrez votre commande : ")); 

    if (!$command->execute($line)) 
    {
        break;
    }
}

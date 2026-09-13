<?php

class Functions
{
    public static function afficherMenu(): void
    {
        echo "Voici la liste des commandes disponibles :\n";
        echo "- list    : Affiche la liste des commandes\n";
        echo "- connect : Teste la connexion à la base de données\n";
        echo "- display : Affiche tous les contacts de la base de données\n";
        echo "- exit    : Quitte le programme\n";
        echo "- detail <id> : Affiche les coordonnées du contact n°<id> (un Numéro est saisi à la place de <id>)\n";
        echo "- create + \"nom\" \"email\" et \"numéro de téléphone\" : Créer un nouveau contact\n";
    
    }
}


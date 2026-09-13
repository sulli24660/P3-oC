<?php
require_once 'DBconnect.php';
require_once 'ContactManager.php';
require_once 'functions.php';
class Command
{
    public function execute(string $line): bool
    {
        if (str_starts_with($line, 'detail'))
    {
        return $this->detail($line);
    }
        elseif (str_starts_with($line,'create'))
    {   return $this->create($line);
    }
        elseif (str_starts_with($line,'delete'))
        {   
            return $this->delete($line);
        }
        elseif 
        (str_starts_with($line, 'modify'))
        { 
        
            return $this->modify($line); 
        }
        return match ($line)
        {
            'exit' => $this->quit(),
            'list' => $this->showMenu(),
            'display' => $this->display(),
            'connect' => $this->connect(),
            'help' => $this->showMenu(),
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

    private function detail(string $line): bool
    {
        $resultat = preg_match('/^detail (\d+)$/', $line, $matches);
            if ($resultat === 1)
                {
                $resultConverts = (int) $matches[1];
                        $pdo = (new DBConnect())->getPDO();
                        $manager = new ContactManager($pdo); 
                        $match = $manager->findById($resultConverts); 
                        if ($match === null)
                            {
                                echo "Aucun contact trouvé sur cet identifiant $resultConverts \n";
                            }
                        else 
                            {
                                echo $match->__toString() . "\n";
                            }
                return true;
                }
            else 
                {
            echo "Format invalide. Utilisation attendue : detail <id>\n";
                return true;
                }
            }
    private function create(string $line): bool
        {   
        $resultat = preg_match('/^create ([^,]+),([^,]+),([^,]+)$/', $line, $matches);
            if ($resultat === 1)
                {
                        $name = trim($matches[1]);
                        $email = trim($matches[2]);
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                            echo "L'adresse mail saisie n'est pas valide\n"; 
                            return true;
                            }
                        $phoneNumber = trim($matches[3]);
                        $phoneNumberClean = str_replace(' ', '', $phoneNumber);
                        if (!preg_match('/^\d{10}$/', $phoneNumberClean))
                        {
                            echo "Le numéro de téléphone saisi ne contient pas 10 chiffres\n"; 
                            return true;
                        }

                        $pdo = (new DBConnect())->getPDO();
                        $manager = new ContactManager($pdo); 
                        $manager->create($name, $email, $phoneNumberClean);
                        echo "\n Nouveau contact ajouté : $name,$email,$phoneNumberClean\n";
                        return true;
                }
                else
                {    echo "Format invalide. Merci de ressaisir convenablement le contact (nom, email, numéro de téléphone) \n";
                       return true;
                }
         }
    private function delete(string $line): bool
    {
        $resultat = preg_match('/^delete (\d+)$/', $line, $matches);
            if ($resultat === 1)
                {
                $resultConverts = (int) $matches[1];
                        $pdo = (new DBConnect())->getPDO();
                        $manager = new ContactManager($pdo); 
                        $deleted = $manager->delete($resultConverts); 
                        if ($deleted === false)
                            {
                                echo "Aucun contact trouvé sur cet identifiant $resultConverts \n";
                            }
                        else 
                            {
                                echo "L'ID supprimé est le $resultConverts\n";
                            }
                return true;
                }
            else 
                {
            echo "Format invalide. Utilisation attendue : delete <id>\n";
                return true;
                }
            }
        private function modify(string $line): bool
    {
        $resultat = preg_match('/^modify (\d+),([^,]+),([^,]+),([^,]+)$/', $line, $matches);
            if ($resultat === 1)
                {
                $id = (int)trim($matches[1]);  
                $name = (string)trim($matches[2]);
                $email = (string)trim($matches[3]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                    echo "L'adresse mail saisie n'est pas valide\n"; 
                    return true;
                    }
                $phoneNumber = (string)trim($matches[4]);
                $phoneNumberClean = (string)str_replace(' ', '', $phoneNumber);
                    if (!preg_match('/^\d{10}$/', $phoneNumberClean))
                    {
                    echo "Le numéro de téléphone saisi ne contient pas 10 chiffres\n"; 
                            return true;
                    }
                    $pdo = (new DBConnect())->getPDO();
                    $manager = new ContactManager($pdo); 
                    $modified = $manager->modify($id, $name, $email, $phoneNumberClean);
                        if ($modified === false)
                            {
                                echo "Aucunes modifications apportées \n";
                            }
                        else 
                            {
                                echo "voici les modifications apportées : $name, $email, $phoneNumberClean, $id \n";
                            }
                return true;
                }
            else 
                {
            echo "Format invalide. Les informations saisies ne permettent pas de modifier le contact \n";
                return true;
                }
            }
}


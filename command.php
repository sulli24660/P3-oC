<?php

class Command
{

    public ContactManager $contactManager;

    public function __construct(ContactManager $contactManager)
    {
    $this->contactManager = $contactManager;
    }

    public function list(): void
    {
        $contacts = $this->contactManager->findAll(); 

        foreach ($contacts as $contact) {
            echo $contact->__toString() . "\n";
        }
    }
}
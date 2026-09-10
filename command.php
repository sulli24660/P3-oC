<?php

class Command
{

private ContactManager $contactManager;

public function __construct(ContactManager $contactManager)
    {
    $this->contactManager = $contactManager;
    }
}
<?php
require_once 'Contact.php';

$test = new Contact(1, "John Doe", "john.doe@example.com");
echo "ID : " . $test->getId() . "\n";
echo "Nom : " . $test->getName() . "\n";
echo "Email : " . $test->getEmail() . "\n";
?>
<?php

class DBConnect
{
    public function getPDO(): PDO
    {
        $dsn = 'mysql:dbname=' . $_ENV['DB_NAME'] . ';host=' . $_ENV['DB_HOST'] . ';charset=utf8';

        return new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
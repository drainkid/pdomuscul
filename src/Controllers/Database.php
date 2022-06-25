<?php

namespace Controllers;

use Exception;
use PDO;

class Database
{
    private PDO $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=chatik',
                'newuser',
                'password'
            );
            $this->pdo->exec('CREATE TABLE IF NOT EXISTS messages(date_time varchar(255), login varchar(255), text varchar(255))');
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addMessage($date, $login, $text) {
        $command = 'INSERT INTO messages VALUES (:date, :login , :text)';
        $tmp = $this->pdo->prepare($command);
        $tmp->bindParam('date', $date, PDO::PARAM_STR);
        $tmp->bindParam('login', $login, PDO::PARAM_STR);
        $tmp->bindParam('text', $text, PDO::PARAM_STR);
        $tmp->execute();
    }

    public function getMessages()
    {
        $statement = 'SELECT * FROM messages;';
        $result = $this->pdo->prepare($statement);
        $result->execute();
        return $result;
    }
}
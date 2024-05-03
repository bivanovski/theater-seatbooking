<?php

namespace Genres;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;
use PDO;

class Genre
{
    protected $id;
    protected $genre;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }
    public function store() {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();
    
        // Prepare SQL without 'id' since it's auto-generated
        $statement = $connection->prepare('INSERT INTO `genres` (`genre`) VALUES (:genre)');
    
        $data = ['genre' => $this->genre]; // Only include 'genre'
    
        $res = $statement->execute($data); // Execute the prepared statement
    
        if (!$res) {
            error_log("Failed to insert record: " . implode(', ', $statement->errorInfo()));
        }
    
        $connectionObj->destroy(); // Close the connection
        return $res;
    }
    public static function findById($id)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT * FROM `genres` WHERE `id` = :id');
        $statement->execute(['id' => $id]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            error_log("Record not found for ID: " . $id);
        }

        $connectionObj->destroy();
        return $result;
    }
    public function update()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('UPDATE `genres` SET `genre` = :genre WHERE `id` = :id');

        $data = [
            'id' => $this->id,
            'genre' => $this->genre
        ];

        $res = $statement->execute($data);

        if (!$res) {
            error_log("Failed to update record: " . implode(', ', $statement->errorInfo()));
        }

        $connectionObj->destroy();
        return $res;
    }
    public function delete()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('DELETE FROM `genres` WHERE `id` = :id');
        
        $res = $statement->execute(['id' => $this->id]);

        if (!$res) {
            error_log("Failed to delete record: " . implode(', ', $statement->errorInfo()));
        }

        $connectionObj->destroy();
        return $res;
    }

}

?>

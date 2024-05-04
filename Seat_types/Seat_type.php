<?php

namespace Seat_types; // Updated namespace

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection;
use PDO;

class Seat_type // Updated class name
{
    protected $id;
    protected $type; // Property for 'types'
    protected $price; // Property for 'price'

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getTypes() // Getter for 'types'
    {
        return $this->type;
    }

    public function setTypes($type) // Setter for 'types'
    {
        $this->type = $type;
        return $this;
    }

    public function getPrice() // Getter for 'price'
    {
        return $this->price;
    }

    public function setPrice($price) // Setter for 'price'
    {
        $this->price = $price;
        return $this;
    }

    public function store()
    {
        $connectionObj = new Connection(); // Create connection object
        $connection = $connectionObj->getConnection(); // Get the PDO connection

        // Prepare the SQL statement with the correct table and parameters
        $statement = $connection->prepare('INSERT INTO `seat_types` (`type`, `price`) VALUES (:type, :price)');
    
        // Data to be used in the prepared statement
        $data = [
            'type' => $this->type,
            'price' => $this->price,
        ];
    
        // Execute the prepared statement with data
        $res = $statement->execute($data); 
    
        if (!$res) { // If execution fails, log the error
            error_log("Failed to insert record: " . implode(', ', $statement->errorInfo()));
        }
    
        $connectionObj->destroy(); // Close the connection
        return $res;
    }

    public static function findById($id)
    {
        $connectionObj = new Connection(); // Create connection object
        $connection = $connectionObj->getConnection(); // Get the PDO connection

        // Prepare the SQL statement to find a record by ID
        $statement = $connection->prepare('SELECT * FROM `seat_types` WHERE `id` = :id');
        
        // Execute with the ID parameter
        $statement->execute(['id' => $id]);
        
        // Fetch the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$result) { // If no record is found, log the error
            error_log("Record not found for ID: " . $id);
        }

        $connectionObj->destroy(); // Close the connection
        return $result;
    }

    public function update()
    {
        $connectionObj = new Connection(); // Create connection object
        $connection = $connectionObj->getConnection(); // Get the PDO connection

        // Prepare the SQL statement to update a record by ID
        $statement = $connection->prepare('UPDATE `seat_types` SET `type` = :type, `price` = :price WHERE `id` = :id');

        $data = [
            'id' => $this->id,
            'type' => $this->type,
            'price' => $this->price,
        ];

        $res = $statement->execute($data); // Execute the statement

        if (!$res) { // If the execution fails, log the error
            error_log("Failed to update record: " . implode(', ', $statement->errorInfo()));
        }

        $connectionObj->destroy(); // Close the connection
        return $res;
    }

    public function delete()
    {
        $connectionObj = new Connection(); // Create connection object
        $connection = $connectionObj->getConnection(); // Get the PDO connection

        // Prepare the SQL statement to delete a record by ID
        $statement = $connection->prepare('DELETE FROM `seat_types` WHERE `id` = :id');

        $res = $statement->execute(['id' => $this->id]); // Execute with ID parameter
        
        if (!$res) { // If deletion fails, log the error
            error_log("Failed to delete record: " . implode(', ', $statement->errorInfo()));
        }

        $connectionObj->destroy(); // Close the connection
        return $res;
    }
}

?>

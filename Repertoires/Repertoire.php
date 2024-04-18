<?php

namespace Repertoires;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;
use PDO;
class Repertoire
{
    protected $id;

    protected $show_id;

    protected $date_time;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getShow_id()
    {
        return $this->show_id;
    }

    public function setShow_id($show_id)
    {
        $this->show_id = $show_id;

        return $this;
    }

    public function getDatetime()
    {
        return $this->date_time;
    }

    public function setDatetime($date_time)
    {
        $this->date_time = $date_time;

        return $this;
    }

    public function store()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('INSERT INTO 
                            `repertoire` ( `id`, `show_id`, `date_time`) 
                            VALUES (:id, :show_id, :date_time)'
        );

        $data = [
            'id' => $this->id,
            'show_id' => $this->show_id,
            'date_time' => $this->date_time
        ];

        $res = $statement->execute($data);

        $connectionObj->destroy();
        return $res;
    }

    public static function findById($id)
    {
        $connectionObj = new Connection();
            $connection = $connectionObj->getConnection();

            $statement = $connection->prepare('SELECT r.*, s.*,
                                                      g.genre AS genre_name
                                              FROM `repertoire` AS r
                                              INNER JOIN `shows` AS s ON r.show_id = s.id
                                              INNER JOIN `genres` AS g ON s.genre_id = g.id
                                              WHERE r.`id` = :id');
            $statement->execute(['id' => $id]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $connectionObj->destroy();
            return $result;
    }

    public function update()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('UPDATE `repertoire` SET `show_id` = :show_id, `date_time` = :date_time WHERE `id` = :id');

        $data = [
            'id' => $this->id,
            'show_id' => $this->show_id,
            'date_time' => $this->date_time
        ];

        $res = $statement->execute($data);

        $connectionObj->destroy();
        return $res;
    }

    public function delete()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('DELETE FROM `repertoire` WHERE `id` = :id');
        $res = $statement->execute(['id' => $this->id]);

        $connectionObj->destroy();
        return $res;
    }
    public function getByShow($show_id)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();
    
        $statement = $connection->prepare('SELECT * FROM `repertoire` WHERE `show_id` = :show_id');
        $statement->execute(['show_id' => $show_id]);
    
        $errorInfo = $statement->errorInfo();
        if ($errorInfo[0] !== '00000') {
            error_log("Database error: " . $errorInfo[2]);
            return null;
        }
    
        $repertoires = [];
        while ($row = $statement->fetch()) {
            $repertoire = new Repertoire();
            $repertoire->setId($row['id'])
                       ->setShow_id($row['show_id'])
                       ->setDatetime($row['date_time']);
            $repertoires[] = $repertoire;
        }
    
        $connectionObj->destroy();
    
        return $repertoires;
    }
    

}

?>
<?php

namespace Repertoires;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;

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

        $statement = $connection->prepare('SELECT r.*, s.* 
        FROM `repertoire` AS r
        INNER JOIN `shows` AS s ON r.show_id = s.id
        WHERE r.`id` = :id');

        $statement->execute(['id' => $id]);

        // Check for errors
        $errorInfo = $statement->errorInfo();
        if ($errorInfo[0] !== '00000') {
            // Handle error (e.g., log it)
            error_log("Database error: " . $errorInfo[2]);
            return null;
        }

        $result = $statement->fetch();

        $connectionObj->destroy();

        if (!$result) {
            return null;
        }

        $repertoire = new Repertoire();
        $repertoire->setId($result['id'])
            ->setShow_id($result['show_id'])
            ->setDatetime($result['date_time']);

        return $repertoire;
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


}

?>
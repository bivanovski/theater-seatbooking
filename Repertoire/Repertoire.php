<?php

namespace Repertoire;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;

class Repertoire
{
    protected $id;

    protected $show_id;

    protected $datetime;

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
        return $this->datetime;
    }

    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function store()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('INSERT INTO 
                            `repertoire` ( `id`, `show_id`, `datetime`) 
                            VALUES (:id, :show_id, :datetime)'
        );

        $data = [
            'id' => $this->id,
            'show_id' => $this->show_id,
            'datetime' => $this->datetime
        ];

        $res = $statement->execute($data);

        $connectionObj->destroy();
        return $res;
    }

    public static function findById($id)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT r.*, s.name AS show_name 
                                       FROM `repertoire` AS r
                                       INNER JOIN `shows` AS s ON r.show_id = s.id
                                       WHERE r.`id` = :id');
        $statement->execute(['id' => $id]);

        $result = $statement->fetch();

        $connectionObj->destroy();

        if (!$result) {
            return null;
        }

        $repertoire = new Repertoire();
        $repertoire->setId($result['id'])
            ->setShow_id($result['show_id'])
            ->setDatetime($result['datetime']);

        return $repertoire;
    }

    public function update()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('UPDATE `repertoire` SET `show_id` = :show_id, `datetime` = :datetime WHERE `id` = :id');

        $data = [
            'id' => $this->id,
            'show_id' => $this->show_id,
            'datetime' => $this->datetime
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
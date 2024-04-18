<?php

namespace Reservations;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;

class Reservation
{
    protected $id;
    protected $user_id;
    protected $row;
    protected $seat_num;
    protected $repertoire_id;
    protected $seat_type_id;
    protected $is_confirmed;


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

    }

    public function getUserId()
    {
        return $this->user_id;
    }


    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

    }

    public function getRow()
    {
        return $this->row;
    }


    public function setRow($row)
    {
        $this->row = $row;

    }

    public function getSeatNum()
    {
        return $this->seat_num;
    }

    function setSeatNum($seat_num)
    {
        $this->seat_num = $seat_num;

    }


    public function getRepertoireId()
    {
        return $this->repertoire_id;
    }


    public function setRepertoireId($repertoire_id)
    {
        $this->repertoire_id = $repertoire_id;

    }

    public function getSeatTypeId()
    {
        return $this->seat_type_id;
    }

    public function setSeatTypeId($seat_type_id)
    {
        $this->seat_type_id = $seat_type_id;

    }


    public function getIsConfirmed()
    {
        return $this->is_confirmed;
    }

    public function setIsConfirmed($is_confirmed)
    {
        $this->is_confirmed = $is_confirmed;

    }
    public function store()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare(
            'INSERT INTO
            `reservations` (`user_id`,`row`,`seat_num`,`repertoire_id`,`seat_type_id`)
            VALUES (:user_id,:row,:seat_num,:repertoire_id,:seat_type_id)'
        );

        $data = [
            'user_id' => $this->user_id,
            'row' => $this->row,
            'seat_num' => $this->seat_num,
            'repertoire_id' => $this->repertoire_id,
            'seat_type_id' => $this->seat_type_id,
        ];

        $res = $statement->execute($data);

        $connectionObj->destroy();
        return $res;
    }

    

}
<?php

namespace Reservations;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;
use PDO;

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
    public static function getUserReservationCountForRepertoire($userId, $repertoireId)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT COUNT(*) AS num_reservations FROM `reservations` WHERE `user_id` = :user_id AND `repertoire_id` = :repertoire_id');
        $statement->execute(['user_id' => $userId, 'repertoire_id' => $repertoireId]);
        $numReservations = $statement->fetchColumn();

        $connectionObj->destroy();

        return $numReservations;
    }


    public function update()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('UPDATE `reservations` SET `id` = :id, `user_id` = :user_id, `row` = :row, `seat_num` = :seat_num, `repertoire_id` = :repertoire_id, `seat_type_id` = :seat_type_id, `is_confirmed` = :is_confirmed WHERE `id` = :id');

        $data = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'row' => $this->row,
            'seat_num' => $this->seat_num,
            'repertoire_id' => $this->repertoire_id,
            'seat_type_id' => $this->seat_type_id,
            'is_confirmed' => $this->is_confirmed
        ];

        $res = $statement->execute($data);

        $connectionObj->destroy();
        return $res;
    }

    public function delete()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('DELETE FROM `reservations` WHERE `id` = :id');
        $res = $statement->execute(['id' => $this->id]);

        $connectionObj->destroy();
        return $res;
    }

    public function getReservationDetails($id)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $reservationStatement = $connection->prepare('
        SELECT * FROM reservations WHERE id = :id
    ');
        $reservationStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $reservationStatement->execute();
        $reservationData = $reservationStatement->fetch(PDO::FETCH_ASSOC);

        $userStatement = $connection->prepare('
        SELECT id, email, first_name, last_name FROM users WHERE id = :user_id
    ');
        $userStatement->bindParam(':user_id', $reservationData['user_id'], PDO::PARAM_INT);
        $userStatement->execute();
        $userData = $userStatement->fetch(PDO::FETCH_ASSOC);

        $repertoireStatement = $connection->prepare('
        SELECT * FROM repertoire WHERE id = :repertoire_id
    ');
        $repertoireStatement->bindParam(':repertoire_id', $reservationData['repertoire_id'], PDO::PARAM_INT);
        $repertoireStatement->execute();
        $repertoireData = $repertoireStatement->fetch(PDO::FETCH_ASSOC);

        $reservationData['user_data'] = $userData;
        $reservationData['repertoire_data'] = $repertoireData;

        $connectionObj->destroy();

        return $reservationData;
    }

    public function getReservationsByRepertoireId($repertoireId)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT * FROM `reservations` WHERE `repertoire_id` = :repertoire_id');
        $statement->execute(['repertoire_id' => $repertoireId]);

        $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);

        $connectionObj->destroy();

        return $reservations;
    }

    public function getReservationsByUserIdGroupedByRepertoire($userId)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('
        SELECT 
            reservations.repertoire_id,
            repertoire.date_time AS repertoire_date_time,
            GROUP_CONCAT(reservations.id) AS reservation_ids,
            COUNT(*) AS total_reservations
        FROM 
            reservations
        INNER JOIN 
            repertoire ON reservations.repertoire_id = repertoire.id
        WHERE 
            reservations.user_id = :user_id
        GROUP BY 
            reservations.repertoire_id
    ');

        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);


        foreach ($reservations as &$repertoire) {
            $repertoireStatement = $connection->prepare('
            SELECT * FROM reservations WHERE user_id = :user_id AND repertoire_id = :repertoire_id
        ');
            $repertoireStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $repertoireStatement->bindParam(':repertoire_id', $repertoire['repertoire_id'], PDO::PARAM_INT);
            $repertoireStatement->execute();
            $repertoire['reservations'] = $repertoireStatement->fetchAll(PDO::FETCH_ASSOC);
        }

        $connectionObj->destroy();

        return $reservations;
    }

    public function getReservationsByRepertoireIdGroupedByUser($repertoireId)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('
        SELECT 
            reservations.user_id,
            users.email,
            users.first_name,
            users.last_name,
            reservations.row,
            reservations.seat_num,
            reservations.is_confirmed,
            seat_types.type,
            seat_types.price
        FROM 
            reservations
        INNER JOIN 
            users ON reservations.user_id = users.id
        JOIN 
            seat_types ON reservations.seat_type_id=seat_types.id
        WHERE 
            reservations.repertoire_id = :repertoire_id
        ORDER BY 
            users.first_name, users.last_name
    ');
        $statement->execute(['repertoire_id' => $repertoireId]);

        $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);

        $groupedReservations = [];

        foreach ($reservations as $reservation) {
            $userId = $reservation['user_id'];
            if (!isset($groupedReservations[$userId])) {
                $groupedReservations[$userId] = [
                    'user_id' => $userId,
                    'email' => $reservation['email'],
                    'first_name' => $reservation['first_name'],
                    'last_name' => $reservation['last_name'],
                    'reservations' => []
                ];
            }

            $groupedReservations[$userId]['reservations'][] = [
                'row' => $reservation['row'],
                'seat_num' => $reservation['seat_num'],
                'is_confirmed' => $reservation['is_confirmed'],
                'seat_type'=>$reservation['type'],
                'price'=>$reservation['price'],
            ];
        }

        $connectionObj->destroy();

        return array_values($groupedReservations);
    }
    public function toggleConfirmationForUser($userId, $repertoireId, $is_confirmed)
{
    $connectionObj = new Connection();
    $connection = $connectionObj->getConnection();

    $updateStatement = $connection->prepare('UPDATE reservations SET is_confirmed = :is_confirmed WHERE user_id = :userId AND repertoire_id = :repertoireId');
    $newConfirmation = $is_confirmed ? 1 : 0;
    $updateStatement->bindParam(':is_confirmed', $newConfirmation, PDO::PARAM_INT);
    $updateStatement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $updateStatement->bindParam(':repertoireId', $repertoireId, PDO::PARAM_INT);

    try {
        $updateStatement->execute();
        $rowCount = $updateStatement->rowCount();
        if ($rowCount > 0) {
            // Update successful
            return true;
        } else {
            // No rows affected, possibly no matching records found
            return false;
        }
    } catch (PDOException $e) {
        // Log the error message for debugging
        $this->logger->log('Error: ' . $e->getMessage());
        return false;
    }
}

    public static function checkReservationExists($reservationId)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT COUNT(*) FROM `reservations` WHERE `id` = :reservation_id');
        $statement->execute(['reservation_id' => $reservationId]);
        $numRows = $statement->fetchColumn();

        $connectionObj->destroy();

        return ($numRows > 0);
    }


}
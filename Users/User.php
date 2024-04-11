<?php

namespace Users;

require_once(__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;

class User
{
    protected $id;
    protected $username;
    protected $password;
    protected $role_id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function getRoleId()
    {
        return $this->role_id;
    }


    public function authenticate(): bool
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindParam(':username', $this->username, \PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(\PDO::FETCH_ASSOC);
        $connectionObj->destroy();

        if (!empty($user) && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->password = $user['password'];
            $this->role_id = $user['role_id'];
            return true;
        }

        return false;
    }
    public function store() {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('INSERT INTO 
                            `users` (`username`, `password`) 
                            VALUES (:username, :password)'
        );

        $data = [
            'username' => $this->username,
            'password' => password_hash($this->password, PASSWORD_DEFAULT)
        ];

        $statement->execute($data);

        $connectionObj->destroy();
    }

    public function checkRole()
    {
        if (isset($this->role_id)) {
            if ($this->role_id == 1) {
                return "admin";
            } elseif ($this->role_id == 2) {
                return "user";
            }
        }
        return "unknown";
    }
    public function getByUsername($username)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindValue(':username', $username);
        $statement->execute();

        $connectionObj->destroy();

        $user = $statement->fetch(\PDO::FETCH_ASSOC);
        
        return $user;
    }

}
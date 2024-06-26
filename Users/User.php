<?php

namespace Users;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;

class User
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $password;
    protected $email;
    protected $role_id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getLastName()
    {
        return $this->last_name;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getRoleId()
    {
        return $this->role_id;
    }


    public function authenticate(): bool
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();
    
        $statement = $connection->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindParam(':email', $this->email, \PDO::PARAM_STR);
        $statement->execute();
    
        $user = $statement->fetch(\PDO::FETCH_ASSOC);
        $connectionObj->destroy();
    
        if (!empty($user) && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->email = $user['email'];
            $this->first_name = $user['first_name'];
            $this->last_name = $user['last_name'];
            $this->role_id = $user['role_id'];
            return true;
        }
    
        return false;
    }
    public function store()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('INSERT INTO 
                            `users` (`first_name`, `last_name`, `email`, `password`) 
                            VALUES (:first_name, :last_name, :email, :password)'
        );

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT)
        ];

        $statement->execute($data);
        $this->id = $connection->lastInsertId();

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
    public function getByEmail($email)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();

        $connectionObj->destroy();

        $user = $statement->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

}
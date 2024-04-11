<?php

namespace Shows;

require_once (__DIR__ . '/../Database/Connection.php');

use Database\Connection as Connection;

class Show
{
    protected $id;
    protected $name;
    protected $description;
    protected $genre_id;
    protected $director;
    protected $set_designer;
    protected $age_group;
    protected $hall_number;
    protected $costume_designer;
    protected $assistant_director;
    protected $stage_manager;
    protected $image;


    public function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;

    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getGenreId()
    {
        return $this->genre_id;
    }


    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;

    }

    public function getDirector()
    {
        return $this->director;
    }


    public function setDirector($director)
    {
        $this->director = $director;
    }

    public function getSetDesigner()
    {
        return $this->set_designer;
    }


    public function setSetDesigner($set_designer)
    {
        $this->set_designer = $set_designer;

    }


    public function getAgeGroup()
    {
        return $this->age_group;
    }


    public function setAgeGroup($age_group)
    {
        $this->age_group = $age_group;

    }

    public function getHallNumber()
    {
        return $this->hall_number;
    }

    public function setHallNumber($hall_number)
    {
        $this->hall_number = $hall_number;
    }

    public function getCostumeDesigner()
    {
        return $this->costume_designer;
    }

    public function setCostumeDesigner($costume_designer)
    {
        $this->costume_designer = $costume_designer;

    }

    public function getAssistantDirector()
    {
        return $this->assistant_director;
    }


    public function setAssistantDirector($assistant_director)
    {
        $this->assistant_director = $assistant_director;
    }


    public function getStageManager()
    {
        return $this->stage_manager;
    }


    public function setStageManager($stage_manager)
    {
        $this->stage_manager = $stage_manager;
    }


    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image)
    {
        $this->image = $image;
    }

    public function store()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare(
            'INSERT INTO
            `shows` (`name`,`description`,`genre_id`,`director`,`set_designer`,`age_group`, `hall_number`, `costum_designer`, `assistant_director`, `stage_manager`, `image`)
            VALUES (:name,:description,:genre_id,:director,:set_designer,:age_group,:hall_number, :costum_designer, :assistant_director, :stage_manager, :image)'
        );

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'genre_id' => $this->genre_id,
            'director' => $this->director,
            'set_designer' => $this->set_designer,
            'age_group' => $this->age_group,
            'hall_number' => $this->hall_number,
            'costum_designer' => $this->costume_designer,
            'assistant_director' => $this->assistant_director,
            'stage_manager' => $this->stage_manager,
            'image' => $this->image,
        ];

        $res = $statement->execute($data);

        $connectionObj->destroy();
        return $res;
    }

    public function getShowDetails($id)
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare("SELECT s.*, g.genre FROM shows AS s JOIN genres AS g ON s.genre_id = g.id WHERE s.id = :id");

        $statement->bindValue(':id', $id);

        $statement->execute();

        $connectionObj->destroy();
        $show = $statement->fetch(\PDO::FETCH_ASSOC);

        return $show;
    }

    public function update()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $statement = $connection->prepare(
            'UPDATE shows
            SET name = :name, description = :description, genre_id = :genre_id, director = :director, set_designer = :set_designer, age_group = :age_group, hall_number = :hall_number, costum_designer = :costum_designer, assistant_director = :assistant_director, stage_manager = :stage_manager, image=:image
            WHERE id = :id'
        );

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'genre_id' => $this->genre_id,
            'director' => $this->director,
            'set_designer' => $this->set_designer,
            'age_group' => $this->age_group,
            'hall_number' => $this->hall_number,
            'costum_designer' => $this->costume_designer,
            'assistant_director' => $this->assistant_director,
            'stage_manager' => $this->stage_manager,
            'image' => $this->image,
        ];

        $res = $statement->execute($data);

        $connectionObj->destroy();
        return $res;
    }
    public function get($selectedGenres = [], $selectedAgeGroups = [])
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();

        $query = "SELECT shows.*, genres.genre FROM shows JOIN genres ON shows.genre_id = genres.id";

        $conditions = [];
        $params = [];

        if (!empty($selectedGenres)) {
            $genrePlaceholders = implode(',', array_fill(0, count($selectedGenres), '?'));
            $conditions[] = "genres.id IN ($genrePlaceholders)";
            $params = array_merge($params, $selectedGenres);
        }

        if (!empty($selectedAgeGroups)) {
            $ageGroupPlaceholders = implode(',', array_fill(0, count($selectedAgeGroups), '?'));
            $conditions[] = "age_group IN ($ageGroupPlaceholders)";
            $params = array_merge($params, $selectedAgeGroups);
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $statement = $connection->prepare($query);

        foreach ($params as $index => $param) {
            $statement->bindValue($index + 1, $param, \PDO::PARAM_STR);
        }

        $statement->execute();

        $connectionObj->destroy();

        $shows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $shows;
    }
    public function delete()
    {
        $connectionObj = new Connection();
        $connection = $connectionObj->getConnection();
         //TODO: add later cascading deleting in repertoire
        $deleteShow = $connection->prepare('DELETE FROM shows WHERE id = :id');
        $deleteShow->bindValue(':id', $this->id);
        $success = $deleteShow->execute();
    
        $connectionObj->destroy();
        return $success;
    }

}
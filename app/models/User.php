<?php

namespace App\models;
use PDO;

class Players
{
    public $ID;
    public $USERNAME;
    public $PASSWORD;
    public $TEAMNAME;
    public $CAP;
    public $SLOTS;

    public function create()
    {
        $db = new Database("players");
        $hashed_password = password_hash($this->PASSWORD, PASSWORD_DEFAULT);
        $db->insert([
            "USERNAME" => $this->USERNAME,
            "PASSWORD" => $hashed_password,
            "TEAMNAME" => $this->TEAMNAME,
        ]);

        return true;
    }

    public function edit()
    {
        $db = new Database("players");
        $db->update('ID = ' . $this->ID, [
            "BID_WINNER" => $this->BID_WINNER,
            "BID_VALUE" => $this->BID_VALUE,
            "BID_YEARS" => $this->BID_YEARS,
        ]);

        return true;
    }

    public function remove()
    {
        return (new Database('players'))->delete("ID = '{$this->ID}'");
    }

    public function getSlug($attribute)
    {
        $slug = $this->$attribute;
        $slug = preg_replace('/\s+/', '+', $slug);

        return $slug;
    }

    public static function getPlayers($order = "'ID'")
    {
        return (new Database('players'))->select()->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function getPlayer($NBA_ID)
    {
        return (new Database("players"))->select("NBA_ID = $NBA_ID")->fetchObject(static::class);
    }

    public function getPosition(){
        if(!empty($this->POSITION2)) {
            return $this->POSITION1 . '/' . $this->POSITION2;
        }
        else {
            return $this->POSITION1;
        }
    }
}
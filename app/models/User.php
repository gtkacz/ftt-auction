<?php

namespace App\models;
use PDO;

class User
{
    public $ID;
    public $USERNAME;
    public $PASSWORD;
    public $TEAMNAME;
    public $CAP;
    public $SLOTS;

    public function create()
    {
        $db = new Database("users");
        $hashed_password = password_hash($this->PASSWORD, PASSWORD_DEFAULT);
        $db->insert([
            "USERNAME" => $this->USERNAME,
            "PASSWORD" => $hashed_password,
            "TEAMNAME" => $this->TEAMNAME
        ]);

        return true;
    }

    public static function getUser($USERNAME)
    {
        return (new Database("users"))->select("USERNAME = $USERNAME")->fetchObject(static::class);
    }

    public static function getUsers($order = "'ID'")
    {
        return (new Database('users'))->select()->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function getSlug($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }
}
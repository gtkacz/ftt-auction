<?php

namespace App\models;
use PDO;

class Players
{
    public $ID;
    public $NAME;
    public $POSITION1;
    public $POSITION2;
    public $PLAYER_TYPE;
    public $BID_VALUE;
    public $BID_DATE;
    public $BID_WINNER;

    public function create()
    {
        $db = new Database("players");
        $db->insert([
            "Name" => $this->Name,
            "Price" => $this->Price,
            "productType" => $this->productType,
            "productAttribute" => $this->productAttribute
        ]);

        return true;
    }

    public function edit($oldID)
    {
        $db = new Database("players");
        $db->update('ID = ' . $oldID, [
            "ID" => $this->ID,
            "Name" => $this->Name,
            "Price" => $this->Price,
            "productType" => $this->productType,
            "productAttribute" => $this->productAttribute
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

    public static function getPlayer($ID)
    {
        return (new Database("players"))->select("ID = $ID")->fetchObject(static::class);
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
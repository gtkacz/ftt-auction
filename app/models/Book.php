<?php

namespace App\models;

use PDO;

class Book extends Product
{
    public static function getProducts($where = "productType = 'Book'", $order = "'SKU'")
    {
        return (new Database('products'))->select($where, $order)->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function getProduct($SKU)
    {
        return (new Database("products"))->select("SKU = $SKU")->fetchObject(static::class);
    }

    public function createAttribute($data)
    {
        $this->productAttribute = $data['weight'];
    }

    public function attributeString(): string
    {
        return "Weight: $this->productAttribute KG";
    }

}
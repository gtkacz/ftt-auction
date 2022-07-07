<?php

namespace App\models;

use PDO;

class Furniture extends Product
{
    public static function getProducts($where = "productType = 'Furniture'", $order = "'SKU'")
    {
        return (new Database('products'))->select($where, $order)->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function getProduct($SKU)
    {
        return (new Database("products"))->select("SKU = $SKU")->fetchObject(static::class);
    }

    public function createAttribute($data)
    {
        $height = $data["height"];
        $width = $data["width"];
        $length = $data["length"];

        $this->productAttribute = "${height}x${width}x${length}";
    }

    public function attributeString(): string
    {
        return "Dimension: $this->productAttribute";
    }
}
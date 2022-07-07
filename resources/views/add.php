<?php

require_once("../../vendor/autoload.php");

use App\models\Book;
use App\models\DVD;
use App\models\Furniture;

if (isset($_POST["SKU"], $_POST["Name"], $_POST["Price"], $_POST["productType"])) {
    $productType = $_POST["productType"];

    $className = "App\\models\\$productType";

    $newProduct = new $className();

    $newProduct->SKU = $_POST["SKU"];
    $newProduct->Name = $_POST["Name"];
    $newProduct->Price = $_POST["Price"];
    $newProduct->productType = $productType;
    $newProduct->createAttribute($_POST);

    $newProduct->create();
}
header('location: index');
exit;
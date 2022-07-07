<?php

require_once("../../vendor/autoload.php");

use App\models\Book;
use App\models\DVD;
use App\models\Furniture;

if (isset($_POST["SKU"], $_POST["Name"], $_POST["Price"], $_POST["productType"])) {
    $productType = $_POST["productType"];
    $className = "App\\models\\$productType";

    print_r($_POST);

    $oldSKU = $_POST["oldSKU"];
    $oldSKU = "'$oldSKU'";

    $editProduct = call_user_func([$className, 'getProduct'], $oldSKU);
    
    $editProduct->SKU = $_POST["SKU"];
    $editProduct->Name = $_POST["Name"];
    $editProduct->Price = $_POST["Price"];
    $editProduct->productType = $productType;
    $editProduct->productAttribute = $_POST["productAttribute"];

    $editProduct->edit($oldSKU);
}
header('location: index');
exit;
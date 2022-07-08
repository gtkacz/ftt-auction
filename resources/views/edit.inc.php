<?php

require_once("../../vendor/autoload.php");

use App\models\User;

if (isset($_POST["username"], $_POST["password"], $_POST["teamname"])) {
    $className = "App\\models\\User";

    $newUser = new $className();

    $newUser->USERNAME = $_POST["username"];
    $newUser->PASSWORD = $_POST["password"];
    $newUser->TEAMNAME = $_POST["teamname"];
    $newUser->TEAMSLUG = $newUser->getSlug($_POST["teamname"]);

    $newUser->create();
    header('location: log-in?success=true');
}
exit;
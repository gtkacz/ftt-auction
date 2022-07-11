<?php

require_once("../../vendor/autoload.php");

use App\models\User;

if(isset($_POST["username"], $_POST["teamname"])) {
    $className = "App\\models\\User";

    $username = $_POST["username"];
    $username = "'$username'";
    $newUser = call_user_func([$className, 'getUser'], $username);

    $newUser->USERNAME = $_POST["username"];
    $newUser->TEAMNAME = $_POST["teamname"];
    $newUser->TEAMSLUG = $newUser->getSlug($_POST["teamname"]);
    $newUser->CAP = $_POST["usercap"] * 1000000;
    $newUser->SLOTS = $_POST["userslots"];
    $newUser->IS_COMMISSIONER = $_POST["usercms"];

    $newUser->edit_user();
    header('location: admin?success=true');
}
exit;
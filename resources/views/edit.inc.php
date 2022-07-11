<?php

require_once("../../vendor/autoload.php");

use App\models\User;

if(isset($_POST["username"], $_POST["password"], $_POST["teamname"])) {
    $className = "App\\models\\User";
    echo 'rola';

    if(!isset($_GET["user"])){
        $newUser = new $className();
    }
    else{
        echo 'pinto';
        $username = $_POST["username"];
        $username = "'$username'";
        $newUser = call_user_func([$className, 'getUser'], $username);
    }


    $newUser->USERNAME = $_POST["username"];
    $newUser->PASSWORD = $_POST["password"];
    $newUser->TEAMNAME = $_POST["teamname"];
    $newUser->TEAMSLUG = $newUser->getSlug($_POST["teamname"]);

    if(!isset($_GET["user"])){
        $newUser->create();
        header('location: log-in?success=true');
    }
    else{
        echo 'penis';
    }
}
exit;
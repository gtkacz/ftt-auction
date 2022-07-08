<?php

require_once("../../vendor/autoload.php");

use App\models\User;

if (isset($_POST["username"], $_POST["password"])) {
    $className = "App\\models\\User";

    $username = $_POST["username"];
    $username = "'$username'";

    $user = call_user_func([$className, 'getUser'], $username);

    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (password_verify($_POST["password"], $user->PASSWORD)) {
        session_start();
        $_SESSION["username"] = $user->USERNAME;
        $_SESSION["userteam"] = $user->getSlug($user->TEAMNAME);
        $_SESSION["commissioner"] = $user->IS_COMMISSIONER;
        header('location: index');
        exit;
    } else {
        header('location: log-in?error=1');
    }
}
exit;
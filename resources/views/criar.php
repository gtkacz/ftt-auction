<?php

require_once("../../vendor/autoload.php");

use App\models\Players;
use App\models\User;

if (isset($_POST["user_team"], $_POST["player_name"], $_POST["bid_value"], $_POST["bid_years"])) {
    session_start();

    $className = "App\\models\\Players";
    $create_bid = call_user_func([$className, 'getPlayer'], $_POST["player_name"]);

    $className2 = "App\\models\\User";
    $username = $_SESSION["username"];
    $username = "'$username'";
    $user = call_user_func([$className2, 'getUser'], $username);
    
    $bid_millions = $_POST["bid_value"] * 1000000;

    if (isset($_GET["edit"])){
        $check1 = $create_bid->BID_VALUE < $bid_millions;
        $check2 = $create_bid->BID_YEARS < (int)$_POST["bid_years"];
        if(!($check1 || $check2)){
            header('location: edit-bid?error=true&ID=' . $_POST["player_name"]);
            exit;
        }
        else{
            $username2 = $create_bid->BID_WINNER;
            $username2 = "'$username2'";
            $user2 = call_user_func([$className2, 'getUser'], $username2);

            $user2->CAP += $create_bid->BID_VALUE;
            $user2->SLOTS += 1;
            $user2->edit_bid();
        }
    }

    $user->CAP -= $bid_millions;
    $user->SLOTS -= 1;
    $user->edit_bid();
    
    $create_bid->BID_WINNER = $_POST["user_team"];
    $create_bid->BID_VALUE = $bid_millions;
    $create_bid->BID_YEARS = $_POST["bid_years"];
    if (isset($_POST["team_option"])){
        $create_bid->has_to(1);
    }
    else{
        $create_bid->has_to(NULL);
    }

    date_default_timezone_set("America/Sao_Paulo");
    $now = (int) date('H');
    if ($now < 8){
        $create_bid->set_time('early');
    }
    elseif ($now > 21){
        $create_bid->set_time('late');
    }

    $create_bid->edit();
}
header('location: index');
exit;
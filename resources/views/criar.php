<?php

require_once("../../vendor/autoload.php");

use App\models\Players;

if (isset($_POST["user_team"], $_POST["player_name"], $_POST["bid_value"], $_POST["bid_years"])) {
    $className = "App\\models\\Players";
    $create_bid = call_user_func([$className, 'getPlayer'], $_POST["player_name"]);
    
    $bid_millions = $_POST["bid_value"] * 1000000;

    if (isset($_GET["edit"])){
        $check1 = $create_bid->BID_VALUE < $bid_millions;
        $check2 = $create_bid->BID_YEARS < (int)$_POST["bid_years"];
        if(!($check1 || $check2)){
            header('location: edit-bid?error=true&ID=' . $_POST["player_name"]);
            exit;
        }
    }

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
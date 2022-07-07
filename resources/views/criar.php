<?php

require_once("../../vendor/autoload.php");

use App\models\Players;

if (isset($_POST["user-team"], $_POST["player_id"], $_POST["bid_value"], $_POST["bid_years"])) {
    $className = "App\\models\\Players";
    $create_bid = call_user_func([$className, 'getPlayer'], $_POST["player_id"]);

    $bid_millions = $_POST["bid_value"] * 1000000;

    $create_bid->BID_WINNER = $_POST["user-team"];
    $create_bid->BID_VALUE = $bid_millions;
    $create_bid->BID_START_DATE = $_POST["bid_years"];

    $create_bid->edit($oldSKU);
}
header('location: index');
exit;
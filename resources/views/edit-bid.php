<?php

require_once("../../vendor/autoload.php");

include("partials/head.php");

use App\models\Players;
use App\models\User;

$allPlayers = Players::getPlayers();

if (isset($_GET["ID"])) {
    $className = "App\\models\\Players";

    $player = call_user_func([$className, 'getPlayer'], $_GET["ID"]);
} else {
    header('location: index');
    exit;
}

if (isset($_GET["error"])){
    echo '<script>alert("Bid inválido.")</script>';
}

$className2 = "App\\models\\User";
$username = $_SESSION["username"];
$username = "'$username'";
$user = call_user_func([$className2, 'getUser'], $username);
if($user->SLOTS < 1 || $user->CAP < $player->BID_VALUE){
    header('location: index?error=true');
    exit;
}

?>
<body>
<div class="container">
    <form method="post" action="criar?edit=true" autocomplete="off" id="player_form">
        <div class="title">
            <h2>Bidar <b><?= $player->NAME ?></b></h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Bidar</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='index'">Cancelar
                </button>
            </div>
        </div>

        <hr>
        <div class=preview>
        <div class="div-preview">
            <img id="preview" src="<?= 'https://cdn.nba.com/headshots/nba/latest/1040x760/' . $player->NBA_ID . '.png' ?>" alt="<?= $player->NAME  ?>" title="<?= $player->NAME  ?>">
        </div>
        <div class="form">
            <input type="hidden" value="<?= $_SESSION["username"] ?>" name="user_team">
            <input type="hidden" value="<?= $player->NBA_ID ?>" name="player_name">
            <div class="form-item">
                <label for="Price"><h4>Dê seu bid:</h4></label>
                <div>
                <!-- <span>$</span> -->
                <input id="bid_form" type="number" min="<?= $player->BID_VALUE / 1000000 ?>" max="30" value="<?= $player->BID_VALUE / 1000000 ?>"
                        oninput="validity.valid||(value='');" step="0.5" id="price" name="bid_value"
                        placeholder="Dê seu bid inicial"
                        oninvalid="this.setCustomValidity('Please, submit required data')"
                        oninput="this.setCustomValidity('')" required><span> milhões</span>
                </div>
                <div>
                <!-- <span>por</span> -->
                <input id="bid_years" type="number" onChange="update();" min="1" max="3" value="<?= $player->BID_YEARS ?>"
                        oninput="validity.valid||(value='');" step="1" id="price" name="bid_years"
                        placeholder="Dê seu bid inicial"
                        oninvalid="this.setCustomValidity('Please, submit required data')"
                        oninput="this.setCustomValidity('')" required>
                        <span> anos</span>
                    </div>
                    <div>
                    <span>TO</span>
                    <input type="checkbox" name="team_option" id="team_option"
                    <?php if($player->HAS_TO){echo "checked";} ?>
                    >
                    </div>
                    <br>
            </div>
        </div>
        </div>
    </form>
</div>
<?php include("partials/footer.php"); ?>
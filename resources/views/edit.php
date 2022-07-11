<?php

require_once("../../vendor/autoload.php");

include("partials/head.php");

use App\models\User;
use App\models\Players;

if($_GET["type"] == 'user'){
    $className = "App\\models\\User";

    $username = $_GET["username"];
    $username = "'$username'";

    $user = call_user_func([$className, 'getUser'], $username);

?>
<body>
<div class="container">
    <form method="post" action="edit.inc?user=true" autocomplete="off" id="edit_form">
        <div class="title">
            <h2>Editar o usuário <b><?= $user->USERNAME ?></b></h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Editar</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='admin'">Cancelar</button>
            </div>
        </div>

        <hr>

        <div class="form">
            <div class="form-item">
                <label for="username">Nome de usuário</label>
                <input type="text" maxlength="30" id="username" name="username" placeholder="Escolha seu nome de usuário" oninvalid="this.setCustomValidity('Nome de usuário inválido.')" oninput="this.setCustomValidity('')" value="<?= $user->USERNAME ?>" required><br>

                <label for="teamname">Nome do time</label>
                <input type="text" maxlength="30" id="teamname" name="teamname" placeholder="Escolha o nome do seu time" oninvalid="this.setCustomValidity('Nome de time inválido.')" oninput="this.setCustomValidity('')" value="<?= $user->TEAMNAME ?>" required><br>
                
                <label for="usercap">Cap (milhões)</label>
                <input type="number" min=0 max=130 id="usercap" name="usercap" oninvalid="this.setCustomValidity('Nome de time inválido.')" oninput="this.setCustomValidity('')" value="<?= $user->CAP / 1000000 ?>" step=0.5 required><br>
                
                <label for="userslots">Slots</label>
                <input type="number" min=0 max=15 id="userslots" name="userslots" oninvalid="this.setCustomValidity('Nome de time inválido.')" oninput="this.setCustomValidity('')" value="<?= $user->SLOTS ?>" required><br>
                
                <label for="usercms">É comissário</label>
                <input type="checkbox" id="usercms" name="usercms" oninvalid="this.setCustomValidity('Nome de time inválido.')" oninput="this.setCustomValidity('')" <?php if($user->IS_COMMISSIONER){echo "checked";} ?>><br>
            </div>
        </div>
    </form>
</div>

<?php }

if($_GET["type"] == 'player'){
    $className = "App\\models\\Players";

    $player = call_user_func([$className, 'getPlayer'], $_GET["playerid"]);
?>

<body>
<div class="container">
    <form method="post" action="edit.inc?user=true" autocomplete="off" id="edit_form">
        <div class="title">
            <h2>Editar o jogador <b><?= $player->NAME ?></b></h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Editar</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='admin'">Cancelar</button>
            </div>
        </div>

        <hr>

        <div class="form">
            <div class="form-item">
                <label for="username">Nome do jogador</label>
                <input type="text" maxlength="30" id="username" name="username" placeholder="Escolha seu nome de usuário" oninvalid="this.setCustomValidity('Nome de usuário inválido.')" oninput="this.setCustomValidity('')" value="<?= $player->NAME ?>" required><br>

                <label for="userslots">Posição 1</label>
                <select id="player_name" name="player_name" class="div-toggle" onChange="update_image()">
                    <option <?php if ($player->POSITION1 == "G"){echo "selected";} ?> value="G">G</option>
                    <option <?php if ($player->POSITION1 == "F"){echo "selected";} ?> value="F">F</option>
                    <option <?php if ($player->POSITION1 == "C"){echo "selected";} ?> value="C">C</option>
                </select>

                <label for="userslots">Posição 2</label>
                <select id="player_name" name="player_name" class="div-toggle" onChange="update_image()">
                    <option <?php if ($player->POSITION2 == "G"){echo "selected";} ?> value="G">G</option>
                    <option <?php if ($player->POSITION2 == "F"){echo "selected";} ?> value="F">F</option>
                    <option <?php if ($player->POSITION2 == "C"){echo "selected";} ?> value="C">C</option>
                </select>

                <label for="userslots">Slots</label>
                <input type="number" min=0 max=15 id="userslots" name="userslots" oninvalid="this.setCustomValidity('Nome de time inválido.')" oninput="this.setCustomValidity('')" value="<?= $player->PLAYER_TYPE ?>" required><br>
            </div>
        </div>
    </form>
</div>

<?php } ?>

<?php include("partials/footer.php"); ?>
<?php

require_once("../../vendor/autoload.php");

include("partials/head.php");

use App\models\Players;

$allPlayers = Players::getPlayers();
$results = "";

foreach ($allPlayers as $row) {
    if($row->BID_VALUE == '' && $row->PLAYER_TYPE != 'SIGNED'){
        $results .= '<option value="' . $row->NBA_ID . '">' . $row->NAME . '</option>';
    }
}
?>
<body>
<div class="container">
    <form method="post" action="criar" autocomplete="off" id="player_form">
        <div class="title">
            <h2>Criar leilão</h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Criar</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='index'">Cancelar
                </button>
            </div>
        </div>

        <hr>
        <div class=preview>
        <div class="div-preview">
            <img id="preview" src="<?= 'https://cdn.nba.com/headshots/nba/latest/1040x760/' . $row->NBA_ID . '.png' ?>" alt="" onerror="this.onerror=null;this.src='https://placeimg.com/200/300/animals';">
        </div>
        <div class="form">
            <input type="hidden" value="<?= $_SESSION["username"] ?>" name="user_team">
            <div class="form-item">
                <label for="player_name">Selecione o jogador que você quer bidar:</label>
                <select id="player_name" name="player_name" class="div-toggle" onChange="update_image()">
                    <?= $results ?>
                </select>
                <a id="player_stats" target="_blank" href="<?= 'https://www.nba.com/stats/player/' . $row->NBA_ID?>"><small>Estatísticas</small></a><br>
            </div>
            <div class="form-item">
                <label for="Price">Dê seu bid inicial:</label>

                <div>
                <!-- <span>$</span> -->
                <input id="bid_form" type="number" min="3.5" max="30" value="3.5"
                        oninput="validity.valid||(value='');" step="0.5" id="price" name="bid_value"
                        placeholder="Dê seu bid inicial"
                        oninvalid="this.setCustomValidity('Please, submit required data')"
                        oninput="this.setCustomValidity('')" required><span> milhões</span>
                </div>
                <div>
                <!-- <span>por</span> -->
                <input id="bid_years" type="number" onChange="update();" min="1" max="3" value="1"
                        oninput="validity.valid||(value='');" step="1" id="price" name="bid_years"
                        placeholder="Dê seu bid inicial"
                        oninvalid="this.setCustomValidity('Please, submit required data')"
                        oninput="this.setCustomValidity('')" required>
                        <span> anos</span>
                    </div>
                    <div>
                    <span>TO</span>
                    <input type="checkbox" name="team_option" id="team_option">
                    </div>
                    <br>
            </div>
        </div>
        </div>
    </form>
</div>
<?php include("partials/footer.php"); ?>
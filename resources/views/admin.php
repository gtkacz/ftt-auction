<?php

require_once("../../vendor/autoload.php");

use App\models\Players;
use App\models\User;

include("partials/head.php");

if (!isset($_SESSION["username"])){
    header('location: log-in?index=true');
}

if ($_SESSION["commissioner"] != 1){
    header('location: index?admin=true');
}

$allUsers = User::getUsers();
$allPlayers = Players::getPlayers();

$resultsUsers = "";
$resultsPlayers = "";

foreach ($allUsers as $row) {
    $resultsUsers .= '<tr>
                <td class="texto-bandeira"><a href="/edit?" class="a"><img src="resources/images/edit_black_24dp.svg" class="logo"/>' . $row->USERNAME . '</td>
                <td>' . $row->TEAMNAME . '</td>
                <td>' . number_format($row->CAP) . '</td>
                <td>' . number_format($row->SLOTS) . '</td>
                <td>' . number_format($row->IS_COMMISSIONER) . '</td>
            </tr>';
}

?>
<body>
<div class="container">
    <div class="title">
        <h2>Painel de administração</h2>
        <div>
            <button type="submit" class="btn btn-primary btn-size" onclick="window.location.href='admin'">Usuários</button>
            <button type="button" class="btn btn-primary btn-size" onclick="window.location.href='index'">Jogadores</button>
        </div>
    </div>

    <hr>

    <center>
    <table class="styled-table">
        <thead>
        <tr>
            <th><span class="a-titulo">Nome de usuário</span></th>
            <th><span class="a-titulo">Nome do time</span></th>
            <th><span class="a-titulo">Cap disponível</span></th>
            <th><span class="a-titulo">Slots disponíveis</span></th>
            <th><span class="a-titulo">É comissário</span></th>
        </tr>
        </thead>
        <tbody>
        <?= $resultsUsers ?>
        </tbody>
        </table>
    </center>
</div>
<?php include("partials/footer.php"); ?>
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

$result = "";

if (!isset($_GET["players"])){
    $columns = '<th><span class="a-titulo">Nome de usuário</span></th>
                <th><span class="a-titulo">Nome do time</span></th>
                <th><span class="a-titulo">Cap disponível</span></th>
                <th><span class="a-titulo">Slots disponíveis</span></th>
                <th><span class="a-titulo">É comissário</span></th>';
    foreach ($allUsers as $row) {
        $result .= '<tr>
                    <td class="texto-bandeira"><a href="/ftt/edit?user=true&username=' . $row->getSlug($row->USERNAME) . '" class="a"><img src="resources/images/edit_black_24dp.svg" class="logo"/>' . $row->USERNAME . '</td>
                    <td>' . $row->TEAMNAME . '</td>
                    <td>' . number_format($row->CAP) . '</td>
                    <td>' . number_format($row->SLOTS) . '</td>
                    <td>' . number_format($row->IS_COMMISSIONER) . '</td>
                </tr>';
    }
}

else{
    $columns = '<th><span class="a-titulo">Nome do jogador</span></th>
                <th><span class="a-titulo">Posição 1</span></th>
                <th><span class="a-titulo">Posição 2</span></th>
                <th><span class="a-titulo">Tipo</span></th>
                <th><span class="a-titulo">ID</span></th>
                <th><span class="a-titulo">Bid</span></th>
                ';
    foreach ($allPlayers as $row) {
        if ($row->PLAYER_TYPE != "SIGNED"){
            $result .= '<tr>
                            <td class="texto-bandeira"><a href="/ftt/edit?player=true&playername=' . $row->getSlug($row->NAME) . '" class="a"><img src="resources/images/edit_black_24dp.svg" class="logo"/>' . $row->NAME . '</td>
                            <td>' . $row->POSITION1 . '</td>
                            <td>' . $row->POSITION2 . '</td>
                            <td>' . $row->PLAYER_TYPE . '</td>
                            <td>' . $row->NBA_ID . '</td>
                            <td><a href="edit-bid?ID=' . $row->NBA_ID . '">Link</a></td>
                        </tr>';}
        else{
            $result .= '<tr>
                            <td class="texto-bandeira"><a href="/ftt/edit?player=true&playername=' . $row->getSlug($row->NAME) . '" class="a"><img src="resources/images/edit_black_24dp.svg" class="logo"/>' . $row->NAME . '</td>
                            <td>' . $row->POSITION1 . '</td>
                            <td>' . $row->POSITION2 . '</td>
                            <td>' . $row->PLAYER_TYPE . '</td>
                            <td>' . $row->NBA_ID . '</td>
                            <td>-</td>
                        </tr>';}
    }
}

?>
<body>
<div class="container">
    <div class="title">
        <h2>Painel de administração</h2>
        <div>
            <button type="submit" class="btn btn-primary btn-size" onclick="window.location.href='admin'">Usuários</button>
            <button type="button" class="btn btn-primary btn-size" onclick="window.location.href='admin?players=true'">Jogadores</button>
        </div>
    </div>

    <hr>

    <center>
    <table class="styled-table">
        <thead>
        <tr>
            <?= $columns ?>
        </tr>
        </thead>
        <tbody>
            <?= $result ?>
        </tbody>
        </table>
    </center>
</div>
<?php include("partials/footer.php"); ?>
<?php
require_once("vendor/autoload.php");

include("resources/views/partials/head.php");

use App\models\Players;

if (!isset($_SESSION["username"])){
    header('location: log-in?index=true');
}

$allPlayers = Players::getPlayers();

$results = "";

date_default_timezone_set("America/Sao_Paulo");

foreach ($allPlayers as $row) {
    $end_date_init = $row->BID_START_DATE;
    $end_date_raw = date('Y-m-d H:i:s', strtotime($end_date_init. ' + 1 days'));
    $end_date = str_replace(" ", "T", $end_date_raw);
    $date_obj = new DateTime($end_date_raw);
    $now = new DateTime();
    
    if($row->PLAYER_TYPE != 'SIGNED' && $row->BID_VALUE != ''){
        if($date_obj < $now) {
            $row->bid_over();
        } else {
            $interval = $date_obj->diff($now);
            $results .= '<div class="div-leilao">
            <div class="card hover-overlay hover-zoom hover-shadow ripple">
                <a href="resources/views/edit-bid?ID=' . $row->NBA_ID . '">
                <span title="Bidar esse jogador" class="edit-content">+</span>
                </a>
                <b>' . $row->NAME . '</b>
                <span>' . $row->getPosition() . '</span>
                <em>$ ' . number_format($row->BID_VALUE) . '</em>
                <em>' . $row->BID_YEARS . ' ano(s)</em>
                <em>' . $row->BID_WINNER . '</em>
            </div>
            <p>
                <span name="ticking_h" id="ticking_h">' . $interval->format('%h') . '</span><span>h </span
                <span name="ticking_m" id="ticking_m">' . $interval->format('%i') . '</span><span>min </span
                <span name="ticking_s" id="ticking_s">' . $interval->format('%s') . '</span><span>s </span
            </p>
            </div>
            ';
        }
    }
}

if(empty($results)){
    $results = "<em><h4>Nenhum leilão ativo.</h4></em>";
}

?>
<body>
<div class="container">
    <form method="post" action="resources/views/delete">
        <div class="title">
            <h2>Leilões ativos</h2>
            <div>
                <button type="button" class="btn btn-success btn-size" onclick="window.location.href='resources/views/criar-leilao'">
                    Criar leilão
                </button>
                <!-- <button type="submit" class="btn btn-danger btn-size" value="delete" name="but_delete"
                        id="delete-product-btn" disabled>MASS DELETE
                </button> -->
            </div>
        </div>

        <hr>

        <div class="row isotope-grid main-grid">
            <?= $results ?>
        </div>
    </form>
</div>
<?php include("resources/views/partials/footer.php"); ?>

<!-- <script>
    var countDownDate = new Date("' . $end_date . '").getTime();
    var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("demo").innerHTML = + hours + "h "
    + minutes + "min " + seconds + "s";
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Leilão encerrado.";
    }
    }, 1000);
</script> -->
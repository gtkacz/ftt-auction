<?php
require_once("vendor/autoload.php");

include("resources/views/partials/head.php");

use App\models\Players;

$allPlayers = Players::getPlayers();

$results = "";

foreach ($allPlayers as $row) {
    if($row->PLAYER_TYPE != 'SIGNED'){
        $end_date_raw = $row->BID_START_DATE;
        $end_date_raw = date('Y-m-d h:i:s', strtotime($end_date_raw. ' + 1 days'));
        $end_date = str_replace(" ", "T", $end_date_raw);
        
        $results .= '<div class="div-leilao">
        <div class="card hover-overlay hover-zoom hover-shadow ripple">
        <a href="resources/views/edit-product?ID=' . $row->getSlug("ID") . '">
        <span class="edit-content">+</span>
        </a>
        <b>' . $row->NAME . '</b>
        <span>' . $row->getPosition() . '</span>
        <span>' . $row->PLAYER_TYPE . '</span>
        <em>$ ' . number_format($row->BID_VALUE) . '</em>
        <em> Maior bid: ' . $row->BID_WINNER . '</em>
        </div>
        <script language="JavaScript">
        TargetDate = "'. $end_date . '";
        ForeColor = "black";
        CountActive = true;
        CountStepper = -1;
        LeadingZero = true;
        DisplayFormat = "%%H%% h %%M%% min %%S%% s";
        FinishMessage = "Leilão encerrado.";
        </script>
        <script language="JavaScript" src="https://rhashemian.github.io/js/countdown.js"></script>
        </div>';
    }
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
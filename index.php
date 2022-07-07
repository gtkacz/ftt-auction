<?php
require_once("vendor/autoload.php");

include("resources/views/partials/head.php");

use App\models\Players;

$allProducts = Players::getPlayers();

$results = "";

foreach ($allProducts as $row) {
    $results .= '<div class="div-leilao">
                    <div class="card hover-overlay hover-zoom hover-shadow ripple">
						<a href="resources/views/edit-product?ID=' . $row->getSlug("ID") . '">
							<span class="edit-content">+</span>
                        </a>
						<span>' . $row->NAME . '</span>
						<span>' . $row->getPosition() . '</span>
						<span>$ ' . number_format($row->BID_VALUE) . '</span>
						<span> Maior bid: ' . $row->BID_WINNER . '</span>
					</div>
                    <script language="JavaScript">
                        TargetDate = "2023-07-07T06:13:00";
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
?>
<body>
<div class="container">
    <form method="post" action="resources/views/delete">
        <div class="title">
            <h2>Leilões ativos</h2>
            <div>
                <button type="button" class="btn btn-success btn-size" onclick="window.location.href='resources/views/add-product'">
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
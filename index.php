<?php
require_once("vendor/autoload.php");

include("resources/views/partials/head.php");

use App\models\Book;
use App\models\DVD;
use App\models\Furniture;

$allDVD = DVD::getProducts();
$allBook = Book::getProducts();
$allFurniture = Furniture::getProducts();
$allProducts = array_merge($allDVD, $allBook, $allFurniture);
array_multisort(array_column($allProducts, 'SKU'), SORT_ASC, SORT_NATURAL | SORT_FLAG_CASE, $allProducts);

$results = "";

foreach ($allProducts as $row) {
    $results .= '<div class="div-leilao">
                    <div class="card hover-overlay hover-zoom hover-shadow ripple">
						<a href="resources/views/edit-product?SKU=' . $row->getSlug("SKU") . '&type=' . $row->productType . '">
							<span class="edit-content">+</span>
                        </a>
						<span>' . $row->SKU . '</span>
						<span>' . $row->Name . '</span>
						<span>' . $row->Price . ' $</span>
						<span>' . $row->attributeString() . '</span>
					</div>
                    <script language="JavaScript">
                        TargetDate = "2023-07-07T06:04:00";
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
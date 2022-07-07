<?php

require_once("../../vendor/autoload.php");

use App\models\Book;
use App\models\DVD;
use App\models\Furniture;

if (isset($_GET["SKU"], $_GET["type"])) {
    $productType = $_GET["type"];
    $className = "App\\models\\$productType";

    $SKU = $_GET["SKU"];
    $SKU = str_replace('+', ' ', $SKU);
    $SKU = "'$SKU'";

    $product = call_user_func([$className, 'getProduct'], $SKU);
} else {
    header('location: index');
    exit;
}

include("partials/head.php");
?>
<body>
<div class="container">
    <form method="post" action="edit" autocomplete="off" id="product_form">
        <div class="title">
            <h2>Product Edit</h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Save</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='index'">Cancel
                </button>
            </div>
        </div>
        <center>
            <div class="card-edit">
                <input type="text" class="fake-input" placeholder="Edit SKU" id="sku" name="SKU"
                       value="<?= $product->SKU ?>" oninvalid="this.setCustomValidity('Please, submit required data')"
                oninput="this.setCustomValidity('')" required><br>
                <input type="text" class="fake-input" placeholder="Edit name" id="name" name="Name"
                       value="<?= $product->Name ?>" oninvalid="this.setCustomValidity('Please, submit required
                       data')" oninput="this.setCustomValidity('')" required><br>
                <input type="text" class="fake-input" placeholder="Edit price" pattern="[0-9]+" min="0"
                       oninput="validity.valid||(value='');" id="price" name="Price"
                       value=<?= $product->Price ?> oninvalid="this.setCustomValidity('Please, submit required
                       data')" oninput="this.setCustomValidity('')" required><br>
                <input type="hidden" id="productType" name="productType"
                       value=<?= $product->productType ?> required><br>
                <input type="hidden" id="oldSKU" name="oldSKU" value="<?= $product->SKU ?>" required><br>
                <input type="text" class="fake-input" placeholder="Edit attribute" id="productAttribute"
                       name="productAttribute"
                       value=<?= $product->productAttribute ?> oninvalid="this.setCustomValidity('Please, submit
                       required data')" oninput="this.setCustomValidity('')" required><br>
            </div>
        </center>
    </form>
</div>
<?php include("partials/footer.php"); ?>
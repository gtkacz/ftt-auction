<?php

require_once("../../vendor/autoload.php");

include("partials/head.php");

?>
<body>
<div class="container">
    <form method="post" action="add" autocomplete="off" id="product_form">
        <div class="title">
            <h2>Product Add</h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Save</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='index'">Cancel
                </button>
            </div>
        </div>

        <hr>
        <div class=preview>

            <div class="div-preview">
                <span>Live preview:</span>
                <div class="card-preview">
                    <span id="skuupdate">SKU</span>
                    <span id="nameupdate">Name</span>
                    <span id="priceupdate">Price</span>
                    <span id="attrupdate">Attribute</span>
                </div>
            </div>

            <div class="form">
                <div class="form-item">
                    <label for="SKU">SKU</label>
                    <input type="text" onChange="update('sku', 'skuupdate');" maxlength="30" id="sku" name="SKU"
                           placeholder="Enter product SKU"
                           oninvalid="this.setCustomValidity('Please, submit required data')"
                           oninput="this.setCustomValidity('')" required><br>
                </div>

                <div class="form-item">
                    <label for="Name">Name</label>
                    <input type="text" onChange="update('name', 'nameupdate');" maxlength="65" id="name" name="Name"
                           placeholder="Enter product name"
                           oninvalid="this.setCustomValidity('Please, submit required data')"
                           oninput="this.setCustomValidity('')" required><br>
                </div>

                <div class="form-item">
                    <label for="Price">Price</label>
                    <input type="number" onChange="update('price', 'priceupdate');" min="0"
                           oninput="validity.valid||(value='');" step="any" id="price" name="Price"
                           placeholder="Enter product price"
                           oninvalid="this.setCustomValidity('Please, submit required data')"
                           oninput="this.setCustomValidity('')" required><br>
                </div>

                <div class="form-item">
                    <label for="productType">Type Switcher</label>
                    <select id="productType" name="productType" class="div-toggle" data-target=".dynamic-show">
                        <option value="DVD" data-show=".dvd">DVD</option>
                        <option value="Furniture" data-show=".furniture">Furniture</option>
                        <option value="Book" data-show=".book">Book</option>
                    </select><br>
                </div>

                <div class="dynamic-show form-item">
                    <label for="size" class="dvd hide">Size (MB)</label>
                    <input type="number" onChange="update('size', 'attrupdate');" min="0"
                           oninput="validity.valid||(value='');" id="size" name="size" class="dvd hide"
                           placeholder="Enter product size" required>
                    <span class="description dvd hide">* Please provide the size of the contents of the CD in megabytes.</span><br>
                </div>

                <div class="dynamic-show form-item">
                    <label for="weight" class="book hide">Weight (KG)</label>
                    <input type="number" onChange="update('weight', 'attrupdate');" min="0"
                           oninput="validity.valid||(value='');" id="weight" name="weight" class="book hide"
                           placeholder="Enter product weight" required>
                    <span class="description book hide">* Please provide the weight of the book in kilograms.</span><br>
                </div>

                <div class="dynamic-show form-item">
                    <label for="height" class="furniture hide">Height (CM)</label>
                    <input type="number" onChange="update('height', 'attrupdate');" min="0"
                           oninput="validity.valid||(value='');" id="height" name="height" class="furniture hide"
                           placeholder="Enter product height" required>
                </div>
                <div class="dynamic-show form-item">
                    <label for="width" class="furniture hide">Width (CM)</label>
                    <input type="number" onChange="update('width', 'attrupdate');" min="0"
                           oninput="validity.valid||(value='');" id="width" name="width" class="furniture hide"
                           placeholder="Enter product width" required>
                </div>
                <div class="dynamic-show form-item">
                    <label for="length" class="furniture hide">Length (CM)</label>
                    <input type="number" onChange="update('length', 'attrupdate');" min="0"
                           oninput="validity.valid||(value='');" id="length" name="length" class="furniture hide"
                           placeholder="Enter product length" required>
                    <span class="description furniture hide">* Please provide the dimensions of the piece of furniture in centimeters.</span><br>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include("partials/footer.php"); ?>
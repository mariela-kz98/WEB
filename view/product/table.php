<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/product.service.php");

$product_service = new ProductService($pdo);

$collection = $product_service->all();

$resource_name = "product";
$table_header = "
    <th>Id</th>
    <th>Name</th>
    <th>Group ID</th>
    <th>Price</th>
    <th>Quantity</th>";

include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/table.php");

if (isset($_POST["delete"])) {
    $curr_id = $_POST["id"];

    $product_service->delete($curr_id);
}



?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap; ?>


</head>

<body>
    <form method="post" action="/storewebpr/view/product/filter.php">

        <div class="form-group">
            <label for="price">Search by price:</label>
            <input class="form-control" id="price" name="price" type="text">
        </div>

        <input class="btn btn-primary" type="submit" name="filter-price" value="Filter">

        <div class="form-group">
            <label for="name">Search by name:</label>
            <input class="form-control" id="name" name="name" type="text">
        </div>

        <input class="btn btn-primary" type="submit" name="filter-name" value="Filter">

        <div class="form-group">
            <label for="group">Search by group:</label>
            <input class="form-control" id="group" name="group" type="text">
        </div>

        <input class="btn btn-primary" type="submit" name="filter-group" value="Filter">

    </form>
</body>

</html>
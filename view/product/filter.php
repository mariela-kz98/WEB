<!DOCTYPE html>
<html>

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap; ?>
</head>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/product.service.php");


$product_service = new ProductService($pdo);
$filtered_products = [];

if (isset($_POST["filter-price"])) {
    $price = $_POST["price"];

    $filtered_products = $product_service->search_price($price);
} else if (isset($_POST["filter-name"])) {

    $name = $_POST["name"];

    $filtered_products = $product_service->search_name($name);
} else if (isset($_POST["filter-group"])) {

    $group = $_POST["group"];

    $filtered_products = $product_service->search_group($group);
}
?>

<table class="table">
    <thead>
        <tr>
            <!-- <?php echo $table_header ?> -->

            <th>ID</th>
            <th>Name</th>
            <th>Group</th>
            <th>Price</th>
            <th>Quantity</th>
            <?php foreach ($filtered_products as $current_product) : ?>
        <tr>
    </thead>

    <?php foreach ($current_product as $key => $value) : ?>
        <td><?php echo $value ?></td>
    <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</tr>
</table>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap; ?>
</head>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/delivery.service.php");


$delivery_service = new DeliveryService($pdo);
$filtered_deliveries = [];

if (isset($_POST["filter-supplier"])) {
    $supplier = $_POST["supplier"];

    $filtered_deliveries = $delivery_service->search_supplier($supplier);
}
?>

<table class="table">
    <thead>
        <tr>
            <!-- <?php echo $table_header ?> -->

            <th>ID</th>
            <th>Product</th>
            <th>Group</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Supplier</th>
            <?php foreach ($filtered_deliveries as $current_delivery) : ?>
        <tr>
    </thead>

    <?php foreach ($current_delivery as $key => $value) : ?>
        <td><?php echo $value ?></td>
    <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</tr>
</table>

</body>

</html>
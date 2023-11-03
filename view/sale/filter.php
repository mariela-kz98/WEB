<!DOCTYPE html>
<html>

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap; ?>
</head>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/sale.service.php");


$sale_service = new SaleService($pdo);
$filtered_sales = [];

if (isset($_POST["filter-date"])) {
    $date = $_POST["date"];

    $filtered_sales = $sale_service->search_date($date);
} else if (isset($_POST["filter-employee"])) {
    $employee = $_POST["employee"];

    $filtered_sales = $sale_service->search_empdate($employee);
} else if (isset($_POST["filter-customer"])) {
    $customer = $_POST["customer"];

    $filtered_sales = $sale_service->search_customer($customer);
}
?>

<table class="table">
    <thead>
        <tr>
            <!-- <?php echo $table_header ?> -->

            <th>ID</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Employee</th>
            <th>Date</th>
            <th>Price</th>
            <?php foreach ($filtered_sales as $current_sale) : ?>
        <tr>
    </thead>

    <?php foreach ($current_sale as $key => $value) : ?>
        <td><?php echo $value ?></td>
    <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</tr>
</table>

</body>

</html>
<!DOCTYPE html>
<html>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
echo $bootstrap; ?>
<head>

</head>

<body>
    <form method="post">

        <h1>Create Delivery</h1>

        <!--$product_id, $group_id, $price, $quantity, $supplier_id -->

        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/group.service.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/product.service.php");

        $product_service = new ProductService($pdo);
        $all_products = $product_service->all();

        echo "
        <div class=form-group>
            <label for=product_id>Product:</label>
            <select class=form-control name=product_id id=product_id>
        ";
        foreach ($all_products as $curr_product) {
            echo "<option value=$curr_product->id>$curr_product->name</option>";
        }

        echo " </select></div>";

        $group_service = new GroupServices($pdo);
        $all_groups = $group_service->all();

        echo "<div class=form-group>
            <label for=group_id>Group:</label>
            <select class=form-control  name=group_id id=group_id>";

        foreach ($all_groups as $curr_group) {
            echo "<option value=$curr_group->id>$curr_group->name</option>";
        }

        echo " </select></div>";
        ?>

        <div class="form-group">
            <label for="price">Price:</label>
            <input class="form-control" id="price" name="price" type="text">
        </div>


        <div class="form-group">
            <label for="quantity">Phone:</label>
            <input input class="form-control" id="quantity" name="quantity" type="text">
        </div>


        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/supplier.service.php");

        $supplier_service = new SupplierService($pdo);
        $all_supplier = $supplier_service->all();

        echo "<div class=form-group>
                <label for=supplier_id>Supplier:</label>
                <select input class=form-control name=supplier_id id=supplier_id>";


        foreach ($all_supplier as $curr_supplier) {
            echo "<option value=$curr_supplier->id>$curr_supplier->name</option>";
        }

        echo " </select></div>";
        ?>

        <br />
        <input class="btn btn-primary" type="submit" name="create" value="Create">

    </form>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/delivery.service.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");

    if (isset($_POST["create"])) {
        $product_id = $_POST["product_id"];
        $group_id = $_POST["group_id"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $supplier_id = $_POST["supplier_id"];

        $delivery_service = new DeliveryService($pdo);
        $delivery = $delivery_service->create($product_id, $group_id, $price, $quantity, $supplier_id);
    }

    ?>
</body>

</html>
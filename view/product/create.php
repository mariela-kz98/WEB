<!DOCTYPE html>
<html>

<head>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
echo $bootstrap; ?>

</head>

<body>
    <form method="post">

        <h1>Create Product</h1>

        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" id="name" name="name" type="text">
        </div>

        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/group.service.php");

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
            <label for="quantity">Quantity:</label>
            <input class="form-control" id="quantity" name="quantity" type="text">
        </div>
        <br />
        <input class="btn btn-primary" type="submit" name="create" value="Create">

    </form>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/product.service.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");

    if (isset($_POST["create"])) {
        $name = $_POST["name"];
        $group_id = $_POST["group_id"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];

        $product_service = new ProductService($pdo);
        $product = $product_service->create($name, $group_id, $price, $quantity);
    }

    ?>
</body>

</html>
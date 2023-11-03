<!DOCTYPE html>
<html>

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap; ?>


</head>

<body>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/delivery.service.php");

    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/product.service.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/group.service.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/supplier.service.php");

    $group_service = new GroupServices($pdo);
    $supplier_service = new SupplierService($pdo);
    $product_service = new ProductService($pdo);

    $all_groups = $group_service->all();
    $all_suppliers = $supplier_service->all();
    $all_products = $product_service->all();

    $delivery_service = new DeliveryService($pdo);

    $collection = $delivery_service->all();
    $table_header = "
    <th>ID</th>
    <th>Product ID</th>
    <th>Group ID</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Supplier ID</th>";
    ?>

    <table class="table">
        <thead>

            <tr>
                <?php echo $table_header ?>

                <?php foreach ($collection as $current_el) : ?>
            <tr><?php $curr_id = 0;
                    $counter = 0; ?>
        </thead>



        <?php foreach ($current_el as $key => $value) : ?>
            <?php if ($key == "id") {
                            $curr_id = $value;
                        }

            ?>

            <form method="post">
                <td>


                    <?php if ($key == "group_id") : ?>
                        <select class=form-control name=group id=group>
                            <?php foreach ($all_groups as $curr_group) : ?>
                                <option value=<?php echo $curr_group->id ?> <?php echo $curr_group->id == $current_el->group_id ? "selected" : "" ?>><?php echo $curr_group->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif ($key == "product_id") : ?>
                        <select class=form-control name=product id=product>
                            <?php foreach ($all_products as $curr_product) : ?>
                                <option value=<?php echo $curr_product->id ?> <?php echo $curr_product->id == $current_el->product_id ? "selected" : "" ?>><?php echo $curr_product->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif ($key == "supplier_id") : ?>
                        <select class=form-control name=supplier id=supplier>
                            <?php foreach ($all_suppliers as $curr_supplier) : ?>
                                <option value=<?php echo $curr_supplier->id ?> <?php echo $curr_supplier->id == $current_el->supplier_id ? "selected" : "" ?>><?php echo $curr_supplier->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else : ?>
                        <input class="form-control" name=<?php echo $key ?> value=<?php echo $value ?> <?php echo $key == "id" ? "disabled" : "" ?>>
                    <?php endif; ?>

                </td>

            <?php endforeach; ?>

            <td>
                <div class="form-group">
                    <input type="hidden" name="id" value=<?php echo $curr_id ?>>
                    <input class="btn btn-warning" type="submit" name="edit" value="Edit">
                </div>
            </form>
            <form method="post">
                <input type="hidden" name="id" value=<?php echo $curr_id ?>>
                <input class="btn btn-danger" type="submit" name="delete" value="Delete">
            </form>
            </td>
            </tr>
        <?php endforeach; ?>
        </tr>
    </table>
    <?php
    if (isset($_POST["delete"])) {
        $curr_id = $_POST["id"];

        $delivery_service->delete($curr_id);
    } else if (isset($_POST["edit"])) {
        $curr_id = $_POST["id"];
        $product_id = $_POST["product"];
        $supplier_id = $_POST["supplier"];
        $group_id = $_POST["group"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];


        $emp = $delivery_service->update($curr_id, $product_id, $group_id, $price, $quantity, $supplier_id);
    }

    ?>

    <form method="post" action="/storewebpr/view/delivery/filter.php">
        <div class="form-group">
            <label for="supplier">Search by supplier:</label>
            <input class="form-control" id="supplier" name="supplier" type="text">
        </div>

        <input class="btn btn-primary" type="submit" name="filter-supplier" value="Filter">
    </form>
</body>

</html>
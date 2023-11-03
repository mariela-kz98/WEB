<!DOCTYPE html>
<html>

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap; ?>


</head>

<body>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/sale.service.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/product.service.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employee.service.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/customer.service.php");

    $sale_service = new SaleService($pdo);
    $employee_service = new EmployeeService($pdo);
    $customer_service = new CustomerService($pdo);
    $product_service = new ProductService($pdo);

    $collection = $sale_service->all();
    $all_employees = $employee_service->all();
    $all_customers = $customer_service->all();
    $all_products = $product_service->all();


    $table_header = "
    <th>Id</th>
    <th>Product ID</th>
    <th>Customer ID</th>
    <th>Employee ID</th>
    <th>Date</th>
    <th>Price</th>";

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


                    <?php if ($key == "employee_id") : ?>
                        <select class=form-control name=employee id=employee>
                            <?php foreach ($all_employees as $curr_employee) : ?>
                                <option value=<?php echo $curr_employee->id ?> <?php echo $curr_employee->id == $current_el->employee_id ? "selected" : "" ?>><?php echo $curr_employee->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif ($key == "product_id") : ?>
                        <select class=form-control name=product id=product>
                            <?php foreach ($all_products as $curr_product) : ?>
                                <option value=<?php echo $curr_product->id ?> <?php echo $curr_product->id == $current_el->product_id ? "selected" : "" ?>><?php echo $curr_product->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif ($key == "customer_id") : ?>
                        <select class=form-control name=customer id=customer>
                            <?php foreach ($all_customers as $curr_customer) : ?>
                                <option value=<?php echo $curr_customer->id ?> <?php echo $curr_customer->id == $current_el->customer_id ? "selected" : "" ?>><?php echo $curr_customer->name ?></option>
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

        $sale_service->delete($curr_id);
    } else if (isset($_POST["edit"])) {
        $curr_id = $_POST["id"];
        $prodcut_id = $_POST["product"];
        $customer_id = $_POST["customer"];
        $employee_id = $_POST["employee"];
        $date = $_POST["sdate"];
        $price = $_POST["price"];


        $emp = $sale_service->update($curr_id, $prodcut_id, $customer_id, $employee_id, $date, $price);
    }

    ?>



    <form method="post" action="/storewebpr/view/sale/filter.php">

        <div class="form-group">
            <label for="customer">Search by customer:</label>
            <input class="form-control" id="customer" name="customer" type="text">
        </div>

        <input class="btn btn-primary" type="submit" name="filter-customer" value="Filter Customer">

        <div class="form-group">
            <label for="date">Search by date:</label>
            <input class="form-control" id="date" name="date" type="text">
        </div>

        <input class="btn btn-primary" type="submit" name="filter-date" value="Filter Date">

        <div class="form-group">
            <label for="employee">Search by employee name(order by date):</label>
            <input class="form-control" id="employee" name="employee" type="text">
        </div>

        <input class="btn btn-primary" type="submit" name="filter-employee" value="Filter Employee">
    </form>
</body>

</html>
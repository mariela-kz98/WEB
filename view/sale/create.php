<!DOCTYPE html>
<html>

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap; ?>

</head>

<body>
    <form method="post">

        <h1>Create Sale</h1>
        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/product.service.php");

        $product_service = new ProductService($pdo);
        $all_products = $product_service->all();

        echo "
        <div class=form-group>
            <label for=product_id>Product:</label>
            <select class=form-control name=product_id id=product_id>";
        foreach ($all_products as $curr_product) {
            echo "<option value=$curr_product->id>$curr_product->name</option>";
        }

        echo " </select></div>";


        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/customer.service.php");

        $customer_service = new CustomerService($pdo);
        $all_customers = $customer_service->all();

        echo "<div class=form-group>
            <label for=customer_id>Customer:</label>
            <select class=form-control name=customer_id id=customer_id>";
        foreach ($all_customers as $curr_customer) {
            echo "<option value=$curr_customer->id>$curr_customer->name</option>";
        }

        echo " </select></div>";


        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employee.service.php");

        $employee_service = new EmployeeService($pdo);
        $all_employees = $employee_service->all();

        echo "<div class=form-group>
            <label for=employee_id>Employee:</label>
            <select class=form-control name=employee_id id=employee_id>";
        foreach ($all_employees as $curr_employee) {
            echo "<option value=$curr_employee->id>$curr_employee->name</option>";
        }

        echo " </select></div>";
        ?>

        <div class="form-group">
            <label for="date">Date:</label>
            <input class="form-control" id="date" name="date" type="text">
        </div>


        <div class="form-group">
            <label for="price">Price:</label>
            <input class="form-control" id="price" name="price" type="text">
        </div>

        <br />
        <input class="btn btn-primary" type="submit" name="create" value="Create">

    </form>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/sale.service.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");

    if (isset($_POST["create"])) {
        $product_id = $_POST["product_id"];
        $customer_id = $_POST["customer_id"];
        $employee_id = $_POST["employee_id"];
        $date = $_POST["date"];
        $price = $_POST["price"];

        $sale_service = new SaleService($pdo);
        $sale = $sale_service->create($product_id, $customer_id, $employee_id, $date, $price);
    }

    ?>
</body>

</html>
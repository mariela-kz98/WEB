<!DOCTYPE html>
<html>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
echo $bootstrap; ?>

<head>

</head>

<body>
    <form method="post">

        <h1>Create Employee</h1>

        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" id="name" name="name" type="text">
        </div>
        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
        include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employeepos.service.php");

        $position_service = new EmployeePositionServices($pdo);
        $all_positions = $position_service->all();

        echo "<div class=form-group>
        <label for=position>Position:</label>
        <select class=form-control name=postion id=position>";

        foreach ($all_positions as $curr_position) {
            echo "<option value=$curr_position->id>$curr_position->name</option>";
        }

        echo " </select></div>";
        ?>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input class="form-control" id="phone" name="phone" type="text">
        </div>
        <br />
        <input class="btn btn-primary" type="submit" name="create" value="Create">

    </form>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employee.service.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");

    if (isset($_POST["create"])) {
        $name = $_POST["name"];
        $employeepos_id = $_POST["postion"];
        $phone = $_POST["phone"];


        $employee_service = new EmployeeService($pdo);

        $employee = $employee_service->create($name, $employeepos_id, $phone);
    }
    ?>
</body>

</html>
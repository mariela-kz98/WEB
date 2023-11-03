<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employee.service.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employeepos.service.php");

$employee_service = new EmployeeService($pdo);
$position_service = new EmployeePositionServices($pdo);
$all_positions = $position_service->all();

$collection = $employee_service->all();
$table_header = "
    <th>Id</th>
    <th>Name</th>
    <th>Employee Position ID</th>
    <th>Phone</th>";
?>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
    echo $bootstrap;
    ?>
    <title>Test</title>
</head>

<body>

    <table class="table">
        <thead>

            <tr>
                <?php echo $table_header ?>

                <?php foreach ($collection as $current_el) : ?>
            <tr><?php $curr_id = 0;$counter = 0; ?>
        </thead>



        <?php foreach ($current_el as $key => $value) : ?>
            <?php if ($key == "id") {
                            $curr_id = $value;
                        }

            ?>

            <form method="post">
                <td>


                    <?php if ($key == "emplpos_id") : ?>
                        <select class=form-control name=postion id=position>
                            <?php foreach ($all_positions as $curr_position) : ?>
                                <option value=<?php echo $curr_position->id?> <?php echo $curr_position->id == $current_el->emplpos_id ? "selected" : "" ?> ><?php echo $curr_position->name?></option>
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
</body>

</html>

<?php
if (isset($_POST["delete"])) {
    $curr_id = $_POST["id"];

    $employee_service->delete($curr_id);
} else if (isset($_POST["edit"])) {
    $curr_id = $_POST["id"];
    $name = $_POST["name"];
    $position_id = $_POST["postion"];
    $phone = $_POST["phone"];
    

    $emp = $employee_service->update($curr_id, $name, $position_id, $phone);

}
?>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employeepos.service.php");

$employeepos_service = new EmployeePositionServices($pdo);

$collection = $employeepos_service->all();
$table_header = "
    <th>Id</th>
    <th>Name</th>";

include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/table.php");

if (isset($_POST["delete"])) {
    $curr_id = $_POST["id"];
    
    $employeepos_service->delete($curr_id);
}

if (isset($_POST["edit"])) {
    $curr_id = $_POST["id"];
    $name = $_POST["name"];

    $employee = $employeepos_service->update($curr_id, $name);
}
?>
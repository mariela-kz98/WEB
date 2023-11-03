<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/group.service.php");

$group_service = new GroupServices($pdo);

$collection = $group_service->all();
$table_header = "
    <th>Id</th>
    <th>Name</th>";

include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/table.php");

if (isset($_POST["delete"])) {
    $curr_id = $_POST["id"];
    
    $group_service->delete($curr_id);
}

if (isset($_POST["edit"])) {
    $curr_id = $_POST["id"];
    $name = $_POST["name"];

    $group = $group_service->update($curr_id, $name);
}

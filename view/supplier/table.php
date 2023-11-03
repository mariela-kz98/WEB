<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/supplier.service.php");

$supplier_service = new SupplierService($pdo);

$collection = $supplier_service->all();
$table_header = "
    <th>Id</th>
    <th>Name</th>
    <th>EIK</th>";

include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/table.php");

if (isset($_POST["delete"])) {
    $curr_id = $_POST["id"];
    
    $supplier_service->delete($curr_id);
}

if (isset($_POST["edit"])) {
    $curr_id = $_POST["id"];
    $name = $_POST["name"];
    $eik = $_POST["eik"];

    $supplier = $supplier_service->update($curr_id, $name, $eik);
}

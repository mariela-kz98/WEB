<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/customer.service.php");

$customer_service = new CustomerService($pdo);

$resource_name = "customer";
$collection = $customer_service->all();
$table_header = "
    <th>Id</th>
    <th>Name</th>
    <th>Phone</th>";

include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/table.php");

if (isset($_POST["delete"])) {
    $curr_id = $_POST["id"];

    $customer_service->delete($curr_id);
}
if (isset($_POST["edit"])) {
    $curr_id = $_POST["id"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];

    $customer = $customer_service->update($curr_id, $name, $phone);
}
?>
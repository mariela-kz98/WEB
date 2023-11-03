

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/customer.service.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");

$data = [
    [
        "name" => "name",
        "type" => "text",
        "value" => ""
    ],
    [
        "name" => "phone",
        "type" => "text",
        "value" => ""
    ],
];
$resource_name = "customer";


include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/form.php");

if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $phone = $_POST["phone"];

    $customer_service = new CustomerService($pdo);
    $customer = $customer_service->create($name, $phone);
}

?>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/supplier.service.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");


    $data = [
        [
            "name" => "name",
            "type" => "text",
            "value" => ""
        ],
        [
            "name" => "eik",
            "type" => "text",
            "value" => ""
        ],
    ];
    $resource_name = "Employee Position";

    include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/form.php");

    if (isset($_POST["create"])) {
        $name = $_POST["name"];
        $eik = $_POST["eik"];

        $supplier_service = new SupplierService($pdo);
        $supplier = $supplier_service->create($name, $eik);
    }

    ?>
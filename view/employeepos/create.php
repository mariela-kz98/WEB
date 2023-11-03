    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/employeepos.service.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");

    $data = [
        [
            "name" => "name",
            "type" => "text",
            "value" => ""
        ],
    ];
    $resource_name = "Employee Position";
    
include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/form.php");

    if (isset($_POST["create"])) {
        $name = $_POST["name"];

        $employeepos_service = new EmployeePositionServices($pdo);
        $employeepos = $employeepos_service->create($name);
    }

    ?>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/services/group.service.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/database/create.php");

    $data = [
        [
            "name" => "name",
            "type" => "text",
            "value" => ""
        ],
    ];
    $resource_name = "Group";

    include($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/templates/form.php");

    if (isset($_POST["create"])) {
        $name = $_POST["name"];

        $group_service = new GroupServices($pdo);
        $group = $group_service->create($name);
    }

    ?>
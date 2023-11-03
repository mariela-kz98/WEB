<!DOCTYPE html>
<html>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/view/constants.php");
echo $bootstrap; ?>

<head>
    <title>Create Page</title>
</head>

<body>
    <form method="post">

        <h1>
            <?php echo "Create " . $resource_name ?>.
        </h1>

        <?php foreach ($data as $curr_data) : ?>
            <div class="form-group">
                <label for=<?php echo $curr_data["name"] ?>><?php echo $curr_data["name"] ?>: </label>
                <input class="form-control" id=<?php echo $curr_data["name"] ?> name=<?php echo $curr_data["name"] ?> type=<?php echo $curr_data["type"] ?> value=<?php echo $curr_data["value"] ?>>
            </div>


        <?php endforeach; ?>


        <br />
        <input class="btn btn-primary" type="submit" name="create" value="Create">

    </form>

</body>

</html>
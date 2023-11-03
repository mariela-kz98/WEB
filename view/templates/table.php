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
            <tr><?php $curr_id = 0; ?>
        </thead>

        <?php foreach ($current_el as $key => $value) : ?>
            <?php if ($key == "id") {
                            $curr_id = $value;
                        }
            ?>

            <form method="post">
                <td>

                    <input class="form-control" name=<?php echo $key ?> value=<?php echo $value ?> <?php echo $key == "id" ? "disabled" : "" ?>>
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
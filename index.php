<?php
 require($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/database/create.php");
//require($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/services/employeepos.services.php");
//require($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/view/customer/table.php");
require($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/services/product.service.php");

$productser = new ProductService($pdo);

var_dump( $productser->search_group("Group1"));

?>
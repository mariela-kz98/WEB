<?php
//TO DO FK; 


require_once($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/models/sale.php");
class SaleService
{
    private $pdo;
    
    public function __construct($pdo) {
    $this->pdo = $pdo;
 }

 
 public function create($product_id, $customer_id, $employee_id, $date, $price)
 {
     $statement = $this->pdo->prepare("INSERT INTO sale(product_id, customer_id, employee_id, sdate, price) VALUES(:product_id, :customer_id, :employee_id, :sdate, :price)");
     $statement->execute([":product_id" => $product_id, ":customer_id" => $customer_id, ":employee_id" => $employee_id, ":sdate" => $date, ":price" => $price]);
     $sale_id = $this->pdo->lastInsertId();

     return $this->find($sale_id);
 }
public function find($id)
{
   
    $statement = $this->pdo->prepare("SELECT * FROM sale WHERE id = :id");
    $statement->execute([":id" => $id]);
    
    return $statement->fetchObject("Sale");
}

public function delete($id)
{
    $statement = $this->pdo->prepare("DELETE FROM sale WHERE id = :id");
    $statement->execute([":id" => $id]);
}

public function update($id, $product_id, $customer_id, $employee_id, $date, $price)
 {
     $statement = $this->pdo->prepare("UPDATE sale SET product_id = :product_id, customer_id = :customer_id, employee_id = :employee_id, sdate = :sdate, price = :price WHERE id = :id");
     $statement->execute([":id" => $id, ":product_id" => $product_id, ":customer_id" => $customer_id, ":employee_id" => $employee_id, ":sdate" => $date, ":price" => $price]);
     
     return $statement->fetchObject("Sale");
 }

 public function all()
 {
    $statement = $this->pdo->prepare("SELECT * FROM sale");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }

 
 public function search_customer($customer_name)
 {
    $statement = $this->pdo->prepare("SELECT * FROM sale JOIN customer ON sale.customer_id = customer.id WHERE customer.name = :customer_name");
    // ORDER BY DATE;
    $statement->execute([":customer_name" => $customer_name]);
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }

 
 public function search_date($date)
 {
    $statement = $this->pdo->prepare("SELECT * FROM sale WHERE sdate = :sdate");
    $statement->execute([":sdate" => $date]);
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }
 
 public function search_empdate($employee_name)
 {
    $statement = $this->pdo->prepare("SELECT
        sale.id, sale.product_id, sale.customer_id, employee.name, sale.sdate, sale.price 
     FROM sale JOIN employee ON sale.employee_id = employee.id WHERE employee.name = :employee_name ORDER BY sale.sdate DESC");
    $statement->execute([":employee_name" => $employee_name]);
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }
}

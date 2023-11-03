<?php


require_once($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/models/customer.php");
class CustomerService
{
    private $pdo;
    
    public function __construct($pdo) {
    $this->pdo = $pdo;
 }
 
 public function create($name, $phone)
 {
     $statement = $this->pdo->prepare("INSERT INTO customer(name,phone) VALUES(:name, :phone)");
     $statement->execute([":name" => $name, ":phone" => $phone]);
     $customer_id = $this->pdo->lastInsertId();

     return $this->find($customer_id);
 }
public function find($id)
{
   
    $statement = $this->pdo->prepare("SELECT * FROM customer WHERE id = :id");
    $statement->execute([":id" => $id]);
    
    return $statement->fetchObject("Customer");
}

public function delete($id)
{
    $statement = $this->pdo->prepare("DELETE FROM customer WHERE id = :id");
    $statement->execute([":id" => $id]);
}

public function update($id, $name, $phone)
 {
     $statement = $this->pdo->prepare("UPDATE customer SET name = :name, phone = :phone WHERE id = :id");
     $statement->execute([":id" => $id,":name" => $name, ":phone" => $phone]);
     
     return $statement->fetchObject("Customer");
 }

 public function all()
 {
    $statement = $this->pdo->prepare("SELECT * FROM customer");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }

}

?>
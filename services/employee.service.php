<?php
//TO DO FK; 


require_once($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/models/employee.php");
class EmployeeService
{
    private $pdo;
    
    public function __construct($pdo) {
    $this->pdo = $pdo;
 }

 
 public function create($name, $employeepos_id, $phone)
 {
     $statement = $this->pdo->prepare("INSERT INTO employee(name, emplpos_id,phone) VALUES(:name, :employeepos_id, :phone)");
     $statement->execute([":name" => $name,":employeepos_id" => $employeepos_id, ":phone" => $phone]);
     $employee_id = $this->pdo->lastInsertId();

     return $this->find($employee_id);
 }
public function find($id)
{
   
    $statement = $this->pdo->prepare("SELECT * FROM employee WHERE id = :id");
    $statement->execute([":id" => $id]);
    
    return $statement->fetchObject("Employee");
}

public function delete($id)
{
    $statement = $this->pdo->prepare("DELETE FROM employee WHERE id = :id");
    $statement->execute([":id" => $id]);
}

public function update($id, $name, $employeepos_id, $phone)
 {
     $statement = $this->pdo->prepare("UPDATE employee SET name = :name, emplpos_id = :employeepos_id , phone = :phone WHERE id = :id");
     $statement->execute([":id" => $id,":name" => $name, ":employeepos_id" => $employeepos_id , ":phone" => $phone]);
     
     return $statement->fetchObject("Employee");
 }

 public function all()
 {
    $statement = $this->pdo->prepare("SELECT * FROM employee");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }

}

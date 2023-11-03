<?php

require_once($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/models/employeeposition.php");

class EmployeePositionServices
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function create($name)
    {
        $statement = $this->pdo->prepare("INSERT INTO employee_position(name) VALUES (:name) "); // check employee_position - correct!!!
        $statement->execute([":name" => $name]);
        $employeepos_id = $this->pdo->lastInsertId();
    
        return $this->find($employeepos_id);
    }
    public function find($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM employee_position WHERE id = :id");
        $statement->execute([":id" => $id]);

        return $statement->fetchObject("EmployeePosition");
    }
    
    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM employee_position WHERE id = :id");
        $statement->execute([":id" => $id]);
   
    }
    public function update($id, $name)
 {
     $statement = $this->pdo->prepare("UPDATE employee_position SET name = :name WHERE id = :id");
     $statement->execute([":id" => $id,":name" => $name]);
     
     return $statement->fetchObject("EmployeePosition");
 }

 public function all()
 {
    $statement = $this->pdo->prepare("SELECT * FROM employee_position");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }


}

?>
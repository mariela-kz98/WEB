<?php

require_once($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/models/group.php");

class GroupServices
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function create($name)
    {
        $statement = $this->pdo->prepare("INSERT INTO groupp(name) VALUES (:name)");
        $statement->execute([":name" => $name]);
        $group_id = $this->pdo->lastInsertId();
    
        return $this->find($group_id);
    }
    public function find($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM groupp WHERE id = :id");
        $statement->execute([":id" => $id]);

        return $statement->fetchObject("Group");
    }
    
    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM groupp WHERE id = :id");
        $statement->execute([":id" => $id]);
   
    }
    public function update($id, $name)
 {
     $statement = $this->pdo->prepare("UPDATE groupp SET name = :name WHERE id = :id");
     $statement->execute([":id" => $id,":name" => $name]);
     
     return $statement->fetchObject("Group");
 }

 public function all()
 {
    $statement = $this->pdo->prepare("SELECT * FROM groupp");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
 }


}

?>
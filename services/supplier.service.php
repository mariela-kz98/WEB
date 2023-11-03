<?php


require_once($_SERVER['DOCUMENT_ROOT'] ."/storewebpr/models/supplier.php");

class SupplierService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($name, $eik)
    {
        $statement = $this->pdo->prepare("INSERT INTO supplier(name, eik) VALUES (:name, :eik)");
        $statement->execute([":name" => $name, ":eik" => $eik]);
        $supplier_id = $this->pdo->lastInsertId();

        return $this->find($supplier_id);
    }
    public function find($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM supplier WHERE id = :id");
        $statement->execute([":id" => $id]);

        return $statement->fetchObject("Supplier");
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM supplier WHERE id = :id");
        $statement->execute([":id" => $id]);
        
    }
    public function update($id, $name, $eik)
    {
        $statement = $this->pdo->prepare("UPDATE supplier SET name = :name, eik = :eik WHERE id = :id");
        $statement->execute([":id" => $id, ":name" => $name, ":eik" => $eik]);

        return $statement->fetchObject("Supplier");
    }
    public function all()
    {
        $statement = $this->pdo->prepare("SELECT * FROM supplier");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }


}

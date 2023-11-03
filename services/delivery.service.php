<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/models/delivery.php");
class DeliveryService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($product_id, $group_id, $price, $quantity, $supplier_id)
    {
        $statement = $this->pdo->prepare("INSERT INTO delivery(product_id, group_id, price, quantity, supplier_id) VALUES(:product_id, :group_id, :price, :quantity, :supplier_id)");
        $statement->execute([":product_id" => $product_id, ":group_id" => $group_id, ":price" => $price, ":quantity" => $quantity, ":supplier_id" => $supplier_id]);
        $delivery_id = $this->pdo->lastInsertId();

        return $this->find($delivery_id);
    }

    public function find($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM delivery WHERE id = :id");
        $statement->execute([":id" => $id]);

        return $statement->fetchObject("Delivery");
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM delivery WHERE id = :id");
        $statement->execute([":id" => $id]);
    }

    public function update($id, $product_id, $group_id, $price, $quantity, $supplier_id)
    {
        $statement = $this->pdo->prepare("UPDATE delivery SET product_id = :product_id, group_id = :group_id, price = :price, quantity = :quantity, supplier_id = :supplier_id WHERE id = :id");
        $statement->execute([":id" => $id, ":product_id" => $product_id, ":group_id" => $group_id, ":price" => $price, ":quantity" => $quantity, ":supplier_id" => $supplier_id]);

        return $statement->fetchObject("Delivery");
    }

    public function all()
    {
        $statement = $this->pdo->prepare("SELECT * FROM delivery");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }


    public $id;
    public $product_id;
    public $group_id;
    public $price;
    public $quantity;
    public $supplier_id;

    public function search_supplier($supplier_name)
    {
        $statement = $this->pdo->prepare("SELECT 
            delivery.id, delivery.product_id, delivery.group_id, delivery.price, delivery.quantity, supplier.name
         delivery FROM delivery JOIN supplier ON delivery.supplier_id = supplier.id WHERE supplier.name = :supplier_name");
        $statement->execute([":supplier_name" => $supplier_name]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    //  public function search_date($date)
    //  {
    //     $statement = $this->pdo->prepare("SELECT * FROM delivery WHERE delivery.pr = : ORDER BY DESC sale.date");
    //     $statement->execute([":sdate" => $date]);
    //     return $statement->fetchAll(PDO::FETCH_OBJ);
    //  }


    // public function search_productsbydate($product, $date)
    //  {
    //     $statement = $this->pdo->prepare("SELECT * FROM delivery JOIN product ON 
    //     product.id = delivery.product_id WHERE  ----
    //     sale.employee_id = employee.id WHERE employee.name = :employee_name ORDER BY DESC sale.date");
    //     $statement->execute([":employee_name" => $employee_name]);
    //     return $statement->fetchAll(PDO::FETCH_OBJ);
    //  }



}

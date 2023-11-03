<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/storewebpr/models/product.php");
class ProductService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function create($name, $group_id, $price, $quantity)
    {
        $statement = $this->pdo->prepare("INSERT INTO product(name, group_id, price, quantity) VALUES(:name, :group_id, :price, :quantity)");
        $statement->execute([":name" => $name, ":group_id" => $group_id, ":price" => $price, ":quantity" => $quantity]);
        $product_id = $this->pdo->lastInsertId();

        return $this->find($product_id);
    }
    public function find($id)
    {

        $statement = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
        $statement->execute([":id" => $id]);

        return $statement->fetchObject("Product");
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM product WHERE id = :id");
        $statement->execute([":id" => $id]);
    }

    public function update($id, $name, $group_id, $price, $quantity)
    {
        $statement = $this->pdo->prepare("UPDATE product SET name = :name, :group_id, :price, :quantity WHERE id = :id");
        $statement->execute([":id" => $id, ":name" => $name, ":group_id" => $group_id, ":price" => $price, ":quantity" => $quantity]);

        return $statement->fetchObject("Product");
    }

    public function all()
    {
        $statement = $this->pdo->prepare("SELECT * FROM product");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function search_price($price)
    {
        $statement = $this->pdo->prepare("SELECT * FROM product WHERE price = :price");
        $statement->execute([":price" => $price]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function search_name($name)
    {
        $statement = $this->pdo->prepare("SELECT * FROM product WHERE name = :name");
        $statement->execute([":name" => $name]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function search_group($group_name)
    {
        $statement = $this->pdo->prepare("SELECT product.id, product.name AS product_name, groupp.name AS group_name, product.price, product.quantity FROM product JOIN groupp ON groupp.id = product.group_id WHERE groupp.name = :group_name");
        $statement->execute([":group_name" => $group_name]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}

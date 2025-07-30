<?php
require "db.php";

class Product {
    private $pdo;

    public function __construct() {
        $this->pdo = new DB();
    }
   public function addProduct($name, $description, $price, $image, $categorie) {
       $this->pdo->run("INSERT INTO product (naam, description, prijs, image, categorie) VALUES 
       (:name, :description, :price, :image, :categorie)", 
       ["name"=>$name, 
       "description"=>$description, 
       "price"=>$price, 
       "image"=>$image,
       "categorie"=>$categorie]);
   }
    public function getProducts() {
        return $this->pdo->run("SELECT * FROM product")->fetchAll();
    }
    public function getCategorie() {
        return $this->pdo->run("SELECT * FROM categorie")->fetchAll();
    }
    public function editProduct($name, $description, $price, $image, $productCode) {
        $this->pdo->run("UPDATE product SET naam = :name, description = :description, prijs = :price, image = :image WHERE productCode = :productCode", ["name"=>$name, "description"=>$description, "price"=>$price, "image"=>$image, "productCode"=>$productCode]);
    }
    public function deleteProduct($productCode) {
        $this->pdo->run("DELETE FROM product WHERE productCode = :productCode", ["productCode"=>$productCode]);
    }
}
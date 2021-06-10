<?php

class Products
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getTotalRow()
    {
        $this->db->query("SELECT COUNT(*) as total_row FROM products");
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        } else {
            return $results;
        }
    }
    public function getPagination($offset, $no_of_records_per_page)
    {
        $this->db->query("SELECT products.*, categorys.name AS cat_name,brands.name AS brand_name FROM products JOIN categorys ON products.category = categorys.id JOIN brands ON products.brand = brands.id
 where products.top_f=0 and products.boottom_f=0 LIMIT :limit OFFSET :offset ");
        $this->db->bind(':limit', $no_of_records_per_page);
        $this->db->bind(':offset', $offset);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTopF(){
        $this->db->query("SELECT products.*, categorys.name AS cat_name,brands.name AS brand_name FROM products JOIN categorys ON products.category = categorys.id JOIN brands ON products.brand = brands.id
  where top_f=1");
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        } else {
            return $results;
        }
    }
    public function getBottomF(){
        $this->db->query("SELECT products.*, categorys.name AS cat_name,brands.name AS brand_name FROM products JOIN categorys ON products.category = categorys.id JOIN brands ON products.brand = brands.id
 where boottom_f=1");
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        } else {
            return $results;
        }
    }
    public function getProductByUrl($Url){
        $this->db->query("SELECT products.*, categorys.name AS cat_name,brands.name AS brand_name FROM products JOIN categorys ON products.category = categorys.id JOIN brands ON products.brand = brands.id where products.url=:url");
        $this->db->bind(':url', $Url);
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        } else {
            return $results;
        }
    }
    public function addProduct($data){
        $this->db->query("INSERT INTO products(product_name, price, short_info,product_details,more_info,category,brand,url) VALUES(:product_name, :price, :short_info,:product_details,:more_info,:category,:brand,:url)");
        $this->db->bind(':product_name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':short_info', $data['short_info']);
        $this->db->bind(':product_details', $data['details']);
        $this->db->bind(':more_info', $data['more_info']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':url', $data['url']);
        $this->db->resultSet();
        return $this->db->lastInsertId();
    }
    public function deleteproduct($data){
        $this->db->query("DELETE FROM products where id=:id");
        $this->db->bind(':id', $data);
        $this->db->execute();
    }
    public function addTopF($id){
        $this->db->query("UPDATE products SET top_f=1 where id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    public function removeTopF($id){
        $this->db->query("UPDATE products SET top_f=0 where id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    public function addBottomF($id){
        $this->db->query("UPDATE products SET boottom_f=1 where id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    public function removeBottomF($id){
        $this->db->query("UPDATE products SET boottom_f=0 where id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    public function updateProduct($data){
        $this->db->query("UPDATE products SET product_name=:product_name,price=:price,short_info=:short_info,product_details=:product_details,more_info=:more_info,category=:category,brand=:brand where id=:id");
        $this->db->bind(':product_name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':short_info', $data['short_info']);
        $this->db->bind(':product_details', $data['details']);
        $this->db->bind(':more_info', $data['more_info']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':id', $data['id']);
        $this->db->execute();
    }
}
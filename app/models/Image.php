<?php
class Image
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getImgByProductId($product){
        $this->db->query("SELECT * FROM image where product_id=:id");
        $this->db->bind(':id', $product['0']->id);
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        } else {
            return $results;
        }
    }
    public function addImg($name,$id){
        $this->db->query("INSERT INTO image (img, product_id) VALUES(:img, :product_id)");
        $this->db->bind(':img', $name);
        $this->db->bind(':product_id', $id);
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        }
    }
    public function deleteImg($id){
        $this->db->query("DELETE FROM image WHERE id=:id");
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        }
    }
    public function editImg($name,$id){
        $this->db->query("UPDATE image SET img=:img WHERE id=:id");
        $this->db->bind(':id', $id);
        $this->db->bind(':img', $name);
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        }
    }
}
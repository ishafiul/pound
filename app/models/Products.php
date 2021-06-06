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
 LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $no_of_records_per_page);
        $this->db->bind(':offset', $offset);
        $results = $this->db->resultSet();
        return $results;
    }
}
<?php
class Payment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getPagination($offset,$no_of_records_per_page){
        $this->db->query("SELECT * FROM payments LIMIT :limit OFFSET :offset ");
        $this->db->bind(':limit', $no_of_records_per_page);
        $this->db->bind(':offset', $offset);
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalRow()
    {
        $this->db->query("SELECT COUNT(*) as total_row FROM payments");
        $results = $this->db->resultSet();
        if ($results) {
            return $results;
        } else {
            return $results;
        }
    }
}
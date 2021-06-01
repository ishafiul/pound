<?php
class AdminCategory
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function addPrimaryCategory($data){
        $this->db->query("INSERT INTO categorys (name,parents) VALUES(:name,:parents)");
        // Bind values
        $this->db->bind(':name', $data['categoryPName']);
        $this->db->bind(':parents', 1);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function getPrimaryCategory(){
        $this->db->query("SELECT * FROM categorys ");
        $results = $this->db->resultSet();
        return $results;
    }
    public function editPrimaryCategory($data){
            $this->db->query("UPDATE categorys SET name = :name where id = :id");
            $this->db->bind(':name',$data['editPrimaryCatName']);
            $this->db->bind(':id',$data['editPrimaryCatId']);
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
    }
    public function deletePrimaryCategory($data){
        $this->db->query("DELETE FROM categorys where id = :id");
        $this->db->bind(':id',$data['editPrimaryCatId']);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}

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
    public function pendingpayment($data)
    {
        $this->db->query("INSERT INTO payments  (payment_status, fname, lname, mail, phone, zip, address, user_id, products_ids) VALUES ('pending',:fname,:lname,:mail,:phone,:zip,:address,:user_id,:products_ids)");
        $this->db->bind(':fname',$data['fname']);
        $this->db->bind(':lname',$data['lname']);
        $this->db->bind(':mail',$data['email']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->bind(':zip',$data['zip']);
        $this->db->bind(':address',$data['address']);
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':products_ids',$data['product_ids']);
        $results = $this->db->execute();
        if ($results) {
            return $results;
        } else {
            return $results;
        }
    }
    public function paymentsuccess($payment){
        $this->db->query("UPDATE payments SET payment_id=:payment_id, payer_id=:payer_id, payer_email=:payer_email, amount=:amount, currency=:currency, payment_status=:payment_status where id=:id");
        $this->db->bind(':payment_id',$payment['payment_id']);
        $this->db->bind(':payer_id',$payment['payer_id']);
        $this->db->bind(':payer_email',$payment['payer_email']);
        $this->db->bind(':amount',$payment['amount']);
        $this->db->bind(':currency',$payment['currency']);
        $this->db->bind(':payment_status',$payment['payment_status']);
        $this->db->bind(':id',$payment['id']);
        $results = $this->db->execute();
    }
    public function lastId(){
        $this->db->query("SELECT id FROM payments ORDER BY id DESC LIMIT 1");
        $results = $this->db->resultSet();
        if ($results) {
            return $results[0]->id;
        } else {
            return $results;
        }
    }
    public function findPaymentByUser($id){
        $this->db->query("SELECT * FROM payments where user_id=:id and payment_status='approved'");
        $this->db->bind(':id',$id);
        $result = $this->db->resultSet();
        return $result;
    }
}
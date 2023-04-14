<?php
class CheckOut extends CI_Model {
    function get_all_checked_outs()
    {
        return $this->db->query("SELECT * FROM checked_out")->result_array();
    }
    function get_order_by_id($item_id)
    {
        return $this->db->query("SELECT * FROM items WHERE id = ?", array($item_id))->row_array();
    }
    function check_out($order)
    {
        $encrypted = md5($order['card_number']);
        $query = "INSERT INTO checked_out (name, address, card_number,added_at,updated_at) VALUES (?,?,?,?,?)";
        $values = array($order['name'],$order['address'],$encrypted,date("Y-m-d H:i:s"),date("Y-m-d H:i:s")); 
        return $this->db->query($query, $values);
        echo 'model';
    }
    function validate($post){
        $this->load->library("form_validation");
        $this->form_validation->set_rules('name', "Name", "required");
        $this->form_validation->set_rules('address', "Address", "required");
        $this->form_validation->set_rules('card_number', "Card Number", "required|is_natural");

        if($this->form_validation->run()){
            return 'valid';
        } else{
            return validation_errors();
        }
    }
}
?>
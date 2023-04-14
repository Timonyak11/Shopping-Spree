<?php
class Cart extends CI_Model {
    function get_all_orders()
    {
        return $this->db->query("SELECT items.name,cart.quantity,items.value,cart.id FROM `cart` INNER JOIN items ON items.id=cart.item_id ORDER BY items.name")->result_array();
    }
    function get_order_by_id($order_id)
    {
        return $this->db->query("SELECT * FROM items WHERE id = ?", array($order_id))->row_array();
    }
    function get_olddata_by_id($item_id)
    {
        return $this->db->query("SELECT quantity, item_id FROM cart WHERE item_id = ?", $item_id)->row_array();
    }
    function get_total_price(){
        return $this->db->query("SELECT cart.quantity, items.value FROM `cart` INNER JOIN items ON items.id=cart.item_id")->result_array();
    }
    function add_order($order)
    {
        $query = "INSERT INTO cart (item_id, quantity, added_at,updated_at) VALUES (?,?,?,?)";
        $values = array($order['item_id'],$order['quantity'],date("Y-m-d H:i:s"),date("Y-m-d H:i:s")); 
        return $this->db->query($query, $values);
    }
    function update_order($order)
    {
        $query = "UPDATE cart SET quantity = ?, updated_at = ?  WHERE item_id = ?";
        $values = array($order['quantity'],date("Y-m-d H:i:s"),$order['item_id']); 
        return $this->db->query($query, $values);
    }
    function delete_order($order_id){
        return $this->db->query("DELETE FROM `cart` WHERE id = ?", $order_id);
    }   
    function validate($post){
        $this->load->library("form_validation");
        $this->form_validation->set_rules('item_id', "ID", "is_unique[cart.item_id]");

        if($this->form_validation->run()){
            return "add";
        } else{
            return "update";
        }
    }
}
?>
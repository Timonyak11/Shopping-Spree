<?php
class Item extends CI_Model {
    function get_all_items()
    {
        return $this->db->query("SELECT * FROM items")->result_array();
    }
    function get_item_by_id($item_id)
    {
        return $this->db->query("SELECT * FROM items WHERE id = ?", array($item_id))->row_array();
    }
}
?>
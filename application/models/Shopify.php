<?php

class Shopify extends CI_Model {

    function get_store_details($where) {
        $query = $this->db->get_where("stores", $where);    
        if ($query->num_rows() > 0) {
            $dumb = $query->result_array();
            return $dumb[0];
        } else {
            return 0;
        }
    }

    function get_tags($store_id) {
        $query = $this->db->get_where("tags", array("store_id" => $store_id));    
        
        return $query->result_array();
    }

    function log($log) {
        $this->db->insert("logs", $log);
    }
}
  
?>
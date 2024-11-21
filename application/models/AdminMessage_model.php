<?php
    class AdminMessage_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_messages($slug = FALSE, $limit = FALSE, $offset = FALSE){
            if($limit){
                $this->db->limit($limit, $offset);
            }
            
            if($slug === FALSE){
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('messages');
                return $query->result_array();
            }

            $query = $this->db->get_where('messages', array('slug' => $slug));
            return $query->row_array();
        }

        public function get_customers($slug = FALSE){
            $query = $this->db->query("SELECT customer_id FROM messages WHERE slug='$slug'");
            $query2 = $this->db->query("SELECT name,lastname,email FROM customers WHERE id='$query'");
            //$query3 = $this->db->get_where('customers', array('id' => $customer_id));
            
            return $query2->row_array(); 
            
            
        }





    }

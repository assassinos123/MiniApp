<?php
    class Message_model extends CI_Model{
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

        public function create_message(){
            $slug = url_title($this->input->post('title'));

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'customer_id' => $this->session->userdata('customer_id')
            );
            return $this->db->insert('messages', $data);
        }

        public function delete_message($id){
            $this->db->where('id', $id);
            $this->db->delete('messages');
            return true;
        }

    }
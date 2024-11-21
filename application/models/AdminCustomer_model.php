<?php
    class AdminCustomer_model extends CI_Model{
        public function get_customers($lastname = FALSE){
            if($lastname === FALSE){
                $this->db->order_by('id');
                $query = $this->db->get('customers');
                return $query->result_array();
            }

            $query = $this->db->get_where('customers', array('lastname' => $lastname));
            return $query->row_array();
        }

        public function delete_customer($id){
            $this->db->where('id', $id);
            $this->db->delete('customers');
            return true;
        }

        public function delete_messages($id){
            $this->db->where('customer_id', $id);
            $this->db->delete('messages');
            return true;
        }

        public function myprofile($id, $name, $lastname, $email, $enc_password){
            $data =array(
                'name' => $name,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $enc_password
            );
            //Insert credentials
            $this->db->where('id', $id);
            return $this->db->update('customers', $data);
        }

        public function showcustomermessages($id, $slug = FALSE){
            if($slug = NULL){
                $this->db->get_where('customers_id', $id);
                //$query2 = $this->db->where('customers_id', 'id');
                $query3 = $this->db->get('messages');
                return $query3->result_array();
            }

            $query = $this->db->get_where('messages', array('slug' => $slug));
            return $query->row_array();

        }

    }
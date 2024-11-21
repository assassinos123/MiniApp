<?php
    class Customer_model extends CI_Model{
        public function register($enc_password, $email){
            //Customer data array
            $data = array(
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'email' => $email,
                'password' => $enc_password               
            );
            //Insert customer
            return $this->db->insert('customers', $data);
        }

        public function login($email, $password){
            //Validate
            $this->db->where('email', $email);
            $this->db->where('password', $password);

            $result = $this->db->get('customers');

            if($result->num_rows() == 1){
                return $result->row(0)->id;
            }else{
                return false;
            }

        }

        public function myprofile($name, $lastname, $email, $enc_password){
            $data = array(
                'name' => $name,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $enc_password
            );
            //Insert credentials
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('customers', $data);
        }

        public function forgotpassword($email, $enc_password){
            $data = array(
                'password' => $enc_password
            );
            //Insert password
            $this->db->where('email', $email);
            return $this->db->update('customers', $data);
        }

        /*public function updatepasswordhash($data, $email){
            $this->db->where('email', $email);
            $this->db->update('customers', $data);
        }

        public function getHashDetails($hash){
            $query = $this->db->query("select * from customers WHERE hash_key='$hash'");
            if($query->num_rows()==1){
                return $query->row();
            }else{
                return false;
            }
        } */


    }
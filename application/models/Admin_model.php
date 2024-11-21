<?php
    class Admin_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }
        
        public function login($email, $password){
            //Validate
            $this->db->where('email', $email);
            $this->db->where('password', $password);

            $result = $this->db->get('admin');

            if($result->num_rows() == 1){
                return $result->row(0)->id;
            }else{
                return false;
            }
        }

        public function myprofile($name, $email, $enc_password){
            $data =array(
                'name' => $name,
                //'lastname' => $lastname,
                'email' => $email,
                'password' => $enc_password
            );
            //Insert credentials
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('admin', $data);
        }

        public function forgotpassword($email, $enc_password){
            $data = array(
                'password' => $enc_password
            );
            //Insert password
            $this->db->where('email', $email);
            return $this->db->update('admin', $data);
        }
    }
<?php
class Reset extends CI_Controller{
    function password(){
        if($this->input->get('hash')){
            $hash = $this->input->get('hash');
            $getHashDetails = $this->customer_model->getHashDetails($hash);
            if($getHashDetails!=false){
                $hash_expiry = $getHashDetails->hash_expiry;
                $currentDate = date('Y-m-d H:i');
                if($currentDate < $hash_expiry){
                    
                }else{
                    $this->session->set_flashdata('link_expired', 'Link is expired');
                    redirect(base_url('customers/forgotpassword'));
                }
            }else{
                echo 'invalid link';exit;
            }

        }else{
            redirect(base_url('customers/forgotpassword'));
        }
    }
}
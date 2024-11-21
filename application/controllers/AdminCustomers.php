<?php
    class AdminCustomers extends CI_controller{
        public function indexcustomerAdmin(){
            // Check Login
            if(!$this->session->userdata('adminlogged_in')){
                redirect('admin/loginAdmin');
            }
            $data['title'] = 'Customers';

            $data['messages'] = $this->admincustomer_model->get_customers();          

            $this->load->view('templates/header');
            $this->load->view('admincustomers/indexcustomerAdmin', $data);
            $this->load->view('templates/footer');
        }

        public function viewcustomerAdmin($lastname = FALSE){
            // Check Login
            if(!$this->session->userdata('adminlogged_in')){
                redirect('admin/loginAdmin');
            }
            $data['message'] = $this->admincustomer_model->get_customers($lastname);
    
            if(empty($data['message'])){
                show_404();
            }
    
            $data['title'] = $data['message']['lastname'];
    
            $this->load->view('templates/header');
            $this->load->view('admincustomers/viewcustomerAdmin', $data);
            $this->load->view('templates/footer');
            
        }

        public function delete($id){           
            $this->admincustomer_model->delete_customer($id);
            $this->admincustomer_model->delete_messages($id);
            //Set Message
            $this->session->set_flashdata('customer_deleted', 'Customer has been deleted');

            redirect('admincustomers');
        }

        public function editcustomerAdmin($id){
            // Check Login
            if(!$this->session->userdata('adminlogged_in')){
                redirect('admin/loginAdmin');
            }
               
            $data['title'] = 'Edit Customer Profile';
            //$data['message'] = $this->admincustomer_model->get_customers();

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', ' Confirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('admincustomers/editcustomerAdmin', $data);
                $this->load->view('templates/footer');
            }else{
                //Encrypt password
                $name = $this->input->post('name');
                $lastname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $enc_password = md5($this->input->post('password'));
                
                $this->admincustomer_model->myprofile($id, $name, $lastname, $email, $enc_password);

                //Set Message
                $this->session->set_flashdata('customerprofile_updated', 'Customer info has been updated');
                redirect('admincustomers');
            }
        }
        public function showcustomermessagesAdmin($id, $slug = FALSE){
            // Check Login
            if(!$this->session->userdata('adminlogged_in')){
                redirect('admin/loginAdmin');
            }
            redirect('adminmessages');
            /*
            $data['message'] = $this->admincustomer_model->showcustomermessages($id, $slug);
            if(empty($data['message'])){
                show_404();
            }
            $data['title'] = $data['message']['title']; 
        
            $this->load->view('templates/header');
            $this->load->view('admincustomers/showcustomermessagesAdmin', $data);
            $this->load->view('templates/footer'); */
        }

    }
    
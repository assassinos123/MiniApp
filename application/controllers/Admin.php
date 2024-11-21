<?php
    class Admin extends CI_Controller{
        public function loginAdmin(){
            $data['title'] = 'Log in Admin';

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('admin/loginAdmin', $data);
                $this->load->view('templates/footer');
            }else{    
                //Check credentials
                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));

                $admin_id = $this->admin_model->login($email, $password);

                if($admin_id){
                    //Create session
                    $admin_data = array(
                        'admin_id' => $admin_id,
                        'email' => $email,
                        'adminlogged_in' => true
                    );
                    $this->session->set_userdata($admin_data);

                    //Set Message
                    $this->session->set_flashdata('admin_loggedin', 'You are now logged in');
                    redirect('adminmessages');

                }else{
                    //Set Message
                    $this->session->set_flashdata('login_failed', 'Login is invalid');
                    redirect('admin/loginAdmin');
                }     
            }           
        }
        //Log out
        public function logoutAdmin(){
            $this->session->unset_userdata('adminlogged_in');
            $this->session->unset_userdata('admin_id');
            $this->session->unset_userdata('email');

            //Set Message
            $this->session->set_flashdata('admin_loggedout', 'You are now logged out');
            redirect('admin/loginAdmin');

        }

        public function myprofile(){
            // Check Login
            if(!$this->session->userdata('adminlogged_in')){
                redirect('admin/loginAdmin');
            }
               
            $data['title'] = 'My Profile';

            $this->form_validation->set_rules('name', 'Name', 'required');
            //$this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', ' Confirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('admin/myprofile', $data);
                $this->load->view('templates/footer');
            }else{
                //Encrypt password
                $name = $this->input->post('name');
                //$lastname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $enc_password = md5($this->input->post('password'));
                
                $this->admin_model->myprofile($name, $email, $enc_password);

                //Set Message
                $this->session->set_flashdata('admin_updated', 'Your info has been updated');
                redirect('adminmessages');
            }
        }


        // Forgot password
        public function forgotpassword(){
            $data['title'] = 'Reset Password';

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', ' Confirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('admin/forgotpassword', $data);
                $this->load->view('templates/footer');
            }else{
                $enc_password = md5($this->input->post('password'));
                $email = $this->input->post('email');
                $this->admin_model->forgotpassword($email, $enc_password);

                //Set Message
                $this->session->set_flashdata('resetpass', 'Your password has been changed');
                redirect('admin/loginadmin');

            }
        }

    }
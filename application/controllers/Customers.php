<?php
    class Customers extends CI_Controller{
        // Registration
        public function register(){
            $data['title'] = 'Sign up';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', ' Confirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('customers/register', $data);
                $this->load->view('templates/footer');
            }else{
                //Encrypt password
                $enc_password = md5($this->input->post('password'));
                $email = $this->input->post('email');
                if(preg_match("/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/",$email)){
                    $this->customer_model->register($enc_password, $email);
                }else{
                    //Set Message
                    $this->session->set_flashdata('failed_email', 'Your email is invalid');
                    redirect('customers/register');
                }
                
                //Set Message
                $this->session->set_flashdata('customer_registered', 'You are now registered and can log in');
                redirect('messages');
            }
        } 

        // Login
        public function login(){
            $data['title'] = 'Log in';

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('customers/login', $data);
                $this->load->view('templates/footer');
            }else{    
                //Check credentials
                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));

                $customer_id = $this->customer_model->login($email, $password);

                if($customer_id){
                    //Create session                   
                    $customer_data = array(
                        'customer_id' => $customer_id,
                        'email' => $email,
                        'logged_in' => true
                    );
                    $this->session->set_userdata($customer_data);

                    //Set Message
                    $this->session->set_flashdata('customer_loggedin', 'You are now logged in');
                    redirect('messages');

                }else{
                    //Set Message
                    $this->session->set_flashdata('login_failed', 'Login is invalid');
                    redirect('customers/login');
                }     
            }           
        }

        //Log out
        public function logout(){
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('customer_id');
            $this->session->unset_userdata('email');

            //Set Message
            $this->session->set_flashdata('customer_loggedout', 'You are now logged out');
            redirect('customers/login');

        }

        public function myprofile(){
            // Check Login
            if(!$this->session->userdata('logged_in')){
                redirect('customers/login');
            }
               
            $data['title'] = 'My Profile';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', ' Confirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('customers/myprofile', $data);
                $this->load->view('templates/footer');
            }else{
                //Encrypt password
                $name = $this->input->post('name');
                $lastname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $enc_password = md5($this->input->post('password'));
                
                $this->customer_model->myprofile($name, $lastname, $email, $enc_password);

                //Set Message
                $this->session->set_flashdata('customer_updated', 'Your info has been updated');
                redirect('messages');
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
                $this->load->view('customers/forgotpassword', $data);
                $this->load->view('templates/footer');
            }else{
                $enc_password = md5($this->input->post('password'));
                $email = $this->input->post('email');
                $this->customer_model->forgotpassword($email, $enc_password);

                //Set Message
                $this->session->set_flashdata('resetpass', 'Your password has been changed');
                redirect('customers/login');

            }
        }


       /* public function forgotpassword(){
            $data['title'] = 'Forgot Password?';

            $this->form_validation->set_rules('email', 'Email', 'required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('customers/forgotpassword', $data);
                $this->load->view('templates/footer');
            }else{
                $email = $this->input->post('email');
                $forgotpassword = $this->customer_model->forgotpassword($email);

                if($forgotpassword!= FALSE){
                    $row = $forgotpassword;
                    $customer_id = $row->id;

                    $string = time().$customer_id.$email;
                    $hash_string = hash('md5', $string);
                    $currentDate = date('Y-m-d H:i');
                    $hash_expiry = date('Y-m-d H:i', strtotime($currentDate. ' 1 days'));
                    $data = array(
                        'hash_key'=>$hash_string,
                        'hash_expiry'=>$hash_expiry,
                    );
                   
                    $resetlink = base_url().'/reset/password?hash='.$hash_string;
                    $message = '<p>Your reset password Link is here: </p>'.$resetlink;
                    $subject = "Password Reset link";
                    $sendstatus = $this->sendEmail($email,$subject,$message);
                    if($sendstatus == TRUE){
                        $this->customer_model->updatepasswordhash($data, $email);
                        $this->session->set_flashdata('success_sending_email', 'Reset password link succesfully sent');
                        redirect('/customers/forgotpassword');
                    }else{
                        $this->session->set_flashdata('failed_sending_email', 'Your email does not sent');
                    }
                }else{
                    $this->session->set_flashdata('failed_email', 'Your email is invalid');
                    $this->load->view('templates/header');
                    $this->load->view('customers/forgotpassword', $data);
                    $this->load->view('templates/footer');
                }
            }
        }

        //CUSTOMER THIS EMAIL SENDING CODE
        public function sendEmail($email,$subject,$message){
            $config = Array(
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            ); 
            //THIS EMAIL CONFIGURATION FOR SENDING EMAIL BY GOOGLE EMAIL FROM LOCALHOST
             $config = Array(
                    'protocol' => 'stmp',
                    'smtp_host' => 'ssl://stmp.googlemail.com',

                    'smtp_port' => 465,
                    'smtp_user' => 'kostas@gmail.com',
                    'smtp_pass' => 'password',

                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
            );
             
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('noreply');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);

            if($this->email->send()){
                return true;
            }else{
                return false;
            }

        } */

    }
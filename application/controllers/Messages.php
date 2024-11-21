<?php
    class Messages extends CI_Controller{
        public function index($offset = 0){
            // Check Login
            if(!$this->session->userdata('logged_in')){
                redirect('customers/login');
            }
            // Pagination Config
            $config['base_url']= base_url() . 'messages/index/';
            $config['total_rows'] = $this->db->count_all('messages');
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');
            
            // Init Pagination
            $this->pagination->initialize($config);

            $data['title'] = 'Latest Messages';

            $data['messages'] = $this->message_model->get_messages(FALSE, $config['per_page'], $offset);

            $this->load->view('templates/header');
            $this->load->view('messages/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($slug = NULL){
            // Check Login
            if(!$this->session->userdata('logged_in')){
                redirect('customers/login');
            }

            $data['message'] = $this->message_model->get_messages($slug);

            if(empty($data['message'])){
                show_404();
            }

            $data['title'] = $data['message']['title'];

            $this->load->view('templates/header');
            $this->load->view('messages/view', $data);
            $this->load->view('templates/footer');
        }

        public function create(){
            // Check Login
            if(!$this->session->userdata('logged_in')){
                redirect('customers/login');
            }

            $data['title'] = 'Create Message';

            $this->form_validation->set_rules('title','Subject','required');
            $this->form_validation->set_rules('body','Text Area','required');

            if($this->form_validation->run() === FALSE){    
                $this->load->view('templates/header');
                $this->load->view('messages/create', $data);
                $this->load->view('templates/footer');
            }else{
                $this->message_model->create_message();
                //Set Message
                $this->session->set_flashdata('message_sent', 'Your message has been sent');
                redirect('messages');
            }
        }

        public function delete($id){
            // Check Login
            if(!$this->session->userdata('logged_in')){
                redirect('customers/login');
            }

            $this->message_model->delete_message($id);

            //Set Message
            $this->session->set_flashdata('message_deleted', 'Your message has been deleted');
            redirect('messages');
        }


    }
<?php
    class AdminMessages extends CI_Controller{
        public function indexAdmin($offset = 0){
            // Check Login
            if(!$this->session->userdata('adminlogged_in')){
                redirect('admin/loginAdmin');
            }
            // Pagination Config
            $config['base_url']= base_url() . 'adminmessages/indexAdmin/';
            $config['total_rows'] = $this->db->count_all('messages');
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');
            
            // Init Pagination
            $this->pagination->initialize($config);

            $data['title'] = 'All latest messages';

            $data['messages'] = $this->adminmessage_model->get_messages(FALSE, $config['per_page'], $offset);

            $this->load->view('templates/header');
            $this->load->view('adminmessages/indexAdmin', $data);
            $this->load->view('templates/footer');
        }

        public function viewAdmin($slug = NULL, $lastname = FALSE){
            // Check Login
            if(!$this->session->userdata('adminlogged_in')){
                redirect('admin/loginAdmin');
            }
            $data['message'] = $this->adminmessage_model->get_messages($slug);
            //$data2['message'] = $this->adminmessage_model->get_customers($slug);

            //$row = $data2;
            //$name = $row->name;
            //$lastname = $row->lastname;
            //$email = $row->email;
            
            //$data['message'] = $data['message'] + $data2['customers'];
            
            if(empty($data['message'])){
                show_404();
            }
            $data['title'] = $data['message']['title'];             

            $this->load->view('templates/header');
            $this->load->view('adminmessages/viewAdmin', $data);
            $this->load->view('templates/footer');

        }

    }

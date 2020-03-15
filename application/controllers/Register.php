<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required helpers and libraries
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
        
        //load our Register model here
        $this->load->model('RegisterModel', 'register');
    }

    //registration form page
    public function index() {
        //check if the user is already logged in 
        //if yes redirect to the catalogue page
        if ($this->session->userdata('logged_in')) {
            redirect(base_url() . 'catalogue');
        }
        //load the register page views
        $this->load->view('header');
        $this->load->view('register_page');
        $this->load->view('footer');
    }

    //register validation and logic
    public function doRegister() {
        //set the form validation here
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'register');
        } else {
            //if not get the input values
            $name = $this->input->post('name');
            $age = $this->input->post('age');
            $sex = $this->input->post('sex');
            $occupation = $this->input->post('occupation');
            $password = sha1($this->input->post('password'));
            $imgPath = $this->img_upload();
            $data = [
                'name' => $name, 'edad' => $age, 'sex' => $sex, 
                'ocupacion' => $occupation, 'passwd' => $password, 'pic' => $imgPath
            ];
            //pass the input values to the register model
            $insert_data = $this->register->add_user($data);
            //if data inserted then set the success message and redirect to login page
            if ($insert_data) {
                $id = $this->db->insert_id();
                $this->session->set_flashdata('msg', 'Successfully registered, Login now! Your ID is: '. $id);
                redirect(base_url() . 'login');
            }
        }
    }

    public function img_upload() {
        $config = array(
            'upload_path' => "./assets/imgs/users",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "1024",
            'max_width' => "2048"
        );
        $this->load->library('upload', $config);
        if($this->upload->do_upload('img')) {
            return $this->upload->data('file_name');
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error',$error['error']);
        }
    }
}

?>
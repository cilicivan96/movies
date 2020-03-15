<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        $this->load->model('LoginModel', 'login');
        $this->load->model('UserModel', 'user');
    }

    public function index() {
        $logged_in = $this->session->userdata('logged_in');
        if($logged_in){
            redirect(base_url().'catalogue');
        }

        $this->load->view('header');
        $this->load->view('login_page');
        $this->load->view('footer');
    }

    public function doLogin() {
        $id = $this->input->post('id');
        $password = sha1($this->input->post('password'));
        
        $check_login = $this->login->checkLogin($id, $password);
        if ($check_login) {
            $user = $this->user->get_user($id);
            $name = $user->name;
            $imgName = $user->pic;
            $this->session->set_userdata('id', $id);
            $this->session->set_userdata('name', $name);
            if ($imgName != "") {
                $this->session->set_userdata('imgName', $imgName);
            } else {
                $this->session->set_userdata('imgName', 'blank.png');
            }
            $this->session->set_userdata('logged_in', true);
            redirect(base_url().'catalogue');
        } else {
            $this->session->set_userdata('logged_in', false);
            
            $this->session->set_flashdata('msg', 'Username / Password Invalid');
            redirect(base_url().'login');            
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }
}

?>
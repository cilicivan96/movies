<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recommendation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();

        $this->load->model('MovieModel', 'movie');
    }


    public function index() {
      	$address = 'localhost';
        $port = '1111';
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $result = socket_connect($socket, $address, $port);
        if ($result === false) {
            $this->load->view('error');;
    	} else {
            $id = $this->session->userdata('id');
            $path="/home/alumnos/ai22/public_html/matlab\r\n";
            $fun="filtering(".$id.")\r\n";
            $info = $path.$fun.chr(0);
            socket_write($socket, $info, strlen($info));
            socket_close($socket);
	    }       
    }

    public function showrecs() {
        $id_user = $this->session->userdata('id');
        $data['recs'] = $this->movie->get_recs($id_user);
        
        $this->load->view('navbar_header');
        $this->load->view('recs_page', $data);
        $this->load->view('footer');
    }

}

?>
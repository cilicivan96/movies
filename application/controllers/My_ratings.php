<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class My_ratings extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->model('MovieModel', 'movie');

        $logged_in = $this->session->userdata('logged_in');
        if (!$logged_in) {
            redirect(base_url() . 'login');
        }
    }

    public function index() {
        $data = $this->get_ratings();

        $this->load->view('navbar_header');
        $this->load->view('myratings_page', $data);
        $this->load->view('footer');
    }

    public function get_ratings() {
        $id = $this->session->userdata('id');
        $movies = $this->movie->get_rated_movies($id);
        $data['movies'] = $movies;
        return $data;
    }
}

?>
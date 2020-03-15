<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Catalogue extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        
        $this->load->model('MovieModel', 'movie');
    }

    public function index() {
        $data = $this->get_catalogue();

        $this->load->view('navbar_header');
        $this->load->view('catalogue_page', $data);
        $this->load->view('footer');
    }

    public function get_catalogue() {
        $id_user = $this->session->userdata('id');
        $movies = $this->movie->get_movies_catalogue();
        $n_and_r = $this->movie->get_n_and_r();
        $data['movies'] = $movies;
        $data['N'] = $n_and_r->n;
        $data['R'] = $n_and_r->r;
        if($id_user != null) {
            $favorites = $this->movie->get_favorites($id_user);
            $data['favorites'] = $favorites;
        }
        return $data;
    }

    public function addfavorite($id_movie = NULL) {
        $id_user = $this->session->userdata('id');
        $this->movie->store_favorite($id_user, $id_movie);
    }

    public function removefavorite($id_movie = NULL) {
        $id_user = $this->session->userdata('id');
        $this->movie->delete_favorite($id_user, $id_movie);
    }
}

?>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Movie extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        
        $this->load->model('MovieModel', 'movie');
    }

    public function index() {
        
    }

    public function getmovie($id_movie = NULL) {
        if ($id_movie != NULL) {
            $id_user = $this->session->userdata('id');
            $data['movie_genre'] = $this->movie->get_movie_with_genre($id_movie);
            if ($id_user != null) {
                if (($row = $this->movie->get_user_rating($id_movie, $id_user)) != NULL) {
                    $data['user_rating'] = $row->score;
                } else {
                    $data['user_rating'] = NULL;
                }
            }
            if (($comments = $this->movie->get_comments($id_movie)) != NULL) {
                $data['comments'] = $comments;
            } else {
                $data['comments'] = NULL;
            }

            $this->load->view('navbar_header');
            $this->load->view('movie_page', $data);
            $this->load->view('footer');
        }
    }

    public function rating($score = NULL, $id_movie = NULL) {
        $id_user = $this->session->userdata('id');
        $this->movie->store_user_rating($id_user, $id_movie, $score);
    }

    public function addcomment() {
        $comment = $this->input->post('com_text');
        $id_movie = $this->input->post('id_movie');
        $id_user = $this->session->userdata('id');
        $this->movie->store_comment($id_movie, $id_user, $comment);

        $this->getmovie($id_movie); 
    }

}

?>
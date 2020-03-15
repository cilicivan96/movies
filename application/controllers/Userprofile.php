<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Userprofile extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('UserModel', 'user');
        $this->load->model('MovieModel', 'movie');
    }

    public function index() {
        $id = $this->session->userdata('id');
        $data['favorites'] = $this->movie->get_favorites_names($id);
        $data['user'] = $this->user->get_user($id);
        $data['genre'] = $this->movie->get_all_genres();

        $this->load->view('navbar_header');
        $this->load->view('userprofile_page', $data);
        $this->load->view('footer');
    }

    public function editprofile() {
        $id = $this->session->userdata('id');
        $data['user'] = $this->user->get_user($id);

        $this->load->view('navbar_header');
        $this->load->view('editprofile_page', $data);
        $this->load->view('footer');
    }

    public function updatedata() {
        $id = $this->session->userdata('id');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'userprofile/editprofile');
        } else {
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
            $update_data = $this->user->update_profile_data($data, $id);
            //if data inserted then set the success message and redirect to login page
            if ($update_data) {
                $this->session->set_userdata('name', $name);
                $this->session->set_userdata('imgName', $imgPath);
                if($imgPath) {
                    $this->session->set_flashdata('msg', 'Successfully updated profile!');
                }
                redirect(base_url() . 'userprofile');
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

    public function toprated($genre = NULL) {
        $toprated = $this->movie->get_movies_by_genre($genre);
        $html = '<thead><tr><th scope="col">Title</th><th scope="col">Rating</th></tr></thead><tbody>';
        foreach($toprated as $row) {
            $html = $html . '<tr>';
            $html = $html . '
            <td><a href="' . base_url() . 'movie/getmovie/' . $row->id . '">' .  $row->title . '</a>';
            $html = $html . '
            <td>' . $row->r . '</td>';
            $html = $html . '</tr>';
        }
        $html = $html . '</tbody>';
        echo json_encode($html);
    }
}

?>
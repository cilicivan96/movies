<?php

class MovieModel extends CI_Model {
    
    public function get_movie($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('movie');
        return $query->row();
    }

    public function get_movies_catalogue() {
        $query = 'SELECT id, title, `date`, url_imdb, url_pic, `desc`, AVG(score) as ri, COUNT(*) as ni 
                FROM movie JOIN user_score ON id = id_movie GROUP BY id ORDER by ri DESC';
        return $this->db->query($query)->result();
    }

    public function get_n_and_r() {
        $query = 'SELECT COUNT(*) as n,AVG(score) as r FROM movie JOIN user_score ON id = id_movie';
        return $this->db->query($query)->row();
    }

    public function get_movie_with_genre($id_movie) {
        $query = 'SELECT movie.id AS movie_id, title, `desc`, url_pic, name FROM movie 
        JOIN moviegenre ON movie.id = moviegenre.movie_id 
        JOIN genre ON moviegenre.genre = genre.id WHERE movie.id = ' . $id_movie;
        return $this->db->query($query)->result();
    }

    public function get_user_rating($id_movie, $id_user) {
        $query = 'SELECT score FROM movie JOIN user_score ON movie.id = user_score.id_movie 
        WHERE id_movie = ' . $id_movie . ' AND id_user = ' . $id_user;
        return $this->db->query($query)->row();
    }

    public function store_user_rating($id_user, $id_movie , $score) {
        $query = 'REPLACE INTO user_score(id_user, id_movie, score, time) VALUES (' . $id_user . 
        ', ' . $id_movie . ', ' . $score . ', NOW())';
        return $this->db->query($query);
    }

    public function get_comments($id_movie) {
        $query = 'SELECT name, comment FROM moviecomments JOIN users ON user_id = id 
        WHERE movie_id = ' . $id_movie;
        return $this->db->query($query)->result();
    }

    public function store_comment($id_movie, $id_user, $comment) {
        $query = 'INSERT INTO moviecomments(movie_id, user_id, comment) VALUES (' . $id_movie . ', ' .
            $id_user . ', \'' . $comment . '\')';
        return $this->db->query($query);
    }

    public function store_favorite($id_user, $id_movie) {
        $query = 'INSERT INTO favorites(id_user, id_movie) VALUES (' . $id_user . ', ' .
            $id_movie . ')';
        return $this->db->query($query);
    }

    public function delete_favorite($id_user, $id_movie) {
        $query = 'DELETE FROM favorites WHERE id_user = ' . $id_user . ' AND id_movie = ' . $id_movie;
        return $this->db->query($query);
    }

    public function get_favorites($id_user) {
        $query = 'SELECT id_movie FROM favorites WHERE id_user = ' . $id_user;
        $result = $this->db->query($query)->result_array();
        return array_column($result,'id_movie');
    }

    public function get_favorites_names($id_user) {
        $query = 'SELECT id, title FROM favorites JOIN movie ON favorites.id_movie = movie.id 
        WHERE id_user = ' . $id_user;
        return $this->db->query($query)->result();
    }

    public function get_rated_movies($id_user) {
        $query = 'SELECT id, title, `date`, url_pic, `desc`, score FROM movie JOIN user_score ON id = id_movie
        WHERE id_user = ' . $this->session->userdata('id') . ' GROUP BY id';
        return $this->db->query($query)->result();
    }

    public function get_recs($id_user) {
        $query = 'SELECT * FROM recs JOIN movie ON movie_id = id 
        LEFT JOIN favorites ON user_id = id_user AND movie_id = id_movie 
        WHERE user_id = ' . $id_user . ' AND rec_score > 0.0';
        return $this->db->query($query)->result();
    }

    public function get_all_genres() {
        $query = 'SELECT id,name FROM genre';
        return $this->db->query($query)->result();
    }

    public function get_movies_by_genre($genre) {
        $query = 'SELECT movie.id, title, AVG(score) AS r FROM movie JOIN moviegenre ON movie.id = movie_id 
        JOIN genre ON moviegenre.genre = genre.id JOIN user_score ON movie.id = id_movie 
        WHERE genre.id = \'' .$genre . '\' GROUP BY movie.id';
        return $this->db->query($query)->result();
    }
    
}

?>
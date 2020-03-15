<?php

class LoginModel extends CI_Model {

    public function checkLogin($id, $password) {
        $this->db->where('id', $id);
        $this->db->where('passwd', $password);
        $query = $this->db->get('users');
        return $query->num_rows();
    }
    
}

?>
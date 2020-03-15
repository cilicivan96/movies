<?php

class UserModel extends CI_Model {
    
    public function get_user($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function update_profile_data($data, $id) {
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('users');
    }
    
}

?>
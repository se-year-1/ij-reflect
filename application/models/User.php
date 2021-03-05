<?php

class User extends CI_Model {

    public $email;
    
    public $id;
    
    public $familyName;
    
    public $givenName;
    
    public $name;
    
    public $gender;
    
    public $locale;
    
    public $picture;
    
    public $level;

    public function add($user_object) {
        
        $this->db->where('email', $user_object->email);
        $query = $this->db->get('User');

        if (!$query->num_rows() > 0) {
            
            $this->db->insert('User', $user_object);
        }
    }
    
    public function get_user($email) {
        
        $this->db->where('email', $email);
        $query = $this->db->get('User');

        return $query->row();
    }

}
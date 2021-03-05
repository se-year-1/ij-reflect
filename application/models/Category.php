<?php

/**
 * A category of one or more questions.
 */
class Category extends CI_Model {

    /**
     * Category unique identifier.
     * @var int
     */
    public $id;

    /**
     * Category name.
     * @var string
     */
    public $name;

    /**
     * Category description.
     * @var string
     */
    public $description;

    /**
     * Query the database to return the specified category.
     * @param int $idcategory
     * @return array of objects
     */
    public function get_category($idcategory) {
        
        $this->db->where('id', $idcategory);
        $query = $this->db->get('Category');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Query the database to return the entire Category table.
     * @return array of objects
     */
    public function get_all() {

        $query = $this->db->get('Category');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    /**
     * Delete the category with the given ID
     * @param int $id_category
     * @return boolean whether the deletion succeeded
     */
    public function delete($id_category) {
        $this->db->where('id', $id_category);
        
        $this->db->delete('Category');
        return ($this->db->affected_rows() === 1);
    }
    
    /**
     * Insert a category with the given POST data
     * @return boolean whether insertion succeeded
     */
    public function insert() {
        $this->name = $this->input->post("name");
        $this->description = $this->input->post("description");
        
        $this->db->insert("Category", $this);
        return ($this->db->affected_rows() === 1);
    }
    
    /**
     * Edit a category with the given POST data
     * @return boolean whether editing succeeded
     */
    public function edit() {
        $this->id = $this->input->post("id");
        $this->name = $this->input->post("name");
        $this->description = $this->input->post("description");
        
        //BUG: database pk becomes 0!
        //FIX: id was not set above, active record produces SET id = NULL
        $this->db->update("Category", $this, array('id' => $this->input->post("id")));
        return ($this->db->affected_rows() === 1);
    }

}

<?php

/**
 * A question in the form.
 */
class Question extends CI_Model {

    /**
     * Question unique identifier.
     * @var int 
     */
    public $id;

    /**
     * ID of the category that the question belongs to. 
     * @var int
     */
    public $idcategory;

    /**
     * Question description.
     * @var string 
     */
    public $description;

    /**
     * Query the database to return the specified question.
     * @param int $idquestion 
     * @param int $idcategory
     * @return array of objects
     */
    public function get_question($idquestion, $idcategory = null) {

        $this->db->where('id', $idquestion);
        if ($idcategory !== null) {
            $this->db->where('idcategory', $idcategory);
        }
        $query = $this->db->get('Question');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Query the database to return the entire Question table.
     * @return array of objects
     */
    public function get_all() {

        $query = $this->db->get('Question');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Query the database to return all the questions by the id of the category
     * they belong to
     * @param int $idcategory The ID of the category
     * @return array The questions belonging to the category
     */
    public function get_all_by_category($idcategory) {
        $this->db->where('idcategory', $idcategory);
        $query = $this->db->get('Question');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Delete the question with the given ID
     * @param int $id_question
     * @return boolean whether the deletion succeeded
     */
    public function delete($id_question) {
        $this->db->where('id', $id_question);

        $this->db->delete('Question');
        return ($this->db->affected_rows() === 1);
    }
    
    /**
     * Insert a category with the given POST data
     * @return boolean whether insertion succeeded
     */
    public function insert() {
        $this->idcategory = $this->input->post("idcategory");
        $this->description = $this->input->post("description");
        
        $this->db->insert("Question", $this);
        return ($this->db->affected_rows() === 1);
    }
    
    /**
     * Edit a category with the given POST data
     * @return boolean whether editing succeeded
     */
    public function edit() {
        $this->id = $this->input->post("id");
        $this->idcategory = $this->input->post("idcategory");
        $this->description = $this->input->post("description");
        
        //BUG: database pk becomes 0!
        //FIX: id was not set above, active record produces SET id = NULL
        $this->db->update("Question", $this, array('id' => $this->input->post("id")));
        return ($this->db->affected_rows() === 1);
    }

}

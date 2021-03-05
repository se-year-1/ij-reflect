<?php

/**
 * A gradation belonging to a question. A gradation is a possible answer to a 
 * question. A gradation has a description, a level and a question it belongs to.
 */
class Gradation extends CI_Model {

    /**
     * Gradation unique identifier.
     * @var int
     */
    public $id;

    /**
     * Gradation level (1-5).
     * @var int
     */
    public $gradationlevel;

    /**
     * ID of the question that the gradation belong to.
     * @var int
     */
    public $idquestion;

    /**
     * Gradation description.
     * @var string
     */
    public $description;

    /**
     * Query the database to return all the gradation of the specified 
     * ($idquestion) question.
     * @param int $idquestion The ID of the question.
     * @return array The gradations belonging to the question specified.
     */
    public function get_gradations($idquestion) {
        $this->db->where('idquestion', $idquestion);
        $this->db->order_by('gradationlevel', 'asc');
        $query = $this->db->get('Gradation');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Query the database to return the entire Gradation table.
     * @return array of objects
     */
    public function get_all() {
        $query = $this->db->get('Gradation');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    
    public function insert($gradationlevel, $id_question, $description) {
        $this->gradationlevel = $gradationlevel;
        $this->idquestion = $id_question;
        $this->description = $description;
        
        $this->db->insert("Gradation", $this);
        return ($this->db->affected_rows() === 1);
    }
    
    public function edit($id_gradation, $gradationlevel, $id_question, $description) {
        $this->id = $id_gradation;
        $this->gradationlevel = $gradationlevel;
        $this->idquestion = $id_question;
        $this->description = $description;
        
        $this->db->update("Gradation", $this, array('id' => $id_gradation));
        return ($this->db->affected_rows() === 1);
    }

}

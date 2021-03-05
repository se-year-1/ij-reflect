<?php

/**
 * A filled in or partially filled in form for the user.
 */
class Form_History extends CI_Model {

    /**
     * User unifying record.
     * @var string
     */
    public $email;

    /**
     * Starting date and time of the form.
     * @var string 
     */
    public $datetime;

    /**
     * Role of the person who filled it in. 
     * @var string
     */
    public $respondent;

    /**
     * Name of the person who filled it in. 
     * @var string
     */
    public $name_respondent;

    /**
     * Boolean, which will be 1(TRUE) when all the questions in the form have
     * been answered and 0 if questions are left unanswered.
     * @var int
     */
    public $completed;

    /**
     * The form data. The format is [categoryid-questionid-gradationlevel] 
     * seperated by commas: 1-1-2,1-2-4,1-3-2 etc.
     * @var string 
     */
    public $formdata;

    /**
     * The graph data.
     * @var string 
     */
    public $graphdata;

    /**
     * The id of the period this form_history row belongs to.
     * @var int
     */
    public $period_id;

    /**
     * Create or update a form_history record.
     * @param string $email
     * @param string $datetime
     * @param mixed $data form_history object or array with attributes
     */
    public function add($data) {
        $email = NULL;
        $datetime = NULL;

        if (is_array($data)) {
            $email = $data[0];
            $datetime = $data[1];
        } else {
            $email = $data->email;
            $datetime = $data->datetime;
        }

        $this->db->where('email', $email);
        $this->db->where('datetime', $datetime);
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            // update
            $this->db->where('email', $email);
            $this->db->where('datetime', $datetime);
            $this->db->update('Form_History', $data);
        } else {
            // insert
            $this->db->insert('Form_History', $data);
        }
    }

    /**
     * Query the database to return an array of category ids and question ids.
     * @return array 
     */
    public function get_category_question_ids() {

        $this->db->select('c.id as categoryid, q.id as questionid');
        $this->db->from('Category c');
        $this->db->join('Question q', 'c.id = q.idcategory');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Get the descriptions that go with the primary keys in formdata and put
     * them in an array with the keys defined in the 'SELECT' portion.
     * @param array $formdata
     * @return array
     */
    public function get_formdata_descriptions($formdata) {

        $this->db->select('c.id as categoryid, c.name as categoryname, '
                . 'c.description as categorydescription, q.id as questionid, '
                . 'q.description as questiondescription, g.id as gradationid, '
                . 'g.gradationlevel, g.description as gradationdescription');
        $this->db->from('Category c');
        $this->db->join('Question q', 'c.id = q.idcategory');
        $this->db->join('Gradation g', 'q.id = g.idquestion');
        $this->db->order_by("categoryid asc, questionid asc");

        // Loop through $formdata, building the string 'WHERE x = x AND y = y 
        // AND z = z OR x = x ..' etc. for every category + question + answer
        $counter = 0;
        foreach ($formdata as $value) {
            if ($counter == 0) {
                $array = array('c.id' => $value->categoryid, 'q.id'
                    => $value->questionid, 'g.gradationlevel' => $value->gradation);
                $this->db->where($array);
            } else {
                $this->db->or_where('c.id', $value->categoryid);
                $array = array('q.id' => $value->questionid,
                    'g.gradationlevel' => $value->gradation);
                $this->db->where($array);
            }
            $counter++;
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Return the form_history object with the given primary keys
     * @param string $email
     * @param string $datetime
     * @return form_history form history object
     */
    public function get($email, $datetime) {

        $this->db->where('email', $email);
        $this->db->where('datetime', $datetime);
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }

    /**
     * Return the raw JSON formdata from the row specified by the primary keys.
     * @param string $email
     * @param string $datetime
     * @return string
     */
    public function get_raw_formdata($email, $datetime) {

        $this->db->select('formdata as raw_json_formdata');
        $this->db->where('email', $email);
        $this->db->where('datetime', $datetime);
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            return $query->row()->raw_json_formdata;
        } else {
            return NULL;
        }
    }

    /**
     * Decode and combine the graphdata from a certain period into an array and 
     * return the result
     * @param int $id_period
     * @param string $email
     * @return string
     */
    public function get_combined_graphdata($id_period, $email) {

        $this->db->select('graphdata');
        $this->db->where('Form_History.email', $email);
        $this->db->where('graphdata IS NOT NULL');
        $this->db->where('Period.id', $id_period);
        $this->db->join('Period', 'Form_History.period_id = Period.id');
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            $combined_graphdata = array();
            foreach ($query->result() as $row) {
                array_push($combined_graphdata, json_decode($row->graphdata));
            }
            return $combined_graphdata;
        } else {
            return NULL;
        }
    }

    /**
     * Gets the legend for the spider chart
     * @param string $email
     * @return string
     */
    public function get_legend($email) {

        $this->db->select('respondent, name_respondent AS name');
        $this->db->where('email', $email);
        $this->db->where('graphdata IS NOT NULL');
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            $legend = array();
            foreach ($query->result() as $row) {
                if ($row->respondent === "Ikzelf") {
                    array_push($legend, $row->respondent);
                } else {
                    array_push($legend, $row->respondent . ": " . $row->name);
                }
            }
            return json_encode($legend);
        } else {
            return NULL;
        }
    }

    /**
     * Get all the form_history of the user and period_id specified.
     * @param array $period_id
     * @return array
     */
    public function get_active_rows() {

        $this->db->select('datetime, respondent, name_respondent, completed, formdata');
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->where('period_id', $this->session->userdata('period_id'));
        $this->db->order_by('datetime', 'desc');
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Get all the form_history
     * @return array
     */
    public function get_all() {

        $this->db->select('datetime, respondent, name_respondent, completed, formdata');
        $this->db->order_by('datetime', 'desc');
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Get all the completed form_history of the user and period_id.
     * @return array
     */
    public function get_completed_rows() {

        $this->db->select('Form_History.datetime, respondent, name_respondent, completed, formdata, period_id, name');
        $this->db->join('Period', 'Period.id = Form_History.period_id');
        $this->db->where('Form_History.email', $this->session->userdata('email'));
        $this->db->where('period_id !=', $this->session->userdata('period_id'));
        $this->db->order_by('Form_History.datetime', 'desc');
        $query = $this->db->get('Form_History');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Return an array with the completed rows specified by the period_id.
     * @param int $period_id
     */
    public function get_by_period_id($period_id) {

        $this->db->select('Form_History.datetime, respondent, name_respondent, completed, formdata, period_id, name');
        $this->db->join('Period', 'Period.id = Form_History.period_id');
        $this->db->where('Form_History.email', $this->session->userdata('email'));
        $this->db->where('period_id', $period_id);
        $this->db->order_by('Form_History.datetime', 'desc');
        $query = $this->db->get('Form_History');


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Deletes formdata row in db with pk specified
     * @param string $email
     * @param string $datetime
     */
    public function delete($email, $datetime) {

        $this->db->where('email', $email);
        $this->db->where('datetime', $datetime);
        $this->db->delete('Form_History');
    }

}

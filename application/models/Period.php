<?php

class Period extends CI_Model {

    /**
     * The id of a period (PK).
     * @var int 
     */
    public $id;

    /**
     * Email of the user.
     * @var string
     */
    public $email;

    /**
     * Starting datetime of the period.
     * @var string
     */
    public $datetime;

    /**
     * Name of the period.
     * @var string
     */
    public $name;

    /**
     * Boolean if the period is the current active period.
     * @var boolean
     */
    public $active;

    /**
     * Create a new period record if there is no currently active period.
     */
    public function create_active() {

        $this->load->helper('date');
        $period_object = array(
            'email' => $this->session->userdata('email'),
            'datetime' => date('Y-m-d H:i:s'),
            'name' => 'Mijn periode',
            'active' => 1
        );

        if ($this->active_exists() == FALSE) {
            $this->db->insert('Period', $period_object);
        }
    }

    /**
     * Completed the currently active period.
     */
    public function complete() {
        $this->db->where('id', $this->session->userdata('period_id'));
        $this->db->update('Period', array('active' => 0));
    }

    /**
     * Remove the formdata for each reflection in the period specified.
     * @param int $period_id
     */
    public function delete_all_formdata($period_id) {
        $this->db->where('period_id', $period_id);
        $this->db->update('Form_History', array('formdata' => 0));
    }

    /**
     * Check if user has an active period.
     * @param string $email
     * @return boolean
     */
    public function active_exists() {

        $this->db->where('email', $this->session->userdata('email'));
        $this->db->where('active', 1);
        $query = $this->db->get('Period');

        return ($query->num_rows() > 0);
    }

    /**
     * Return the active period.
     * @return array
     */
    public function get_active() {

        $this->db->where('email', $this->session->userdata('email'));
        $this->db->where('active', 1);
        $query = $this->db->get('Period');

        return $query->row();
    }

    /**
     * Return the completed periods and the amount of reflections per period.
     * @return array
     */
    public function get_completed() {

        $query = $this->db->query('SELECT p.id as id, p.email as email, 
                                p.datetime as datetime, 
                                p.name as name, 
                                COUNT(f.period_id) as amount FROM Period p
                                LEFT JOIN Form_History f
                                ON p.id = f.period_id
                                WHERE p.email = "' . $this->session->userdata('email') . '" AND active = 0
                                GROUP BY p.id
                                ORDER BY datetime DESC;');

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    /**
     * Return the period row with the id specified.
     * @param int $period_id
     * @return array
     */
    public function get_period($period_id) {

        $this->db->where('id', $period_id);
        $query = $this->db->get('Period');

        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    /**
     * Update the name of a period with the given POST data
     * @return boolean whether updating succeeded
     */
    public function update_name_active() {
        $data = array('name' => $this->input->post('period_name'));
        $this->db->where('id', $this->session->userdata('period_id'));

        $this->db->update('Period', $data);

        return ($this->db->affected_rows() === 1);
    }

    /**
     * Update the name of a period with the given POST data
     * @return boolean whether updating succeeded
     */
    public function update_name_completed($period_id) {
        $data = array('name' => $this->input->post('period_name'));
        $this->db->where('id', $period_id);

        $this->db->update('Period', $data);

        return ($this->db->affected_rows() === 1);
    }

    /**
     * Delete a period
     * @param int $period_id
     * @return boolean whether period deletion succeeded
     */
    public function delete($period_id) {
        $this->db->where('id', $period_id);
        $this->db->delete('Period');

        return ($this->db->affected_rows() === 1);
    }

    /**
     * Boolean whether the period has uncompleted reflections
     * @param int $period_id
     * @return boolean
     */
    public function has_uncompleted($period_id) {
        $sql = 'SELECT * 
                FROM `Form_History`
                WHERE formdata LIKE \'%gradation":"0"%\' 
                AND period_id = ' . $period_id;

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    /**
     * Boolean whether the period has reflections or is empty.
     * @param int $period_id
     * @return boolean
     */
    public function is_empty($period_id) {
        $query = $this->db->get_where('Form_History', array('period_id' => $period_id));

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

}

<?php

class Voltooide_Periodes extends CI_Controller {

    /**
     * Constructor for the controller, executes this function before all others.
     */
    public function __construct() {
        parent::__construct();
        $this->utility->require_level(1);
        $this->load->helper('date');
        $this->load->library('form_validation');
    }

    /**
     * Index gets called if no function is specified.
     */
    public function index() {
        $this->load->model('period');
        $this->load->model('form_history');

        $form_history = $this->form_history->get_completed_rows();

        $data['form_history'] = $form_history;
        $data['respondent_count'] = $this->count_respondents($form_history);
        $data['completed_periods'] = $this->period->get_completed();
        $data['page_title'] = "Voltooide Periodes";

        $this->load->template('voltooide_periodes_view', $data);
    }

    /**
     * Load the view with completed period in the table, specified by period_id.
     * @param int period_id
     */
//    public function completed($period_id) {
//
//        $this->load->model('period');
//        $this->load->model('form_history');
//
//        $form_history = $this->form_history->get_by_period_id($period_id);
//
//        $completed_periods = $this->period->get_completed();
//
//        $data['form_history'] = $form_history;
//        $data['respondent_count'] = $this->count_respondents($form_history);
//        $data['completed_periods'] = $completed_periods;
//        $data['page_title'] = "Voltooide Periodes";
//
//        $this->load->template('voltooide_periodes_view', $data);
//    }

    /**
     * Return an array with the amount of respondents for each respondent role 
     * in $form_history.
     * @param array $form_history
     * @return array
     */
    public function count_respondents($form_history) {

        $respondent_count = array();

        foreach ($form_history as $object) {
            if (key_exists($object->respondent, $respondent_count)) {
                $respondent_count[$object->respondent] ++;
            } else {
                $respondent_count[$object->respondent] = 1;
            }
        }
        return $respondent_count;
    }

    /**
     * Deletes formdata row in db with pk specified
     * @param string $datetime
     */
    public function delete_form_history($datetime) {
        $this->load->model('form_history');
        $this->form_history->delete($this->session->userdata('email'), urldecode($datetime));

        redirect('/voltooide_periodes/', 'location', 301);
    }

    /**
     * Set the name of the current period to the POST data given.
     */
    public function update_period_name($period_id) {
        $this->load->model('period');

        $this->form_validation->set_rules('period_name', 'period_name', 'required|min_length[3]|max_length[30]');

        if ($this->form_validation->run() && $this->period->update_name_completed($period_id)) {
            $this->session->set_flashdata('success_message', '<b>Periode naam succesvol aangepast!</b>');
        } else {
            $this->session->set_flashdata('error_message', '<b>Periode naam aanpassen mislukt.</b><br> Naam moet uit minimaal drie karakters bestaan!');
        }

        redirect('/voltooide_periodes/', 'location', 301);
    }

    /**
     * Delete a period
     */
    public function delete_period($period_id) {

        $this->load->model('period');

        if ($this->period->delete($period_id)) {
            $this->session->set_flashdata('success_message', '<b>Periode succesvol verwijderd!</b>');
        } else {
            $this->session->set_flashdata('error_message', '<b>Periode verwijderen mislukt.</b>');
        }
        redirect('/voltooide_periodes', 'location', 301);
    }

}

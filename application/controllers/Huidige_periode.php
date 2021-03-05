<?php

class Huidige_Periode extends CI_Controller {

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


        $form_history = $this->form_history->get_active_rows();

        $percentages_completed = $this->get_percentages_completed($form_history);
        $form_history_with_percs = $this->add_percs_to_form_history($form_history, $percentages_completed);
        $active_period = $this->period->get_active();

        $data['form_history'] = $form_history_with_percs;
        $data['respondent_count'] = $this->count_respondents($form_history);
        $data['active_period'] = $active_period;
        $data['page_title'] = "Huidige Periode";

        $this->load->template('huidige_periode_view', $data);
    }

    /**
     * Completes the currently active period and creates a new active period.
     */
    public function complete_period() {
        if ($this->has_uncompleted($this->session->userdata('period_id'))) {
            $this->session->set_flashdata('error_message', '<b>Periode afsluiten mislukt.</b><br>De periode mag geen onvoltooide reflecties bevatten!');
        } else if ($this->is_empty($this->session->userdata('period_id'))) {
            $this->session->set_flashdata('error_message', '<b>Periode afsluiten mislukt.</b><br>De periode mag niet leeg zijn!');
        } else {
            $this->load->model('period');

            $this->period->complete();
            $this->period->create_active();
            $this->period->delete_all_formdata($this->session->userdata('period_id'));
            $this->set_session_period_id();

            $this->session->set_flashdata('success_message', '<b>Periode succesvol afgesloten.</b><br>Een nieuwe lege periode is gestart.<br>Geef deze zelf een naam!');
        }
        redirect('/huidige_periode', 'location', 301);
    }

    /**
     * Check if the period contains uncompleted reflections
     * @return boolean
     */
    public function has_uncompleted($period_id) {
        $this->load->model('period');
        return $this->period->has_uncompleted($period_id);
    }

    /**
     * Check if the period contains reflections or is empty.
     * @param int $period_id
     * @return boolean
     */
    public function is_empty($period_id) {
        $this->load->model('period');
        return $this->period->is_empty($period_id);
    }

    /**
     * Remove the formdata for each reflection in the period specified.
     * @param int $period_id
     */
    public function delete_all_formdata($period_id) {
        $this->load->mode('period');
        $this->period->delete_all_formdata($period_id);
    }
    
    /**
     * Set the currently active period id in the current session data.
     */
    public function set_session_period_id() {

        $active_period = $this->period->get_active();
        $this->session->set_userdata(['period_id' => $active_period->id]);
    }

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

        $this->index();
    }

    /**
     * Return an array with percentages completed for each formdata row
     * @param array $form_history
     * @return array
     */
    public function get_percentages_completed($form_history) {

        $percentages_completed = array();
        foreach ($form_history as $row) {
            array_push($percentages_completed, $this->utility->get_percentage_done(json_decode($row->formdata)));
        }
        return $percentages_completed;
    }

    /**
     * Add the percentages completed array as a new attribute to form_history
     * @param array $form_history
     * @param array $percentages_completed
     * @return array
     */
    public function add_percs_to_form_history($form_history, $percentages_completed) {

        for ($i = 0; $i < sizeof($form_history); $i++) {
            $form_history[$i]->percentage_done = $percentages_completed[$i];
        }
        return $form_history;
    }

    /**
     * Set the name of the current period to the POST data given.
     */
    public function update_period_name() {
        $this->load->model('period');

        $this->form_validation->set_rules('period_name', 'period_name', 'required|min_length[3]|max_length[30]');

        if ($this->form_validation->run() && $this->period->update_name_active()) {
            $this->session->set_flashdata('success_message', '<b>Periode naam succesvol aangepast!</b>');
        } else {
            $this->session->set_flashdata('error_message', '<b>Periode naam aanpassen mislukt.</b><br> Naam moet uit minimaal drie karakters bestaan!');
        }
        redirect('/huidige_periode', 'location', 301);
    }

}

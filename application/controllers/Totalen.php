<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for the Totals screen.
 */
class Totalen extends CI_Controller {

    /**
     * Constructor for the controller, executes this function before all others.
     */
    public function __construct() {
        parent::__construct();
        $this->utility->require_level(2);
    }

    /**
     * Index gets called if no function is specified.
     */
    public function index() {
        $this->overzicht();
    }

    /**
     * Shows the totals
     */
    public function overzicht() {
        $this->load->model("form_history");
        
        $data['page_title'] = "Totalen";

        $form_history = $this->form_history->get_all();

        $data['form_history'] = $form_history;
        $data['respondent_count'] = $this->count_respondents($form_history);

        $this->load->template('totalen_view', $data);
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

}

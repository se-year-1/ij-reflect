<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for the Graphs screen.
 */
class Grafieken extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utility->require_level(1);
    }

    /**
     * Index gets called if no function is specified.
     */
    public function index() {
        $this->id();
    }
    
    public function id($id_period = "") {
        $this->load->model("period");
        $data['periods'] = $this->period->get_completed();

        $data["id_period"] = $id_period;
        $data['page_title'] = "Grafiekenoverzicht";

        $this->load->template('grafieken_view', $data);
    }

    /**
     * Combine all graph data for the given period and serve it as JSON, ready
     * to be picked up by an AJAX request.
     */
    public function graphdata() {
        $this->load->model("form_history");

        $id_period = $this->input->post("id");
        $email = $this->session->userdata("email");

        $graphdata = $this->form_history->get_combined_graphdata($id_period, $email);

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($graphdata));
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for the Home screen.
 */
class Overons extends CI_Controller {

    /**
     * Constructor for the controller, executes this function before all others.
     */
    public function __construct() {
        parent::__construct();
        $this->utility->require_level(0);
    }

    /**
     * Index gets called if no function is specified.
     */
    public function index() {
        $data['page_title'] = "Over ons";
        
        $this->load->view('templates/page_header', $data);
        $this->load->view('templates/page_topbar', $data);
        $this->load->view('overons', $data);
        $this->load->view('templates/page_footer', $data);
    }
    // test
}

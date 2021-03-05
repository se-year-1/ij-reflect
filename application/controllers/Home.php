<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for the Home screen.
 */
class Home extends CI_Controller {

    /**
     * Constructor for the controller, executes this function before all others.
     */
    public function __construct() {
        parent::__construct();
        $this->utility->require_level(0);
        $this->load->helper('form');
    }

    /**
     * Index gets called if no function is specified.
     */
    public function index() {
        $this->home();
    }

    /**
     * Loads the home_view.
     */
    public function home() {
        
        $data['page_title'] = "Home";
        
        $user_level = $this->session->userdata('level');
        
        if($user_level == 0) {
            $this->load->template('home_login', $data);
        } else if($user_level == 1) {
            $this->load->template('home_view', $data);
        } else if($user_level == 2) {
            $this->load->template('home_admin', $data);
        }
        
    }

}

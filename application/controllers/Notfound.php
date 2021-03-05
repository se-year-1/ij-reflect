<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for the 404 screen.
 */
class Notfound extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utility->require_level(0);
    }

    public function index() {
        $data['page_title'] = "404";

        $this->output->set_status_header('404');

        $this->load->template('notfound_view', $data);
    }

}

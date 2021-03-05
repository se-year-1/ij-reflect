<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Extending the core Exceptions class
 */

class MY_Exceptions extends CI_Exceptions {
    
    // Holds the CodeIgniter instance
    protected $CI;

    public function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
    }

    public function show_404($page = '', $log_error = TRUE) {
        // By default we log this, but allow a dev to skip it
        if ($log_error) {
            log_message('Error', '404: ' . $page);
        }

        $this->CI->output->set_status_header('404');
        $data['page_title'] = "404";
        $this->CI->load->template('Notfound_view', $data);

        echo $this->CI->output->get_output();
        exit(4);
    }

}

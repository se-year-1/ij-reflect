<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

    public function __construct(array $params = array()) {
        parent::__construct($params);
        
        /*
         * If user is not logged in, populate the session level variable,
         * so every loaded page can access the context of the user
         */
        if ($this->CI->session->userdata('level') === false) {
            $this->session->set_userdata(['level' => 0]);
        }
    }

}

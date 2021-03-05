<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility {

    // Holds the CodeIgniter instance
    protected $CI;

    /**
     * Load all CodeIgniter functions since this is an external library
     */
    public function __construct() {
        $this->CI = & get_instance();
        //$this->CI->load->library('session');
    }

    /**
     * Use this in a controller to enforce user login by redirecting to the
     * login page if the user isn't logged in.
     * 
     * context level overview:
     *      0: public
     *      1: member
     *      2: admin
     * 
     * @param int $required_level specify the user level required to access a page or method
     */
    function require_level($required_level = 2) {

        /*
         * It is now safe to assume level is set, since it is automatically set in
         * MY_Session when a controller initializes.
         */
        $user_level = $this->CI->session->userdata('level');

        switch ($required_level) {
            case 0:
                // Public: access allowed for all levels
                break;
            case 1:
                if ($user_level != 1) {
                    // Member: access allowed only on member pages
                    $this->CI->session->set_flashdata('message', "Je moet ingelogd zijn als leerling om deze pagina te bekijken!");
                    redirect(base_url(), 'refresh');
                }
                break;
            case 2:
                if ($user_level != 2) {
                    // Admin: access allowed only on admin pages
                    $this->CI->session->set_flashdata('message', "Je moet ingelogd zijn als administrator om deze pagina te bekijken!");
                    redirect(base_url(), 'refresh');
                }
                break;
            default:
                die("Incorrect page permission settings");
        }
    }

    /**
     * Return the percentage of questions answered in formdata.
     * @param array $formdata
     * @return int 
     */
    public function get_percentage_done($formdata) {

        $total_questions = count($formdata);
        $answered_questions = 0;
        if (is_array($formdata)) {
            foreach ($formdata as $value) {
                if ($value->gradation !== '0') {
                    $answered_questions++;
                }
            }
            return ($answered_questions / $total_questions) * 100;
        }
        return -1;
    }

}

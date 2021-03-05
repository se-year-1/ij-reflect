<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Extending the core Loader class
 */

class MY_Loader extends CI_Loader {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Load the given document using a template
     * @param string $view_name the name of the view to load
     * @param array $vars data to be passed through to te views
     * @param boolean $return whether the loader returns its data or not
     * @return mixed data to be returned
     */
    public function template($view_name, $vars = array(), $return = FALSE) {
        if ($return):
            $content = $this->view('templates/page_header', $vars, $return);
            $content .= $this->view('templates/page_topbar', $vars, $return);
            $content .= $this->view($view_name, $vars, $return);
            $content .= $this->view('templates/page_footer_content', $vars, $return);
            $content .= $this->view('templates/page_footer', $vars, $return);

            return $content;
        else:
            $this->view('templates/page_header', $vars);
            $this->view('templates/page_topbar', $vars);
            $this->view($view_name, $vars);
            $this->view('templates/page_footer_content', $vars);
            $this->view('templates/page_footer', $vars);
        endif;
    }

}

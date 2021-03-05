<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Graph {

    // Holds the CodeIgniter instance
    protected $CI;

    /**
     * Load all CodeIgniter functions since this is an external library
     */
    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * Returns array of graph data in JSON format. Spider data array JSON format is:
     *  {
     *      "name": "name",
     *      "categories": ["a", "b", "c"],
     *      "score": [1, 2, 3]
     *  }
     * 
     * @param formdata $formdata
     * @return string JSON graphdata
     */
    public function create_graphdata($formdata, $form_history) {
        // Initialize the variables
        $name = $form_history->respondent;
        if($form_history->respondent != "Ikzelf") {
            $name .= ": " . $form_history->name_respondent;
        }
        $categories = array();
        $scores = array();
        $category = array('id_category' => '', 'max_score' => 0, 'total_score' => 0);

        // Initialize the category data and reset the score
        $category['id_category'] = $formdata[0]->categoryid;
        self::reset_score($category);

        // Loop through the form data
        foreach ($formdata as $data) :
            
            // If a new category id has been found
            if ($data->categoryid !== $category['id_category']) :
                
                // Push the newly created spider data
                array_push($categories, self::get_category_name($category));
                array_push($scores, self::calculate_percentage($category));

                // Set the category id to the next category and reset the score
                $category['id_category'] = $data->categoryid;
                self::reset_score($category);
            endif;
            
            // Increment the score variables based on the current formdata question
            $category['max_score'] += 4;
            $category['total_score'] += $data->gradation - 1;
            
        endforeach;
        
        // Push the final category stats
        array_push($categories, self::get_category_name($category));
        array_push($scores, self::calculate_percentage($category));

        // Initialize graphdata array
        $graphdata = array();
        $graphdata['name'] = $name;
        $graphdata['categories'] = $categories;
        $graphdata['scores'] = $scores;

        // Morph array to object and JSON encode
        return json_encode((object) $graphdata);
    }

    /**
     * Helper function to reset the score array.
     * @param array $category the category array
     */
    private function reset_score(&$category) {
        $category['max_score'] = 0;
        $category['total_score'] = 0;
    }

    private function calculate_percentage($category) {
        $percentage_score = $category['total_score'] / $category['max_score'] * 100;

        return $percentage_score;
    }

    private function get_category_name($category) {
        $this->CI->load->model("category");

        $id_category = $category['id_category'];
        $name_category = $this->CI->category->get_category($id_category)[0]->name;
        
        /*
         * $name_category = implode("\n", explode(" ", $name_category));
         */

        return $name_category;
    }

}

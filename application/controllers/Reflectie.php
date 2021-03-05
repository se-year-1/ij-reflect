<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for the reflection and result views.
 */
class Reflectie extends CI_Controller {

    /**
     * Constructor for the controller, executes this function before all others.
     */
    public function __construct() {
        parent::__construct();
        $this->utility->require_level(1);
        $this->load->helper('date');
        $this->load->library('form_validation');
    }

    /**
     * Index gets called if no function is specified.
     */
    public function index() {
        $data['page_title'] = "Reflectie: home";
        $this->load->template('home_view', $data);
    }

    /**
     * Loads the pre_reflectie_view.
     */
    public function pre() {
        $data['page_title'] = "Reflectie: start";
        //DEBUG
        $data['formdata'] = $this->unanswered_formdata();
        $this->load->template('pre_reflectie_view', $data);
    }

    /**
     * Initializes a reflection, sets cookies.
     */
    public function reflectie_init() {
        // Form validation
        $this->form_validation->set_message('name_respondent_check');
        $this->form_validation->set_rules('name_respondent', 'naam respondent', 'callback_name_respondent_check');

        if ($this->form_validation->run() == FALSE) {

            //Load the views
            $this->load->template('pre_reflectie_view');
        } else {
            // Set the cookies
            $this->input->set_cookie('starting_datetime', $this->input->post('starting_datetime'), 0);
            $this->input->set_cookie('respondent', $this->input->post('respondent'), 0);
            $this->input->set_cookie('name_respondent', $this->input->post('name_respondent'), 0);

            redirect('/reflectie/q/1/1', 'location', 301);
        }
    }

    /**
     * Load a question with its gradations and provide forminfo to the view.
     * @param int $idcategory The category id of the question.
     * @param int $idquestion The id of the question.
     */
    public function q($idcategory = null, $idquestion = null) {

        $this->load->model('category');
        $this->load->model('question');
        $this->load->model('gradation');
        $this->load->model('form_history');

        // URL error handling
        if ($idcategory === null || $idquestion === null) {
            show_404();
        }

        // URL error handling
        $category = $this->category->get_category($idcategory);
        if ($category === null) {
            show_404();
        } else {
            $data['category'] = $category;
        }

        // URL error handling
        $question = $this->question->get_question($idquestion, $idcategory);
        if ($question === null) {
            show_404();
        } else {
            $data['question'] = $question;
        }
        $data['gradations'] = $this->gradation->get_gradations($idquestion);

        // Get question data
        $formdata = $this->get_formdata($this->session->userdata('email'), $this->input->cookie('starting_datetime'));
        $current_question_index = $this->get_current_question_index($formdata, $idcategory, $idquestion);

        // Treat POST data
        if ($this->input->method() === "post") {
            $this->save_answer_in_formdata($formdata, $current_question_index);
            $this->save_form_history($formdata);
            redirect(current_url(), 'refresh');
        }

        // Set page info
        $data['forminfo'] = $this->get_forminfo($idcategory, $idquestion);
        $data['page_title'] = "Vraag " . ($current_question_index + 1);

        $this->load->template('reflectie_view', $data);
    }

    /**
     * Return an array with information about the form and the current question
     * @param int $idcategory
     * @param int $idquestion
     * @return array
     */
    public function get_forminfo($idcategory, $idquestion) {

        $email = $this->session->userdata('email');
        $datetime = $this->input->cookie('starting_datetime');
        $formdata = $this->get_formdata($email, $datetime);

        $current_question_index = $this->get_current_question_index($formdata, $idcategory, $idquestion);

        // Reflection info
        return $forminfo = [
            'formdata' => $formdata,
            'current_question_index' => $current_question_index,
            'next_question' => $this->get_next_question_ids($formdata, $current_question_index),
            'previous_question' => $this->get_previous_question_ids($formdata, $current_question_index),
            'selected_gradation_level' => $formdata[$current_question_index]->gradation,
            'percentage_done' => $this->utility->get_percentage_done($formdata),
            'total_questions' => count($formdata)
        ];
    }

    /**
     * Add the gradation in $_POST to formdata as an answer to the current question.
     * @param array $formdata
     * @param int $current_question_index
     * @return array
     */
    public function save_answer_in_formdata($formdata, $current_question_index) {

        $gradation_to_insert = $this->input->post('gradation');

        if (array_key_exists('gradation', $this->input->post())) {
            return $formdata = $this->update_formdata_row($formdata, $gradation_to_insert, $current_question_index);
        }
    }

    /**
     * Save a Form_History object in the database by adding/updating a row.
     * @param array $formdata
     * @param array $graphdata
     */
    private function save_form_history($formdata, $graphdata = null) {

        $this->load->model('form_history');
        $form_history_obj = new Form_History(); // Create Form_History object
        $form_history_obj->email = $this->session->userdata('email');
        $form_history_obj->datetime = $this->input->cookie('starting_datetime');
        $form_history_obj->respondent = $this->input->cookie('respondent');
        $form_history_obj->name_respondent = $this->input->cookie('name_respondent');
        $form_history_obj->completed = $this->iscompleted($formdata);
        $form_history_obj->formdata = json_encode($formdata);
        $form_history_obj->period_id = $this->session->userdata('period_id');
        $form_history_obj->graphdata = $graphdata;

        $this->form_history->add($form_history_obj);
    }

    /**
     * Return formdata with an answer updated to the question specified.
     * @param array $formdata
     * @param int $gradationlevel
     * @param int $current_question_index
     * @return array
     */
    public function update_formdata_row($formdata, $gradationlevel, $current_question_index) {

        $formdata[$current_question_index - 1]->gradation = $gradationlevel;
        return $formdata;
    }

    /**
     * Return an array with formdata. Checks if record already exists in the 
     * Form_History table with composite key provided as arguments and uses the 
     * existing formdata.
     * If no record exists, create a new unanswered formdata array.
     * @param string $email
     * @param datetime $datetime
     * @return array formdata
     */
    public function get_formdata($email, $datetime) {

        $this->load->model('Form_History');
        $result_set = $this->form_history->get_raw_formdata($email, $datetime);

        if (isset($result_set)) {

            $formdata = json_decode($result_set);
        } else {

            $formdata = $this->unanswered_formdata();
        }
        return $formdata;
    }

    /**
     * Return an unanswered formdata array.
     * @return array
     */
    public function unanswered_formdata() {

        $this->load->model('form_history');
        $unanswered_formdata = $this->form_history->get_category_question_ids();

        foreach ($unanswered_formdata as $key => $value) {
            $unanswered_formdata[$key]->gradation = "0";
        }

        return $unanswered_formdata;
    }

    /**
     * Returns an array with the category and question IDs of the next question.
     * @param array $formdata
     * @param int $current_question_index
     * @return array
     */
    public function get_next_question_ids($formdata, $current_question_index) {

        $next_question = array();
        if (count($formdata) > $current_question_index + 1) {

            $next_question = $formdata[$current_question_index + 1];
            return $next_question;
        }
        return $formdata[$current_question_index];
    }

    /**
     * Returns an array with the category and question IDs of the previous question.
     * @param array $formdata
     * @param int $current_question_index
     * @return array
     */
    public function get_previous_question_ids($formdata, $current_question_index) {

        $previous_question = array();
        if (count($formdata) >= $current_question_index + 1) {
            if ($current_question_index != 0) {

                $previous_question = $formdata[$current_question_index - 1];
                return $previous_question;
            }
        }
        return isset($formdata[$current_question_index]);
    }

    /**
     * Return the index of the current question in $formdata.
     * @param array $formdata 
     * @param int $current_categoryid 
     * @param int $current_questionid 
     * @return int Index of the current question in $formdata.
     */
    public function get_current_question_index($formdata, $current_categoryid, $current_questionid) {

        $category_indexes = array();
        $current_category = 0;
        $current_question = 0;

        for ($i = 0; $i < count($formdata); $i++) {

            foreach ($formdata[$i] as $key => $value) {

                if ($key == 'categoryid' && $current_categoryid == $value) {
                    array_push($category_indexes, $i);
                    $current_category = $value;
                }
            }

            foreach ($formdata[$i] as $key => $value) {
                if ($key == 'questionid' && $current_questionid == $value && in_array($i, $category_indexes)) {

                    $current_question = $value;
                    return array_search($i, array_keys($formdata));
                }
            }
        }
    }

    /**
     * Load the result screen of a reflection and save the last question to
     * formdata.
     */
    public function result() {

        $this->load->model('category');
        $this->load->model('question');
        $this->load->model('gradation');
        $this->load->model('form_history');

        $data['category'] = $this->category->get_all();
        $data['question'] = $this->question->get_all();
        $data['gradations'] = $this->gradation->get_all();
        
        $email = $this->session->userdata('email');
        $starting_datetime = $this->input->cookie('starting_datetime');

        $formdata = $this->get_formdata($email, $starting_datetime);

        $current_question_index = count($formdata);
        $this->save_answer_in_formdata($formdata, $current_question_index);

        if ($this->iscompleted($formdata)) {
            $this->load->library('graph');
            $form_history = $this->form_history->get($email, $starting_datetime);
            $graphdata = $this->graph->create_graphdata($formdata, $form_history);
            $this->save_form_history($formdata, $graphdata);
        } else {
            $this->save_form_history($formdata);
        }

        $data['starting_datetime'] = $this->input->cookie('starting_datetime');
        $data['respondent'] = $this->input->cookie('respondent');
        $data['name_respondent'] = $this->input->cookie('name_respondent');
        $data['formdata'] = $this->form_history->get_formdata_descriptions($formdata);
        $data['iscompleted'] = $this->iscompleted($formdata);
        $data['page_title'] = "Resultaat reflectie";

        // Load the views
        $this->load->template('post_reflectie_view', $data);
    }

    /**
     * Check if all questions in formdata are answered
     * @param array $formdata
     * @return boolean 0 or 1
     */
    public function iscompleted($formdata) {

        $json_formdata = json_encode($formdata);
        if (strpos($json_formdata, 'gradation":"0"') === FALSE) {
            return 1;
        }
        return 0;
    }

    /**
     * Returns false if the name of the respondent is an empty string
     * @param string $name_respondent
     * @return boolean
     */
    public function name_respondent_check($name_respondent) {

        if ($name_respondent == '') {
            $this->form_validation->set_message('name_respondent_check', 'Voer een naam in in het %s veld');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

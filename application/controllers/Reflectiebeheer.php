<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for the management screen.
 */
class Reflectiebeheer extends CI_Controller {

    /**
     * Constructor for the controller, executes this function before all others.
     */
    public function __construct() {
        parent::__construct();
        $this->utility->require_level(2);

        $this->load->library('form_validation');
    }

    /**
     * Index gets called if no function is specified. Automatically redirect
     * indexs function to category overview
     */
    public function index() {
        $this->menu();
    }

    /**
     * Overview functions below. These functions serve to present overviews
     * of different options and data in the management section.
     */
    
    /**
     * Main page to overview the different options in the admin area
     */
    public function menu() {
        $data['page-title'] = "Reflectiebeheer";

        $this->load->template('admin_menu_view', $data);
    }

    /**
     * Category overview
     */
    public function category() {
        $this->load->model('category');

        $data['page-title'] = "Reflectiebeheer";
        $data['categories'] = $this->category->get_all();

        $this->load->template('categorie_view', $data);
    }

    /**
     * Questions overview
     * @param type $id_category id of the category the questions belong to
     */
    public function questions($id_category = NULL) {
        $this->load->model('category');
        $this->load->model('question');
        $this->load->model('gradation');

        // Check whether the overview should be of all questions or not
        if ($id_category === NULL) {
            $obj = new stdClass;
            $data['category'][0] = $obj;
            $data['category'][0]->name = "alle";
            $questions = $this->question->get_all();
        } else {
            // Get the selected category
            $data['category'] = $this->category->get_category($id_category);
            // Get all questions for that category
            $questions = $this->question->get_all_by_category($id_category);
        }
        // Merge the gradations with the question object they belong to
        foreach ($questions as $index => $question) {
            $questions[$index]->gradations = $this->gradation->get_gradations($question->id);
        }
        $data['questions'] = $questions;
        $data['page-title'] = "Reflectiebeheer";

        $this->load->template('vraag_view', $data);
    }

    /**
     * Validation functions below. These functions serve to validate the entered
     * data and call the corresponding PRG function if the validation succeeds.
     */

    /**
     * Validate the edit category form
     * @param type $id_category
     */
    public function category_modify($id_category) {
        $this->load->model('category');

        // Set up all validation rules
        $this->form_validation->set_rules('name', 'Categorienaam', 'required');
        $this->form_validation->set_rules('description', 'Beschrijving', 'required');

        // Perform validation
        if ($this->form_validation->run() == FALSE) {
            $data['page-title'] = "Categorie bewerken";

            $data['category'] = $this->category->get_category($id_category);

            $this->load->template('categorie_edit_view', $data);
        } else {
            $this->edit_category();
        }
    }

    /**
     * Validate the add category form
     */
    public function category_add() {
        // Set up all validation rules
        $this->form_validation->set_rules('name', 'Categorienaam', 'required');
        $this->form_validation->set_rules('description', 'Beschrijving', 'required');

        // Perform validation
        if ($this->form_validation->run() == FALSE) {
            $data['page-title'] = "Categorie toevoegen";

            $this->load->template('categorie_add_view', $data);
        } else {
            $this->add_category();
        }
    }

    /**
     * Validate the edit question form
     * @param type $id_question
     */
    public function question_modify($id_question) {
        $this->load->model('category');
        $this->load->model('question');
        $this->load->model('gradation');

        // Set up all validation rules
        $this->form_validation->set_rules('gradation[1]', 'Gradatie 1', 'required');
        $this->form_validation->set_rules('gradation[2]', 'Gradatie 2', 'required');
        $this->form_validation->set_rules('gradation[3]', 'Gradatie 3', 'required');
        $this->form_validation->set_rules('gradation[4]', 'Gradatie 4', 'required');
        $this->form_validation->set_rules('gradation[5]', 'Gradatie 5', 'required');
        $this->form_validation->set_rules('description', 'Naam van de vraag', 'required');
        $this->form_validation->set_rules('idcategory', 'Categorie', 'callback_idcategory_check');

        // Perform validation
        if ($this->form_validation->run() == FALSE) {
            $data['categories'] = $this->category->get_all();

            $data['page-title'] = "Vraag bewerken";

            $data['question'] = $this->question->get_question($id_question);
            $data['gradations'] = $this->gradation->get_gradations($id_question);

            $this->load->template('vraag_edit_view', $data);
        } else {
            $this->edit_question();
        }
    }

    /**
     * Callback function for the category validation
     * @param type $str input value
     * @return boolean
     */
    public function idcategory_check($str) {
        if ($str == '0') {
            $this->form_validation->set_message('idcategory_check', 'Selecteer een categorie.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Validate the add question form
     */
    public function question_add() {
        $this->load->model('category');

        $data['categories'] = $this->category->get_all();

        // Set up all validation rules
        $this->form_validation->set_rules('gradation[1]', 'Gradatie 1', 'required');
        $this->form_validation->set_rules('gradation[2]', 'Gradatie 2', 'required');
        $this->form_validation->set_rules('gradation[3]', 'Gradatie 3', 'required');
        $this->form_validation->set_rules('gradation[4]', 'Gradatie 4', 'required');
        $this->form_validation->set_rules('gradation[5]', 'Gradatie 5', 'required');
        $this->form_validation->set_rules('description', 'Naam van de vraag', 'required');
        $this->form_validation->set_rules('idcategory', 'Categorie', 'callback_idcategory_check');

        // Perform validation
        if ($this->form_validation->run() == FALSE) {
            $data['page-title'] = "Vraag toevoegen";

            $this->load->template('vraag_add_view', $data);
        } else {
            $this->add_question();
        }
    }

    /**
     * PRG functions below. These functions treat the POST data and redirect,
     * triggering a GET request.
     */

    /**
     * Delete the specified category
     * @param int $id_category
     */
    public function delete_category($id_category) {
        $this->load->model('category');

        // Test if the PRG operation was succesful
        if ($this->category->delete($id_category)) {
            $this->session->set_flashdata('success_message', 'Categorie succesvol verwijderd!');
        } else {
            $this->session->set_flashdata('error_message', 'Categorie verwijderen mislukt.');
        }

        redirect('/reflectiebeheer/', 'refresh');
    }

    /**
     * Add category
     */
    public function add_category() {
        $this->load->model('category');

        // Test if the PRG operation was succesful
        if ($this->category->insert()) {
            $this->session->set_flashdata('success_message', 'Categorie succesvol toegevoegd!');
        } else {
            $this->session->set_flashdata('error_message', 'Categorie toevoegen mislukt.');
        }

        redirect('/reflectiebeheer/', 'refresh');
    }

    /**
     * Edit category
     */
    public function edit_category() {
        $this->load->model('category');

        // Test if the PRG operation was succesful
        if ($this->category->edit()) {
            $this->session->set_flashdata('success_message', 'Categorie succesvol bewerkt!');
        } else {
            $this->session->set_flashdata('error_message', 'Categorie bewerken mislukt.');
        }

        redirect('/reflectiebeheer/', 'refresh');
    }

    /**
     * Delete the specified question
     * @param int $id_question
     */
    public function delete_question($id_question) {
        $this->load->model('question');

        // Test if the PRG operation was succesful
        if ($this->question->delete($id_question)) {
            $this->session->set_flashdata('success_message', 'Vraag succesvol verwijderd!');
        } else {
            $this->session->set_flashdata('error_message', 'Vraag verwijderen mislukt.');
        }

        redirect('/reflectiebeheer/', 'refresh');
    }

    /**
     * Add question
     */
    public function add_question() {
        $this->load->model('question');
        $this->load->model('gradation');

        // Test if the PRG operation was succesful
        if ($this->question->insert()) {
            $id_question = $this->question->get_question($this->db->insert_id())[0]->id;

            // Loop trough the gradations and insert them
            foreach ($this->input->post('gradation') as $level => $description) {
                $this->gradation->insert($level, $id_question, $description);
            }

            $this->session->set_flashdata('success_message', 'Vraag succesvol toegevoegd!');
        } else {
            $this->session->set_flashdata('error_message', 'Vraag toevoegen mislukt.');
        }

        redirect('/reflectiebeheer/', 'refresh');
    }

    /**
     * Edit question
     */
    public function edit_question() {
        $this->load->model('question');
        $this->load->model('gradation');

        // Test if the PRG operation was succesful
        if ($this->question->edit()) {
            $id_question = $this->question->get_question($this->input->post('id'))[0]->id;
            $gradations = $this->gradation->get_gradations($id_question);

            // Loop trough the gradations and edit them
            foreach ($this->input->post('gradation') as $level => $description) {
                $id_gradation = $gradations[$level - 1]->id;
                $this->gradation->edit($id_gradation, $level, $id_question, $description);
            }

            $this->session->set_flashdata('success_message', 'Vraag succesvol bewerkt!');
        } else {
            $this->session->set_flashdata('error_message', 'Vraag bewerken mislukt.');
        }

        redirect('/reflectiebeheer/', 'refresh');
    }

}

<?php
/**
 * This controller serves the user management pages and tools.
 * @copyright  Copyright (c) 2014-2017 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      0.1.0
 */

if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */

class locations extends CI_Controller {

    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', 'URI=' . $this->uri->uri_string());
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        if($this->session->loggedIn === TRUE) {
           // Allowed methods
           if ($this->session->isAdmin || $this->session->isSuperAdmin) {
             //User management is reserved to admins and super admins
           } else {
             redirect('errors/privileges');
           }
         } else {
           redirect('connection/login');
         }
        $this->load->model('location_model');
    }

    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        // $this->load->helper('form');
        $data['locat'] = $this->location_model->getlocatInfo();
        $data['title'] = 'List of locations';
        $data['activeLink'] = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('locations/index', $data);
        $this->load->view('templates/footer', $data);
    }
    public function edit($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Edit a user';
        $data['activeLink'] = 'users';

        $this->form_validation->set_rules('firstname', 'Firstname', 'required|strip_tags');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|strip_tags');
        $this->form_validation->set_rules('login', 'Login', 'required|strip_tags');
        $this->form_validation->set_rules('email', 'Email', 'required|strip_tags');
        $this->form_validation->set_rules('role[]', 'Role', 'required');
        
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            redirect('notfound');
        }
        if ($this->form_validation->run() === FALSE) {
            $data['roles'] = $this->users_model->getRoles();
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->users_model->updateUsers();
            $this->session->set_flashdata('msg', 'The user was successfully modified.');
            if (isset($_GET['source'])) {
                redirect($_GET['source']);
            } else {
                redirect('users');
            }
        }
    }

    /**
     * Delete a user. Log it as an error.
     * @param int $id User identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete($id) {
        //Test if user exists
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            redirect('notfound');
        } else {
            $this->users_model->deleteUser($id);
        }
        log_message('error', 'User #' . $id . ' has been deleted by user #' . $this->session->userdata('id'));
        $this->session->set_flashdata('msg', 'The user was successfully deleted');
        redirect('users');
    }

    /**
     * Display the form / action Create a new user
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        $data_in['location_name'] =$tihs->input->post('create_location');
        echo json_decode($data_in);
    }
}

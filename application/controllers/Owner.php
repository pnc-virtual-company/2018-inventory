<?php
/**
 * This controller serves the user management pages and tools.
 *
 * @copyright  Copyright (c) 2014-2017 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      0.1.0
 */
// this is owners layout
if (!defined('BASEPATH')) {
    exit('No direct script access allowed'); }

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class Owner extends CI_Controller
{


    /**
     * Default constructor
     *
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        log_message('debug', 'URI='.$this->uri->uri_string());
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        if ($this->session->loggedIn === true) {
            // Allowed methods
            if ($this->session->isAdmin || $this->session->isSuperAdmin) {
                //User management is reserved to admins and super admins
            } else {
                redirect('errors/privileges');
            }
        } else {
            redirect('connection/login');
        }

        $this->load->model('Owners_model', 'owners_model', true);

    }//end __construct()


    /**
     * Display the list of all users
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->load->helper('form');
        $data['title']            = 'List of owners';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('owners/index', $data);
        //to load view owner
        $this->load->view('templates/footer', $data);

    }//end index()


    /**
     * Use for delete owner that get query form model
     * @return void
     */
    public function deleteOwner()
    {
        $idowner      = $this->input->post('idowner');
        $remove_owner = $this->owners_model->deleteOwner($idowner);
        if ($remove_owner) {
            echo "1";
        } else {
            echo "0";
        }

    }//end deleteOwner()


    /**
     * To show the owner for edit
     * @return void
     */
    public function showEditOwner()
    {
        $form    = '';
        $idowner = $this->input->post('idowner');
        $result  = $this->owners_model->showEditOwner($idowner);
        if ($result > 0) {
            foreach ($result as $owner) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Owner: </label> &nbsp;<input type="text" class="form-control" name="update_owner" value="'.$owner->owner.'"> <input type="hidden" value="'.$owner->idowner.'" name="id">';
                $form .= '</div>';
            }
        }

        echo json_encode($form);

    }//end showEditOwner()


    /**
     * Show all the owner that get query from model to show in view
     * @return void
     */
    public function showAllOwner()
    {
        $result = $this->owners_model->showAllOwner();
        echo json_encode($result);

    }//end showAllOwner()


    /**
     * To insert data from form input into databae in table owner
     * @return void
     */
    public function create()
    {
        $data_in['owner'] = $this->input->post('create_owner');
        $owner            = $this->owners_model->create_owner($data_in);
        if ($owner) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }

    }//end create()


    /**
     * For update the owner by load query from model and update to database
     * @return void
     */
    public function update()
    {
        $idowner     = $this->input->post('id');
        $owner       = $this->input->post('update_owner');
        $ownerUpdate = $this->owners_model->updateOwner($idowner, $owner);
        if ($ownerUpdate) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }

            // echo json_encode($data_in);

    }//end update()


}//end class

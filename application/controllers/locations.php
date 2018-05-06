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
        $data['locat'] = $this->location_model->showAlllocat();
        $data['title'] = 'List of locations';
        $data['activeLink'] = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('locations/index', $data);
        $this->load->view('templates/footer', $data);

    }

    //show data location
    public function showAlllocat(){
        $result = $this->location_model->showAlllocat();
        echo json_encode($result);
    }

     //delete location 
      public function deletelocat(){
        $idlocation=  $this->input->post('idlocation');
        $remove_location = $this->location_model->deletelocat($idlocation);
        if ($remove_location) {
            echo "1";
        }else{
            echo "0";
        }
    }

    // show edit location
    public function showEditlocat(){
        $form = '';
        $idlocation=  $this->input->post('idlocation'); 
        $result = $this->location_model->showEditlocation($idlocation);
        if ($result>0) {
            foreach ($result as $locations) {
                $form .='<div class="form-inline">';
                $form .='<label for="">Location: </label> &nbsp;<input type="text" class="form-control" name="update_location" value="'.$locations->location.'"> <input type="hidden" value="'.$locations->idlocation.'" name="id">';
                $form .='</div>';
            }
        }
        echo json_encode($form);
    }

    // create location
    public function create(){
        $data_in['location'] =$this->input->post('create_location');
        $location = $this->location_model->create_location($data_in);
        if ($location)
            echo json_encode(array('status'=>true));
        else    
            echo json_encode(array('status'=>false));        
    }

    // update location
    public function update(){
        $idlocation=  $this->input->post('id');
        $location = $this->input->post('update_location');
        $locationUpdate = $this->location_model->update($idlocation, $location);
        if ($locationUpdate)
            echo json_encode(array('status'=>true));
        else    
            echo json_encode(array('status'=>false));        
    }
}

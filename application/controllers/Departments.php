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
class Departments extends CI_Controller {


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
   $this->load->model('model_department','model_department',TRUE);
}

    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        $this->load->helper('form');
        $data['title'] = 'List of department';
        $data['activeLink'] = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('departments/index', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function deleteDepartment(){
        $iddepartment=  $this->input->post('iddepartment');
        $remove_department = $this->model_department->deleteDepartment($iddepartment);
        if ($remove_department) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function showEditDepartment(){
        $form = '';
        $iddepartment=  $this->input->post('iddepartment'); 
        $result = $this->model_department->showEditDepartment($iddepartment);
        if ($result>0) {
            foreach ($result as $department) {
                $form .='<div class="form-inline">';
                $form .='<label for="">Owner: </label> &nbsp;<input type="text" class="form-control" name="update_department" value="'.$department->department.'"> <input type="hidden" value="'.$department->iddepartment.'" name="id">';
                $form .='</div>';
            }
        }
        echo json_encode($form);
    }


    public function showAllDepartments(){
        $result = $this->model_department->showAllDepartments();
        echo json_encode($result);
    }

    public function create(){
        // $data_in['owner_id'] ='';
        $data_in['department'] =$this->input->post('create_department');
        $department = $this->model_department->create_department($data_in);
        if ($department)
            echo json_encode(array('status'=>true));
        else    
            echo json_encode(array('status'=>false));        

    }

    public function update(){
        $iddepartment=  $this->input->post('id');
        $department = $this->input->post('update_department');
        $departmentUpdate = $this->model_department->updateDepartment($iddepartment, $department);
        if ($departmentUpdate)
            echo json_encode(array('status'=>true));
        else    
            echo json_encode(array('status'=>false));        

            // echo json_encode($data_in);
    }


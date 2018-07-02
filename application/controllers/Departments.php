<?php
// Edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class Departments extends CI_Controller
{


    /**
     * Default constructor ok
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

        $this->load->model('model_department', 'model_department', true);

    }//end __construct()


    /**
     * Display the list of department
     * @return void
     */
    public function index()
    {
        $this->load->helper('form');
        $data['title']            = 'List of department';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('departments/index', $data);
        $this->load->view('templates/footer', $data);

    }//end index()


    /**
     * Display list all department from model department
     * @return void
     */
    public function showAllDepartments()
    {
        $result = $this->model_department->showAllDepartments();
        echo json_encode($result);

    }//end showAllDepartments()


    /**
     * Get delete departments from model to database
     * @return void
     */
    public function deleteDepartment()
    {
        $iddepartment      = $this->input->post('iddepartment');
        $remove_department = $this->model_department->deleteDepartment($iddepartment);
        //Load query delete department from database by iddepartment
        if ($remove_department) {
            echo "1";
        } else {
            echo "0";
        }

    }//end deleteDepartment()


    /**
     * Display edit department from model
     * @return void
     */
    public function showEditDepartment()
    {
        $form         = '';
        $iddepartment = $this->input->post('iddepartment');
        $result       = $this->model_department->showEditDepartment($iddepartment);
        //Load query show edit department from database by iddepartment
        if ($result > 0) {
            foreach ($result as $department) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Department: </label> &nbsp;<input type="text" class="form-control" name="update_department" value="'.$department->department.'"> <input type="hidden" value="'.$department->iddepartment.'" name="id">';
                $form .= '</div>';
            }
        }

        echo json_encode($form);

    }//end showEditDepartment()


    /**
     * Create department into database from modal
     * @return void
     */
    public function create()
    {
        $data_in['department'] = $this->input->post('create_department');
        $department            = $this->model_department->create_department($data_in);
        //Load query create department from database by data_in
        if ($department) {
            echo json_encode(
                ['status' => true]
            );
        } else {
            echo json_encode(
                ['status' => false]
            );
        }

    }//end create()


    /**
     * Update department into database from modal
     * @return void
     */
    public function update()
    {
        $iddepartment     = $this->input->post('id');
        $department       = $this->input->post('update_department');
        $departmentUpdate = $this->model_department->updateDepartment($iddepartment, $department);
        //Load query delete department from database by iddepartment and department
        if ($departmentUpdate) {
            echo json_encode(
                ['status' => true]
            );
        } else {
            echo json_encode(
                ['status' => false]
            );
        }

    }//end update()


}//end class

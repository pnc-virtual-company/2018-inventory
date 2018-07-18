<?php
// this is status layout
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Status extends CI_Controller
{


    /**
     * Default constructor
     *
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('connection_model');
        if (!$this->connection_model->isConnected()) {
            redirect('connection/login');
        }
        if (!$this->connection_model->isAdmin()) {
            redirect('errors/privileges');
        }
        log_message('debug', 'URI='.$this->uri->uri_string());

        $this->load->model('Status_model', 'status_model', true);
    }//end __construct()


    /**
     * Display the list of all users
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        $this->load->helper('form');
        $data['title']            = 'List of status';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('status/index', $data);
        //to load view status
        $this->load->view('templates/footer', $data);
    }//end index()


    /**
     * Use for delete status that get query form model
     * @return void
     */
    public function deleteStatus()
    {
        $idstatus      = $this->input->post('idstatus');
        $remove_status = $this->status_model->deleteStatus($idstatus);
        if ($remove_status) {
            echo "1";
        } else {
            echo "0";
        }
    }//end deleteStatus()


    /**
     * To show the status for edit
     * @return void
     */
    public function showEditStatus()
    {
        $form    = '';
        $idstatus = $this->input->post('idstatus');
        $result  = $this->status_model->showEditStatus($idstatus);
        if ($result > 0) {
            foreach ($result as $status) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Status: </label> &nbsp;<input type="text" class="form-control" name="update_status" value="'.$status->status.'"> <input type="hidden" value="'.$status->idstatus.'" name="id">';
                $form .= '</div>';
            }
        }

        echo json_encode($form);
    }//end showEditStatus()


    /**
     * Show all the status that get query from model to show in view
     * @return void
     */
    public function showAllStatus()
    {
        $result = $this->status_model->showAllStatus();
        echo json_encode($result);
    }//end showAllStatus()


    /**
     * To insert data from form input into databae in table status
     * @return void
     */
    public function create()
    {
        $data_in['status'] = $this->input->post('create_status');
        $status            = $this->status_model->create_status($data_in);
        if ($status) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }//end create()


    /**
     * For update the status by load query from model and update to database
     * @return void
     */
    public function update()
    {
        $idstatus     = $this->input->post('id');
        $status       = $this->input->post('update_status');
        $statusUpdate = $this->status_model->updateStatus($idstatus, $status);
        if ($statusUpdate) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }

        // echo json_encode($data_in);
    }//end update()
}//end class

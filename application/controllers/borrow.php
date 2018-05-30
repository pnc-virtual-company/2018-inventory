<?php
// edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class borrow extends CI_Controller
{
    /**
     * Default constructor ok     
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        log_message('debug', 'URI=' . $this->uri->uri_string());
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        if ($this->session->loggedIn === TRUE) {
            // Allowed methods
            if ($this->session->isAdmin || $this->session->isSuperAdmin) {
                //User management is reserved to admins and super admins
            } else {
                redirect('errors/privileges');
            }
        } else {
            redirect('connection/login');
        }
        $this->load->model('borrow_model', 'borrow_model', TRUE);
    }
    
    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->load->helper('form');
        $data['title']            = 'List of borrow';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('borrow/index', $data);
        $this->load->view('templates/footer', $data);
    }
    
    // Load the list borrower from model
    public function showAllBorrow()
    {
        $result = $this->borrow_model->showAllBorrow();
        echo json_encode($result);
    }
}
?>
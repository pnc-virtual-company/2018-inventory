<?php
/**
 * This controller serves the user management pages and tools.
 *
 * @copyright  Copyright (c) 2014-2017 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      0.1.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class Reports extends CI_Controller
{


    /**
     * construct
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
        $this->load->model('reports_model');
        //load report model
    }//end __construct()


    /**
     * Display the list of all users
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        // $this->load->helper('form');
        $data['reportNew'] = $this->reports_model->getCountNew();
        //call function getCountNew from mode to use in view
        $data['reportFair'] = $this->reports_model->getCountFair();
        //call function from mode to use in view
        $data['reportDamaged'] = $this->reports_model->getCountDamaged();
        //call function from mode to use in view
        $data['reportBroken'] = $this->reports_model->getCountBroken();
        //call function from mode to use in view
        // var_dump($data['reportNew']); die();
        $data['title']            = 'Items Report:';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('reports/charts', $data);
        //to load view chart
        $this->load->view('templates/footer', $data);
    }//end index()


    /**
     * Function is use for show all count the department that have relationship with item list
     * @return void
     */
    public function showDepCount()
    {
        $resultDep = $this->reports_model->getItemByDepartment();
        echo json_encode($resultDep);
    }//end showDepCount()
}//end class

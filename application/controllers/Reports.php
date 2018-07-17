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
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getItemByDepartment();
        $obj->title = "Number of items by condition:";
        echo json_encode($obj);
    }//end showDepCount()

    public function getCountCondition()
    {
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getCountCondition();
        $obj->title = "condition";
        echo json_encode($obj);
    }

    public function getItemCountByCategory()
    {
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getItemCountByCategory();
        $obj->title = "category";
        echo json_encode($obj);
    }

    public function getItemCountByMaterial()
    {
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getItemCountByMaterial();
        $obj->title = "material";
        echo json_encode($obj);
    }

    public function getItemCountByDepartment()
    {
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getItemCountByDepartment();
        $obj->title = "department";
        echo json_encode($obj);
    }

    public function getItemCountByBrand()
    {
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getItemCountByBrand();
        $obj->title = "brand";
        echo json_encode($obj);
    }

    public function getItemCountByLocation()
    {
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getItemCountByLocation();
        $obj->title = "location";
        echo json_encode($obj);
    }

    public function getItemCountByOwner()
    {
        $obj = new \stdClass();
        $obj->result = $this->reports_model->getItemCountByOwner();
        $obj->title = "owner";
        echo json_encode($obj);
    }
}//end class

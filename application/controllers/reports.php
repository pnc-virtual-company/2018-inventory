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
class reports extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();

        $this->load->model('reports_model');
    }

    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() 
    {
        // $this->load->helper('form');
       $data['reportNew'] = $this->reports_model->getCountNew();
        $data['reportFair'] = $this->reports_model->getCountFair();
        $data['reportDamaged'] = $this->reports_model->getCountDamaged();
        $data['reportBroken'] = $this->reports_model->getCountBroken();
        // $data['itemByDep'] = $this->reports_model->getItemByDepartment();
        // var_dump($data['reportNew']); die();
        $data['title'] = 'Items Report:';
        $data['activeLink'] = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('reports/charts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function showDepCount()
    {
        $resultDep = $this->reports_model->getItemByDepartment();
        echo json_encode($resultDep);
    }
}

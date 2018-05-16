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
class borrow extends CI_Controller {
/**
* Default constructor
* @author Benjamin BALET <benjamin.balet@gmail.com>
*/
public function __construct() {
    parent::__construct();
    $this->load->model('brand_model', 'brand_model', TRUE);
    // $this->load->model('brand_model');
}
/**
* Display the list of all users
* @author Benjamin BALET <benjamin.balet@gmail.com>
*/
public function index() {
    $this->load->helper('form');
    $data['brands'] = $this->brand_model->showAllBrand();
    $data['title'] = 'List of brands';
    $data['activeLink'] = 'others';
    $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
    $this->load->view('templates/header', $data);
    $this->load->view('menu/index', $data);
    $this->load->view('form_borrow/index', $data);
    $this->load->view('templates/footer', $data);
}

public function borrow(){
    $this->load->view('form_borrow/index');
    }
}
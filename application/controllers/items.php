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
class items extends CI_Controller {
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
 $this->load->model('items_model');
}

    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        $this->load->helper('form');
        $data['title'] = 'List of Items';
        $data['activeLink'] = 'items';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/index', $data);
        $this->load->view('templates/footer', $data);
    }
    public function showAllitems(){
        $result = $this->items_model->showAllItems();
        echo json_encode($result);
    }
    public function deleteItems(){
        $iditem=  $this->input->post('iditem');
        $remove_item = $this->items_model->deleteItems($iditem);
        if ($remove_item) {
            echo "1";
        }else{
            echo "0";
        }
    }

}
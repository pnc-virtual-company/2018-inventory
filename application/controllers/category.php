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
class category extends CI_Controller {

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
     $this->load->model('category_model');
   }

    /**
     * Display the list of all category
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
      $this->load->helper('form');
      $data['cate'] = $this->category_model->getCateInfo();
        // var_dump($data['cate']); die();
      $data['title'] = 'List of categories';
      $data['activeLink'] = 'others';
      $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
      $this->load->view('templates/header', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('category/index', $data);
      $this->load->view('templates/footer', $data);
    }


    /**
     * Display a for that allows updating a given user
     * @param int $id User identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($id) {
      // $this->load->helper('form');
      // $this->load->library('form_validation');
      // $data['title'] = 'Edit a user';
      // $data['activeLink'] = 'users';



      $data['users_item'] = $this->users_model->getCate($id);
      if (empty($data['users_item'])) {
        redirect('notfound');
      }

    }

    /**
     * Delete a category.
     * @param int $id category identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete($id) {
        //Test if user exists
      $data['cate_item'] = $this->category_model->getCate($id);
      if (empty($data['cate_item'])) {
        redirect('notfound');
      } else {
        $this->category_model->deleteCate($id);
      }
      log_message('error', 'User #' . $id . ' has been deleted by user #' . $this->session->userdata('idcategory'));
      $this->session->set_flashdata('msg', 'The category was successfully deleted');
      redirect('category');
    }


    /**
     * Display the form / action Create a new category
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {

      // $data['title'] = 'Create a category';
      // $data['activeLink'] = 'others';
      // $data['roles'] = $this->users_model->getRoles();

      // $insert = $this->category_model->insertCate();
      // if ($insert) {
        // $this->load->view('category');
        // redirect('category');
      //   // echo "successfully";
      // }else{
      //   redirect('category');
        // echo "not successfully";
      // }

      $data_in['createCategory'] = $this->input->post('createCategory');

      // $this->load->view('category',$data_in);
      echo json_encode($data_in);

    }

    /**
     * Form validation callback : prevent from login duplication
     * @param string $login Login
     * @return boolean TRUE if the field is valid, FALSE otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function checkLogin($login) {
      if (!$this->users_model->isLoginAvailable($login)) {
        $this->form_validation->set_message('checkLogin', lang('users_create_checkLogin'));
        return FALSE;
      } else {
        return TRUE;
      }
    }

    /**
     * Ajax endpoint : check login duplication
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function checkLoginByAjax() {
      $this->output->set_content_type('text/plain');
      if ($this->users_model->isLoginAvailable($this->input->post('login'))) {
        $this->output->set_output('true');
      } else {
        $this->output->set_output('false');
      }
    }

    
  }

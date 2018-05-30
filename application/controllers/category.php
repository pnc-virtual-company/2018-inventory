<?php
// edit by @author Bunla Rath <bunla.rath@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class category extends CI_Controller
{
    
    /**
     * Default constructor
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
        $this->load->model('category_model', 'category_model', TRUE);
    }
    
    /**
     * Display the list of all category
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->load->helper('form');
        $data['title']            = 'List of categories';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('category/index', $data);
        $this->load->view('templates/footer', $data);
    }
    
    // Load all category from model 
    public function showAllCategory()
    {
        $result = $this->category_model->getAllCate();
        echo json_encode($result);
    }
    
    // Create category controller
    public function create()
    {
        $data_in['category'] = $this->input->post('createCategory');
        $category            = $this->category_model->create_category($data_in);
        if ($category)
            echo json_encode(array(
                'status' => true
            ));
        else
            echo json_encode(array(
                'status' => false
            ));
    }
    
    //  show edit category 
    public function showEditCategory()
    {
        $form       = '';
        $idcategory = $this->input->post('idcategory');
        $result     = $this->category_model->showEditCategory($idcategory); //Load from model
        if ($result > 0) {
            foreach ($result as $category) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Category: </label> &nbsp;<input type="text" class="form-control" name="update_category" value="' . $category->category . '"> <input type="hidden" value="' . $category->idcategory . '" name="id">';
                $form .= '</div>';
            }
        }
        echo json_encode($form);
    }
    
    // Update category  
    public function update()
    {
        $idcategory     = $this->input->post('id');
        $category       = $this->input->post('update_category');
        $categoryUpdate = $this->category_model->updateCategory($idcategory, $category); //Load to model
        if ($categoryUpdate)
            echo json_encode(array(
                'status' => true
            ));
        else
            echo json_encode(array(
                'status' => false
            ));
    }
    
    // controller Delete category
    public function deleteCategory()
    {
        $idcategory      = $this->input->post('idcategory');
        $remove_category = $this->category_model->deleteCategory($idcategory); // Load to model
        if ($remove_category) {
            echo "1";
        } else {
            echo "0";
        }
    }
}
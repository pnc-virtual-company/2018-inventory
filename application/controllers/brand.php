<?php
// Edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org> 

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class brand extends CI_Controller
{
    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('brand_model', 'brand_model', TRUE);
    }
    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->load->helper('form');
        $data['brands']           = $this->brand_model->showAllBrand();
        $data['title']            = 'List of brands';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('brands/index', $data);
        $this->load->view('templates/footer', $data);
    }
    
    // Get all data in brand from database
    public function showAllBrand()
    {
        $result = $this->brand_model->showAllBrand(); //Load show all brand from brand model
        echo json_encode($result);
    }
    
    // Crea brand into database
    public function create_brand()
    {
        $data_in['brand'] = $this->input->post('brand');
        $brand            = $this->brand_model->create_brand($data_in); //Load create all brand from brand model
        
        if ($brand) {
            echo json_encode(array(
                'status' => true
            ));
        } else {
            echo json_encode(array(
                'status' => false
            ));
        }
    }
    
    // Delete brand into database
    public function deleteBrand()
    {
        $idbrand      = $this->input->post('idbrand');
        $remove_brand = $this->brand_model->deleteBrand($idbrand); //Load delete brand from brand model
        if ($remove_brand) {
            echo "1";
        } else {
            echo "0";
        }
    }
    
    // Show edit brand from view modal
    public function showEditBrand()
    {
        $form    = '';
        $idbrand = $this->input->post('idbrand');
        $result  = $this->brand_model->showEditBrand($idbrand); //Load show edit brand from brand model by idbrand
        if ($result > 0) {
            foreach ($result as $brand) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Brand: </label> &nbsp;<input type="text" class="form-control" name="update_brand" value="' . $brand->brand . '"> <input type="hidden" value="' . $brand->idbrand . '" name="id">';
                $form .= '</div>';
            }
        }
        echo json_encode($form);
    }
    
    // Update brand with modal pop up
    public function update()
    {
        $idbrand     = $this->input->post('id');
        $brand       = $this->input->post('update_brand');
        $brandUpdate = $this->brand_model->updateBrand($idbrand, $brand); //Load update brand to brand model by idbrand and brand
        if ($brandUpdate) {
            echo json_encode(array(
                'status' => true
            ));
        } else {
            echo json_encode(array(
                'status' => false
            ));
        }
    }
    
}
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
class brand extends CI_Controller {
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
    $this->load->view('brands/index', $data);
    $this->load->view('templates/footer', $data);
}

// show all data in brand
public function showAllBrand(){
    $result = $this->brand_model->showAllBrand();
    echo json_encode($result);
}

// crate brand
public function create_brand(){
    $data_in['brand'] = $this->input->post('brand');
    $brand = $this->brand_model->create_brand($data_in);
    
    if($brand)
        echo json_encode(array('status'=>true));
    else
        echo json_encode(array('status'=>false));
}

// get bran to delete
public function deleteBrand(){
    $idbrand=  $this->input->post('idbrand');
    $remove_brand = $this->brand_model->deleteBrand($idbrand);
    if ($remove_brand) {
        echo "1";
    }else{
        echo "0";
    }
}

// use for show edit
public function showEditBrand(){
    $form = '';
    $idbrand=  $this->input->post('idbrand'); 
    $result = $this->brand_model->showEditBrand($idbrand);
    if ($result>0) {
        foreach ($result as $brand) {
            $form .='<div class="form-inline">';
            $form .='<label for="">Brand: </label> &nbsp;<input type="text" class="form-control" name="update_brand" value="'.$brand->brand.'"> <input type="hidden" value="'.$brand->idbrand.'" name="id">';
            $form .='</div>';
        }
    }
    echo json_encode($form);
}

// use for update
public function update(){
    $idbrand=  $this->input->post('id');
    $brand = $this->input->post('update_brand');
    $brandUpdate = $this->brand_model->updateBrand($idbrand, $brand);
    if ($brandUpdate)
        echo json_encode(array('status'=>true));
    else    
        echo json_encode(array('status'=>false));        

        // echo json_encode($data_in);
}

}
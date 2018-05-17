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
class materials extends CI_Controller {
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
   $this->load->model('materials_model');
}

    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        $this->load->helper('form');
        $data['title'] = 'List of Materials';
        $data['activeLink'] = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('materials/index', $data);
        $this->load->view('templates/footer', $data);
    }
    public function showAllmaterial(){
        $result = $this->materials_model->showAllmaterial();
        echo json_encode($result);
    }

    public function create(){
        $data_in['material'] =$this->input->post('create_material');
        $material = $this->materials_model->create_material($data_in);
        if ($material)
            echo json_encode(array('status'=>true));
        else    
            echo json_encode(array('status'=>false));        
    }
    
    public function deleteMaterial(){
        $idmaterial=  $this->input->post('idmaterial');
        $remove_material = $this->materials_model->deleteMaterial($idmaterial);
        if ($remove_material) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function showEditMaterial(){
        $form = '';
        $showEditMaterial=  $this->input->post('idmaterial'); 
        $result = $this->materials_model->showEditMaterial($showEditMaterial);
        if ($result>0) {
            foreach ($result as $material) {
                $form .='<div class="form-inline">';
                $form .='<label for="">Material: </label> &nbsp;<input type="text" class="form-control" name="update_material" value="'.$material->material.'"> <input type="hidden" value="'.$material->idmaterial.'" name="id">';
                $form .='</div>';
            }
        }
        echo json_encode($form);
    }



    public function update(){
        $idmaterial=  $this->input->post('id');
        $material = $this->input->post('update_material');
        $materialUpdate = $this->materials_model->updateMaterial($idmaterial, $material);
        if ($materialUpdate)
            echo json_encode(array('status'=>true));
        else    
            echo json_encode(array('status'=>false));        

            // echo json_encode($data_in);
    }


}
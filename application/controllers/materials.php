<?php
// edit by @author Bunla Rath <bunla.rath@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class Materials extends CI_Controller
{


    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        log_message('debug', 'URI='.$this->uri->uri_string());
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        if ($this->session->loggedIn === true) {
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

    }//end __construct()


    /**
     * Display the list of all users
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->load->helper('form');
        $data['title']            = 'List of materials';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('materials/index', $data);
        $this->load->view('templates/footer', $data);

    }//end index()


    /**
     * Get all material from database
     * @return void
     */
    public function showAllmaterial()
    {
        $result = $this->materials_model->showAllmaterial();
        echo json_encode($result);

    }//end showAllmaterial()


    /**
     * Insert material into database
     * @return void
     */
    public function create()
    {
        $data_in['material'] = $this->input->post('create_material');
        $material            = $this->materials_model->create_material($data_in);
        //Load to create material in material modal
        if ($material) {
            echo json_encode(
                ['status' => true]
            );
        } else {
            echo json_encode(
                ['status' => false]
            );
        }

    }//end create()


    /**
     * Delete material into database
     * @return void
     */
    public function deleteMaterial()
    {
        $idmaterial      = $this->input->post('idmaterial');
        $remove_material = $this->materials_model->deleteMaterial($idmaterial);
        //Load to delete material in material modal by idmaterial
        if ($remove_material) {
            echo "1";
        } else {
            echo "0";
        }

    }//end deleteMaterial()


    /**
     * Show edit material into pop up modal in view
     * @return void
     */
    public function showEditMaterial()
    {
        $form = '';
        $showEditMaterial = $this->input->post('idmaterial');
        $result           = $this->materials_model->showEditMaterial($showEditMaterial);
        //Load to show edit material in material modal by showEditMaterial
        if ($result > 0) {
            foreach ($result as $material) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Material: </label> &nbsp;<input type="text" class="form-control" name="update_material" value="'.$material->material.'"> <input type="hidden" value="'.$material->idmaterial.'" name="id">';
                $form .= '</div>';
            }
        }

        echo json_encode($form);

    }//end showEditMaterial()


    /**
     * Update material into database
     * @return void
     */
    public function update()
    {
        $idmaterial     = $this->input->post('id');
        $material       = $this->input->post('update_material');
        $materialUpdate = $this->materials_model->updateMaterial($idmaterial, $material);
        //Load to update material in material modal by idmaterial and material
        if ($materialUpdate) {
            echo json_encode(
                ['status' => true]
            );
        } else {
            echo json_encode(
                ['status' => false]
            );
        }

    }//end update()


}//end class

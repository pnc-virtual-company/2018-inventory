<?php
// Edit by @author Sinat Neam <sinat.neam@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */

class Models extends CI_Controller
{


    /**
     * Default constructor
     *
     * @author Benjamin BALET <benjamin.balet@gmail.com>
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
        log_message('debug', 'URI='.$this->uri->uri_string());

        $this->load->model('model_model');
    }//end __construct()


    /**
     * Display the list of all users
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        $this->load->helper('form');
        $id        = $this->uri->segment(3);
        $brandName = $this->model_model->getBrandById($id);
        foreach ($brandName as $value) {
            $data['title']   = $value->brand;
            $data['idbrand'] = $value->idbrand;
        }

        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('models/index', $data);
        $this->load->view('templates/footer', $data);
    }//end index()


    /**
     * Display all list of model with pop up modal
     * @return void
     */
    public function showAllModelsByBrandId()
    {
        $id     = $this->uri->segment(3);
        $result = $this->model_model->showAllModelsByBrandId($id);
        //Load show all model with model_model by $id
        echo json_encode($result);
    }//end showAllModelsByBrandId()


    /**
     * Display create model with pop up modal
     * @return void
     */
    public function create_model()
    {
        $data_in['brandid'] = $this->input->post('brandid');
        $data_in['model']   = $this->input->post('model');
        $model = $this->model_model->create_model($data_in);
        // Load create model with model_model with $data_in
        if ($model) {
            echo json_encode(
                ['status' => true]
            );
        } else {
            echo json_encode(
                ['status' => false]
            );
        }
    }//end create_model()


    /**
     * Delete data model
     * @return void
     */
    public function deleteModel()
    {
        $idmodel      = $this->input->post('idmodel');
        $remove_model = $this->model_model->deleteModel($idmodel);
        // Load delete model with model_model by $idmodel
        if ($remove_model) {
            echo "1";
        } else {
            echo "0";
        }
    }//end deleteModel()


    /**
     * Display edit model with pop up model
     * @return void
     */
    public function showEditModel()
    {
        $idbrand = $this->uri->segment(3);
        $form    = '';
        $idmodel = $this->input->post('idmodel');
        $result  = $this->model_model->showEditModel($idmodel);
        if ($result > 0) {
            foreach ($result as $model) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Model: </label> &nbsp;<input type="text" class="form-control" name="update_model" value="'.htmlspecialchars($model->model).'"> <input type="hidden" value="'.$model->idmodel.'" name="id">';
            }

            $form .= '<input type="hidden" value="'.$idbrand.'" name="brandid">';
            $form .= '</div>';
        }

        echo json_encode($form);
    }//end showEditModel()


    /**
     * Update model by pop up modal
     * @return void
     */
    public function update()
    {
        $idmodel     = $this->input->post('id');
        $model       = $this->input->post('update_model');
        $brandid     = $this->input->post('brandid');
        $modelUpdate = $this->model_model->updateModel($idmodel, $model, $brandid);
        // Load update model with model_model by $idmodel, model and brandid
        if ($modelUpdate) {
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

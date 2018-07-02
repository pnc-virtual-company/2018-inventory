<?php
// Edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class Brand extends CI_Controller
{


    /**
     * Default constructor
     *
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('brand_model', 'brand_model', true);

    }//end __construct()


    /**
     * Display the list of all users
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->load->helper('form');
        $data['brands']           = $this->brand_model->showAllBrand();
        $data['title']            = 'List of brands';
        $data['activeLink']       = 'others';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('brands/index', $data);
        $this->load->view('templates/footer', $data);

    }//end index()


    /**
     * Get all data in brand from database
     * @return void
     */
    public function showAllBrand()
    {
        $result = $this->brand_model->showAllBrand();
        //Load show all brand from brand model
        echo json_encode($result);

    }//end showAllBrand()


    /**
     * Create brand into database
     * @return void
     */
    public function create_brand()
    {
        $data_in['brand'] = $this->input->post('brand');
        $brand            = $this->brand_model->create_brand($data_in);
        //Load create all brand from brand model

        if ($brand) {
            echo json_encode(
                ['status' => true]
            );
        } else {
            echo json_encode(
                ['status' => false]
            );
        }

    }//end create_brand()


    /**
     * Delete brand into database
     * @return void
     */
    public function deleteBrand()
    {
        $idbrand      = $this->input->post('idbrand');
        $remove_brand = $this->brand_model->deleteBrand($idbrand);
        //Load delete brand from brand model
        if ($remove_brand) {
            echo "1";
        } else {
            echo "0";
        }

    }//end deleteBrand()


    /**
     * Show edit brand from view modal
     * @return void
     */
    public function showEditBrand()
    {
        $form    = '';
        $idbrand = $this->input->post('idbrand');
        $result  = $this->brand_model->showEditBrand($idbrand);
        //Load show edit brand from brand model by idbrand
        if ($result > 0) {
            foreach ($result as $brand) {
                $form .= '<div class="form-inline">';
                $form .= '<label for="">Brand: </label> &nbsp;<input type="text" class="form-control" name="update_brand" value="'.$brand->brand.'"> <input type="hidden" value="'.$brand->idbrand.'" name="id">';
                $form .= '</div>';
            }
        }

        echo json_encode($form);

    }//end showEditBrand()


    /**
     * Update brand with modal pop up
     * @return void
     */
    public function update()
    {
        $idbrand     = $this->input->post('id');
        $brand       = $this->input->post('update_brand');
        $brandUpdate = $this->brand_model->updateBrand($idbrand, $brand);
        //Load update brand to brand model by idbrand and brand
        if ($brandUpdate) {
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

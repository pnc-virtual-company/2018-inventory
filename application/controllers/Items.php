<?php
/**
 * This controller serves the user management pages and tools.
 *
 * @copyright  Copyright (c) 2014-2017 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      0.1.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the user management pages and tools.
 * The difference with HR Controller is that operations are technical (CRUD, etc.).
 */
class Items extends CI_Controller
{


    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('connection_model');
        if (!$this->connection_model->isConnected()) {
            redirect('connection/login');
        }
        log_message('debug', 'URI='.$this->uri->uri_string());
        // $this->session->set_userdata('last_page', $this->uri->uri_string());
        $this->load->model('items_model');
        // $this->returnLate();
    }//end __construct()


    /**
     * Display the list of all users
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        $this->returnLate();
        $this->load->helper('form');
        $data['title']            = 'List of Items';
        $data['activeLink']       = 'items';
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/index', $data);
        $this->load->view('templates/footer', $data);
    }//end index()


    /**
     * This function is use for show all the item that get from table item in database
     * @return void
     */
    public function showAllitems()
    {
        $result = $this->items_model->showAllItems();
        echo json_encode($result);
    }//end showAllitems()


    /**
     * This function is use for delete an items from table and database
     * @return void
     */
    public function deleteItems()
    {
        $iditem      = $this->input->post('iditem');
        $remove_item = $this->items_model->deleteItems($iditem);
        if ($remove_item) {
            echo "1";
        } else {
            echo "0";
        }
    }//end deleteItems()


    /**
     * This function is use to show form for update an item when click on update icon
     * @return void
     */
    public function edit()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title']      = 'Update item';
        $data['activeLink'] = 'items';
        $id = $this->uri->segment(3);
        $data['itemEdit'] = $this->items_model->showEditItems($id);
        //this variable is to get data from model
        // var_dump($data['itemEdit']);die();
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/edit', $data);
        $this->load->view('templates/footer');
    }//end edit()


    /**
     * This use for get data from database into form to update
     * @return void
     */
    public function itemUpdate()
    {
        // all these variables is get from form update
        $id            = $this->uri->segment(3);
        $nameitem      = $this->input->post('nameitem');
        $desitem       = $this->input->post('desitem');
        $catitem       = $this->input->post('catitem');
        $matitem       = $this->input->post('matitem');
        $depitem       = $this->input->post('depitem');
        $locitem       = $this->input->post('locitem');
        $moditem       = $this->input->post('moditem');
        $useritem      = $this->input->post('useritem');
        $ownitem       = $this->input->post('ownitem');
        $conditionitem = $this->input->post('conditionitem');
        $dateitem      = $this->input->post('dateitem');
        $costitem      = $this->input->post('costitem');
        $status        = $this->input->post('statusitem');

        // this variable is to get CONV iditem from database to identifier in table Item list
        $getIdMax = $this->items_model->getiditem($id);
        foreach ($getIdMax as $value) {
            $idmaximum = $value->IdMax;
        }

        // this variable is use to show the label when clik on detail item it will show('location - identifier')
        $getLoc = $this->items_model->getLocById($locitem);
        foreach ($getLoc as $value) {
            $locnamebyid = $value->location;
        }

        $code = $locnamebyid.'-'.$idmaximum;

        $item_update = $this->items_model->update_item($nameitem, $desitem, $catitem, $matitem, $depitem, $locitem, $moditem, $useritem, $ownitem, $conditionitem, $dateitem, $costitem, $code, $id, $status);
        if ($item_update) {
            $this->session->set_flashdata('msg', 'The item was updated successfully.');
            redirect('items');
        }
    }//end itemUpdate()


    /**
     * This function will show the form for create an item
     * @return void
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Create a new Item';
        // use to show title of create an item
        $data['activeLink'] = 'items';
        // this use for active on manu
        $data['flashPartialView'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/create', $data);
        $this->load->view('templates/footer');
    }//end create()


    /**
     * This function is use to add data that created from form create item
     * into dabase and show on table list item
     * @return void
     */
    public function itemcreate()
    {
        // All these variables are to store all the data from form create
        $code          = '';
        $nameitem      = $this->input->post('nameitem');
        $desitem       = $this->input->post('desitem');
        $catitem       = $this->input->post('catitem');
        $matitem       = $this->input->post('matitem');
        $depitem       = $this->input->post('depitem');
        $locitem       = $this->input->post('locitem');
        $moditem       = $this->input->post('moditem');
        $useritem      = $this->input->post('useritem');
        $ownitem       = $this->input->post('ownitem');
        $conditionitem = $this->input->post('conditionitem');
        $dateitem      = $this->input->post('dateitem');
        $costitem      = $this->input->post('costitem');

        $getIdMax = $this->items_model->getmaxiditem();
        foreach ($getIdMax as $value) {
            $idmaximum = $value->IdMax;
        }

        if ($locitem != '') {
            $getLoc = $this->items_model->getLocById($locitem);
            foreach ($getLoc as $value) {
                $locnamebyid = $value->location;
            }

            $code = $locnamebyid.'-'.$idmaximum;
        }

        // This varible is use to get data from form to insert into database and show on table
        $item_insert = $this->items_model->add_item($nameitem, $desitem, $catitem, $matitem, $depitem, $locitem, $moditem, $useritem, $ownitem, $conditionitem, $dateitem, $costitem, $code);
        if ($item_insert) {
            $this->session->set_flashdata('msg', 'The item was created successfully.');
            redirect('items');
        }
    }//end itemcreate()

    /**
     * This function is use to show the detail
     * of each item on modal when click on eye icon
     * @return void
     */
    public function showDetailItem()
    {
        $form;
        $iditem = $this->input->post('iditem');
        $result = $this->items_model->showDetailItem($iditem);
        $borrowstatus = '';
        if ($result > 0) {
            foreach ($result as $value) {
                switch ($value->borrowstatus) {
                case 0:
                  $borrowstatus = 'Available';
                  break;
                case 1:
                  $borrowstatus = 'Borrowed';
                  break;
                case 2:
                  if ($this->connection_model->isAdmin()) {
                      $borrowstatus = 'Late';
                  } else {
                      $borrowstatus = 'Borrowed';
                  }
                  break;
                case 3:
                  $borrowstatus = 'Not available';
                  break;
                default:
                  $borrowstatus = 'Not available';
              }

                $form = (object)[
                  'name'         => $value->item,
                  'description'  => $value->description,
                  'code'         => $value->code,
                  'cost'         => $value->cost,
                  'condition'    => $value->condition,
                  'cat'          => $value->cat,
                  'brand'        => $value->brand,
                  'model'        => $value->model,
                  'mat'          => $value->mat,
                  'locat'        => $value->locat,
                  'depat'        => $value->depat,
                  'nameuser'     => $value->nameuser,
                  'owner'        => $value->owner,
                  'borrowstatus' => $borrowstatus,
                  'status'       => $value->status
                ];
            }//end foreach
        }//end if

        echo json_encode($form);
    }//end showDetailItem()


    /**
     * This function is use to load view export file  from item into excel
     * @return void
     */
    public function export()
    {
        $this->load->view('items/export');
    }//end export()


    /**
     * This function is use to get the name of user that borrow as "Borrower" an item by id
     * @return void
     */
    public function borrowerName()
    {
        $borrower = $this->items_model->showUser();
        echo json_encode($borrower);
    }//end borrowerName()


    /**
     * Use to show form borrow an item when click on borrow icon
     * @return void
     */
    public function borrower()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['activeLink'] = 'items';
        $data['title']      = 'Borrow an item';
        $id = $this->uri->segment(3);
        $data['borrow'] = $this->items_model->showListBorrower($id);
        // var_dump($data['borrow']);die();
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/borrow', $data);
        $this->load->view('templates/footer');
    }//end borrower()


    /**
     * Use for insert data that user borrow an item into borrower table in database
     * @return void
     */
    public function insertBorrower()
    {
        $borrower   = $this->input->post('nameBorrower');
        $item       = $this->input->post('itemName');
        $startDate  = $this->input->post('startDate');
        $returnDate = $this->input->post('returnDate');

        $insertBorrowItem = $this->items_model->insertBorrow($borrower, $item, $startDate, $returnDate);
        // var_dump($insertBorrowItem);die();
        if ($insertBorrowItem) {
            redirect('items');
        } else {
            echo "error";
        }
    }//end insertBorrower()


    /**
     * This function is use to show form return an item when click on return icon
     * @return void
     */
    public function returnItem()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['activeLink'] = 'items';
        $data['title']      = 'Return an item';
        $id = $this->uri->segment(3);
        $data['borrow'] = $this->items_model->showListBorrower($id);
        $data['r_item'] = $this->items_model->returnitem($id);
        // var_dump($data['r_item']);die();
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/returnItem', $data);
        //is use to load view to return an item form
        $this->load->view('templates/footer');
    }//end returnItem()


    /**
     * Function use to return an item and to update borrowstatus
     * in database and list item borrowstatus
     * @return void
     */
    public function returnAnItem()
    {
        $data['startDate']  = $this->input->post('startDate');
        $data['actualDate'] = $this->input->post('actualDate');
        $data['itemId']     = $this->input->post('itemId');
        $maxIdBorrow        = $this->items_model->getMaxIdBorrow($this->input->post('itemId'));
        //use to get max id of borrower
        $data['maxIdBorrow'] = $maxIdBorrow[0]->maxIdBorrow;
        //var_dump($data);die();
        $borrowstatus_update = $this->items_model->r_u_borrowstatus($data);
        //load model for update borrowstatus in database and table
        // var_dump($borrowstatus_update);die();

        // validate update borrowstatus in database table item column borrowstatus
        if ($borrowstatus_update) {
            redirect('items');
        // echo "updated borrowstatus...";
        } else {
            echo "Error...";
        }
    }//end returnAnItem()


    /**
     * Condition to make late borrowstatus if the borrower return later
     * than the day they expected to return materail that borrowed
     * @return void
     */
    public function returnLate()
    {
        $lateIds = $this->items_model->returnLate();
        //print_r($lateIds);
        foreach ($lateIds as $value) {
            $this->items_model->updateBorrowstatus($value->itemBorrow);
            //load model update borrowstatus late
        }
    }//end returnLate()
}//end class
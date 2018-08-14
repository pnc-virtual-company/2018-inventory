<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the items management pages and tools.
 */
class Items extends CI_Controller
{
    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('connection_model');
        if (!$this->connection_model->isConnected()) {
            redirect('connection/login');
        }
        log_message('debug', 'URI='.$this->uri->uri_string());
        $this->load->model('items_model');
    }

    /**
     * Display the list of all items
     * @return void
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
    }

    /**
     * Return a JSON string containing all the items
     * in a format suitable for JQuery DataTable widget
     * @return void
     */
    public function showAllitems()
    {
        $items = array("data" => $this->items_model->showAllItems());
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($items));
    }

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
    }

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
        $this->items_model->updateLabel($id);
        if ($item_update) {
            $this->session->set_flashdata('msg', 'The item was updated successfully.');
            redirect('items');
        }
    }


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
    }


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
            $code = $locnamebyid.'-'.$getIdMax;
        }

        // This varible is use to get data from form to insert into database and show on table
        $item_insert = $this->items_model->add_item($nameitem, $desitem, $catitem, $matitem, $depitem, $locitem, $moditem, $useritem, $ownitem, $conditionitem, $dateitem, $costitem, $code);
        $this->items_model->updateLabel($item_insert);
        $this->session->set_flashdata('msg', 'The item was created successfully.(' . $item_insert . ')');
        redirect('items');
    }

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
    }


    /**
     * This function is use to load view export file  from item into excel
     * @return void
     */
    public function export()
    {
        $this->load->view('items/export');
    }


    /**
     * This function is use to get the name of user that borrow as "Borrower" an item by id
     * @return void
     */
    public function borrowerName()
    {
        $borrower = $this->items_model->showUser();
        echo json_encode($borrower);
    }


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
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/borrow', $data);
        $this->load->view('templates/footer');
    }

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
        if ($insertBorrowItem) {
            redirect('items');
        } else {
            echo "error";
        }
    }


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
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('items/returnItem', $data);
        //is use to load view to return an item form
        $this->load->view('templates/footer');
    }


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
        $borrowstatus_update = $this->items_model->r_u_borrowstatus($data);

        // validate update borrowstatus in database table item column borrowstatus
        if ($borrowstatus_update) {
            redirect('items');
        } else {
            echo "Error...";
        }
    }


    /**
     * Condition to make late borrowstatus if the borrower return later
     * than the day they expected to return materail that borrowed
     * @return void
     */
    public function returnLate()
    {
        $lateIds = $this->items_model->returnLate();
        foreach ($lateIds as $value) {
            $this->items_model->updateBorrowstatus($value->itemBorrow);
        }
    }
}

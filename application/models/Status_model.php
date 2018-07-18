<?php
/**
 * This model contains the business logic and manages the persistence of users and roles
 *
 * @copyright  Copyright (c) 2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Status_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }//end __construct()


    /**
     * This function is use for get all the data from status table to display
     * @return bool result
     */
    public function showAllStatus()
    {
        $query = $this->db->get('status');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }//end showAllStatus()


    /**
     * Function to get status for edit in modal form
     * @param  int $id id
     * @return bool     result
     */
    public function showEditStatus($id)
    {
        $this->db->where('idstatus', $id);
        $query = $this->db->get('status');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }//end showEditStatus()


    /**
     * Function to delete status from database and agurment $id get
     * from controller to compare with id in database
     * @param  int $id id
     * @return void
     */
    public function deleteStatus($id)
    {
        $this->db->where('idstatus', $id);
        $this->db->delete('status');
    }//end deleteStatus()


    /**
     * Function for insert data that enter by admin into database in table status
     * and argument $data get from controller that store the info form user that input into modal form
     * @param  mixed $data data
     * @return int       id of inserted data
     */
    public function create_status($data)
    {
        $this->db->insert('status', $data);
        return $insert_id = $this->db->insert_id();
    }//end create_status()


    /**
     * Use for update status that get value from form input to upddate in database
     * @param  int $idstatus idstatus
     * @param  mixed $status status
     * @return mixed         result
     */
    public function updateStatus($idstatus, $status)
    {
        $data = [
            'idstatus' => $idstatus,
            'status'   => $status,
        ];
        $this->db->where('idstatus', $idstatus);
        return $this->db->replace('status', $data);
    }//end updateStatus()
}//end class

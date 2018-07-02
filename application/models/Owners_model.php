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
    exit('No direct script access allowed'); }

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Owners_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();

    }//end __construct()


    /**
     * This function is use for get all the data from owner table to display
     * @return bool result
     */
    public function showAllOwner()
    {
        $query = $this->db->get('owner');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showAllOwner()


    /**
     * Function to get owner for edit in modal form
     * @param  int $id id
     * @return bool     result
     */
    public function showEditOwner($id)
    {
        $this->db->where('idowner', $id);
        $query = $this->db->get('owner');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditOwner()


    /**
     * Function to delete owner from database and agurment $id get
     * from controller to compare with id in database
     * @param  int $id id
     * @return void
     */
    public function deleteOwner($id)
    {
        $this->db->where('idowner', $id);
        $this->db->delete('owner');

    }//end deleteOwner()


    /**
     * Function for insert data that enter by admin into database in table owner
     * and argument $data get from controller that store the info form user that input into modal form
     * @param  any $data data
     * @return int       id of inserted data
     */
    public function create_owner($data)
    {
        $this->db->insert('owner', $data);
        return $insert_id = $this->db->insert_id();

    }//end create_owner()


    /**
     * Use for update owner that get value from form input to upddate in database
     * @param  int $idowner idowner
     * @param  any $owner   owner
     * @return any          result
     */
    public function updateOwner($idowner, $owner)
    {
        $data = [
            'idowner' => $idowner,
            'owner'   => $owner,
        ];
        $this->db->where('idowner', $idowner);
        return $this->db->replace('owner', $data);

    }//end updateOwner()


}//end class

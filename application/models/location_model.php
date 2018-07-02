<?php
// Edit by @author Sinat NEAM <sinat.neam@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Location_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();

    }//end __construct()


    /**
     * Show all location from database
     * @return bool result
     */
    public function showAlllocat()
    {
        $query = $this->db->get('location');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showAlllocat()


    /**
     * Show edit localtion from database by id
     * @param  int $id id
     * @return bool    result
     */
    public function showEditlocation($id)
    {
        $this->db->where('idlocation', $id);
        $query = $this->db->get('location');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditlocation()


    /**
     * Delete location from database by id
     * @param  int $id id
     * @return void
     */
    public function deletelocat($id)
    {
        $this->db->where('idlocation', $id);
        $this->db->delete('location');

    }//end deletelocat()


    /**
     * Ceate location into database by $data
     * @param  any $data data
     * @return int       id of inserted data
     */
    public function create_location($data)
    {
        $this->db->insert('location', $data);
        return $insert_id = $this->db->insert_id();

    }//end create_location()


    /**
     * Update location into database by idlocation and location
     * @param  int $idlocation id location
     * @param  any $location   location
     * @return any             result
     */
    public function update($idlocation, $location)
    {
        $data = [
            'idlocation' => $idlocation,
            'location'   => $location,
        ];
        $this->db->where('idlocation', $idlocation);
        return $this->db->replace('location', $data);

    }//end update()


}//end class

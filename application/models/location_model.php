<?php
/**
 * This model contains the business logic and manages the persistence of users and roles
 * @copyright  Copyright (c) 2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */

if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class location_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
    }
    public function showAlllocat(){
        $query = $this->db->get('location');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    public function showEditlocation($id){
        $this->db->where('idlocation', $id);
        $query = $this->db->get('location');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    function deletelocat($id){
        $this->db->where('idlocation', $id);
        $this->db->delete('location');
    }


    public function create_location($data)
    {
        $this->db->insert('location', $data);
        return $insert_id = $this->db->insert_id();
    }

    public function update($idlocation, $location)
    {
        $data = array(
            'idlocation' => $idlocation,
            'location'  => $location
        );
        $this->db->where('idlocation',$idlocation);
        return $this->db->replace('location', $data);
        
    }
}

<?php
// Edit by @author Sinat NEAM <sinat.neam@student.passerellesnumeriques.org> 

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class location_model extends CI_Model
{
    
    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // Show all location from database
    public function showAlllocat()
    {
        $query = $this->db->get('location');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Show edit localtion from database by id
    public function showEditlocation($id)
    {
        $this->db->where('idlocation', $id);
        $query = $this->db->get('location');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Delete location from database by id
    function deletelocat($id)
    {
        $this->db->where('idlocation', $id);
        $this->db->delete('location');
    }
    
    // Ceate location into database by $data
    public function create_location($data)
    {
        $this->db->insert('location', $data);
        return $insert_id = $this->db->insert_id();
    }
    
    // Update location into database by idlocation and location
    public function update($idlocation, $location)
    {
        $data = array(
            'idlocation' => $idlocation,
            'location' => $location
        );
        $this->db->where('idlocation', $idlocation);
        return $this->db->replace('location', $data);
    }
}
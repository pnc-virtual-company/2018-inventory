<?php
// Edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org> 

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class model_department extends CI_Model
{
    
    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // Get data department from database
    public function showAllDepartments()
    {
        $query = $this->db->get('department');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Update department to database
    public function showEditDepartment($id)
    {
        $this->db->where('iddepartment', $id);
        $query = $this->db->get('department');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Delete department from database
    function deleteDepartment($id)
    {
        $this->db->where('iddepartment', $id);
        $this->db->delete('department');
    }
    
    // Create department to database 
    public function create_department($data)
    {
        $this->db->insert('department', $data);
        return $insert_id = $this->db->insert_id();
    }
    
    public function updateDepartment($iddepartment, $department)
    {
        $data = array(
            'iddepartment' => $iddepartment,
            'department' => $department
        );
        $this->db->where('iddepartment', $iddepartment);
        return $this->db->replace('department', $data);
    }
}
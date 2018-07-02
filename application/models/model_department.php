<?php
// Edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Model_department extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();

    }//end __construct()


    /**
     * Get data department from database
     * @return bool result
     */
    public function showAllDepartments()
    {
        $query = $this->db->get('department');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showAllDepartments()


    /**
     * Update department to database
     * @param  int $id id
     * @return bool    result
     */
    public function showEditDepartment($id)
    {
        $this->db->where('iddepartment', $id);
        $query = $this->db->get('department');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditDepartment()


    /**
     * Delete department from database
     * @param  int $id id
     * @return void
     */
    public function deleteDepartment($id)
    {
        $this->db->where('iddepartment', $id);
        $this->db->delete('department');

    }//end deleteDepartment()


    /**
     * Create department to database
     * @param  any $data data
     * @return int       id of inserted data
     */
    public function create_department($data)
    {
        $this->db->insert('department', $data);
        return $insert_id = $this->db->insert_id();

    }//end create_department()


    /**
     * Use for update department that get value from form input to upddate in database
     * @param  int $iddepartment id department
     * @param  any $department   department
     * @return any               result
     */
    public function updateDepartment($iddepartment, $department)
    {
        $data = [
            'iddepartment' => $iddepartment,
            'department'   => $department,
        ];
        $this->db->where('iddepartment', $iddepartment);
        return $this->db->replace('department', $data);

    }//end updateDepartment()


}//end class

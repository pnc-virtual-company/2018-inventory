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
class model_department extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
    }
    public function showAllDepartments(){
        $query = $this->db->get('department');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    public function showEditDepartment($id){
        $this->db->where('iddepartment', $id);
        $query = $this->db->get('department');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    function deleteDepartment($id){
        $this->db->where('iddepartment', $id);
        $this->db->delete('department');
    }


    public function create_department($data)
    {
        $this->db->insert('department', $data);
        return $insert_id = $this->db->insert_id();
    }

    public function updateDepartment($iddepartment, $department)
    {
        $data = array(
            'iddepartment' => $iddepartment,
            'department'  => $department
        );
        $this->db->where('iddepartment',$iddepartment);
        return $this->db->replace('department', $data);
        
    }
    
}

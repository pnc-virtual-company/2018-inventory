<?php 
	
	class department_model extends CI_Model {

	    /**
	     * Default constructor
	     */
	    public function __construct() {

	    }

	    /**
	     * Get the list of users or one user
	     * @param int $id optional id of one user
	     * @return array record of users
	     * @author Benjamin BALET <benjamin.balet@gmail.com>
	     */
	    public function getDepart($id = 0) {
	        $this->db->select('department.*');
	        if ($id === 0) { 
	            $query = $this->db->get('department');
	            return $query->result_array();
	        }
	        $query = $this->db->get_where('department', array('department.iddepartment' => $id));
	        return $query->row_array();
	    }

	    /**
	     * Get the list of users and their roles
	     * @return array record of users
	     * @author Benjamin BALET <benjamin.balet@gmail.com>
	     */
	    public function getDepartment() {
	        $this->db->select('department.iddepartment, department.department');
	        
	        $query = $this->db->get('department');
	        return $query->result();
	    }

	    /**
	     * Delete a category from the database
	     * @param int $id identifier of the category
	     * @author Benjamin BALET <benjamin.balet@gmail.com>
	     */
	    public function deleteCate($id) {
	        $this->db->delete('department', array('department.iddepartment' => $id));
	    }

	}
 ?>
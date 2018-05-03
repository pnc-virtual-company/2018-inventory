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
class category_model extends CI_Model {

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
    public function getCate($id = 0) {
        $this->db->select('category.*');
        if ($id === 0) { 
            $query = $this->db->get('category');
            return $query->result_array();
        }
        $query = $this->db->get_where('category', array('category.idcategory' => $id));
        return $query->row_array();
    }

    /**
     * Get the list of users and their roles
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getCateInfo() {
        $this->db->select('category.idcategory, category.category');
        
        $query = $this->db->get('category');
        return $query->result();
    }

 

    /**
     * Delete a category from the database
     * @param int $id identifier of the category
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function deleteCate($id) {
        $this->db->delete('category', array('category.idcategory' => $id));
    }

    
    /**
     * Insert a new category into the database. Inserted data are coming from an HTML form
     * @return string deciphered password (so as to send it by e-mail in clear)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function insertCate() {
      
        // $catego.ry = $this->input->post('createCategory');

        $data = array(
            'category' => $this->input->post('createCategory'),
        
        );
        $category = $this->db->insert('category', $data);
        if ($this->db->affected_rows()>0) {
            return true;
        }else{
            return false;
        }
    }


    /**
     * Update a given user in the database. Update data are coming from an HTML form
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function updatecate() {
            $data = array(
            'category' => $this->input->post('createCategory'),
            
        );
        $this->db->where('idcategory', $this->input->post('id'));
        $this->db->update('category', $data);
        if ($this->db->affected_rows()>0) {
            return true;
        }else{
            return false;
        }
    }

    
}

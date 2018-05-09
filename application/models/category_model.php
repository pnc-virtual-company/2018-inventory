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

     *     
     * Default constructor
     */
    public function __construct() {
        parent ::__construct();
    }
    // Model select category
    public function getAllCate()
    {  
        $query = $this->db->get('category');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
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

    public function create_category($data)
    {
        $this->db->insert('category', $data);
        return $insert_id = $this->db->insert_id();
    }

    /**
     * Update a given category in the database. Update data are coming from an HTML form
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
   public function showEditCategory($id){
        $this->db->where('idcategory', $id);
        $query = $this->db->get('category');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
       }

       public function updateCategory($idcategory, $category)
       {
        $data = array(
            'idcategory' => $idcategory,
            'category'  => $category
        );
        $this->db->where('idcategory',$idcategory);
        return $this->db->replace('category', $data);
        
       }
    
    //delete category 
    function deleteCategory($id){
        $this->db->where('idcategory', $id);
        $this->db->delete('category');
    } 
}

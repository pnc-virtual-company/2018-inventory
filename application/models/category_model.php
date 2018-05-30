<?php
// edit by @author Bunla Rath <bunla.rath@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class category_model extends CI_Model
{
    
    /**
     *     
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // Get category from database
    public function getAllCate()
    {
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    /**
     * Delete a category from the database
     */
    public function deleteCate($id)
    {
        $this->db->delete('category', array(
            'category.idcategory' => $id
        ));
    }
    
    // Create category to database
    public function create_category($data)
    {
        $this->db->insert('category', $data);
        return $insert_id = $this->db->insert_id();
    }
    
    // Display show edit category to controller
    public function showEditCategory($id)
    {
        $this->db->where('idcategory', $id);
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Update data from pop up modal to database
    public function updateCategory($idcategory, $category)
    {
        $data = array(
            'idcategory' => $idcategory,
            'category' => $category
        );
        $this->db->where('idcategory', $idcategory);
        return $this->db->replace('category', $data);
    }
    
    //delete category from database
    function deleteCategory($id)
    {
        $this->db->where('idcategory', $id);
        $this->db->delete('category');
    }
}
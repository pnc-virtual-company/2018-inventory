<?php
// edit by @author Bunla Rath <bunla.rath@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Category_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();

    }//end __construct()


    /**
     * Get category from database
     * @return bool result
     */
    public function getAllCate()
    {
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllCate()


    //
    // /**
    //  * Delete category from database
    //  * @param  int $id id
    //  * @return void
    //  */
    // public function deleteCate($id)
    // {
    //     $this->db->delete(
    //         'category',
    //         ['category.idcategory' => $id]
    //     );
    //
    // }//end deleteCate()


    /**
     * Create category to database
     * @param  any $data data
     * @return int       id of inserted data
     */
    public function create_category($data)
    {
        $this->db->insert('category', $data);
        return $insert_id = $this->db->insert_id();

    }//end create_category()


    /**
     * Display show edit category to controller
     * @param  int $id id
     * @return bool    result
     */
    public function showEditCategory($id)
    {
        $this->db->where('idcategory', $id);
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditCategory()


    /**
     * Update data from pop up modal to database
     * @param  int $idcategory id category
     * @param  any $category   category
     * @return any             result
     */
    public function updateCategory($idcategory, $category)
    {
        $data = [
            'idcategory' => $idcategory,
            'category'   => $category,
        ];
        $this->db->where('idcategory', $idcategory);
        return $this->db->replace('category', $data);

    }//end updateCategory()


    /**
     * Delete category from database
     * @param  int $id id
     * @return void
     */
    public function deleteCategory($id)
    {
        $this->db->where('idcategory', $id);
        $this->db->delete('category');

    }//end deleteCategory()


}//end class

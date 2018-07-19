<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of categories
 */
class Category_model extends CI_Model
{
    /**
     * Get categories from database
     * @return array list of categories or null
     */
    public function getAll()
    {
        $query = $this->db->get('category');
        return $query->result();
    }

    /**
     * Create a new category into the database
     * @param string $categoryName category name
     * @param string $categoryAcronym category acronym
     * @return int id of last inserted data
     */
    public function create($categoryName, $categoryAcronym = "")
    {
        $data = [
            'category'   => $categoryName,
            'acronym'   => $categoryAcronym,
        ];
        $this->db->insert('category', $data);
        return $this->db->insert_id();
    }

    /**
     * Load a given category from database
     * @param int $id id of category
     * @return array category record or null
     */
    public function get($categoryId)
    {
        $this->db->where('idcategory', $categoryId);
        $query = $this->db->get('category');
        return $query->row();
    }

    /**
     * Update a category into the database
     * @param int $categoryId id category
     * @param string $categoryName category name
     * @param string $categoryAcronym category acronym
     * @return int number of affected rows
     */
    public function update($categoryId, $categoryName, $categoryAcronym = "")
    {
        $data = [
            'idcategory' => $categoryId,
            'category'   => $categoryName,
            'acronym'   => $categoryAcronym,
        ];
        $this->db->where('idcategory', $categoryId);
        return $this->db->replace('category', $data);
    }

    /**
     * Delete a category from database
     * @param  int $categoryId id of the category
     */
    public function delete($categoryId)
    {
        $this->db->where('idcategory', $categoryId);
        $this->db->delete('category');
    }
}

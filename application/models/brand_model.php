<?php

class brand_model extends CI_Model
{
    
    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // Display all data in brand from database
    public function showAllBrand()
    {
        $this->db->select('idbrand, brand, count(skeleton_model.idmodel) AS "ModelCount" ');
        $this->db->from('brand');
        $this->db->join('model', 'model.brandid = brand.idbrand', 'left');
        $this->db->group_by('skeleton_brand.brand');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Create brand into database by $data
    public function create_brand($data)
    {
        $this->db->insert('brand', $data);
        return $insert_id = $this->db->insert_id();
    }
    
    // Delete brand into database by $id
    function deleteBrand($id)
    {
        $this->db->where('idbrand', $id);
        $this->db->delete('brand');
    }
    
    // Display edit brand from database by $id
    public function showEditBrand($id)
    {
        $this->db->where('idbrand', $id);
        $query = $this->db->get('brand');
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Update brand into database by $idbrand and $brand
    public function updateBrand($idbrand, $brand)
    {
        $data = array(
            'idbrand' => $idbrand,
            'brand' => $brand
        );
        $this->db->where('idbrand', $idbrand);
        return $this->db->replace('brand', $data);
    }    
}
?>
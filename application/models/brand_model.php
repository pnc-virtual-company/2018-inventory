<?php

class Brand_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();

    }//end __construct()


    /**
     * Display all data in brand from database
     * @return bool result
     */
    public function showAllBrand()
    {
        $this->db->select('idbrand, brand, count(model.idmodel) AS "ModelCount" ');
        $this->db->from('brand');
        $this->db->join('model', 'model.brandid = brand.idbrand', 'left');
        $this->db->group_by('brand.brand');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showAllBrand()


    /**
     * Create brand into database by $data
     * @param  any $data data
     * @return int       id of inserted data
     */
    public function create_brand($data)
    {
        $this->db->insert('brand', $data);
        return $insert_id = $this->db->insert_id();

    }//end create_brand()


    /**
     * Delete brand into database by $id
     * @param  int $id id
     * @return void
     */
    public function deleteBrand($id)
    {
        $this->db->where('idbrand', $id);
        $this->db->delete('brand');

    }//end deleteBrand()


    /**
     * Display edit brand from database by $id
     * @param  int $id id
     * @return bool    result
     */
    public function showEditBrand($id)
    {
        $this->db->where('idbrand', $id);
        $query = $this->db->get('brand');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditBrand()


    /**
     * Update brand into database by $idbrand and $brand
     * @param  int $idbrand id brand
     * @param  any $brand   brand
     * @return any          result
     */
    public function updateBrand($idbrand, $brand)
    {
        $data = [
            'idbrand' => $idbrand,
            'brand'   => $brand,
        ];
        $this->db->where('idbrand', $idbrand);
        return $this->db->replace('brand', $data);

    }//end updateBrand()


}//end class

<?php
// edit by @author Bunla Rath <bunla.rath@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Materials_model extends CI_Model
{


    /**
     * Get all material from database
     * @return bool result
     */
    public function showAllmaterial()
    {
        $query = $this->db->get('material');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showAllmaterial()


    /**
     * Insert material into database
     * @param  any $data data
     * @return int       id of inserted data
     */
    public function create_material($data)
    {
        $this->db->insert('material', $data);
        return $insert_id = $this->db->insert_id();

    }//end create_material()


    /**
     * Delete material from database by id
     * @param  int $id id
     * @return void
     */
    public function deleteMaterial($id)
    {
        $this->db->where('idmaterial', $id);
        $this->db->delete('material');

    }//end deleteMaterial()


    /**
     * Show edit material from database by id
     * @param  int $id id
     * @return bool    result
     */
    public function showEditMaterial($id)
    {
        $this->db->where('idmaterial', $id);
        $query = $this->db->get('material');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditMaterial()


    /**
     * Update material from database by idmaterial and material
     * @param  int $idmaterial id material
     * @param  any $material   material
     * @return any             result
     */
    public function updateMaterial($idmaterial, $material)
    {
        $data = [
            'idmaterial' => $idmaterial,
            'material'   => $material,
        ];
        $this->db->where('idmaterial', $idmaterial);
        return $this->db->replace('material', $data);

    }//end updateMaterial()


}//end class

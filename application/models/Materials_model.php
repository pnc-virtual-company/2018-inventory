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
    
    // Get all material from database
    public function showAllmaterial()
    {
        $query = $this->db->get('material');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Insert material into database
    public function create_material($data)
    {
        $this->db->insert('material', $data);
        return $insert_id = $this->db->insert_id();
    }
    
    // Delete material from database by id
    function deleteMaterial($id)
    {
        $this->db->where('idmaterial', $id);
        $this->db->delete('material');
    }
    
    // Show edit material from database by id
    public function showEditMaterial($id)
    {
        $this->db->where('idmaterial', $id);
        $query = $this->db->get('material');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Update material from database by idmaterial and material
    public function updateMaterial($idmaterial, $material)
    {
        $data = array(
            'idmaterial' => $idmaterial,
            'material' => $material
        );
        $this->db->where('idmaterial', $idmaterial);
        return $this->db->replace('material', $data);
    }
}
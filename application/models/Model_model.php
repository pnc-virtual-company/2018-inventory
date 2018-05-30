<?php
// Edit by @author Sinat Neam <sinat.neam@student.passerellesnumeriques.org> 

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class model_model extends CI_Model
{
    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // Get brand from database by $id
    public function getBrandById($id)
    {
        $this->db->where('idbrand', $id);
        $query = $this->db->get('brand');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Get all model brand in database by idbrand
    public function showAllModelsByBrandId($idbrand)
    {
        $this->db->where('brandid', $idbrand);
        $query = $this->db->get('model');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Edit model into database by $id
    public function showEditModel($id)
    {
        $this->db->where('idmodel', $id);
        $query = $this->db->get('model');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    // Delete model into database by $id
    function deleteModel($id)
    {
        $this->db->where('idmodel', $id);
        $this->db->delete('model');
    }
    
    // Create model from database by $data
    public function create_model($data)
    {
        $this->db->insert('model', $data);
        return $insert_id = $this->db->insert_id();
    }
    
    // Update data model into database by $idmodel, $model and $brandid
    public function updateModel($idmodel, $model, $brandid)
    {
        $data = array(
            'idmodel' => $idmodel,
            'model' => $model,
            'brandid' => $brandid
        );
        $this->db->where('idmodel', $idmodel);
        return $this->db->replace('model', $data);
    }
}
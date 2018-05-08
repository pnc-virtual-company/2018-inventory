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
class model_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
    }
    public function getBrandById($id){
        $this->db->where('idbrand',$id);
        $query = $this->db->get('brand');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function showAllModelsByBrandId($idbrand){
        $this->db->where('brandid', $idbrand);
        $query = $this->db->get('model');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    public function showEditModel($id){
        $this->db->where('idmodel', $id);
        $query = $this->db->get('model');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    function deleteModel($id){
        $this->db->where('idmodel', $id);
        $this->db->delete('model');
    }


    public function create_model($data)
    {
        $this->db->insert('model', $data);
        return $insert_id = $this->db->insert_id();
    }

    public function updateModel($idmodel, $model,$brandid)
    {
        $data = array(
            'idmodel' => $idmodel,
            'model'  => $model,
            'brandid'  => $brandid
        );
        $this->db->where('idmodel',$idmodel);
        return $this->db->replace('model', $data);
    }
}

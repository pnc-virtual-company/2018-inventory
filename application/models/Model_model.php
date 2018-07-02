<?php
// Edit by @author Sinat Neam <sinat.neam@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Model_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();

    }//end __construct()


    /**
     * Get brand from database by $id
     * @param  int $id id
     * @return bool    result
     */
    public function getBrandById($id)
    {
        $this->db->where('idbrand', $id);
        $query = $this->db->get('brand');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getBrandById()


    /**
     * Get all model brand in database by idbrand
     * @param  int $idbrand id brand
     * @return bool         result
     */
    public function showAllModelsByBrandId($idbrand)
    {
        $this->db->where('brandid', $idbrand);
        $query = $this->db->get('model');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showAllModelsByBrandId()


    /**
     * Edit model into database by $id
     * @param  int $id id
     * @return bool     result
     */
    public function showEditModel($id)
    {
        $this->db->where('idmodel', $id);
        $query = $this->db->get('model');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditModel()


    /**
     * Delete model into database by $id
     * @param  int $id id
     * @return void
     */
    public function deleteModel($id)
    {
        $this->db->where('idmodel', $id);
        $this->db->delete('model');

    }//end deleteModel()


    /**
     * Create model from database by $data
     * @param  any $data data
     * @return int       id of inserted data
     */
    public function create_model($data)
    {
        $this->db->insert('model', $data);
        return $insert_id = $this->db->insert_id();

    }//end create_model()


    /**
     * Update data model into database by $idmodel, $model and $brandid
     * @param  int $idmodel id model
     * @param  any $model   model
     * @param  int $brandid brandid
     * @return any          result
     */
    public function updateModel($idmodel, $model, $brandid)
    {
        $data = [
            'idmodel' => $idmodel,
            'model'   => $model,
            'brandid' => $brandid,
        ];
        $this->db->where('idmodel', $idmodel);
        return $this->db->replace('model', $data);

    }//end updateModel()


}//end class

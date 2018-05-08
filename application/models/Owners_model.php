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
class Owners_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
    	parent::__construct();
    }
    public function showAllOwner(){
    	$query = $this->db->get('owner');
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return false;
    	}
    }


    public function showEditOwner($id){
    	$this->db->where('idowner', $id);
    	$query = $this->db->get('owner');
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return false;
    	}
    }


    function deleteOwner($id){
    	$this->db->where('idowner', $id);
    	$this->db->delete('owner');
    }


    public function create_owner($data)
    {
    	$this->db->insert('owner', $data);
    	return $insert_id = $this->db->insert_id();
    }

    public function updateOwner($idowner, $owner)
    {
    	$data = array(
    		'idowner' => $idowner,
    		'owner'  => $owner
    	);
    	$this->db->where('idowner',$idowner);
    	return $this->db->replace('owner', $data);
    	
    }
    
}

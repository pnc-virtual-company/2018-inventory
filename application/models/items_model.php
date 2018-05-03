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
class items_model extends CI_Model {
    /**
     * Default constructor
     */
    public function __construct() {
    }

    /**
     * Get the list of users or one user
     * @param int $id optional id of one user
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getItems($id = 0) {
        $this->db->select('item.*');
        if ($id === 0) {
            $query = $this->db->get('item');
            return $query->result_array();
        }
        $query = $this->db->get_where('item', array('item.iditem' => $id));
        return $query->row_array();
    }
    /**
     * Get the list of users and their roles
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function itemInfo() {
        $this->db->select('CONV(100, 10, 36) AS "itemid", item.item, category.category, condition, material.material, department.department , location.location , users.firstname AS "nameuser", owner.owner');
        $this->db->join('category', 'category.idcategory = item.categoryid');    
        $this->db->join('material', 'material.idmaterial = item.materialid');    
        $this->db->join('department', 'department.iddepartment = item.departmentid');    
        $this->db->join('location', 'location.idlocation = item.locationid');    
        $this->db->join('users', 'users.id = item.userid');    
        $this->db->join('owner', 'owner.idowner = item.ownerid'); 
        $query = $this->db->get('item');
        return $query->result_array();
    }

    /**
     * Delete a user from the database
     * @param int $id identifier of the user
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function deleteUser($id) {
        $this->db->delete('users', array('id' => $id));
    }
    /**
     * Update a given user in the database. Update data are coming from an HTML form
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function updateUsers() {
        //Role field is a binary mask
        $role = 0;
        foreach($this->input->post("role") as $role_bit){
            $role = $role | $role_bit;
        }
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'login' => $this->input->post('login'),
            'email' => $this->input->post('email'),
            'role' => $role
        );
        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('users', $data);
        return $result;
    }

}

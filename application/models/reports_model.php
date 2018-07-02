<?php
/**
 * This model contains the business logic and manages the persistence of users and roles
 *
 * @copyright  Copyright (c) 2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed'); }

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Reports_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {

    }//end __construct()


    /**
     * Get the list of users or one user
     *
     * @param int $id optional id of one user
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */

    // // model to get the report from
    // public function getReport($id = 0)
    // {
    //     $this->db->select('item.*');
    //     if ($id === 0) {
    //         $query = $this->db->get('item');
    //         return $query->result_array();
    //     }
    //     $query = $this->db->get_where('item', array('item.iditem' => $id));
    //     return $query->row_array();
    // }

    /**
     * Get the list of users and their roles
     *
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */


    /**
     * Model to count all the condition New from table item
     * @return bool true if succed
     */
    public function getCountNew()
    {
        $this->db->select("COUNT(item.condition) AS countNew");
        $countQuery = $this->db->get_where('item', ['item.condition' => 'New']);
        return $countQuery->result();

    }//end getCountNew()


    /**
     * Model to count all the condition Fair from table item
     * @return bool true if succed
     */
    public function getCountFair()
    {
        $this->db->select("COUNT(item.condition) AS countFair");
        $countQuery = $this->db->get_where('item', ['item.condition' => 'Fair']);
        return $countQuery->result();

    }//end getCountFair()


    /**
     * Model to count all the condition Danaged from table item
     * @return bool true if succed
     */
    public function getCountDamaged()
    {
        $this->db->select("COUNT(item.condition) AS countDamaged");
        $countQuery = $this->db->get_where('item', ['item.condition' => 'Damaged']);
        return $countQuery->result();

    }//end getCountDamaged()


    /**
     * Model to count all the condition Broken from table item
     * @return bool TRUE if succed
     */
    public function getCountBroken()
    {
        $this->db->select("COUNT(item.condition) AS countBroken");
        $countQuery = $this->db->get_where('item', ['item.condition' => 'Broken']);
        return $countQuery->result();

    }//end getCountBroken()


    /**
     * This function is to get all the item that have relationship with the department
     * @return array items of a department
     */
    public function getItemByDepartment()
    {
        $this->db->select('department.department, COUNT(item.iditem) AS itemcount');
        $this->db->join('item', 'department.iddepartment=item.departmentid', 'left');
        $this->db->group_by(["department.iddepartment"]);
        $query = $this->db->get('department');
        return $query->result();

    }//end getItemByDepartment()


}//end class

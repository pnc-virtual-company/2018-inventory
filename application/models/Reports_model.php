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
    exit('No direct script access allowed');
}

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
     * get number of items by condition
     * @return mixed count items
     */
    public function getCountCondition()
    {

      // 'SELECT i.condition, count(i.condition) as count FROM `item` i WHERE 1 GROUP BY i.condition'
        $this->db->select('item.condition as key, count(item.condition) as count');
        $this->db->group_by("item.condition");
        $query = $this->db->get('item');
        return $query->result();
    }

    /**
     * get number of items by category
     * @return mixed count items
     */
    public function getItemCountByCategory()
    {
        $this->db->select('category.category as key, COUNT(item.iditem) AS count');
        $this->db->join('item', 'category.idcategory=item.categoryid', 'left');
        $this->db->group_by(["category.idcategory"]);
        $query = $this->db->get('category');
        return $query->result();
    }

    /**
     * get number of items by material
     * @return mixed count items
     */
    public function getItemCountByMaterial()
    {
        $this->db->select('material.material as key, COUNT(item.iditem) AS count');
        $this->db->join('item', 'material.idmaterial=item.materialid', 'left');
        $this->db->group_by(["material.idmaterial"]);
        $query = $this->db->get('material');
        return $query->result();
    }

    /**
     * get number of items by department
     * @return mixed count items
     */
    public function getItemCountByDepartment()
    {
        $this->db->select('department.department as key, COUNT(item.iditem) AS count');
        $this->db->join('item', 'department.iddepartment=item.departmentid', 'left');
        $this->db->group_by(["department.iddepartment"]);
        $query = $this->db->get('department');
        return $query->result();
    }

    /**
     * get number of items by brand
     * @return mixed count items
     */
    public function getItemCountByBrand()
    {
        $this->db->select('brand.brand as key, COUNT(item.iditem) AS count');
        $this->db->join('model', 'brand.idbrand=model.brandid', 'left');
        $this->db->join('item', 'model.idmodel=item.modelid', 'left');
        $this->db->group_by(["brand.idbrand"]);
        $query = $this->db->get('brand');
        return $query->result();
    }

    /**
     * get number of items by location
     * @return mixed count items
     */
    public function getItemCountByLocation()
    {
        $this->db->select('location.location as key, COUNT(item.iditem) AS count');
        $this->db->join('item', 'location.idlocation=item.locationid', 'left');
        $this->db->group_by(["location.idlocation"]);
        $query = $this->db->get('location');
        return $query->result();
    }

    /**
     * get number of items by owner
     * @return mixed count items
     */
    public function getItemCountByOwner()
    {
        $this->db->select('owner.owner as key, COUNT(item.iditem) AS count');
        $this->db->join('item', 'owner.idowner=item.ownerid', 'left');
        $this->db->group_by(["owner.idowner"]);
        $query = $this->db->get('owner');
        return $query->result();
    }

    /**
     * get number of items by status
     * @return mixed count items
     */
    public function getItemCountByStatus()
    {
        $this->db->select('status.status as key, COUNT(item.iditem) AS count');
        $this->db->join('item', 'status.idstatus=item.statusid', 'left');
        $this->db->group_by(["status.idstatus"]);
        $query = $this->db->get('status');
        return $query->result();
    }

    /**
     * This function is to get all the item that have relationship with the department
     * @return array items of a department
     */
    public function getItemByDepartment()
    {
        $this->db->select('department.departmentn as key, COUNT(item.iditem) AS count');
        $this->db->join('item', 'department.iddepartment=item.departmentid', 'left');
        $this->db->group_by(["department.iddepartment"]);
        $query = $this->db->get('department');
        return $query->result();
    }//end getItemByDepartment()
}//end class

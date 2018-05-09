

<?php
/**
 * This model contains the business logic and manages the persistence of users and roles
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
    public function showAllItems(){
        // $query = $this->db->get('material');

        $this->db->select('CONV(skeleton_item.iditem, 10, 36) AS "itemcodeid",item.iditem, item.item, category.category AS "cat", condition as "condition", material.material as "mat", department.department as "depat" , location.location as "locat", users.firstname AS "nameuser", owner.owner as "owner"');
        $this->db->join('category', 'category.idcategory = item.categoryid');    
        $this->db->join('material', 'material.idmaterial = item.materialid');    
        $this->db->join('department', 'department.iddepartment = item.departmentid');    
        $this->db->join('location', 'location.idlocation = item.locationid');    
        $this->db->join('users', 'users.id = item.userid');    
        $this->db->join('owner', 'owner.idowner = item.ownerid'); 
        $query = $this->db->get('item');

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
     public function deleteItems($id){
        $this->db->where('iditem', $id);
        $this->db->delete('item');
    }



}

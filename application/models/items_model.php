

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

    // Model select category
    public function getAllCate()
    {  
        $query = $this->db->get('category');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }

    // Model select material
    public function getAllMat()
    {  
        $query = $this->db->get('material');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }

    // Model select department
    public function getAllDep()
    {  
        $query = $this->db->get('department');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }

    // Model select location
    public function getAllLoc()
    {  
        $query = $this->db->get('location');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }

    // Model select user
    public function getAllUser()
    {  
        $query = $this->db->get('users');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }

    // Model select owner
    public function getAllOwner()
    {  
        $query = $this->db->get('owner');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }


    // Model select brand
    public function getAllBrand()
    {  
        $query = $this->db->get('brand');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }


    // Model select model
    public function getAllModel($id)
    {  
        $this->db->where('brandid', $id);
        $query = $this->db->get('model');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }

    // get item maximum id with convert

    public function getmaxiditem(){
        $this->db->select('CONV(MAX(skeleton_item.iditem),10,36) AS "IdMax"');
        $query = $this->db->get('item');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }

    // get location by id

    public function getLocById($id)
    {  
        $this->db->where('idlocation',$id);
        $query = $this->db->get('location');  
        if($query->num_rows() > 0)
        {   
            return $query->result();  
        }else{   
            return false;  
        } 
    }


    //     // Insert item to database 
    public function add_item($nameitem,$desitem,$catitem,$matitem,$depitem,$locitem,$moditem,$useritem,$ownitem,$conditionitem,$dateitem,$costitem,$code)
    {
        
        $data = array(
            'item'=> $nameitem,
            'itemdescription'=> $desitem,
            'categoryid'=> $catitem,
            'materialid'=> $matitem,
            'departmentid'=> $depitem,
            'locationid'=> $locitem,
            'modelid'=> $moditem,
            'userid'=> $useritem,
            'ownerid'=> $ownitem,
            'condition'=> $conditionitem,
            'date'=> $dateitem,
            'itemcost'=> $costitem,
            'status'=> '0',
            'code'=> $code
        );

        return $query=$this->db->insert('item',$data);
    }

}

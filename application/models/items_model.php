<?php
/**
 * This model contains the business logic and manages the persistence of users and roles
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed'); }

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Items_model extends CI_Model
{

    /**
     * Get the list of users or one user
     *
     * @param int $id optional id of one user
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */


    /**
     * Controller when export an item into excel file
     * @param  integer $id id
     * @return any         result
     */
    public function getitems($id=0)
    {
        $this->db->select(
            'item.iditem,item.code, item.item, item.itemdescription AS "description",condition as "condition",  item.itemcost AS "cost", item.date AS "date", category.category AS ,"cat",location.location as "locat", users.firstname AS "nameuser",department.department as "depart",material.material as "mat",model.model as "model", owner.owner as "owner"
              '
        );
          $this->db->join('category', 'category.idcategory = item.categoryid', 'left');
          $this->db->join('material', 'material.idmaterial = item.materialid', 'left');
          $this->db->join('department', 'department.iddepartment = item.departmentid', 'left');
          $this->db->join('location', 'location.idlocation = item.locationid', 'left');
          $this->db->join('users', 'users.id = item.userid', 'left');
          $this->db->join('owner', 'owner.idowner = item.ownerid', 'left');
          $this->db->join('model', 'model.idmodel = item.modelid', 'left');
          $this->db->join('brand', 'model.brandid = brand.idbrand', 'left');

        if ($id === 0) {
            $query = $this->db->get('item');
            return $query->result_array();
        }

          $query = $this->db->get_where('item', ['item.iditem' => $id]);
          return $query->row_array();

    }//end getitems()


    /**
     * This is use to edit for the item
     * @param  int $id id
     * @return any     result
     */
    public function showEditItems($id)
    {
        $this->db->select('item.iditem, item.item, item.itemdescription AS "description", category.category AS "cat",category.idcategory AS "catid", condition as "condition", material.material as "mat",material.idmaterial as "matid", department.department as "depat" ,department.iddepartment as "depatid" ,location.location as "locat",location.idlocation as "locatid", users.firstname AS "nameuser",users.id AS "userid", owner.owner as "owner", owner.idowner as "ownerid" , model.model as "model", model.idmodel as "modelid" , brand.brand as "brand", brand.idbrand as "brandid" , item.itemcost AS "cost", item.date AS "date"');
        $this->db->join('category', 'category.idcategory = item.categoryid', 'left');
        $this->db->join('material', 'material.idmaterial = item.materialid', 'left');
        $this->db->join('department', 'department.iddepartment = item.departmentid', 'left');
        $this->db->join('location', 'location.idlocation = item.locationid', 'left');
        $this->db->join('users', 'users.id = item.userid', 'left');
        $this->db->join('owner', 'owner.idowner = item.ownerid', 'left');
        $this->db->join('model', 'model.idmodel = item.modelid', 'left');
        $this->db->join('brand', 'model.brandid = brand.idbrand', 'left');
        $this->db->where('item.iditem', $id);
        $query = $this->db->get('item');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showEditItems()


    /**
     * Select the item detail for show into modal
     * @param  int $id id
     * @return any     result
     */
    public function showDetailItem($id)
    {
        $this->db->select('item.iditem, item.item, item.itemdescription AS "description", category.category AS "cat",category.idcategory AS "catid", condition as "condition", material.material as "mat",material.idmaterial as "matid", department.department as "depat" ,department.iddepartment as "depatid" ,location.location as "locat",location.idlocation as "locatid", CONCAT(users.firstname," ",users.lastname) AS "nameuser",users.id AS "userid", owner.owner as "owner", owner.idowner as "ownerid" , model.model as "model", model.idmodel as "modelid" , brand.brand as "brand", brand.idbrand as "brandid" , item.itemcost AS "cost", item.date AS "date", item.code, status');
        $this->db->join('category', 'category.idcategory = item.categoryid', 'left');
        $this->db->join('material', 'material.idmaterial = item.materialid', 'left');
        $this->db->join('department', 'department.iddepartment = item.departmentid', 'left');
        $this->db->join('location', 'location.idlocation = item.locationid', 'left');
        $this->db->join('users', 'users.id = item.userid', 'left');
        $this->db->join('owner', 'owner.idowner = item.ownerid', 'left');
        $this->db->join('model', 'model.idmodel = item.modelid', 'left');
        $this->db->join('brand', 'model.brandid = brand.idbrand', 'left');
        $this->db->where('item.iditem', $id);
        $query = $this->db->get('item');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showDetailItem()


    /**
     * This function in model is use for select the data from database in table item to show list item
     * @return any result
     */
    public function showAllItems()
    {

        $this->db->select('CONV(item.iditem, 10, 36) AS "itemcodeid",item.iditem, item.item, category.category AS "cat", condition as "condition", material.material as "mat", department.department as "depat" , location.location as "locat", users.firstname AS "nameuser", owner.owner as "owner",status');
        $this->db->join('category', 'category.idcategory = item.categoryid', 'left');
        $this->db->join('material', 'material.idmaterial = item.materialid', 'left');
        $this->db->join('department', 'department.iddepartment = item.departmentid', 'left');
        $this->db->join('location', 'location.idlocation = item.locationid', 'left');
        $this->db->join('users', 'users.id = item.userid', 'left');
        $this->db->join('owner', 'owner.idowner = item.ownerid', 'left');
        $query = $this->db->get('item');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showAllItems()


    /**
     * This function is use to delete item from database
     * @param  int $id id
     * @return void
     */
    public function deleteItems($id)
    {
        $this->db->where('iditem', $id);
        $this->db->delete('item');

    }//end deleteItems()


    /**
     * Select all the category from database
     * @return any result
     */
    public function getAllCate()
    {
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllCate()


    /**
     * Model select material
     * @return any result
     */
    public function getAllMat()
    {
        $query = $this->db->get('material');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllMat()


    /**
     * Model select department
     * @return any result
     */
    public function getAllDep()
    {
        $query = $this->db->get('department');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllDep()


    /**
     * Model select location
     * @return any result
     */
    public function getAllLoc()
    {
        $query = $this->db->get('location');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllLoc()


    /**
     * Model select user
     * @return any result
     */
    public function getAllUser()
    {
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllUser()


    /**
     * Model select owner
     * @return any result
     */
    public function getAllOwner()
    {
        $query = $this->db->get('owner');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllOwner()


    /**
     * Model select brand
     * @return any result
     */
    public function getAllBrand()
    {
        $query = $this->db->get('brand');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllBrand()


    /**
     * Model select model by brand
     * @param  int $id id
     * @return any     result
     */
    public function getAllModel($id)
    {
        $this->db->where('brandid', $id);
        $query = $this->db->get('model');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getAllModel()


    /**
     * Get itemid maximum id with convert into Letter for create
     * @return any result
     */
    public function getmaxiditem()
    {
        $this->db->select('CONV(MAX(item.iditem),10,36) AS "IdMax"');
        $query = $this->db->get('item');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getmaxiditem()


    /**
     * Get item id with convert for update data
     * @param  int $id id
     * @return any     result
     */
    public function getiditem($id)
    {
        $this->db->select('CONV(item.iditem,10,36) AS "IdMax"');
        $this->db->where('item.iditem', $id);
        $query = $this->db->get('item');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getiditem()


    /**
     * Get location by id to show into list item
     * @param  int $id id
     * @return any     result
     */
    public function getLocById($id)
    {
        $this->db->where('idlocation', $id);
        $query = $this->db->get('location');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end getLocById()


    /**
     * Insert the data from form create an item into table item in database
     * @param  any $nameitem      name item
     * @param  any $desitem       des item
     * @param  any $catitem       cat item
     * @param  any $matitem       mat item
     * @param  any $depitem       dep item
     * @param  any $locitem       loc item
     * @param  any $moditem       mod item
     * @param  any $useritem      user item
     * @param  any $ownitem       own item
     * @param  any $conditionitem condition item
     * @param  any $dateitem      date item
     * @param  any $costitem      cost item
     * @param  any $code          code
     * @return any                result
     */
    public function add_item($nameitem, $desitem, $catitem, $matitem, $depitem, $locitem, $moditem, $useritem, $ownitem, $conditionitem, $dateitem, $costitem, $code)
    {
        $data = [
            'item'            => $nameitem,
            'itemdescription' => $desitem,
            'categoryid'      => $catitem,
            'materialid'      => $matitem,
            'departmentid'    => $depitem,
            'locationid'      => $locitem,
            'modelid'         => $moditem,
            'userid'          => $useritem,
            'ownerid'         => $ownitem,
            'condition'       => $conditionitem,
            'date'            => $dateitem,
            'itemcost'        => $costitem,
            'status'          => '0',
            'code'            => $code,
        ];
        $this->db->query(' SET FOREIGN_KEY_CHECKS = 0');
        //this use for check foriegn key in table
        $query = $this->db->insert('item', $data);
        //this use for insert into database
        $this->db->query(' SET FOREIGN_KEY_CHECKS = 1');
        return $query;

    }//end add_item()


    /**
     * To get data from form update an item to update into database in table item
     * @param  any $nameitem      name item
     * @param  any $desitem       des item
     * @param  any $catitem       cat item
     * @param  any $matitem       mat item
     * @param  any $depitem       dep item
     * @param  any $locitem       loc item
     * @param  any $moditem       mod item
     * @param  any $useritem      user item
     * @param  any $ownitem       own item
     * @param  any $conditionitem condition item
     * @param  any $dateitem      date item
     * @param  any $costitem      cost item
     * @param  any $code          code
     * @param  int $id            id
     * @return any                result
     */
    public function update_item($nameitem, $desitem, $catitem, $matitem, $depitem, $locitem, $moditem, $useritem, $ownitem, $conditionitem, $dateitem, $costitem, $code, $id)
    {
        $data = [
            'item'            => $nameitem,
            'itemdescription' => $desitem,
            'categoryid'      => $catitem,
            'materialid'      => $matitem,
            'departmentid'    => $depitem,
            'locationid'      => $locitem,
            'modelid'         => $moditem,
            'userid'          => $useritem,
            'ownerid'         => $ownitem,
            'condition'       => $conditionitem,
            'date'            => $dateitem,
            'itemcost'        => $costitem,
            'status'          => '0',
            'code'            => $code,
        ];
        $this->db->where('item.iditem', $id);
        $this->db->set($data);
        $this->db->query(' SET FOREIGN_KEY_CHECKS = 0');
        $result = $this->db->update('item');
        $this->db->query(' SET FOREIGN_KEY_CHECKS = 1');
        return $result;

    }//end update_item()


    /**
     * Use to get value of userS for borrow item by id
     * @return any result
     */
    public function showUser()
    {
        $this->db->select('id, CONCAT(users.firstname," ",users.lastname) AS "borrower"');
        $sql = $this->db->get('users');
        if ($sql->num_rows() > 0) {
            return $sql->result();
        } else {
            return false;
        }

    }//end showUser()


    /**
     * Use to get list of borrower by id into form borrow an item
     * @param  int $id id
     * @return any     result
     */
    public function showListBorrower($id)
    {
        $this->db->select('item.iditem, item.item');
        //select item form table item
        $this->db->where('iditem', $id);
        $query = $this->db->get('item');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end showListBorrower()


    /**
     * This function use for insert data into borrower table in database
     * @param  any  $borrower   borrower
     * @param  any  $item       item
     * @param  date $startDate  start date
     * @param  date $returnDate return date
     * @return int              id of inserted result
     */
    public function insertBorrow($borrower, $item, $startDate, $returnDate)
    {
        $data  = [
            'borrower'   => $borrower,
            'itemBorrow' => $item,
            'startDate'  => $startDate,
            'returnDate' => $returnDate,
        ];
        $query = $this->db->insert('borrow', $data);

        $this->db->set('status', '1');
        $this->db->where('item.iditem', $item);
        $this->db->update('item');
        return $query;

    }//end insertBorrow()


    /**
     * Use to get list of return item by id into form return an item when click on return item
     * @param  int $id id
     * @return any     result
     */
    public function returnitem($id)
    {
        $queryStatement = "select * from borrow WHERE borrow.idBorrow in (select MAX(borrow.idBorrow) from borrow where borrow.itemBorrow =".$id.')';
        $query          = $this->db->query($queryStatement);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }//end returnitem()


    /**
     * This is use for get maximum of idBorrow to validation
     * @param  int $id id
     * @return int     result
     */
    public function getMaxIdBorrow($id)
    {
        $this->db->select('MAX(borrow.idBorrow) as "maxIdBorrow"');
        $this->db->where('itemBorrow', $id);
        $query = $this->db->get('borrow');
        return $query->result();

    }//end getMaxIdBorrow()


    /**
     * Use to return and update status in database
     * @param  any $data data
     * @return any       result
     */
    public function r_u_status($data)
    {
        $this->db->set('status', '0');
        $this->db->where('item.iditem', $data['itemId']);
        $s_update = $this->db->update('item');
        $this->db->set('actualDate', $data['actualDate']);
        $this->db->where('itemBorrow', $data['itemId']);
        $this->db->where('startDate', $data['startDate']);
        $this->db->where('idBorrow', $data['maxIdBorrow']);
        $this->db->update('borrow');

        return $s_update;

    }//end r_u_status()


    /**
     * Function to select expected return date to make condition in late status
     * to show in the item list(auto update status)
     * @return any result
     */
    public function returnLate()
    {
        // $query= $this->db->query('select max(borrow.returnDate) AS reDate, iditem from borrow inner join item where item.iditem = borrow.itemBorrow and item.`status`=1');
        // return $query->result();
        $this->db->select('itemBorrow');
        $this->db->from('borrow');
        $this->db->where('actualDate', null);
        $this->db->where('returnDate <', date('Y/m/d'));
        $query = $this->db->get();
        return $query->result();

    }//end returnLate()


    /**
     * This use for auto update status when borrower return an item later than expected return date
     * @param  int $id id
     * @return void
     */
    public function updateStatus($id)
    {
        $this->db->query("update item set item.status = '2' where item.iditem = '".$id."'");

    }//end updateStatus()


}//end class

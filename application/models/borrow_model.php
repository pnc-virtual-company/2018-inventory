<?php
// edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class borrow_model extends CI_Model
{
    
    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // get borrow data from database
    public function showAllBorrow()
    {
        $this->db->select('borrow.borrower, borrow.itemBorrow,borrow.startDate, borrow.returnDate, item.item');
        $this->db->join('item', 'item.iditem=borrow.itemBorrow');
        $query = $this->db->get('borrow');
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
}
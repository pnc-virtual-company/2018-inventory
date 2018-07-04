<?php
// edit by @author Bunla Rath <bunla.rath@student.passerellesnumeriques.org>

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Connection_model extends CI_Model
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }//end __construct()


    /**
     * Test if the user is connected
     * @return boolean true if he is connected
     */
    public function isConnected()
    {
        return $this->session->userdata('loggedIn') && $this->session->userdata('loggedIn') === true;
    }//end isConnected()

    /**
     * Test if the user is admin
     * @return boolean true if he is admin
     */
    public function isAdmin()
    {
        return $this->session->userdata('isAdmin') && $this->session->userdata('isAdmin') === true ||
          $this->session->userdata('isSuperAdmin') && $this->session->userdata('isSuperAdmin') === true;
    }//end isAdmin()
}//end class

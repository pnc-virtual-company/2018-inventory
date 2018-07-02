<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
        log_message('debug', 'URI='.$this->uri->uri_string());

    }//end __construct()


    /**
     * index for welcome
     * @return void
     */
    public function index()
    {
        $data['activeLink'] = 'home';
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('welcome', $data);
        $this->load->view('templates/footer', $data);

    }//end index()


}//end class

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Errors extends CI_Controller
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
     * Show privileges page
     * @return void
     */
    public function privileges()
    {
        $data['activeLink'] = 'home';
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('errors/html/privileges', $data);
        $this->load->view('templates/footer', $data);

    }//end privileges()


    /**
     * Show not found page
     * @return void
     */
    public function notfound()
    {
        $data['activeLink'] = 'home';
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('errors/html/notfound', $data);
        $this->load->view('templates/footer', $data);

    }//end notfound()


}//end class

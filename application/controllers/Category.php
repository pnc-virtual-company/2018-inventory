<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This controller serves the categories management pages.
 */
class Category extends CI_Controller
{
    /**
     * Default constructor
     * Check that the user is connected and an admin
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('connection_model');
        if (!$this->connection_model->isConnected()) {
            redirect('connection/login');
        }
        if (!$this->connection_model->isAdmin()) {
            redirect('errors/privileges');
        }
        log_message('debug', 'URI='.$this->uri->uri_string());
        $this->load->model('category_model');
    }

    /**
     * Display the page listing all categories.
     * But categories are loaded by Ajax.
     * @return void
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index()
    {
        $this->session->set_userdata('last_page', $this->uri->uri_string());
        $this->load->helper('form');
        $data['title'] = 'List of categories';
        $data['activeLink'] = 'others';
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('category/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Return an Ajax feed containing all categories
     * @return void
     */
    public function getAll()
    {
        $categories = $this->category_model->getAll();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($categories));
    }

    /**
     * Create a new category via Ajax
     */
    public function create()
    {
        $categoryName = $this->input->post('categoryNameCreate');
        $categoryAcronym = $this->input->post('categoryAcronymCreate');
        $categoryId = $this->category_model->create($categoryName, $categoryAcronym);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['categoryId' => $categoryId]));
    }

    /**
     * Load a partial form that allows to edit a category
     */
    public function edit()
    {
        $categoryId = $this->input->post('idcategory');
        $category = $this->category_model->get($categoryId);
        if (!empty($category)) {
            $data['categoryId'] = $category->idcategory;
            $data['categoryName'] = $category->category;
            $data['categoryAcronym'] = $category->acronym;
            $this->load->view('category/edit', $data);
        } else {
            $this->output
            ->set_content_type('text/html')
            ->set_output('<b>The object was not found</b>');
        }
    }

    /**
     * Update a category
     */
    public function update()
    {
        $categoryId = $this->input->post('categoryIdEdit');
        $categoryName = $this->input->post('categoryNameEdit');
        $categoryAcronym = $this->input->post('categoryAcronymEdit');
        $result = $this->category_model->update($categoryId, $categoryName, $categoryAcronym);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['result' => $result]));
    }

    /**
     * Delete a category
     */
    public function delete()
    {
        $categoryId = $this->input->post('idcategory');
        $result = $this->category_model->delete($categoryId);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['result' => $result]));
    }

    /**
     * Get the acronym of a category
     * @return string     acronym
     */
    public function getAcronym()
    {
        $id = $this->uri->segment(3);
        echo json_encode($this->category_model->getAcronym($id));
    }
}

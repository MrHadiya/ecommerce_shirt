<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->model('frontend/product_model');
        $this->load->model('frontend/banner_model');
        $this->load->helper('url');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Home Page',
            'description' => 'Welcome to Ecommerce Page.'
        );
        
        $data['banner_list'] = $this->banner_model->get_banners();
        $data['product_list'] = $this->product_model->get_products();
//        print_r($data);
//        die;
        $this->load->view('frontend/index', $data);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->model('frontend/product_model');
        $this->load->helper('url');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Product',
            'description' => 'Welcome to Product Page.'
        );
        
        $total_segment = $this->uri->total_segments();
        $record_num = $this->uri->segment($total_segment);
        $productId = $record_num;
        $data['product_info'] = $this->product_model->get_productById(array('product_id'=>$productId));
        
        $this->load->view('frontend/product', $data);
    }
}

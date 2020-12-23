<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Order',
            'description' => 'Welcome to Order Page.'
        );
        $this->load->view('admin/order', $data);
    }
}
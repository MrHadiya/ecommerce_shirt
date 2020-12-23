<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Customer',
            'description' => 'Welcome to Customer Page.'
        );
        $this->load->view('admin/customer', $data);
    }
}
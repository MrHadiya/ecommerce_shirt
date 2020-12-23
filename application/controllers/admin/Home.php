<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Dashboard',
            'description' => 'Welcome to Backend Panel.'
        );
        $this->load->view('admin/index', $data);
    }
}

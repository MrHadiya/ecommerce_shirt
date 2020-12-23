<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Login',
            'description' => 'Welcome to Login Page.'
        );
        
        $this->load->view('admin/login', $data);
    }
    
    public function login()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $username = isset($form_data["username"]) ? $form_data["username"] : array_push($errors, "Please enter Username Name.");
        $password = isset($form_data["password"]) ? $form_data["password"] : array_push($errors, "Please enter Password.");
        
        if( count($errors) > 0 ) {
            $output["code"] = 306;
            $output["status"] = 'false';
            $output["message"] = $errors;
            $output["data"] = array();
        }
        else {
            $inputData = array(
                'email' => $username, 
                'password' => md5($password)
            );
            $this->load->model('admin/auth_model');
            $output = $this->auth_model->login($inputData);
            if( $output['status'] == 'true' ) {
                unset($password);
                $output['link'] = '../admin/product';
            }
        }
        
        echo json_encode($output);
    }
    
    public function logout()
    {
        $session_data = array('adminid', 'name');
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->model('admin/brand_model');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Brand',
            'description' => 'Welcome to Brand Page.'
        );
        $data['brand_list'] = $this->brand_model->get_brands();
        
        $this->load->view('admin/brand', $data);
    }
    
    public function addBrand()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $brandName = isset($form_data["brandName"]) ? trim($form_data["brandName"]) : array_push($errors, "Please enter Brand Name.");
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $res_isexist_brand = $this->brand_model->isexist_brand(array('brand_name'=> strtolower($brandName)));
                if( $res_isexist_brand['status'] == 'true' ) {
                    $output['code'] = 305;
                    $output['status'] = false;
                    $output['message'] = 'This Brand already exist.';
                }
                else {
                    $inputData = array(
                        'admin_id' => $loginAdminId, 
                        'brand_name' => $brandName, 
                        'status' => $status
                    );
                    $output = $this->brand_model->add_brand($inputData);
                }
            }
        }
        else {
            $output["code"] = 440;
            $output["status"] = false;
            $output["message"] = "Session Timeout!";
            $output["data"] = array();
        }
        
        echo json_encode($output);
    }
    
    public function deleteBrand()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $brand_id = isset($form_data["value"]) ? trim($form_data["value"]) : array_push($errors, "Brand not Defined.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $inputData = array(
                    'brand_id' => $brand_id
                );
                $output = $this->brand_model->delete_brand($inputData);
            }
        }
        else {
            $output["code"] = 440;
            $output["status"] = false;
            $output["message"] = "Session Timeout!";
            $output["data"] = array();
        }
        
        echo json_encode($output);
    }
    
    public function getBrandByValue($values = array())
    {
        $output = array();
        //$form_data = $this->input->post();
        
        $inputData = array();
        if( isset($values["status"]) ) {
            $inputData['status'] = $values["status"];
        }
        if( isset($values["brand_id"]) ) {
            $inputData['brand_id'] = $values["brand_id"];
        }
        
        $output = $this->brand_model->get_brandByValue($inputData);
        
        echo json_encode($output);
    }
}
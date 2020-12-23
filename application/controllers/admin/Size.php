<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->model('admin/size_model');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Sizes',
            'description' => 'Welcome to Sizes Page.'
        );
        $data['size_list'] = $this->size_model->get_sizes();
        
        $this->load->view('admin/size', $data);
    }
    
    public function addSize()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $sizeName = isset($form_data["sizeName"]) ? trim($form_data["sizeName"]) : array_push($errors, "Please enter Size Name.");
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $res_isexist_size = $this->size_model->isexist_size(array('size_name'=> strtolower($sizeName)));
                if( $res_isexist_size['status'] == 'true' ) {
                    $output['code'] = 305;
                    $output['status'] = false;
                    $output['message'] = 'This Size already exist.';
                }
                else {
                    $inputData = array(
                        'admin_id' => $loginAdminId, 
                        'title' => $sizeName, 
                        'status' => $status
                    );
                    $output = $this->size_model->add_size($inputData);
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
    
    public function editSize()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $sizeName = isset($form_data["sizeName"]) ? trim($form_data["sizeName"]) : array_push($errors, "Please enter Size Name.");
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        $sizeId = isset($form_data["sizeId"]) ? trim($form_data["sizeId"]) : array_push($errors, "Size not defined.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $inputData = array(
                    'admin_id' => $loginAdminId, 
                    'size_id' => $sizeId, 
                    'title' => $sizeName, 
                    'status' => $status
                );
                
                $res_getSizeInfo = $this->size_model->get_sizeByValue(array('size_id'=>$sizeId));
                $size_name = ( $res_getSizeInfo['status'] == 'true' ) ? strtolower($res_getSizeInfo['data'][0]->size_name) : '';
                if( strtolower($sizeName) != $size_name ) {
                    $res_isexist_size = $this->size_model->isexist_size(array('size_name'=> strtolower($sizeName)));
                    if( $res_isexist_size['status'] == 'true' ) {
                        $output['code'] = 305;
                        $output['status'] = false;
                        $output['message'] = 'This Size already exist.';
                    }
                    else {
                        $output = $this->size_model->update_size($inputData);
                    }
                }
                else {
                    $output = $this->size_model->update_size($inputData);
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
    
    public function deleteSize()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $size_id = isset($form_data["value"]) ? trim($form_data["value"]) : array_push($errors, "Size not Defined.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $inputData = array(
                    'size_id' => $size_id
                );
                $output = $this->size_model->delete_size($inputData);
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
    
    public function getSizeByValue($values = array())
    {
        $output = array();
        //$form_data = $this->input->post();
        
        $inputData = array();
        if( isset($values["status"]) ) {
            $inputData['status'] = $values["status"];
        }
        if( isset($values["size_id"]) ) {
            $inputData['size_id'] = $values["size_id"];
        }
        
        $output = $this->size_model->get_sizeByValue($inputData);
        
        echo json_encode($output);
    }
    
    public function loadEditSizeForm($value)
    {
        $data = array();
        $data['edit_sizeData'] = $this->size_model->get_sizeByValue(array('size_id'=>$value));
        
        $this->load->view('admin/pages/size/view_size_edit', $data);
    }
}
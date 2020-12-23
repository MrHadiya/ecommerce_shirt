<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colors extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->model('admin/colors_model');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Colors',
            'description' => 'Welcome to Colors Page.'
        );
        $data['colors_list'] = $this->colors_model->get_colors();
        
        $this->load->view('admin/colors', $data);
    }
    
    public function addColor()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $colorName = isset($form_data["colorName"]) ? trim($form_data["colorName"]) : array_push($errors, "Please enter Color Name.");
        $colorCode = isset($form_data["colorName"]) ? trim($form_data["colorCode"]) : array_push($errors, "Please enter Color Code.");
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $res_isexist_color = $this->colors_model->isexist_color(array('color_code'=>strtolower($colorCode)));
                if( $res_isexist_color['status'] == 'true' ) {
                    $output['code'] = 305;
                    $output['status'] = false;
                    $output['message'] = 'This Color-Code already exist.';
                }
                else {
                    $inputData = array(
                        'admin_id' => $loginAdminId, 
                        'color_name' => $colorName, 
                        'color_code' => $colorCode, 
                        'status' => $status
                    );
                    $output = $this->colors_model->add_color($inputData);
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
    
    public function deleteColor()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $color_id = isset($form_data["value"]) ? trim($form_data["value"]) : array_push($errors, "Color not Defined.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $inputData = array(
                    'color_id' => $color_id
                );
                $output = $this->colors_model->delete_color($inputData);
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
    
    public function getColorByValue($values = array())
    {
        $output = array();
        //$form_data = $this->input->post();
        
        $inputData = array();
        if( isset($values["status"]) ) {
            $inputData['status'] = $values["status"];
        }
        if( isset($values["color_id"]) ) {
            $inputData['color_id'] = $values["color_id"];
        }
        
        $output = $this->colors_model->get_colorByValue($inputData);
        
        echo json_encode($output);
    }
    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->model('admin/category_model');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Category',
            'description' => 'Welcome to Category Page.'
        );
        $data['category_list'] = $this->category_model->get_categories();
        
        $this->load->view('admin/category', $data);
    }
    
    public function addCategory()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $categoryName = isset($form_data["categoryName"]) ? trim($form_data["categoryName"]) : array_push($errors, "Please enter Category Name.");
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $res_isexist_category = $this->category_model->isexist_category(array('category_name'=> strtolower($categoryName)));
                if( $res_isexist_category['status'] == 'true' ) {
                    $output['code'] = 305;
                    $output['status'] = false;
                    $output['message'] = 'This Category already exist.';
                }
                else {
                    $inputData = array(
                        'admin_id' => $loginAdminId, 
                        'category_name' => $categoryName, 
                        'status' => $status
                    );
                    $output = $this->category_model->add_category($inputData);
                    //$output['status'] = true;
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
    
    public function editCategory()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $categoryName = isset($form_data["categoryName"]) ? trim($form_data["categoryName"]) : array_push($errors, "Please enter Category Name.");
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        $categoryId = isset($form_data["categoryId"]) ? trim($form_data["categoryId"]) : array_push($errors, "Category not defined.");
        
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
                    'category_id' => $categoryId, 
                    'category_name' => $categoryName, 
                    'status' => $status
                );
                
                $res_getCatInfo = $this->category_model->get_categoryByValue(array('category_id'=>$categoryId));
                $category_name = ( $res_getCatInfo['status'] == 'true' ) ? strtolower($res_getCatInfo['data'][0]->category_name) : '';
                if( strtolower($categoryName) != $category_name ) {
                    $res_isexist_category = $this->category_model->isexist_category(array('category_name'=> strtolower($categoryName)));
                    if( $res_isexist_category['status'] == 'true' ) {
                        $output['code'] = 305;
                        $output['status'] = false;
                        $output['message'] = 'This Category already exist.';
                    }
                    else {
                        $output = $this->category_model->update_category($inputData);
                    }
                }
                else {
                    $output = $this->category_model->update_category($inputData);
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
    
    public function deleteCategory()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $category_id = isset($form_data["value"]) ? trim($form_data["value"]) : array_push($errors, "Category not Defined.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $inputData = array(
                    'category_id' => $category_id
                );
                $output = $this->category_model->delete_category($inputData);
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
    
    public function loadEditCategoryForm($value)
    {
        $data = array();
        $data['edit_categoryData'] = $this->category_model->get_categoryByValue(array('category_id'=>$value));
        
        $this->load->view('admin/pages/category/view_category_edit', $data);
    }
}
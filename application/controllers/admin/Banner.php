<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->model('admin/banner_model');
        $this->load->helper('url');
    }
    
    public function index()
    {
        $data = array();
        $data['meta'] = array(
            'title' => 'Banner',
            'description' => 'Welcome to Banner Page.'
        );
        $data['banner_list'] = $this->banner_model->get_banners();

        $this->load->view('admin/banner', $data);
    }
    
    public function addBanner()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $bannerTitle = isset($form_data["bannerTitle"]) ? trim($form_data["bannerTitle"]) : array_push($errors, "Please enter Banner Title.");
        $bannerImage = isset($_FILES["bannerImage"]["tmp_name"]) ? $_FILES["bannerImage"]["name"] : array_push($errors, "Please upload Banner Image.");
        $bannerLink = isset($form_data["bannerLink"]) ? trim($form_data["bannerLink"]) : '';
        $description = isset($form_data["description"]) ? trim($form_data["description"]) : '';
        $sortOrder = isset($form_data["sortOrder"]) ? trim($form_data["sortOrder"]) : '0';
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                if( !empty($bannerImage) ) {
                    date_default_timezone_set('Asia/Calcutta');
                    $date_time = date("Y-m-d H:i:s");
                    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $imageName = strtotime($date_time).substr(str_shuffle($characters), 0, 10);

                    $fileName = explode('.', $bannerImage);
                    $extension = end($fileName);
                    $dest = base_url()."uploads/images/banner/".$imageName.".".$extension;
                    $uploaded_files = $imageName.".".$extension;
                    $scr = isset($_FILES['bannerImage']['tmp_name']) ? $_FILES['bannerImage']['tmp_name'] : "";
                }

                $inputData = array(
                    'admin_id' => $loginAdminId, 
                    'banner_title' => $bannerTitle, 
                    'description' => $description, 
                    'link' => $bannerLink, 
                    'sort_order' => $sortOrder, 
                    'image' => $uploaded_files, 
                    'status' => $status
                );
                $res_addBanner = $this->banner_model->add_banner($inputData);
                if( !empty($bannerImage) ) {
                    if( $res_addBanner['status'] == 'true' && count($res_addBanner['data']) > 0 ) {
                        if( move_uploaded_file($scr, $dest) ) {
                            $output = $res_addBanner;
                        }
                        else {
                            $output['status'] = 'false';
                        }
                    }
                }
                else {
                    $output = $res_addBanner;
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
    
    public function editBanner()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $bannerTitle = isset($form_data["bannerTitle"]) ? trim($form_data["bannerTitle"]) : array_push($errors, "Please enter Banner Title.");
        $bannerImage = isset($_FILES["bannerImage"]["tmp_name"]) ? $_FILES["bannerImage"]["name"] : array_push($errors, "Please upload Banner Image.");
        $bannerLink = isset($form_data["bannerLink"]) ? trim($form_data["bannerLink"]) : '';
        $description = isset($form_data["description"]) ? trim($form_data["description"]) : '';
        $sortOrder = isset($form_data["sortOrder"]) ? trim($form_data["sortOrder"]) : '0';
        $status = isset($form_data["status"]) ? trim($form_data["status"]) : array_push($errors, "Please select Status.");
        $bannerId = isset($form_data["bannerId"]) ? trim($form_data["bannerId"]) : array_push($errors, "Banner not defined.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $res_getBannerInfo = $this->banner_model->get_bannerByValue(array('banner_id'=>$bannerId));
                $imageWithPath = ( $res_getBannerInfo['status'] == 'true' ) ? $res_getBannerInfo['data'][0]->image : '';
                $imageWithPathArray = ( !empty($imageWithPath) ) ? explode('/', $imageWithPath) : '';
                $image = ( count($imageWithPathArray) > 0 ) ? end($imageWithPathArray) : '';
                
                $uploaded_files = '';
                $changeOrNot = '';
                if( !empty($bannerImage) ) {
                    date_default_timezone_set('Asia/Calcutta');
                    $date_time = date("Y-m-d H:i:s");
                    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $imageName = strtotime($date_time).substr(str_shuffle($characters), 0, 10);

                    $fileName = explode('.', $bannerImage);
                    $extension = end($fileName);
                    $dest = base_url()."uploads/images/banner/".$imageName.".".$extension;
                    $uploaded_files = $imageName.".".$extension;
                    $scr = isset($_FILES['bannerImage']['tmp_name']) ? $_FILES['bannerImage']['tmp_name'] : "";
                    $changeOrNot = 'changed';
                }
                else {
                    $uploaded_files = $image;
                    $changeOrNot = 'nochanged';
                }
                
                if( !empty($uploaded_files) ) {
                    $inputData = array(
                        'admin_id' => $loginAdminId, 
                        'banner_id' => $bannerId, 
                        'banner_title' => $bannerTitle, 
                        'description' => $description, 
                        'link' => $bannerLink, 
                        'sort_order' => $sortOrder, 
                        'image' => $uploaded_files, 
                        'status' => $status
                    );
                    $res_updateBanner = $this->banner_model->update_banner($inputData);
                }
                
                if( $res_updateBanner['status'] == 'true' && $changeOrNot == 'changed' ) {
                    if( move_uploaded_file($scr, $dest) ) {
                        unlink(base_url().$imageWithPath);
                        $output = $res_updateBanner;
                    }
                }
                else {
                    $output = $res_updateBanner;
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
    
    public function deleteBanner()
    {
        $output = array();
        $errors = array();
        
        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $banner_id = isset($form_data["value"]) ? trim($form_data["value"]) : array_push($errors, "Banner not Defined.");
        
        if( !empty($loginAdminId) ) {
            if( count($errors) > 0 ) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            }
            else {
                $inputData = array(
                    'banner_id' => $banner_id
                );
                $bannerData = $this->banner_model->get_bannerByValue($inputData);
                if( $bannerData['status'] == 'true' && count($bannerData['data']) > 0 ) {
                    $image = $bannerData['data'][0]->image;
                    $output = $this->banner_model->delete_banner($inputData);
                    if( $output['status'] == 'true' ) {
                        unlink(base_url().$image);
                    }
                }
                else {
                    $output = array('status'=>'false', 'message'=>'Something Wrong!');
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
    
    public function loadEditBannerForm($value)
    {
        $data = array();
        $data['edit_bannerData'] = $this->banner_model->get_bannerByValue(array('banner_id'=>$value));
        
        $this->load->view('admin/pages/banner/view_banner_edit', $data);
    }
}

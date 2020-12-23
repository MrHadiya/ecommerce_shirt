<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->database();
        $this->load->model('admin/product_model');
        //$this->CI = & get_instance();
        $this->load->helper('url');
    }

    public function index() {
        $data = array();
        $data['meta'] = array(
            'title' => 'Products',
            'description' => 'Welcome to Product Page.'
        );
        $data['product_list'] = $this->product_model->get_products();

        $this->load->view('admin/product', $data);
    }

    public function addProduct() {
        $output = array();
        $errors = array();

        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $productName = isset($form_data["productName"]) ? trim($form_data["productName"]) : array_push($errors, "Please enter Product Name.");
        $productCode = isset($form_data["productCode"]) ? trim($form_data["productCode"]) : array_push($errors, "Please enter Product Code.");
        $category = isset($form_data["category"]) ? trim($form_data["category"]) : array_push($errors, "Please select Category.");
        $sizes = isset($form_data["sizes"]) ? $form_data["sizes"] : array_push($errors, "Please select Sizes.");
        $color = isset($form_data["color"]) ? trim($form_data["color"]) : array_push($errors, "Please select Color.");
        $mrp = isset($form_data["mrp"]) ? trim($form_data["mrp"]) : array_push($errors, "Please enter MRP.");
        $mrp = (is_numeric($mrp)) ? $mrp : array_push($errors, "Please enter MRP in Numeric Format.");
        $sp = isset($form_data["sp"]) ? trim($form_data["sp"]) : array_push($errors, "Please enter SP.");
        $sp = (is_numeric($sp)) ? $sp : array_push($errors, "Please enter SP in Numeric Format.");
        $stock = isset($form_data["stock"]) ? trim($form_data["stock"]) : array_push($errors, "Please enter Stock.");
        $stock = (is_numeric($stock)) ? $stock : array_push($errors, "Please enter Stock in Numeric Format.");
        $description = isset($form_data["description"]) ? trim($form_data["description"]) : '';
        $image = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["name"] : '';
        $status = isset($form_data["status"]) ? $form_data["status"] : array_push($errors, "Please select Status.");

        if (!empty($loginAdminId)) {
            if (count($errors) > 0) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            } else {
                $res_isexist_product = $this->product_model->isexist_product(array('product_code' => strtolower($productCode)));
                if ($res_isexist_product['status'] == 'true') {
                    $output['code'] = 305;
                    $output['status'] = false;
                    $output['message'] = 'This Product Code already exist.';
                } else {
                    if (!empty($image)) {
                        date_default_timezone_set('Asia/Calcutta');
                        $date_time = date("Y-m-d H:i:s");
                        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $imageName = strtotime($date_time) . substr(str_shuffle($characters), 0, 10);

                        $fileName = explode('.', $image);
                        $extension = end($fileName);
                        $uploaded_files = $imageName . "." . $extension;
                        $dest = base_url() . "uploads/images/product/" . $imageName . "." . $extension;
                        $scr = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : "";
                    }
                    $inputData = array(
                        'admin_id' => $loginAdminId,
                        'category_id' => $category,
                        'color_id' => $color,
                        'size_ids' => implode(",", $sizes),
                        'product_name' => $productName,
                        'product_code' => $productCode,
                        'mrp' => $mrp,
                        'sp' => $sp,
                        'stock' => $stock,
                        'description' => $description,
                        'image' => $uploaded_files,
                        'status' => $status
                    );
                    $res_addProduct = $this->product_model->add_product($inputData);
                    if (!empty($image)) {
                        if ($res_addProduct['status'] == 'true' && count($res_addProduct['data']) > 0) {
                            if (move_uploaded_file($scr, $dest)) {
                                $output = $res_addProduct;
                            } else {
                                $output['status'] = 'false';
                                $output['message'] = 'Product created Successfully but image not uploaded.';
                            }
                        }
                    } else {
                        $output = $res_addProduct;
                    }
                }
            }
        } else {
            $output["code"] = 440;
            $output["status"] = false;
            $output["message"] = "Session Timeout!";
            $output["data"] = array();
        }

        echo json_encode($output);
    }

    public function editProduct() {
        $output = array();
        $errors = array();

        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $productName = isset($form_data["productName"]) ? trim($form_data["productName"]) : array_push($errors, "Please enter Product Name.");
        $productCode = isset($form_data["productCode"]) ? trim($form_data["productCode"]) : array_push($errors, "Please enter Product Code.");
        $category = isset($form_data["category"]) ? trim($form_data["category"]) : array_push($errors, "Please select Category.");
        $sizes = isset($form_data["sizes"]) ? $form_data["sizes"] : array_push($errors, "Please select Sizes.");
        $color = isset($form_data["color"]) ? trim($form_data["color"]) : array_push($errors, "Please select Color.");
        $mrp = isset($form_data["mrp"]) ? trim($form_data["mrp"]) : array_push($errors, "Please enter MRP.");
        $mrp = (is_numeric($mrp)) ? $mrp : array_push($errors, "Please enter MRP in Numeric Format.");
        $sp = isset($form_data["sp"]) ? trim($form_data["sp"]) : array_push($errors, "Please enter SP.");
        $sp = (is_numeric($sp)) ? $sp : array_push($errors, "Please enter SP in Numeric Format.");
        $stock = isset($form_data["stock"]) ? trim($form_data["stock"]) : array_push($errors, "Please enter Stock.");
        $stock = (is_numeric($stock)) ? $stock : array_push($errors, "Please enter Stock in Numeric Format.");
        $description = isset($form_data["description"]) ? trim($form_data["description"]) : '';
        $image = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["name"] : '';
        $status = isset($form_data["status"]) ? $form_data["status"] : array_push($errors, "Please select Status.");
        $productId = isset($form_data["productId"]) ? trim($form_data["productId"]) : array_push($errors, "Product not defined.");

        if (!empty($loginAdminId)) {
            if (count($errors) > 0) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            } else {
                $res_getProductInfo = $this->product_model->get_productByValue(array('product_id' => $productId));
                $imageWithPath = ( $res_getProductInfo['status'] == 'true' ) ? $res_getProductInfo['data'][0]->image : '';
                $imageWithPathArray = (!empty($imageWithPath) ) ? explode('/', $imageWithPath) : '';
                $db_image = ( count($imageWithPathArray) > 0 ) ? end($imageWithPathArray) : '';

                $uploaded_files = '';
                $changeOrNot = '';
                if (!empty($image)) {
                    date_default_timezone_set('Asia/Calcutta');
                    $date_time = date("Y-m-d H:i:s");
                    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $imageName = strtotime($date_time) . substr(str_shuffle($characters), 0, 10);

                    $fileName = explode('.', $image);
                    $extension = end($fileName);
                    $dest = base_url() . "uploads/images/product/" . $imageName . "." . $extension;
                    $uploaded_files = $imageName . "." . $extension;
                    $scr = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : "";
                    $changeOrNot = 'changed';
                } else {
                    $uploaded_files = $db_image;
                    $changeOrNot = 'nochanged';
                }

                $inputData = array(
                    'admin_id' => $loginAdminId,
                    'product_id' => $productId,
                    'category_id' => $category,
                    'color_id' => $color,
                    'size_ids' => implode(",", $sizes),
                    'product_name' => $productName,
                    'product_code' => $productCode,
                    'mrp' => $mrp,
                    'sp' => $sp,
                    'stock' => $stock,
                    'description' => $description,
                    'image' => $uploaded_files,
                    'status' => $status
                );

                $product_code = ( $res_getProductInfo['status'] == 'true' ) ? strtolower($res_getProductInfo['data'][0]->product_code) : '';
                if (strtolower($productCode) != $product_code) {
                    $res_isexist_product = $this->product_model->isexist_product(array('product_code' => strtolower($productCode)));
                    if ($res_isexist_product['status'] == 'true') {
                        $output['code'] = 305;
                        $output['status'] = false;
                        $output['message'] = 'This Product Code already exist.';
                    } else {
                        $res_updateProduct = $this->product_model->update_product($inputData);
                    }
                } else {
                    $res_updateProduct = $this->product_model->update_product($inputData);
                }

                if ($res_updateProduct['status'] == 'true' && $changeOrNot == 'changed') {
                    if (move_uploaded_file($scr, $dest)) {
                        unlink(base_url() . $imageWithPath);
                        $output = $res_updateProduct;
                    }
                } else {
                    $output = $res_updateProduct;
                }
            }
        } else {
            $output["code"] = 440;
            $output["status"] = false;
            $output["message"] = "Session Timeout!";
            $output["data"] = array();
        }

        echo json_encode($output);
    }

    public function deleteProduct() {
        $output = array();
        $errors = array();

        $form_data = $this->input->post();
        $loginAdminId = isset($_SESSION['SESSION_ADMIN_LOGIN']) ? $_SESSION['SESSION_ADMIN_LOGIN']['admin_user_id'] : '1';
        $product_id = isset($form_data["value"]) ? trim($form_data["value"]) : array_push($errors, "Category not Defined.");

        if (!empty($loginAdminId)) {
            if (count($errors) > 0) {
                $output["code"] = 306;
                $output["status"] = false;
                $output["message"] = $errors;
                $output["data"] = array();
            } else {
                $inputData = array(
                    'product_id' => $product_id
                );
                $productData = $this->product_model->get_productByValue($inputData);
                if ($productData['status'] == 'true' && count($productData['data']) > 0) {
                    $image = $productData['data'][0]->image;
                    $output = $this->product_model->delete_product($inputData);
                    if ($output['status'] == 'true') {
                        unlink(base_url() . $image);
                    }
                } else {
                    $output = array('status' => 'false', 'message' => 'Something Wrong!');
                }
            }
        } else {
            $output["code"] = 440;
            $output["status"] = false;
            $output["message"] = "Session Timeout!";
            $output["data"] = array();
        }

        echo json_encode($output);
    }

    public function generateProductCode() {
        $productCode = false;
        $res = $this->product_model->get_lastProductCode();

        if ($res['status'] == 'true') {
//        if ($res['status'] == 'true' && count($res['data']) > 0) {
            $productCode = $res['data']->product_id + 1;
        }
        return $productCode;
    }

    public function loadEditProductForm($value) {
        $data = array();
        $data['edit_productData'] = $this->product_model->get_productByValue(array('product_id' => $value));

        $this->load->view('admin/pages/product/view_product_edit', $data);
    }

    public function getCategoryByValue($values = array()) {
        $output = array();
        //$form_data = $this->input->post();

        $inputData = array();
        if (isset($values["status"])) {
            $inputData['status'] = $values["status"];
        }
        if (isset($values["brand_id"])) {
            $inputData['brand_id'] = $values["brand_id"];
        }

        $this->load->model('admin/category_model');
        $output = $this->category_model->get_categoryByValue($inputData);

        return json_encode($output);
    }

    public function getColorByValue($values = array()) {
        $output = array();
        //$form_data = $this->input->post();

        $inputData = array();
        if (isset($values["status"])) {
            $inputData['status'] = $values["status"];
        }
        if (isset($values["color_id"])) {
            $inputData['color_id'] = $values["color_id"];
        }

        $this->load->model('admin/colors_model');
        $output = $this->colors_model->get_colorByValue($inputData);

        return json_encode($output);
    }

    public function getSizeByValue($values = array()) {
        $output = array();
        //$form_data = $this->input->post();

        $inputData = array();
        if (isset($values["status"])) {
            $inputData['status'] = $values["status"];
        }
        if (isset($values["size_id"])) {
            $inputData['size_id'] = $values["size_id"];
        }

        $this->load->model('admin/size_model');
        $output = $this->size_model->get_sizeByValue($inputData);

        return json_encode($output);
    }

}

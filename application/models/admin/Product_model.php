<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_products() {
        $response = array();
        $this->db->select('P.product_id, P.size_ids, P.product_name, P.product_code, P.mrp, P.sp, P.stock, P.keywords, P.description, CONCAT("uploads/images/product/", P.image) as image, P.status, 
                P.category_id, C.category_name, 
                P.color_id, CL.color_code');
        $this->db->from('products P');
        $this->db->where('P.status !=', '0');
        $this->db->join('categories C', 'C.category_id = P.category_id', 'left');
        $this->db->join('colors CL', 'CL.color_id = P.color_id', 'left');
        $this->db->order_by('P.product_name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();

            $response = array('status' => 'true', 'message' => 'Records Found', 'data' => $data);
        } else {
            $response = array('status' => 'false', 'message' => 'No Records Found', 'data' => array());
        }

        return $response;
    }

    public function isexist_product($values) {
        $output = array();

        $this->db->select('P.product_id, P.category_id, P.color_id, P.size_ids, P.product_name, P.product_code, P.mrp, P.sp, P.stock, P.keywords, P.description, CONCAT("uploads/images/product/", P.image) as image, P.status');
        $this->db->from('products P');
        $this->db->where('P.status !=', '0');
        $this->db->where('LOWER(P.product_code)', $values['product_code']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();

            $output = array('status' => 'true', 'message' => 'Records Found', 'data' => $data);
        } else {
            $output = array('status' => 'false', 'message' => 'No Records Found', 'data' => array());
        }

        return $output;
    }

    function add_product($values = array()) {
        $output = array();

        if (is_array($values) == true || count($values) > 0) {
            $res = $this->db->insert('products', $values);
            if ($this->db->affected_rows() > 0 && $res == true) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status' => 'true', 'message' => 'Success', 'data' => array('new_product_id' => $new_inserted_id));
            } else {
                $output = array('status' => 'false', 'message' => 'Something Wrong!', 'data' => array());
            }
        } else {
            $output = array('status' => 'false', 'message' => 'Form Data can not be empty.', 'data' => array());
        }

        return $output;
    }

    public function update_product($values = array()) {
        $output = array();

        if (is_array($values) == true || count($values) > 0) {
            $this->db->where('product_id', $values['product_id']);
            $res = $this->db->update('products', $values);
            if ($this->db->affected_rows() > 0 && $res == true) {
                $output = array('status' => 'true', 'message' => 'Success');
            } else {
                $output = array('status' => 'false', 'message' => 'Something Wrong!');
            }
        } else {
            $output = array('status' => 'false', 'message' => 'Form Data can not be empty.', 'data' => array());
        }

        return $output;
    }

    public function delete_product($values = array()) {
        $output = array();

        if (is_array($values) == true || count($values) > 0) {
            $this->db->where('product_id', $values['product_id']);
            $res = $this->db->delete('products');
            if ($this->db->affected_rows() > 0 && $res == true) {
                $output = array('status' => 'true', 'message' => 'Product Deleted Successfully');
            } else {
                $output = array('status' => 'false', 'message' => 'Something Wrong!');
            }
        } else {
            $output = array('status' => 'false', 'message' => 'Form Data can not be empty.');
        }

        return $output;
    }

    public function get_lastProductCode() {
        $output = array();

        $this->db->select('P.product_id, P.product_code');
        $this->db->from('products P');
        $this->db->order_by('P.product_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();

            $output = array('status' => 'true', 'message' => 'Records Found', 'data' => $data);
        } else {
            $output = array('status' => 'false', 'message' => 'No Records Found', 'data' => array());
        }

        return $output;
    }

    public function get_productByValue($values = array()) {
        $output = array();
        $this->db->select('P.product_id, P.size_ids, P.product_name, P.product_code, P.mrp, P.sp, P.stock, P.keywords, P.description, CONCAT("uploads/images/product/", P.image) as image, P.status, 
                P.category_id, C.category_name, 
                P.color_id, CL.color_code');
        $this->db->from('products P');
        $this->db->where('P.status !=', '0');
        $this->db->join('categories C', 'C.category_id = P.category_id', 'left');
        $this->db->join('colors CL', 'CL.color_id = P.color_id', 'left');
        if (isset($values['status'])) {
            $this->db->where('P.status', $values['status']);
        }
        if (isset($values['product_id'])) {
            $this->db->where('P.product_id', $values['product_id']);
        }
        $this->db->order_by('P.product_name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();

            $output = array('status' => 'true', 'message' => 'Records Found', 'data' => $data);
        } else {
            $output = array('status' => 'false', 'message' => 'No Records Found', 'data' => array());
        }

        return $output;
    }

    public function isexist_productVariant($values) {
        $output = array();

        $this->db->select('PV.product_variant_id, PV.product_id, PV.size_id, PV.color_id, PV.mrp, PV.sp, PV.stock, PV.status');
        $this->db->from('product_variants PV');
        $this->db->where('PV.status !=', '0');
        $this->db->where('PV.product_id', $values['product_id']);
        $this->db->where('PV.size_id', $values['size_id']);
        $this->db->where('PV.color_id', $values['color_id']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();

            $output = array('status' => 'true', 'message' => 'Records Found', 'data' => $data);
        } else {
            $output = array('status' => 'false', 'message' => 'No Records Found', 'data' => array());
        }

        return $output;
    }

    function add_variants($values = array()) {
        $output = array();

        if (is_array($values) == true || count($values) > 0) {
            $res = $this->db->insert('product_variants', $values);
            if ($this->db->affected_rows() > 0 && $res == true) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status' => 'true', 'message' => 'Success', 'data' => array('new_variant_id' => $new_inserted_id));
            } else {
                $output = array('status' => 'false', 'message' => 'Something Wrong!', 'data' => array());
            }
        } else {
            $output = array('status' => 'false', 'message' => 'Form Data can not be empty.', 'data' => array());
        }

        return $output;
    }

    function add_product_image($values = array()) {
        $output = array();

        if (is_array($values) == true || count($values) > 0) {
            $res = $this->db->insert('product_images', $values);
            if ($this->db->affected_rows() > 0 && $res == true) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status' => 'true', 'message' => 'Success', 'data' => array('new_image_id' => $new_inserted_id));
            } else {
                $output = array('status' => 'false', 'message' => 'Something Wrong!', 'data' => array());
            }
        } else {
            $output = array('status' => 'false', 'message' => 'Form Data can not be empty.', 'data' => array());
        }

        return $output;
    }

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_productsV2()
    {
        $response = array();
        
        $this->db->select('P.product_id, P.product_name, P.product_code, P.keywords, P.description, P.specification, P.status, 
                P.brand_id, B.brand_name, 
                P.category_id, C.category_name');
        $this->db->from('products P');
        $this->db->where('P.status', '1');
        $this->db->join('brands B', 'B.brand_id = P.brand_id', 'left');
        $this->db->join('categories C', 'C.category_id = P.category_id', 'left');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            $data = $query->result();
            foreach( $data as $key => $value ) {
                $res_variants = $this->get_productVariantsByProduct(array('product_id'=>$value->product_id));
                if( $res_variants['status'] == 'true' ) {
                    $data[$key]->variants = $res_variants['data'];
                }
                else {
                    $data[$key]->variants = array();
                }
                
                $res_images = $this->get_productImagesByProduct(array('product_id'=>$value->product_id));
                if( $res_images['status'] == 'true' ) {
                    $data[$key]->images = $res_images['data'];
                }
                else {
                    $data[$key]->images = array();
                }
            }
            
            $response = array('status'=>'true', 'message'=>'Records Found', 'data'=>$data);
        }
        else {
            $response = array('status'=>'false', 'message'=>'No Records Found', 'data'=>array());
        }
        
        return $response;
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
    
    
    
    
    public function get_productById($values)
    {
        $response = array();
        
        $this->db->select('P.product_id, P.product_name, P.product_code, P.keywords, P.description, P.specification, P.status, 
                P.brand_id, B.brand_name, 
                P.category_id, C.category_name');
        $this->db->from('products P');
        $this->db->where('P.status', '1');
        $this->db->where('P.product_id', $values['product_id']);
        $this->db->join('brands B', 'B.brand_id = P.brand_id', 'left');
        $this->db->join('categories C', 'C.category_id = P.category_id', 'left');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            //$data = $query->result();
            $data = $query->row();
            $res_variants = $this->get_productVariantsByProduct(array('product_id'=>$values['product_id']));
            if( $res_variants['status'] == 'true' ) {
                $data->variants = $res_variants['data'];
            }
            else {
                $data->variants = array();
            }
            $res_images = $this->get_productImagesByProduct(array('product_id'=>$values['product_id']));
            if( $res_images['status'] == 'true' ) {
                $data->images = $res_images['data'];
            }
            else {
                $data->images = array();
            }
            
            $response = array('status'=>'true', 'message'=>'Records Found', 'data'=>$data);
        }
        else {
            $response = array('status'=>'false', 'message'=>'No Records Found', 'data'=>array());
        }
        
        return $response;
    }
    
    public function get_productVariantsByProduct($values)
    {
        $response = array();
        
        $this->db->select('PV.product_variant_id, PV.product_id, PV.mrp, PV.sp, PV.stock, PV.status, 
                PV.size_id, S.title as size_title, 
                PV.color_id, C.color_name');
        $this->db->from('product_variants PV');
        $this->db->where('PV.status', '1');
        $this->db->where('PV.product_id', $values['product_id']);
        $this->db->join('sizes S', 'S.size_id = PV.size_id', 'left');
        $this->db->join('colors C', 'C.color_id = PV.color_id', 'left');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            $data = $query->result();
            
            $response = array('status'=>'true', 'message'=>'Records Found', 'data'=>$data);
        }
        else {
            $response = array('status'=>'false', 'message'=>'No Records Found', 'data'=>array());
        }
        
        return $response;
    }
    
    public function get_productImagesByProduct($values)
    {
        $response = array();
        
        $this->db->select('PI.product_image_id, PI.product_id, PI.product_variant_id, PI.sort_order, CONCAT("uploads/images/product/",PI.image) as image, PI.status');
        $this->db->from('product_images PI');
        $this->db->where('PI.status', '1');
        $this->db->where('PI.product_id', $values['product_id']);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            $data = $query->result();
            
            $response = array('status'=>'true', 'message'=>'Records Found', 'data'=>$data);
        }
        else {
            $response = array('status'=>'false', 'message'=>'No Records Found', 'data'=>array());
        }
        
        return $response;
    }
}
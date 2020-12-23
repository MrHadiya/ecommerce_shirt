<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_brands()
    {
        $output = array();
        
        $this->db->select('B.brand_id, B.brand_name, B.image, B.status');
        $this->db->from('brands B');
        $this->db->where('B.status !=', '0');
        $this->db->order_by('B.brand_name', 'ASC');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            $data = $query->result();
            
            $output = array('status'=>'true', 'message'=>'Records Found', 'data'=>$data);
        }
        else {
            $output = array('status'=>'false', 'message'=>'No Records Found', 'data'=>array());
        }
        
        return $output;
    }
    
    public function isexist_brand($values)
    {
        $output = array();
        
        $this->db->select('B.brand_id, B.brand_name, B.image, B.status');
        $this->db->from('brands B');
        $this->db->where('B.status !=', '0');
        $this->db->where('LOWER(B.brand_name)', $values['brand_name']);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            $data = $query->result();

            $output = array('status'=>'true', 'message'=>'Records Found', 'data'=>$data);
        }
        else {
            $output = array('status'=>'false', 'message'=>'No Records Found', 'data'=>array());
        }
        
        return $output;
    }
    
    function add_brand($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $res = $this->db->insert('brands', $values);
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status'=>'true', 'message'=>'Success', 'data'=>array('new_brand_id'=>$new_inserted_id));
            }
            else {
                $output = array('status'=>'false', 'message'=>'Something Wrong!', 'data'=>array());
            }
        }
        else {
            $output = array('status'=>'false', 'message'=>'Form Data can not be empty.', 'data'=>array());
        }
        
        return $output;
    }
    
    public function delete_brand($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('brand_id', $values['brand_id']);
            $res = $this->db->delete('brands');
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $output = array('status'=>'true', 'message'=>'Brand Deleted Successfully');
            }
            else {
                $output = array('status'=>'false', 'message'=>'Something Wrong!');
            }
        }
        else {
            $output = array('status'=>'false', 'message'=>'Form Data can not be empty.');
        }
        
        return $output;
    }
    
    public function get_brandByValue($values = array())
    {
        $output = array();
        
        $this->db->select('B.brand_id, B.brand_name, B.image, B.status');
        $this->db->from('brands B');
        $this->db->where('B.status !=', '0');
        if( isset($values['status']) ) {
            $this->db->where('B.status', $values['status']);
        }
        if( isset($values['brand_id']) ) {
            $this->db->where('B.brand_id', $values['brand_id']);
        }
        $this->db->order_by('B.brand_name', 'ASC');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            $data = $query->result();
            
            $output = array('status'=>'true', 'message'=>'Records Found', 'data'=>$data);
        }
        else {
            $output = array('status'=>'false', 'message'=>'No Records Found', 'data'=>array());
        }
        
        return $output;
    }
}
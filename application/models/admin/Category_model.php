<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_categories()
    {
        $output = array();
        
        $this->db->select('C.category_id, C.category_name, C.image, C.status');
        $this->db->from('categories C');
        $this->db->where('C.status !=', '0');
        $this->db->order_by('C.category_name', 'ASC');
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
    
    public function isexist_category($values)
    {
        $output = array();
        
        $this->db->select('C.category_id, C.category_name, C.image, C.status');
        $this->db->from('categories C');
        $this->db->where('C.status !=', '0');
        $this->db->where('LOWER(C.category_name)', $values['category_name']);
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
    
    function add_category($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $res = $this->db->insert('categories', $values);
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status'=>'true', 'message'=>'Success', 'data'=>array('new_category_id'=>$new_inserted_id));
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
    
    public function update_category($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('category_id', $values['category_id']);
            $res = $this->db->update('categories', $values);
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $output = array('status'=>'true', 'message'=>'Success');
            }
            else {
                $output = array('status'=>'false', 'message'=>'Something Wrong!');
            }
        }
        else {
            $output = array('status'=>'false', 'message'=>'Form Data can not be empty.', 'data'=>array());
        }
        
        return $output;
    }
    
    public function delete_category($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('category_id', $values['category_id']);
            $res = $this->db->delete('categories');
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $output = array('status'=>'true', 'message'=>'Category Deleted Successfully');
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
    
    public function get_categoryByValue($values = array())
    {
        $output = array();
        
        $this->db->select('C.category_id, C.category_name, C.image, C.status');
        $this->db->from('categories C');
        $this->db->where('C.status !=', '0');
        if( isset($values['status']) ) {
            $this->db->where('C.status', $values['status']);
        }
        if( isset($values['category_id']) ) {
            $this->db->where('C.category_id', $values['category_id']);
        }
        $this->db->order_by('C.category_name', 'ASC');
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
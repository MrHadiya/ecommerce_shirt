<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Size_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_sizes()
    {
        $response = array();
        
        $this->db->select('S.size_id, S.title as size_name, S.status');
        $this->db->from('sizes S');
        $this->db->where('S.status !=', '0');
        $this->db->order_by('S.title', 'ASC');
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
    
    public function isexist_size($values)
    {
        $output = array();
        
        $this->db->select('S.size_id, S.title as size_name, S.status');
        $this->db->from('sizes S');
        $this->db->where('S.status !=', '0');
        $this->db->where('LOWER(S.title)', $values['size_name']);
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
    
    function add_size($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $res = $this->db->insert('sizes', $values);
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status'=>'true', 'message'=>'Success', 'data'=>array('new_size_id'=>$new_inserted_id));
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
    
    public function update_size($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('size_id', $values['size_id']);
            $res = $this->db->update('sizes', $values);
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
    
    public function delete_size($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('size_id', $values['size_id']);
            $res = $this->db->delete('sizes');
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $output = array('status'=>'true', 'message'=>'Size Deleted Successfully');
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
    
    public function get_sizeByValue($values = array())
    {
        $output = array();
        
        $this->db->select('S.size_id, S.title as size_name, S.status');
        $this->db->from('sizes S');
        $this->db->where('S.status !=', '0');
        if( isset($values['status']) ) {
            $this->db->where('S.status', $values['status']);
        }
        if( isset($values['size_id']) ) {
            $this->db->where('S.size_id', $values['size_id']);
        }
        $this->db->order_by('S.title', 'ASC');
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

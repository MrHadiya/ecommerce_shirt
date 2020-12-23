<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colors_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_colors()
    {
        $output = array();
        
        $this->db->select('C.color_id, C.color_name, C.color_code, C.status');
        $this->db->from('colors C');
        $this->db->where('C.status !=', '0');
        $this->db->order_by('C.color_name', 'ASC');
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
    
    public function isexist_color($values)
    {
        $output = array();
        
        $this->db->select('C.color_id, C.color_name, C.color_code, C.status');
        $this->db->from('colors C');
        $this->db->where('C.status !=', '0');
        $this->db->where('LOWER(C.color_code)', $values['color_code']);
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
    
    function add_color($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $res = $this->db->insert('colors', $values);
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status'=>'true', 'message'=>'Success', 'data'=>array('new_color_id'=>$new_inserted_id));
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
    
    public function delete_color($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('color_id', $values['color_id']);
            $res = $this->db->delete('colors');
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $output = array('status'=>'true', 'message'=>'Color Deleted Successfully');
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
    
    public function get_colorByValue($values = array())
    {
        $output = array();
        
        $this->db->select('C.color_id, C.color_name, C.color_code, C.status');
        $this->db->from('colors C');
        $this->db->where('C.status !=', '0');
        if( isset($values['status']) ) {
            $this->db->where('C.status', $values['status']);
        }
        if( isset($values['color_id']) ) {
            $this->db->where('B.color_id', $values['color_id']);
        }
        $this->db->order_by('C.color_name', 'ASC');
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
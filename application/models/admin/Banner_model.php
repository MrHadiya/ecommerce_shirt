<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_banners()
    {
        $response = array();
        
        $this->db->select('B.banner_id, B.banner_title, B.description, B.link, B.sort_order, CONCAT("uploads/images/banner/", B.image) as image, B.status');
        $this->db->from('banners B');
        $this->db->where('B.status !=', '0');
        $this->db->order_by('B.sort_order', 'ASC');
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
    
    function add_banner($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $res = $this->db->insert('banners', $values);
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $new_inserted_id = $this->db->insert_id();
                $output = array('status'=>'true', 'message'=>'Success', 'data'=>array('new_banner_id'=>$new_inserted_id));
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
    
    public function update_banner($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('banner_id', $values['banner_id']);
            $res = $this->db->update('banners', $values);
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
    
    public function delete_banner($values = array())
    {
        $output = array();
        
        if( is_array($values) == true || count($values) > 0 ) {
            $this->db->where('banner_id', $values['banner_id']);
            $res = $this->db->delete('banners');
            if( $this->db->affected_rows() > 0 && $res == true ) {
                $output = array('status'=>'true', 'message'=>'Banner Deleted Successfully');
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
    
    public function get_bannerByValue($values = array())
    {
        $output = array();
        
        $this->db->select('B.banner_id, B.banner_title, B.description, B.link, B.sort_order, CONCAT("uploads/images/banner/", B.image) as image, B.status');
        $this->db->from('banners B');
        $this->db->where('B.status !=', '0');
        if( isset($values['status']) ) {
            $this->db->where('B.status', $values['status']);
        }
        if( isset($values['banner_id']) ) {
            $this->db->where('B.banner_id', $values['banner_id']);
        }
        $this->db->order_by('B.sort_order', 'ASC');
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

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
        
        $this->db->select('B.banner_id, B.banner_title, B.description, B.link, B.sort_order, B.image, B.status');
        $this->db->from('banners B');
        $this->db->where('B.status', '1');
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
}

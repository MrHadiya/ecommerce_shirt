<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function login($values = array())
    {
        $output = array();
        
        $this->db->select('A.admin_id, A.first_name, A.last_name, A.email, A.contact_no, A.status');
        $this->db->from('admins A');
        //$this->db->where('A.status', '1');
        $this->db->where('A.email', $values['email']);
        $this->db->where('A.password', $values['password']);
        $this->db->limit(1);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            $data = $query->result();
            if( $data[0]->status != 1 ) {
                $output = array('status'=>'false', 'message'=>'Your account deactivated.', 'data'=>array());
            }
            else {
                $session_data = array(
                    'adminid' => $data[0]->admin_id, 
                    'name' => $data[0]->first_name.' '.$data[0]->last_name
                );
                $this->session->set_userdata($session_data);
                $output = array('status'=>'true', 'message'=>'Login Successfully', 'data'=>$session_data);
            }
        }
        else {
            $output = array('status'=>'false', 'message'=>'The email or password you have entered is incorrect', 'data'=>array());
        }
        
        return $output;
    }
}

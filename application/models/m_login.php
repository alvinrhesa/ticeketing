<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_login extends CI_Model {

    public function cek_user(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $query = $this->db->where('username',$username)
                          ->where('password',$password)
                          ->get('tb_admin');

        if($this->db->affected_rows() > 0){

            $data_login = $query->row();

            $data_session = array(
                                'username'=> $data_login->username,
                                'password'=> $data_login->password,
                                'logged_in'=> TRUE,
            );
            $this->session->set_userdata($data_session);

            return TRUE;
        }else{
            return FALSE;
        }
    }

	
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */
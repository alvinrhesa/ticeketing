<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_admin extends CI_Model {

	public function insert($id_admin){
		$data = array(
			'id_admin'  	=> $this->input->post('id_admin'),
			'fullname'		=> $this->input->post('fullname'),
			'username'		=> $this->input->post('username'),
			'password'		=> $this->input->post('password'),
			'email' 		=> $this->input->post('email'),
			'no_telp'	    => $this->input->post('no_telp')
			// 'D_CREATED'		=> date('Ymd')
			 );

		$this->db->insert('tb_admin', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function generateID(){
		$query = $this->db->order_by('ID_ADMIN', 'DESC')->limit(1)->get('tb_admin')->row('ID_ADMIN');
		$lastNo = substr($query, 3);
		$next = $lastNo + 1;
		$kd = 'AGT';
		return $kd.sprintf('%03s', $next);
	}

	public function getList(){
		return $query = $this->db->order_by('id_admin','ASC')->get('tb_admin')->result();
	}

	public function getCount(){
		return $this->db->count_all('tb_admin');
	}

	public function getDetail($id){
		return $this->db->where('ID_ADMIN', $id)->get('tb_admin')->row();
	}

	public function checkAvailability($id){
		$query = $this->db->where('ID_ADMIN', $id)->get('tb_admin');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function update($id_admin){
		$data = array(
			'id_admin'=>$this->input->post('id_admin'),
			'username'=>$this->input->post('username'),
			'password'=>$this->input->post('password'),
			'fullname'=>$this->input->post('fullname'),
			'email'=>$this->input->post('email'),
			'no_telp'=>$this->input->post('no_telp')
			);
		$this->db->where('id_admin', $id_admin)->update('tb_admin', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where('id_admin', $id)->delete('tb_admin');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */
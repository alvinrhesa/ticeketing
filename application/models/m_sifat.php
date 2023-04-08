<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_sifat extends CI_Model {

  public function get_sifat()
  {
			$data_sifat= $this->db
							->get('tb_sifat')
							->result();
     		return $data_sifat;
  } 

  public function generateID(){
		$query = $this->db->order_by('ID_id_sifat', 'DESC')->limit(1)->get('tb_sifat')->row('id_sifat');
		$lastNo = substr($query, 3);
		$next = $lastNo + 1;
		$kd = 'AGT';
		return $kd.sprintf('%03s', $next);
	}

	public function getList(){
		return $query = $this->db->order_by('id_sifat','ASC')->get('tb_sifat')->result();
	}

	public function getCount(){
		return $this->db->count_all('tb_sifat');
	}

	public function getDetail($id_sifat){
		return $this->db->where('id_sifat', $id_sifat)->get('tb_sifat')->row();
	}

	public function checkAvailability($id_sifat){
		$query = $this->db->where('id_sifat', $id_sifat)->get('tb_sifat');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function add_sifat()
	{
	  $data_sifat=array(
		'id_sifat'=>$this->input->post('id_sifat'),
		'nama_sifat'=>$this->input->post('nama_sifat')
	  ); 
	  $ql_masuk=$this->db->insert('tb_sifat', $data_sifat);
	  return $ql_masuk;
	}

	
	public function update($id_sifat){
		$data = array(
			'id_sifat'=>$this->input->post('id_sifat'),
			'nama_sifat'=>$this->input->post('nama_sifat')
			);
		$this->db->where('id_sifat', $id_sifat)->update('tb_sifat', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where('id_sifat', $id);
		return $this->db->delete('tb_sifat');
	}

}
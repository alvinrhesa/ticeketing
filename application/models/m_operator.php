<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_operator extends CI_Model {

  public function get_operator()
  {
			$data_operator= $this->db
							->get('tb_operator')
							->result();
     		return $data_operator;
  } 

  public function generateID(){
		$query = $this->db->order_by('ID_id_operator', 'DESC')->limit(1)->get('tb_operator')->row('id_operator');
		$lastNo = substr($query, 3);
		$next = $lastNo + 1;
		$kd = 'AGT';
		return $kd.sprintf('%03s', $next);
	}

	public function getList(){
		return $query = $this->db->order_by('id_operator','ASC')->get('tb_operator')->result();
	}

	public function getCount(){
		return $this->db->count_all('tb_operator');
	}

	public function getDetail($id_operator){
		return $this->db->where('id_operator', $id_operator)->get('tb_operator')->row();
	}

	public function checkAvailability($id_operator){
		$query = $this->db->where('id_operator', $id_operator)->get('tb_operator');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function add_operator()
	{
	  $data_operator=array(
		'id_operator'=>$this->input->post('id_operator'),
		'nama_operator'=>$this->input->post('nama_operator')
	  ); 
	  $ql_masuk=$this->db->insert('tb_operator', $data_operator);
	  return $ql_masuk;
	}

	
	public function update($id_operator){
		$data = array(
			'id_operator'=>$this->input->post('id_operator'),
			'nama_operator'=>$this->input->post('nama_operator')
			);
		$this->db->where('id_operator', $id_operator)->update('tb_operator', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where('id_operator', $id);
		return $this->db->delete('tb_operator');
	}

}
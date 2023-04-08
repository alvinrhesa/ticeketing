<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_kunci extends CI_Model {

  public function get_kunci()
  {
      $data_kunci= $this->db->join('tb_operator', 'tb_operator.id_operator=tb_kunci.id_operator')->get('tb_kunci')->result();
      return $data_kunci;
  }

  public function input_kunci()
  {
    $data_kunci=array(
      'Id'=>$this->input->post('Id'),
      'no_kunci'=>$this->input->post('no_kunci'),
      'nama_site'=>$this->input->post('nama_site'),
      'id_operator'=>$this->input->post('id_operator'),
      'kepada'=>$this->input->post('kepada'),
      'tempat'=>$this->input->post('tempat'),
      'lampiran'=>$this->input->post('lampiran'),
      'tempatt'=>$this->input->post('tempatt'),
      'acara'=>$this->input->post('acara'),
      'deskripsi'=>$this->input->post('deskripsi'),
      'id_sifat'=>$this->input->post('id_sifat'),
      'stts' => 'Tersedia'
    );
    $ql_masuk=$this->db->insert('tb_kunci', $data_kunci);
    return $ql_masuk;
  }

  public function checkAvailability($id_kunci){
		$query = $this->db->where('Id', $id_kunci)->get('tb_kunci');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
  }
  
  public function getDetail($id_kunci){
    return $this->db->join('tb_operator', 'tb_operator.id_operator=tb_kunci.id_operator')
                    ->where('Id', $id_kunci)
                    ->get('tb_kunci')
                    ->row();

    
	}
  

  public function update_kunci($Id)
  {
    $dt_up_kunci=array(
      'Id'=>$this->input->post('Id'),
      'no_kunci'=>$this->input->post('no_kunci'),
      'nama_site'=>$this->input->post('nama_site'),
      'id_operator'=>$this->input->post('id_operator'),
      'kepada'=>$this->input->post('kepada'),
      'tempat'=>$this->input->post('tempat'),
      'lampiran'=>$this->input->post('lampiran'),
      'tempatt'=>$this->input->post('tempatt'),
      'acara'=>$this->input->post('acara'),
      'deskripsi'=>$this->input->post('deskripsi'),
    );
    return $this->db->where('Id',$this->input->post('Id'))->update('tb_kunci', $dt_up_kunci);
  }

  public function delete($id){
		$this->db->where('Id', $id)->delete('tb_kunci');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
  }
  
}

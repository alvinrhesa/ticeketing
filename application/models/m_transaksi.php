<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_transaksi extends CI_Model {
    
  public function getList(){
    $query = $this->db->join('tb_kunci','tb_kunci.Id=tb_peminjaman.Id')
          ->join('tb_operator','tb_kunci.id_operator=tb_operator.id_operator')
          ->where('status != "Belum Kembali"')
          ->get('tb_peminjaman')
          ->result();
    return $query;
  }

  public function getCount(){
		return $this->db->count_all('tb_peminjaman');
  }
  public function detail_laporan(){
    $data_peminjaman= $this->db->join('tb_kunci','tb_kunci.Id=tb_peminjaman.Id')
                               ->where('status != "Belum Kembali"')
                               ->get('tb_peminjaman')
                               ->result();
  return $data_peminjaman;
  }

  public function delete($id){
		$this->db->where('id_peminjaman', $id);
		return $this->db->delete('tb_peminjaman');
	}

}

/* End of file kategori_model.php */
/* Location: ./application/models/kategori_model.php */
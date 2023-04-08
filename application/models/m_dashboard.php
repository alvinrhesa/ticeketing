<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_dashboard extends CI_Model {

    public function getKncCount(){
		return $this->db->count_all('tb_kunci');
	}

	public function getOptCount(){
		return $this->db->count_all('tb_operator');
	}

    public function getPinjamCount(){
		return $this->db->where('status', 'Belum Kembali')->from('tb_peminjaman')->count_all_results();
	}

	public function getKmbCount(){
		return $this->db->where('status', 'Sudah Kembali')->from('tb_peminjaman')->count_all_results();
    }
    

}
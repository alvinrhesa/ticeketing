<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pengembalian extends CI_Model {

    public function getList(){
        $query = $this->db->join('tb_kunci','tb_kunci.Id=tb_peminjaman.Id')
						  ->where('status != "Sudah Kembali"')
						  ->get('tb_peminjaman')
						  ->result();
        return $query;
    }

    public function getCount(){
		return $this->db->count_all('tb_peminjaman');
	}

	public function delete_peminjaman($id_peminjaman)
	{
		$delete = $this->db->where('id_peminjaman',$id_peminjaman)->delete('tb_peminjaman');
		return $delete;
	}

	public function kembali($id, $idk)
	{
		$data = array('tgl_kembali' => date("Y-m-d"),
					  'status' => 'Sudah Kembali'
					);
		$this->db->where('id_peminjaman',$id)->update('tb_peminjaman',$data);

        $value = array('stts' => 'Tersedia');
		$statusValue = $this->db->where('Id', $idk)->update('tb_kunci', $value);
		
        
		$this->db->affected_rows() > 0 ? $r = TRUE : $r = FALSE;
		return $r;
	}

}

/* End of file kategori_model.php */
/* Location: ./application/models/kategori_model.php */
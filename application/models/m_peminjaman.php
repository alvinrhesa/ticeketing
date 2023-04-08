<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_peminjaman extends CI_Model {

    public function generateID(){
        $today = date('ymd');
        $query = $this->db->join('tb_kunci', 'tb_kunci.Id=tb_peminjaman.Id')
                          ->join('tb_operator', 'tb_operator.id_operator=tb_kunci.id_operator')
                          ->order_by('id_peminjaman', 'desc')
                          ->limit(1)
                          ->get('tb_peminjaman')
                          ->row('id_peminjaman');
        $lastDate = substr($query, 1, 6);
        $lastNumber = (int) substr($query, -3);
        $nowID = $today === $lastDate ? $lastNumber + 1 : 1;
        $nowID = 'P'.$today.sprintf('%03s', $nowID);
        return $nowID;
    }

    public function getKncList(){
        $query = $this->db->where('stts = "Tersedia"')->order_by('Id', 'asc')->get('tb_kunci')->result();
        return $query;
    }

    public function getOprList(){
        $query = $this->db->get('tb_operator')->result();
        return $query;
    }

    public function cariOperator($kode){
        $hm = $this->db->where('nama_operator', $kode)->get('tb_operator');
        return $hm;
    }


    public function cariNomor($kode){
        $hm = $this->db->where('Id', $kode)->get('tb_kunci');
        return $hm;
    }

    public function getAdmID(){
        return $this->db->where('username', $this->session->userdata('username'))
                        ->get('tb_admin')->row('id_admin');
    }

    public function insert(){
        $pinjam = array(
            'id_peminjaman'     => $this->input->post('id_peminjaman'),
            'nama_peminjam'     => $this->input->post('nama_peminjam'),
            'telp_peminjam'     => $this->input->post('telp_peminjam'),
            'no_identitas'      => $this->input->post('no_identitas'),
            'nama_ins'          => $this->input->post('nama_ins'),
            'nama_ptgs'         => $this->input->post('nama_ptgs'),
            'tgl_pinjam'        => date('Y-m-d'),
            'jam_pinjam'        => $this->input->post('jam_pinjam'),
            'Id'                => $this->input->post('brow'),
            'status'            => 'Belum Kembali'
        );
        $this->db->insert('tb_peminjaman', $pinjam);
        
        $Id = $this->input->post('brow');
        $value = array(
            'stts' => 'Dipinjam'
        );
        $statusValue = $this->db->where('Id', $Id)
                 ->update('tb_kunci', $value);
                 
        $this->db->affected_rows() > 0 ? $y = true : $y = false;
        return $y;
    }

}
?>
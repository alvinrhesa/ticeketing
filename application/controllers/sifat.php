<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sifat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_sifat');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['title'] = 'Data sifat'; 
        $data['list'] = $this->m_sifat->getList();
        $this->load->model('m_sifat');
		$data['konten'] = 'v_sifat';
		$data['total'] = $this->m_sifat->getCount();
		$this->load->view('template', $data);
	}

	public function add(){
        $this->load->model('m_sifat');
        $data['data_sifat']=$this->m_sifat->get_sifat();
		$data['title'] = 'Tambah sifat';
		$data['konten'] = 'v_sifat_tambah';
		$this->load->view('template', $data);
	}

	public function submit_sifat()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->form_validation->set_rules('id_sifat', 'ID sifat', 'trim|required',
			array('required' => 'ID sifat harus diisi'));
			$this->form_validation->set_rules('nama_sifat', 'Nama sifat', 'trim|required',
			array('required' => 'Nama sifat harus diisi'));
			if ($this->form_validation->run() == TRUE )
			{
				$this->load->model('m_sifat', 'opt');
				$masuk=$this->opt->add_sifat();
				if($masuk==true){
					$this->session->set_flashdata('announce', 'sukses masuk');
				} else{
					$this->session->set_flashdata('announce', 'gagal masuk');
				}
				redirect(base_url('index.php/sifat'), 'refresh');
			}else{
			$this->session->set_flashdata('announce', validation_errors());
			redirect(base_url('index.php/sifat'), 'refresh');}
		} else{
			redirect('login');	
		}
	}

	public function submit_edit(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('id_sifat', 'ID sifat', 'trim|required');
			$this->form_validation->set_rules('nama_sifat', 'Nama sifat', 'trim|required');
			if ($this->form_validation->run() == true) {
				if($this->m_sifat->update($this->input->post('id_sifat')) == true){
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('sifat');
				}else{
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('sifat/edit?idtf='.$this->input->post('id_sifat'));
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('sifat/edit?idtf='.$this->input->post('id_sifat'));
			}
		}
	}

	public function edit(){
		$id_sifat = $this->input->get('idtf');
		//CHECK : Data Availability
		if($this->m_sifat->checkAvailability($id_sifat) == true){
			if($this->m_sifat->getDetail($id_sifat) == true){
				$data['konten'] = 'v_sifat_edit';
			}else{
				$data['konten'] = 'v_dashboard';
			}
		$data['title'] = 'Edit sifat';
		$data['detail'] = $this->m_sifat->getDetail($id_sifat);
		$this->load->view('template', $data);
		}
	}

	public function delete(){
		$id = $this->uri->segment(3);
		if($this->m_sifat->delete($id) == true){
			$this->session->set_flashdata('announce', 'Berhasil menghapus data');
			redirect('sifat');
		}else{
			$this->session->set_flashdata('announce', 'Gagal menghapus data');
			redirect('sifat');
		}
	}
}

/* End of file sifat.php */
/* Location: ./application/controllers/sifat.php */
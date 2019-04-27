<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perpustakaan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->load->model('DataMaster_Buku');
		$this->load->model('DataMaster_Anggota');

		$this->md_buku = $this->DataMaster_Buku;
		$this->md_ang = $this->DataMaster_Anggota;
	}
	public function index()
	{
		redirect( base_url() );
	}
	public function listBuku()
	{
		$data['buku'] = $this->md_buku->list_all();
		//var_dump($data);
		$this->load->view('admin/dashboard/petugas/master_buku',$data);
	}
	public function listAnggota()
	{
		$data['anggota'] = $this->md_ang->list_all();
		//var_dump($data);
		$this->load->view('admin/dashboard/petugas/master_anggota',$data);
	}
	public function addNew()
	{
		if( empty($this->uri->segment('3'))) {
			redirect( base_url() );
		}

		$cek=$this->uri->segment('3');
		//var_dump($cek);

		switch ($cek) {
			case 'buku':
				if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$judul= $this->security->xss_clean( $this->input->post('judul'));
					$penerbit= $this->security->xss_clean( $this->input->post('penerbit'));
					$pengarang= $this->security->xss_clean( $this->input->post('pengarang'));
					$tahun= $this->security->xss_clean( $this->input->post('tahun'));

					// validasi
					$this->form_validation->set_rules('judul', 'Judul Buku', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Menambah data Buku');
						redirect( base_url('Perpustakaan/listBuku') );
					}

		            $data['JudulBuku'] = $judul;
					$data['Pengarang'] = $pengarang;
					$data['Penerbit'] = $penerbit;
					$data['TahunTerbit'] = $tahun;
					$this->md_buku->tambahBuku($data);

					redirect(base_url('Perpustakaan/listBuku'));
				}
				break;
			default:
				redirect( base_url() );
				break;
		}
	}
	public function hapus()
	{
		if( empty($this->uri->segment('3'))) {
			redirect( base_url() );
		}

		if( empty($this->uri->segment('4'))) {
			redirect( base_url() );
		}

		$cek = $this->uri->segment('3');
		$id = $this->uri->segment('4');
		//var_dump($id);

		switch ($cek) {
			case 'buku':
				$this->md_buku->hapusBuku($id);
			    redirect(base_url('Perpustakaan/listBuku'));
			break;
			default:
				redirect( base_url() );
			break;
		}
	}
	public function update()
	{
		if( empty($this->uri->segment('3'))) {
			redirect( base_url() );
		}
		$cek = $this->uri->segment('3');
		//var_dump($cek);

		switch ($cek) {
			case 'buku':
				if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$id= $this->security->xss_clean( $this->input->post('id'));
					$judul= $this->security->xss_clean( $this->input->post('judul'));
					$penerbit= $this->security->xss_clean( $this->input->post('penerbit'));
					$pengarang= $this->security->xss_clean( $this->input->post('pengarang'));
					$tahun= $this->security->xss_clean( $this->input->post('tahun'));

					// validasi
					$this->form_validation->set_rules('judul', 'Judul Buku', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Menambah data Buku');
						redirect( base_url('Perpustakaan/listBuku') );
					}

					$data['JudulBuku'] = $judul;
					$data['Pengarang'] = $pengarang;
					$data['Penerbit'] = $penerbit;
					$data['TahunTerbit'] = $tahun;

					// var_dump($data);
					$this->md_buku->updateBuku($id,$data);
					redirect(base_url('Perpustakaan/listBuku'));
				}
			break;
			default:
				redirect( base_url() );
				break;
		}
	}
}

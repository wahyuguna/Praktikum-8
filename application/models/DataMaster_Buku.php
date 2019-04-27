<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMaster_Buku extends CI_Model {

	public function list_all() {
		$data = $this->db->select('b.*')
					 ->from('buku as b')
					 ->get();
		return $data->result();
	}
	public function tambahBuku($data)
	{
		$this->db->insert('buku', $data);
		$this->session->set_flashdata('msg_alert', 'Data Buku berhasil ditambahkan');
	}
	public function hapusBuku($id)
    {
	  	$this->db->where('Kd_Register',$id)
				 ->delete('buku');
	  	$this->session->set_flashdata('msg_alert', 'Data Buku berhasil dihapus');
    }
    public function updateBuku($id,$data)
    {
		$this->db->where('Kd_Register',$id)
				 ->update('buku', $data);
		$this->session->set_flashdata('msg_alert', 'Data Buku berhasil diupdate');
    }
}

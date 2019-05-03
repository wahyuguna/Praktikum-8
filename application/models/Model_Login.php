<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Login extends CI_Model {

	function validate($username,$password){
	    $this->db->where('username',$username);
	    $this->db->where('password',$password);
	    $result = $this->db->get('tb_user',1);
	    return $result;
	}
	public function logout($date, $id)
    {
        $this->db->where('Kd_Petugas', $id);
        $this->db->update('petugas', $date);
    }
    public function tambahPetugas($data,$item)
	{
		$this->db->insert('petugas', $data);

		$x = $this->db->select('*')
				  ->from('petugas')
				  ->order_by('Kd_Petugas','desc')
				  ->limit(1)
				  ->get();
		
		$id = $x->row()->Kd_Petugas;
		$item['id'] = $id;
		$this->db->insert('tb_user', $item);

		$this->session->set_flashdata('msg_alert', 'Daftar Sebagai Petugas Perpustaan Berhasil');
	}
}

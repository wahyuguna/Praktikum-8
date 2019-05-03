<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');

		$this->load->model('Model_Login');

		$this->md_login = $this->Model_Login;
	}
	function index(){
	    $this->load->view('login');
	}
	public function viewRegis()
	{
		$this->load->view('register');
	}

	public function register()
	{
		if( $_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->input->post('password') == $this->input->post('conpassword')) 
			{
				$password= $this->security->xss_clean( $this->input->post('password'));
				$username= $this->security->xss_clean( $this->input->post('username'));
				$nama= $this->security->xss_clean( $this->input->post('nama'));
				$alamat= $this->security->xss_clean( $this->input->post('alamat'));

				// validasi
				$this->form_validation->set_rules('username', 'Username', 'required');
				if(!$this->form_validation->run()) {
					$this->session->set_flashdata('msg_alert_error', 'Gagal Register Sebagai Petugas');
					redirect( base_url('Login/viewRegis') );
				}

		        $data['password'] = md5($password);
				$data['username'] = $username;
				$data['nama'] = $nama;
				$data['alamat'] = $alamat;

				$item['password'] = md5($password);
				$item['username'] = $username;
				$item['level'] = 1;

				$this->md_login->tambahPetugas($data,$item);

				redirect( base_url('Login/index') );
			}
			else
			{
				$this->session->set_flashdata('msg_alert_error', 'Gagal Register Sebagai Petugas');
				redirect( base_url('Login/viewRegis') );
			}
		}
	}

	function auth(){
	    $username    = $this->input->post('username',TRUE);
	    $password = md5($this->input->post('password',TRUE));
	    $validate = $this->md_login->validate($username,$password);
	    if($validate->num_rows() > 0){
	        $data  = $validate->row_array();
	        $id  = $data['id'];
	        $username = $data['username'];
	        $level = $data['level'];
	        $sesdata = array(
	            'username'  => $username,
	            'id'     => $id,
	            'level'     => $level,
	            'logged_in' => TRUE
	        );
	        $this->session->set_userdata($sesdata);
	        // access login for Petugas
	        if($level === '1'){
	            redirect( base_url('Perpustakaan/petugas') );
	        }
	        // access login for Anggota
	        // }elseif($level === '2'){
	        //     redirect( base_url('Perpustakaan/anggota') );
	        // }
	    }else{
	        echo $this->session->set_flashdata('msg_alert_error','Username or Password Salah');
	        redirect(base_url('Login/index'));
	    }
	}

	function logout(){

		date_default_timezone_set("ASIA/JAKARTA");
        $date = array('last_login' => date('Y-m-d H:i:s'));
        $id = $this->session->userdata('id');
        $this->md_login->logout($date, $id);

	    $this->session->sess_destroy();
	    redirect(base_url('Login/index'));
	}
}

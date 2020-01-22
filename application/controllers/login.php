<?php
class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
		$this->load->view('auth/log');
	}
 
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_login->cek_login("user",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("auth/"));
 
		}else{

 echo "username atau password salah";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth/login'));
	}

	function register(){
		$this->load->view('auth/register');
	}




		function tambahuser(){

			$username = $this->input->post('username');
			$gender = $this->input->post('gender');
			$password = $this->input->post('password');
			

			$dataa = array(
				'username' => $username,
				'gender' => $gender,
				'password' => md5($password),
				
			);

			$this->tambahuser->input_data($dataa,'user');
			redirect('auth/log');
		}

}



?>
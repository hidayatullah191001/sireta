<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if($this->session->userdata('username'))
		{
			redirect('user');
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Halaman masuk';
			$this->load->view('auth/header', $data);
			$this->load->view('auth/login');
			$this->load->view('auth/footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        //jika usernya aktig
        if ($user) {
            //jika user aktif
            if ($user['status'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if($user['role_id'] == 1){
                        redirect('admin');
                    }elseif ($user['role_id'] == 2) {
                    	redirect('user');
                    }else{
                       	redirect('manager');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class=" mt-3 alert alert-danger">
                     Password salah!
                     </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="mt-3 alert alert-danger ">
                    Akun ini belum aktif. Hubungi CS!
                    </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="mt-3 alert alert-danger">
                Akun ini tidak terdaftar!
                </div>');
            redirect('auth');
        }
    }

	/*public function register()
	{
		if($this->session->userdata('username'))
		{
			redirect('user');
		}
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Nama tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'Nama pengguna ini sudah pernah didaftarkan!',
			'required' => 'Nama pengguna tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'required'=> 'Kata sandi tidak boleh kosong!',
			'matches' => 'Kata sandi tidak sama!',
			'min_length' => 'Kata sandi terlalu pendek. Min 8 char!'
		]);
		$this->form_validation->set_rules('password2', 'Passoword', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Daftar Akun';
			$this->load->view('auth/header2', $data);
			$this->load->view('auth/register');
			$this->load->view('auth/footer');
		}else{
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'image' => 'default.png',
				'role_id' => 2,
				'status' => 1,
				'date_created' =>time()
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="mt-3 alert alert-success">
				Akun berhasil dibuat, silahkan login.
				</div>');
			redirect('auth');
		}
	}*/

	public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="mt-3 alert alert-success">Berhasil keluar! </div>');
        redirect('auth');
    }
}

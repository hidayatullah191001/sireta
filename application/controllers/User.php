<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username', 'role_id')) {
			$data = base_url();
			$this->session->unset_userdata('username', 'role_id');
			$this-> session ->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect($data);
		}
		$userdata = $this->session->userdata();
		if ($userdata['role_id'] != 2) {
			$data = base_url();
			$this->session->unset_userdata('username', 'role_id');
			$this-> session ->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect($data);
		}
		$this->load->library('form_validation');
		$this->load->model('User_model');
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['role'] = $this->db->get('user_role')->result();
		$data['kategori'] = $this->User_model->getKategori();
		$data['title'] = 'Dashboard';
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/index');
		$this->load->view('template/footer', $data);
	}

	public function library()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		if (isset($_GET['param']) != null) {
			$value = $_GET['param'];
			$idkategori = $value;
		}else{
			$idkategori = null;
		}
		

		$iduser = $data['user']['id'];
		$data['kategori'] = $this->User_model->getKategori();
		$data['role'] = $this->db->get('user_role')->result();

		if ($idkategori != null) {
			$data['kategoriid'] = $this->db->get_where('kategori', ['id' => $idkategori])->row_array();
			
			$data['title'] = $data['kategoriid']['kategori'];

			$id_kategori = $data['kategoriid']['id'];

			$data['list_data'] = $this->User_model->getListDataFilterKategori($id_kategori);

			//config
			$config['base_url'] = "http://localhost:8080/sireta/user/library/".$_GET['param']."/"; 
			$config['total_rows'] = $this->User_model->getCount();
			$config['per_page'] = 2;
			$config['num_links'] = 5;

			$config['attributes'] = array('class' =>'page-link');

			//initialize
			$this->pagination->initialize($config);

			$data['start'] = $this->uri->segment(4);
			$data['list_data'] = $this->User_model->getListDataPage($id_kategori, $config['per_page'],$data['start']);

			/*END PAGINATION*/

			if($this->input->post('key')){
				$data['list_data'] = $this->User_model->getSearchByKategori($id_kategori, $iduser);
			}

		}else if($idkategori == null){
			$data['title'] = "Semua Library";
			$data['list_data'] = $this->User_model->getListData();
			//config
			$config['base_url'] = "https://localhost/sireta/user/library/"; 
			$config['total_rows'] = $this->User_model->getCount();
			$config['per_page'] = 2;
			$config['num_links'] = 5;

			$config['attributes'] = array('class' =>'page-link');

			//initialize
			$this->pagination->initialize($config);

			$data['start'] = $this->uri->segment(3);
			$data['list_data'] = $this->User_model->getListDataPageAll($config['per_page'],$data['start']);

			if($this->input->post('key')){
				$data['list_data'] = $this->User_model->getSearch();
			}
		}

		$data['bookmark'] = $this->User_model->getBookmark($iduser);

		$data['total'] = $this->User_model->total2();
		$data['idkategori'] = $idkategori;
		$data['akun'] = $this->User_model->getAll();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/library', $data);
		$this->load->view('template/footer', $data);
	}

	public function profile(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->User_model->getKategori();
		$data['role'] = $this->db->get('user_role')->result();
		$id = $data['user']['id'];
		$old_username = $data['user']['username'];

		$this->form_validation->set_rules('nama', 'Nama', 'required',[
			'required' => 'Nama tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('username', 'Username', 'required',[
			'required' => ' Username tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Profile';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('user/profile', $data);
			$this->load->view('template/footer', $data);
		}else{
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$pwlama = $this->input->post('pwlama');
			$pwbaru = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

			$upload_image = $_FILES['image']['name'];

			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/profile/';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('image'))
				{
					$old_image = $data['user']['image'];
					if($old_image != 'default.png'){
						unlink(FCPATH . 'assets/profile/'. $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				}
				else
				{
					echo $this->upload->display_errors();
				}
			}

			if ($username == $old_username) {
				$this->db->set('nama', $nama);
				$this->db->where('id', $id);
				$this->db->update('user');

				$this->session->set_flashdata('message', '
					<div class="alert alert-success text-success">Profile berhasil diperbarui!
					</div>');
				redirect('user/profile');
			}else{
				$this->db->set('nama', $nama);
				$this->db->set('username', $username);
				$this->db->where('id', $id);
				$this->db->update('user');

				$this->session->unset_userdata('username');
				$this->session->unset_userdata('role_id');
				$this->session->set_flashdata('message', '
					<div class="mt-3 alert alert-success text-success">Profile berhasil diperbarui! Silahkan login kembali!
					</div>');
				redirect('auth');
			}
		}
	}

	public function hapusGambar($id)
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$old_image = $data['user']['image'];

		if($old_image != 'default.png'){
			unlink(FCPATH . 'assets/profile/'. $old_image);
		}

		$name = "default.png";
		$this->db->set('image', $name);
		$this->db->where('id', $id);
		$this->db->update('user');

		$this->session->set_flashdata('message', '
			<div class="alert alert-success text-success">Profile berhasil dihapus!
			</div>');
		redirect('user/profile');
	}

	public function ubah_password(){
		$data['role'] = $this->db->get('user_role')->result();
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$id = $data['user']['id'];
		$data['kategori'] = $this->User_model->getKategori();

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'required'=> 'Password tidak boleh kosong!',
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek. Min 8 char!'
		]);
		$this->form_validation->set_rules('password2', 'Passoword', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Ubah Kata Sandi';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('user/ubah_password', $data);
			$this->load->view('template/footer', $data);
		}else{
			$pwbaru = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$this->db->set('password', $pwbaru);
			$this->db->where('id', $id);
			$this->db->update('user');
			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Password berhasil diubah!</div>');
			redirect('user/ubah_password');
		}
	}

	public function add_bookmark($id_bookmark=null){
		
		if (isset($_GET['param']) != null) {
			$value = $_GET['param'];
			$idkategori = $value;
		}else{
			$idkategori = null;
		}
		
		$data['role'] = $this->db->get('user_role')->result();
		if ($idkategori != null) {
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

			$id_user = $data['user']['id'];
			$data = [
				'id_file' => $id_bookmark,
				'id_user' => $id_user,
				'status' => 1
			];
			$this->db->insert('bookmark', $data);


			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Berhasil ditambahkan ke Item Tersimpan!</div>');
			$alamat = urlencode($value);
			redirect('user/library?param='.$alamat);
		}else{
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

			$id_user = $data['user']['id'];
			$data = [
				'id_file' => $id_bookmark,
				'id_user' => $id_user,
				'status' => 1
			];
			$this->db->insert('bookmark', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Berhasil ditambahkan ke Item Tersimpan!</div>');
			redirect('user/library/');
		}
	}

	public function bookmark(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['role'] = $this->db->get('user_role')->result();
		$data['title'] = 'Item Tersimpan';
		$data['kategori'] = $this->User_model->getKategori();

		$id = $data['user']['id'];
		$data['total'] = $this->User_model->total($id);
		$data['akun'] = $this->User_model->getAll();

		$data['bookmark'] = $this->User_model->getBookmark($id);
		if($this->input->post('key')){
			$data['bookmark'] = $this->User_model->getSearchBookmark();
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/bookmark', $data);
		$this->load->view('template/footer', $data);
	}

	public function hapus_bookmark($id_bookmark){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$query = $this->db->delete('bookmark', ['id_file' =>$id_bookmark]);

		$this->session->set_flashdata('message', '
			<div class="alert alert-success">
			Berhasil dihapus dari Item Tersimpan!
			</div>');
		redirect('user/bookmark');
	}

	public function hapus_simpan($id_bookmark = null){
		
		if (isset($_GET['param']) != null) {
			$value = $_GET['param'];
			$idkategori = $value;
		}else{
			$idkategori = null;
		}

		if ($idkategori != null) {
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$query = $this->db->delete('bookmark', ['id_file' =>$id_bookmark]);

			$this->session->set_flashdata('message', '
				<div class="alert alert-success">
				Berhasil dihapus dari Item Tersimpan!
				</div>');
			$alamat = urlencode($value);
			redirect('user/library?param='.$alamat);
		}else{
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$query = $this->db->delete('bookmark', ['id_file' =>$id_bookmark]);

			$this->session->set_flashdata('message', '
				<div class="alert alert-success">
				Berhasil dihapus dari Item Tersimpan!
				</div>');
			redirect('user/library/');
		}
	}
}
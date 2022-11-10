<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
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
		if ($userdata['role_id'] != 1) {
			$data = base_url();
			$this->session->unset_userdata('username', 'role_id');
			$this-> session ->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect($data);
		}
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		$this->load->model('Barang_model');
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Admin_model->getKategori();
		$data['role'] = $this->db->get('user_role')->result();
		$data['title'] = 'Beranda';
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/index');
		$this->load->view('template/footer', $data);
	}

	public function kelola_akun()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'Manajemen Akun';
		$data['kategori'] = $this->Admin_model->getKategori();
		$data['akun'] = $this->Admin_model->getAll();
		$data['role'] = $this->db->get('user_role')->result();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/kelola_akun');
		$this->load->view('template/footer', $data);
	}

	public function tambah_akun()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['role'] = $this->db->get('user_role')->result();
		$data['kategori'] = $this->Admin_model->getKategori();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Nama tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'Username ini sudah pernah didaftarkan!'
		]);

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'required'=> 'Password tidak boleh kosong!',
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek. Min 8 char!'
		]);
		$this->form_validation->set_rules('password2', 'Passoword', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			
			$data['title'] = 'Tambah Akun';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/tambah_akun', $data);
			$this->load->view('template/footer', $data);
		}else{
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'image' => 'default.png',
				'role_id' => $this->input->post('role'),
				'status' => 1,
				'date_created' =>time()
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Akun berhasil dibuat!
				</div>');
			redirect('admin/kelola_akun');
		}
	}

	public function edit_akun($id){
		$data['role'] = $this->db->get('user_role')->result();
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['akun'] = $this->Admin_model->getById($id);
		$data['role_id'] = $this->db->get('user_role')->result_array();
		$data['kategori'] = $this->Admin_model->getKategori();
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Nama tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('pwlama', 'Pwlama', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Akun';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/edit_akun', $data);
			$this->load->view('template/footer', $data);
		}else{
			$this->Admin_model->update_user();
			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Akun berhasil diubah!</div>');
			redirect('admin/kelola_akun');
		}
	}

	public function hapus_akun($id){
		$_id = $this->db->get_where('user', ['id' => $id])->row_array();
		$query = $this->db->delete('user', ['id' =>$id]);
		$this->session->set_flashdata('message', '
			<div class="alert alert-success">
			Akun berhasil dihapus!
			</div>');
		redirect('admin/kelola_akun');
	}

	public function profile(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Admin_model->getKategori();
		$id = $data['user']['id'];
		$old_username = $data['user']['username'];
		$data['role'] = $this->db->get('user_role')->result();

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
			$this->load->view('admin/profile', $data);
			$this->load->view('template/footer', $data);
		}else{
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');

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
				redirect('admin/profile');
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
		redirect('admin/profile');
	}

	public function tambah_kategori(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Admin_model->getKategori();
		$data['role'] = $this->db->get('user_role')->result();
		$this->form_validation->set_rules('kategori', 'kategori', 'required',[
			'required' => 'Masukkan nama kategori baru!'
		]);
		if ($this->form_validation->run()==false) {
			$data['title'] = 'Tambah Kategori';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/tambah_kategori', $data);
			$this->load->view('template/footer', $data);
		}else{
			$kategori = $this->input->post('kategori');
			$data = [
				'kategori' => $kategori
			];

			$this->db->insert('kategori', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Kategori berhasil ditambahkan!
				</div>');
			redirect('admin/tambah_kategori');
		}
	}

	public function edit_kategori($id=null){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get('user_role')->result();
		$data['kategori2'] = $this->db->get_where('kategori', ['id' =>$id])->row_array();
		$data['kategori'] = $this->Admin_model->getKategori();

		$this->form_validation->set_rules('kategori', 'kategori', 'required',[
			'required' => 'Nama kategori tidak boleh kosong!'
		]);
		if ($this->form_validation->run()==false) {
			$data['title'] = 'Edit Kategori '.$data['kategori2']['kategori'] ;
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/edit_kategori', $data);
			$this->load->view('template/footer', $data);
		}else{

			$kategori = $this->input->post('kategori');

			$this->db->set('kategori', $kategori);
			$this->db->where('id', $id);
			$this->db->update('kategori');
			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Kategori berhasil diedit!
				</div>');
			redirect('admin/tambah_kategori');
		}
	}

	public function hapus_kategori($id){
		$this->db->set('id_kategori', 0);
		$this->db->where('id_kategori', $id);
		$this->db->update('fileupload');

		$query = $this->db->delete('kategori', ['id' =>$id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">
			Kategori berhasil dihapus!
			</div>');

		redirect('admin/tambah_kategori');
	}

	public function input_data(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$iduser = $data['user']['id'];
		$data['role'] = $this->db->get('user_role')->result();
		$data['kategori'] = $this->Admin_model->getKategori();

		$this->form_validation->set_rules('judul', 'Judul', 'required',[
			'required' => 'Judul tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('kategori', 'Kategori', 'required',[
			'required' => 'Kategori tidak boleh kosong!'
		]);

		if (empty($_FILES['file']['name']))
		{
			$this->form_validation->set_rules('file', 'File', 'required',[
				'required' => 'File belum dipilih!'
			]);
		}

		if ($this->form_validation->run()==false) {
			$data['title'] = 'Input Data';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/input_data', $data);
			$this->load->view('template/footer', $data);
		}else{
			date_default_timezone_set('Asia/Jakarta');
			$upload = date('Y-m-d');
			
			$data = [
				'judul' => $this->input->post('judul'),
				'nama_file' => $this->fungsiUploadFile('file'),
				'date_uploaded' => date('Y-m-d'),
				'id_user' => $iduser,
				'id_kategori' => $this->input->post('kategori')
			];

			$this->db->insert('fileupload', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success">
				File berhasil diupload!
				</div>');
			redirect('admin/input_data');
		}
	}

	public function fungsiUploadFile($namainputan){
		$config['upload_path']          = './assets/file/upload/';
		$config['allowed_types']        = 'xlsx|pdf|xls|ppt|pptx|doc|docx';
		$config['max_size']             = '8192';
		$this->load->library('upload', $config);
		$this->upload->do_upload($namainputan);
		return $this->upload->data("file_name");
	}

	public function list_data($idkategori=null)
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['role'] = $this->db->get('user_role')->result();
		$data['title'] = "Semua List Data";
		$data['list'] = $this->Admin_model->getListData();
		
		if ($idkategori != null) {
			$data['kategoriid'] = $this->db->get_where('kategori',['id' => $idkategori])->row_array();
			$data['title'] = $data['kategoriid']['kategori'];
			$data['list'] = $this->Admin_model->getListDataFilterKategori($idkategori);
			$data['idkategori'] = $idkategori;
		}
		$data['idkategori'] = $idkategori;
		$data['akun'] = $this->Admin_model->getAll();
		$data['kategori'] = $this->Admin_model->getKategori();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/list_data', $data);
		$this->load->view('template/footer', $data);
	}

	public function edit_list($idkategori, $id=null){

		if ($id != null) {
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list'] = $this->Admin_model->getListById($id);
			$data['kategori'] = $this->Admin_model->getKategori();
			$list = $this->db->get_where('fileupload', ['id' => $id])->row_array();
			$data['role'] = $this->db->get('user_role')->result();
			$this->form_validation->set_rules('judul', 'Judul', 'required',[
				'required' => 'Judul tidak boleh kosong!'
			]);

			$data['idkategori'] = $idkategori;

			if ($this->form_validation->run() == false) {
				$data['title'] = 'Edit List';
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('admin/edit_list', $data);
				$this->load->view('template/footer', $data);
			}else{
				$judul = $this->input->post('judul');
				$kategori = $this->input->post('kategori');

				$upload_file = $_FILES['file']['name'];
				if($upload_file){
					$config['allowed_types'] = 'xlsx|xlx|pdf';
					$config['max_size'] = '2048';
					$config['upload_path'] = './assets/file/upload/';

					$this->load->library('upload', $config);

					if($this->upload->do_upload('file'))
					{
						$old_file = $list['nama_file'];
						unlink(FCPATH . 'assets/file/upload/'. $old_file);
						$new_file = $this->upload->data('file_name');
						$this->db->set('nama_file', $new_file);
					}
					else
					{
						echo $this->upload->display_errors();
					}
				}
				$this->db->set('judul', $judul);
				$this->db->set('id_kategori', $kategori);
				$this->db->where('id', $id);
				$this->db->update('fileupload');
				$this->session->set_flashdata('message', '<div class="alert alert-success">
					Data List berhasil diubah!</div>');
				redirect('admin/list_data/'.$idkategori);
			}
		}else{
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list'] = $this->Admin_model->getListById($idkategori);
			$data['kategori'] = $this->Admin_model->getKategori();
			$list = $this->db->get_where('fileupload', ['id' => $idkategori])->row_array();
			$data['role'] = $this->db->get('user_role')->result();
			$this->form_validation->set_rules('judul', 'Judul', 'required',[
				'required' => 'Judul tidak boleh kosong!'
			]);

			$data['idkategori'] = null;

			if ($this->form_validation->run() == false) {
				$data['title'] = 'Edit List';
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('admin/edit_list', $data);
				$this->load->view('template/footer', $data);
			}else{
				$judul = $this->input->post('judul');
				$kategori = $this->input->post('kategori');
				$upload_file = $_FILES['file']['name'];
				if($upload_file){
					$config['allowed_types'] = 'xlsx|xlx|pdf';
					$config['max_size'] = '2048';
					$config['upload_path'] = './assets/file/upload/';

					$this->load->library('upload', $config);

					if($this->upload->do_upload('file'))
					{
						$old_file = $list['nama_file'];
						unlink(FCPATH . 'assets/file/upload/'. $old_file);
						$new_file = $this->upload->data('file_name');
						$this->db->set('nama_file', $new_file);
					}
					else
					{
						echo $this->upload->display_errors();
					}
				}
				$this->db->set('judul', $judul);
				$this->db->set('id_kategori', $kategori);
				$this->db->where('id', $idkategori);
				$this->db->update('fileupload');
				$this->session->set_flashdata('message', '<div class="alert alert-success">
					Data List berhasil diubah!</div>');
				redirect('admin/list_data');
			}
		}
	}


	public function hapus_list($idkategori,$id=null){
		if ($id!=null) {
			$_id = $this->db->get_where('fileupload', ['id' => $id])->row_array();
			$query = $this->db->delete('fileupload', ['id' =>$id]);
			if ($query) {
				unlink(FCPATH . 'assets/file/upload/'. $_id['nama_file']);
			}
			$this->session->set_flashdata('message', '
				<div class="alert alert-success">
				List berhasil dihapus!
				</div>');
			redirect('admin/list_data/'.$idkategori);
		}else{	
			$_id = $this->db->get_where('fileupload', ['id' => $idkategori])->row_array();
			$query = $this->db->delete('fileupload', ['id' =>$idkategori]);
			if ($query) {
				unlink(FCPATH . 'assets/file/upload/'. $_id['nama_file']);
			}
			$this->session->set_flashdata('message', '
				<div class="alert alert-success">
				List berhasil dihapus!
				</div>');
			redirect('admin/list_data');
		}
	}

	public function backup_data(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->library('zip');
		$this->db->select('nama_file');
		$this->db->from('fileupload');
		$rawdata = $this->db->get()->result_array();
		$datafile = array();
		$lokasi = "./assets/file/upload/";
		foreach ($rawdata as $fu) {
			$datafile  = $lokasi.$fu['nama_file'];
			$this->zip->read_file($datafile);
		}
		$this->zip->download(''.time().'.zip');	
	}

	public function backup_db(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		

		$this->load->dbutil();

		$db_name = 'backup-db-'.$this->db->database.'-on'.date("Y-m-d-H-i-s").'.sql';

		$prefs = array(
        'format'        => 'txt',                       // gzip, zip, txt
        'filename'      => 'sireta.sql',              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
    );

		$backup = $this->dbutil->backup($prefs);
		$this->load->helper('download');
		force_download($db_name, $backup);
	}

	public function input_barang(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'Data Barang';
		$data['barang'] = $this->Barang_model->getBarang();
		$data['role'] = $this->db->get('user_role')->result();
		$data['kategori'] = $this->Admin_model->getKategori();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/input_barang');
		$this->load->view('template/footer', $data);
	}

	public function tambah_barang()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['role'] = $this->db->get('user_role')->result();

		$data['cabang'] = $this->db->get('ms_cabang')->result();

		$this->form_validation->set_rules('barang', 'Barang', 'required|trim',[
			'required' => 'Field barang tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('cabang', 'Cabang', 'required', [
			'required' => 'Field cabang tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('stok', 'Stok', 'required', [
			'required' => 'Field stok tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == false) {
			
			$data['title'] = 'Tambah Barang';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/tambah_barang', $data);
			$this->load->view('template/footer', $data);
		}else{
			$data = [
				'title' => $this->input->post('barang'),
				'id_cabang' =>$this->input->post('cabang'),
				'stok' =>$this->input->post('stok'),
			];
			$this->db->insert('barang', $data);
			$insert_id = $this->db->insert_id();

			$data_detail_pinjam= [
				'id_barang' => $insert_id,
				'cabang1' =>0,
				'cabang2' =>0,
				'cabang3' =>0,
			];
			$this->db->insert('detail_pinjam', $data_detail_pinjam);


			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Data barang berhasil ditambahkan!
				</div>');
			redirect('admin/input_barang');
		}
	}


	public function data_stok(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'Data Stok';
		$data['cabang'] = $this->Barang_model->getCabang();
		$data['barang'] = $this->Barang_model->getBarang();
		
		$data['pinjam'] = $this->Barang_model->getDetailPinjam();

		$data['role'] = $this->db->get('user_role')->result();
		$data['kategori'] = $this->Admin_model->getKategori();


		$data['lengthpinjam'] = count($data['pinjam']);

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/data_stok', $data);
		$this->load->view('template/footer', $data);
	}


	public function pinjam_barang($id_barang)
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['role'] = $this->db->get('user_role')->result();
		$data['cabang'] = $this->db->get('ms_cabang')->result();
		$data['barang'] = $this->Barang_model->getBarangById($id_barang);
		$data['kategori'] = $this->Admin_model->getKategori();


		$this->form_validation->set_rules('pinjam', 'pinjam', 'required|trim',[
			'required' => 'Field pinjam tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('cabang', 'Cabang', 'required', [
			'required' => 'Field cabang tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('ket', 'Ket', 'required', [
			'required' => 'Field keterangan tidak boleh kosong!'
		]);
		$namabarang = $data['barang']['title'];
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Pinjam Barang '.$namabarang;
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/pinjam_barang', $data);
			$this->load->view('template/footer', $data);
		}else{
			$pinjam =  $this->input->post('pinjam');
			$stok = $data['barang']['stok'];
			$cabang = $this->input->post('cabang');

			if ($stok < $pinjam) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">
					Stok '.$namabarang.' kurang! (Sisa stok = '.$stok.');
					</div>');
				redirect('admin/pinjam_barang/'.$id_barang);
			}else{
				$data = [
					'id_cabang' => $cabang,
					'id_barang' => $id_barang,
					'pinjam' => $this->input->post('pinjam'),
					'ket' => $this->input->post('ket'),
					'date_created' => time(),
				];
				//update stok barang
				$update_stok = $stok - $pinjam;
				$this->db->set('stok', $update_stok);
				$this->db->where('id', $id_barang);
				$this->db->update('barang');

				//tambah data tabel pinjam
				$this->db->insert('pinjam', $data);

				//update detail pinjam

				if ($cabang == 1) {
					$this->db->set('cabang1', $pinjam);
					$this->db->where('id_barang', $id_barang);
					$this->db->update('detail_pinjam');
				}else if ($cabang == 2){
					$this->db->set('cabang2', $pinjam);
					$this->db->where('id_barang', $id_barang);
					$this->db->update('detail_pinjam');
				}else if($cabang == 3){
					$this->db->set('cabang3', $pinjam);
					$this->db->where('id_barang', $id_barang);
					$this->db->update('detail_pinjam');
				}

				$this->session->set_flashdata('message', '<div class="alert alert-success">
					Peminjaman barang berhasil!
					</div>');
				redirect('admin/data_stok');
			}
		}
	}

	public function hapus_pinjam_barang($id_barang){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$query = $this->db->delete('pinjam', ['id_barang' =>$id_barang]);
		$this->db->set('cabang1', 0);
		$this->db->set('cabang2', 0);
		$this->db->set('cabang3', 0);
		$this->db->where('id_barang', $id_barang);
		$this->db->update('detail_pinjam');
		$this->session->set_flashdata('message', '
			<div class="alert alert-success">
			Akun berhasil dihapus!
			</div>');
		redirect('admin/data_stok');
	}

	public function detail_pinjam_barang(){
		$cabang = $this->input->get('cabang');
		$id_barang = $this->input->get('id_barang');
		$jumlah_pinjam = $this->input->get('pinjam');
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get('user_role')->result();
		$data['kategori'] = $this->Admin_model->getKategori();

		$data['detail_pinjam'] = $this->Barang_model->getDataPinjamByParam($cabang, $id_barang, $jumlah_pinjam);
		$data['title'] = 'Detail data pinjam barang';

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/detail_pinjam_barang', $data);
		$this->load->view('template/footer', $data);
	}
}
